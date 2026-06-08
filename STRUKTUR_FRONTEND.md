## Struktur Frontend Laravel Blade MBKM System

Dokumentasi lengkap penggunaan struktur frontend yang telah dibuat.

### 📋 Daftar Isi

1. Struktur Folder
2. Penjelasan Tiap Folder
3. Cara Menggunakan Layout
4. Cara Menggunakan Components
5. Best Practices

---

### 1. Struktur Folder

```
resources/views/
├── layouts/
│   ├── app.blade.php           # Layout master utama
│   ├── admin.blade.php          # Layout khusus admin
│   ├── dosen.blade.php          # Layout khusus dosen
│   └── mahasiswa.blade.php      # Layout khusus mahasiswa
│
├── components/
│   ├── navbar/
│   │   ├── admin-navbar.blade.php
│   │   ├── dosen-navbar.blade.php
│   │   └── mahasiswa-navbar.blade.php
│   ├── sidebar/
│   │   ├── admin-sidebar.blade.php
│   │   ├── dosen-sidebar.blade.php
│   │   └── mahasiswa-sidebar.blade.php
│   ├── footer/
│   │   └── footer.blade.php
│   ├── cards/
│   │   ├── stat-card.blade.php
│   │   └── data-card.blade.php
│   ├── badges/
│   │   └── status.blade.php
│   ├── forms/
│   │   └── input.blade.php
│   └── modals/
│       └── confirm.blade.php
│
├── admin/
│   ├── dashboard.blade.php
│   ├── mahasiswa/
│   │   ├── index.blade.php
│   │   └── detail.blade.php
│   ├── mitra/
│   │   └── index.blade.php
│   ├── assign/
│   │   └── index.blade.php
│   ├── monitoring/
│   │   └── index.blade.php
│   ├── penilaian/
│   │   └── index.blade.php
│   └── laporan/
│       └── index.blade.php
│
├── dosen/
│   ├── dashboard.blade.php
│   ├── mahasiswa/
│   │   └── index.blade.php
│   ├── logbook/
│   │   └── index.blade.php
│   └── penilaian/
│       └── index.blade.php
│
└── mahasiswa/
    ├── dashboard.blade.php
    ├── data-mbkm/
    │   └── index.blade.php
    ├── pembimbing/
    │   └── index.blade.php
    ├── dokumen/
    │   └── index.blade.php
    ├── logbook/
    │   └── index.blade.php
    └── penilaian/
        └── index.blade.php
```

---

### 2. Penjelasan Tiap Folder

#### **layouts/**

Menyimpan struktur HTML utama halaman. Terdapat 4 layout:

- **app.blade.php** - Layout dasar master dengan yield untuk navbar, sidebar, content, footer
- **admin.blade.php** - Extends app + menggunakan navbar/sidebar admin
- **dosen.blade.php** - Extends app + menggunakan navbar/sidebar dosen
- **mahasiswa.blade.php** - Extends app + menggunakan navbar/sidebar mahasiswa

#### **components/navbar/**

Komponen navigasi top bar untuk masing-masing role

- Menampilkan logo, nama role, notifikasi, dan profile user
- Warna berbeda untuk setiap role (blue=admin, green=dosen, purple=mahasiswa)

#### **components/sidebar/**

Komponen menu samping untuk masing-masing role

- Menu navigasi disesuaikan dengan akses role
- Styling konsisten dengan Tailwind CSS

#### **components/footer/**

Komponen footer yang reusable untuk semua halaman

#### **components/cards/**

Komponen kartu/card reusable:

- **stat-card.blade.php** - Kartu statistik dengan icon dan value
- **data-card.blade.php** - Kartu untuk menampilkan data/info

#### **components/badges/**

Komponen badge untuk status:

- **status.blade.php** - Badge dengan warna berbeda sesuai status

#### **components/forms/**

Komponen form yang reusable:

- **input.blade.php** - Input field dengan label dan validasi

#### **components/modals/**

Komponen modal popup:

- **confirm.blade.php** - Modal konfirmasi aksi

#### **admin/, dosen/, mahasiswa/**

Folder halaman khusus setiap role:

- Sub-folder untuk mengelompokkan halaman sejenis
- Struktur CRUD: index, create, edit, show (jika diperlukan)

---

### 3. Cara Menggunakan Layout

#### **Menggunakan layout untuk halaman Admin:**

```blade
@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
    <h1>Welcome to Admin Dashboard</h1>
@endsection
```

#### **Menggunakan layout untuk halaman Dosen:**

```blade
@extends('layouts.dosen')

@section('title', 'Dashboard - Dosen')

@section('content')
    <h1>Welcome to Dosen Dashboard</h1>
@endsection
```

#### **Menggunakan layout untuk halaman Mahasiswa:**

```blade
@extends('layouts.mahasiswa')

@section('title', 'Dashboard - Mahasiswa')

@section('content')
    <h1>Welcome to Mahasiswa Dashboard</h1>
@endsection
```

---

### 4. Cara Menggunakan Components

#### **Menggunakan Stat Card Component:**

```blade
<div class="grid grid-cols-4 gap-4">
    <x-cards.stat-card
        title="Total Mahasiswa"
        value="245"
        color="blue"
        icon='<svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">...</svg>'
    />
</div>
```

#### **Menggunakan Status Badge Component:**

```blade
<x-badges.status status="active" />
<x-badges.status status="pending" />
<x-badges.status status="approved" />
```

#### **Menggunakan Form Input Component:**

```blade
<x-forms.input
    label="Email"
    name="email"
    type="email"
    placeholder="masukkan@email.com"
    required
/>
```

#### **Menggunakan Modal Component:**

```blade
<button onclick="document.getElementById('deleteModal').classList.remove('hidden')">
    Hapus
</button>

<x-modals.confirm
    id="deleteModal"
    title="Konfirmasi Hapus"
    message="Anda yakin ingin menghapus data ini?"
    confirmText="Hapus"
    cancelText="Batal"
/>
```

---

### 5. Best Practices

#### **Struktur Blade yang Baik:**

```blade
@extends('layouts.admin')

@section('title', 'Page Title')

@section('content')
    {{-- Header Section --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Page Title</h1>
    </div>

    {{-- Content Section --}}
    <div class="bg-white rounded-lg shadow p-6">
        <!-- Content here -->
    </div>
@endsection

@push('styles')
    {{-- Custom CSS jika diperlukan --}}
@endpush

@push('scripts')
    {{-- Custom JS jika diperlukan --}}
@endpush
```

#### **Warna Tailwind untuk Setiap Role:**

- **Admin**: Blue (`blue-600`, `blue-100`)
- **Dosen**: Green (`green-600`, `green-100`)
- **Mahasiswa**: Purple (`purple-600`, `purple-100`)

#### **Penamaan File Blade:**

- Gunakan lowercase
- Gunakan dash (-) untuk pemisah kata: `admin-sidebar.blade.php`
- Gunakan folder untuk organisasi: `admin/mahasiswa/index.blade.php`

#### **Struktur Component:**

- Selalu gunakan `@props` untuk mendefinisikan props
- Gunakan slot (`{{ $slot }}`) untuk content dinamis
- Buat component yang reusable, hindari hardcoding

#### **Responsive Design:**

- Gunakan Tailwind Grid: `grid-cols-1 md:grid-cols-2 lg:grid-cols-4`
- Gunakan padding/margin yang konsisten: `p-4`, `p-6`, `mb-6`
- Test di berbagai ukuran layar

---

### 6. Routing Setup

Pastikan routes sudah dikonfigurasi di `routes/web.php`:

```php
// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');
    // ... routes lainnya
});

// Dosen Routes
Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    // ... routes lainnya
});

// Mahasiswa Routes
Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    // ... routes lainnya
});
```

---

### 7. Tips Pengembangan

✅ **Lakukan:**

- Gunakan components untuk kode yang sering diulang
- Maintain konsistensi warna dan styling
- Test responsive design
- Dokumentasi kode yang kompleks

❌ **Jangan:**

- Hardcode warna, gunakan Tailwind classes
- Copy-paste code besar, buat component
- Lupa tambahkan title di section
- Gunakan inline styles

---

### 8. Customization

Untuk menambah halaman baru:

1. Buat file di folder role yang sesuai
2. Extend layout yang sesuai (`layouts.admin`, `layouts.dosen`, dst)
3. Tambahkan routing di `routes/web.php`
4. Update sidebar menu dengan link ke halaman baru

Contoh menambah halaman baru untuk admin:

```bash
# 1. Buat file
touch resources/views/admin/program/index.blade.php

# 2. Isi file dengan:
@extends('layouts.admin')
@section('title', 'Program - Admin')
@section('content')
    <!-- content -->
@endsection

# 3. Tambahkan route
Route::resource('/admin/program', ProgramController::class)->names('admin.program');

# 4. Update sidebar di admin-sidebar.blade.php
<a href="{{ route('admin.program.index') }}" class="...">Program</a>
```

---

**Selamat! Struktur frontend Anda sudah siap digunakan dan dikembangkan lebih lanjut. 🚀**
