<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class PreOrderSize extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'pre_order_id',
        'size',
        'jumlah',
        'deskripsi'
    ];

    public function preOrder(): BelongsTo
    {
        return $this->belongsTo(PreOrder::class, 'pre_order_id');
    }
}
