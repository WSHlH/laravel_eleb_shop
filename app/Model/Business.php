<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'phone', 'password','remember_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
