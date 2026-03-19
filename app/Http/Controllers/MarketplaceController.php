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

        return view('courses.marketplace-principal', compact('courses', 'temas', 'categoriasPopulares', 'languages', 'input'));
    }

    /**
     * Muestra el listado de todos los cursos y categorías.
     */

    public function createAllCoursesAndCategories(): View
    {
        $courses = Course::all();
        $temas = CourseCategory::all();
        $languages = Course::distinct()->pluck('language');
        $input = [];
        return view('courses.marketplace-allCoursesAndCategories', compact('courses', 'temas', 'languages', 'input'));
    }

    /**
     * Comprar un curso.
     */
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

    /**
     * Función para buscar cursos y categorías.
     */
    public function search(SearchRequest $request): View
    {
        $request->safe();

        /** Input */
        $search = $request->input('search');

        /** Filters */
        $solocursos = $request->has('solocursos');
        $solocategorias = $request->has('solocategorias');
        $porNombre = $request->has('nombre');
        $porDescripcion = $request->has('descripcion');
        $idioma = $request->input('idioma');
        $temas = $request->input('categoria');
        $orden = $request->input('orden');

        /** Query */
        $coursesSearch = collect();
        $temasSearch = collect();
        $input = $request->all();

        /** Boolean de combinacion válida */
        $combinacionValida = false;

        // Si está seleccionado el filtro de solo categorias
        if ($solocategorias) {
            // Si esta seleccionado o no además el filtro de por nombre
            if ($porNombre == true || $porNombre == false) {
                $temasSearch = CourseCategory::where('name', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
            } else {
                $combinacionValida = false;
            }
        }

        // Si está seleccionado el filtro de solo cursos
        if ($solocursos) {
            $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                ->orWhere('language', 'LIKE', '%' . $search . '%')
                ->orWhereHas('courseCategory', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->get();

            // Si está seleccionado o no además el filtro de por nombre
            if ($porNombre == true) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
                // Si está seleccionado o no además el filtro de por descripcion
            } else if ($porDescripcion == true) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')->get();
                $combinacionValida = true;
                // Si está seleccionado o no además el filtro de por idioma
            } else if ($idioma != 0) {
                $coursesSearch = Course::where('language', 'LIKE', '%' . $idioma . '%')->get();
                $combinacionValida = true;
                // Si está seleccionado o no además el filtro de por temas
            } else if ($temas != 0) {
                $coursesSearch = Course::whereHas('courseCategory', function ($query) use ($temas) {
                    $query->where('id', $temas);
                })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre y por descripcion
            if ($porNombre == true && $porDescripcion == true) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre y por idioma
            if ($porNombre == true && $idioma != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre y por temas
            if ($porNombre == true && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por descripcion y por idioma
            if ($porDescripcion == true && $idioma != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por descripcion y por temas
            if ($porDescripcion == true && $temas != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por idioma y por temas
            if ($idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre, por descripcion y por idioma
            if ($porNombre == true && $porDescripcion == true && $idioma != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre, por descripcion y por temas
            if ($porNombre == true && $porDescripcion == true && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por descripcion, por idioma y por temas
            if ($porNombre == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre, por descripcion, por idioma y por temas
            if ($porDescripcion == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si está seleccionado o no además el filtro de por nombre, por descripcion, por idioma y por temas
            if ($porNombre == true && $porDescripcion == true && $idioma != 0 && $temas != 0) {
                $coursesSearch = Course::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $search . '%')
                    ->where('language', 'LIKE', '%' . $idioma . '%')
                    ->whereHas('courseCategory', function ($query) use ($temas) {
                        $query->where('id', $temas);
                    })->get();
                $combinacionValida = true;
            }

            // Si orden es ascendente
            if ($orden == 'asc') {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Si orden es descendente
            } else if ($orden == 'desc') {
                $coursesSearch = $coursesSearch->sortByDesc('name');
                $combinacionValida = true;
            }

            // Si orden es ascendente y por nombre es true
            if ($orden == 'asc' && $porNombre == true) {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Si orden es descendente y por nombre es true
            } else if ($orden == 'desc' && $porNombre == true) {
                $coursesSearch = $coursesSearch->sortByDesc('name');
                $combinacionValida = true;
            }

            // Si orden es ascendente y por descripcion es true
            if ($orden == 'asc' && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortBy('short_description');
                $combinacionValida = true;
                // Si orden es descendente y por descripcion es true
            } else if ($orden == 'desc' && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortByDesc('short_description');
                $combinacionValida = true;
            }

            // Si orden es ascendente y nombre y descripcion son true
            if ($orden == 'asc' && $porNombre == true && $porDescripcion == true) {
                $coursesSearch = $coursesSearch->sortBy('name');
                $combinacionValida = true;
                // Si orden es descendente y nombre y descripcion son true
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

        return view('courses.marketplace-search', compact('coursesSearch', 'temasSearch', 'temas', 'languages', 'input'), ['alert' => $alert]);
    }

    /**
     * Click en categoría te lleva a todos los cursos con esa categoría.
     */

    public function cursosPorCategoria($id): View
    {
        $courses = Course::where('courses_categories_id', $id)->get();
        $temas = CourseCategory::all();
        $languages = Course::distinct()->pluck('language');
        $input = [];
        return view('courses.marketplace-allCoursesAndCategories', compact('courses', 'temas', 'languages', 'input'));
    }
}
