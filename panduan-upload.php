<?php
/* ============================================================
   panduan-upload.php  →  BAB 8: Upload, Arsitektur, Analisis
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Upload & Arsitektur — Materi';
require 'includes/header.php';
?>

<main class="materi">

  <section class="materi-head">
    <h1>File Upload, Arsitektur Folder &amp; Analisis Kebutuhan</h1>
    <p>Cara aman menerima file, menata folder proyek, dan merencanakan fitur
       sebelum coding.</p>
  </section>

  <section class="lesson">
    <h2>1. Form Upload (wajib <code>enctype</code>)</h2>
    <p class="lead-info">Membahas cara membuat <strong>form yang benar</strong> untuk
       mengirim file dari browser ke server.</p>
    <p>Tanpa <code>enctype="multipart/form-data"</code>, file tidak akan terkirim.</p>
    <?php code_block('<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="foto" accept="image/*" required>
  <button type="submit">Upload</button>
</form>', 'html'); ?>
  </section>

  <section class="lesson">
    <h2>2. Proses Upload + Validasi</h2>
    <p class="lead-info">Membahas cara <strong>memproses file di server dengan aman</strong>:
       memeriksa file sebelum disimpan agar tidak berbahaya atau menimpa file lain.</p>
    <p>Selalu validasi <strong>tipe</strong> (whitelist) &amp; <strong>ukuran</strong>,
       lalu <strong>rename</strong> agar tidak menimpa file lain.</p>
    <?php code_block('<?php
$file   = $_FILES["foto"];
$allowed = ["image/jpeg","image/png","image/gif","image/webp"];

// 1) cek tipe (whitelist)
if (!in_array($file["type"], $allowed)) die("Tipe tidak diizinkan");

// 2) cek ukuran (maks 2MB)
if ($file["size"] > 2 * 1024 * 1024) die("Maksimal 2MB");

// 3) rename unik agar tidak overwrite
$ext  = pathinfo($file["name"], PATHINFO_EXTENSION);
$baru = time() . "_" . uniqid() . "." . $ext;

// 4) pindahkan dari folder sementara ke uploads/
move_uploaded_file($file["tmp_name"], "uploads/" . $baru);
?>', 'php'); ?>
    <p>💡 Materi ini dipakai nyata di
       <a href="<?= BASE_URL ?>/panduan-crud.php"><strong>Demo CRUD</strong></a>
       — coba tambah data dengan foto.</p>
  </section>

  <section class="lesson">
    <h2>3. Arsitektur Folder Terstruktur</h2>
    <p class="lead-info">Membahas cara <strong>menata folder proyek berdasarkan fungsi</strong>
       agar rapi dan mudah dikembangkan.</p>
    <p>Tanpa struktur, proyek jadi <em>spaghetti code</em>. Pisahkan berdasar fungsi.</p>
    <?php code_block('project/
├── config/      → koneksi database (1 tempat)
├── assets/
│   ├── css/     → semua CSS
│   ├── js/      → semua JavaScript
│   └── img/     → gambar statis
├── uploads/     → file upload user (jangan campur ke assets)
├── includes/    → header, footer, functions (reusable)
├── modules/     → fitur (mahasiswa, auth, ...)
└── index.php    → halaman utama', 'text'); ?>
    <p>👉 Website ini sendiri memakai pola tersebut: lihat folder
       <code>config/</code>, <code>assets/</code>, <code>includes/</code>, <code>crud/</code>.</p>
  </section>

  <section class="lesson">
    <h2>4. Analisis Kebutuhan Pengguna</h2>
    <p class="lead-info">Membahas <strong>langkah perencanaan sebelum menulis kode</strong>:
       kenali pengguna, tentukan fitur, rancang database, baru coding.</p>
    <p>Fondasi <strong>sebelum coding</strong>. Urutan yang benar:</p>
    <ol class="steps">
      <li>Identifikasi pengguna (siapa &amp; hak aksesnya)</li>
      <li>Tentukan kebutuhan fungsional (apa yang bisa dilakukan)</li>
      <li>Rancang entitas/tabel database</li>
      <li>Tentukan alur CRUD tiap fitur</li>
      <li>Baru mulai coding</li>
    </ol>
    <table class="table" style="margin-top:8px">
      <thead><tr><th>❌ Salah</th><th>✅ Benar</th></tr></thead>
      <tbody>
        <tr><td>Langsung coding tanpa analisis</td><td>Analisis kebutuhan dulu</td></tr>
        <tr><td>Struktur DB berubah-ubah</td><td>Desain DB matang dulu</td></tr>
        <tr><td>Semua kode di satu file</td><td>Pisah berdasar fungsi</td></tr>
        <tr><td>Tidak ada validasi input</td><td>Validasi di server (PHP)</td></tr>
        <tr><td>Password plain text</td><td>Pakai <code>password_hash()</code></td></tr>
        <tr><td>Nama file upload dibiarkan</td><td>Rename dengan <code>uniqid()</code></td></tr>
      </tbody>
    </table>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
