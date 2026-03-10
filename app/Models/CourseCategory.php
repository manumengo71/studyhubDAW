<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CourseCategory extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $table = 'courses_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'courses_categories_id');
    }
}
