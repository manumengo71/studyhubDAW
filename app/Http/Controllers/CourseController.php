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
use App\Models\User_course_status;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Mostrar la lista de cursos del usuario.
     */
    public function index(): View
    {
        $user = auth()->user();
        $courses = Course::withTrashed()->where('owner_id', $user->id)->paginate(5);
        $usersCourses = $user->usersCourses()->orderBy('created_at', 'desc')->get();  // En VisualStudio da error, pero funciona bien.
        $coursesIds = $usersCourses->pluck('courses_id')->toArray();
        $coursesUsers = Course::whereIn('id', $coursesIds)->get();
        $temas = CourseCategory::all();
        $status = User_course_status::all();
        return view('courses.mycourses', compact('courses', 'temas', 'user', 'usersCourses', 'coursesUsers', 'status'));
    }

    /**
     * Mostrar el formulario para crear un nuevo curso.
     */
    public function create(): View
    {
        $user = auth()->user();
        $categories = CourseCategory::all();

        return view('courses.createCourse', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    /**
     * Mostrar la vista del detalle del curso.
     */

    public function createDetail(CreateDetailRequest $request)
    {
        $request->safe();

        $request->id;
        $user = auth()->user();
        $temas = CourseCategory::all();
        $courses = Course::inRandomOrder()->limit(4)->get();
        $Nlessons = DB::table('lessons')->where('courses_id', $request->id)->count();
        $lessons = Lesson::where('courses_id', $request->id)->get();
        $hasCreditCard = $user->hasCreditCard();
        return view('courses.course-detail', [
            'course' => Course::withTrashed()->find($request->id),
            'user' => $user,
            'temas' => $temas,
            'courses' => $courses,
            'Nlessons' => $Nlessons,
            'lessons' => $lessons,
            'hasCreditCard' => $hasCreditCard,
        ]);
    }

    /**
     * Mostrar la vista del reproductor del curso.
     */

    public function createPlay(CreatePlayRequest $request): View
    {
        $course = Course::withTrashed()->find($request->id);
        $lessons = Lesson::where('courses_id', $course->id)->get();

        /**
         * Inicializa la variable $lesson en null.
         */
        $lesson = null;

        /**
         * Si el request trae una lección, se guarda en la sesión.
         */
        if (!$request->input('leccion') == null) {
            $lesson = Lesson::find($request->input('leccion'));
            $request->session()->put('leccion', $lesson->id);
        }else{
            $request->session()->put('leccion', 0);
        }

        /**
         * Enviamos la vista con el curso, las lecciones y la lección actual.
         */
        return view('courses.course-play', [
            'course' => $course,
            'lessons' => $lessons,
            'lesson' => $lesson,
        ])->with('lesson', $lesson);
    }

    /**
     * Guardar un nuevo curso en la base de datos.
     */
    public function store(StoreRequest $request)
    {
        $request->safe();

        // Se valida los datos en el request.

        // Se crea el curso
        $curso = Course::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'language' => $request->input('language'),
            'price' => $request->input('price'),
            'owner_id' => $request->input('owner_id'),
            'courses_categories_id' => $request->input('courses_categories_id'),
        ]);

        // SoftDelete del curso para que no aparezca en la lista de cursos (Se puede activar después)
        $curso->delete();

        // Si recibe una imagen, se guarda.
        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } else {
            $curso->addMediaFromUrl('https://i.postimg.cc/HkL86Lc1/sinfoto.png')->toMediaCollection('courses_images');
        }

        // Se redirige a la vista de crear lección para seguir con el proceso.
        return redirect()->route('createLesson', ['id' => $curso]);
    }

    /**
     * Actualizar un curso en la base de datos.
     */
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
        $curso->save();

        if ($request->hasFile('imageCourse')) {
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        }

        $abrirCreados = true;

        return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados]);
    }

    /**
     * Mostrar el formulario para editar un curso.
     */
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

    /**
     * Activar un curso. **Aparece en marketplace**
     */
    public function activate(Request $request)
    {
        $curso = Course::withTrashed()->find($request->id);
        $curso->restore();
        $abrirCreados = true;
        $pageActual = $request->input('page');

        return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
    }

    /**
     * Desactivar un curso. **Desaparece del marketplace**
     */
    public function destroy(Course $course, Request $request)
    {
        $course->delete();
        $abrirCreados = true;
        $pageActual = $request->input('page');

        return redirect()->route('mycourses')->with(['abrirCreados' => $abrirCreados, 'pageActual' => $pageActual]);
    }

    /**
     * Comprar un curso.
     */
    public function comprarCurso(Request $request)
    {
        $user = auth()->user();
    }
}
