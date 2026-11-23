<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alat extends Model
{
    protected $fillable = ['kode', 'nama', 'stok', 'kondisi', 'lokasi'];

    // Tantangan 3: satu alat bisa punya banyak catatan peminjaman
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }
}
