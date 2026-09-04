<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    protected $fillable = [
        'kode_peminjam',
        'nama_peminjam',
        'nip_nisn',
        'jabatan_kelas',
        'unit_organisasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'kegiatan',
        'tujuan',
        'no_hp',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai'  => 'date',
        'tanggal_selesai'=> 'date',
        'jam_mulai'      => 'datetime:H:i',
        'jam_selesai'    => 'datetime:H:i',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // app/Models/PeminjamanBarang.php
    public function pengembalians()
    {
        return $this->hasMany(PengembalianBarang::class, 'peminjaman_barang_id');
    }

    // Relasi ke tabel detail (multi-barang)
    public function details()
    {
        return $this->hasMany(PeminjamanBarangDetail::class);
    }

    // Relasi many-to-many melalui detail (untuk akses langsung)
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'peminjaman_barang_details', 'peminjaman_barang_id', 'barang_id')
                    ->withPivot('jumlah');
    }

    // Relasi pengembalian
    public function pengembalian()
    {
        return $this->hasOne(PengembalianBarang::class, 'peminjaman_barang_id');
    }
}