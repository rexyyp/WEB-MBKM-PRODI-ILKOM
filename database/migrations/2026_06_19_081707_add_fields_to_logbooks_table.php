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
        Schema::table('logbooks', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable()->after('kegiatan');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
            $table->text('deskripsi')->nullable()->after('jam_selesai');
            $table->text('komentar_dosen')->nullable()->after('file_bukti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai', 'jam_selesai', 'deskripsi', 'komentar_dosen']);
        });
    }
};
