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
        $roles = Role::withTrashed()->paginate(5);
        return view('admin.roles', compact('roles'));
    }
}
