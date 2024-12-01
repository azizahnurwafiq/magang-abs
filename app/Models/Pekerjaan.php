<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Pekerjaan extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    protected $fillable = [
        'jenis_pekerjaan',
    ];

    public function preOrders(): BelongsToMany
    {
        return $this->belongsToMany(PreOrder::class, 'pre_order_details', 'pekerjaan_id', 'pre_order_id')
            ->withPivot('deadline', 'item', 'quantity', 'total', 'iamge', 'kebutuhan_bahan', 'note')
            ->withTimestamps();
    }

    public function details(): HasMany
    {
        return $this->hasMany(PreOrderDetail::class);
    }
}
