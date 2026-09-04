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
        Schema::create('peminjaman_kendaraans', function (Blueprint $table) {
            $table->id();
             $table->string('kode_peminjam')->unique()->nullable(); // auto generate
            $table->string('nama_peminjam');
            $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
            $table->string('tujuan');
            $table->string('nama_sopir');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable(); // default sama dengan tanggal_mulai
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
        Schema::dropIfExists('peminjaman_kendaraans');
    }
};
