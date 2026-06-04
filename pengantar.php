<?php
/* ============================================================
   pengantar.php  →  BAB 1: Pengantar Pemrograman Berbasis Web
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Pengantar Web — Materi';
require 'includes/header.php';
?>

<main class="materi">

  <section class="materi-head">
    <h1>Pengantar Pemrograman Berbasis Web</h1>
    <p>Konsep dasar: apa itu aplikasi web, arsitektur client-server,
       alur HTTP, dan peran tiap teknologi.</p>
  </section>

  <section class="lesson">
    <h2>Apa itu Aplikasi Web?</h2>
    <p>Aplikasi yang diakses lewat <strong>browser</strong> (Chrome, Firefox, Edge)
       tanpa instalasi. Cukup punya URL dan koneksi internet. Contoh: Google Docs,
       Tokopedia, SIAKAD kampus.</p>
  </section>

  <section class="lesson">
    <h2>Arsitektur Client-Server</h2>
    <p>Browser (client) mengirim permintaan; server memproses lalu membalas.</p>
    <div class="demo-preview" style="align-items:stretch">
      <div class="flow">
        <div class="flow-box">CLIENT<br><small>Browser / HP</small></div>
        <div class="flow-arrow">⇄ HTTP ⇄</div>
        <div class="flow-box">SERVER<br><small>Apache + PHP</small></div>
        <div class="flow-arrow">⇄ SQL ⇄</div>
        <div class="flow-box">DATABASE<br><small>MySQL</small></div>
      </div>
    </div>
    <table class="table" style="margin-top:18px">
      <thead><tr><th>Komponen</th><th>Peran</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td>Client</td><td>Menampilkan UI, mengirim request</td><td>Browser, HP</td></tr>
        <tr><td>Server</td><td>Memproses logika, akses database</td><td>Apache + PHP</td></tr>
        <tr><td>Database</td><td>Menyimpan data permanen</td><td>MySQL</td></tr>
      </tbody>
    </table>
  </section>

  <section class="lesson">
    <h2>Alur HTTP Request &amp; Response</h2>
    <p>Langkah saat membuka sebuah halaman web:</p>
    <ol class="steps">
      <li>User mengetik URL di browser</li>
      <li>Browser kirim <strong>HTTP Request</strong> (mis. <code>GET /index.php</code>)</li>
      <li>Server proses request (jalankan PHP, query MySQL)</li>
      <li>Server kirim <strong>HTTP Response</strong> berupa HTML</li>
      <li>Browser <em>render</em> HTML jadi tampilan</li>
    </ol>
    <table class="table" style="margin-top:6px">
      <thead><tr><th>Method</th><th>Fungsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><span class="badge">GET</span></td><td>Mengambil data</td><td>Buka halaman, cari produk</td></tr>
        <tr><td><span class="badge">POST</span></td><td>Mengirim data</td><td>Login, submit form, upload</td></tr>
      </tbody>
    </table>
  </section>

  <section class="lesson">
    <h2>Peran Masing-masing Teknologi</h2>
    <table class="table">
      <thead><tr><th>Teknologi</th><th>Peran</th><th>Analogi rumah</th></tr></thead>
      <tbody>
        <tr><td>HTML</td><td>Struktur</td><td>Kerangka rumah</td></tr>
        <tr><td>CSS</td><td>Tampilan</td><td>Cat &amp; dekorasi</td></tr>
        <tr><td>JavaScript</td><td>Interaksi</td><td>Listrik &amp; tombol</td></tr>
        <tr><td>PHP</td><td>Logika</td><td>Otak di belakang</td></tr>
        <tr><td>MySQL</td><td>Data</td><td>Gudang penyimpanan</td></tr>
      </tbody>
    </table>
    <p style="margin-top:14px"><strong>Ingat:</strong> HTML &amp; CSS berjalan di sisi
       <em>client</em> (browser). PHP berjalan di sisi <em>server</em>.</p>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
