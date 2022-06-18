<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends  Authenticatable
{
    use HasFactory;
    protected $guarded = [];

    public function reservations(){
        return $this->hasMany('App\Models\Reservation','client_id','id');
    }
}
