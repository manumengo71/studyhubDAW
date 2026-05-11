<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketplaceController\SearchRequest;
use App\Models\BillingHistory;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use App\Models\User_course;
use App\Models\User_course_status;
use App\Models\User_course_progress;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    public function index(): View
    {
        $input = [];
        $courses = Course::latest()->take(11)->get();
        $languages = Course::distinct()->pluck('language');
        $temas = CourseCategory::all();
        $categoriasPopulares = CourseCategory::select('courses_categories.*')
            ->selectSub(function ($query) {
                $query->selectRaw('count(*)')
                    ->from('courses')
                    ->whereColumn('courses.courses_categories_id', 'courses_categories.id');
            }, 'courses_count')
            ->orderByDesc('courses_count')
            ->take(7)
            ->get();

        return view('courses.marketplacePrincipal', compact('courses', 'temas', 'categoriasPopulares', 'languages', 'input'));
    }

    // Muestra todos los cursos y categorias juntos

    public function createAllCoursesAndCategories(): View
    {
        $courses = Course::all();
        $temas = CourseCategory::all();
        $languages = Course::distinct()->pluck('language');
        $input = [];
        return view('courses.marketplaceAllCoursesAndCategories', compact('courses', 'temas', 'languages', 'input'));
    }

    // Proceso de compra de un curso
    public function comprarCurso(Request $request)
    {
        $userAuth = auth()->user()->id;
        $user = User::find($userAuth);
        $course = Course::find($request->id);

        if ($user->billingInformation()->count() == 0) {
            return redirect()->route('billinginfo', ['id' => $course->id])->with('errorCreditCard', 'Debes tener una tarjeta de crédito asociada a tu cuenta para poder comprar un curso.');
        } else {

            $user_course_progresses = User_course_progress::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'users_courses_statuses_id' => 1,
            ]);

            $user_course = User_course::create([
                'users_id' => $user->id,
                'courses_id' => $course->id,
                'user_course_progresses_id' => $user_course_progresses->id,
            ]);

            $billing_histories = BillingHistory::create([
                'buyer_id' => $user->id,
                'billing_id' => $user->billingInformation()->first()->id,
                'course_id' => $course->id,
                'purchase_date' => now(),
            ]);

            return redirect()->route('mycourses.createDetail', ['id' => $course->id]);
        }
    }

    // Buscador de cursos y categorias con filtros
    public function search(SearchRequest $request): View
    {
        $request->safe();

        // Lo que ha escrito el usuario
        $search = $request->input('search');

        // Filtros que ha marcado
        $solocursos = $request->has('solocursos');
        $solocategorias = $request->has('solocategorias');
        $porNombre = $request->has('nombre');
        $porDescripcion = $request->has('descripcion');
        $idioma = $request->input('idioma');
        $temas = $request->input('categoria');
        $orden = $request->input('orden');

        // Preparamos las colecciones vacias para los resultados
        $coursesSearch = collect();
        $temasSearch = collect();
        $input = $request->all();

        // Controlamos que la combinacion de filtros tenga sentido
        $combinacionValida = false;

        // Si solo quiere ver categorias
        if ($solocategorias) {
            // Buscamos categorias por nombre
            if ($porNombre == true || $porNombre == false) {
                $temasSearch = CourseCategory::where('name', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
            } else {
                $combinacionValida = false;
            }
        }

        // Si solo quiere ver cursos
        if ($solocursos) {
            $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                ->orWhere('language', 'LIKE', '%' . $search . '%')
                ->orWhereHas('courseCategory', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->get();

            // Si ha marcado buscar por nombre
            if ($porNombre == true) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
                // Si ha marcado buscar por descripcion
            } else if ($porDescripcion == true) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
                // Si ha elegido un idioma concreto
            } else if ($idioma != 0) {
                $coursesSearch = Course::where('language', 'LIKE', '%' . $idioma . '%')->get();
                $combinacionValida = true;
                // Si ha elegido una categoria concreta
            } else if ($temas != 0) {
                $coursesSearch = Course::whereHas('courseCategory', function ($query) use ($temas) {
                    $query->where('id', $temas);
                })->get();
                $combinacionValida = true;
            }

            // Nombre + descripcion
            if ($porNombre == true && $porDescripcion == true) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Nombre + idioma
            if ($porNombre == true && $idioma != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Nombre + categoria
            if ($porNombre == true && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Descripcion + idioma
            if ($porDescripcion == true && $idioma != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Descripcion + categoria
            if ($porDescripcion == true && $temas != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Idioma + categoria
            if ($idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Nombre + descripcion + idioma
            if ($porNombre == true && $porDescripcion == true && $idioma != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Nombre + descripcion + categoria
            if ($porNombre == true && $porDescripcion == true && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Nombre + idioma + categoria
            if ($porNombre == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Todos los filtros a la vez
            if ($porDescripcion == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Descripcion + idioma + categoria
            if ($porNombre == true && $porDescripcion == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Ordenar de A a Z
            if ($orden == 'asc') {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Ordenar de Z a A
            } else if ($orden == 'desc') {
                $coursesSearch = $coursesSearch->sortByDesc('name');
                $combinacionValida = true;
            }

            // Ordenar por nombre de A a Z
            if ($orden == 'asc' && $porNombre == true) {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Ordenar por nombre de Z a A
            } else if ($orden == 'desc' && $porNombre == true) {
                $coursesSearch = $coursesSearch->sortByDesc('name');
                $combinacionValida = true;
            }

            // Ordenar por descripcion de A a Z
            if ($orden == 'asc' && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortBy('short_description');
                $combinacionValida = true;
                // Ordenar por descripcion de Z a A
            } else if ($orden == 'desc' && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortByDesc('short_description');
                $combinacionValida = true;
            }

            // Ordenar por nombre y descripcion de A a Z
            if ($orden == 'asc' && $porNombre == true && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Ordenar por nombre y descripcion de Z a A
            } else if ($orden == 'desc' && $porNombre == true && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortByDesc('name');
                $combinacionValida = true;
            }
        }

        if ($solocursos == false && $solocategorias == false || $solocursos == true && $solocategorias == true) {
            $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                ->orWhere('language', 'LIKE', '%' . $search . '%')
                ->orWhereHas('courseCategory', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })->get();
            $temasSearch = CourseCategory::where('name', 'LIKE', '%' . $search . '%')->get();
            $combinacionValida = true;
        }

        if ($combinacionValida == false) {
            $alert = 'La combinación de filtros seleccionada no es válida.';
        } else {
            $alert = null;
        }

        $temas = CourseCategory::has('courses')->get();
        $languages = Course::distinct()->pluck('language');

        return view('courses.marketplaceSearch', compact('coursesSearch', 'temasSearch', 'temas', 'languages', 'input'), ['alert' => $alert]);
    }

    // Al pulsar en una categoria, muestra todos los cursos de esa categoria

    public function cursosPorCategoria($id): View
    {
        $courses = Course::where('courses_categories_id', $id)->get();
        $temas = CourseCategory::all();
        $languages = Course::distinct()->pluck('language');
        $input = [];
        return view('courses.marketplaceAllCoursesAndCategories', compact('courses', 'temas', 'languages', 'input'));
    }
}
