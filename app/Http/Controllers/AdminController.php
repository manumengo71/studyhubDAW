<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminController\StoreCategoryRequest;
use App\Http\Requests\AdminController\StoreRoleRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use App\Models\userProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function listUsers()
    {
        $users = User::withTrashed()->paginate(5);

        return view('admin.listado-usuario', compact('users'));
    }

    public function listCourses()
    {
        $courses = Course::withTrashed()->paginate(5);
        return view('admin.listado-cursos', compact('courses'));
    }

    public function listCategories()
    {
        $categories = CourseCategory::withTrashed()->paginate(5);
        return view('admin.listado-categorias', compact('categories'));
    }

    public function listRoles()
    {
        $roles = Role::all();
        return view('admin.roles', compact('roles'));
    }

    public function createCategory(): View
    {
        return view('admin.createCategory');
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $request->safe();

        // Se valida los datos en el request.

        // Se crea la categoría
        $category = CourseCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Se devuelve a listCategories con mensaje de éxito.
        return redirect()->route('listCategories')->with('success', 'Categoría creada correctamente');
    }

    public function createRole(): View
    {
        return view('admin.createRole');
    }

    public function storeRole(StoreRoleRequest $request)
    {
        $request->safe();

        // Se valida los datos en el request.

        // Se crea el rol
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        // Devolver a listRoles con mensaje de éxito.
        return redirect()->route('listRoles')->with('success', 'Rol creado correctamente');
    }
}
