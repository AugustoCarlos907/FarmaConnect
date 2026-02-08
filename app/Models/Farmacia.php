<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'descricao',
        'status',

        'endereco',
        'latitude',
        'longitude'
    ];

    public function stock_item()
    {
        return $this->hasMany(StockItem::class);
    }


    public function entregadores()
    {
        return $this->hasMany(Entregador::class);
    }
}
