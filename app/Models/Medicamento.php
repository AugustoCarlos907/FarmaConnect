<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'name',
        'descricao',
        'preco',
        'forma_farmaceutica',
        'dosagem',
        'categoria_id'
        // 'farmacia_id',
        // 'principio_ativo',
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
