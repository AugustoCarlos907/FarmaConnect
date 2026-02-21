<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    //

    public function farmacia(){
        return $this->belongsTo(Farmacia::class);
    }

    public function companhia(){
        return $this->belongsTo(Companhia::class);
    }
}
