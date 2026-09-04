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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kendaraan')->unique();   // contoh: KND-001
            $table->string('nama_kendaraan');             // contoh: Toyota Hiace
            $table->string('tipe_kendaraan');             // contoh: Minibus
            $table->integer('kapasitas');                 // jumlah penumpang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
