<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Pelanggan extends Model
{
    use HasFactory, SoftDeletes, Sortable;
    protected $table = 'pelanggans';
    protected $fillable = [
        'nama',
        'email',
        'no_WA',
        'alamat',
        'note',
    ];

    public $sortable = [
        'nama',
        'email',
        'no_WA',
        'alamat',
        'note',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
