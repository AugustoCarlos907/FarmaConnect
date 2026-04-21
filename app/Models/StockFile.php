<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockFile extends Model
{
    use SoftDeletes;
    protected $table = 'stock_files';
    protected $fillable = [
        'farmacia_id',
        'filename',
        'file_path',
        'status',
        'tipo'
    ];

    public function farmacia(): BelongsTo{
        return $this->belongsTo(Farmacia::class);
    }
}
