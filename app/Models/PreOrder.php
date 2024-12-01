<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class PreOrder extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'invoice_id',
        'nama_pelanggan',
        'judul_artikel',
        'bahan',
        'warna',
        'model',
        'tanggal',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(PreOrderDetail::class);
    }

    public function pekerjaans(): BelongsToMany
    {
        return $this->belongsToMany(Pekerjaan::class, 'pre_order_details', 'pre_order_id', 'pekerjaan_id')
            ->withPivot('deadline', 'item', 'quantity', 'total', 'iamge', 'kebutuhan_bahan', 'note')
            ->withTimestamps();
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(PreOrderSize::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PreOrderImage::class);
    }
}
