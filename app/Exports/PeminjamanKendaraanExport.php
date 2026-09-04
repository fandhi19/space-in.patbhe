<?php

namespace App\Exports;

use App\Models\PeminjamanKendaraan;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanKendaraanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil data peminjaman kendaraan beserta relasi kendaraan
     */
    public function collection(): Enumerable
    {
        return PeminjamanKendaraan::with('kendaraan')->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'Kode Peminjaman',
            'Nama Peminjam',
            'No HP',
            'Kendaraan',
            'Tipe Kendaraan',
            'Tujuan',
            'Nama Sopir',
            'Hari/Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Status',
        ];
    }

    /**
     * Mapping data per baris
     */
    public function map($peminjaman): array
    {
        return [
            $peminjaman->kode_peminjam,
            $peminjaman->nama_peminjam,
            $peminjaman->no_hp ?? '-',
            $peminjaman->kendaraan->nama_kendaraan ?? '-',
            $peminjaman->kendaraan->tipe_kendaraan ?? '-',
            $peminjaman->tujuan,
            $peminjaman->nama_sopir,
            $peminjaman->tanggal_mulai->format('d/m/Y'),
            $peminjaman->jam_mulai,
            $peminjaman->jam_selesai,
            ucfirst($peminjaman->status),
        ];
    }
}