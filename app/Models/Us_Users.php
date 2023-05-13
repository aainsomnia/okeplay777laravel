<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Us_Users extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'us_users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_fname', 'user_email', 'user_password', 'user_created', 'user_updated'
    ];

    protected $hidden = ['user_password'];
    
    public $timestamps = false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }
}
