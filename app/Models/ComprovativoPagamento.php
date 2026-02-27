<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprovativoPagamento extends Model
{
    protected $fillable = [
        'pagamento_id',
        'hash_arquivo',
        'status_validacao',
        'arquivo_path',
        'dados_extraidos'
    ];

    public function pagamento()
    {
        return $this->belongsTo(Pagamento::class);
    }

}
