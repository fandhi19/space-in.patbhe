<?php

namespace App\Observers;

use App\Models\PeminjamanKendaraan;
use Carbon\Carbon;

class PeminjamanKendaraanObserver
{
    public function creating(PeminjamanKendaraan $peminjamanKendaraan): void
    {
        if (empty($peminjamanKendaraan->kode_peminjam)) {
            $peminjamanKendaraan->kode_peminjam = $this->generateKode($peminjamanKendaraan);
        }
    }

    private function generateKode(PeminjamanKendaraan $peminjamanKendaraan): string
    {
        $tanggalMulai = $peminjamanKendaraan->tanggal_mulai;
        $kendaraanId = $peminjamanKendaraan->kendaraan_id;

        if (!$tanggalMulai || !$kendaraanId) {
            return 'PK-XXXXXXXX-UNKNOWN-000';
        }

        $tanggalStr = Carbon::parse($tanggalMulai)->format('dmy');
        $kendaraan = \App\Models\Kendaraan::find($kendaraanId);
        $kodeKendaraan = $kendaraan ? $kendaraan->kode_kendaraan : 'UNKNOWN';
        $prefix = "PK-{$tanggalStr}-{$kodeKendaraan}-";

        $last = PeminjamanKendaraan::where('kode_peminjam', 'like', $prefix . '%')
            ->orderBy('kode_peminjam', 'desc')
            ->first();

        $nextNumber = $last ? ((int) substr($last->kode_peminjam, strlen($prefix))) + 1 : 1;
        return $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
