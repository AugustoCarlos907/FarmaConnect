<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Endereco extends Model
{
    //


    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
