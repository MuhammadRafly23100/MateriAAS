<?php
/* ============================================================
   crud/tambah.php  →  CREATE: form + proses tambah (publik)
   ============================================================ */
require '../config/db.php';
require '../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama']     ?? '');
    $npm      = trim($_POST['npm']      ?? '');
    $email    = trim($_POST['email']    ?? '');
    $jurusan  = trim($_POST['jurusan']  ?? '');
    $semester = (int) ($_POST['semester'] ?? 1);

    if (empty($nama) || empty($npm) || empty($email)) {
        $error = "Nama, NPM, dan Email wajib diisi.";
    } else {
        $nama_foto = null;

        // Upload foto (opsional) + validasi tipe & ukuran
        if (!empty($_FILES['foto']['name'])) {
            $file    = $_FILES['foto'];
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file['type'], $allowed)) {
                $error = "Tipe file tidak diizinkan (JPG, PNG, GIF, WEBP).";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $error = "Ukuran file maksimal 2MB.";
            } else {
                $ext       = pathinfo($file['name'], PATHINFO_EXTENSION);
                $nama_foto = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($file['tmp_name'], '../uploads/' . $nama_foto);
            }
        }

        if (empty($error)) {
            try {
                $stmt = $conn->prepare(
                    "INSERT INTO mahasiswa (nama, npm, email, jurusan, semester, foto)
                     VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("ssssis", $nama, $npm, $email, $jurusan, $semester, $nama_foto);
                $stmt->execute();
                set_flash('success', 'Data berhasil ditambahkan!');
                header("Location: " . BASE_URL . "/panduan-crud.php");
                exit();
            } catch (mysqli_sql_exception $ex) {
                $error = ($ex->getCode() === 1062)
                    ? "NPM atau Email sudah terdaftar."
                    : "Gagal menyimpan: " . $ex->getMessage();
            }
        }
    }
}

$judul = 'Tambah Data — Demo CRUD';
require '../includes/header.php';
?>

<div class="page">
  <form method="POST" enctype="multipart/form-data" class="form-card">
    <h2 class="form-title">Tambah Mahasiswa</h2>
    <p class="form-sub">Lengkapi data mahasiswa baru di bawah ini.</p>

    <?php if ($error): ?>
      <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="npm">NPM</label>
        <input type="text" id="npm" name="npm" required>
      </div>
      <div class="form-group">
        <label for="semester">Semester</label>
        <input type="number" id="semester" name="semester" min="1" max="14" value="1">
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <input type="text" id="jurusan" name="jurusan">
    </div>
    <div class="form-group">
      <label for="foto">Foto (maks 2MB)</label>
      <input type="file" id="foto" name="foto" accept="image/*">
    </div>

    <div class="form-actions">
      <button type="submit" class="btn">Simpan</button>
      <a href="<?= BASE_URL ?>/panduan-crud.php" class="btn btn-ghost">Batal</a>
    </div>
  </form>
</div>

<?php require '../includes/footer.php'; ?>
