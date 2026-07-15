<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;

// ── Root Route ──────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// ── Auth Routes (Guest Only) ─────────────────────────────────────────
Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {
    Route::get('/login',    [AuthController::class, 'login'])->name('login');
    Route::post('/login',   [AuthController::class, 'processLogin'])->name('login.process');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register',[AuthController::class, 'processRegister'])->name('register.process');
    
    // Quick Switch untuk testing
    Route::get('/quick-switch', [AuthController::class, 'quickSwitch'])->name('quick-switch');
    Route::post('/quick-login', [AuthController::class, 'quickLogin'])->name('quick-login');
});

// Route alias login untuk menghindari RouteNotFoundException dari middleware default Laravel
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Halaman pending bisa diakses siapa saja (guest maupun setelah logout)
Route::get('/auth/pending-confirmation', [AuthController::class, 'pendingConfirmation'])->name('auth.pending');

// Logout harus sudah login
Route::get('/auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

// ── Admin Routes ─────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen Pendaftar (mahasiswa menunggu konfirmasi)
    Route::prefix('pendaftar')->name('pendaftar.')->group(function () {
        Route::get('/',            [AdminController::class, 'pendaftar'])->name('index');
        Route::post('/{id}/konfirmasi', [AdminController::class, 'konfirmasi'])->name('confirm');
        Route::post('/{id}/tolak',      [AdminController::class, 'tolak'])->name('reject');
    });

    // Manajemen Mahasiswa Aktif
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [AdminController::class, 'mahasiswa'])->name('index');
    });

    // Manajemen Dosen
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/',        [AdminController::class, 'dosen'])->name('index');
        Route::get('/create',  [AdminController::class, 'createDosen'])->name('create');
        Route::post('/',       [AdminController::class, 'storeDosen'])->name('store');
        Route::delete('/{id}', [AdminController::class, 'destroyDosen'])->name('destroy');
    });

    // Manajemen Kaprodi
    Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
        Route::get('/',        [AdminController::class, 'kaprodi'])->name('index');
        Route::get('/create',  [AdminController::class, 'createKaprodi'])->name('create');
        Route::post('/',       [AdminController::class, 'storeKaprodi'])->name('store');
        Route::delete('/{id}', [AdminController::class, 'destroyKaprodi'])->name('destroy');
    });

    // Route-route admin lainnya (placeholder untuk admin.mitra, admin.assign, dll.)
    Route::prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/',        [AdminController::class, 'mitra'])->name('index');
        Route::get('/create',  [AdminController::class, 'createMitra'])->name('create');
        Route::post('/',       [AdminController::class, 'storeMitra'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editMitra'])->name('edit');
        Route::put('/{id}',    [AdminController::class, 'updateMitra'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroyMitra'])->name('destroy');
    });
    
    Route::get('/assign',     fn() => view('admin.assign.index'))->name('assign.index');
    Route::get('/monitoring', fn() => view('admin.monitoring.index'))->name('monitoring.index');
    Route::get('/penilaian',  fn() => view('admin.penilaian.index'))->name('penilaian.index');
    Route::get('/laporan',    fn() => view('admin.laporan.index'))->name('laporan.index');

    // Manajemen Tenggat Dokumen
    Route::prefix('tenggat-dokumen')->name('tenggat-dokumen.')->group(function () {
        Route::get('/',        [AdminController::class, 'tenggat'])->name('index');
        Route::put('/{id}',    [AdminController::class, 'updateTenggat'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'resetTenggat'])->name('reset');
    });

    // Hapus Kaprodi (dipindahkan dari controller)
    Route::delete('/kaprodi/{id}', [AdminController::class, 'destroyKaprodi'])->name('kaprodi.destroy');
});

// ── Kaprodi Routes ───────────────────────────────────────────────────
Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [KaprodiController::class, 'dashboard'])->name('index');
    });

    Route::prefix('data-mahasiswa')->name('data-mahasiswa.')->group(function () {
        Route::get('/', [KaprodiController::class, 'dataMahasiswa'])->name('index');
    });

    Route::prefix('mitra-mbkm')->name('mitra-mbkm.')->group(function () {
        Route::get('/',    [KaprodiController::class, 'mitraMbkm'])->name('index');
        Route::get('/{id}',[KaprodiController::class, 'mitraMbkmDetail'])->name('detail');
    });

    Route::prefix('assign-pembimbing')->name('assign-pembimbing.')->group(function () {
        Route::get('/', [KaprodiController::class, 'assignPembimbing'])->name('index');
        Route::post('/{id}', [KaprodiController::class, 'storeAssignPembimbing'])->name('store');
    });

    Route::prefix('penilaian-mbkm')->name('penilaian-mbkm.')->group(function () {
        Route::get('/',         [KaprodiController::class, 'penilaianMbkm'])->name('index');
        Route::get('/{id}',     [KaprodiController::class, 'penilaianForm'])->name('form');
        Route::post('/{id}',    [KaprodiController::class, 'simpanPenilaian'])->name('simpan');
    });

    Route::prefix('konversi-sks')->name('konversi-sks.')->group(function () {
        Route::get('/',           [KaprodiController::class, 'konversiSks'])->name('index');
        Route::post('/{id}/acc',  [KaprodiController::class, 'accKonversi'])->name('acc');
    });

    Route::prefix('laporan-mbkm')->name('laporan-mbkm.')->group(function () {
        Route::get('/', [KaprodiController::class, 'laporanMbkm'])->name('index');
    });

    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [KaprodiController::class, 'monitoring'])->name('index');
    });
});

// ── Mahasiswa Routes ─────────────────────────────────────────────────
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');

    Route::prefix('data-mbkm')->name('data-mbkm.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'dataMbkm'])->name('index');
        Route::post('/', [MahasiswaController::class, 'storeDataMbkm'])->name('store');
    });

    Route::prefix('pembimbing')->name('pembimbing.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'pembimbing'])->name('index');
        Route::post('/update-lapangan', [MahasiswaController::class, 'updatePembimbingLapangan'])->name('update-lapangan');
    });

    Route::prefix('dokumen')->name('dokumen.')->group(function () {
        Route::get('/',            [MahasiswaController::class, 'dokumen'])->name('index');
        Route::post('/upload',     [MahasiswaController::class, 'uploadDokumen'])->name('upload');
        Route::delete('/{id}',     [MahasiswaController::class, 'deleteDokumen'])->name('delete');
        Route::get('/{id}/download', [MahasiswaController::class, 'downloadDokumen'])->name('download');
    });

    Route::prefix('logbook')->name('logbook.')->group(function () {
        Route::get('/',       [MahasiswaController::class, 'logbook'])->name('index');
        Route::get('/create', [MahasiswaController::class, 'createLogbook'])->name('create');
        Route::post('/',      [MahasiswaController::class, 'storeLogbook'])->name('store');
    });

    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'penilaian'])->name('index');
    });

    Route::prefix('konversi-mk')->name('konversi-mk.')->group(function () {
        Route::get('/',                    [MahasiswaController::class, 'konversiMk'])->name('index');
        Route::get('/create',              [MahasiswaController::class, 'createKonversiMk'])->name('create');
        Route::post('/',                   [MahasiswaController::class, 'storeKonversiMk'])->name('store');
        Route::get('/{id}/edit',           [MahasiswaController::class, 'editKonversiMk'])->name('edit');
        Route::put('/{id}',                [MahasiswaController::class, 'updateKonversiMk'])->name('update');
        Route::delete('/{id}',             [MahasiswaController::class, 'destroyKonversiMk'])->name('destroy');
        Route::post('/ajukan',             [MahasiswaController::class, 'ajukanKonversi'])->name('ajukan');
    });

    Route::prefix('uji-kompetensi')->name('uji-kompetensi.')->group(function () {
        Route::get('/proposal',      [MahasiswaController::class, 'proposal'])->name('proposal');
        Route::post('/proposal',     [MahasiswaController::class, 'storeProposal'])->name('proposal.store');
        Route::get('/laporan-akhir', [MahasiswaController::class, 'laporanAkhir'])->name('laporan-akhir');
        Route::post('/laporan-akhir',[MahasiswaController::class, 'storeLaporanAkhir'])->name('laporan-akhir.store');
    });

    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'bimbingan'])->name('index');
        Route::post('/', [MahasiswaController::class, 'storeBimbingan'])->name('store');
    });
});

// ── Dosen Pembimbing Routes ───────────────────────────────────────────
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
        Route::get('/',    [DosenPembimbingController::class, 'penilaian'])->name('index');
        Route::post('/',   [DosenPembimbingController::class, 'simpanPenilaian'])->name('simpan');
    });

    Route::prefix('bimbingan')->name('bimbingan.')->group(function () {
        Route::view('/', 'dosen-pembimbing.bimbingan.index')->name('index');
    });
});

// ── Dosen Penguji Routes ──────────────────────────────────────────────
Route::prefix('dosen-penguji')->name('dosen-penguji.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [\App\Http\Controllers\DosenPengujiController::class, 'dashboard'])->name('index');
    });

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [\App\Http\Controllers\DosenPengujiController::class, 'mahasiswa'])->name('index');
    });

    Route::prefix('uji-kompetensi')->name('uji-kompetensi.')->group(function () {
        Route::view('/proposal', 'dosen-penguji.uji-kompetensi.proposal')->name('proposal');
        Route::view('/laporan',  'dosen-penguji.uji-kompetensi.laporan')->name('laporan');
    });

    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::view('/', 'dosen-penguji.penilaian.index')->name('index');
    });
});
