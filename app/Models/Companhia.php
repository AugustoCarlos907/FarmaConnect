<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companhia extends Model
{
    //


    public function farmacias (){
        return $this->hasMany(Farmacia::class);
    }

    public function users (){
        return $this->belongsTo(User::class);
    }

    public function telefones(){2
        return $this->hasMany(Telefone::class);
    }
}
