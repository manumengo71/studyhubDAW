<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas organizadas por secciones con middleware correctamente aplicado.
|
*/

/** RUTA PRINCIPAL */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * RUTAS PARA LEGAL (públicas)
 */
Route::view('/condiciones', 'legal.condiciones')->name('condiciones');
Route::view('/ayuda', 'legal.ayudaAsistencia')->name('ayuda');
Route::view('/politicaPrivacidad', 'legal.politicaPrivacidad')->name('privacidad');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas autenticadas y verificadas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /** DASHBOARD */
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    /** PERFIL */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userprofile', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
    Route::delete('/userprofile', [ProfileController::class, 'forceDelete'])->name('userprofile.destroy');

    /** MARKETPLACE */
    Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace');
    Route::get('/marketplace/allcoursesAndCategories', [App\Http\Controllers\MarketplaceController::class, 'createAllCoursesAndCategories'])->name('marketplace.allCoursesAndCategories');
    Route::get('/marketplace/busqueda', [App\Http\Controllers\MarketplaceController::class, 'search'])->name('marketplace.search');
    Route::post('/marketplace/comprarCurso/{id}', [App\Http\Controllers\MarketplaceController::class, 'comprarCurso'])->name('marketplace.comprarCurso');
    Route::get('/marketplace/cursosPorCategoria/{id}', [App\Http\Controllers\MarketplaceController::class, 'cursosPorCategoria'])->name('marketplace.cursosPorCategoria');

    /** INFORMACIÓN DE PAGO */
    Route::get('/billinginfo', [App\Http\Controllers\BillingInformationController::class, 'getInfo'])->name('billinginfo');
    Route::post('/storeCreditCard', [App\Http\Controllers\BillingInformationController::class, 'storeCreditCard'])->name('storeCreditCard');
    Route::get('/billingpdf/{id}', [App\Http\Controllers\BillingInformationController::class, 'downloadPdf'])->name('downloadPdf');

    /** CURSOS */
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('mycourses');
    Route::put('/courses-activate/{id}', [App\Http\Controllers\CourseController::class, 'activate'])->name('mycourses.activate');
    Route::put('/course-validate/{id}', [App\Http\Controllers\CourseController::class, 'validateCourse'])->name('mycourses.validate');
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('mycourses.destroy');
    Route::get('/createCourse', [App\Http\Controllers\CourseController::class, 'create'])->name('mycourses.createCourse');
    Route::post('/createCourse', [App\Http\Controllers\CourseController::class, 'store'])->name('mycourses.storeCourse');
    Route::get('/course-detail/{id}', [App\Http\Controllers\CourseController::class, 'createDetail'])->name('mycourses.createDetail');
    Route::get('/editCourse/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('mycourses.editCourse');
    Route::patch('/updateCourse/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('mycourses.updateCourse');
    Route::get('/course-play/{id}/{idlesson?}', [App\Http\Controllers\CourseController::class, 'createPlay'])->name('mycourses.createPlay');
    Route::get('/courses/createInfo/{id}', [App\Http\Controllers\CourseController::class, 'createInfo'])->name('mycourses.createInfo');

    /** LECCIONES (🔐 CORREGIDO: antes NO tenían middleware auth) */
    Route::get('/createLessonStep1/{id}', [App\Http\Controllers\LessonController::class, 'createLessonStep1'])->name('createLessonStep1');
    Route::post('/storeLessonStep1/{id}', [App\Http\Controllers\LessonController::class, 'storeLessonStep1'])->name('storeLessonStep1');
    Route::get('/createLessonStep2/{id}/{lessonId}', [App\Http\Controllers\LessonController::class, 'createLessonStep2'])->name('createLessonStep2');
    Route::post('/storeLessonStep2/{id}', [App\Http\Controllers\LessonController::class, 'storeLessonStep2'])->name('storeLessonStep2');
    Route::get('/editLesson/{id}', [App\Http\Controllers\LessonController::class, 'editLesson'])->name('editLesson');
    Route::patch('/updateLesson/{id}', [App\Http\Controllers\LessonController::class, 'updateLesson'])->name('updateLesson');
    Route::delete('/deleteLesson/{id}', [App\Http\Controllers\LessonController::class, 'deleteLesson'])->name('deleteLesson');
    Route::post('/post-media/{courseId}/{lessonId}', [App\Http\Controllers\LessonController::class, 'postMedia'])->name('postMedia');
});

/*
|--------------------------------------------------------------------------
| Rutas de Administración
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index'); // accessible as admin.index AND 'admin' (alias below)

    // Backward-compatible alias
    Route::get('/dashboard', function () { return redirect()->route('admin.index'); })->name('dashboard');

    /** CATEGORÍAS */
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'listCategories'])->name('listCategories');
    Route::get('/categories/busqueda', [App\Http\Controllers\AdminController::class, 'searchCategories'])->name('categories.search');
    Route::get('/createCategory', [App\Http\Controllers\AdminController::class, 'createCategory'])->name('createCategory');
    Route::post('/storeCategory', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('storeCategory');
    Route::delete('/categories-disable/{category}', [App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('category.destroy');
    Route::put('/categories-activate/{category}', [App\Http\Controllers\AdminController::class, 'activateCategory'])->name('category.activate');
    Route::delete('/categories-delete/{id}', [App\Http\Controllers\AdminController::class, 'forceDestroyCategory'])->name('category.forceDestroy');
    Route::get('/categories-edit/{category}', [App\Http\Controllers\AdminController::class, 'editCategoryView'])->name('category.editView');
    Route::patch('/categories-edit/{id}', [App\Http\Controllers\AdminController::class, 'editCategory'])->name('category.edit');

    /** CURSOS */
    Route::get('/courses', [App\Http\Controllers\AdminController::class, 'listCourses'])->name('listCourses');
    Route::get('/courses/busqueda', [App\Http\Controllers\AdminController::class, 'searchCourses'])->name('courses.search');
    Route::get('/createCourse', [App\Http\Controllers\AdminController::class, 'createCourse'])->name('createCourse');
    Route::post('/storeCourse', [App\Http\Controllers\AdminController::class, 'storeCourse'])->name('storeCourse');
    Route::patch('/updateCourse/{id}', [App\Http\Controllers\AdminController::class, 'updateCourse'])->name('updateCourse');
    Route::get('/editCourse/{id}', [App\Http\Controllers\AdminController::class, 'editCourse'])->name('editCourse');
    Route::put('/activateCourse/{id}', [App\Http\Controllers\AdminController::class, 'activateCourse'])->name('courses.activate');
    Route::delete('/disableCourse/{course}', [App\Http\Controllers\AdminController::class, 'disableCourse'])->name('courses.disable');
    Route::delete('/deleteCourse/{course}', [App\Http\Controllers\AdminController::class, 'deleteCourse'])->name('courses.delete');
    Route::get('/viewCourse/{id}', [App\Http\Controllers\AdminController::class, 'viewCourse'])->name('courses.viewCourse');

    /** LECCIONES */
    Route::get('/createLessonStep1/{id}', [App\Http\Controllers\AdminController::class, 'createLessonStep1'])->name('createLessonStep1');
    Route::get('/createLessonStep2/{id}/{lessonId}', [App\Http\Controllers\AdminController::class, 'createLessonStep2'])->name('createLessonStep2');
    Route::post('/storeLessonStep1/{id}', [App\Http\Controllers\AdminController::class, 'storeLessonStep1'])->name('storeLessonStep1');
    Route::post('/storeLessonStep2/{id}', [App\Http\Controllers\AdminController::class, 'storeLessonStep2'])->name('storeLessonStep2');
    Route::get('/editLesson/{id}', [App\Http\Controllers\AdminController::class, 'editLesson'])->name('editLesson');
    Route::patch('/updateLesson/{id}', [App\Http\Controllers\AdminController::class, 'updateLesson'])->name('updateLesson');
    Route::delete('/deleteLesson/{id}', [App\Http\Controllers\AdminController::class, 'deleteLesson'])->name('deleteLesson');

    /** USUARIOS */
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'listUsers'])->name('listUsers');
    Route::get('/users/busqueda', [App\Http\Controllers\AdminController::class, 'searchUsers'])->name('users.search');
    Route::get('/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('createUser');
    Route::post('/storeUser', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('storeUser');
    Route::get('/editUser/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
    Route::patch('/updateUser/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('updateUser');
    Route::put('/activateUser/{id}', [App\Http\Controllers\AdminController::class, 'activateUser'])->name('users.activate');
    Route::delete('/disableUser/{user}', [App\Http\Controllers\AdminController::class, 'disableUser'])->name('users.disable');
    Route::delete('/deleteUser/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');

    /** ROLES */
    Route::get('/roles', [App\Http\Controllers\AdminController::class, 'listRoles'])->name('listRoles');
    Route::get('/roles/busqueda', [App\Http\Controllers\AdminController::class, 'searchRole'])->name('roles.search');
    Route::get('/createRole', [App\Http\Controllers\AdminController::class, 'createRole'])->name('createRole');
    Route::post('/storeRole', [App\Http\Controllers\AdminController::class, 'storeRole'])->name('storeRole');
    Route::get('/roles-edit/{id}', [App\Http\Controllers\AdminController::class, 'editRoleView'])->name('roles.editView');
    Route::patch('/roles-edit/{id}', [App\Http\Controllers\AdminController::class, 'editRole'])->name('roles.edit');
    Route::put('/roles-activate/{id}', [App\Http\Controllers\AdminController::class, 'activateRole'])->name('roles.activate');
    Route::delete('/roles-disable/{id}', [App\Http\Controllers\AdminController::class, 'destroyRole'])->name('roles.disable');
    Route::delete('/roles-delete/{id}/{guard_name}', [App\Http\Controllers\AdminController::class, 'forceDestroyRole'])->name('roles.forceDestroy');
});
