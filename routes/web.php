<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaprodiController;

// Root route - redirect ke dashboard mahasiswa
Route::get('/', [MahasiswaController::class, 'dashboard']);

// Kaprodi Routes
Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [KaprodiController::class, 'dashboard'])->name('index');
    });
    
    Route::prefix('data-mahasiswa')->name('data-mahasiswa.')->group(function () {
        Route::get('/', [KaprodiController::class, 'dataMahasiswa'])->name('index');
    });
    
    Route::prefix('mitra-mbkm')->name('mitra-mbkm.')->group(function () {
        Route::get('/', [KaprodiController::class, 'mitraMbkm'])->name('index');
        Route::get('/{id}', [KaprodiController::class, 'mitraMbkmDetail'])->name('detail');
    });
    
    Route::prefix('assign-pembimbing')->name('assign-pembimbing.')->group(function () {
        Route::get('/', [KaprodiController::class, 'assignPembimbing'])->name('index');
    });
    
    Route::prefix('penilaian-mbkm')->name('penilaian-mbkm.')->group(function () {
        Route::get('/', [KaprodiController::class, 'penilaianMbkm'])->name('index');
        Route::get('/form', [KaprodiController::class, 'penilaianForm'])->name('form');
    });
    
    Route::prefix('konversi-sks')->name('konversi-sks.')->group(function () {
        Route::get('/', [KaprodiController::class, 'konversiSks'])->name('index');
    });
    
    Route::prefix('laporan-mbkm')->name('laporan-mbkm.')->group(function () {
        Route::get('/', [KaprodiController::class, 'laporanMbkm'])->name('index');
    });
    
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::view('/', 'kaprodi.monitoring.index')->name('index');
    });
});

// Auth Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');
    Route::get('/pending-confirmation', [AuthController::class, 'pendingConfirmation'])->name('pending');
});

// Mahasiswa Routes (with prefix)
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    
    Route::prefix('data-mbkm')->name('data-mbkm.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'dataMbkm'])->name('index');
    });
    
    Route::prefix('pembimbing')->name('pembimbing.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'pembimbing'])->name('index');
    });
    
    Route::prefix('dokumen')->name('dokumen.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'dokumen'])->name('index');
    });
    
    Route::prefix('logbook')->name('logbook.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'logbook'])->name('index');
        Route::get('/create', [MahasiswaController::class, 'createLogbook'])->name('create');
    });
    
    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'penilaian'])->name('index');
    });
    
    Route::prefix('konversi-mk')->name('konversi-mk.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'konversiMk'])->name('index');
        Route::get('/create', [MahasiswaController::class, 'createKonversiMk'])->name('create');
        Route::post('/', [MahasiswaController::class, 'storeKonversiMk'])->name('store');
    });
    
    Route::prefix('uji-kompetensi')->name('uji-kompetensi.')->group(function () {
        Route::view('/proposal', 'mahasiswa.uji-kompetensi.proposal')->name('proposal');
        Route::view('/laporan-akhir', 'mahasiswa.uji-kompetensi.laporan-akhir')->name('laporan-akhir');
    });
    
    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::view('/', 'mahasiswa.bimbingan.index')->name('index');
    });
    
});

// Dosen Pembimbing Routes (with prefix)
Route::prefix('dosen-pembimbing')->name('dosen-pembimbing.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DosenPembimbingController::class, 'dashboard'])->name('index');
    });
    
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [DosenPembimbingController::class, 'mahasiswa'])->name('index');
    });
    
    Route::prefix('logbook')->name('logbook.')->group(function () {
        Route::get('/', [DosenPembimbingController::class, 'logbook'])->name('index');
    });
    
    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/', [DosenPembimbingController::class, 'penilaian'])->name('index');
    });
    
    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::view('/', 'dosen-pembimbing.bimbingan.index')->name('index');
    });
});

// Welcome page (optional)
// Route::get('/', function () {
//     return view('welcome');
// });
