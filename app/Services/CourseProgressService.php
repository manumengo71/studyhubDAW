<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;

class CourseProgressService
{
    // Recoge toda la info que necesita el dashboard para el usuario que esta logueado
    public function getDashboardData(User $user): array
    {
        $progresses = $user->userCourseProgresses()
            ->with(['course.lesson', 'lesson'])
            ->get();

        $data = [
            'userActual' => $user,
            'userNumeroCursosFinalizados' => $progresses->where('users_courses_statuses_id', 3)->count(),
            'mostrarTarjeta' => true,
        ];

        if ($progresses->isEmpty()) {
            $data['mostrarPasosPorHacer'] = true;
            return $data;
        }

        // Buscamos el ultimo curso que no haya terminado todavia
        $activeProgress = $progresses
            ->where('users_courses_statuses_id', '!=', 3)
            ->sortByDesc('updated_at')
            ->first();

        // Si no tiene ningun curso activo, cogemos el ultimo que haya terminado
        $latestProgress = $activeProgress 
            ?? $progresses->where('users_courses_statuses_id', 3)
                ->sortByDesc('updated_at')
                ->first();

        if (!$latestProgress || !$latestProgress->course) {
            $data['mostrarPasosPorHacer'] = true;
            return $data;
        }

        $course = $latestProgress->course;
        $data['ultimoCursoEmpezado'] = $course;
        $data['progresoUltimoCurso'] = $latestProgress;
        $data['porcentajeCurso'] = $this->calculateProgress($course, $latestProgress);

        return $data;
    }

    // Calcula el porcentaje de avance del usuario en un curso
    public function calculateProgress(Course $course, $progress): float
    {
        $lessons = $course->lesson()->pluck('id');
        $totalLessons = $lessons->count();

        if ($totalLessons === 0 || !$progress->lesson_id) {
            return 0;
        }

        $currentPosition = $lessons->search($progress->lesson_id);
        
        if ($currentPosition === false) {
            return 0;
        }

        return round((($currentPosition + 1) / $totalLessons) * 100);
    }
}
