<?php

namespace Database\Seeders;

use App\Models\TenggantDokumen;
use Illuminate\Database\Seeder;

class TenggantDokumenSeeder extends Seeder
{
    public function run(): void
    {
        $dokumens = [
            // ── Surat Administrasi ────────────────────────────────────────
            [
                'kode_dokumen'   => 'surat_permohonan',
                'nama_dokumen'   => 'Permohonan Mahasiswa → Prodi',
                'kategori'       => 'Surat Administrasi',
                'urutan'         => 1,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => 'Dokumen wajib inisiasi pendaftaran MBKM.',
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'surat_fakultas',
                'nama_dokumen'   => 'Surat Pengantar Fakultas → Perusahaan',
                'kategori'       => 'Surat Administrasi',
                'urutan'         => 2,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => 'Surat pengantar resmi dari pihak fakultas.',
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'surat_penerimaan',
                'nama_dokumen'   => 'Surat Penerimaan Magang',
                'kategori'       => 'Surat Administrasi',
                'urutan'         => 3,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => true,
                'prasyarat_kode' => 'surat_fakultas',
                'hint_prasyarat' => 'Wajib diunggah agar dapat mengakses pengisian Logbook.',
                'is_wajib'       => true,
            ],

            // ── Dokumen Akademik ──────────────────────────────────────────
            [
                'kode_dokumen'   => 'proposal_mbkm',
                'nama_dokumen'   => 'Proposal MBKM',
                'kategori'       => 'Dokumen Akademik',
                'urutan'         => 1,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'laporan_mbkm',
                'nama_dokumen'   => 'Laporan MBKM',
                'kategori'       => 'Dokumen Akademik',
                'urutan'         => 2,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'berita_acara',
                'nama_dokumen'   => 'Berita Acara',
                'kategori'       => 'Dokumen Akademik',
                'urutan'         => 3,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'daftar_hadir',
                'nama_dokumen'   => 'Daftar Hadir',
                'kategori'       => 'Dokumen Akademik',
                'urutan'         => 4,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],

            // ── Bimbingan ─────────────────────────────────────────────────
            [
                'kode_dokumen'   => 'bukti_bimbingan_lapangan',
                'nama_dokumen'   => 'Bukti Bimbingan Pembimbing Lapangan',
                'kategori'       => 'Bimbingan',
                'urutan'         => 1,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'bukti_bimbingan_dosen',
                'nama_dokumen'   => 'Bukti Bimbingan Dosen Pembimbing',
                'kategori'       => 'Bimbingan',
                'urutan'         => 2,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],

            // ── Output MBKM ───────────────────────────────────────────────
            [
                'kode_dokumen'   => 'artikel_publikasi',
                'nama_dokumen'   => 'Artikel / Publikasi / HKI',
                'kategori'       => 'Output MBKM',
                'urutan'         => 1,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => false,
            ],
            [
                'kode_dokumen'   => 'transkrip_nilai_mitra',
                'nama_dokumen'   => 'Transkrip Nilai dari Mitra',
                'kategori'       => 'Output MBKM',
                'urutan'         => 2,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
            [
                'kode_dokumen'   => 'sertifikat_mbkm',
                'nama_dokumen'   => 'Sertifikat MBKM / Paklaring',
                'kategori'       => 'Output MBKM',
                'urutan'         => 3,
                'tenggat_waktu'  => null,
                'is_prasyarat'   => false,
                'prasyarat_kode' => null,
                'hint_prasyarat' => null,
                'is_wajib'       => true,
            ],
        ];

        foreach ($dokumens as $dokumen) {
            TenggantDokumen::updateOrCreate(
                ['kode_dokumen' => $dokumen['kode_dokumen']],
                $dokumen
            );
        }

        $this->command->info('✅ TenggantDokumenSeeder: 12 jenis dokumen berhasil di-seed.');
    }
}
