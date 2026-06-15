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
        Schema::create('dokumen_mbkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->string('jenis_dokumen');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_mbkms');
    }
};
