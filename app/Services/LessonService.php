<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;

class LessonService
{
    // Crea la leccion (paso 1): titulo y subtitulo
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

    // Guarda el contenido de la leccion (paso 2): el archivo o texto
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

    // Actualiza una leccion que ya existia
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

    // Borra una leccion de forma permanente
    public function delete(int $lessonId): void
    {
        $lesson = Lesson::findOrFail($lessonId);
        $lesson->forceDelete();
    }

    // Cuando se tocan las lecciones de un curso, lo marcamos como pendiente de validar otra vez
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
