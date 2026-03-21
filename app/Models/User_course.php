<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_course extends Model
{
    use HasFactory;

    protected $table = 'users_courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'courses_id',
        'user_course_progresses_id',
    ];

    public function userCourseProgresses()
    {
        return $this->hasMany(User_course_progress::class, 'course_id', 'courses_id');
    }
}
