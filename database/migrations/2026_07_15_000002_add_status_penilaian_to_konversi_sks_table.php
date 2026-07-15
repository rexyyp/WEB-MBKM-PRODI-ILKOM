<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom status_penilaian ke tabel konversi_sks
     * untuk melacak apakah kaprodi sudah mensahkan nilai huruf.
     */
    public function up(): void
    {
        Schema::table('konversi_sks', function (Blueprint $table) {
            $table->enum('status_penilaian', ['menunggu', 'selesai'])
                  ->default('menunggu')
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('konversi_sks', function (Blueprint $table) {
            $table->dropColumn('status_penilaian');
        });
    }
};
