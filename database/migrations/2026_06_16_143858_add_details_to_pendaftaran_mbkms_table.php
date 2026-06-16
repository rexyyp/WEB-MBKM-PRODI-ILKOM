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
        Schema::table('pendaftaran_mbkms', function (Blueprint $table) {
            $table->string('posisi_magang')->nullable()->after('program_mbkm_id');
            $table->text('detail_pekerjaan')->nullable()->after('posisi_magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_mbkms', function (Blueprint $table) {
            $table->dropColumn(['posisi_magang', 'detail_pekerjaan']);
        });
    }
};
