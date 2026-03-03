<?php

namespace App\Http\Controllers;

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
        return view('courses.mycourses');
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
    public function store(Request $request)
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

        if ($request->hasFile('imageCourse')) {
            // Eliminar la imagen actual
            $curso->clearMediaCollection('courses_images');

            // Subir la nueva imagen
            $curso->addMediaFromRequest('imageCourse')->toMediaCollection('courses_images');
        } elseif ($request->input('avatar-remove') == 1) {
            $curso->clearMediaCollection('courses_images');
        }

        return redirect()->route('marketplace');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
