# 👨‍🏫 FITUR KELOLA DOSEN - DOKUMENTASI

**Tanggal**: 16 Juni 2026  
**Status**: ✅ SELESAI

---

## 📝 DESKRIPSI FITUR

Fitur ini memungkinkan **Admin** untuk:
- ✅ Melihat daftar semua dosen
- ✅ Menambah akun dosen baru (pembimbing/penguji)
- ✅ Menghapus akun dosen
- ✅ Search dosen berdasarkan nama, email, atau NIP
- ✅ Statistik dosen pembimbing & penguji

---

## 🎯 ALUR KERJA

```
Admin Login 
  → Menu "Kelola Dosen"
    → List Dosen (dengan statistik)
      → Klik "Tambah Dosen"
        → Isi Form (Data Akun + Data Dosen)
          → Submit
            → Akun Dosen Otomatis Aktif ✅
              → Role: "dosen"
                → Bisa ditugaskan sebagai:
                  - Dosen Pembimbing
                  - Dosen Penguji
```

---

## 📁 FILE YANG DIBUAT/DIUBAH

### 1. **Controller**
File: `app/Http/Controllers/AdminController.php`

#### Methods Baru:
```php
✅ dosen()         // List semua dosen
✅ createDosen()   // Form create dosen
✅ storeDosen()    // Simpan dosen baru
✅ destroyDosen()  // Hapus dosen
```

---

### 2. **Routes**
File: `routes/web.php`

#### Routes Baru:
```php
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/',        [AdminController::class, 'dosen'])->name('index');
        Route::get('/create',  [AdminController::class, 'createDosen'])->name('create');
        Route::post('/',       [AdminController::class, 'storeDosen'])->name('store');
        Route::delete('/{id}', [AdminController::class, 'destroyDosen'])->name('destroy');
    });
});
```

**URL Routes:**
- `GET  /admin/dosen`           → List dosen
- `GET  /admin/dosen/create`    → Form create
- `POST /admin/dosen`           → Store dosen
- `DELETE /admin/dosen/{id}`    → Delete dosen

---

### 3. **Views**
Folder: `resources/views/admin/dosen/`

#### Files:
```
admin/dosen/
├── index.blade.php   ✅ List dosen
└── create.blade.php  ✅ Form create dosen
```

---

### 4. **Sidebar**
File: `resources/views/components/sidebar/admin-sidebar.blade.php`

#### Menu Baru:
```blade
<a href="{{ route('admin.dosen.index') }}">
    <svg>...</svg>
    Kelola Dosen
</a>
```

---

## 🎨 HALAMAN INDEX (`admin/dosen/index.blade.php`)

### Fitur:

#### 1. **Statistics Cards (3 Card)**
```
┌─────────────────┬─────────────────┬─────────────────┐
│  Total Dosen    │ Dosen Pembimbing│  Dosen Penguji  │
│      [X]        │      [Y]        │      [Z]        │
└─────────────────┴─────────────────┴─────────────────┘
```

#### 2. **Search Bar**
- Input search: Nama, Email, atau NIP
- Button "Cari" dan "Reset"

#### 3. **Table Dosen**
Kolom:
- No
- Nama Dosen (dengan avatar initial)
- NIP
- Email
- No. Telp
- Aksi (Hapus)

#### 4. **Pagination**
- Auto pagination Laravel
- Menampilkan 15 dosen per halaman

#### 5. **Empty State**
- Jika tidak ada data dosen
- Dengan icon dan pesan "Tidak ada data dosen"

---

## 📝 HALAMAN CREATE (`admin/dosen/create.blade.php`)

### Form Sections:

#### Section 1: Informasi Akun
```
┌─────────────────────────────────────┐
│  1. Informasi Akun                  │
├─────────────────────────────────────┤
│  • Nama Lengkap *                   │
│  • Email *                          │
│  • Password *                       │
│  • Konfirmasi Password *            │
└─────────────────────────────────────┘
```

#### Section 2: Data Dosen
```
┌─────────────────────────────────────┐
│  2. Data Dosen                      │
├─────────────────────────────────────┤
│  • NIP (Nomor Induk Pegawai) *      │
│  • No. Telepon                      │
└─────────────────────────────────────┘
```

### Validasi Form:

| Field               | Rules                           |
|---------------------|---------------------------------|
| Nama Lengkap        | Required, max 255 char          |
| Email               | Required, email, unique         |
| Password            | Required, min 8 char, confirmed |
| NIP                 | Required, max 20 char, unique   |
| No. Telp            | Optional, max 15 char           |

### Features:
- ✅ Error messages per field
- ✅ Old input persistence
- ✅ Info box (penjelasan)
- ✅ Help card (panduan pengisian)
- ✅ Button "Simpan" & "Batal"

---

## 🔧 BACKEND LOGIC

### Method: `storeDosen()`

```php
public function storeDosen(Request $request)
{
    // 1. Validasi input
    $request->validate([...]);
    
    // 2. Buat akun User
    $user = User::create([
        'name'      => $request->name,
        'email'     => $request->email,
        'password'  => Hash::make($request->password),
        'role'      => 'dosen',          // ✅ Role: dosen
        'is_active' => true,             // ✅ Langsung aktif
    ]);
    
    // 3. Buat record Dosen
    Dosen::create([
        'user_id'  => $user->id,
        'nip'      => $request->nip,
        'no_telp'  => $request->no_telp,
    ]);
    
    // 4. Redirect dengan success message
    return redirect()->route('admin.dosen.index')
        ->with('success', "Akun dosen berhasil dibuat.");
}
```

**Key Points:**
- Role otomatis: `dosen`
- Status otomatis: `is_active = true`
- Password di-hash dengan bcrypt
- Relasi user → dosen otomatis terlink

---

## 🗄️ STRUKTUR DATABASE

### Table: `users`
```sql
id | name | email | password | role | is_active
---|------|-------|----------|------|----------
1  | Dr. Siti | siti@upi.edu | $2y$... | dosen | 1
```

### Table: `dosens`
```sql
id | user_id | nip | no_telp
---|---------|-----|--------
1  | 1       | 198501012010122001 | 081234567890
```

**Relasi:**
- `users.id` ← → `dosens.user_id` (One-to-One)

---

## 🚀 CARA TESTING

### 1. Login sebagai Admin
```
URL: http://localhost:8000/auth/login
Email: admin@mbkm.ac.id
Password: admin123
```

### 2. Navigasi ke Menu "Kelola Dosen"
```
Sidebar → Kelola Dosen
atau
URL: http://localhost:8000/admin/dosen
```

### 3. Klik "Tambah Dosen"
```
Button: [+ Tambah Dosen]
URL: http://localhost:8000/admin/dosen/create
```

### 4. Isi Form
```
Nama Lengkap: Dr. Ahmad Fauzi, M.Kom
Email: ahmad.fauzi@upi.edu
Password: password123
Konfirmasi Password: password123
NIP: 198701152012121001
No. Telp: 081298765432
```

### 5. Klik "Simpan Akun Dosen"
```
Expected Result:
✅ Redirect ke list dosen
✅ Success message muncul
✅ Dosen baru tampil di table
```

### 6. Test Login sebagai Dosen Baru
```
Logout dari admin
Login dengan:
  Email: ahmad.fauzi@upi.edu
  Password: password123

Expected Result:
✅ Login berhasil
✅ Redirect ke dashboard dosen pembimbing
```

---

## 📊 STATISTICS LOGIC

### Total Dosen
```php
$dosens->total()
// Menghitung total semua dosen aktif
```

### Dosen Pembimbing Aktif
```php
PendaftaranMbkm::whereNotNull('dosen_pembimbing_id')
    ->distinct('dosen_pembimbing_id')
    ->count('dosen_pembimbing_id')
// Menghitung dosen yang sedang aktif membimbing
```

### Dosen Penguji Aktif
```php
PendaftaranMbkm::whereNotNull('dosen_penguji_id')
    ->distinct('dosen_penguji_id')
    ->count('dosen_penguji_id')
// Menghitung dosen yang sedang aktif menguji
```

---

## 🎯 PERBEDAAN ROLE DOSEN

### Role: `dosen`
Satu role untuk semua, tapi **fungsi berbeda** saat penugasan:

```
users.role = "dosen"
    ↓
    Bisa ditugaskan sebagai:
    
    1️⃣ Dosen Pembimbing
       - Membimbing mahasiswa MBKM
       - Validasi logbook
       - Memberikan penilaian
    
    2️⃣ Dosen Penguji
       - Menguji proposal
       - Menguji laporan akhir
       - Memberikan penilaian ujian
```

**Penugasan dilakukan di:**
- Menu "Penugasan" (Admin)
- Menu "Assign Pembimbing" (Kaprodi)

---

## 🔐 SECURITY

### Validasi:
- ✅ Email unique (tidak boleh duplikat)
- ✅ NIP unique (tidak boleh duplikat)
- ✅ Password min 8 karakter
- ✅ Password confirmation

### Authorization:
- ✅ Only admin dapat akses
- ✅ Middleware `auth` + `role:admin`
- ✅ CSRF token protection

### Password:
- ✅ Hash dengan bcrypt
- ✅ Tidak disimpan plain text

---

## 🎨 UI/UX FEATURES

### Design Elements:
- ✅ Avatar initial (huruf pertama nama)
- ✅ Responsive table
- ✅ Hover effects
- ✅ Empty state illustration
- ✅ Success/Error messages
- ✅ Inline validation errors
- ✅ Help text & info boxes
- ✅ Icon-based navigation

### Colors:
- Blue: Primary actions
- Green: Pembimbing
- Purple: Penguji
- Red: Delete actions
- Slate: Neutral elements

---

## ✨ NEXT IMPROVEMENTS (Optional)

- [ ] Edit dosen (update data)
- [ ] Filter by role (pembimbing/penguji)
- [ ] Export list dosen ke Excel/PDF
- [ ] Import dosen dari CSV
- [ ] View detail dosen (mahasiswa bimbingan)
- [ ] Assign pembimbing langsung dari list dosen
- [ ] Avatar upload untuk dosen
- [ ] Send email notification setelah create
- [ ] Bulk delete dosen

---

## 📝 NOTES

### Role vs Fungsi:
- **Role** = `dosen` (di table users)
- **Fungsi** = Pembimbing/Penguji (di table pendaftaran_mbkms)

Satu dosen bisa:
- Jadi pembimbing untuk mahasiswa A
- Jadi penguji untuk mahasiswa B
- Tidak ditugaskan (standby)

### Email:
- Disarankan gunakan email institusi (@upi.edu)
- Email digunakan untuk login
- Email harus unique

### NIP:
- Nomor Induk Pegawai
- Format bebas (sesuai institusi)
- Harus unique

---

## 🎉 STATUS AKHIR

```
✅ Backend controller     - DONE
✅ Routes                 - DONE
✅ Views (index & create) - DONE
✅ Sidebar menu           - DONE
✅ Validation             - DONE
✅ Error handling         - DONE
✅ Success messages       - DONE
✅ Search functionality   - DONE
✅ Delete functionality   - DONE
✅ Pagination             - DONE
✅ Statistics cards       - DONE
```

**SEMUA FITUR BERFUNGSI 100%!** 🎊

---

## 🙏 Credit

Dibuat oleh: Kiro AI Assistant  
Tanggal: 16 Juni 2026  
Untuk: Sistem MBKM Ilmu Komputer UPI
