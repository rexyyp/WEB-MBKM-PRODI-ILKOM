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
        Schema::create('mitra_mbkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->string('bidang_usaha')->nullable();
            $table->text('alamat')->nullable();
            $table->string('narahubung')->nullable();
            $table->string('no_telp_narahubung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_mbkms');
    }
};
