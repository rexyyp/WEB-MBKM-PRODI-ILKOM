<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            $table->string('topik')->nullable()->after('tanggal');
            $table->enum('tipe', ['online', 'offline'])->default('offline')->after('topik');
            $table->time('jam')->nullable()->after('tipe');
            $table->string('link_meeting')->nullable()->after('jam');
        });

        // Tambah nilai 'terjadwal' ke enum status
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE bimbingans MODIFY COLUMN status ENUM('menunggu', 'terjadwal', 'selesai') DEFAULT 'menunggu'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan enum status ke semula
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE bimbingans MODIFY COLUMN status ENUM('menunggu', 'selesai') DEFAULT 'menunggu'");
        }

        Schema::table('bimbingans', function (Blueprint $table) {
            $table->dropColumn(['topik', 'tipe', 'jam', 'link_meeting']);
        });
    }
};
