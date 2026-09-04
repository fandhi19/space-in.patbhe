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
        Schema::create('peminjaman_ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjam')->unique();          // kode unik peminjam
            $table->string('nama_peminjam');                    // nama lengkap peminjam
            $table->string('nip_nisn');                         // NIP atau NISN
            $table->string('jabatan_kelas');                    // Jabatan (pegawai) / Kelas (siswa)
            $table->string('unit_organisasi');                  // unit atau organisasi
            $table->string('no_hp');                            // nomor HP
            $table->string('kegiatan');                         // nama kegiatan
            $table->text('tujuan')->nullable();                 // tujuan kegiatan
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade'); // relasi ruangan
            $table->integer('jumlah_peserta');                  // jumlah peserta
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_ruangans');
    }
};
