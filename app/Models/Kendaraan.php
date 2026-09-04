<?php

namespace App\Models;

use App\Models\PeminjamanKendaraan;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'kode_kendaraan',
        'nama_kendaraan',
        'tipe_kendaraan',
        'kapasitas',
    ];

    public function peminjamanKendaraan()
    {
        return $this->hasMany(PeminjamanKendaraan::class);
    }
}
