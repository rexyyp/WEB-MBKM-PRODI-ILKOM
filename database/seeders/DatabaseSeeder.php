<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil AdminSeeder
        $this->call([
            AdminSeeder::class,
        ]);

        // Buat user mahasiswa Rexy (aktif, tidak punya data MBKM)
        $userRexy = User::create([
            'name' => 'Rexy Mahasiswa',
            'email' => 'rexy@student.upi.edu',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
            'is_active' => true,
        ]);

        \App\Models\Mahasiswa::create([
            'user_id' => $userRexy->id,
            'nim' => '2100001',
            'angkatan' => 2021,
            'prodi' => 'Ilmu Komputer',
        ]);

        // Buat user mahasiswa dengan data MBKM (untuk testing)
        $userWithMbkm = User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@student.upi.edu',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
            'is_active' => true,
        ]);

        $mahasiswaAndi = \App\Models\Mahasiswa::create([
            'user_id' => $userWithMbkm->id,
            'nim' => '2100002',
            'angkatan' => 2021,
            'prodi' => 'Ilmu Komputer',
        ]);

        // Buat mitra untuk testing
        $mitra = \App\Models\MitraMbkm::create([
            'nama_mitra' => 'PT Teknologi Nusantara',
            'bidang_usaha' => 'Teknologi Informasi',
            'alamat' => 'Jl. Gatot Subroto No. 12, Kuningan Timur, Jakarta Selatan 12950',
            'lokasi' => 'Jakarta Selatan',
            'narahubung' => 'Budi Santoso',
            'no_telp_narahubung' => '081234567890',
        ]);

        // Buat program MBKM
        $program = \App\Models\ProgramMbkm::create([
            'nama_program' => 'Magang Mandiri',
            'deskripsi' => 'Program magang mandiri di industri',
        ]);

        // Buat pendaftaran MBKM untuk Andi
        \App\Models\PendaftaranMbkm::create([
            'mahasiswa_id' => $mahasiswaAndi->id,
            'mitra_mbkm_id' => $mitra->id,
            'program_mbkm_id' => $program->id,
            'posisi_magang' => 'Frontend Developer',
            'detail_pekerjaan' => 'Mengembangkan aplikasi web menggunakan React.js dan mengintegrasikan dengan backend API',
            'status' => 'berjalan',
            'tgl_mulai' => '2026-02-01',
            'tgl_selesai' => '2026-06-30',
        ]);

        // Buat dosen untuk testing
        $userDosen = User::create([
            'name' => 'Dr. Siti Nurhaliza',
            'email' => 'siti@upi.edu',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'is_active' => true,
        ]);

        \App\Models\Dosen::create([
            'user_id' => $userDosen->id,
            'nip' => '198501012010122001',
            'jenis_dosen' => 'pembimbing', // ✅ Dosen Pembimbing
            'no_telp' => '081234567890',
        ]);

        // Buat dosen penguji untuk testing
        $userDosenPenguji = User::create([
            'name' => 'Prof. Dr. Budi Santoso',
            'email' => 'budi.santoso@upi.edu',
            'password' => bcrypt('password'),
            'role' => 'dosen',
            'is_active' => true,
        ]);

        \App\Models\Dosen::create([
            'user_id' => $userDosenPenguji->id,
            'nip' => '197505102005011002',
            'jenis_dosen' => 'penguji', // ✅ Dosen Penguji
            'no_telp' => '081298765432',
        ]);
    }
}
