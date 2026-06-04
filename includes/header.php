<?php
/* ============================================================
   includes/header.php  →  Navbar materi belajar (terbuka)
   Halaman boleh men-set $judul sebelum require.
   ============================================================ */
$judul = $judul ?? 'Materi Web — AAS UNSIKA';

// Tandai menu aktif berdasarkan file yang sedang dibuka
$now = basename($_SERVER['SCRIPT_NAME']);

// Daftar bab → ditampilkan langsung di navbar (label singkat)
$nav_materi = [
  ['pengantar.php',      'Pengantar'],
  ['panduan-html.php',   'HTML'],
  ['panduan-css.php',    'CSS'],
  ['praktikum.php',      'Praktikum'],
  ['panduan-php.php',    'PHP'],
  ['panduan-crud.php',   'CRUD'],
  ['panduan-upload.php', 'Upload'],
];
// Halaman anak CRUD (tambah/edit/hapus) tetap menyorot menu "CRUD"
$crud_child = ['tambah.php', 'edit.php', 'hapus.php'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($judul) ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<!-- ===== NAVBAR (sama di semua halaman) ===== -->
<header>
  <nav class="navbar">
    <a href="<?= BASE_URL ?>/index.php" class="logo">CSS&amp;CRUD<span style="color:#fff">Lab</span></a>

    <button class="nav-toggle" onclick="toggleMenu()" aria-label="Menu">&#9776;</button>

    <div class="nav-collapse" id="navMenu">
      <ul class="nav-menu">
        <li><a class="<?= $now === 'index.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php">Home</a></li>
        <?php foreach ($nav_materi as $m):
          $aktif = ($now === $m[0]) ? 'active' : '';
          if ($m[0] === 'panduan-crud.php' && in_array($now, $crud_child)) $aktif = 'active';
        ?>
          <li><a class="<?= $aktif ?>" href="<?= BASE_URL ?>/<?= $m[0] ?>"><?= $m[1] ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>
</header>
