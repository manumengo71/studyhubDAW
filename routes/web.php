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

/** RUTA PRINCIPAL */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/** RUTAS DE DASHBOARD */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/** RUTAS DE PERFIL */
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userprofile', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
});

/** RUTAS DE MARKETPLACE */
Route::get('/marketplace', function () {
    $courses = Course::all();
    $temas = CourseCategory::all();
    return view('courses.marketplace', compact('courses', 'temas'));
})->middleware(['auth', 'verified'])->name('marketplace');

/** RUTAS DE SHOPPING */
Route::get('/billinginfo', function () {
    return view('shopping.billinginfo');
})->middleware(['auth', 'verified'])->name('billinginfo');

/** RUTAS DE COURSES */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('mycourses');
    Route::put('/courses-activate/{id}', [App\Http\Controllers\CourseController::class, 'activate'])->name('mycourses.activate');
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('mycourses.destroy');
    Route::get('/createCourse', [App\Http\Controllers\CourseController::class, 'create'])->name('mycourses.createCourse');
    Route::post('/createCourse', [App\Http\Controllers\CourseController::class, 'store'])->name('mycourses.storeCourse');
});

/** RUTAS DE ADMIN */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');

        /** RUTAS PARA CATEGORIES */
        Route::get('/categories', [App\Http\Controllers\AdminController::class, 'listCategories'])->name('listCategories');
        Route::get('/createCategory', [App\Http\Controllers\AdminController::class, 'createCategory'])->name('createCategory');
        Route::post('/storeCategory', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('storeCategory');
        Route::delete('/categories-disable/{category}', [App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('category.destroy');
        Route::put('/categories-activate/{category}', [App\Http\Controllers\AdminController::class, 'activateCategory'])->name('category.activate');
        Route::delete('/categories-delete/{id}', [App\Http\Controllers\AdminController::class, 'forceDestroyCategory'])->name('category.forceDestroy');
        Route::get('/categories-edit/{category}', [App\Http\Controllers\AdminController::class, 'editCategoryView'])->name('category.editView');
        Route::patch('/categories-edit/{id}', [App\Http\Controllers\AdminController::class, 'editCategory'])->name('category.edit');

        /** RUTAS PARA COURSES */
        Route::get('/courses', [App\Http\Controllers\AdminController::class, 'listCourses'])->name('listCourses');
        Route::put('/activateCourse/{id}', [App\Http\Controllers\AdminController::class, 'activateCourse'])->name('courses.activate');
        Route::delete('/disableCourse/{course}', [App\Http\Controllers\AdminController::class, 'disableCourse'])->name('courses.disable');
        Route::delete('/deleteCourse/{course}', [App\Http\Controllers\AdminController::class, 'deleteCourse'])->name('courses.delete');

        /** RUTAS PARA USERS */
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'listUsers'])->name('listUsers');
        Route::get('/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('createUser');
        Route::post('/storeUser', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('storeUser');
        Route::get('/editUser/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
        Route::patch('/updateUser/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('updateUser');
        Route::put('/activateUser/{id}', [App\Http\Controllers\AdminController::class, 'activateUser'])->name('users.activate');
        Route::delete('/disableUser/{user}', [App\Http\Controllers\AdminController::class, 'disableUser'])->name('users.disable');
        Route::delete('/deleteUser/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');

        /** RUTAS PARA ROLES */
        Route::get('/roles', [App\Http\Controllers\AdminController::class, 'listRoles'])->name('listRoles');
        Route::get('/createRole', [App\Http\Controllers\AdminController::class, 'createRole'])->name('createRole');
        Route::post('/storeRole', [App\Http\Controllers\AdminController::class, 'storeRole'])->name('storeRole');
        Route::get('/roles-edit/{id}', [App\Http\Controllers\AdminController::class, 'editRoleView'])->name('roles.editView');
        Route::patch('/roles-edit/{id}', [App\Http\Controllers\AdminController::class, 'editRole'])->name('roles.edit');
        Route::put('/roles-activate/{id}', [App\Http\Controllers\AdminController::class, 'activateRole'])->name('roles.activate');
        Route::delete('/roles-disable/{id}', [App\Http\Controllers\AdminController::class, 'destroyRole'])->name('roles.disable');
        Route::delete('/roles-delete/{id}/{guard_name}', [App\Http\Controllers\AdminController::class, 'forceDestroyRole'])->name('roles.forceDestroy');
    });

    require __DIR__ . '/auth.php';
});
