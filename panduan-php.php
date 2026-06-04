<?php
/* ============================================================
   panduan-php.php  →  BAB 6: PHP & Web Dinamis
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Panduan PHP — Materi';
require 'includes/header.php';
?>

<main class="materi">

  <section class="materi-head">
    <h1>PHP &amp; Web Dinamis</h1>
    <p>PHP berjalan di <strong>server</strong> dan membuat halaman bisa berubah
       sesuai kondisi/data. Berikut dasar-dasarnya.</p>
  </section>

  <section class="lesson">
    <h2>Statis vs Dinamis</h2>
    <table class="table">
      <thead><tr><th></th><th>Web Statis</th><th>Web Dinamis</th></tr></thead>
      <tbody>
        <tr><td>Teknologi</td><td>HTML + CSS</td><td>HTML + CSS + PHP</td></tr>
        <tr><td>Isi halaman</td><td>Sama untuk semua</td><td>Berubah sesuai kondisi</td></tr>
        <tr><td>Database</td><td>Tidak ada</td><td>Terhubung MySQL</td></tr>
        <tr><td>Contoh</td><td>Landing brochure</td><td>Login, dashboard, toko online</td></tr>
      </tbody>
    </table>
  </section>

  <section class="lesson">
    <h2>1. Variabel &amp; Tipe Data</h2>
    <p>Variabel menyimpan data dan diawali tanda <code>$</code>. Tipe datanya
       otomatis mengikuti isinya. Variabel bisa langsung disisipkan di dalam string
       berpetik ganda. <em>Klik Run untuk lihat hasil <code>echo</code>-nya.</em></p>
    <?php code_demo('<?php
$nama   = "Rafly";      // String
$umur   = 21;            // Integer
$nilai  = 87.5;          // Float
$lulus  = true;          // Boolean
$buah   = ["Apel","Jeruk"]; // Array

echo "Halo, $nama!";     // variabel langsung di string
?>', 'Halo, Rafly!', 'php'); ?>
  </section>

  <section class="lesson">
    <h2>2. Kondisional (if / elseif / else)</h2>
    <p>Program memilih jalur berdasarkan kondisi benar/salah. PHP mengecek dari atas
       ke bawah dan menjalankan blok pertama yang cocok. <em>Coba ganti angkanya
       sendiri lalu klik Run</em> — hasilnya mengikuti kondisi.</p>
    <?php code_block('<?php
$nilai = 75;                      // <- angka ini bisa kamu ubah
if ($nilai >= 80) {
    echo "A - Sangat Baik";
} elseif ($nilai >= 70) {
    echo "B - Baik";
} else {
    echo "C - Cukup";
}
?>', 'php'); ?>

    <div class="run-bar run-input-bar">
      <label for="inp-nilai">$nilai =</label>
      <input type="number" id="inp-nilai" class="run-input" value="75" min="0" max="100" step="1">
      <button class="btn btn-sm run-btn" onclick="runKondisional()">&#9654; Run</button>
    </div>
    <div class="run-output" id="out-kondisional" hidden>
      <span class="run-label">Output</span>
      <pre></pre>
    </div>
  </section>

  <section class="lesson">
    <h2>3. Perulangan (for / foreach / while)</h2>
    <p>Perulangan menjalankan kode berkali-kali tanpa menulis ulang. <code>for</code>
       dipakai saat jumlahnya pasti, <code>foreach</code> untuk menelusuri isi array.
       <em>Klik Run untuk lihat semua keluarannya berurutan.</em></p>
    <?php code_demo('<?php
for ($i = 1; $i <= 3; $i++) {
    echo "Baris ke-$i ";
}

$buah = ["Apel", "Mangga"];
foreach ($buah as $item) {
    echo "- $item ";
}
?>', 'Baris ke-1 Baris ke-2 Baris ke-3 - Apel - Mangga ', 'php'); ?>
  </section>

  <section class="lesson">
    <h2>4. Fungsi</h2>
    <p>Fungsi adalah blok kode yang diberi nama agar bisa dipanggil ulang. Parameter
       bisa punya nilai default (<code>$waktu = "pagi"</code>) sehingga boleh tidak diisi.
       <em>Klik Run untuk lihat dua pemanggilan sekaligus.</em></p>
    <?php code_demo('<?php
function sapa($nama, $waktu = "pagi") {
    return "Selamat $waktu, $nama!";
}
echo sapa("Budi");          // Selamat pagi, Budi!
echo sapa("Ani", "siang");  // Selamat siang, Ani!
?>', 'Selamat pagi, Budi!Selamat siang, Ani!', 'php'); ?>
  </section>

  <section class="lesson">
    <h2>5. Mengambil Data Form ($_POST) ⭐</h2>
    <p>Data dari form HTML dibaca lewat superglobal <code>$_POST</code> (atau <code>$_GET</code>).
       Operator <code>??</code> memberi nilai cadangan jika field kosong agar tidak error.
       <em>Output di bawah mengandaikan form dikirim dengan nama "Rafly" dan nilai 90. Klik Run.</em></p>
    <?php code_demo('<?php
// proses.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama  = $_POST["nama"]  ?? "";
    $nilai = $_POST["nilai"] ?? "";

    if (empty($nama)) {
        echo "Nama tidak boleh kosong!";
    } else {
        echo "Halo, $nama! Nilai: $nilai";
    }
}
?>', 'Halo, Rafly! Nilai: 90', 'php'); ?>
    <table class="table" style="margin-top:14px">
      <thead><tr><th>Superglobal</th><th>Fungsi</th></tr></thead>
      <tbody>
        <tr><td>$_GET</td><td>Data dari URL (<code>?id=5</code>)</td></tr>
        <tr><td>$_POST</td><td>Data dari form method POST</td></tr>
        <tr><td>$_SESSION</td><td>Data sesi user (login)</td></tr>
        <tr><td>$_FILES</td><td>File yang diupload</td></tr>
        <tr><td>$_SERVER</td><td>Info server &amp; request</td></tr>
      </tbody>
    </table>
  </section>

  <section class="lesson">
    <h2>6. Session (untuk Login)</h2>
    <p>Session menyimpan data user di <strong>server</strong> sehingga tetap dikenali
       saat pindah halaman — inilah dasar fitur login. Datanya tidak tampil di layar
       (disimpan di server), jadi output di sini menggambarkan isinya. <em>Klik Run.</em></p>
    <?php code_demo('<?php
session_start();                 // wajib di baris paling atas
$_SESSION["user_id"]  = 1;        // simpan setelah login
$_SESSION["username"] = "rafly";

if (!isset($_SESSION["user_id"])) {  // cek belum login
    header("Location: login.php");
    exit();
}

session_destroy();               // logout
?>', '(tidak ada teks di layar — data disimpan di server)

Isi $_SESSION setelah login:
  user_id  = 1
  username = "rafly"

isset($_SESSION["user_id"]) => true  (sudah login, tidak di-redirect)', 'php'); ?>
  </section>

  <section class="lesson">
    <h2>7. PHP di Dalam HTML (Template)</h2>
    <p><code>&lt;?= $var ?&gt;</code> adalah singkatan dari <code>&lt;?php echo $var; ?&gt;</code>.
       PHP dan HTML bisa dicampur: loop membuat baris tabel otomatis dari data. Operator
       <code>? :</code> (ternary) memilih nilai singkat berdasarkan kondisi.
       <em>Output mengandaikan 2 mahasiswa: Andi (85) &amp; Budi (70). Klik Run.</em></p>
    <?php code_demo('<table>
  <?php foreach ($mahasiswa as $mhs): ?>
  <tr>
    <td><?= $mhs["nama"] ?></td>
    <td><?= $mhs["nilai"] >= 80 ? "A" : "B" ?></td>
  </tr>
  <?php endforeach; ?>
</table>', '<table>
  <tr><td>Andi</td><td>A</td></tr>
  <tr><td>Budi</td><td>B</td></tr>
</table>', 'php'); ?>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
