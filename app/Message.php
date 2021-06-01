<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;
class Message extends Model
{

protected $fillable = [

        'user_id', 'sale_id', 'message_id','title', 'priority', 'message', 'status'
        
    ];

    public function sale()
    {
    	return $this->belongsTo(Sale::class, 'sale_id');
    }

}