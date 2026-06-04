<?php
/* ============================================================
   panduan-crud.php  →  Materi CRUD + DEMO yang bisa dicoba publik
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Panduan CRUD — Materi Web';
require 'includes/header.php';

// READ: ambil semua data untuk demo
$result = $conn->query("SELECT * FROM mahasiswa ORDER BY id DESC");
$total  = $result->num_rows;
?>

<main class="materi">

  <!-- ===== Penjelasan ===== -->
  <section class="materi-head">
    <h1>Panduan CRUD (PHP + MySQL)</h1>
    <p>CRUD adalah 4 operasi dasar pada data: <strong>Create</strong> (tambah),
       <strong>Read</strong> (baca), <strong>Update</strong> (ubah), dan
       <strong>Delete</strong> (hapus). Coba langsung demonya di bawah — data tersimpan
       nyata di database <code>db_kampus</code> tabel <code>mahasiswa</code>.</p>
  </section>

  <!-- ===== Ringkasan kode tiap operasi ===== -->
  <section class="lesson">
    <h2>1. Koneksi Database</h2>
    <p>Semua operasi butuh koneksi. Simpan di satu file <code>config/db.php</code>.</p>
    <?php code_block('$conn = new mysqli("localhost", "root", "", "db_kampus");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}', 'php'); ?>
    <ul class="method-list">
      <li><code>new mysqli(host, user, pass, db)</code> — membuat objek koneksi ke server MySQL. Argumennya: host, username, password, dan nama database.</li>
      <li><code>$conn->connect_error</code> — properti berisi pesan error bila koneksi gagal; bernilai <code>null</code> jika berhasil.</li>
      <li><code>die("...")</code> — menghentikan eksekusi skrip dan menampilkan pesan. Dipakai agar program tidak lanjut saat koneksi gagal.</li>
    </ul>
  </section>

  <section class="lesson">
    <h2>2. CREATE — Tambah Data</h2>
    <p>Pakai <em>prepared statement</em> agar aman dari SQL injection.</p>
    <?php code_block('$stmt = $conn->prepare(
    "INSERT INTO mahasiswa (nama, npm, email) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $nama, $npm, $email);
$stmt->execute();', 'php'); ?>
    <ul class="method-list">
      <li><code>$conn->prepare(sql)</code> — menyiapkan query dengan tanda <code>?</code> sebagai placeholder (prepared statement), pondasi keamanan dari SQL injection.</li>
      <li><code>$stmt->bind_param("sss", ...)</code> — mengisi tiap <code>?</code> dengan nilai. Tiap huruf = tipe data: <code>s</code>=string, <code>i</code>=integer, <code>d</code>=double, <code>b</code>=blob. <code>"sss"</code> artinya tiga string.</li>
      <li><code>$stmt->execute()</code> — mengirim dan menjalankan query ke database.</li>
    </ul>
  </section>

  <section class="lesson">
    <h2>3. READ — Tampilkan Data</h2>
    <p>Ambil semua baris lalu loop dengan <code>fetch_assoc()</code>.</p>
    <?php code_block('$result = $conn->query("SELECT * FROM mahasiswa");
while ($row = $result->fetch_assoc()) {
    echo $row["nama"];
}', 'php'); ?>
    <ul class="method-list">
      <li><code>$conn->query(sql)</code> — menjalankan query <code>SELECT</code> secara langsung dan mengembalikan objek hasil (result set).</li>
      <li><code>$result->fetch_assoc()</code> — mengambil <strong>satu</strong> baris hasil sebagai array asosiatif sehingga bisa diakses lewat nama kolom (<code>$row["nama"]</code>). Mengembalikan <code>null</code> saat baris habis.</li>
      <li><code>$result->num_rows</code> — properti berisi jumlah baris hasil (dipakai untuk mengecek data kosong/tidak).</li>
      <li><code>while (...)</code> — perulangan yang terus berjalan selama masih ada baris, sehingga semua data terbaca satu per satu.</li>
    </ul>
  </section>

  <section class="lesson">
    <h2>4. UPDATE — Ubah Data</h2>
    <p>Langkahnya sama seperti CREATE (<em>prepare → bind → execute</em>), bedanya query-nya <code>UPDATE</code> dan wajib pakai <code>WHERE</code>.</p>
    <?php code_block('$stmt = $conn->prepare(
    "UPDATE mahasiswa SET nama=?, email=? WHERE id=?"
);
$stmt->bind_param("ssi", $nama, $email, $id);
$stmt->execute();', 'php'); ?>
    <ul class="method-list">
      <li><code>$conn->prepare("UPDATE ... WHERE id=?")</code> — menyiapkan query ubah data. Klausa <code>WHERE id=?</code> sangat penting: tanpa itu, <strong>semua</strong> baris akan ikut terubah.</li>
      <li><code>$stmt->bind_param("ssi", ...)</code> — mengisi placeholder. <code>"ssi"</code> = dua string (nama, email) + satu integer (id), sesuai urutan <code>?</code>.</li>
      <li><code>$stmt->execute()</code> — menjalankan perubahan ke database.</li>
    </ul>
  </section>

  <section class="lesson">
    <h2>5. DELETE — Hapus Data</h2>
    <?php code_block('$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();', 'php'); ?>
    <ul class="method-list">
      <li><code>$conn->prepare("DELETE ... WHERE id=?")</code> — menyiapkan query hapus. <code>WHERE id=?</code> wajib agar hanya satu baris yang dihapus, bukan seluruh tabel.</li>
      <li><code>$stmt->bind_param("i", $id)</code> — mengisi placeholder dengan <code>id</code>. <code>"i"</code> menandakan tipenya integer.</li>
      <li><code>$stmt->execute()</code> — menjalankan penghapusan ke database.</li>
    </ul>
  </section>

  <!-- ===== DEMO LANGSUNG ===== -->
  <section class="lesson">
    <h2>🚀 Demo Langsung — Silakan Coba</h2>
    <p>Tambah, edit, atau hapus data di bawah ini. Semua tersimpan di database.</p>

    <?php tampil_flash(); ?>

    <div class="page-head">
      <h3>Data Mahasiswa <span class="badge"><?= $total ?></span></h3>
      <a href="<?= BASE_URL ?>/crud/tambah.php" class="btn">+ Tambah Data</a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>No</th><th>Foto</th><th>Nama</th><th>NPM</th>
          <th>Email</th><th>Jurusan</th><th>Smt</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($total > 0): $no = 1; ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td>
                <img src="<?= !empty($row['foto']) ? BASE_URL.'/uploads/'.e($row['foto']) : BASE_URL.'/assets/img/default.png' ?>"
                     class="thumb" alt="Foto">
              </td>
              <td><?= e($row['nama']) ?></td>
              <td><?= e($row['npm']) ?></td>
              <td><?= e($row['email']) ?></td>
              <td><?= e($row['jurusan']) ?></td>
              <td><span class="badge"><?= e($row['semester']) ?></span></td>
              <td>
                <div class="actions">
                  <a href="<?= BASE_URL ?>/crud/edit.php?id=<?= $row['id'] ?>" class="btn btn-sm">Edit</a>
                  <a href="<?= BASE_URL ?>/crud/hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                     onclick="return konfirmHapus()">Hapus</a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="8" class="empty-state">Belum ada data. Klik &ldquo;+ Tambah Data&rdquo;.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
