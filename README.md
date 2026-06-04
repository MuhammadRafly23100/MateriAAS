# Materi Web — CSS & CRUD Lab (AAS UNSIKA)

Website **materi belajar terbuka** (tanpa login) yang mencakup **8 bab** handout.
Tiap bab: penjelasan + contoh tampilan + kode. CRUD bisa dicoba langsung.

## Peta 8 Bab → Halaman

| Bab | Topik | File |
|----|-------|------|
| 1 | Pengantar Web | `pengantar.php` |
| 2 | HTML | `panduan-html.php` |
| 3+4 | CSS & Layout (Flexbox/Grid) | `panduan-css.php` |
| 5 | Praktikum landing page | `praktikum.php` |
| 6 | PHP & Web Dinamis | `panduan-php.php` |
| 7 | CRUD (PHP+MySQL) + demo | `panduan-crud.php` |
| 8 | Upload, Arsitektur, Analisis | `panduan-upload.php` |

## Struktur Folder

```
PraktikAAS/
├── config/db.php          → koneksi DB + BASE_URL + session
├── assets/css/style.css   → semua style (tiap blok dikomentari bagian apa)
├── assets/js/script.js    → toggle menu, dropdown materi, konfirmasi hapus
├── assets/img/default.png → avatar default
├── uploads/               → foto upload demo CRUD
├── includes/
│   ├── header.php         → navbar + dropdown "Materi" (bab 1–8)
│   ├── footer.php
│   └── functions.php      → helper: e(), code_block(), flash
├── index.php              → Home (daftar isi 8 bab)
├── pengantar.php · panduan-html.php · panduan-css.php
├── praktikum.php · panduan-php.php · panduan-crud.php · panduan-upload.php
├── crud/                  → tambah.php (C), edit.php (U), hapus.php (D)
└── database.sql           → tabel mahasiswa + 3 data contoh
```

## Cara Menjalankan

1. Pastikan **XAMPP** aktif (Apache + MySQL).
2. Import `database.sql` lewat phpMyAdmin (membuat database `db_kampus`)
   — *atau lewati jika sudah pernah diimport.*
3. Buka `http://localhost/PraktikAAS/`
4. Klik **Panduan Styling CSS** atau **Panduan CRUD** di navbar.

## Catatan

- **Tidak ada login.** Demo CRUD sengaja dibuka untuk publik agar bisa dicoba-coba.
- Hanya butuh **satu tabel**: `mahasiswa` (dipakai sebagai contoh data CRUD).
- `code_block()` di `includes/functions.php` dipakai menampilkan potongan kode
  pada halaman panduan dengan aman (di-escape).
