<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonController\StoreRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    // public function createLesson(Request $id): View
    // {
    //     $IdCurso = $id->id;
    //     $curso = Course::withTrashed()->find($IdCurso);

    //     return view('lesson.createLesson', compact('curso'));
    // }


    public function createLesson($id): View
    {
        $curso = Course::withTrashed()->find($id);

        // Verificar si existen lecciones para este curso
        $hasLessons = Lesson::where('courses_id', $id)->exists();

        return view('lesson.createLesson', compact('curso', 'hasLessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeLesson(StoreRequest $request, $id){

        $request->safe();

        $courseId = $request->route('id');

        $lesson = Lesson::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'courses_id' => $courseId,
            'lessons_types_id' => $request->input('content_type'),
        ]);

        $lesson->addMediaFromRequest('content')->toMediaCollection('lesson_content');

        $hasLessons = Lesson::where('courses_id', $courseId)->exists();

        return redirect()->route('createLesson', ['id' => $courseId])->with(compact('hasLessons'));

    }

}
