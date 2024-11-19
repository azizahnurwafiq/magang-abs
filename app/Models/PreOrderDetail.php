<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pre_order_id',
        'invoice_id',
        'jenis_pekerjaan',
        'deadline',
        'item',
        'quantity',
    ];

    public function preOrder(): BelongsTo
    {
        return $this->belongsTo(PreOrder::class, 'pre_order_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
