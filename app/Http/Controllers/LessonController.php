<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonController\PostMediaRequest;
use App\Http\Requests\LessonController\StoreRequestStep1;
use App\Http\Requests\LessonController\StoreRequestStep2;
use App\Http\Requests\LessonController\UpdateRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Mostrar el formulario para crear el step 1 de una lección.
     */

    public function createLessonStep1($id): View
    {
        $curso = Course::withTrashed()->find($id);

        // Verificar si existen lecciones para este curso
        $hasLessons = Lesson::where('courses_id', $id)->exists();

        return view('lesson.createLessonStep1', compact('curso', 'hasLessons'));
    }

    /**
     * Guardar el step1 de una lección en la base de datos.
     */
    public function storeLessonStep1(StoreRequestStep1 $request, $id)
    {

        $request->safe();

        $courseId = $request->route('id');

        $lesson = Lesson::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'courses_id' => $courseId,
            'lessons_types_id' => '1',
        ]);

        $lessonId = $lesson->id;

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('createLessonStep2', ['id' => $courseId, 'lessonId' => $lessonId]);
    }

    /**
     * Mostrar el formulario para crear una nueva lección.
     */

    public function createLessonStep2($id, $lessonId): View
    {
        $curso = Course::withTrashed()->find($id);

        return view('lesson.createLessonStep2', compact('curso', 'lessonId'));
    }

    /**
     * Guardar una nueva lección en la base de datos.
     */
    public function storeLessonStep2(StoreRequestStep2 $request, $id)
    {

        $request->safe();

        $courseId = $request->route('id');

        $lesson = Lesson::where('courses_id', $courseId)->latest()->first();

        if ($request->hasFile('media')) {

            $lesson->update([
                'lessons_types_id' => $request->input('content_type'),
                'content' => null,
            ]);

            $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
        } else {

            $lesson->update([
                'lessons_types_id' => $request->input('content_type'),
                'content' => $request->input('content'),
            ]);
        }

        $hasLessons = Lesson::where('courses_id', $courseId)->exists();

        $course = Course::withTrashed()->find($courseId);

        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

        return redirect()->route('createLessonStep1', ['id' => $courseId])->with(compact('hasLessons'));
    }

    /**
     * Mostrar el formulario para editar una lección.
     */
    public function editLesson(Request $request)
    {
        $lesson = Lesson::where('id', $request->id)->first();
        $lessonType = LessonType::where('id', $lesson->lessons_types_id)->first();
        $data = $lesson->content;

        return view('lesson.updateLesson', [
            'lesson' => $lesson,
            'lessonType' => $lessonType,
            'data' => $data,
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

        if ($lesson->lessons_types_id == 5) {
            $lesson->content = $request->content;
        }else {
            $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
        }

        $lesson->save();

        $courseId = $lesson->courses_id;
        $course = Course::withTrashed()->find($courseId);
        $course->validated = null;
        $course->updated_at = now();
        $course->deleted_at = now()->subSeconds(1);
        $course->save();

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

    /**
     * Guardar imagen
     *
     */
    public function postMedia(PostMediaRequest $request, $courseId, $lessonId)
    {

        $request->safe();

        $courseId = $request->route('courseId');
        $lessonId = $request->route('lessonId');

        $lesson = Lesson::find($lessonId);
        $course = Course::withTrashed()->find($courseId);

        if ($course->lesson->contains('id', $lessonId)) {
            $lesson->addMediaFromRequest('image')->toMediaCollection('lesson_content');
            $image = $lesson->getMedia('lesson_content')->last()->getUrl();

            return response()->json(['success' => !!$image, 'file' => ['url' => $image]]);
        } else {
            return response()->json(['success' => false, 'file' => ['url' => '']]);
        }

    }
}
