<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stoks';
    protected $fillable = [
        'SKU',
        'kategori',
        'item',
        'warna',
        'jumlah',
        'tanggal_masuk',
        'harga_beli',
        'harga_jual',
    ];

    public function invoice_taxes(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
