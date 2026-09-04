<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kendaraan;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanBarangDetail;
use App\Models\PeminjamanKendaraan;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Landing page
    public function index()
    {
        $ruangans = Ruangan::all();
        $barangs = Barang::all();
        $kendaraans = Kendaraan::all();
        return view('index', compact('ruangans', 'barangs', 'kendaraans'));
    }

    // Form peminjaman ruangan
    public function formRuangan()
    {
        $ruangans = Ruangan::all();
        return view('user.form-ruangan', compact('ruangans'));
    }

    // Simpan peminjaman ruangan
    public function simpanRuangan(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nip_nisn' => 'required|string|max:50',
            'jabatan_kelas' => 'required|string|max:100',
            'unit_organisasi' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'kegiatan' => 'required|string|max:255',
            'tujuan' => 'nullable|string',
            'ruangan_id' => 'required|exists:ruangans,id',
            'jumlah_peserta' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        // Validasi bentrok jadwal
        $start = Carbon::parse($validated['tanggal_mulai'] . ' ' . $validated['jam_mulai']);
        $end = Carbon::parse($validated['tanggal_selesai'] . ' ' . $validated['jam_selesai']);

        $conflict = PeminjamanRuangan::where('ruangan_id', $validated['ruangan_id'])
            ->where('status', '!=', 'ditolak')
            ->where(function ($q) use ($start, $end) {
                $q->whereDate('tanggal_mulai', '<=', $end->toDateString())
                  ->whereDate('tanggal_selesai', '>=', $start->toDateString())
                  ->whereTime('jam_mulai', '<', $end->toTimeString())
                  ->whereTime('jam_selesai', '>', $start->toTimeString());
            })
            ->exists();

        if ($conflict) {
            return back()->withInput()->withErrors(['ruangan_id' => 'Ruangan sudah dipinjam pada rentang waktu tersebut.']);
        }

        $peminjaman = PeminjamanRuangan::create($validated + ['status' => 'pending']);

        // Generate PDF surat permohonan ruangan
        $pdf = Pdf::loadView('user.surat-ruangan', compact('peminjaman'))
                ->setPaper('a4', 'portrait');

        // Kirim email ke admin
        Mail::raw(
            "Halo Admin Sarpras SMAN 4 Yogyakarta,\n\n" .
            "Ada pengajuan peminjaman ruangan baru:\n\n" .
            "🔹 Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
            "🔹 Nama            : {$peminjaman->nama_peminjam}\n" .
            "🔹 Ruangan         : {$peminjaman->ruangan->nama_ruangan}\n" .
            "🔹 Tanggal         : " . Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
            " s/d " . Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .
            "🔹 Jam             : {$peminjaman->jam_mulai} - {$peminjaman->jam_selesai}\n" .
            "🔹 Kegiatan        : {$peminjaman->kegiatan}\n\n" .
            "Silakan cek panel admin untuk menindaklanjuti.\n" .
            "Surat permohonan terlampir dalam PDF.\n\n" .
            "SPACE-IN PATBHE - SMAN 4 Yogyakarta",
            function ($message) use ($peminjaman, $pdf) {
                $message->to('pipitpuspitasari82@guru.sma.belajar.id', 'Admin SARPRAS PATBHE')
                        ->subject('🔔 Pengajuan Peminjaman Ruangan Baru - ' . now()->format('d/m/Y H:i'))
                        ->attachData($pdf->output(), "Surat-Permohonan-Ruangan-{$peminjaman->kode_peminjam}.pdf", [
                            'mime' => 'application/pdf',
                        ]);
            }
        );

        // Kirim notifikasi WhatsApp ke admin melalui Fonnte
        try {
            $pesanWa =
                "🔔 *PENGAJUAN PEMINJAMAN RUANGAN BARU*\n\n" .
                "Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
                "Nama            : {$peminjaman->nama_peminjam}\n" .
                "Ruangan         : {$peminjaman->ruangan->nama_ruangan}\n" .
                "Tanggal         : " .
                Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
                " s/d " .
                Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .
                "Jam             : 
                " . Carbon::parse($peminjaman->jam_mulai)->format('H:i') . 
                " s/d " . 
                Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n" .
                "Kegiatan        : {$peminjaman->kegiatan}\n\n" .
                "Silakan cek panel admin untuk menindaklanjuti pengajuan ini.\n\n" .
                "SPACE-IN PATBHE - SMAN 4 Yogyakarta";

            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => ('6285740584009'),
                'message' => $pesanWa,
            ]);

            if (!$response->successful()) {
                Log::error('Fonnte gagal mengirim WhatsApp', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }

        } 
        
        catch (\Throwable $e) {
            Log::error('Error Fonnte: ' . $e->getMessage());
        }

        // Kirim notifikasi WA ke peminjam
        if ($request->filled('no_hp')) {

            $pesanWa =
                "Halo *{$peminjaman->nama_peminjam}* 👋\n\n" .
                "Pengajuan peminjaman ruangan Anda telah berhasil diterima oleh sistem *SPACE-IN PATBHE*.\n\n" .

                "🔹 *Kode Peminjaman:* {$peminjaman->kode_peminjam}\n" .
                "🔹 *Ruangan:* {$peminjaman->ruangan->nama_ruangan}\n" .
                "🔹 *Tanggal:* " .
                Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
                " s/d " .
                Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .

                "🔹 *Jam:* {$peminjaman->jam_mulai} - {$peminjaman->jam_selesai}\n" .
                "🔹 *Kegiatan:* {$peminjaman->kegiatan}\n\n" .

                "Status pengajuan saat ini: *Menunggu Persetujuan Admin*.\n\n" .

                "Silakan simpan kode peminjaman tersebut untuk melakukan tracking pengajuan Anda.\n\n" .

                "Terima kasih 🙏\n" .
                "*SPACE-IN PATBHE - SMAN 4 Yogyakarta*";

            $this->kirimWa(
                $request->no_hp,
                $pesanWa
            );
        }

        return redirect()->route('sukses', ['kode' => $peminjaman->kode_peminjam, 'jenis' => 'ruangan']);
    }

    private function kirimWa($target, $message)
    {
        $target = preg_replace('/[^0-9]/', '', $target);

        if (str_starts_with($target, '08')) {
            $target = '62' . substr($target, 1);
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => config('fonnte.api_token'),
                ])
                ->post(config('fonnte.api_url'), [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => '62',
                ]);

            Log::info('Fonnte Response', [
                'target' => $target,
                'response' => $response->json(),
            ]);

            return $response->json();

        } catch (\Throwable $e) {

            Log::error('Fonnte Error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'status' => false,
                'reason' => $e->getMessage(),
            ];
        }
    }

    // Form peminjaman barang
    public function formBarang()
    {
        $barangs = Barang::all();
        return view('user.form-barang', compact('barangs'));
    }

    // Simpan peminjaman barang
    public function simpanBarang(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam'   => 'required|string|max:255',
            'nip_nisn'        => 'required|string|max:50',
            'jabatan_kelas'   => 'required|string|max:100',
            'unit_organisasi' => 'required|string|max:100',
            'no_hp'           => 'required|string|max:15',
            'kegiatan'        => 'required|string|max:255',
            'tujuan'          => 'nullable|string',
            'barang_id'       => 'required|array|min:1',
            'barang_id.*'     => 'required|exists:barangs,id',
            'jumlah'          => 'required|array|min:1',
            'jumlah.*'        => 'required|integer|min:1',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required|after:jam_mulai',
        ]);

        $start = Carbon::parse($validated['tanggal_mulai'] . ' ' . $validated['jam_mulai']);
        $end   = Carbon::parse($validated['tanggal_selesai'] . ' ' . $validated['jam_selesai']);

        // Validasi stok per barang
        foreach ($validated['barang_id'] as $index => $barangId) {
            $jumlahDiminta = $validated['jumlah'][$index];
            $barang = Barang::findOrFail($barangId);

            $dipinjam = PeminjamanBarangDetail::where('barang_id', $barangId)
                ->whereHas('peminjamanBarang', function ($query) use ($start, $end) {
                    $query->where('status', '!=', 'ditolak')
                        ->where(function ($q) use ($start, $end) {
                            $q->whereDate('tanggal_mulai', '<=', $end->toDateString())
                                ->whereDate('tanggal_selesai', '>=', $start->toDateString())
                                ->whereTime('jam_mulai', '<', $end->toTimeString())
                                ->whereTime('jam_selesai', '>', $start->toTimeString());
                        });
                })
                ->sum('jumlah');

            $stokTersedia = $barang->stok - $dipinjam;
            if ($jumlahDiminta > $stokTersedia) {
                return back()->withInput()->withErrors([
                    "jumlah.$index" => "Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$stokTersedia}"
                ]);
            }
        }

        // Buat peminjaman header
        $peminjaman = PeminjamanBarang::create([
            'nama_peminjam'   => $validated['nama_peminjam'],
            'nip_nisn'        => $validated['nip_nisn'],
            'jabatan_kelas'   => $validated['jabatan_kelas'],
            'unit_organisasi' => $validated['unit_organisasi'],
            'no_hp'           => $validated['no_hp'],
            'kegiatan'        => $validated['kegiatan'],
            'tujuan'          => $validated['tujuan'] ?? null,
            'tanggal_mulai'   => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jam_mulai'       => $validated['jam_mulai'],
            'jam_selesai'     => $validated['jam_selesai'],
            'status'          => 'pending',
        ]);

        // Simpan detail barang
        foreach ($validated['barang_id'] as $index => $barangId) {
            PeminjamanBarangDetail::create([
                'peminjaman_barang_id' => $peminjaman->id,
                'barang_id'            => $barangId,
                'jumlah'               => $validated['jumlah'][$index],
            ]);
        }

        // Generate kode peminjam (pakai barang pertama)
        $barangPertama = Barang::find($validated['barang_id'][0]);
        $tanggalMulai  = Carbon::parse($validated['tanggal_mulai']);
        $tanggalStr    = $tanggalMulai->format('dmy');
        $kodeBarang    = $barangPertama ? $barangPertama->kode_barang : 'UNKNOWN';
        $prefix        = "PB4B-{$tanggalStr}-{$kodeBarang}-";

        $last = PeminjamanBarang::where('kode_peminjam', 'like', $prefix . '%')
                    ->orderBy('kode_peminjam', 'desc')
                    ->first();
        $nextNumber = $last ? ((int) substr($last->kode_peminjam, strlen($prefix))) + 1 : 1;
        $kodePeminjam = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $peminjaman->update(['kode_peminjam' => $kodePeminjam]);

        // Ringkasan daftar barang
        $barangList = $peminjaman->details->map(function ($detail) {
            return $detail->barang->nama_barang . ' (' . $detail->jumlah . ' unit)';
        })->join(', ');

        // Generate PDF surat permohonan barang
        $pdf = Pdf::loadView('user.surat-barang', compact('peminjaman'))
                ->setPaper('a4', 'portrait');

        // Kirim notifikasi ke admin
        Mail::raw(
            "Halo Admin Sarpras SMAN 4 Yogyakarta,\n\n" .
            "Ada pengajuan peminjaman barang baru:\n\n" .
            "🔹 Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
            "🔹 Nama            : {$peminjaman->nama_peminjam}\n" .
            "🔹 Barang          : {$barangList}\n" .
            "🔹 Tanggal         : " . Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
            " s/d " . Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .
            "🔹 Jam             : " . Carbon::parse($peminjaman->jam_mulai)->format('H:i') .
            " - " . Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n" .
            "🔹 Kegiatan        : {$peminjaman->kegiatan}\n\n" .
            "Silakan cek panel admin untuk menindaklanjuti.\n" .
            "Surat permohonan terlampir dalam PDF.\n\n" .
            "SPACE-IN PATBHE - SMAN 4 Yogyakarta",
            function ($message) use ($peminjaman, $pdf) {
                $message->to('pipitpuspitasari82@guru.sma.belajar.id', 'Admin SARPRAS PATBHE')
                        ->subject('🔔 Pengajuan Peminjaman Barang Baru - ' . now()->format('d/m/Y H:i'))
                        ->attachData($pdf->output(), "Surat-Permohonan-Barang-{$peminjaman->kode_peminjam}.pdf", [
                            'mime' => 'application/pdf',
                        ]);
            }
        );

        // Kirim notifikasi WhatsApp ke admin melalui Fonnte
        try {
            $pesanWa =
                "🔔 *PENGAJUAN PEMINJAMAN BARANG BARU*\n\n" .

                "Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
                "Nama            : {$peminjaman->nama_peminjam}\n" .
                "Barang          : {$barangList}\n" .
                "Tanggal         : " .
                Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
                " s/d " .
                Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .
                "Jam              : " .
                Carbon::parse($peminjaman->jam_mulai)->format('H:i') .
                " s/d " .
                Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n" .
                "Kegiatan        : {$peminjaman->kegiatan}\n\n" .

                "Silakan cek panel admin untuk menindaklanjuti pengajuan ini.\n\n" .

                "SPACE-IN PATBHE - SMAN 4 Yogyakarta";

            $response = Http::withHeaders([
                'Authorization' => config('fonnte.api_token'),
            ])->post(config('fonnte.api_url'), [
                'target' => '6285740584009',
                'message' => $pesanWa,
                'countryCode' => '62',
            ]);

            if (!$response->successful()) {
                Log::error('Fonnte gagal mengirim WhatsApp peminjaman barang', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }

        } catch (\Throwable $e) {

            Log::error('Error Fonnte peminjaman barang', [
                'message' => $e->getMessage(),
            ]);
        }

        // Kirim notifikasi WA ke peminjam
        if ($request->filled('no_hp')) {

            $barangList = $peminjaman->details->map(function ($detail) {
                return $detail->barang->nama_barang .
                    ' (' . $detail->jumlah . ' unit)';
            })->join(', ');

            $pesanWa =
            "Halo *{$peminjaman->nama_peminjam}* 👋\n\n" .
            "Pengajuan peminjaman barang Anda telah berhasil diterima oleh sistem *SPACE-IN PATBHE*.\n\n" .

            "🔹 *Kode Peminjaman:* {$peminjaman->kode_peminjam}\n" .
            "🔹 *Barang:* {$barangList}\n" .
            "🔹 *Tanggal:* " .
            Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') .
            " s/d " .
            Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') . "\n" .
            "🔹 *Jam:* " .
            Carbon::parse($peminjaman->jam_mulai)->format('H:i') .
            " - " .
            Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n" .
            "🔹 *Kegiatan:* {$peminjaman->kegiatan}\n\n" .

            "Status pengajuan saat ini: *Menunggu Persetujuan Admin*.\n\n" .
            "Silakan simpan kode peminjaman tersebut untuk melakukan tracking pengajuan Anda.\n\n" .

            "Terima kasih 🙏\n" .
            "*SPACE-IN PATBHE - SMAN 4 Yogyakarta*";

            $this->kirimWa(
                $request->no_hp,
                $pesanWa
            );
        }

        return redirect()->route('sukses', [
            'kode'  => $peminjaman->kode_peminjam,
            'jenis' => 'barang'
        ]);
    }

    // Halaman sukses
    public function sukses(Request $request)
    {
        $kode = $request->query('kode');
        $jenis = $request->query('jenis');
        return view('user.sukses', compact('kode', 'jenis'));
    }

    // ========== TRACKING RUANGAN ==========
    // Menampilkan halaman tracking ruangan (GET)
    public function showTrackingRuangan(Request $request)
    {
        $kode = $request->query('kode');
        $peminjaman = null;
        $error = null;

        if ($kode) {
            $peminjaman = PeminjamanRuangan::with('ruangan')
                            ->where('kode_peminjam', $kode)
                            ->first();
            if (!$peminjaman) {
                $error = '❌ Kode peminjaman ruangan tidak ditemukan.';
            }
        }

        return view('user.tracking-ruangan', compact('peminjaman', 'kode', 'error'));
    }

    // Proses pencarian dari form di halaman tracking (POST)
    public function processTrackingRuangan(Request $request)
    {
        $request->validate(['kode' => 'required|string']);
        $kode = $request->input('kode');
        return redirect()->route('tracking.ruangan.form', ['kode' => $kode]);
    }

    // ========== TRACKING BARANG ==========
    // Menampilkan halaman tracking barang (GET)
    public function showTrackingBarang(Request $request)
    {
        $kode = $request->query('kode');
        $peminjaman = null;
        $error = null;

        if ($kode) {
            $peminjaman = PeminjamanBarang::with('details.barang')
                            ->where('kode_peminjam', $kode)
                            ->first();
            if (!$peminjaman) {
                $error = '❌ Kode peminjaman barang tidak ditemukan.';
            }
        }

        return view('user.tracking-barang', compact('peminjaman', 'kode', 'error'));
    }

    // Proses pencarian dari form di halaman tracking (POST)
    public function processTrackingBarang(Request $request)
    {
        $request->validate(['kode' => 'required|string']);
        $kode = $request->input('kode');
        return redirect()->route('tracking.barang.form', ['kode' => $kode]);
    }

    // Unduh surat peminjaman ruangan
    public function unduhSuratRuangan($kode)
    {
        $peminjaman = PeminjamanRuangan::with('ruangan')
                        ->where('kode_peminjam', $kode)
                        ->firstOrFail();

        $pdf = Pdf::loadView('user.surat-ruangan', compact('peminjaman'))
                ->setPaper('a4', 'portrait');

        return $pdf->download("Surat-Peminjaman-Ruangan-{$peminjaman->kode_peminjam}.pdf");
    }

    // Unduh surat peminjaman barang
    public function unduhSuratBarang($kode)
    {
        $peminjaman = PeminjamanBarang::with('details.barang')
                        ->where('kode_peminjam', $kode)
                        ->firstOrFail();

        $pdf = Pdf::loadView('user.surat-barang', compact('peminjaman'))
                ->setPaper('a4', 'portrait');

        return $pdf->download("Surat-Peminjaman-Barang-{$peminjaman->kode_peminjam}.pdf");
    }


    // BAGIAN PEMINJAMAN KENDARAN

    public function formKendaraan()
    {
        $kendaraans = Kendaraan::all();
        return view('user.form-kendaraan', compact('kendaraans'));
    }

    //PENGINPUTAN USER
    public function simpanKendaraan(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'kendaraan_id'  => 'required|exists:kendaraans,id',
            'no_hp'           => 'required|string|max:15',
            'tujuan'        => 'required|string|max:255',
            'nama_sopir'    => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required|after:jam_mulai',
        ]);

        // Validasi bentrok jadwal kendaraan (tanggal sama & irisan jam)
        $tanggal = $validated['tanggal_mulai'];
        $start = Carbon::parse($tanggal . ' ' . $validated['jam_mulai']);
        $end   = Carbon::parse($tanggal . ' ' . $validated['jam_selesai']);

        $conflict = PeminjamanKendaraan::where('kendaraan_id', $validated['kendaraan_id'])
            ->where('status', '!=', 'ditolak')
            ->whereDate('tanggal_mulai', $tanggal)
            ->where(function ($q) use ($start, $end) {
                $q->whereTime('jam_mulai', '<', $end->toTimeString())
                ->whereTime('jam_selesai', '>', $start->toTimeString());
            })
            ->exists();

        if ($conflict) {
            return back()->withInput()->withErrors(['kendaraan_id' => 'Kendaraan sudah dipinjam pada tanggal dan jam tersebut.']);
        }

        // Simpan peminjaman (kode otomatis via observer)
        $peminjaman = PeminjamanKendaraan::create($validated + [
            'status' => 'pending',
            'tanggal_selesai' => $tanggal, // tidak perlu, tapi tetap diisi jika kolom masih ada
        ]);

        // Kirim notifikasi email ke admin (opsional)
        try {
            $pdf = Pdf::loadView('user.surat-kendaraan', compact('peminjaman'))
                    ->setPaper('a4', 'portrait');

            Mail::raw(
                "Halo Admin Sarpras SMAN 4 Yogyakarta,\n\n" .
                "Ada pengajuan peminjaman kendaraan baru:\n\n" .
                "🔹 Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
                "🔹 Nama            : {$peminjaman->nama_peminjam}\n" .
                "🔹 Kendaraan       : {$peminjaman->kendaraan->nama_kendaraan} ({$peminjaman->kendaraan->tipe_kendaraan})\n" .
                "🔹 Tujuan          : {$peminjaman->tujuan}\n" .
                "🔹 Tanggal         : " . Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') . "\n" .
                "🔹 Jam             : " . Carbon::parse($peminjaman->jam_mulai)->format('H:i') . " - " . Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n\n" .
                "Silakan cek panel admin untuk menindaklanjuti.\n" .
                "Surat permohonan terlampir dalam PDF.\n\n" .
                "SPACE-IN PATBHE - SMAN 4 Yogyakarta",
                function ($message) use ($peminjaman, $pdf) {
                    $message->to('pipitpuspitasari82@guru.sma.belajar.id', 'Admin SARPRAS PATBHE')
                            ->subject('🔔 Pengajuan Peminjaman Kendaraan Baru - ' . now()->format('d/m/Y H:i'))
                            ->attachData($pdf->output(), "Surat-Permohonan-Kendaraan-{$peminjaman->kode_peminjam}.pdf", [
                                'mime' => 'application/pdf',
                            ]);
                }
            );
        } catch (\Exception $e) {
            // Abaikan error email agar tidak mengganggu proses utama
        }

        // Muat relasi kendaraan agar tersedia
        $peminjaman->load('kendaraan');

        // Kirim notifikasi WhatsApp ke admin
        try {
            $pesanWaAdmin =
                "🔔 *PENGAJUAN PEMINJAMAN KENDARAAN BARU*\n\n" .

                "Kode Peminjaman : {$peminjaman->kode_peminjam}\n" .
                "Nama            : {$peminjaman->nama_peminjam}\n" .
                "No. HP          : {$peminjaman->no_hp}\n" .
                "Kendaraan       : {$peminjaman->kendaraan->nama_kendaraan} ({$peminjaman->kendaraan->tipe_kendaraan})\n" .
                "Tujuan          : {$peminjaman->tujuan}\n" .
                "Nama Sopir      : {$peminjaman->nama_sopir}\n" .
                "Hari/Tanggal    : " . Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') . "\n" .
                "Jam             : " . Carbon::parse($peminjaman->jam_mulai)->format('H:i') . " - " . Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n\n" .

                "Silakan cek panel admin untuk menindaklanjuti pengajuan ini.\n\n" .

                "SPACE-IN PATBHE - SMAN 4 Yogyakarta";

            $this->kirimWa(('6285740584009'), $pesanWaAdmin);
        
            } catch (\Throwable $e) {
            Log::error('Error Fonnte peminjaman kendaraan (admin)', [
                'message' => $e->getMessage(),
            ]);
        }

        // Kirim notifikasi WA ke peminjam
        if ($request->filled('no_hp')) {
            $pesanWaPeminjam =
                "Halo *{$peminjaman->nama_peminjam}* 👋\n\n" .
                "Pengajuan peminjaman kendaraan Anda telah berhasil diterima oleh sistem *SPACE-IN PATBHE*.\n\n" .

                "🔹 *Kode Peminjaman:* {$peminjaman->kode_peminjam}\n" .
                "🔹 *Kendaraan:* {$peminjaman->kendaraan->nama_kendaraan} ({$peminjaman->kendaraan->tipe_kendaraan})\n" .
                "🔹 *Tujuan:* {$peminjaman->tujuan}\n" .
                "🔹 *Nama Sopir:* {$peminjaman->nama_sopir}\n" .
                "🔹 *Tanggal:* " . Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') . "\n" .
                "🔹 *Jam:* " . Carbon::parse($peminjaman->jam_mulai)->format('H:i') . " - " . Carbon::parse($peminjaman->jam_selesai)->format('H:i') . "\n\n" .

                "Status pengajuan saat ini: *Menunggu Persetujuan Admin*.\n\n" .
                "Silakan simpan kode peminjaman tersebut untuk melakukan tracking pengajuan Anda.\n\n" .

                "Terima kasih 🙏\n" .
                "*SPACE-IN PATBHE - SMAN 4 Yogyakarta*";

            $this->kirimWa($request->no_hp, $pesanWaPeminjam);
        }

        return redirect()->route('sukses', ['kode' => $peminjaman->kode_peminjam, 'jenis' => 'kendaraan']);
    }

    //USER TRACKING
    public function showTrackingKendaraan(Request $request)
    {
        $kode = $request->query('kode');
        $peminjaman = null;
        $error = null;

        if ($kode) {
            $peminjaman = PeminjamanKendaraan::with('kendaraan')
                            ->where('kode_peminjam', $kode)
                            ->first();
            if (!$peminjaman) {
                $error = '❌ Kode peminjaman kendaraan tidak ditemukan.';
            }
        }

        return view('user.tracking-kendaraan', compact('peminjaman', 'kode', 'error'));
    }

    public function processTrackingKendaraan(Request $request)
    {
        $request->validate(['kode' => 'required|string']);
        return redirect()->route('tracking.kendaraan.form', ['kode' => $request->kode]);
    }

    //UNDUH SURAT PEMINJAMAN KENDARAAN
    public function unduhSuratKendaraan($kode)
    {
        $peminjaman = PeminjamanKendaraan::with('kendaraan')
                        ->where('kode_peminjam', $kode)
                        ->firstOrFail();

        $pdf = Pdf::loadView('user.surat-kendaraan', compact('peminjaman'))
                ->setPaper('a4', 'portrait');

        return $pdf->download("Surat-Permohonan-Kendaraan-{$peminjaman->kode_peminjam}.pdf");
    }
    
    // Kalender Peminjaman
    public function getCalendarEvents()
    {
        $events = [];

        // Peminjaman Ruangan
        $ruangans = PeminjamanRuangan::with('ruangan')
            ->whereIn('status', ['pending', 'disetujui'])
            ->get();

        foreach ($ruangans as $p) {
            $start = $this->combineDateTime($p->tanggal_mulai, $p->jam_mulai);
            $end = $this->combineDateTime($p->tanggal_selesai ?? $p->tanggal_mulai, $p->jam_selesai);

            $events[] = [
                'title' => '',
                'start' => $start->format('Y-m-d\TH:i:s'),
                'end'   => $end->format('Y-m-d\TH:i:s'),
                'backgroundColor' => $p->status === 'disetujui' ? '#ef4444' : '#eab308',
                'borderColor'     => $p->status === 'disetujui' ? '#ef4444' : '#eab308',
                'textColor'       => '#ffffff',
                'extendedProps' => [
                    'jenis'  => 'ruangan',
                    'detail' => '
                        <p class="font-semibold text-lg text-blue-800 mb-2">Peminjaman Ruangan</p>
                        <p>Ruangan: ' . ($p->ruangan->nama_ruangan ?? '-') . '</p>
                        <p>Jam: ' . $this->formatJam($p->jam_mulai) . ' - ' . $this->formatJam($p->jam_selesai) . '</p>
                        <p>Status: ' . ucfirst($p->status) . '</p>
                    '
                ]
            ];
        }

        // Peminjaman Kendaraan
        $kendaraans = PeminjamanKendaraan::with('kendaraan')
            ->whereIn('status', ['pending', 'disetujui'])
            ->get();

        foreach ($kendaraans as $p) {
            $start = $this->combineDateTime($p->tanggal_mulai, $p->jam_mulai);
            $end = $this->combineDateTime($p->tanggal_mulai, $p->jam_selesai);

            $events[] = [
                'title' => '',
                'start' => $start->format('Y-m-d\TH:i:s'),
                'end'   => $end->format('Y-m-d\TH:i:s'),
                'color' => $p->status === 'disetujui' ? '#ef4444' : '#eab308',
                'extendedProps' => [
                    'jenis'  => 'kendaraan',
                    'detail' => '
                        <p class="font-semibold text-lg text-blue-800 mb-2">Peminjaman Kendaraan</p>
                        <p>Kendaraan: ' . ($p->kendaraan->nama_kendaraan ?? '-') . ' (' . ($p->kendaraan->tipe_kendaraan ?? '') . ')</p>
                        <p>Jam: ' . $this->formatJam($p->jam_mulai) . ' - ' . $this->formatJam($p->jam_selesai) . '</p>
                        <p>Status: ' . ucfirst($p->status) . '</p>
                    '
                ]
            ];
        }

        // Peminjaman Barang
        $barangs = PeminjamanBarang::with('details.barang')
            ->whereIn('status', ['pending', 'disetujui'])
            ->get();

        foreach ($barangs as $p) {
            $barangList = $p->details->map(fn($d) => $d->barang->nama_barang . ' (' . $d->jumlah . ')')->join(', ');
            $start = $this->combineDateTime($p->tanggal_mulai, $p->jam_mulai);
            $end = $this->combineDateTime($p->tanggal_selesai ?? $p->tanggal_mulai, $p->jam_selesai);

            $events[] = [
                'title' => '',
                'start' => $start->format('Y-m-d\TH:i:s'),
                'end'   => $end->format('Y-m-d\TH:i:s'),
                'color' => $p->status === 'disetujui' ? '#ef4444' : '#eab308',
                'extendedProps' => [
                    'jenis'  => 'barang',
                    'detail' => '
                        <p class="font-semibold text-lg text-blue-800 mb-2">Peminjaman Barang</p>
                        <p>Barang: ' . $barangList . '</p>
                        <p>Jam: ' . $this->formatJam($p->jam_mulai) . ' - ' . $this->formatJam($p->jam_selesai) . '</p>
                        <p>Status: ' . ucfirst($p->status) . '</p>
                    '
                ]
            ];
        }

        return response()->json($events);
    }

    /**
     * Gabungkan tanggal dan jam menjadi objek Carbon
     */
    private function combineDateTime($tanggal, $jam): Carbon
    {
        $tanggalStr = $tanggal instanceof Carbon
            ? $tanggal->format('Y-m-d')
            : substr((string) $tanggal, 0, 10);

        $jamStr = $jam instanceof Carbon
            ? $jam->format('H:i:s')
            : substr((string) $jam, 0, 8);

        // Parse dengan timezone default aplikasi
        return Carbon::parse($tanggalStr . ' ' . $jamStr, config('app.timezone'));
    }

    /**
     * Format jam agar tampil H:i
     */
    private function formatJam($jam): string
    {
        return $jam instanceof Carbon
            ? $jam->format('H:i')
            : substr((string) $jam, 0, 5);
    }

    private function ensureValidEnd(Carbon $start, Carbon $end): Carbon
    {
        if ($end->lessThanOrEqualTo($start)) {
            return $start->copy()->addHour(); // tambah 1 jam
        }
        return $end;
    }
    
}