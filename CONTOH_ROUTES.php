/**
 * CONTOH ROUTES SETUP UNTUK MBKM SYSTEM
 * 
 * File: routes/web.php
 * 
 * Salin dan sesuaikan dengan struktur project Anda
 */

<?php

use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Mahasiswa Management
    Route::resource('/mahasiswa', AdminMahasiswaController::class)->names('mahasiswa');
    
    // Mitra Management
    Route::resource('/mitra', AdminMitraController::class)->names('mitra');
    
    // Penugasan Pembimbing
    Route::resource('/assign', AdminAssignController::class)->names('assign');
    
    // Monitoring
    Route::get('/monitoring', [AdminMonitoringController::class, 'index'])->name('monitoring.index');
    
    // Penilaian
    Route::get('/penilaian', [AdminPenilaianController::class, 'index'])->name('penilaian.index');
    
    // Laporan
    Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/download/{type}', [AdminLaporanController::class, 'download'])->name('laporan.download');
});

// ============================================
// DOSEN ROUTES
// ============================================
Route::middleware(['auth', 'dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
    
    // Mahasiswa Bimbing
    Route::get('/mahasiswa', [DosenMahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/{id}', [DosenMahasiswaController::class, 'show'])->name('mahasiswa.show');
    
    // Logbook
    Route::get('/logbook', [DosenLogbookController::class, 'index'])->name('logbook.index');
    Route::get('/logbook/{id}', [DosenLogbookController::class, 'show'])->name('logbook.show');
    Route::post('/logbook/{id}/approve', [DosenLogbookController::class, 'approve'])->name('logbook.approve');
    
    // Penilaian
    Route::get('/penilaian', [DosenPenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian/store', [DosenPenilaianController::class, 'store'])->name('penilaian.store');
});

// ============================================
// MAHASISWA ROUTES
// ============================================
Route::middleware(['auth', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    
    // Data MBKM
    Route::get('/data-mbkm', [MahasiswaDataMbkmController::class, 'index'])->name('data-mbkm.index');
    
    // Pembimbing
    Route::get('/pembimbing', [MahasiswaPembimbingController::class, 'index'])->name('pembimbing.index');
    
    // Dokumen
    Route::get('/dokumen', [MahasiswaDokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/dokumen/upload', [MahasiswaDokumenController::class, 'upload'])->name('dokumen.upload');
    
    // Logbook
    Route::get('/logbook', [MahasiswaLogbookController::class, 'index'])->name('logbook.index');
    Route::get('/logbook/create', [MahasiswaLogbookController::class, 'create'])->name('logbook.create');
    Route::post('/logbook', [MahasiswaLogbookController::class, 'store'])->name('logbook.store');
    
    // Penilaian
    Route::get('/penilaian', [MahasiswaPenilaianController::class, 'index'])->name('penilaian.index');
});

// ============================================
// FALLBACK
// ============================================
Route::fallback(function () {
    return view('errors.404');
});
