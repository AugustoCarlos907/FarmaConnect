<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregador extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'descricao',
        'status',
        'numero_bi',    
        'matricula_veiculo',
        'foto_perfil',
        'latitude',
        'longitude',
        'farmacia_id'
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }
}