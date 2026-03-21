<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_course_progress extends Model
{
    use HasFactory;

    protected $table = 'user_course_progresses';

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'users_courses_statuses_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function users_courses_status()
    {
        return $this->belongsTo(User_course_status::class);
    }
}
