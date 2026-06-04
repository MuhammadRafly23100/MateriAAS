<?php
/* ============================================================
   crud/edit.php  →  UPDATE: SELECT by id + form (publik)
   ============================================================ */
require '../config/db.php';
require '../includes/functions.php';

$id    = (int) ($_GET['id'] ?? 0);
$error = '';

// Ambil data yang akan diedit
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    set_flash('error', 'Data tidak ditemukan.');
    header("Location: " . BASE_URL . "/panduan-crud.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama']     ?? '');
    $npm      = trim($_POST['npm']      ?? '');
    $email    = trim($_POST['email']    ?? '');
    $jurusan  = trim($_POST['jurusan']  ?? '');
    $semester = (int) ($_POST['semester'] ?? 1);
    $nama_foto = $data['foto'];   // default: foto lama

    if (empty($nama) || empty($npm) || empty($email)) {
        $error = "Nama, NPM, dan Email wajib diisi.";
    } else {
        if (!empty($_FILES['foto']['name'])) {
            $file    = $_FILES['foto'];
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file['type'], $allowed)) {
                $error = "Tipe file tidak diizinkan.";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $error = "Ukuran file maksimal 2MB.";
            } else {
                $ext       = pathinfo($file['name'], PATHINFO_EXTENSION);
                $nama_foto = time() . '_' . uniqid() . '.' . $ext;
                move_uploaded_file($file['tmp_name'], '../uploads/' . $nama_foto);
                if (!empty($data['foto']) && file_exists('../uploads/' . $data['foto'])) {
                    unlink('../uploads/' . $data['foto']);
                }
            }
        }

        if (empty($error)) {
            try {
                $stmt = $conn->prepare(
                    "UPDATE mahasiswa
                     SET nama=?, npm=?, email=?, jurusan=?, semester=?, foto=?
                     WHERE id=?"
                );
                $stmt->bind_param("ssssisi", $nama, $npm, $email, $jurusan, $semester, $nama_foto, $id);
                $stmt->execute();
                set_flash('success', 'Data berhasil diperbarui!');
                header("Location: " . BASE_URL . "/panduan-crud.php");
                exit();
            } catch (mysqli_sql_exception $ex) {
                $error = ($ex->getCode() === 1062)
                    ? "NPM atau Email sudah dipakai data lain."
                    : "Gagal memperbarui: " . $ex->getMessage();
            }
        }
    }
}

$judul = 'Edit Data — Demo CRUD';
require '../includes/header.php';
?>

<div class="page">
  <form method="POST" enctype="multipart/form-data" class="form-card">
    <h2 class="form-title">Edit Mahasiswa</h2>
    <p class="form-sub">Perbarui data mahasiswa di bawah ini.</p>

    <?php if ($error): ?>
      <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <div class="foto-wrap">
      <img src="<?= !empty($data['foto']) ? BASE_URL.'/uploads/'.e($data['foto']) : BASE_URL.'/assets/img/default.png' ?>"
           class="foto-preview" alt="Foto">
    </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= e($data['nama']) ?>" required>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="npm">NPM</label>
        <input type="text" id="npm" name="npm" value="<?= e($data['npm']) ?>" required>
      </div>
      <div class="form-group">
        <label for="semester">Semester</label>
        <input type="number" id="semester" name="semester" min="1" max="14" value="<?= e($data['semester']) ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= e($data['email']) ?>" required>
    </div>
    <div class="form-group">
      <label for="jurusan">Jurusan</label>
      <input type="text" id="jurusan" name="jurusan" value="<?= e($data['jurusan']) ?>">
    </div>
    <div class="form-group">
      <label for="foto">Ganti Foto (opsional, maks 2MB)</label>
      <input type="file" id="foto" name="foto" accept="image/*">
    </div>

    <div class="form-actions">
      <button type="submit" class="btn">Update</button>
      <a href="<?= BASE_URL ?>/panduan-crud.php" class="btn btn-ghost">Batal</a>
    </div>
  </form>
</div>

<?php require '../includes/footer.php'; ?>
