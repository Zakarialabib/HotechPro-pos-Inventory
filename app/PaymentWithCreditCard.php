<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentWithCreditCard extends Model
{
    protected $table = 'payment_with_credit_card';

    protected $fillable =[

        "payment_id", "user_id", "user_stripe_id", "charge_id"
    ];
}
