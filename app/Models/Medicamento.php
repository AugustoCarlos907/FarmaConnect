<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'name',
        'descricao',
        'preco',
        // 'principio_ativo',
        'forma_farmaceutica',
        'dosagem',
        // 'farmacia_id',
        'categoria_id'
    ];


    public function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // public function farmacia(){
    //     return $this->belongsTo(Farmacia::class);
    // }
    
}
