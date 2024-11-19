<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stok_id',
        'jumlah',
        'tanggal_masuk',
        'total_stok',
    ];

    public function stok(): BelongsTo
    {
        return $this->belongsTo(Stok::class, 'stok_id');
    }
}
