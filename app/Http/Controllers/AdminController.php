<?php

namespace App\Http\Controllers;

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

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = CourseCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('listCategories')->with('success', 'Categoría creada correctamente');
    }

    public function createRole(): View
    {
        return view('admin.createRole');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name'),
        ]);

        return redirect()->route('listRoles')->with('success', 'Rol creado correctamente');
    }
}
