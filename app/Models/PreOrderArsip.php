<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class PreOrderArsip extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'pre_order_id',
        'pekerjaan_id',
        'deadline',
        'item',
        'quantity',
        'total',
        'image',
        'kebutuhan_bahan',
        'status',
        'note',
        'note_produksi',
    ];

    public function preOrder(): BelongsTo
    {
        return $this->belongsTo(PreOrder::class);
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PreOrderImage::class, 'pre_order_id');
    }
}
