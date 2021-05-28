<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable =[

        "site_title", "site_logo", "currency", "vat_number" , "email" , "phone_number", "currency_position", "staff_access", "date_format", "theme", "invoice_format", "state"
    ];
}
