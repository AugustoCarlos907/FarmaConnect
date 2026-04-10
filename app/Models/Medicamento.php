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
        'categoria_id',
        'requer_receita'
        // 'principio_ativo',
    ];

    
    protected $casts = [
    'requer_receita' => 'boolean',
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

    //data_fabricacao
    //laboratorio
    //origem (indiano , português)

    
}
