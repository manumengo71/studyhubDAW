<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class BillingHistory extends Model implements HasMedia
{
    use HasFactory;
    use \Spatie\MediaLibrary\InteractsWithMedia;

    protected $table = 'billing_histories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'buyer_id',
        'billing_id',
        'course_id',
        'purchase_date',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function billing()
    {
        return $this->belongsTo(BillingInformation::class, 'buyer_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
