<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class PreOrderImage extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'pre_order_id',
        'image',
    ];

    public function preOrder(): BelongsTo
    {
        return $this->belongsTo(PreOrder::class, 'pre_order_id');
    }
}
