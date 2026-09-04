<?php

namespace App\Observers;

use App\Models\PeminjamanBarang;
use App\Models\PeminjamanBarangDetail;
use Carbon\Carbon;

class PeminjamanBarangDetailObserver
{
    /**
     * Handle the PeminjamanBarangDetail "created" event.
     */

    /**
     * Handle the PeminjamanBarangDetail "updated" event.
     */
    public function updated(PeminjamanBarangDetail $peminjamanBarangDetail): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarangDetail "deleted" event.
     */
    public function deleted(PeminjamanBarangDetail $peminjamanBarangDetail): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarangDetail "restored" event.
     */
    public function restored(PeminjamanBarangDetail $peminjamanBarangDetail): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarangDetail "force deleted" event.
     */
    public function forceDeleted(PeminjamanBarangDetail $peminjamanBarangDetail): void
    {
        //
    }

    public function created(PeminjamanBarangDetail $detail): void
    {
        $peminjaman = $detail->peminjamanBarang;

        if (!$peminjaman->kode_peminjam || str_contains($peminjaman->kode_peminjam, 'UNKNOWN')) {
            if ($peminjaman->details()->count() === 1) {
                $this->generateKodePeminjaman($peminjaman, $detail);
            }
        }
    }

    private function generateKodePeminjaman(PeminjamanBarang $peminjaman, PeminjamanBarangDetail $detail): void
    {
        $barang = $detail->barang;
        if (!$barang) return;

        $tanggalMulai = $peminjaman->tanggal_mulai;
        if (!$tanggalMulai) return;

        $tanggalMulai = $tanggalMulai instanceof \DateTimeInterface
            ? $tanggalMulai->format('Y-m-d')
            : (string) $tanggalMulai;

        $tanggalStr = Carbon::parse($tanggalMulai)->format('dmy');
        $kodeBarang = $barang->kode_barang ?? 'UNKNOWN';
        $prefix = "PB4B-{$tanggalStr}-{$kodeBarang}-";

        $last = PeminjamanBarang::where('kode_peminjam', 'like', $prefix . '%')
            ->orderBy('kode_peminjam', 'desc')
            ->first();

        $nextNumber = $last ? ((int) substr($last->kode_peminjam, strlen($prefix))) + 1 : 1;
        $kode = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Update kode tanpa memicu event updating
        $peminjaman->updateQuietly(['kode_peminjam' => $kode]);
    }
}
