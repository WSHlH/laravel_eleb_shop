<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'phone', 'password','remember_token','business_lists_id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
