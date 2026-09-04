<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Berhasil - SPACE-IN PATBHE</title>
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
<body class="bg-[#f8fafc] flex items-center justify-center min-h-screen p-4">

    @php
        // Tentukan label dan route berdasarkan jenis peminjaman
        $jenisLabel = match ($jenis) {
            'ruangan'   => 'Peminjaman Ruangan',
            'barang'    => 'Peminjaman Barang',
            'kendaraan' => 'Peminjaman Kendaraan',
            default     => 'Peminjaman',
        };

        $routeAjukan = match ($jenis) {
            'ruangan'   => route('form.peminjaman'),
            'barang'    => route('form.barang'),
            'kendaraan' => route('form.kendaraan') ?? route('home'), // sesuaikan bila route kendaraan sudah ada
            default     => route('home'),
        };
    @endphp

    <div class="bg-white rounded-2xl shadow-lg border border-[#d1d5db] p-8 max-w-md w-full text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-circle-check text-green-500 text-4xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-[#142b52] mb-2">Pengajuan Berhasil!</h1>
        <p class="text-[#666666] mb-6">Simpan kode unik berikut untuk melacak status peminjaman Anda.</p>
        
        <div class="bg-gray-50 border border-[#d1d5db] rounded-xl p-4 mb-6">
            <span class="text-xs text-[#888] uppercase tracking-wider">Kode Peminjaman</span>
            <div class="text-xl font-mono font-bold text-[#142b52] mt-1 break-all">
                {{ $kode }}
            </div>
            <span class="text-sm text-[#666666]">Jenis: {{ $jenisLabel }}</span>
        </div>

        <div class="bg-yellow-50 border-l-4 border-[#eab308] p-4 rounded-r-lg text-left mb-6">
            <p class="text-sm text-[#555555]">
                <i class="fa-solid fa-circle-info text-[#eab308] mr-1"></i>
                Gunakan kode ini untuk <strong>mengecek status</strong> peminjaman Anda melalui halaman utama.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}" 
               class="bg-[#142b52] hover:bg-[#0f213d] text-white font-semibold px-6 py-3 rounded-lg transition">
                <i class="fa-solid fa-home mr-1"></i> Kembali ke Beranda
            </a>
            <a href="{{ $routeAjukan }}" 
               class="border border-[#142b52] text-[#142b52] font-semibold px-6 py-3 rounded-lg hover:bg-gray-50 transition">
                Ajukan Lagi
            </a>
        </div>
    </div>

</body>
</html>