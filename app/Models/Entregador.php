<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Entregador extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , MustVerifyEmail ;

    protected $table = 'entregadores'; // Ou o nome real da sua tabela

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
        'farmacia_id',
        'password'
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}