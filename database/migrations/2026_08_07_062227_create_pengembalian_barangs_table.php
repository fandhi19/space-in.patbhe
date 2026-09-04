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
        Schema::create('pengembalian_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_barang_id')->constrained('peminjaman_barangs')->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->integer('jumlah_kembali');      // dihitung otomatis
            $table->integer('jumlah_baik')->default(0);
            $table->integer('jumlah_rusak')->default(0);
            $table->integer('jumlah_hilang')->default(0);
            $table->text('keterangan_rusak')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_barangs');
    }
};
