<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userActual = auth()->user();

        if ($userActual->userCourseProgresses()->count() > 0) {
            $mostrarTarjeta = true;

            $userActual->userCourseProgresses()->get(); // En visual Studio da error pero funciona.

            $userNumeroCursosFinalizados = $userActual->userCourseProgresses()->where('users_courses_statuses_id', 3)->count();

            $ultimoCursoEmpezadoProgreso = $userActual->userCourseProgresses()->where('users_courses_statuses_id', '!=', 3)->orderBy('updated_at', 'desc')->first();

            if ($ultimoCursoEmpezadoProgreso == null) {
                $ultimoCursoFinalizado = $userActual->userCourseProgresses()->where('users_courses_statuses_id', '=', 3)->orderBy('updated_at', 'desc')->first();
                $ultimoCursoEmpezado = $ultimoCursoFinalizado->course()->first();

                $totalLeccionesCurso = $ultimoCursoEmpezado->lesson()->count();

                $totalLeccionesIdsCurso = $ultimoCursoEmpezado->lesson()->pluck('id');

                if ($ultimoCursoFinalizado->lesson()->count() > 0) {

                    $ultimaLeccionComenzada = $ultimoCursoFinalizado->lesson()->first()->id;

                    $posicionUltimaLeccionComenzada = array_search($ultimaLeccionComenzada, $totalLeccionesIdsCurso->toArray()) + 1;

                    $porcentajeCurso = ($posicionUltimaLeccionComenzada / $totalLeccionesCurso) * 100;
                } else {
                    $porcentajeCurso = 0;
                }

                $progresoUltimoCurso = $userActual->userCourseProgresses()->where('course_id', $ultimoCursoEmpezado->id)->first();

                return view('dashboard', compact('userNumeroCursosFinalizados', 'ultimoCursoEmpezado', 'porcentajeCurso', 'mostrarTarjeta', 'userActual', 'progresoUltimoCurso'));
            } else {
                $ultimoCursoEmpezado = $ultimoCursoEmpezadoProgreso->course()->first();

                /** Cuentas para el porcentaje del curso */
                $totalLeccionesCurso = $ultimoCursoEmpezado->lesson()->count();

                $totalLeccionesIdsCurso = $ultimoCursoEmpezado->lesson()->pluck('id');

                if ($ultimoCursoEmpezadoProgreso->lesson()->count() > 0) {

                    $ultimaLeccionComenzada = $ultimoCursoEmpezadoProgreso->lesson()->first()->id;

                    $posicionUltimaLeccionComenzada = array_search($ultimaLeccionComenzada, $totalLeccionesIdsCurso->toArray()) + 1;

                    $porcentajeCurso = ($posicionUltimaLeccionComenzada / $totalLeccionesCurso) * 100;
                } else {
                    $porcentajeCurso = 0;
                }

                $progresoUltimoCurso = $userActual->userCourseProgresses()->where('course_id', $ultimoCursoEmpezado->id)->first();

                return view('dashboard', compact('userNumeroCursosFinalizados', 'ultimoCursoEmpezado', 'porcentajeCurso', 'mostrarTarjeta', 'userActual', 'progresoUltimoCurso'));
            }
        } else {
            $mostrarTarjeta = true;
            $mostrarPasosPorHacer = true;

            $userActual->userCourseProgresses()->get(); // En visual Studio da error pero funciona.

            $userNumeroCursosFinalizados = $userActual->userCourseProgresses()->where('users_courses_statuses_id', 3)->count();
            return view('dashboard', compact('userNumeroCursosFinalizados', 'mostrarTarjeta', 'mostrarPasosPorHacer', 'userActual'));
        }
    }
}
