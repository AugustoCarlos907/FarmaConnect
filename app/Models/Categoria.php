<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'name',
        'descricao',
        'imagem',
        // 'stock_items_id',
    ];

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }
}
