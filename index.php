<?php
/* ============================================================
   index.php  →  Home: daftar isi materi (8 bab)
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Materi Web — CSS & CRUD Lab';
require 'includes/header.php';

// Daftar bab → file tujuan
$bab = [
  ['1', 'Pengantar Web',        'Client-server, HTTP, peran tiap teknologi',      'pengantar.php',     '🌐'],
  ['2', 'HTML',                 'Struktur, tag, form, tabel, HTML semantik',      'panduan-html.php',  '📄'],
  ['3', 'CSS & Layout',         'Selector, Box Model, Flexbox, Grid, responsive', 'panduan-css.php',   '🎨'],
  ['5', 'Praktikum',            'Landing page responsive (HTML+CSS+Layout)',      'praktikum.php',     '🧩'],
  ['6', 'PHP & Web Dinamis',    'Variabel, kondisi, loop, fungsi, $_POST, session','panduan-php.php',  '⚙️'],
  ['7', 'CRUD (PHP + MySQL)',   'Create, Read, Update, Delete + demo langsung',   'panduan-crud.php',  '🗄️'],
  ['8', 'Upload & Arsitektur',  'File upload, struktur folder, analisis kebutuhan','panduan-upload.php','📁'],
];
?>

<main>

  <!-- HERO -->
  <section class="hero">
    <h1>Materi Pemrograman Berbasis Web</h1>
    <p>Academic Achievement Support (AAS) — UNSIKA. Setiap bab berisi penjelasan,
       contoh tampilan, dan kodenya. CRUD-nya bisa langsung dicoba.</p>
    <a href="<?= BASE_URL ?>/pengantar.php" class="btn-cta">Mulai dari Bab 1</a>
  </section>

  <!-- DAFTAR BAB -->
  <section class="services">
    <h2>Daftar Materi</h2>
    <div class="services-grid">
      <?php foreach ($bab as $b): ?>
        <a href="<?= BASE_URL ?>/<?= $b[3] ?>" class="card card-link">
          <div class="card-icon"><?= $b[4] ?></div>
          <h3><span class="badge"><?= $b[0] ?></span> &nbsp;<?= e($b[1]) ?></h3>
          <p><?= e($b[2]) ?></p>
          <span class="card-cta">Buka materi →</span>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
