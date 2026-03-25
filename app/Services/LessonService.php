<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;

class LessonService
{
    /**
     * Crear el paso 1 de una lección (título/subtítulo).
     * Compartido entre LessonController y AdminController.
     */
    public function createStep1(array $data, int $courseId): Lesson
    {
        $lesson = Lesson::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'courses_id' => $courseId,
            'lessons_types_id' => '1',
        ]);

        $this->invalidateCourseValidation($courseId);

        return $lesson;
    }

    /**
     * Guardar el paso 2 de una lección (contenido/media).
     */
    public function createStep2($request, int $courseId): void
    {
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

        $this->invalidateCourseValidation($courseId);
    }

    /**
     * Actualizar una lección existente.
     */
    public function update(array $data, int $lessonId, $request = null): Lesson
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->title = $data['title'];
        $lesson->subtitle = $data['subtitle'];

        if ($lesson->lessons_types_id == 5) {
            $lesson->content = $data['content'] ?? $lesson->content;
        } elseif ($request && $request->hasFile('media')) {
            $lesson->addMediaFromRequest('media')->toMediaCollection('lesson_content');
        }

        $lesson->save();
        $this->invalidateCourseValidation($lesson->courses_id);

        return $lesson;
    }

    /**
     * Eliminar una lección permanentemente.
     */
    public function delete(int $lessonId): void
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->forceDelete();
    }

    /**
     * Invalidar la validación del curso cuando se modifican sus lecciones.
     * Esto pone el curso en estado "pendiente de re-validación".
     */
    private function invalidateCourseValidation(int $courseId): void
    {
        $course = Course::withTrashed()->find($courseId);
        
        if ($course) {
            $course->validated = null;
            $course->updated_at = now();
            $course->deleted_at = now()->subSeconds(1);
            $course->save();
        }
    }
}
