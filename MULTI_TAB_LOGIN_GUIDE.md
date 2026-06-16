# 🔄 CARA LOGIN MULTI-USER DI TAB BERBEDA

**Problem**: Ingin login sebagai Mahasiswa di tab baru, tapi masih login Admin di tab lama.

**Solusi**: Gunakan Incognito/Private Mode atau Browser Berbeda!

---

## ⭐ CARA PALING MUDAH: INCOGNITO MODE

### Step-by-Step:

#### **1. Tab Pertama (Normal) - Admin**
```
✅ Sudah login sebagai Admin
✅ Dashboard admin terbuka
✅ JANGAN LOGOUT!
```

#### **2. Buka Incognito/Private Window**

**Chrome:**
```
Tekan: Ctrl + Shift + N
```

**Firefox:**
```
Tekan: Ctrl + Shift + P
```

**Edge:**
```
Tekan: Ctrl + Shift + N
```

#### **3. Di Incognito Window**
```
1. Buka: http://localhost:8000/auth/quick-switch
2. Klik card user yang ingin di-test (misal: Rexy Mahasiswa)
3. Otomatis login sebagai Mahasiswa
```

#### **4. Sekarang Anda Punya 2 Session!**
```
Tab Normal    → Admin Dashboard ✅
Tab Incognito → Mahasiswa Dashboard ✅

Bisa dibuka bersamaan! 🎉
```

---

## 🚀 CARA ALTERNATIF: MULTIPLE BROWSER

### Setup:

#### **Browser 1: Chrome**
```
Login sebagai: Admin
URL: http://localhost:8000/admin/dashboard
```

#### **Browser 2: Firefox**
```
Login sebagai: Mahasiswa (Rexy)
URL: http://localhost:8000/mahasiswa/dashboard
```

#### **Browser 3: Edge**
```
Login sebagai: Dosen Pembimbing (Siti)
URL: http://localhost:8000/dosen-pembimbing/dashboard
```

#### **Browser 4: Opera/Brave**
```
Login sebagai: Dosen Penguji (Budi)
URL: http://localhost:8000/dosen-penguji/dashboard
```

### Keuntungan:
- ✅ Semua session tetap aktif
- ✅ Bisa switch antar browser dengan Alt+Tab
- ✅ Perfect untuk demo/presentation

---

## 💡 HELPER BANNER DI DASHBOARD ADMIN

Sekarang ada banner kuning di dashboard admin yang memudahkan Anda!

### Fitur Banner:

#### **Button 1: "Buka di Incognito"**
```
Klik → Alert dengan instruksi
     → URL auto-copied ke clipboard
     → Tinggal paste di incognito window
```

#### **Button 2: "Quick Switch (Tab Baru)"**
```
Klik → Buka quick-switch di tab baru
     → Pilih user
     → Login
Note: Tab admin akan logout! Gunakan incognito lebih baik.
```

#### **Button X (Close)**
```
Klik → Banner hilang (untuk sesi ini)
```

---

## 📋 WORKFLOW TESTING

### Skenario 1: Test Flow Mahasiswa
```
1. Tab Normal (Chrome)
   → Login Admin
   → Buka dashboard admin
   
2. Tekan Ctrl+Shift+N
   → Buka incognito Chrome
   
3. Di Incognito
   → Akses: http://localhost:8000/auth/quick-switch
   → Login sebagai Rexy
   → Test dashboard mahasiswa
   
4. Switch Tab (Alt+Tab)
   → Tab Admin masih aktif ✅
   → Tab Mahasiswa juga aktif ✅
```

### Skenario 2: Test Multi-Role Interaction
```
1. Chrome Normal → Admin
   - Assign dosen ke mahasiswa
   
2. Chrome Incognito → Mahasiswa
   - Cek dashboard (dosen pembimbing muncul)
   
3. Firefox → Dosen Pembimbing
   - Cek dashboard (mahasiswa bimbingan muncul)
   
4. Edge → Dosen Penguji
   - Cek ujian kompetensi
```

---

## ⚠️ IMPORTANT NOTES

### ❌ YANG TIDAK BISA:
```
✗ Login 2 user di tab yang sama (browser yang sama)
  → User pertama akan logout otomatis
  
✗ Login 2 user di 2 tab normal (browser yang sama)
  → Session di-share, hanya 1 user aktif
```

### ✅ YANG BISA:
```
✓ Login di tab normal + tab incognito (browser yang sama)
  → 2 session berbeda ✅
  
✓ Login di 2 browser berbeda (Chrome + Firefox)
  → 2 session berbeda ✅
  
✓ Login di multiple incognito windows
  → Multiple session berbeda ✅
```

---

## 🎯 QUICK REFERENCE

### Keyboard Shortcuts:

| Action | Chrome | Firefox | Edge |
|--------|--------|---------|------|
| New Incognito | `Ctrl+Shift+N` | `Ctrl+Shift+P` | `Ctrl+Shift+N` |
| New Tab | `Ctrl+T` | `Ctrl+T` | `Ctrl+T` |
| Close Tab | `Ctrl+W` | `Ctrl+W` | `Ctrl+W` |
| Switch Tab | `Ctrl+Tab` | `Ctrl+Tab` | `Ctrl+Tab` |
| Switch Browser | `Alt+Tab` | `Alt+Tab` | `Alt+Tab` |

### URLs Penting:

```
Quick Switch:
http://localhost:8000/auth/quick-switch

Login Manual:
http://localhost:8000/auth/login

Admin Dashboard:
http://localhost:8000/admin/dashboard

Mahasiswa Dashboard:
http://localhost:8000/mahasiswa/dashboard

Dosen Pembimbing Dashboard:
http://localhost:8000/dosen-pembimbing/dashboard

Dosen Penguji Dashboard:
http://localhost:8000/dosen-penguji/dashboard
```

---

## 🎨 VISUAL GUIDE

```
┌─────────────────────────────────────────────────┐
│  CHROME (Tab Normal)                            │
│  ✅ Login: Admin                                │
│  📍 URL: /admin/dashboard                       │
│                                                 │
│  [Dashboard] [Pendaftar] [Mahasiswa] [Dosen]   │
└─────────────────────────────────────────────────┘

         ↓ Ctrl+Shift+N (Buka Incognito)

┌─────────────────────────────────────────────────┐
│  CHROME INCOGNITO (Tab Baru)                    │
│  🔒 Session Baru                                │
│  📍 URL: /auth/quick-switch                     │
│                                                 │
│  [Admin] [Rexy] [Andi] [Siti] [Budi]           │
│                  ↓ Klik Rexy                    │
└─────────────────────────────────────────────────┘

         ↓ Login Berhasil

┌─────────────────────────────────────────────────┐
│  CHROME INCOGNITO (Mahasiswa)                   │
│  ✅ Login: Rexy Mahasiswa                       │
│  📍 URL: /mahasiswa/dashboard                   │
│                                                 │
│  [Dashboard] [Data MBKM] [Logbook] [Penilaian] │
└─────────────────────────────────────────────────┘

        ✨ Alt+Tab (Switch Tab)

┌─────────────────────────────────────────────────┐
│  CHROME (Tab Normal)                            │
│  ✅ Login: Admin (MASIH AKTIF!)                 │
│  📍 URL: /admin/dashboard                       │
└─────────────────────────────────────────────────┘
```

---

## 💪 PRO TIPS

### Tip 1: Bookmark Quick Switch
```
Bookmark URL ini:
http://localhost:8000/auth/quick-switch

Untuk akses cepat dari incognito
```

### Tip 2: Multiple Monitor Setup
```
Monitor 1: Admin view (Chrome)
Monitor 2: Mahasiswa view (Chrome Incognito)
Monitor 3: Dosen view (Firefox)
```

### Tip 3: Browser Profiles
```
Chrome Profile 1 "Admin" → Auto-login admin
Chrome Profile 2 "Mahasiswa" → Auto-login mahasiswa
Chrome Profile 3 "Dosen" → Auto-login dosen
```

### Tip 4: Use Developer Tools
```
F12 → Application → Storage
Bisa lihat session cookie per tab
```

---

## 🎯 KESIMPULAN

### ✅ **CARA YANG BENAR:**

1. **Tab Normal** → Login Admin
2. **Ctrl+Shift+N** → Buka Incognito
3. **Di Incognito** → Login user lain
4. **Alt+Tab** → Switch antar tab

### ❌ **CARA YANG SALAH:**

1. Tab Normal → Login Admin
2. Tab Baru (Ctrl+T) → Login mahasiswa
3. **ERROR**: Admin logout otomatis! ❌

---

## 📞 TROUBLESHOOTING

### Problem: "Admin logout saat buka tab baru"
**Solusi**: Gunakan **Incognito** bukan tab biasa!

### Problem: "Incognito juga logout"
**Solusi**: Pastikan buka **NEW incognito window**, bukan tab di incognito yang sudah ada.

### Problem: "Lupa sudah login apa"
**Solusi**: Lihat navbar → Ada nama user di kanan atas.

---

## ✨ SUMMARY

**Intinya:**
- ✅ **1 Browser Normal = 1 Session**
- ✅ **1 Incognito Window = 1 Session Baru**
- ✅ **Beda Browser = Beda Session**

**Mau testing multi-user?**
→ Pakai Incognito atau browser berbeda!

**Mau ganti user?**
→ Logout dulu, atau pakai incognito baru!

---

🎉 **Selamat Testing!**
