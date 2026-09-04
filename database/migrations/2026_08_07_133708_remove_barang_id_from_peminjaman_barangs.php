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
        Schema::table('peminjaman_barangs', function (Blueprint $table) {
            // Hapus foreign key dulu, lalu kolom
            $table->dropForeign(['barang_id']);
            $table->dropColumn('barang_id');
            $table->dropColumn('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_barangs', function (Blueprint $table) {
            // Kembalikan kolom jika rollback
            $table->foreignId('barang_id')->nullable()->constrained('barangs');
            $table->integer('jumlah')->nullable();
        });
    }
};
