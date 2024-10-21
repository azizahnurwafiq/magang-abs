<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pelanggans';
    protected $fillable = [
        'nama',
        'email',
        'no_WA',
        'alamat',
        'note',
    ];

    public function invoice_taxes(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
