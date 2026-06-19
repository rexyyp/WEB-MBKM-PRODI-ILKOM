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
        Schema::table('uji_kompetensis', function (Blueprint $table) {
            // Tambah kolom untuk mendukung frontend
            $table->enum('tipe_ujian', ['offline', 'online'])->nullable()->after('jenis_ujian');
            $table->string('link_daring')->nullable()->after('tipe_ujian');
            $table->text('catatan_revisi')->nullable()->after('link_daring');
            $table->timestamp('diajukan_at')->nullable()->after('catatan_revisi');
            $table->foreignId('dosen_penguji_id')->nullable()->after('diajukan_at')
                  ->constrained('dosens')->nullOnDelete();
        });

        // Ubah status enum: tambah 'draft' dan 'direview'
        DB::statement("ALTER TABLE uji_kompetensis MODIFY COLUMN status ENUM('draft','menunggu','direview','revisi','disetujui','selesai') NOT NULL DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uji_kompetensis', function (Blueprint $table) {
            $table->dropForeign(['dosen_penguji_id']);
            $table->dropColumn(['tipe_ujian', 'link_daring', 'catatan_revisi', 'diajukan_at', 'dosen_penguji_id']);
        });

        DB::statement("ALTER TABLE uji_kompetensis MODIFY COLUMN status ENUM('menunggu','disetujui','revisi','selesai') NOT NULL DEFAULT 'menunggu'");
    }
};
