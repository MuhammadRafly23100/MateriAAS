<?php
/* ============================================================
   panduan-css.php  →  Materi styling CSS (contoh + kode)
   ============================================================ */
require 'config/db.php';
require 'includes/functions.php';

$judul = 'Panduan Styling CSS — Materi Web';
require 'includes/header.php';
?>

<main class="materi">

  <section class="materi-head">
    <h1>Panduan Styling CSS</h1>
    <p>Setiap topik menampilkan <strong>hasil tampilan</strong> di kiri dan
       <strong>kode CSS</strong>-nya di kanan. Tinggal tiru kodenya.</p>
  </section>

  <!-- 1. Selector -->
  <section class="lesson">
    <h2>1. Jenis Selector</h2>
    <p>CSS memilih elemen lewat selector: tag, <code>.class</code>, atau <code>#id</code>.</p>
    <div class="demo-wrap">
      <div class="demo-preview demo-text">
        <span class="el">p &rarr; semua paragraf</span>
        <span class="cls">.judul &rarr; berdasar class</span>
        <span class="idd">#hero &rarr; berdasar id</span>
      </div>
      <?php code_block('p        { color: #334155; }   /* element */
.judul   { color: #2563eb; }   /* class   */
#hero    { color: #dc2626; }   /* id      */', 'css'); ?>
    </div>
  </section>

  <!-- 2. Box Model -->
  <section class="lesson">
    <h2>2. Box Model (margin · border · padding)</h2>
    <p>Setiap elemen punya isi (content), <em>padding</em>, <em>border</em>, dan <em>margin</em>.</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <div class="demo-box">CONTENT</div>
      </div>
      <?php code_block('.demo-box {
  width: 150px;
  padding: 18px;                 /* jarak isi ke border */
  border: 4px solid #3b82f6;     /* garis tepi          */
  margin: 16px;                  /* jarak ke elemen lain */
}', 'css'); ?>
    </div>
  </section>

  <!-- 3. Tombol + hover -->
  <section class="lesson">
    <h2>3. Tombol &amp; Efek Hover</h2>
    <p>Arahkan kursor ke tombol untuk melihat perubahan warna (<code>:hover</code>).</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <button class="demo-btn">Klik Saya</button>
      </div>
      <?php code_block('.demo-btn {
  background: #2563eb;
  color: #fff;
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.2s;   /* animasi halus */
}
.demo-btn:hover { background: #1d4ed8; }', 'css'); ?>
    </div>
  </section>

  <!-- 4. Card + shadow -->
  <section class="lesson">
    <h2>4. Kartu dengan Bayangan</h2>
    <p>Kombinasi <code>border-radius</code> + <code>box-shadow</code> membuat kartu modern.</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <div class="demo-card">
          <h4>Judul Kartu</h4>
          <p>Deskripsi singkat isi kartu.</p>
        </div>
      </div>
      <?php code_block('.demo-card {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.12);
  border-top: 4px solid #2563eb;
}', 'css'); ?>
    </div>
  </section>

  <!-- 5. Flexbox navbar -->
  <section class="lesson">
    <h2>5. Flexbox — Navbar (logo kiri, menu kanan)</h2>
    <p>Teknik andalan: <code>justify-content: space-between</code>.</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <div class="demo-nav">
          <span class="brand">BrandKu</span>
          <span class="links"><a href="#">Home</a><a href="#">About</a></span>
        </div>
      </div>
      <?php code_block('.demo-nav {
  display: flex;
  justify-content: space-between;  /* dorong ke dua ujung */
  align-items: center;             /* sejajar tengah       */
  padding: 12px 18px;
}', 'css'); ?>
    </div>
  </section>

  <!-- 6. Posisi & Perataan — INTERAKTIF -->
  <section class="lesson">
    <h2>6. Posisi &amp; Perataan — Coba Sendiri 🎮</h2>
    <p>Klik tombol pada tiap demo: <strong>tampilan langsung berubah</strong> dan
       <strong>kodenya ikut menyesuaikan</strong>. Cara paling cepat memahami cara
       menaruh elemen di tengah, pinggir, atas, atau bawah.</p>

    <!-- 6a. Flexbox -->
    <h3>a. Flexbox — <code>justify-content</code> &amp; <code>align-items</code></h3>
    <p><code>justify-content</code> mengatur posisi mendatar (kiri ↔ kanan),
       <code>align-items</code> mengatur posisi tegak (atas ↕ bawah).</p>
    <div class="itr">
      <div class="itr-controls">
        <div class="itr-group">
          <span class="itr-label">justify-content</span>
          <button class="itr-btn active" data-target="flexDemo" data-prop="justify-content" data-val="flex-start">flex-start</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="justify-content" data-val="center">center</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="justify-content" data-val="flex-end">flex-end</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="justify-content" data-val="space-between">space-between</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="justify-content" data-val="space-around">space-around</button>
        </div>
        <div class="itr-group">
          <span class="itr-label">align-items</span>
          <button class="itr-btn active" data-target="flexDemo" data-prop="align-items" data-val="flex-start">flex-start</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="align-items" data-val="center">center</button>
          <button class="itr-btn" data-target="flexDemo" data-prop="align-items" data-val="flex-end">flex-end</button>
        </div>
      </div>
      <div class="demo-wrap">
        <div class="itr-stage">
          <div class="itr-flex" id="flexDemo">
            <div class="kotak">1</div><div class="kotak">2</div><div class="kotak">3</div>
          </div>
        </div>
        <div class="code-block">
          <span class="code-lang">css</span>
          <button type="button" class="copy-btn" onclick="copyCode(this)">Copy</button>
          <pre><code id="flexDemo-code"></code></pre>
        </div>
      </div>
    </div>

    <!-- 6b. text-align -->
    <h3 style="margin-top:26px">b. <code>text-align</code> — Rata Teks</h3>
    <p>Mengatur perataan teks di dalam elemen: kiri, tengah, kanan, atau rata kiri-kanan (justify).</p>
    <div class="itr">
      <div class="itr-controls">
        <div class="itr-group">
          <span class="itr-label">text-align</span>
          <button class="itr-btn active" data-target="textDemo" data-prop="text-align" data-val="left">left</button>
          <button class="itr-btn" data-target="textDemo" data-prop="text-align" data-val="center">center</button>
          <button class="itr-btn" data-target="textDemo" data-prop="text-align" data-val="right">right</button>
          <button class="itr-btn" data-target="textDemo" data-prop="text-align" data-val="justify">justify</button>
        </div>
      </div>
      <div class="demo-wrap">
        <div class="itr-stage">
          <p class="paragraf" id="textDemo">Belajar CSS itu paling cepat lewat praktik langsung.
            Coba klik tombol di atas dan perhatikan bagaimana posisi teks ini berubah mengikuti
            nilai text-align yang dipilih. Pilih "justify" untuk melihat teks dirapikan rata di
            kedua sisi.</p>
        </div>
        <div class="code-block">
          <span class="code-lang">css</span>
          <button type="button" class="copy-btn" onclick="copyCode(this)">Copy</button>
          <pre><code id="textDemo-code"></code></pre>
        </div>
      </div>
    </div>

    <!-- 6c. position -->
    <h3 style="margin-top:26px">c. <code>position</code> — static / relative / absolute</h3>
    <p>Kotak biru di-set <code>top: 20px; left: 20px</code>. Perhatikan: saat
       <code>static</code> offset itu <em>diabaikan</em>; <code>relative</code> menggeser dari
       posisi aslinya; <code>absolute</code> mengeluarkannya dari alur (teks merapat seolah kotak tak ada).</p>
    <div class="itr">
      <div class="itr-controls">
        <div class="itr-group">
          <span class="itr-label">position</span>
          <button class="itr-btn active" data-target="posDemo" data-prop="position" data-val="static">static</button>
          <button class="itr-btn" data-target="posDemo" data-prop="position" data-val="relative">relative</button>
          <button class="itr-btn" data-target="posDemo" data-prop="position" data-val="absolute">absolute</button>
        </div>
      </div>
      <div class="demo-wrap">
        <div class="itr-pos">
          <span>Teks sebelum kotak. </span>
          <span class="kotak-biru" id="posDemo">box</span>
          <span> Teks sesudah kotak — amati apakah ikut terdorong atau tidak.</span>
        </div>
        <div class="code-block">
          <span class="code-lang">css</span>
          <button type="button" class="copy-btn" onclick="copyCode(this)">Copy</button>
          <pre><code id="posDemo-code"></code></pre>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. Grid auto-fit -->
  <section class="lesson">
    <h2>7. CSS Grid — Kartu Responsif Otomatis</h2>
    <p><code>auto-fit</code> + <code>minmax</code> = kolom menyesuaikan lebar layar tanpa media query.</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <div class="demo-grid">
          <div>1</div><div>2</div><div>3</div><div>4</div>
        </div>
      </div>
      <?php code_block('.demo-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
  gap: 12px;
}', 'css'); ?>
    </div>
  </section>

  <!-- 8. CSS Variables -->
  <section class="lesson">
    <h2>8. CSS Variables (Custom Properties)</h2>
    <p>Definisikan warna sekali di <code>:root</code>, pakai berkali-kali via <code>var()</code>.</p>
    <div class="demo-wrap">
      <div class="demo-preview">
        <button class="demo-btn">Pakai var()</button>
      </div>
      <?php code_block(':root {
  --warna-utama: #2563eb;
  --radius: 8px;
}
.tombol {
  background: var(--warna-utama);
  border-radius: var(--radius);
}', 'css'); ?>
    </div>
  </section>

  <!-- 9. Responsive -->
  <section class="lesson">
    <h2>9. Responsive — Media Query</h2>
    <p>Ubah tampilan pada lebar layar tertentu. Breakpoint umum: 768px (tablet).</p>
    <?php code_block('/* Default: 1 kolom (HP) */
.grid { grid-template-columns: 1fr; }

/* Tablet ke atas: 2 kolom */
@media (min-width: 768px) {
  .grid { grid-template-columns: repeat(2, 1fr); }
}', 'css'); ?>
  </section>

</main>

<?php require 'includes/footer.php'; ?>
