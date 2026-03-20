<?php

namespace App\Http\Controllers\api\Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function coursesCreated($id)
    {
        $courses = Course::withTrashed()->where('owner_id', $id)->get();

        return $courses;
    }

    public function coursesPurchased($id)
    {
        $courses = Course::withTrashed()
            ->join('users_courses', 'courses.id', '=', 'users_courses.courses_id')
            ->where('users_courses.users_id', $id)
            ->select('courses.*')
            ->get();

        return $courses;
    }
}
