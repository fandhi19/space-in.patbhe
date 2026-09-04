<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang - SPACE-IN PATBHE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/logo-web.png') }}" type="image/x-icon">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
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

    {{-- Form --}}
    <main class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-[#d1d5db] p-6 sm:p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-[#142b52]">
                    <i class="fa-solid fa-box mr-2 text-[#eab308]"></i> Form Peminjaman Barang
                </h1>
                <p class="text-[#666666] mt-2">Lengkapi data berikut untuk mengajukan peminjaman barang inventaris. Anda dapat meminjam lebih dari satu barang.</p>
            </div>

            {{-- Error Alert --}}
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

            <form action="{{ route('simpan.barang') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Data Peminjam --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Nama Peminjam <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Nama lengkap" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">NIP / NISN <span class="text-red-500">*</span></label>
                        <input type="text" name="nip_nisn" value="{{ old('nip_nisn') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="NIP atau NISN" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Jabatan / Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan_kelas" value="{{ old('jabatan_kelas') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Contoh: Guru / XII MIPA 1" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Unit / Organisasi <span class="text-red-500">*</span></label>
                        <input type="text" name="unit_organisasi" value="{{ old('unit_organisasi') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Contoh: OSIS, PMR, Guru Mapel" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">No. HP <span class="text-red-500">*</span></label>
                        <input type="tel" name="no_hp" value="{{ old('no_hp') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kegiatan" value="{{ old('kegiatan') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               placeholder="Nama kegiatan" required>
                    </div>
                </div>

                {{-- Tujuan --}}
                <div>
                    <label class="block font-medium text-[#333333] mb-1">Tujuan</label>
                    <textarea name="tujuan" rows="3"
                              class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                              placeholder="Jelaskan tujuan penggunaan barang (opsional)">{{ old('tujuan') }}</textarea>
                </div>

                {{-- Detail Peminjaman Multi Barang --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block font-medium text-[#333333]">Daftar Barang <span class="text-red-500">*</span></label>
                        <button type="button" onclick="addBarang()" 
                                class="text-sm bg-[#f8fafc] hover:bg-[#eab308] hover:text-[#142b52] border border-[#d1d5db] px-3 py-1 rounded-lg transition font-medium">
                            <i class="fa-solid fa-plus mr-1"></i> Tambah Barang
                        </button>
                    </div>
                    <div id="barang-container" class="space-y-3">
                        <div class="barang-item flex gap-2 items-start">
                            <select name="barang_id[]" required
                                    class="flex-1 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52] bg-white">
                                <option value="">-- Pilih Barang --</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" {{ old('barang_id.0') == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="number" name="jumlah[]" value="{{ old('jumlah.0') }}" required min="1" placeholder="Jumlah" 
                                   class="w-24 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]">
                            <button type="button" onclick="removeBarang(this)" class="text-red-500 hover:text-red-700 p-3">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        @if(old('barang_id'))
                            @foreach(old('barang_id') as $index => $oldBarangId)
                                @if($index > 0)
                                <div class="barang-item flex gap-2 items-start">
                                    <select name="barang_id[]" required
                                            class="flex-1 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52] bg-white">
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}" {{ $oldBarangId == $barang->id ? 'selected' : '' }}>
                                                {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="jumlah[]" value="{{ old('jumlah.'.$index) }}" required min="1" placeholder="Jumlah" 
                                           class="w-24 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]">
                                    <button type="button" onclick="removeBarang(this)" class="text-red-500 hover:text-red-700 p-3">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <p class="text-xs text-[#666666] mt-1">Klik "Tambah Barang" untuk meminjam lebih dari satu barang.</p>
                </div>

                {{-- Tanggal dan Jam --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                               class="w-full border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]"
                               required>
                    </div>
                    <div>
                        <label class="block font-medium text-[#333333] mb-1">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
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

                {{-- Catatan Penting --}}
                <div class="bg-yellow-50 border-l-4 border-[#eab308] p-4 rounded-r-lg text-sm text-[#555555] flex items-start space-x-2">
                    <i class="fa-solid fa-circle-info text-[#eab308] mt-0.5"></i>
                    <p>Pastikan stok mencukupi pada rentang tanggal yang dipilih. Jika stok habis, pengajuan akan ditolak otomatis.</p>
                </div>

                {{-- Submit --}}
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

    {{-- JavaScript --}}
    <script>
        function addBarang() {
            const container = document.getElementById('barang-container');
            const div = document.createElement('div');
            div.className = 'barang-item flex gap-2 items-start';
            div.innerHTML = `
                <select name="barang_id[]" required
                        class="flex-1 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52] bg-white">
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }} (Stok: {{ $barang->stok }})</option>
                    @endforeach
                </select>
                <input type="number" name="jumlah[]" required min="1" placeholder="Jumlah" 
                       class="w-24 border border-[#d1d5db] rounded-lg p-3 focus:border-[#142b52] focus:ring-[#142b52]">
                <button type="button" onclick="removeBarang(this)" class="text-red-500 hover:text-red-700 p-3">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
        }

        function removeBarang(btn) {
            const container = document.getElementById('barang-container');
            const items = container.querySelectorAll('.barang-item');
            if (items.length > 1) {
                btn.parentElement.remove();
            } else {
                alert('Minimal satu barang harus dipilih.');
            }
        }
    </script>

</body>
</html>