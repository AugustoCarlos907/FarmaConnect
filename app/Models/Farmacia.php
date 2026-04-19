<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Farmacia  extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , MustVerifyEmail ;

    protected $table = 'farmacias';
    protected $fillable = [
        'name',
        'logo',
        // 'email',
        // 'telefone',
        'descricao',
        'status',
        'endereco',
        'latitude',
        'longitude',
        'iban',
        'numero_express',
        'alvara',
        'nif',
        'companhia_id',
        'rua',
        'bairro',
        'municipio',
        'horario_abertura',
        'horario_fechamento'
        // 'password'
    ];

    // public function medicamentos()
    // {
    //     return $this->hasMany(Medicamento::class);
    // }



    public function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }

    public function avaliacoes() {
        return $this->hasMany(Avaliacao::class);
    }

    public function relatorios (){
        return $this->hasMany(Relatorio::class);
    }

    // public function entregadores()
    // {
    //     return $this->hasMany(Entregador::class);
    // }

    // public function pedidos() {
    //      return $this->hasMany(Pedido::class);
    // }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'farmacia_pedido')
                    ->withPivot('status')
                    ->withTimestamps();
    }
    
    // Itens da farmácia 
    public function itensPedido()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function stock_files() {
        return $this->hasMany(StockFile::class);
    }

    public function users(){
        return $this->hasOne(User::class  );
    }

    public function companhia(){
        return $this->belongsTo(Companhia::class);
    }

    public function telefones(){
        return $this->hasMany(Telefone::class);
    }
}
