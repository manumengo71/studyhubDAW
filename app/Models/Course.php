<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $table = 'Courses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'language',
        'owner_id',
        'courses_categories_id',
    ];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'courses_categories_id');
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }
}
