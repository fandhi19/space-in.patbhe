<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanBarangDetail extends Model
{
    protected $fillable = ['peminjaman_barang_id', 'barang_id', 'jumlah'];

    public function peminjamanBarang()
    {
        return $this->belongsTo(PeminjamanBarang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
