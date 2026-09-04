<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianKendaraan extends Model
{
    protected $fillable = [
        'peminjaman_kendaraan_id',
        'tanggal_pengembalian',
        'kondisi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'date',
    ];

    public function peminjamanKendaraan()
    {
        return $this->belongsTo(PeminjamanKendaraan::class, 'peminjaman_kendaraan_id');
    }
}
