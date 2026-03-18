<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Rutas organizadas por secciones:
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
    Route::delete('/userprofile', [ProfileController::class, 'forceDelete'])->name('userprofile.destroy');
});

/** RUTAS DE MARKETPLACE */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/marketplace', function () {
        $input = [];
        $courses = Course::latest()->take(11)->get();
        $languages = Course::distinct()->pluck('language');
        $temas = CourseCategory::all();
        $categoriasPopulares = CourseCategory::select('courses_categories.*')
            ->selectSub(function ($query) {
                $query->selectRaw('count(*)')
                    ->from('courses')
                    ->whereColumn('courses.courses_categories_id', 'courses_categories.id');
            }, 'courses_count')
            ->orderByDesc('courses_count')
            ->take(7)
            ->get();
        return view('courses.marketplace-principal', compact('courses', 'temas', 'categoriasPopulares', 'languages', 'input'));
    })->name('marketplace');

    Route::get('/marketplace/allcoursesAndCategories', [App\Http\Controllers\MarketplaceController::class, 'createAllCoursesAndCategories'])->name('marketplace.allCoursesAndCategories');
    Route::get('/marketplace/busqueda', [App\Http\Controllers\MarketplaceController::class, 'search'])->name('marketplace.search');
    Route::post('/marketplace/comprarCurso/{id}', [App\Http\Controllers\MarketplaceController::class, 'comprarCurso'])->name('marketplace.comprarCurso');
    Route::get('/marketplace/cursosPorCategoria/{id}', [App\Http\Controllers\MarketplaceController::class, 'cursosPorCategoria'])->name('marketplace.cursosPorCategoria');
});

/** RUTAS DE SHOPPING */
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/billinginfo', function () {
    //     $coursesHistory = "p";
    //     return view('shopping.billinginfo', compact('coursesHistory'));
    // })->name('billinginfo');

    Route::get('/billinginfo', [App\Http\Controllers\BillingInformationController::class, 'getInfo'])->name('billinginfo');

    Route::post('storeCreditCard', [App\Http\Controllers\BillingInformationController::class, 'storeCreditCard'])->name('storeCreditCard');

    Route::get('/billingpdf/{id}', [App\Http\Controllers\BillingInformationController::class, 'downloadPdf'])->name('downloadPdf');
});

/** RUTAS DE COURSES */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('mycourses');
    Route::put('/courses-activate/{id}', [App\Http\Controllers\CourseController::class, 'activate'])->name('mycourses.activate');
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('mycourses.destroy');
    Route::get('/createCourse', [App\Http\Controllers\CourseController::class, 'create'])->name('mycourses.createCourse');
    Route::post('/createCourse', [App\Http\Controllers\CourseController::class, 'store'])->name('mycourses.storeCourse');
    Route::get('/course-detail/{id}', [App\Http\Controllers\CourseController::class, 'createDetail'])->name('mycourses.createDetail');
    Route::get('/editCourse/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->name('mycourses.editCourse');
    Route::patch('/updateCourse/{id}', [App\Http\Controllers\CourseController::class, 'update'])->name('mycourses.updateCourse');
    Route::get('/course-play/{id}/{idlesson?}', [App\Http\Controllers\CourseController::class, 'createPlay'])->name('mycourses.createPlay');
});

/** RUTAS PARA LECCIONES */
Route::get('/createLesson/{id}', [App\Http\Controllers\LessonController::class, 'createLesson'])->name('createLesson');
Route::post('/storeLesson/{id}', [App\Http\Controllers\LessonController::class, 'storeLesson'])->name('storeLesson');

require __DIR__ . '/auth.php';

/** RUTAS DE ADMIN */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');


        /** RUTAS PARA CATEGORIES */
        Route::get('/categories', [App\Http\Controllers\AdminController::class, 'listCategories'])->name('listCategories');
        Route::get('/categories/busqueda', [App\Http\Controllers\AdminController::class, 'searchCategories'])->name('categories.search');
        Route::get('/createCourse', [App\Http\Controllers\AdminController::class, 'createCourse'])->name('admin.createCourse');
        Route::post('/storeCourse', [App\Http\Controllers\AdminController::class, 'storeCourse'])->name('admin.storeCourse');

        Route::get('/createCategory', [App\Http\Controllers\AdminController::class, 'createCategory'])->name('createCategory');
        Route::post('/storeCategory', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('storeCategory');
        Route::delete('/categories-disable/{category}', [App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('category.destroy');
        Route::put('/categories-activate/{category}', [App\Http\Controllers\AdminController::class, 'activateCategory'])->name('category.activate');
        Route::delete('/categories-delete/{id}', [App\Http\Controllers\AdminController::class, 'forceDestroyCategory'])->name('category.forceDestroy');
        Route::get('/categories-edit/{category}', [App\Http\Controllers\AdminController::class, 'editCategoryView'])->name('category.editView');
        Route::patch('/categories-edit/{id}', [App\Http\Controllers\AdminController::class, 'editCategory'])->name('category.edit');

        /** RUTAS PARA COURSES */
        Route::get('/courses', [App\Http\Controllers\AdminController::class, 'listCourses'])->name('listCourses');
        Route::get('/courses/busqueda', [App\Http\Controllers\AdminController::class, 'searchCourses'])->name('courses.search');
        Route::put('/activateCourse/{id}', [App\Http\Controllers\AdminController::class, 'activateCourse'])->name('courses.activate');
        Route::delete('/disableCourse/{course}', [App\Http\Controllers\AdminController::class, 'disableCourse'])->name('courses.disable');
        Route::delete('/deleteCourse/{course}', [App\Http\Controllers\AdminController::class, 'deleteCourse'])->name('courses.delete');

        /** RUTAS PARA LECCIONES */
        Route::get('/createLesson/{id}', [App\Http\Controllers\LessonController::class, 'createLesson'])->name('createLesson');
        Route::post('/storeLesson/{id}', [App\Http\Controllers\LessonController::class, 'storeLesson'])->name('storeLesson');
        Route::get('/editLesson/{id}', [App\Http\Controllers\LessonController::class, 'editLesson'])->name('editLesson');
        Route::patch('/updateLesson/{id}', [App\Http\Controllers\LessonController::class, 'updateLesson'])->name('updateLesson');

        /** RUTAS PARA USERS */
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'listUsers'])->name('listUsers');
        Route::get('/users/busqueda', [App\Http\Controllers\AdminController::class, 'searchUsers'])->name('users.search');
        Route::get('/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('createUser');
        Route::post('/storeUser', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('storeUser');
        Route::get('/editUser/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
        Route::patch('/updateUser/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('updateUser');
        Route::put('/activateUser/{id}', [App\Http\Controllers\AdminController::class, 'activateUser'])->name('users.activate');
        Route::delete('/disableUser/{user}', [App\Http\Controllers\AdminController::class, 'disableUser'])->name('users.disable');
        Route::delete('/deleteUser/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');

        /** RUTAS PARA ROLES */
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
});
