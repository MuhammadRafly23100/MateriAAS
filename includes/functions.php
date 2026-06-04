<?php
/* ============================================================
   includes/functions.php  →  Helper functions (dipakai ulang)
   ============================================================ */

// --- Cegah XSS: bersihkan output sebelum ditampilkan ---
function e($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}

// --- Render markup code-block (dipakai ulang oleh code_block & code_demo) ---
// Sudah termasuk tombol Copy + label bahasa. $kode di-escape agar aman.
function render_code_block($kode, $bahasa) {
    echo '<div class="code-block">';
    echo '<span class="code-lang">' . e($bahasa) . '</span>';
    echo '<button type="button" class="copy-btn" onclick="copyCode(this)">Copy</button>';
    echo '<pre><code>' . e(trim($kode)) . '</code></pre>';
    echo '</div>';
}

// --- Tampilkan potongan KODE dengan rapi (untuk halaman panduan) ---
// $bahasa hanya label, $kode di-escape agar aman ditampilkan apa adanya.
function code_block($kode, $bahasa = 'css') {
    render_code_block($kode, $bahasa);
}

// --- Code block + tombol "Run" yang menampilkan output siap-saji ---
// $kode   = potongan kode yang ditampilkan
// $output = hasil yang muncul saat tombol Run diklik (sudah disiapkan, aman)
// $bahasa = label bahasa (php/html/...)
function code_demo($kode, $output, $bahasa = 'php') {
    static $no = 0;
    $no++;
    $id = 'demo-out-' . $no;

    render_code_block($kode, $bahasa);

    echo '<div class="run-bar">';
    echo '<button class="btn btn-sm run-btn" onclick="runDemo(\'' . $id . '\', this)">&#9654; Run</button>';
    echo '</div>';

    echo '<div class="run-output" id="' . $id . '" hidden>';
    echo '<span class="run-label">Output</span>';
    echo '<pre>' . e(trim($output)) . '</pre>';
    echo '</div>';
}

// --- Playground: editor HTML + CSS live, hasil dirender di iframe ---
// $html & $css = kode awal yg muncul di editor (di-escape agar aman di <textarea>)
function playground($html, $css) {
    echo '<div class="pg">';
    echo '  <div class="pg-editors">';
    echo '    <div class="pg-pane">';
    echo '      <div class="pg-pane-head">';
    echo '        <span class="pg-label">HTML</span>';
    echo '        <button type="button" class="pg-copy" onclick="copyPg(this)">Copy</button>';
    echo '      </div>';
    echo '      <textarea class="pg-html" spellcheck="false">' . e(trim($html)) . '</textarea>';
    echo '    </div>';
    echo '    <div class="pg-pane">';
    echo '      <div class="pg-pane-head">';
    echo '        <span class="pg-label">CSS</span>';
    echo '        <button type="button" class="pg-copy" onclick="copyPg(this)">Copy</button>';
    echo '      </div>';
    echo '      <textarea class="pg-css" spellcheck="false">' . e(trim($css)) . '</textarea>';
    echo '    </div>';
    echo '  </div>';
    echo '  <div class="pg-preview">';
    echo '    <span class="pg-label pg-label-prev">&#9679; Hasil (live) — ubah kode di kiri, langsung berubah</span>';
    echo '    <iframe class="pg-frame" title="Preview hasil"></iframe>';
    echo '  </div>';
    echo '</div>';
}

// --- Flash message (pesan sekali tampil, dipakai di demo CRUD) ---
function set_flash($tipe, $pesan) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampil_flash() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        $kelas = $f['tipe'] === 'success' ? 'alert-success' : 'alert-error';
        echo "<div class='alert {$kelas}'>" . e($f['pesan']) . "</div>";
        unset($_SESSION['flash']);
    }
}
