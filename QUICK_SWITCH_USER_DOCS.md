# 🔄 QUICK SWITCH USER - DOKUMENTASI

**Tanggal**: 16 Juni 2026  
**Status**: ✅ SELESAI

---

## 📝 FITUR INI UNTUK APA?

Fitur **Quick Switch User** memudahkan Anda untuk:
- ✅ Login cepat ke berbagai role **tanpa ketik email/password**
- ✅ Testing multi-user dengan mudah
- ✅ Switch antar akun dalam hitungan detik
- ✅ Akses semua role (Admin, Mahasiswa, Dosen Pembimbing, Dosen Penguji)

---

## 🎯 CARA MENGGUNAKAN

### Akses Halaman Quick Switch:

#### Cara 1: Dari Halaman Login
```
1. Buka halaman login: http://localhost:8000/auth/login
2. Scroll ke bawah
3. Klik tombol kuning "Quick Switch User (Testing Mode)"
```

#### Cara 2: Direct URL
```
Buka langsung: http://localhost:8000/auth/quick-switch
```

---

## 👥 USER YANG TERSEDIA

### 1️⃣ **Admin**
```
📧 Email: admin@mbkm.ac.id
🔑 Password: admin123
🎯 Role: Administrator
📍 Redirect: /admin/dashboard
```

### 2️⃣ **Rexy Mahasiswa** (Tanpa Data MBKM)
```
📧 Email: rexy@student.upi.edu
🔑 Password: password
🎯 Role: Mahasiswa
⚠️ Status: Belum ada data MBKM
📍 Redirect: /mahasiswa/dashboard
```

### 3️⃣ **Andi Pratama** (Dengan Data MBKM)
```
📧 Email: andi@student.upi.edu
🔑 Password: password
🎯 Role: Mahasiswa
✅ Status: Punya data MBKM (PT Teknologi Nusantara)
📍 Redirect: /mahasiswa/dashboard
```

### 4️⃣ **Dr. Siti Nurhaliza** (Dosen Pembimbing)
```
📧 Email: siti@upi.edu
🔑 Password: password
🎯 Role: Dosen Pembimbing
📋 NIP: 198501012010122001
📍 Redirect: /dosen-pembimbing/dashboard
```

### 5️⃣ **Prof. Dr. Budi Santoso** (Dosen Penguji)
```
📧 Email: budi.santoso@upi.edu
🔑 Password: password
🎯 Role: Dosen Penguji
📋 NIP: 197505102005011002
📍 Redirect: /dosen-penguji/dashboard
```

### 6️⃣ **Login Manual**
```
Untuk akun lain atau akun custom
📍 Link ke: /auth/login
```

---

## 🎨 TAMPILAN UI

### Halaman Quick Switch:
```
┌─────────────────────────────────────────────────────────┐
│              🔄 Quick Switch User                       │
│         Login cepat untuk testing berbagai role         │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐            │
│  │  🔹 Admin │  │ 🟢 Rexy  │  │ 🟢 Andi  │            │
│  │ admin@.. │  │ rexy@... │  │ andi@... │            │
│  │ [Login]  │  │ [Login]  │  │ [Login]  │            │
│  └──────────┘  └──────────┘  └──────────┘            │
│                                                         │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐            │
│  │ 🟣 Siti  │  │ 🟣 Budi  │  │ 🔒 Manual│            │
│  │ siti@... │  │ budi@... │  │  Login   │            │
│  │ [Login]  │  │ [Login]  │  │  Custom  │            │
│  └──────────┘  └──────────┘  └──────────┘            │
│                                                         │
├─────────────────────────────────────────────────────────┤
│  💡 Tips untuk Testing Multi-User:                     │
│  • Cara 1: Gunakan browser berbeda                     │
│  • Cara 2: Gunakan Incognito/Private mode              │
│  • Cara 3: Switch user dengan cepat di sini            │
└─────────────────────────────────────────────────────────┘
```

---

## 🔐 KEAMANAN

### Proteksi Production:
```php
if (app()->environment('production')) {
    abort(404); // Quick switch tidak tersedia di production
}
```

**Fitur ini hanya aktif di environment:**
- ✅ `local` (development)
- ✅ `testing`
- ❌ `production` (dinonaktifkan otomatis)

---

## 💡 TIPS TESTING MULTI-USER

### Masalah: Session Conflict
Ketika login di tab yang sama, user sebelumnya akan ter-logout karena Laravel menggunakan session yang sama.

### Solusi:

#### **Cara 1: Multiple Browser** ⭐ RECOMMENDED
```
1. Chrome    → Login sebagai Admin
2. Firefox   → Login sebagai Mahasiswa (Rexy)
3. Edge      → Login sebagai Dosen Pembimbing
4. Opera     → Login sebagai Dosen Penguji
```

#### **Cara 2: Incognito/Private Mode**
```
Browser Normal  → Login sebagai Admin
Incognito Tab 1 → Login sebagai Mahasiswa
Incognito Tab 2 → Login sebagai Dosen Pembimbing
Incognito Tab 3 → Login sebagai Dosen Penguji
```

#### **Cara 3: Browser Profiles**
```
Chrome Profile 1 → Admin
Chrome Profile 2 → Mahasiswa
Chrome Profile 3 → Dosen Pembimbing
Chrome Profile 4 → Dosen Penguji
```

#### **Cara 4: Quick Switch (Same Tab)**
```
Tab 1 → Quick Switch → Login Admin → Test
      → Quick Switch → Login Mahasiswa → Test
      → Quick Switch → Login Dosen → Test
```
**Note:** Cara ini akan logout user sebelumnya

---

## 🚀 WORKFLOW TESTING

### Skenario 1: Test Flow Mahasiswa Baru
```
1. Quick Switch → Login Rexy
2. Cek dashboard (belum ada data)
3. Isi data MBKM
4. Lihat perubahan di dashboard
5. Quick Switch → Login Admin
6. Cek list mahasiswa (Rexy sudah ada data)
```

### Skenario 2: Test Assignment Dosen
```
1. Quick Switch → Login Admin
2. Buka menu "Kelola Dosen"
3. Tambah dosen baru (pembimbing/penguji)
4. Assign ke mahasiswa
5. Quick Switch → Login Dosen
6. Cek dashboard dosen (mahasiswa bimbingan muncul)
```

### Skenario 3: Test Penilaian
```
1. Quick Switch → Login Mahasiswa (Andi)
2. Upload dokumen/logbook
3. Quick Switch → Login Dosen Pembimbing
4. Validasi logbook
5. Beri penilaian
6. Quick Switch → Login Mahasiswa (Andi)
7. Cek nilai sudah muncul
```

---

## 📁 FILE YANG DIBUAT/DIUBAH

### 1. View (Halaman Quick Switch)
```
resources/views/auth/quick-switch.blade.php
```

### 2. Controller (Methods)
```
app/Http/Controllers/AuthController.php
  ├─ quickSwitch()  // Tampilkan halaman
  └─ quickLogin()   // Proses login cepat
```

### 3. Routes
```
routes/web.php
  ├─ GET  /auth/quick-switch → quickSwitch()
  └─ POST /auth/quick-login  → quickLogin()
```

### 4. Login Page (Link ke Quick Switch)
```
resources/views/auth/login.blade.php
  └─ Link "Quick Switch User (Testing Mode)"
```

---

## 🎨 DESIGN FEATURES

### Color Coding:
- **Admin**: 🔹 Blue (`border-blue-200`)
- **Mahasiswa Rexy**: 🟢 Green (`border-green-200`)
- **Mahasiswa Andi**: 🟢 Emerald (`border-emerald-200`)
- **Dosen Pembimbing**: 🟣 Purple (`border-purple-200`)
- **Dosen Penguji**: 🟣 Indigo (`border-indigo-200`)
- **Manual Login**: ⚪ Slate (`border-slate-200`)

### Card Features:
- ✅ Avatar dengan initial
- ✅ Badge role dengan warna
- ✅ Info email & password
- ✅ Status tag (untuk mahasiswa)
- ✅ Hover effect (shadow + translate)
- ✅ One-click login button

### Info Box:
- ✅ Warning tentang session conflict
- ✅ Tips multi-user testing
- ✅ Visual icon & color coding

---

## 🔧 BACKEND LOGIC

### Method: `quickLogin()`

```php
public function quickLogin(Request $request)
{
    // 1. Proteksi production
    if (app()->environment('production')) {
        abort(404);
    }
    
    // 2. Ambil user dari email
    $user = User::where('email', $request->email)->first();
    
    // 3. Validasi password
    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Login gagal!');
    }
    
    // 4. Cek is_active
    if (!$user->is_active) {
        return redirect()->route('auth.pending');
    }
    
    // 5. Login user
    Auth::login($user, true);
    $request->session()->regenerate();
    
    // 6. Redirect berdasarkan role
    return $this->redirectByRole($user->role);
}
```

---

## 📊 STATISTICS

### User Cards: **6 cards**
- 5 Quick login cards
- 1 Manual login card

### Form Fields per Card:
- Hidden email
- Hidden password
- Submit button (auto-login)

### Total Lines of Code: **~350 lines**

---

## ⚠️ LIMITATIONS

### Session Management:
- ❌ **Tidak bisa** login multiple user di tab yang sama
- ✅ **Bisa** login multiple user di browser berbeda
- ✅ **Bisa** login multiple user di incognito mode

### Production Safety:
- ❌ Quick switch **disabled** di production
- ✅ Route akan `abort(404)` jika diakses di production

---

## 🎯 USE CASES

### Developer:
- ✅ Testing flow dari berbagai role
- ✅ Debug issue specific role
- ✅ Demo ke client/stakeholder

### QA Tester:
- ✅ Test case multi-user interaction
- ✅ Validasi permission & authorization
- ✅ End-to-end testing

### Product Owner:
- ✅ Review fitur dari berbagai perspektif
- ✅ Acceptance testing
- ✅ User story validation

---

## 🚀 QUICK START

### Step 1: Akses Halaman
```
http://localhost:8000/auth/quick-switch
```

### Step 2: Pilih User
```
Klik card user yang ingin di-test
Contoh: Klik card "Admin"
```

### Step 3: Auto-login
```
✅ Sistem otomatis login
✅ Redirect ke dashboard role
✅ Siap testing!
```

### Step 4: Switch User
```
Logout → Quick Switch → Pilih user lain
atau
Buka browser/incognito baru → Quick Switch
```

---

## 💡 PRO TIPS

### Tip 1: Bookmark URL
```
Bookmark: http://localhost:8000/auth/quick-switch
Untuk akses cepat kapan saja
```

### Tip 2: Keyboard Shortcut
```
Ctrl+Shift+N (Chrome) = New Incognito Window
Ctrl+Shift+P (Firefox) = New Private Window
```

### Tip 3: Browser DevTools
```
F12 → Application → Storage → Clear All
Untuk clear session manual
```

### Tip 4: Multiple Monitor
```
Monitor 1: Admin view
Monitor 2: Mahasiswa view
Monitor 3: Dosen view
```

---

## ✨ FUTURE IMPROVEMENTS (Optional)

- [ ] Add Kaprodi quick login
- [ ] Session switcher (tanpa logout)
- [ ] Recent login history
- [ ] Favorite user bookmark
- [ ] Custom user creator (on-the-fly)
- [ ] Auto-logout timer
- [ ] Multi-session indicator

---

## 🎉 STATUS

```
✅ Halaman Quick Switch  - DONE
✅ Controller methods    - DONE
✅ Routes                - DONE
✅ Link di login page   - DONE
✅ Production safety     - DONE
✅ 6 User cards          - DONE
✅ Info box & tips       - DONE
✅ Responsive design     - DONE
```

**SIAP DIGUNAKAN 100%!** 🎊

---

## 🙏 Credit

Dibuat oleh: Kiro AI Assistant  
Tanggal: 16 Juni 2026  
Untuk: Sistem MBKM Ilmu Komputer UPI
