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
        Schema::create('uji_kompetensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->enum('jenis_ujian', ['proposal', 'laporan_akhir']);
            $table->date('tgl_ujian')->nullable();
            $table->float('nilai')->nullable();
            $table->string('file_berkas')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'revisi', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_kompetensis');
    }
};
