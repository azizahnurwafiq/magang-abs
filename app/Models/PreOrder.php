<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'invoice_id',
        'judul',
        'status',
        'image',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(PreOrderDetail::class);
    }
}
