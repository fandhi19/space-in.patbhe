<?php

use App\Exports\PeminjamanBarangExport;
use App\Exports\PeminjamanKendaraanExport;
use App\Exports\PeminjamanRuanganExport;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/form-peminjaman-ruangan', [UserController::class, 'formRuangan'])->name('form.peminjaman');
Route::post('/simpan-peminjaman-ruangan', [UserController::class, 'simpanRuangan'])->name('simpan.ruangan');
Route::get('/form-peminjaman-barang', [UserController::class, 'formBarang'])->name('form.barang');
Route::post('/simpan-peminjaman-barang', [UserController::class, 'simpanBarang'])->name('simpan.barang');
Route::get('/tracking', [UserController::class, 'trackingForm'])->name('tracking.form');
Route::post('/tracking/ruangan', [UserController::class, 'trackingRuangan'])->name('tracking.process');
Route::post('/tracking/barang', [UserController::class, 'trackingBarang'])->name('tracking.barang.process');

Route::get('/sukses', [UserController::class, 'sukses'])->name('sukses');

// Ruangan
Route::get('/tracking-ruangan', [UserController::class, 'showTrackingRuangan'])->name('tracking.ruangan.form');
Route::post('/tracking-ruangan', [UserController::class, 'processTrackingRuangan'])->name('tracking.ruangan.process');

// Barang
Route::get('/tracking-barang', [UserController::class, 'showTrackingBarang'])->name('tracking.barang.form');
Route::post('/tracking-barang', [UserController::class, 'processTrackingBarang'])->name('tracking.barang.process');


// Surat Permohonan
Route::get('/surat-ruangan/{kode}', [UserController::class, 'unduhSuratRuangan'])->name('surat.ruangan');
Route::get('/surat-barang/{kode}', [UserController::class, 'unduhSuratBarang'])->name('surat.barang');

Route::get('/test-email', function () {
    Mail::raw('Test email dari SPACE-IN via SMTP', function ($msg) {
        $msg->to('swisco56@gmail.com')
            ->subject('Test SMTP Gmail');
    });

    return 'Email telah dikirim via SMTP. Cek inbox atau spam.';
});

Route::get('/developer', function () {
    return view('developer');
})->name('developer');

// Form & simpan peminjaman kendaraan
Route::get('/form-kendaraan', [UserController::class, 'formKendaraan'])->name('form.kendaraan');
Route::post('/simpan-kendaraan', [UserController::class, 'simpanKendaraan'])->name('simpan.kendaraan');

// Tracking kendaraan
Route::get('/tracking-kendaraan', [UserController::class, 'showTrackingKendaraan'])->name('tracking.kendaraan.form');
Route::post('/tracking-kendaraan', [UserController::class, 'processTrackingKendaraan'])->name('tracking.kendaraan.process');

// Unduh surat kendaraan (opsional, kalau sudah siap)
Route::get('/surat-kendaraan/{kode}', [UserController::class, 'unduhSuratKendaraan'])->name('surat.kendaraan');

// Export Data Peminjaman Ruangan
Route::get('/export/peminjaman-ruangan', function () {
    return Excel::download(new PeminjamanRuanganExport, 'peminjaman-ruangan.xlsx');
})->name('export.peminjaman-ruangan');

// Export Data Peminjaman Barang
Route::get('/export/peminjaman-barang', function () {
    return Excel::download(new PeminjamanBarangExport, 'peminjaman-barang.xlsx');
})->name('export.peminjaman-barang');

// Export Data Peminjaman Kendaraan
Route::get('/export/peminjaman-kendaraan', function () {
    return Excel::download(new PeminjamanKendaraanExport, 'peminjaman-kendaraan.xlsx');
})->name('export.peminjaman-kendaraan');

// Kalender Peminjaman
Route::get('/kalender-events', [UserController::class, 'getCalendarEvents'])->name('kalender.events');