<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_lesson extends Model
{
    use HasFactory;

    protected $table = 'users_lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'lessons_id',
        'users_courses_id',
        'read',
    ];
}
