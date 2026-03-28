<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    protected $fillable = [
        'user_id',
        'pedido_id',
        'pagamento_id',
        'numero_factura',
        'valor_total',
        'iva',
        'status',
        'emitida_em',
        'pdf_path'
    ];



    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
