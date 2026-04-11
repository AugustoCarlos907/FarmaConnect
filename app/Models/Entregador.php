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

    protected $table = 'entregadores'; 

    protected $fillable = [
       
        'descricao',
        'status',
        'numero_bi',    
        'matricula_veiculo',
        'foto_perfil',
        'disponivel',
        'latitude',
        'longitude',
        // 'farmacia_id',
        'user_id',

        'num_carta_conducao',
        'validade_carta',
        'seguro_veiculo',
        'total_entregas',
        'avaliacao_media',
        'tipo_veiculo',
    ];

    protected $with = ['user'];
    protected $casts = [
        'validade_carta' => 'date',
        'total_entregas' => 'integer',
        'avaliacao_media' => 'decimal:2',
        'disponivel' => 'boolean',
    ];

    public function getNameAttribute()
    {
        return $this->user?->name;
    }

    public function getEmailAttribute()
    {
        return $this->user?->email;
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function avaliacoes(){
        return $this->hasMany(Avaliacao::class);
    }
    // public function farmacia()
    // {
    //     return $this->belongsTo(Farmacia::class);
    // }

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function atualizarMetricas(): void {
        $this->total_entregas = $this->entregas()->where('status', 'entregue')->count();
        $this->avaliacao_media = $this->avaliacoes()->avg('classificacao') ?? 0;
        $this->save();
    }
}