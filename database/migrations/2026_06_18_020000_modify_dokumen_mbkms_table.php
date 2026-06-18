<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumen_mbkms', function (Blueprint $table) {
            // Rename jenis_dokumen → kode_dokumen
            $table->renameColumn('jenis_dokumen', 'kode_dokumen');
        });

        Schema::table('dokumen_mbkms', function (Blueprint $table) {
            // Tambah kolom baru
            $table->string('file_name')->nullable()->after('kode_dokumen');
            $table->unsignedBigInteger('file_size')->nullable()->after('file_name')->comment('dalam bytes');
            $table->timestamp('uploaded_at')->nullable()->after('file_size');
        });
    }

    public function down(): void
    {
        Schema::table('dokumen_mbkms', function (Blueprint $table) {
            $table->dropColumn(['file_name', 'file_size', 'uploaded_at']);
        });

        Schema::table('dokumen_mbkms', function (Blueprint $table) {
            $table->renameColumn('kode_dokumen', 'jenis_dokumen');
        });
    }
};
