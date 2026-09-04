<?php

namespace App\Observers;

use App\Models\PeminjamanBarang;
use Carbon\Carbon;

class PeminjamanBarangObserver
{
    /**
     * Handle the PeminjamanBarang "created" event.
     */
    public function created(PeminjamanBarang $peminjamanBarang): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarang "updated" event.
     */
    public function updated(PeminjamanBarang $peminjamanBarang): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarang "deleted" event.
     */
    public function deleted(PeminjamanBarang $peminjamanBarang): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarang "restored" event.
     */
    public function restored(PeminjamanBarang $peminjamanBarang): void
    {
        //
    }

    /**
     * Handle the PeminjamanBarang "force deleted" event.
     */
    public function forceDeleted(PeminjamanBarang $peminjamanBarang): void
    {
        //
    }

    

    // Method baru untuk mengelola stok saat status berubah
    public function updating(PeminjamanBarang $peminjamanBarang)
    {
        $originalStatus = $peminjamanBarang->getOriginal('status');
        $newStatus = $peminjamanBarang->status;

        if ($originalStatus === 'dikembalikan' || $newStatus === 'dikembalikan') {
            return;
        }

        // Ambil semua detail barang
        $details = $peminjamanBarang->details()->with('barang')->get();

        foreach ($details as $detail) {
            $barang = $detail->barang;
            if (!$barang) continue;

            if ($originalStatus !== 'disetujui' && $newStatus === 'disetujui') {
                $barang->decrement('stok', $detail->jumlah);
            }

            if ($originalStatus === 'disetujui' && $newStatus !== 'disetujui') {
                $barang->increment('stok', $detail->jumlah);
            }
        }
    }

    public function deleting(PeminjamanBarang $peminjamanBarang)
    {
        if ($peminjamanBarang->status === 'disetujui') {
            foreach ($peminjamanBarang->details as $detail) {
                $detail->barang->increment('stok', $detail->jumlah);
            }
        }
    }

    // private function generateKode(PeminjamanBarang $peminjamanBarang): string
    // {
    //     $tanggalMulai = $peminjamanBarang->tanggal_mulai;
    //     $barangId = $peminjamanBarang->barang_id;

    //     if (!$tanggalMulai || !$barangId) {
    //         return 'PB4B-XXXXXXXX-UNKNOWN-000';
    //     }

    //     $tanggal = Carbon::parse((string) $tanggalMulai);
    //     $tanggalStr = $tanggal->format('dmy');

    //     $barang = \App\Models\Barang::find($barangId);
    //     $kodeBarang = $barang ? $barang->kode_barang : 'UNKNOWN';

    //     $prefix = "PB4B-{$tanggalStr}-{$kodeBarang}-";

    //     $last = PeminjamanBarang::where('kode_peminjam', 'like', $prefix . '%')
    //         ->orderBy('kode_peminjam', 'desc')
    //         ->first();

    //     if ($last) {
    //         $lastNumber = (int) substr($last->kode_peminjam, strlen($prefix));
    //         $next = $lastNumber + 1;
    //     } else {
    //         $next = 1;
    //     }

    //     return $prefix . str_pad($next, 3, '0', STR_PAD_LEFT);
    // }

    // public function creating(PeminjamanBarang $peminjamanBarang): void
    // {
    //     if (empty($peminjamanBarang->kode_peminjam)) {
    //         $peminjamanBarang->kode_peminjam = $this->generateKode($peminjamanBarang);
    //     }
    // }

}
