<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom nilai_huruf ke tabel detail_konversi_sks
     * untuk menyimpan nilai huruf (A, B+, B, dst.) per mata kuliah yang dikonversi.
     */
    public function up(): void
    {
        Schema::table('detail_konversi_sks', function (Blueprint $table) {
            $table->string('nilai_huruf', 5)->nullable()->after('nilai_diakui');
        });
    }

    public function down(): void
    {
        Schema::table('detail_konversi_sks', function (Blueprint $table) {
            $table->dropColumn('nilai_huruf');
        });
    }
};
