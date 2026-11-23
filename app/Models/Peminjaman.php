<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    // nama tabel ditulis eksplisit karena Laravel akan menebak peminjamen
    protected $table = 'peminjaman';

    protected $fillable = ['alat_id', 'nama_peminjam', 'jumlah', 'tanggal_pinjam', 'tanggal_kembali'];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam'  => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    // Tantangan 3: setiap peminjaman dimiliki satu alat
    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class);
    }
}
