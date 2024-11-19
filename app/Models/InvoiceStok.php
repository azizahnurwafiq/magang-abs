<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class InvoiceStok extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'invoice_id',
        'stok_id',
        'harga',
        'jumlah',
        'total',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(Stok::class, 'stok_id');
    }
}
