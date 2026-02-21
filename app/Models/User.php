<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , MustVerifyEmail ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'phone',
        'endereco',
        'data_nascimento',
        'genero'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
    * @var list<string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function enderecos(){
        return $this->hasMany(Endereco::class);
    }

    public function farmacia(){
        return $this->hasOne(Farmacia::class);
    }
    public function entregador(){
        return $this->hasOne(Entregador::class);
    }

    public function companhia(){
        return $this->hasOne(Companhia::class);
    }
}
