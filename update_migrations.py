import os
import re

migrations_dir = "database/migrations"

files = os.listdir(migrations_dir)

schemas = {
    'users': """        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'kaprodi', 'mahasiswa', 'dosen'])->default('mahasiswa');
            $table->rememberToken();
            $table->timestamps();
        });""",
    
    'mahasiswas': """        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nim')->unique();
            $table->string('prodi');
            $table->integer('angkatan');
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });""",
    
    'dosens': """        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nip')->unique();
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });""",

    'mitra_mbkms': """        Schema::create('mitra_mbkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->string('bidang_usaha')->nullable();
            $table->text('alamat')->nullable();
            $table->string('narahubung')->nullable();
            $table->string('no_telp_narahubung')->nullable();
            $table->timestamps();
        });""",

    'program_mbkms': """        Schema::create('program_mbkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });""",

    'mata_kuliahs': """        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester');
            $table->timestamps();
        });""",

    'pendaftaran_mbkms': """        Schema::create('pendaftaran_mbkms', function (Blueprint $table) {
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
        });""",

    'logbooks': """        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->string('file_bukti')->nullable();
            $table->enum('status_validasi', ['pending', 'disetujui', 'revisi'])->default('pending');
            $table->timestamps();
        });""",

    'bimbingans': """        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->date('tanggal');
            $table->text('catatan_mahasiswa')->nullable();
            $table->text('catatan_dosen')->nullable();
            $table->enum('status', ['menunggu', 'selesai'])->default('menunggu');
            $table->timestamps();
        });""",

    'dokumen_mbkms': """        Schema::create('dokumen_mbkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->string('jenis_dokumen');
            $table->string('file_path');
            $table->timestamps();
        });""",

    'uji_kompetensis': """        Schema::create('uji_kompetensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->enum('jenis_ujian', ['proposal', 'laporan_akhir']);
            $table->date('tgl_ujian')->nullable();
            $table->float('nilai')->nullable();
            $table->string('file_berkas')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'revisi', 'selesai'])->default('menunggu');
            $table->timestamps();
        });""",

    'konversi_sks': """        Schema::create('konversi_sks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->string('file_transkrip_mitra')->nullable();
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });""",

    'detail_konversi_sks': """        Schema::create('detail_konversi_sks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konversi_sks_id')->constrained('konversi_sks')->cascadeOnDelete();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->cascadeOnDelete();
            $table->float('nilai_diakui')->nullable();
            $table->timestamps();
        });""",

    'penilaians': """        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_mbkm_id')->constrained('pendaftaran_mbkms')->cascadeOnDelete();
            $table->enum('jenis_penilai', ['pembimbing', 'penguji', 'mitra']);
            $table->float('nilai_total')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });"""
}

for file in files:
    for key, schema in schemas.items():
        if "create_" + key + "_table" in file or (key == 'users' and "create_users_table" in file) or (key == 'konversi_sks' and 'create_konversi_sks_table' in file):
            path = os.path.join(migrations_dir, file)
            with open(path, 'r') as f:
                content = f.read()
            
            # replace Schema::create block
            pattern = r"        Schema::create\('" + key + r"', function \(Blueprint \$table\) \{.*?        \}\);"
            
            new_content = re.sub(pattern, schema, content, flags=re.DOTALL)
            
            if new_content != content:
                with open(path, 'w') as f:
                    f.write(new_content)
                print(f"Updated {file}")
