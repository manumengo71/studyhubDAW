<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingHistory extends Model
{
    use HasFactory;

    protected $table = 'billing_history';
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function billing()
    {
        return $this->belongsTo(BillingInformation::class, 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id');
    }
}
