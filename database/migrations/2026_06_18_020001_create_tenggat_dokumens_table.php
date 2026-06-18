<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenggat_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokumen')->unique()->comment('Kode unik jenis dokumen');
            $table->string('nama_dokumen')->comment('Label tampilan dokumen');
            $table->string('kategori')->comment('Surat Administrasi | Dokumen Akademik | Bimbingan | Output MBKM');
            $table->integer('urutan')->default(0)->comment('Urutan tampil dalam kategori');
            $table->date('tenggat_waktu')->nullable()->comment('Null = tidak ada tenggat');
            $table->boolean('is_prasyarat')->default(false)->comment('Apakah dokumen ini merupakan prasyarat?');
            $table->string('prasyarat_kode')->nullable()->comment('Kode dokumen yang harus diupload lebih dulu');
            $table->string('hint_prasyarat')->nullable()->comment('Teks petunjuk prasyarat');
            $table->boolean('is_wajib')->default(true)->comment('Apakah dokumen wajib?');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenggat_dokumens');
    }
};
