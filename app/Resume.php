<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable =[
        "date", "object", "customer_id", "user_id", "employee_id", "action", "note", "file"
    ];
}
