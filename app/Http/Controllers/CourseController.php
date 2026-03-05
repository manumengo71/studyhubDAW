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
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string',
            'owner_id' => 'required',
            'courses_categories_id' => 'required',
        ]);

        $curso = Course::create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'language' => $request->input('language'),
            'owner_id' => $request->input('owner_id'),
            'courses_categories_id' => $request->input('courses_categories_id'),
        ]);

        //
        $curso->delete();

        if ($request->hasFile('imageCourse')) {
            // Eliminar la imagen actual
            $curso->clearMediaCollection('courses_images');

            // Subir la nueva imagen
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } elseif ($request->input('avatar-remove') == 1) {
            $curso->clearMediaCollection('courses_images');
        }

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
