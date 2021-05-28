<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable =[
        "date", "employee_id", "user_id", "customer_id", "duration", "place",
        "hour", "expense", "status", "note", "object", "refund", "transportation"
    ];
}
