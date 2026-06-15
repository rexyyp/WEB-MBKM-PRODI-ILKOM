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
        Schema::create('pendaftaran_mbkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mitra_mbkm_id')->constrained('mitra_mbkms')->cascadeOnDelete();
            $table->foreignId('program_mbkm_id')->constrained('program_mbkms')->cascadeOnDelete();
            $table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosens')->nullOnDelete();
            $table->foreignId('dosen_penguji_id')->nullable()->constrained('dosens')->nullOnDelete();
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'berjalan', 'selesai'])->default('pending');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_mbkms');
    }
};
