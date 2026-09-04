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
        Schema::create('pengembalian_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_kendaraan_id')->constrained('peminjaman_kendaraans')->onDelete('cascade');
            $table->date('tanggal_pengembalian');
            $table->enum('kondisi', ['baik', 'rusak'])->default('baik');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_kendaraans');
    }
};
