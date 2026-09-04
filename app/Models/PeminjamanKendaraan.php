<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanKendaraan extends Model
{
    protected $fillable = [
        'kode_peminjam',
        'nama_peminjam',
        'no_hp',
        'kendaraan_id',
        'tujuan',
        'nama_sopir',
        'tanggal_mulai',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'jam_mulai'       => 'datetime:H:i',
        'jam_selesai'     => 'datetime:H:i',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(PengembalianKendaraan::class, 'peminjaman_kendaraan_id');
    }
}
