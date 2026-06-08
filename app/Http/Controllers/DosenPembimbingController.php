<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenPembimbingController extends Controller
{
    /**
     * Show the Dosen Dashboard
     */
    public function dashboard()
    {
        return view('dosen-pembimbing.dashboard');
    }

    /**
     * Show the Mahasiswa Bimbingan list
     */
    public function mahasiswa()
    {
        return view('dosen-pembimbing.mahasiswa.index');
    }

    /**
     * Show the Logbook review page
     */
    public function logbook()
    {
        return view('dosen-pembimbing.logbook.index');
    }

    /**
     * Show the Penilaian page
     */
    public function penilaian()
    {
        return view('dosen-pembimbing.penilaian.index');
    }
}
