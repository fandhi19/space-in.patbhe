<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjaman_kendaraans', function (Blueprint $table) {
            DB::statement("ALTER TABLE peminjaman_kendaraans MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak', 'dikembalikan') NOT NULL DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_kendaraans', function (Blueprint $table) {
            DB::statement("ALTER TABLE peminjaman_kendaraans MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak') NOT NULL DEFAULT 'pending'");
        });
    }
};
