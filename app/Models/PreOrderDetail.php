<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class PreOrderDetail extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'pre_order_id',
        'jenis_pekerjaan',
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
}
