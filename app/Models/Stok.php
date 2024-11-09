<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stoks';
    protected $fillable = [
        'SKU',
        'kategori_id',
        'item',
        'warna',
        'jumlah',
        'tanggal_masuk',
        'harga_beli',
        'harga_jual',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_stoks');
    }
}
