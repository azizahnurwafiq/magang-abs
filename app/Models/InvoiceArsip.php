<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class InvoiceArsip extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'kode',
        'no_invoice',
        'pelanggan_id',
        'tanggal',
        'alamat',
        'judul',
        'down_payment',
        'kekurangan_bayar',
        'total_invoice',
        'status',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
