<?php

namespace App;

use App\Commons\APICode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',"phone","company_name", "role_id", "biller_id", "warehouse_id", "is_active", "is_deleted"
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isActive()
    {
        return $this->is_active;
    }

    public function holiday() {
        return $this->hasMany('App\Holiday');
    }

      /**
     * Roll API Key
     */
    public function generateApiToken()
    {
        do {
            $this->api_token = Str::random(60);
        } while ($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }

    public function generateApiToken1()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
}
