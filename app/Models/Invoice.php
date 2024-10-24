<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'invoices';
    protected $fillable = [
        'kode',
        'no_invoice',
        'pelanggan_id',
        'tanggal',
        'alamat',
        'judul',
        'stok_id',
        'harga',
        'jumlah',
        'down_payment',
        'kekurangan_bayar',
        'total_invoice',
        'status',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(Stok::class, 'stok_id');
    }
}
