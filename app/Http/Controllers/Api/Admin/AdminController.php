<?php

namespace App\Http\Controllers\api\Admin;

use App\Http\Controllers\Controller;

use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function listRoles()
    {
        $roles = Role::all();
        return $roles;
    }


    public function listCategories()
    {
        $categories = CourseCategory::all();
        return $categories;
    }

    public function listCourses()
    {
        $courses = Course::withTrashed()->get();
        return $courses;
    }

    public function listUsers()
    {
        $users = User::withTrashed()
            ->leftJoin('users_profiles', 'users.id', '=', 'users_profiles.user_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users_profiles.*', 'users.*', 'roles.name as role')
            ->get();
        return $users;
    }

    public function storeCategory(Request $request)
    {
        $category = new CourseCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json(['message' => 'Categoria creada correctamente']);
    }

    public function storeCourse(Request $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->short_description = $request->short_description;
        $course->description = $request->description;
        $course->language = $request->language;
        $course->courses_categories_id = $request->courses_categories_id;
        $course->owner_id = $request->owner_id;
        $course->save();
        return response()->json(['message' => 'Curso creado correctamente']);
    }
}
