<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan dashboard mahasiswa
     */
    public function dashboard()
    {
        return view('mahasiswa.dashboard');
    }

    /**
     * Menampilkan data MBKM
     */
    public function dataMbkm()
    {
        return view('mahasiswa.data-mbkm.index');
    }

    /**
     * Menampilkan halaman pembimbing
     */
    public function pembimbing()
    {
        return view('mahasiswa.pembimbing.index');
    }

    /**
     * Menampilkan halaman dokumen
     */
    public function dokumen()
    {
        return view('mahasiswa.dokumen.index');
    }

    /**
     * Menampilkan halaman logbook
     */
    public function logbook()
    {
        return view('mahasiswa.logbook.index');
    }

    /**
     * Menampilkan form tambah logbook
     */
    public function createLogbook()
    {
        return view('mahasiswa.logbook.create');
    }

    /**
     * Menampilkan halaman penilaian
     */
    public function penilaian()
    {
        return view('mahasiswa.penilaian.index');
    }

    /**
     * Menampilkan halaman konversi mata kuliah
     */
    public function konversiMk()
    {
        return view('mahasiswa.konversi-mk.index');
    }

    /**
     * Menampilkan form tambah mata kuliah konversi
     */
    public function createKonversiMk()
    {
        return view('mahasiswa.konversi-mk.create');
    }

    /**
     * Simpan mata kuliah konversi
     */
    public function storeKonversiMk()
    {
        // Logic akan diimplementasikan setelah database integration
        return redirect()->route('mahasiswa.konversi-mk.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }
}
