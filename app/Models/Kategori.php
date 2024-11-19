<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Kategori extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    protected $fillable = [
        'kategori',
    ];

    public function stoks(): HasMany
    {
        return $this->hasMany(Stok::class);
    }
}
