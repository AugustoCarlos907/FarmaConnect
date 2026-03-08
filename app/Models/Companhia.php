<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companhia extends Model
{
    protected $fillable = [
        'nif',
        'logo',

    ];


    public function farmacias (){
        return $this->hasMany(Farmacia::class);
    }

    public function users (){
        return $this->hasMany(User::class);
    }

    public function telefones(){
        return $this->hasMany(Telefone::class);
    }
}
