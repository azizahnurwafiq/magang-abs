<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class Stok extends Model
{
    use HasFactory, SoftDeletes, Sortable;
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

    public $sortable = [
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

    public function stokHistories(): HasMany
    {
        return $this->hasMany(StokHistory::class);
    }

    public function invoices(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_stoks');
    }

    public function invoice_stoks(): HasMany
    {
        return $this->hasMany(InvoiceStok::class);
    }
}
