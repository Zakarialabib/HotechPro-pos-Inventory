<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

protected $fillable = [

        "reference_no", "sale_id", "user_id", "biller_id", "file", "status", "message"

    ];

    public function sale()
    {
    	return $this->belongsTo("App\Sale");
    }

    public function biller()
    {
    	return $this->belongsTo("App\Biller");
    }

    public function user()
    {
    	return $this->belongsTo("App\User");
    }

}