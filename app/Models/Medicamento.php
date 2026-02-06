<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'name',
        'descricao',
        'principio_ativo',
        'forma_farmaceutica',
        'dosagem',
        'farmacia_id',
    ];


}
