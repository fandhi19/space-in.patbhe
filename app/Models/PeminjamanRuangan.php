<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    // protected $table = 'peminjaman_ruangan';

    protected $fillable = [
        'kode_peminjam',
        'nama_peminjam',
        'nip_nisn',
        'jabatan_kelas',
        'unit_organisasi',
        'no_hp',
        'kegiatan',
        'tujuan',
        'ruangan_id',
        'jumlah_peserta',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai'  => 'date',
        'tanggal_selesai'=> 'date',
        'jam_mulai'      => 'datetime:H:i',
        'jam_selesai'    => 'datetime:H:i',
    ];

    // Relasi ke Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
