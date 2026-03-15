<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingInformation extends Model
{
    use HasFactory;

    protected $table = 'billing_information';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'user_id',
        'owner_name',
        'owner_surname',
        'owner_second_surname',
        'credit_card_number',
        'expiration_date',
        'cvv',
        'type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creditCardType()
    {
        return $this->belongsTo(CreditCardType::class, 'id');
    }

    public function billingHistory()
    {
        return $this->hasMany(BillingHistory::class, 'billing_id');
    }
}
