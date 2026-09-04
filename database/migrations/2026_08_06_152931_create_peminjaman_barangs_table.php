<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjam')->unique();          // kode otomatis
            $table->string('nama_peminjam');
            $table->string('nip_nisn');                         // NIP/NISN
            $table->string('jabatan_kelas');                    // Jabatan atau Kelas
            $table->string('unit_organisasi');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('jumlah');                          // jumlah barang dipinjam
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('kegiatan');
            $table->text('tujuan')->nullable();
            $table->string('no_hp');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_barangs');
    }
};
