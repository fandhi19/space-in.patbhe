<?php

namespace App\Exports;

use App\Models\PeminjamanBarang;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanBarangExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Enumerable
    {
        return PeminjamanBarang::with('details.barang')->get();
    }

    public function headings(): array
    {
        return [
            'Kode Peminjaman',
            'Nama Peminjam',
            'NIP/NISN',
            'Jabatan/Kelas',
            'Unit/Organisasi',
            'No HP',
            'Kegiatan',
            'Tujuan',
            'Daftar Barang',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Jam Mulai',
            'Jam Selesai',
            'Status',
        ];
    }

    public function map($peminjaman): array
    {
        $barangList = $peminjaman->details->map(function ($d) {
            return $d->barang->nama_barang . ' (' . $d->jumlah . ')';
        })->join(', ');

        return [
            $peminjaman->kode_peminjam,
            $peminjaman->nama_peminjam,
            $peminjaman->nip_nisn,
            $peminjaman->jabatan_kelas,
            $peminjaman->unit_organisasi,
            $peminjaman->no_hp,
            $peminjaman->kegiatan,
            $peminjaman->tujuan,
            $barangList,
            $peminjaman->tanggal_mulai->format('d/m/Y'),
            $peminjaman->tanggal_selesai->format('d/m/Y'),
            $peminjaman->jam_mulai,
            $peminjaman->jam_selesai,
            ucfirst($peminjaman->status),
        ];
    }
}