<?php

namespace App\Exports;

use App\Models\PeminjamanRuangan;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanRuanganExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Ambil data yang akan diexport
     */
    public function collection(): Enumerable
    {
        return PeminjamanRuangan::with('ruangan')->get();
    }

    /**
     * Header kolom Excel
     */
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
            'Ruangan',
            'Jumlah Peserta',
            'Tanggal Mulai',
            'Tanggal Selesai',
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
            $peminjaman->nip_nisn,
            $peminjaman->jabatan_kelas,
            $peminjaman->unit_organisasi,
            $peminjaman->no_hp,
            $peminjaman->kegiatan,
            $peminjaman->tujuan,
            $peminjaman->ruangan->nama_ruangan ?? '-',
            $peminjaman->jumlah_peserta,
            $peminjaman->tanggal_mulai->format('d/m/Y'),
            $peminjaman->tanggal_selesai->format('d/m/Y'),
            $peminjaman->jam_mulai,
            $peminjaman->jam_selesai,
            ucfirst($peminjaman->status),
        ];
    }
}