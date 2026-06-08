/**
 * CONTOH PENGGUNAAN COMPONENTS
 * 
 * Panduan lengkap menggunakan Blade Components
 * yang telah dibuat untuk MBKM System
 */

<!-- ===== CONTOH 1: MENGGUNAKAN STAT CARD ===== -->
<!-- File: resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <!-- Menggunakan Stat Card Component -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <x-cards.stat-card 
            title="Total Mahasiswa" 
            value="245"
            color="blue"
        />
        
        <x-cards.stat-card 
            title="Total Mitra" 
            value="42"
            color="green"
        />
        
        <x-cards.stat-card 
            title="Total Dosen" 
            value="18"
            color="yellow"
        />
        
        <x-cards.stat-card 
            title="Penempatan Aktif" 
            value="198"
            color="purple"
        />
    </div>
@endsection


<!-- ===== CONTOH 2: MENGGUNAKAN STATUS BADGE ===== -->
<!-- File: resources/views/admin/mahasiswa/index.blade.php -->

<table class="w-full">
    <tbody>
        <tr>
            <td>Adi Permana</td>
            <td>2301001</td>
            <td>
                <!-- Menggunakan Status Badge -->
                <x-badges.status status="active" />
            </td>
        </tr>
        <tr>
            <td>Citra Dewi</td>
            <td>2301005</td>
            <td>
                <x-badges.status status="pending" />
            </td>
        </tr>
    </tbody>
</table>


<!-- ===== CONTOH 3: MENGGUNAKAN FORM INPUT ===== -->
<!-- File: resources/views/admin/mahasiswa/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Tambah Mahasiswa Baru</h1>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf

            <!-- Menggunakan Form Input Component -->
            <x-forms.input 
                label="NIM" 
                name="nim" 
                type="text" 
                placeholder="Masukkan NIM"
                required
            />

            <x-forms.input 
                label="Nama Lengkap" 
                name="name" 
                type="text" 
                placeholder="Masukkan nama"
                required
            />

            <x-forms.input 
                label="Email" 
                name="email" 
                type="email" 
                placeholder="user@email.com"
                required
            />

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
                <button type="reset" class="bg-slate-300 text-slate-700 px-6 py-2 rounded-lg hover:bg-slate-400">
                    Batal
                </button>
            </div>
        </form>
    </div>
@endsection


<!-- ===== CONTOH 4: MENGGUNAKAN DATA CARD ===== -->
<!-- File: resources/views/mahasiswa/pembimbing/index.blade.php -->

<div class="grid grid-cols-2 gap-6">
    <x-cards.data-card title="Dosen Pembimbing" subtitle="Informasi dosen pembimbing akademik">
        <div>
            <label class="text-sm text-slate-600">Nama</label>
            <p class="font-medium text-slate-900">Dr. Budi Santoso</p>
        </div>
        <div>
            <label class="text-sm text-slate-600">Email</label>
            <p class="font-medium text-slate-900">budi@univ.ac.id</p>
        </div>
    </x-cards.data-card>

    <x-cards.data-card title="Mentor Industri" subtitle="Informasi mentor dari perusahaan">
        <div>
            <label class="text-sm text-slate-600">Nama</label>
            <p class="font-medium text-slate-900">Ahmad Wijaya</p>
        </div>
        <div>
            <label class="text-sm text-slate-600">Divisi</label>
            <p class="font-medium text-slate-900">Backend Development</p>
        </div>
    </x-cards.data-card>
</div>


<!-- ===== CONTOH 5: MENGGUNAKAN MODAL CONFIRM ===== -->
<!-- File: resources/views/admin/mahasiswa/index.blade.php -->

<table class="w-full">
    <tbody>
        <tr>
            <td>Adi Permana</td>
            <td>
                <button onclick="document.getElementById('deleteModal1').classList.remove('hidden')" 
                    class="text-red-600 hover:text-red-800">
                    Hapus
                </button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal Component -->
<x-modals.confirm 
    id="deleteModal1"
    title="Konfirmasi Hapus"
    message="Anda yakin ingin menghapus data Adi Permana? Tindakan ini tidak dapat dibatalkan."
    confirmText="Hapus Data"
    cancelText="Batal"
/>


<!-- ===== CONTOH 6: LAYOUT STRUCTURE ===== -->
<!-- File: resources/views/dosen/mahasiswa/index.blade.php -->

@extends('layouts.dosen')

@section('title', 'Mahasiswa Bimbing - Dosen')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Mahasiswa Bimbing</h1>
        <p class="text-slate-600">Kelola mahasiswa yang Anda bimbing</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <input type="text" placeholder="Cari mahasiswa..." 
            class="w-full px-4 py-2 border border-slate-300 rounded-lg">
    </div>

    <!-- Content Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <!-- Table content -->
        </table>
    </div>
@endsection


<!-- ===== CONTOH 7: RESPONSIVE GRID ===== -->

<!-- Untuk 4 kolom di desktop, 2 di tablet, 1 di mobile -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <x-cards.stat-card title="Stat 1" value="100" />
    <x-cards.stat-card title="Stat 2" value="200" />
    <x-cards.stat-card title="Stat 3" value="300" />
    <x-cards.stat-card title="Stat 4" value="400" />
</div>


<!-- ===== CONTOH 8: DENGAN CUSTOM SLOT ===== -->

<x-cards.data-card title="Informasi Personal">
    <div>
        <label class="text-sm text-slate-600">NIM</label>
        <p class="font-medium text-slate-900">2301001</p>
    </div>
    <div>
        <label class="text-sm text-slate-600">Nama</label>
        <p class="font-medium text-slate-900">Adi Permana</p>
    </div>
</x-cards.data-card>


<!-- ===== CONTOH 9: KOMBINASI MULTIPLE COMPONENTS ===== -->

<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-4 gap-4">
        <x-cards.stat-card title="Total" value="100" color="blue" />
        <x-cards.stat-card title="Aktif" value="80" color="green" />
        <x-cards.stat-card title="Pending" value="15" color="yellow" />
        <x-cards.stat-card title="Selesai" value="5" color="purple" />
    </div>

    <!-- Table with Status Badges -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <tr>
                <td>Item 1</td>
                <td><x-badges.status status="active" /></td>
            </tr>
            <tr>
                <td>Item 2</td>
                <td><x-badges.status status="pending" /></td>
            </tr>
        </table>
    </div>
</div>


<!-- ===== TIPS PENGGUNAAN ===== -->

/*
1. WARNA TAILWIND:
   - Admin: blue
   - Dosen: green
   - Mahasiswa: purple
   
   Contoh: color="blue", color="green", color="purple"

2. STATUS BADGE VALUES:
   - 'active' = Hijau (Aktif)
   - 'inactive' = Merah (Tidak Aktif)
   - 'pending' = Kuning (Menunggu)
   - 'approved' = Biru (Disetujui)
   - 'rejected' = Merah (Ditolak)

3. RESPONSIVE GRID:
   grid-cols-1         = 1 kolom (mobile)
   md:grid-cols-2      = 2 kolom (tablet)
   lg:grid-cols-4      = 4 kolom (desktop)

4. SPACING TAILWIND:
   mb-6 = margin-bottom (1.5rem)
   p-6  = padding (1.5rem)
   gap-4 = gap between items (1rem)

5. BEST PRACTICES:
   - Selalu gunakan @extends untuk layout
   - Selalu set @section('title', '...')
   - Gunakan components untuk DRY code
   - Maintain konsistensi naming
   - Test responsive design
*/
