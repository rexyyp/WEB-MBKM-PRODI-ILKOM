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
        Schema::table('mitra_mbkms', function (Blueprint $table) {
            $table->dropColumn('bidang_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitra_mbkms', function (Blueprint $table) {
            $table->string('bidang_usaha', 255)->nullable()->after('nama_mitra');
        });
    }
};
