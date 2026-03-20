<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonController\StoreRequest;
use App\Http\Requests\LessonController\UpdateRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Mostrar el formulario para crear una nueva lección.
     */

    public function createLesson($id): View
    {
        $curso = Course::withTrashed()->find($id);

        // Verificar si existen lecciones para este curso
        $hasLessons = Lesson::where('courses_id', $id)->exists();

        return view('lesson.createLesson', compact('curso', 'hasLessons'));
    }

    /**
     * Guardar una nueva lección en la base de datos.
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

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('createLesson', ['id' => $courseId])->with(compact('hasLessons'));

    }

    /**
     * Mostrar el formulario para editar una lección.
     */
    public function editLesson(Request $request)
    {
        $lesson = Lesson::where('id', $request->id)->first();

        return view('lesson.updateLesson', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * Actualizar una lección en la base de datos.
     */
    public function updateLesson(UpdateRequest $request)
    {
        $request->safe();

        $lesson = Lesson::find($request->id);
        $lesson->title = $request->title;
        $lesson->subtitle = $request->subtitle;
        $lesson->lessons_types_id = $request->content_type;
        $lesson->save();
        $courseId = $lesson->courses_id;

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        if ($request->hasFile('content')) {
            $lesson->addMediaFromRequest('content')->toMediaCollection('lesson_content');
        }

        return redirect()->route('mycourses.editCourse', ['id' => $courseId]);
    }

        /**
     * Actualizar una lección en la base de datos.
     */
    public function updateLessonAdmin(UpdateRequest $request)
    {
        $request->safe();

        $lesson = Lesson::find($request->id);
        $lesson->title = $request->title;
        $lesson->subtitle = $request->subtitle;
        $lesson->lessons_types_id = $request->content_type;
        $lesson->save();
        $courseId = $lesson->courses_id;

        if ($request->hasFile('content')) {
            $lesson->addMediaFromRequest('content')->toMediaCollection('lesson_content');
        }

        return redirect()->route('admin.editCourse', ['id' => $courseId]);
    }

}
