<?php
/* ============================================================
   praktikum.php  →  BAB 5: Praktikum HTML + CSS + Layout
   Menampilkan landing page responsive sbg hasil praktik utuh.
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Praktikum Landing Page — Materi';
require 'includes/header.php';
?>

<main class="materi">
  <section class="materi-head">
    <h1>Praktikum: Landing Page Responsive</h1>
    <p>Gabungan HTML + CSS + Layout (Flexbox &amp; Grid) jadi satu halaman utuh.
       Tiap bagian di bawah punya <strong>editor live</strong>: ubah HTML/CSS-nya di kiri,
       hasilnya langsung berubah di kanan. Silakan utak-atik! 🎮</p>
  </section>

  <section class="lesson">
    <h2>Struktur yang dipraktikkan</h2>
    <table class="table">
      <thead><tr><th>Bagian</th><th>Teknik Layout</th></tr></thead>
      <tbody>
        <tr><td>Navbar</td><td>Flexbox · <code>justify-content: space-between</code></td></tr>
        <tr><td>Hero</td><td>Flexbox · <code>column</code> + center</td></tr>
        <tr><td>Services (kartu)</td><td>CSS Grid · <code>auto-fit minmax</code></td></tr>
        <tr><td>Testimoni</td><td>Flexbox · <code>flex-wrap</code></td></tr>
        <tr><td>Semua bagian</td><td>Responsive · <code>@media (max-width:768px)</code></td></tr>
      </tbody>
    </table>
    <p>👉 Materi tiap teknik di atas ada di
       <a href="<?= BASE_URL ?>/panduan-css.php"><strong>Panduan CSS</strong></a>.</p>
  </section>

  <!-- ===== 1. HERO (Flexbox column + center) ===== -->
  <section class="lesson">
    <h2>1. Hero — Flexbox (kolom &amp; rata tengah)</h2>
    <p>Bagian sambutan paling atas. Kuncinya <code>display:flex</code> +
       <code>flex-direction:column</code> + <code>align-items:center</code> agar judul,
       teks, dan tombol tersusun ke bawah dan rata tengah. Coba ganti warna
       <code>background</code> atau ukuran <code>font-size</code>-nya.</p>
    <?php playground('<div class="hero">
  <h2>Solusi Digital Terbaik</h2>
  <p>Kami membantu bisnis Anda bertumbuh di era digital.</p>
  <button class="btn">Lihat Layanan</button>
</div>', '.hero {
  display: flex;
  flex-direction: column;   /* susun ke bawah */
  align-items: center;      /* tengah mendatar */
  justify-content: center;
  text-align: center;
  gap: 14px;
  padding: 50px 20px;
  background: linear-gradient(135deg, #2563eb, #1e3a8a);
  color: #fff;
}
.hero h2 { font-size: 28px; }
.hero p  { opacity: .9; }
.btn {
  background: #fff;
  color: #2563eb;
  border: none;
  padding: 12px 22px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
}'); ?>
  </section>

  <!-- ===== 2. SERVICES (CSS Grid auto-fit) ===== -->
  <section class="lesson">
    <h2>2. Services — CSS Grid (kartu responsif)</h2>
    <p>Empat kartu layanan yang otomatis menyesuaikan jumlah kolom dengan lebar layar,
       tanpa media query. Rahasianya:
       <code>grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))</code>.
       Coba kecilkan jendela / ubah angka <code>150px</code> dan lihat kolomnya berubah.</p>
    <?php playground('<section class="services">
  <h3>Layanan Kami</h3>
  <div class="grid">
    <div class="card"><h4>Web Design</h4><p>Desain modern & responsif.</p></div>
    <div class="card"><h4>Development</h4><p>Web profesional PHP & MySQL.</p></div>
    <div class="card"><h4>Database</h4><p>Pengelolaan data efisien.</p></div>
    <div class="card"><h4>Maintenance</h4><p>Pemeliharaan berkala.</p></div>
  </div>
</section>', '.services { padding: 28px 20px; text-align: center; }
.services h3 { margin-bottom: 18px; }
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 14px;
}
.card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 18px;
  text-align: left;
}
.card h4 { color: #2563eb; margin-bottom: 6px; }
.card p  { color: #64748b; font-size: 14px; }'); ?>
  </section>

  <!-- ===== 3. TESTIMONI (Flexbox flex-wrap) ===== -->
  <section class="lesson">
    <h2>3. Testimoni — Flexbox (<code>flex-wrap</code>)</h2>
    <p>Kartu testimoni berjajar mendatar, tapi <code>flex-wrap: wrap</code> membuatnya
       turun baris otomatis saat tak muat. <code>flex: 1 1 200px</code> mengatur lebar
       dasar tiap kartu. Coba tambah/hapus satu kartu di HTML.</p>
    <?php playground('<section class="testi">
  <h3>Apa Kata Mereka</h3>
  <div class="wrap">
    <div class="t-card"><p>"Layanan sangat memuaskan!"</p><strong>— Budi</strong></div>
    <div class="t-card"><p>"Tim profesional & responsif."</p><strong>— Siti</strong></div>
    <div class="t-card"><p>"Hasil melebihi ekspektasi."</p><strong>— Ahmad</strong></div>
  </div>
</section>', '.testi { padding: 28px 20px; text-align: center; }
.testi h3 { margin-bottom: 18px; }
.wrap {
  display: flex;
  flex-wrap: wrap;          /* turun baris bila sempit */
  justify-content: center;
  gap: 14px;
}
.t-card {
  flex: 1 1 200px;          /* lebar dasar 200px, boleh tumbuh */
  max-width: 260px;
  background: #eff6ff;
  border-left: 4px solid #22d3ee;
  border-radius: 12px;
  padding: 16px;
}
.t-card p { font-style: italic; color: #475569; margin-bottom: 10px; }
.t-card strong { color: #2563eb; font-size: 14px; }'); ?>
  </section>
</main>

<?php require 'includes/footer.php'; ?>
