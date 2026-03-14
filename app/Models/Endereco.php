<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Endereco extends Model
{ 
    // protected $table = ['enderecos'];
    protected $fillable = [
        'user_id',
        'name',
        'endereco',
        'latitude',
        'longitude'
    ];


    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
