<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianBarang extends Model
{
    protected $fillable = [
    'peminjaman_barang_id',
    'barang_detail_id',
    'tanggal_pengembalian',
    'jumlah_kembali',
    'jumlah_hilang',
    'keterangan',
    'catatan',
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'date',
    ];

    public function peminjamanBarang()
    {
        return $this->belongsTo(PeminjamanBarang::class, 'peminjaman_barang_id');
    }

    
}
