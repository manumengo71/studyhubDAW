<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;

class CourseProgressService
{
    /**
     * Obtiene los datos del dashboard para el usuario autenticado.
     * Reemplaza las ~70 líneas de lógica compleja del DashboardController original.
     */
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

        // Buscar el último curso no finalizado
        $activeProgress = $progresses
            ->where('users_courses_statuses_id', '!=', 3)
            ->sortByDesc('updated_at')
            ->first();

        // Si no hay curso activo, usar el último finalizado
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

    /**
     * Calcula el porcentaje de progreso de un curso.
     */
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
