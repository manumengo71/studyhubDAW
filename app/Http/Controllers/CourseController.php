<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseController\CreateDetailRequest;
use App\Http\Requests\CourseController\CreatePlayRequest;
use App\Http\Requests\CourseController\StoreRequest;
use App\Http\Requests\CourseController\UpdateRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CourseCategory;
use App\Models\Lesson;
use App\Models\User_course_progress;
use App\Models\User_course_status;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class CourseController extends Controller
{
    // Muestra los cursos creados y comprados del usuario
    public function index(): View
    {
        $user = auth()->user();
        $courses = Course::withTrashed()->where('owner_id', $user->id)->paginate(5);

        $usersCourses = $user->usersCourses()->with('userCourseProgresses')->orderBy('created_at', 'desc')->get(); // VSCode marca error aqui pero funciona sin problema

        $coursesIds = $usersCourses->pluck('courses_id')->toArray();
        $coursesUsers = Course::withTrashed()->whereIn('id', $coursesIds)->get();
        $temas = CourseCategory::all();



        return view('courses.mycourses', compact('courses', 'temas', 'user', 'usersCourses', 'coursesUsers'));
    }

    // Muestra el formulario para crear un curso nuevo
    public function create(): View
    {
        $user = auth()->user();
        $categories = CourseCategory::all();

        return view('courses.createCourse', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    // Muestra la pagina con toda la info del curso (detalle)

    public function createDetail(CreateDetailRequest $request)
    {
        $request->safe();

        $request->id;
        $user = auth()->user();
        $temas = CourseCategory::all();
        // Sacamos cursos aleatorios que el usuario no haya comprado ya, para sugerirle otros
        $courses = Course::whereNotIn('id', function ($query) use ($user) {
            $query->select('courses_id')
                ->from('users_courses')
                ->where('users_id', $user->id);
        })->inRandomOrder()->limit(4)->get();
        $Nlessons = DB::table('lessons')->where('courses_id', $request->id)->count();
        $lessons = Lesson::where('courses_id', $request->id)->get();
        $hasCreditCard = $user->hasCreditCard();
        return view('courses.courseDetail', [
            'course' => Course::withTrashed()->find($request->id),
            'user' => $user,
            'temas' => $temas,
            'courses' => $courses,
            'Nlessons' => $Nlessons,
            'lessons' => $lessons,
            'hasCreditCard' => $hasCreditCard,
        ]);
    }

    // Carga el reproductor del curso con sus lecciones

    public function createPlay(CreatePlayRequest $request): View
    {
        $course = Course::withTrashed()->find($request->id);
        $lessons = Lesson::where('courses_id', $course->id)->get();

        // Empezamos sin leccion seleccionada
        $lesson = null;
        $data = null;

        if ($request->input('continuar') == 'true') {
            $user = auth()->user();
            $userCourse = User_course_progress::where('user_id', $user->id)->where('course_id', $course->id)->first();
            $lesson = Lesson::find($userCourse->lesson_id);
        } elseif ($request->input('empezarDeNuevo') == 'true') {
            $user = auth()->user();
            $userCourse = User_course_progress::where('user_id', $user->id)->where('course_id', $course->id)->first();
            $lesson = null;
            $userCourse->users_courses_statuses_id = 1;
            $userCourse->lesson_id = null;
            $userCourse->save();
        }

        // Si viene una leccion en la peticion, la guardamos en sesion y actualizamos el progreso
        if (!$request->input('leccion') == null) {
            $lesson = Lesson::find($request->input('leccion'));
            $request->session()->put('leccion', $lesson->id);

            // Guardamos hasta donde ha llegado el usuario en el curso

            $user = auth()->user();

            $userCourse = User_course_progress::where('user_id', $user->id)->where('course_id', $course->id)->first();

            $ultimaLeccionCurso = Lesson::where('courses_id', $course->id)->orderBy('id', 'desc')->first();



            if ($userCourse->lesson_id < $lesson->id) {
                $userCourse->lesson_id = $lesson->id;
                $userCourse->users_courses_statuses_id = 2;
                $userCourse->save();

                if ($userCourse->lesson_id == $ultimaLeccionCurso->id) {
                    $userCourse->users_courses_statuses_id = 3;
                    $userCourse->save();
                }
            }

            if ($lesson->lessons_types_id == 5) {
                $data = $lesson->content;
            }
        } elseif ($request->input('continuar') == 'true') {
            $request->session()->put('leccion', $lesson->id);
        } elseif ($request->input('empezarDeNuevo') == 'true') {
            $request->session()->put('leccion', 0);
        } else {
            $request->session()->put('leccion', 0);
        }

        // Devolvemos la vista con todo lo necesario para el reproductor
        return view('courses.coursePlay', [
            'course' => $course,
            'lessons' => $lessons,
            'lesson' => $lesson,
            'data' => $data,
        ])->with('lesson', $lesson);
    }

    // Guarda un curso nuevo en la base de datos
    public function store(StoreRequest $request)
    {
        $request->safe();



        // Creamos el curso con los datos del formulario
        $curso = Course::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'language' => $request->input('language'),
            'price' => $request->input('price'),
            'validated' => null,
            'owner_id' => $request->input('owner_id'),
            'courses_categories_id' => $request->input('courses_categories_id'),
        ]);

        // Lo dejamos desactivado por defecto, ya se activara cuando este listo
        $curso->delete();

        // Si sube una imagen la guardamos, si no le ponemos una por defecto
        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } else {
            $curso->addMediaFromUrl('https://i.postimg.cc/HkL86Lc1/sinfoto.png')->toMediaCollection('courses_images');
        }

        // Redirigimos al siguiente paso: crear la primera leccion
        return redirect()->route('createLessonStep1', ['id' => $curso]);
    }

    // Actualiza los datos de un curso existente
    public function update(UpdateRequest $request)
    {
        $request->safe();

        $curso = Course::withTrashed()->find($request->id);
        $curso->name = $request->name;
        $curso->short_description = $request->short_description;
        $curso->description = $request->description;
        $curso->language = $request->language;
        $curso->price = $request->price;
        $curso->owner_id = $request->owner_id;
        $curso->courses_categories_id = $request->courses_categories_id;
        $curso->validated = null;
        $curso->updated_at = now();
        $curso->deleted_at = now()->subSeconds(1);
        $curso->save();

        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        }

        $abrirCreados = true;

        return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados]);
    }

    // Muestra el formulario de edicion de un curso
    public function edit(Request $request, Course $course)
    {
        $user = auth()->user();
        $categories = CourseCategory::all();
        $lessons = Lesson::where('courses_id', $request->id)->get();
        $courseInfo = Course::withTrashed()->find($request->id);
        $lessons = Lesson::where('courses_id', $request->id)->get();

        return view('courses.updateCourse', [
            'user' => $user,
            'categories' => $categories,
            'lessons' => $lessons,
            'courseInfo' => $courseInfo,
            'lessons' => $lessons,
        ]);
    }

    // Activa un curso para que aparezca en el marketplace (solo si esta validado)
    public function activate(Request $request)
    {
        $curso = Course::withTrashed()->find($request->id);

        if ($curso->deleted_at == $curso->updated_at && $curso->validated === 1) {
            $curso->restore();
            $abrirCreados = true;
            $pageActual = $request->input('page');

            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        } else {
            $abrirCreados = true;
            $pageActual = $request->input('page');
            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        }
    }

    // Envia el curso a validacion, el admin lo revisara y decidira si lo aprueba
    public function validateCourse(Request $request)
    {
        $curso = Course::withTrashed()->find($request->id);
        if ($curso->deleted_at !== null && $curso->validated === null) {
            $curso->validated = false;
            $curso->updated_at = now();
            $curso->deleted_at = $curso->updated_at;
            $curso->save();
            $abrirCreados = true;
            $pageActual = $request->input('page');
            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        } else {
            $abrirCreados = true;
            $pageActual = $request->input('page');

            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        }
    }

    // Desactiva un curso, deja de aparecer en el marketplace
    public function destroy(Course $course, Request $request)
    {
        if ($course->deleted_at === null && $course->validated === 1) {
            $course->updated_at = now();
            $course->deleted_at = $course->updated_at;
            $course->delete();
            $abrirCreados = true;
            $pageActual = $request->input('page');

            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        } else {
            $abrirCreados = true;
            $pageActual = $request->input('page');

            return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
        }
    }

    // Comprar un curso (pendiente de completar)
    public function comprarCurso(Request $request)
    {
        $user = auth()->user();
    }

    // Muestra la ficha informativa del curso

    public function createInfo(Request $request)
    {
        $course = Course::withTrashed()->find($request->id);

        $courseImage = $course->getFirstMediaUrl('courses_images');

        return view('courses.courseInfo')->with(['course' => $course, 'courseImage' => $courseImage]);
    }

    // Genera y descarga el certificado en PDF cuando el usuario ha terminado el curso
    public function downloadCertificate(Request $request, $id)
    {
        $user = auth()->user();
        $course = Course::withTrashed()->findOrFail($id);

        $userCourse = User_course_progress::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$userCourse || $userCourse->users_courses_statuses_id != 3) {
            abort(403, 'No has completado este curso.');
        }

        // Sacamos la fecha en la que termino el curso
        $date = $userCourse->updated_at->format('d/m/Y');

        $pdf = FacadePdf::loadView('courses.certificatePdf', compact('user', 'course', 'date'));
        
        // Lo ponemos en horizontal que queda mejor como diploma
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download("Certificado_{$course->name}.pdf");
    }
}
