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
        Schema::table('pengembalian_barangs', function (Blueprint $table) {
            $table->foreignId('barang_detail_id')->nullable()->constrained('peminjaman_barang_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalian_barangs', function (Blueprint $table) {
            //
        });
    }
};
