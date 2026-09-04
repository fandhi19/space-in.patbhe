<?php

namespace App\Observers;

use App\Models\PeminjamanRuangan;
use Carbon\Carbon;

class PeminjamanRuanganObserver
{
    /**
     * Handle the PeminjamanRuangan "created" event.
     */
    public function created(PeminjamanRuangan $peminjamanRuangan): void
    {
        //
    }

    /**
     * Handle the PeminjamanRuangan "updated" event.
     */
    public function updated(PeminjamanRuangan $peminjamanRuangan): void
    {
        //
    }

    /**
     * Handle the PeminjamanRuangan "deleted" event.
     */
    public function deleted(PeminjamanRuangan $peminjamanRuangan): void
    {
        //
    }

    /**
     * Handle the PeminjamanRuangan "restored" event.
     */
    public function restored(PeminjamanRuangan $peminjamanRuangan): void
    {
        //
    }

    /**
     * Handle the PeminjamanRuangan "force deleted" event.
     */
    public function forceDeleted(PeminjamanRuangan $peminjamanRuangan): void
    {
        //
    }

    public function creating(PeminjamanRuangan $peminjamanRuangan): void
    {
        // Hanya generate jika kode_peminjam masih kosong
        if (empty($peminjamanRuangan->kode_peminjam)) {
            $peminjamanRuangan->kode_peminjam = $this->generateKodePeminjam($peminjamanRuangan);
        }
    }

    private function generateKodePeminjam(PeminjamanRuangan $peminjamanRuangan): string
    {
        $tanggalMulai = $peminjamanRuangan->tanggal_mulai;
        $ruanganId = $peminjamanRuangan->ruangan_id;

        // Pastikan tanggal dan ruangan ada
        if (!$tanggalMulai || !$ruanganId) {
            // Fallback jika tidak lengkap, bisa dilempar exception atau return default
            return 'PR4B-XXXXXXXX-UNKNOWN-000';
        }

        // Support various types (string, int, DateTimeInterface, Carbon, or DB date)
        if ($tanggalMulai instanceof \DateTimeInterface) {
            $tanggal = Carbon::instance($tanggalMulai);
        } else {
            $tanggal = Carbon::parse((string) $tanggalMulai);
        }
        $tanggalStr = $tanggal->format('dmy');

        $ruangan = \App\Models\Ruangan::find($ruanganId);
        $kodeRuangan = $ruangan ? $ruangan->kode_ruangan : 'UNKNOWN';

        $prefix = "PR4B-{$tanggalStr}-{$kodeRuangan}-";

        // Cari nomor urut terakhir dengan prefix tersebut
        $last = PeminjamanRuangan::where('kode_peminjam', 'like', $prefix . '%')
            ->orderBy('kode_peminjam', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_peminjam, strlen($prefix));
            $next = $lastNumber + 1;
        } else {
            $next = 1;
        }

        return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
