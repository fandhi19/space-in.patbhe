<?php

namespace App\Models;

use App\Models\PeminjamanBarang;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
    ];

    // Relasi ke peminjaman barang
    public function peminjamanBarang()
    {
        return $this->hasMany(PeminjamanBarang::class);
    }
}
