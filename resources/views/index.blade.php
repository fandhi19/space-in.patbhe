<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPACE-IN PATBHE - Peminjaman Ruangan & Barang SMAN 4 Yogyakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo-web.png') }}" type="image/x-icon">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Perbaikan event satu hari */
        .fc-daygrid-event-harness {
            margin-bottom: 2px;          /* beri jarak antar event */
        }

        .fc-daygrid-event {
            min-height: 18px;            /* tinggi minimum jelas */
            border-radius: 4px;          /* sudut membulat */
            padding: 2px 4px;            /* beri padding agar blok terlihat */
            display: block !important;   /* pastikan tampil sebagai blok */
            border: none;                /* hilangkan border default */
            line-height: 1.4;            /* jarak baris normal */
        }

        .fc-event {
            min-height: 18px;            /* untuk event multi-hari */
        }

        /* Untuk event yang dirender dengan eventContent kosong */
        .fc-event .fc-event-main {
            min-height: 18px;
            height: 100%;
        }

        /* Hilangkan titik indikator */
        .fc-daygrid-event-dot {
            display: none;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-[#333333] scroll-smooth">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-web.png') }}" alt="Logo SMAN 4 Yogyakarta" class="w-12 h-12">
                    <div>
                        <span class="font-bold text-lg text-[#142b52] block leading-none">SPACE-IN PATBHE</span>
                        <span class="text-xs text-[#666666]">SMAN 4 Yogyakarta</span>
                    </div>
                </div>
                <div class="hidden md:flex space-x-8 font-medium text-[#555555]">
                    <a href="#beranda" class="hover:text-[#eab308] transition">Beranda</a>
                    <a href="#keunggulan" class="hover:text-[#eab308] transition">Keunggulan</a>
                    <a href="#fasilitas" class="hover:text-[#eab308] transition">Ruangan</a>
                    <a href="#barang" class="hover:text-[#eab308] transition">Barang</a>
                    <a href="#prosedur" class="hover:text-[#eab308] transition">Prosedur</a>
                    <a href="#kontak" class="hover:text-[#eab308] transition">Kontak</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Header --}}
    <header id="beranda" class="relative bg-gradient-to-br from-[#142b52] to-[#0f213d] text-white py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 text-center md:text-left">
                <span class="bg-white/10 text-[#facc15] text-xs font-semibold uppercase tracking-wider px-3 py-1 rounded-full border border-[#facc15]/30">
                    Layanan Resmi Sarpras Patbhe
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight text-white">
                    Pinjam Sarana & Prasarana Jadi Lebih <span class="text-[#facc15]">Mudah Cepat & Transparan</span>
                </h1>
                <p class="text-lg text-[#d1d5db] max-w-xl mx-auto md:mx-0">
                    Ajukan peminjaman ruangan maupun barang inventaris sekolah secara digital. Mudah, terjadwal, dan terpantau real-time.
                </p>
                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4 pt-2">
                    <a href="{{ route('form.peminjaman') }}" class="bg-[#facc15] hover:bg-[#eab308] text-[#142b52] font-bold px-6 py-3 rounded-xl shadow-lg transition text-center">
                        <i class="fa-regular fa-building mr-1"></i> Pinjam Ruangan
                    </a>
                    <a href="{{ route('form.barang') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-semibold px-6 py-3 rounded-xl transition text-center">
                        <i class="fa-solid fa-box mr-1"></i> Pinjam Barang
                    </a>
                    <a href="{{ route('form.kendaraan') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-semibold px-6 py-3 rounded-xl transition text-center">
                        <i class="fa-solid fa-car mr-1"></i> Pinjam Kendaraan
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <svg class="w-full max-w-md text-white/10" viewBox="0 0 200 200" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M40 20h120v160H40z" fill="#0f213d" />
                    <path d="M50 30h100v40H50z" fill="#142b52" />
                    <circle cx="70" cy="50" r="8" fill="#facc15" />
                    <rect x="50" y="90" width="25" height="25" rx="4" fill="#eab308" />
                    <rect x="87" y="90" width="25" height="25" rx="4" fill="#eab308" />
                    <rect x="125" y="90" width="25" height="25" rx="4" fill="#eab308" />
                    <rect x="50" y="130" width="25" height="25" rx="4" fill="#eab308" />
                    <rect x="87" y="130" width="25" height="25" rx="4" fill="#eab308" />
                    <rect x="125" y="130" width="25" height="25" rx="4" fill="#eab308" />
                </svg>
            </div>
        </div>
    </header>

    {{-- Keunggulan --}}
    <section id="keunggulan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">Mengapa SPACE-IN Patbhe?</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Manajemen peminjaman fasilitas dan inventaris sekolah yang serba digital, cepat, dan transparan.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-[#f8fafc] p-8 rounded-2xl border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-12 h-12 bg-[#f4f6f9] rounded-xl flex items-center justify-center text-[#142b52] text-xl font-bold mb-6 group-hover:bg-[#142b52] group-hover:text-[#facc15] transition-all shadow-sm">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#142b52] mb-3">Proses Cepat</h3>
                    <p class="text-[#666666] leading-relaxed">Ajukan peminjaman ruangan atau barang dari mana saja tanpa perlu proposal fisik yang memakan waktu.</p>
                </div>
                <div class="bg-[#f8fafc] p-8 rounded-2xl border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-12 h-12 bg-[#f4f6f9] rounded-xl flex items-center justify-center text-[#142b52] text-xl font-bold mb-6 group-hover:bg-[#142b52] group-hover:text-[#facc15] transition-all shadow-sm">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#142b52] mb-3">Inventaris Terpadu</h3>
                    <p class="text-[#666666] leading-relaxed">Cek ketersediaan ruangan dan stok barang secara real-time, hindari bentrok dan kehabisan stok.</p>
                </div>
                <div class="bg-[#f8fafc] p-8 rounded-2xl border border-gray-100 hover:shadow-xl transition group">
                    <div class="w-12 h-12 bg-[#f4f6f9] rounded-xl flex items-center justify-center text-[#142b52] text-xl font-bold mb-6 group-hover:bg-[#142b52] group-hover:text-[#facc15] transition-all shadow-sm">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#142b52] mb-3">Status Transparan</h3>
                    <p class="text-[#666666] leading-relaxed">Pantau status pengajuan Anda kapan saja lewat kode unik. Disetujui, ditolak, atau selesai, semua jelas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Daftar Ruangan --}}
    <section id="fasilitas" class="py-20 bg-[#f4f6f9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">Daftar Ruangan</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Berbagai ruangan di SMAN 4 Yogyakarta yang siap digunakan untuk menunjang kegiatan Anda.</p>
            </div>

            {{-- Tabel untuk desktop --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] overflow-hidden hidden lg:block">
                <div class="max-h-80 overflow-y-auto">
                    <table class="min-w-full divide-y divide-[#d1d5db] text-left">
                        <thead class="bg-[#f8fafc] text-[#333333] uppercase text-xs font-semibold tracking-wider sticky top-0 z-10 border-b border-[#d1d5db]">
                            <tr>
                                <th class="px-6 py-4">Nama Ruangan</th>
                                <th class="px-6 py-4">Kapasitas</th>
                                <th class="px-6 py-4">Fasilitas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f4f6f9] text-sm text-[#555555] font-medium">
                            @forelse ($ruangans as $ruangan)
                            <tr class="hover:bg-[#f4f6f9]">
                                <td class="px-6 py-4 text-[#142b52] font-bold">{{ $ruangan->nama_ruangan }}</td>
                                <td class="px-6 py-4">{{ $ruangan->kapasitas }} Orang</td>
                                <td class="px-6 py-4">{{ $ruangan->fasilitas ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-[#666666]">Belum ada data ruangan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card untuk mobile --}}
            <div class="grid md:grid-cols-2 gap-4 lg:hidden">
                @forelse ($ruangans as $ruangan)
                <div class="bg-white p-5 rounded-xl border border-[#d1d5db] shadow-sm">
                    <h4 class="font-bold text-[#142b52] text-lg">{{ $ruangan->nama_ruangan }}</h4>
                    <p class="text-sm text-[#555555] mt-1">Kapasitas: {{ $ruangan->kapasitas }} Orang</p>
                    <p class="text-sm text-[#666666] mt-2"><strong>Fasilitas:</strong> {{ $ruangan->fasilitas ?? '-' }}</p>
                </div>
                @empty
                <div class="col-span-full text-center text-[#666666] py-8">Belum ada data ruangan.</div>
                @endforelse
            </div>

            {{-- <div class="text-center mt-8">
                <a href="{{ route('form.peminjaman') }}" class="bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold px-6 py-3 rounded-lg inline-block transition">
                    <i class="fa-regular fa-building mr-1 text-[#facc15]"></i> Ajukan Peminjaman Ruangan
                </a>
            </div> --}}
        </div>
    </section>

    {{-- Daftar Barang --}}
    <section id="barang" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">Daftar Barang Inventaris</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Barang-barang yang dapat dipinjam untuk menunjang kegiatan akademik maupun organisasi.</p>
            </div>

            {{-- Tabel desktop --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] overflow-hidden hidden lg:block">
                <div class="max-h-80 overflow-y-auto">
                    <table class="min-w-full divide-y divide-[#d1d5db] text-left">
                        <thead class="bg-[#f8fafc] text-[#333333] uppercase text-xs font-semibold tracking-wider sticky top-0 z-10 border-b border-[#d1d5db]">
                            <tr>
                                <th class="px-6 py-4">Nama Barang</th>
                                <th class="px-6 py-4">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f4f6f9] text-sm text-[#555555] font-medium">
                            @forelse ($barangs as $barang)
                            <tr class="hover:bg-[#f4f6f9]">
                                <td class="px-6 py-4 text-[#142b52] font-bold">{{ $barang->nama_barang }}</td>
                                <td class="px-6 py-4">{{ $barang->stok }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-center py-4 text-[#666666]">Belum ada data barang.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card mobile --}}
            <div class="grid md:grid-cols-2 gap-4 lg:hidden">
                @forelse ($barangs as $barang)
                <div class="bg-white p-5 rounded-xl border border-[#d1d5db] shadow-sm">
                    <h4 class="font-bold text-[#142b52] text-lg">{{ $barang->nama_barang }}</h4>
                    <p class="text-sm text-[#666666] mt-2"><strong>Stok:</strong> {{ $barang->stok }}</p>
                </div>
                @empty
                <div class="col-span-full text-center text-[#666666] py-8">Belum ada data barang.</div>
                @endforelse
            </div>

            {{-- <div class="text-center mt-8">
                <a href="{{ route('form.barang') }}" class="bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold px-6 py-3 rounded-lg inline-block transition">
                    <i class="fa-solid fa-box mr-1 text-[#facc15]"></i> Ajukan Peminjaman Barang
                </a>
            </div> --}}
        </div>
    </section>

    {{-- Daftar Kendaraan --}}
    <section id="kendaraan" class="py-20 bg-[#f4f6f9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">Daftar Kendaraan</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Kendaraan dinas yang dapat dipinjam untuk menunjang kegiatan sekolah.</p>
            </div>

            {{-- Tabel untuk desktop --}}
            <div class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] overflow-hidden hidden lg:block">
                <div class="max-h-80 overflow-y-auto">
                    <table class="min-w-full divide-y divide-[#d1d5db] text-left">
                        <thead class="bg-[#f8fafc] text-[#333333] uppercase text-xs font-semibold tracking-wider sticky top-0 z-10 border-b border-[#d1d5db]">
                            <tr>
                                <th class="px-6 py-4">Nama Kendaraan</th>
                                <th class="px-6 py-4">Tipe</th>
                                <th class="px-6 py-4">Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f4f6f9] text-sm text-[#555555] font-medium">
                            @forelse ($kendaraans as $kendaraan)
                            <tr class="hover:bg-[#f4f6f9]">
                                <td class="px-6 py-4 text-[#142b52] font-bold">{{ $kendaraan->nama_kendaraan }}</td>
                                <td class="px-6 py-4">{{ $kendaraan->tipe_kendaraan }}</td>
                                <td class="px-6 py-4">{{ $kendaraan->kapasitas }} Orang</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-[#666666]">Belum ada data kendaraan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Card untuk mobile --}}
            <div class="grid md:grid-cols-2 gap-4 lg:hidden">
                @forelse ($kendaraans as $kendaraan)
                <div class="bg-white p-5 rounded-xl border border-[#d1d5db] shadow-sm">
                    <h4 class="font-bold text-[#142b52] text-lg">{{ $kendaraan->nama_kendaraan }}</h4>
                    <p class="text-sm text-[#555555] mt-1">Tipe: {{ $kendaraan->tipe_kendaraan }}</p>
                    <p class="text-sm text-[#666666] mt-2"><strong>Kapasitas:</strong> {{ $kendaraan->kapasitas }} Orang</p>
                </div>
                @empty
                <div class="col-span-full text-center text-[#666666] py-8">Belum ada data kendaraan.</div>
                @endforelse
            </div>

            {{-- <div class="text-center mt-8">
                <a href="{{ route('form.kendaraan') }}" class="bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold px-6 py-3 rounded-lg inline-block transition">
                    <i class="fa-solid fa-car mr-1 text-[#facc15]"></i> Ajukan Peminjaman Kendaraan
                </a>
            </div> --}}
        </div>
    </section>

    {{-- Kalender Interaktif Peminjaman --}}
    <section id="kalender" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">Kalender Peminjaman</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Lihat ketersediaan ruangan, kendaraan, dan barang secara visual.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-4 text-sm">
                    <span class="inline-flex items-center space-x-2">
                        <span class="w-4 h-4 bg-[#ef4444] rounded-sm"></span>
                        <span>Terpakai (Disetujui)</span>
                    </span>
                    <span class="inline-flex items-center space-x-2">
                        <span class="w-4 h-4 bg-[#eab308] rounded-sm"></span>
                        <span>Pending (Menunggu)</span>
                    </span>
                    <span class="inline-flex items-center space-x-2">
                        <span class="w-4 h-4 bg-[#10b981] rounded-sm"></span>
                        <span>Kosong</span>
                    </span>
                </div>
            </div>

            <div id="calendar" class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] p-4"></div>
        </div>
    </section>

    {{-- Prosedur --}}
    <section id="prosedur" class="py-20 bg-[#f4f6f9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">3 Langkah Mudah Peminjaman</h2>
                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>
                <p class="mt-4 text-[#555555] text-lg">Pahami alur pengajuan agar peminjaman ruangan atau barang Anda berjalan lancar.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-[#142b52] text-[#facc15] font-extrabold text-xl rounded-full flex items-center justify-center mx-auto shadow-md border-2 border-[#eab308]">1</div>
                    <h3 class="text-xl font-bold text-[#142b52]">Pilih Jenis Peminjaman</h3>
                    <p class="text-[#666666] max-w-xs mx-auto">Tentukan apakah Anda ingin meminjam ruangan atau barang, lalu buka form yang sesuai.</p>
                </div>
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-[#142b52] text-[#facc15] font-extrabold text-xl rounded-full flex items-center justify-center mx-auto shadow-md border-2 border-[#eab308]">2</div>
                    <h3 class="text-xl font-bold text-[#142b52]">Isi Form dengan Lengkap</h3>
                    <p class="text-[#666666] max-w-xs mx-auto">Lengkapi data diri, pilih ruangan/barang yang tersedia, dan jelaskan keperluan Anda.</p>
                </div>
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-[#142b52] text-[#facc15] font-extrabold text-xl rounded-full flex items-center justify-center mx-auto shadow-md border-2 border-[#eab308]">3</div>
                    <h3 class="text-xl font-bold text-[#142b52]">Tunggu Persetujuan</h3>
                    <p class="text-[#666666] max-w-xs mx-auto">Tim Sarpras akan meninjau. Status akan diperbarui dan dapat dicek melalui kode unik yang Anda terima.</p>
                </div>
            </div>

            <div class="mt-16 bg-white border-l-4 border-[#eab308] p-5 rounded-r-xl max-w-4xl mx-auto flex items-start space-x-3 shadow-sm">
                <i class="fa-solid fa-triangle-exclamation text-[#eab308] text-xl mt-0.5"></i>
                <div>
                    <h5 class="font-bold text-[#333333] text-sm sm:text-base">Catatan Penting:</h5>
                    <p class="text-[#666666] text-sm mt-1 leading-relaxed">
                        Apabila pada hari pelaksanaan terdapat peminjaman ruangan dengan lokasi yang sama dan kebutuhan penggunaan ruangan oleh guru dinilai lebih mendesak/urgen, maka pihak pengelola akan menginformasikan kepada siswa yang juga telah meminjam ruangan tersebut paling lambat 1 (satu) hari sebelum pelaksanaan, untuk dilakukan penyesuaian lokasi atau jadwal penggunaan ruangan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Cek Status Peminjaman --}}
    <section id="cek-status" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-[#142b52] sm:text-4xl">
                    Cek Status Peminjaman
                </h2>

                <div class="w-20 h-1 bg-[#eab308] mx-auto mt-4 rounded"></div>

                <p class="mt-4 text-[#555555] text-lg">
                    Gunakan kode unik yang Anda dapatkan saat pengajuan untuk melacak
                    status peminjaman ruangan maupun barang.
                </p>
            </div>

            {{-- 3 Card Horizontal --}}
            <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

                {{-- Card Ruangan --}}
                <div class="bg-[#f8fafc] rounded-2xl shadow-sm border border-[#d1d5db] p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-[#f4f6f9] rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fa-solid fa-building text-[#142b52] text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-[#142b52] mb-3">
                        Peminjaman Ruangan
                    </h3>

                    <p class="text-[#666666] mb-6">
                        Lacak status pengajuan peminjaman ruangan Anda di sini.
                    </p>

                    <form action="{{ route('tracking.ruangan.process') }}" method="GET" class="space-y-4">
                        <input
                            type="text"
                            name="kode"
                            placeholder="Masukkan kode ruangan (PR4B-...)"
                            required
                            class="w-full rounded-lg border-[#d1d5db] shadow-sm focus:border-[#142b52] focus:ring-[#142b52] p-3 border text-center"
                        >

                        <button
                            type="submit"
                            class="w-full bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold py-3 px-6 rounded-lg transition"
                        >
                            <i class="fa-solid fa-search mr-2 text-[#facc15]"></i>
                            Cek Status Ruangan
                        </button>
                    </form>
                </div>


                {{-- Card Barang --}}
                <div class="bg-[#f8fafc] rounded-2xl shadow-sm border border-[#d1d5db] p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-[#f4f6f9] rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fa-solid fa-box text-[#142b52] text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-[#142b52] mb-3">
                        Peminjaman Barang
                    </h3>

                    <p class="text-[#666666] mb-6">
                        Lacak status pengajuan peminjaman barang Anda di sini.
                    </p>

                    <form action="{{ route('tracking.barang.form') }}" method="GET" class="space-y-4">
                        <input
                            type="text"
                            name="kode"
                            placeholder="Masukkan kode barang (PB4B-...)"
                            required
                            class="w-full rounded-lg border-[#d1d5db] shadow-sm focus:border-[#142b52] focus:ring-[#142b52] p-3 border text-center"
                        >

                        <button
                            type="submit"
                            class="w-full bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold py-3 px-6 rounded-lg transition"
                        >
                            <i class="fa-solid fa-search mr-2 text-[#facc15]"></i>
                            Cek Status Barang
                        </button>
                    </form>
                </div>


                {{-- Card Kendaraan --}}
                <div class="bg-[#f8fafc] rounded-2xl shadow-sm border border-[#d1d5db] p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-[#f4f6f9] rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fa-solid fa-car text-[#142b52] text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-[#142b52] mb-3">
                        Peminjaman Kendaraan
                    </h3>

                    <p class="text-[#666666] mb-6">
                        Lacak status pengajuan peminjaman kendaraan Anda di sini.
                    </p>

                    <form action="{{ route('tracking.kendaraan.form') }}" method="GET" class="space-y-4">
                        <input
                            type="text"
                            name="kode"
                            placeholder="Masukkan kode kendaraan (PK-...)"
                            required
                            class="w-full rounded-lg border-[#d1d5db] shadow-sm focus:border-[#142b52] focus:ring-[#142b52] p-3 border text-center"
                        >

                        <button
                            type="submit"
                            class="w-full bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold py-3 px-6 rounded-lg transition"
                        >
                            <i class="fa-solid fa-search mr-2 text-[#facc15]"></i>
                            Cek Status Kendaraan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    {{-- <section class="bg-[#142b52] text-white py-16 text-center relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 space-y-6 relative z-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold">Siap Memulai Kegiatan Anda?</h2>
            <p class="text-[#d1d5db] max-w-xl mx-auto">Pilih jenis peminjaman yang Anda butuhkan dan lengkapi formulirnya sekarang juga.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('form.peminjaman') }}" 
                   class="bg-[#facc15] hover:bg-[#eab308] text-[#142b52] font-bold px-8 py-4 rounded-xl text-lg shadow-xl transition transform hover:-translate-y-1 inline-block">
                    <i class="fa-regular fa-building mr-2"></i> Pinjam Ruangan
                </a>
                <a href="{{ route('form.barang') }}" 
                   class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-bold px-8 py-4 rounded-xl text-lg transition hover:-translate-y-1 inline-block">
                    <i class="fa-solid fa-box mr-2 text-[#facc15]"></i> Pinjam Barang
                </a>
            </div>
        </div>
    </section> --}}

    {{-- Footer --}}
    <footer id="kontak" class="bg-[#0f213d] text-[#d1d5db] py-12 border-t border-[#142b52]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-8">
            <div class="space-y-4">
                <div class="flex items-center space-x-3 text-white">
                    <img src="{{ asset('images/logo-web.png') }}" alt="Logo SMAN 4 Yogyakarta" class="w-20 h-20">
                    <span class="font-bold text-lg">SPACE-IN PATBHE</span>
                </div>
                <p class="text-sm leading-relaxed text-[#d1d5db]">Sistem Informasi Peminjaman Ruangan & Barang terintegrasi demi mewujudkan transparansi dan kenyamanan fasilitas sekolah.</p>
            </div>
            <div class="space-y-3">
                <h4 class="text-white font-semibold">Hubungi Sarpras</h4>
                <ul class="space-y-2 text-sm">
                    <li><i class="fa-solid fa-location-dot mr-2 text-[#facc15]"></i> Jl. Karangwaru Kidul, Tegalrejo, Kota Yogyakarta</li>
                    <li><i class="fa-solid fa-envelope mr-2 text-[#facc15]"></i> 4bheyogyakarta@gmail.com</li>
                    <li><i class="fa-solid fa-phone mr-2 text-[#facc15]"></i> (0274) 513245</li>
                </ul>
            </div>
            <div class="space-y-3">
                <h4 class="text-white font-semibold">Tautan Cepat</h4>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <a href="#beranda" class="hover:text-[#facc15] transition">Beranda</a>
                    <a href="#keunggulan" class="hover:text-[#facc15] transition">Keunggulan</a>
                    <a href="#fasilitas" class="hover:text-[#facc15] transition">Ruangan</a>
                    <a href="#barang" class="hover:text-[#facc15] transition">Barang</a>
                    <a href="#prosedur" class="hover:text-[#facc15] transition">Prosedur</a>
                    <a href="#cek-status" class="hover:text-[#facc15] transition">Cek Status</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-6 border-t border-[#142b52] text-center text-xs text-[#d1d5db]">
            © 2026 Tim IT SMAN 4 Yogyakarta. All Rights Reserved.

            <span class="mx-2 text-[#475569]">|</span>

            <a href="{{ route('developer') }}"
            class="text-[#facc15] hover:text-white transition font-medium">
                Tim Developer
            </a>
        </div>
    </footer>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Script Kalender -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            events: '{{ route('kalender.events') }}',

            // Tampilkan hanya blok warna, tanpa teks
            eventContent: function(arg) {
                return { html: '<div style="width:100%;height:100%;"></div>' };
            },

            eventDidMount: function(info) {
                info.el.style.backgroundColor = info.event.backgroundColor;
                info.el.style.borderColor = info.event.borderColor;
                info.el.style.color = info.event.textColor;
            },

            // Saat event diklik, tetap tampilkan daftar peminjaman tanggal itu
            eventClick: function(info) {
                var dateStr = info.event.startStr.slice(0, 10);
                var clickedDate = new Date(dateStr + 'T00:00:00');
                handleDateClick(clickedDate, calendar);
            },

            // Saat tanggal diklik, tampilkan daftar peminjaman
            dateClick: function(info) {
                var clickedDate = new Date(info.dateStr + 'T00:00:00');
                handleDateClick(clickedDate, calendar);
            },

            // Warna hijau untuk tanggal kosong
            dayCellDidMount: function(info) {
                var hasEvents = calendar.getEvents().some(function(ev) {
                    var start = new Date(ev.start);
                    var end = ev.end ? new Date(ev.end) : start;
                    var cellDate = new Date(info.date);
                    cellDate.setHours(0,0,0,0);
                    var startDate = new Date(start);
                    startDate.setHours(0,0,0,0);
                    var endDate = new Date(end);
                    endDate.setHours(0,0,0,0);
                    return cellDate >= startDate && cellDate <= endDate;
                });
                if (!hasEvents) {
                    info.el.style.backgroundColor = '#dcfce7';
                }
            },

            eventColor: '#eab308',
            height: 'auto',
            dayMaxEvents: 3,
        });

        calendar.render();

        // Fungsi global untuk menampilkan detail peminjaman pada tanggal
        window.handleDateClick = function(clickedDate, calendar) {
            var eventsOnDate = calendar.getEvents().filter(function(event) {
                var eventStart = new Date(event.start);
                var eventEnd = event.end ? new Date(event.end) : eventStart;
                var startDate = new Date(eventStart);
                startDate.setHours(0,0,0,0);
                var endDate = new Date(eventEnd);
                endDate.setHours(0,0,0,0);
                var cellDate = new Date(clickedDate);
                cellDate.setHours(0,0,0,0);
                return cellDate >= startDate && cellDate <= endDate;
            });

            var html = '';
            if (eventsOnDate.length > 0) {
                html += '<p class="font-semibold mb-3">📅 Peminjaman pada tanggal ' + 
                        clickedDate.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }) + 
                        '</p>';
                html += '<div class="space-y-4">';
                eventsOnDate.forEach(function(ev) {
                    html += '<div class="border border-gray-200 rounded-lg p-3">';
                    html += ev.extendedProps.detail; // detail lengkap per event (sudah disamarkan)
                    html += '</div>';
                });
                html += '</div>';
            } else {
                html = '<p class="text-center text-gray-500 py-4">✅ Tidak ada peminjaman pada tanggal ini.</p>';
            }

            document.getElementById('event-detail').innerHTML = html;
            document.getElementById('event-modal').classList.remove('hidden');
        };

        // Tutup modal
        window.closeEventModal = function() {
            document.getElementById('event-modal').classList.add('hidden');
        };
    });
    </script>

    <!-- Modal Detail Event -->
    <div id="event-modal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-6 max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#142b52]">Detail Peminjaman</h3>
                <button onclick="closeEventModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-xmark text-2xl"></i>
                </button>
            </div>
            <div id="event-detail" class="text-sm text-[#333333] space-y-1"></div>
        </div>
    </div>

</body>
</html>