<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Kendaraan - SPACE-IN PATBHE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo-web.png') }}" type="image/x-icon">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#f8fafc] text-[#333333]">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-web.png') }}" alt="Logo SMAN 4 Yogyakarta" class="w-12 h-12">
                    <div>
                        <span class="font-bold text-lg text-[#142b52] block leading-none">SPACE-IN PATBHE</span>
                        <span class="text-xs text-[#666666]">SMAN 4 Yogyakarta</span>
                    </div>
                </a>
                <a href="{{ route('home') }}" class="text-[#555555] hover:text-[#eab308] font-medium transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] p-6 sm:p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#142b52]">
                    <i class="fa-solid fa-car mr-2 text-[#eab308]"></i> Form Peminjaman Kendaraan
                </h1>
                <p class="text-[#666666] mt-2">Lengkapi data berikut untuk mengajukan peminjaman kendaraan.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 text-sm">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i> Mohon perbaiki data berikut:
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('simpan.kendaraan') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Nama Peminjam <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Nama lengkap" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Kendaraan <span class="text-red-500">*</span></label>
                        <select name="kendaraan_id" required
                                class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52] bg-white">
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                                    {{ $kendaraan->nama_kendaraan }} ({{ $kendaraan->tipe_kendaraan }} - {{ $kendaraan->kapasitas }} orang)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Tujuan <span class="text-red-500">*</span></label>
                        <input type="text" name="tujuan" value="{{ old('tujuan') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Tujuan penggunaan" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Nama Sopir <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sopir" value="{{ old('nama_sopir') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Nama sopir" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">No. HP <span class="text-red-500">*</span></label>
                        <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                            placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Hari / Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Jam Mulai <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Jam Selesai <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               required>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-[#eab308] p-4 rounded-r-lg text-sm text-[#555555] flex items-start space-x-2">
                    <i class="fa-solid fa-circle-info text-[#eab308] mt-0.5"></i>
                    <p>Pastikan jadwal tidak bentrok dengan peminjaman kendaraan lain. Jika kendaraan sudah dipinjam pada rentang waktu tersebut, pengajuan akan ditolak otomatis.</p>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('home') }}" class="px-6 py-3 border border-[#d1d5db] rounded-lg text-[#555555] hover:bg-gray-50 transition font-medium">
                        Batal
                    </a>
                    <button type="submit" class="bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold px-8 py-3 rounded-lg transition shadow-sm">
                        <i class="fa-regular fa-paper-plane mr-2"></i> Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>