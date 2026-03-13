<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardType extends Model
{
    use HasFactory;

    protected $table = 'credit_card_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'type',
    ];

    public function billingInformation()
    {
        return $this->hasMany(BillingInformation::class);
    }
}
