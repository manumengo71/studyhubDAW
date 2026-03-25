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

    protected $table = 'courses';

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
        'price',
        'validated',
        'courses_categories_id',
    ];

    // ─── Relationships ─────────────────────────────────

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'courses_categories_id');
    }

    /**
     * Alias: mantiene compatibilidad con código existente que usa lesson() en singular.
     */
    public function lesson()
    {
        return $this->lessons();
    }

    /**
     * Relación correcta con nombre en plural.
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'courses_id');
    }

    public function billingHistory()
    {
        return $this->hasMany(BillingHistory::class, 'course_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function userCourseProgresses()
    {
        return $this->hasMany(User_course_progress::class, 'course_id');
    }

    // ─── Query Scopes ──────────────────────────────────

    /**
     * Cursos activos (validados y no eliminados).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at')->where('validated', 1);
    }

    /**
     * Cursos pendientes de validación.
     */
    public function scopePendingValidation($query)
    {
        return $query->where('validated', 0)
            ->whereRaw('deleted_at = updated_at');
    }

    /**
     * Cursos inactivos (validated=1 pero soft-deleted).
     */
    public function scopeInactive($query)
    {
        return $query->where('validated', 1)
            ->whereRaw('deleted_at = updated_at');
    }

    // ─── Accessors ─────────────────────────────────────

    /**
     * Devuelve el precio formateado.
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->price == 0 ? 'Gratis' : number_format($this->price, 2) . '€';
    }
}
