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
            $table->dropColumn(['jumlah_baik', 'jumlah_rusak', 'keterangan_rusak']);
            $table->text('keterangan')->nullable()->after('jumlah_hilang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalian_barangs', function (Blueprint $table) {
            $table->integer('jumlah_baik')->default(0);
            $table->integer('jumlah_rusak')->default(0);
            $table->text('keterangan_rusak')->nullable();
            $table->dropColumn('keterangan');
        });
    }
};
