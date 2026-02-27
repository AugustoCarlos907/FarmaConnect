<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransacoesBancaria extends Model
{
    protected $fillable = [
        'pedido_id',
        'banco_origem',
        'banco_destino',
        'valor',
        'data_transacao',
    ];


    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }
}
