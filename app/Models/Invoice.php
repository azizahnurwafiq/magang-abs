<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    protected $table = 'invoices';
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

    public function stoks(): BelongsToMany
    {
        return $this->belongsToMany(Stok::class, 'invoice_stoks');
    }

    public function invoice_stoks(): HasMany
    {
        return $this->hasMany(InvoiceStok::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(InvoicePayment::class);
    }

    public function preOrders(): HasMany
    {
        return $this->hasMany(PreOrder::class, 'invoice_id', 'id');
    }

    public function preOrderDetails(): HasMany
    {
        return $this->hasMany(PreOrderDetail::class);
    }
}
