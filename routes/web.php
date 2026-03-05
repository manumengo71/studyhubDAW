<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}) ->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/userprofile', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('mycourses');

    Route::put('/courses-activate/{id}', [App\Http\Controllers\CourseController::class, 'activate'])->name('courses.activate');
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('courses.destroy');
});

Route::get('/marketplace', function () {
    $courses = Course::all();
    $temas = CourseCategory::all();
    return view('courses.marketplace', compact('courses', 'temas'));
})->middleware(['auth', 'verified'])->name('marketplace');

Route::get('/billinginfo', function () {
    return view('shopping.billinginfo');
})->middleware(['auth', 'verified'])->name('billinginfo');

Route::middleware(['auth'])->group(function () {
    Route::get('/createCourse', [App\Http\Controllers\CourseController::class, 'create'])->name('createCourse');
    Route::post('/createCourse', [App\Http\Controllers\CourseController::class, 'store'])->name('storeCourse');
});
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'listUsers'])->name('listUsers');
        Route::get('/courses', [App\Http\Controllers\AdminController::class, 'listCourses'])->name('listCourses');
        Route::get('/categories', [App\Http\Controllers\AdminController::class, 'listCategories'])->name('listCategories');
        Route::get('/roles', [App\Http\Controllers\AdminController::class, 'listRoles'])->name('listRoles');

    });
});
