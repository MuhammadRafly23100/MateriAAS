<?php
/* ============================================================
   panduan-html.php  →  BAB 2: HyperText Markup Language
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Panduan HTML — Materi';
require 'includes/header.php';
?>

<main class="materi">

  <section class="materi-head">
    <h1>Panduan HTML</h1>
    <p>HTML = kerangka halaman. Pelajari struktur dasar, tag penting,
       form, tabel, dan HTML semantik.</p>
  </section>

  <section class="lesson">
    <h2>1. Struktur Dasar Dokumen</h2>
    <p>Kerangka wajib setiap halaman HTML5.</p>
    <?php code_block('<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Judul Halaman</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Halo Dunia!</h1>
  <p>Ini paragraf pertama.</p>
</body>
</html>', 'html'); ?>
    <p><strong>Penting:</strong> <code>&lt;meta viewport&gt;</code> wajib agar
       media query (responsive) bekerja.</p>
  </section>

  <section class="lesson">
    <h2>2. Teks, Heading, Link &amp; Gambar</h2>
    <div class="demo-wrap">
      <div class="demo-preview" style="align-items:flex-start">
        <h3 style="margin:0">Heading</h3>
        <p style="margin:0">Paragraf biasa dengan <strong>tebal</strong> &amp; <em>miring</em>.</p>
        <a href="#" style="color:#2563eb">Sebuah tautan</a>
      </div>
      <?php code_block('<h1>Heading Terbesar</h1>
<p>Paragraf <strong>tebal</strong> dan <em>miring</em>.</p>

<a href="about.php">Tautan internal</a>
<a href="https://google.com" target="_blank">Tab baru</a>

<img src="foto.jpg" alt="Deskripsi foto" width="300">', 'html'); ?>
    </div>
  </section>

  <section class="lesson">
    <h2>3. List (Berurutan &amp; Tidak)</h2>
    <div class="demo-wrap">
      <div class="demo-preview" style="align-items:flex-start">
        <ul style="margin:0;padding-left:18px"><li>HTML</li><li>CSS</li></ul>
        <ol style="margin:0;padding-left:18px"><li>Buka editor</li><li>Tulis kode</li></ol>
      </div>
      <?php code_block('<ul>            <!-- tak berurutan -->
  <li>HTML</li>
  <li>CSS</li>
</ul>

<ol>            <!-- berurutan -->
  <li>Buka editor</li>
  <li>Tulis kode</li>
</ol>', 'html'); ?>
    </div>
  </section>

  <section class="lesson">
    <h2>4. Tabel</h2>
    <div class="demo-wrap">
      <div class="demo-preview">
        <table class="table" style="font-size:13px">
          <thead><tr><th>Nama</th><th>Nilai</th></tr></thead>
          <tbody><tr><td>Budi</td><td>85</td></tr><tr><td>Ani</td><td>90</td></tr></tbody>
        </table>
      </div>
      <?php code_block('<table>
  <thead>
    <tr><th>Nama</th><th>Nilai</th></tr>
  </thead>
  <tbody>
    <tr><td>Budi</td><td>85</td></tr>
    <tr><td>Ani</td><td>90</td></tr>
  </tbody>
</table>', 'html'); ?>
    </div>
  </section>

  <section class="lesson">
    <h2>5. Form &amp; Input</h2>
    <div class="demo-wrap">
      <div class="demo-preview" style="align-items:stretch">
        <input class="" type="text" placeholder="Nama" style="padding:8px;border:1px solid #cbd5e1;border-radius:6px">
        <input type="email" placeholder="Email" style="padding:8px;border:1px solid #cbd5e1;border-radius:6px">
        <button class="demo-btn">Kirim</button>
      </div>
      <?php code_block('<form action="proses.php" method="POST">
  <input type="text"  name="nama"  placeholder="Nama" required>
  <input type="email" name="email" required>
  <textarea name="pesan" rows="4"></textarea>
  <select name="kota">
    <option value="krw">Karawang</option>
  </select>
  <button type="submit">Kirim</button>
</form>', 'html'); ?>
    </div>
    <p>Tipe input umum: <code>text</code>, <code>email</code>, <code>password</code>,
       <code>number</code>, <code>date</code>, <code>file</code>,
       <code>checkbox</code>, <code>radio</code>, <code>hidden</code>.</p>
  </section>

  <section class="lesson">
    <h2>6. HTML Semantik ⭐</h2>
    <p>Gunakan tag yang <em>maknanya sesuai</em> isi — bukan <code>&lt;div&gt;</code> untuk segalanya.</p>
    <?php code_block('<header>   <nav> ... </nav> </header>
<main>
  <section>
    <article> ... </article>
  </section>
  <aside> ... </aside>
</main>
<footer> ... </footer>', 'html'); ?>
    <table class="table" style="margin-top:14px">
      <thead><tr><th>Tag</th><th>Untuk</th></tr></thead>
      <tbody>
        <tr><td>&lt;header&gt;</td><td>Bagian atas halaman/section</td></tr>
        <tr><td>&lt;nav&gt;</td><td>Menu navigasi</td></tr>
        <tr><td>&lt;main&gt;</td><td>Konten utama (1 per halaman)</td></tr>
        <tr><td>&lt;section&gt;</td><td>Bagian tematik</td></tr>
        <tr><td>&lt;article&gt;</td><td>Konten independen (kartu/post)</td></tr>
        <tr><td>&lt;footer&gt;</td><td>Bagian bawah</td></tr>
      </tbody>
    </table>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
