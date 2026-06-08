<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    /**
     * Menampilkan dashboard kaprodi
     */
    public function dashboard()
    {
        return view('kaprodi.dashboard');
    }

    /**
     * Menampilkan data mahasiswa MBKM
     */
    public function dataMahasiswa()
    {
        return view('kaprodi.data-mahasiswa');
    }

    /**
     * Menampilkan daftar mitra MBKM
     */
    public function mitraMbkm()
    {
        return view('kaprodi.mitra-mbkm.index');
    }

    /**
     * Menampilkan detail mitra MBKM beserta daftar mahasiswa magang
     */
    public function mitraMbkmDetail($id)
    {
        return view('kaprodi.mitra-mbkm.detail', compact('id'));
    }
    /**
     * Menampilkan halaman assign pembimbing & penguji
     */
    public function assignPembimbing()
    {
        return view('kaprodi.assign-pembimbing.index');
    }
    /**
     * Menampilkan halaman penilaian MBKM
     */
    public function penilaianMbkm()
    {
        return view('kaprodi.penilaian-mbkm.index');
    }
    
    /**
     * Menampilkan halaman form penilaian dan konversi
     */
    public function penilaianForm()
    {
        return view('kaprodi.penilaian-mbkm.form');
    }
    /**
     * Menampilkan halaman Laporan MBKM
     */
    public function laporanMbkm()
    {
        return view('kaprodi.laporan-mbkm.index');
    }

    /**
     * Menampilkan halaman Form Konversi SKS MBKM
     */
    public function konversiSks()
    {
        return view('kaprodi.penilaian-mbkm.konversi');
    }
}
