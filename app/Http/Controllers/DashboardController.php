<?php

namespace App\Http\Controllers;

use App\Services\CourseProgressService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private CourseProgressService $progressService
    ) {}

    /**
     * Muestra el dashboard principal del usuario.
     * La lógica de cálculo de progreso se ha extraído a CourseProgressService.
     */
    public function index(): View
    {
        $user = auth()->user()->load([
            'userCourseProgresses.course.lesson',
            'userCourseProgresses.lesson',
            'billingInformation',
        ]);

        $data = $this->progressService->getDashboardData($user);

        return view('dashboard', $data);
    }
}
