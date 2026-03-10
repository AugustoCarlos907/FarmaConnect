<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = [

        'classificacao',
        'comentario',

        'farmacia_id',
        'user_id'
        
    ];



    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
