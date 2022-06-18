<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo('App\Models\User','client_id','id');
    }
    public function employe(){
        return $this->belongsTo('App\Models\User','employe_id','id');
    }
    public function voiture(){
        return $this->belongsTo('App\Models\Voiture','voiture_id','id');
    }
    public function paiement(){
        return $this->hasOne('App\Models\Paiement');
    }
}
