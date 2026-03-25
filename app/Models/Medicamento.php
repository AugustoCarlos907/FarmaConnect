<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicamento extends Model
{
    // use SoftDeletes;
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

    

    protected $with = ['stockItems'];
    
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
