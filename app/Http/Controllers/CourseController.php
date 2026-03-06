<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseController\StoreRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CourseCategory;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();
        $courses = Course::withTrashed()->where('owner_id', $user->id)->paginate(5);
        $temas = CourseCategory::all();
        return view('courses.mycourses', compact('courses', 'temas', 'user'));
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
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

        // Se redirige a la página anterior.
        if (url()->previous() === route('listCourses')) {
            return redirect()->route('listCourses');
        } else {
            return redirect()->route('marketplace');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    public function activate(Request $request)
    {
        $curso = Course::withTrashed()->find($request->id);
        $curso->restore();

        return redirect()->route('mycourses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('mycourses');
    }
}
