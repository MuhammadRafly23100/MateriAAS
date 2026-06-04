/* ============================================================
   script.js  —  Interaksi sederhana sisi client
   ============================================================ */

// --- Toggle menu navbar di HP (tombol hamburger) ---
function toggleMenu() {
  const menu = document.getElementById('navMenu');
  if (menu) menu.classList.toggle('open');
}

// --- Konfirmasi sebelum hapus data (demo CRUD) ---
function konfirmHapus() {
  return confirm('Yakin ingin menghapus data ini?');
}

// --- Inti: salin teks ke clipboard + umpan balik tombol ---
function salinTeks(teks, btn) {
  const sukses = () => {
    btn.classList.add('copied');
    btn.textContent = 'Tersalin!';
    setTimeout(() => {
      btn.classList.remove('copied');
      btn.textContent = 'Copy';
    }, 1500);
  };
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(teks).then(sukses).catch(() => fallbackCopy(teks, sukses));
  } else {
    fallbackCopy(teks, sukses);
  }
}

// --- Tombol Copy: salin isi code-block ke clipboard ---
function copyCode(btn) {
  const block = btn.closest('.code-block');
  const code = block ? block.querySelector('code') : null;
  if (code) salinTeks(code.innerText, btn);
}

// --- Tombol Copy playground: salin isi terkini textarea (HTML/CSS) ---
function copyPg(btn) {
  const pane = btn.closest('.pg-pane');
  const ta = pane ? pane.querySelector('textarea') : null;
  if (ta) salinTeks(ta.value, btn);
}

// Cadangan untuk browser lama / koneksi non-HTTPS
function fallbackCopy(teks, sukses) {
  const ta = document.createElement('textarea');
  ta.value = teks;
  ta.style.position = 'fixed';
  ta.style.opacity = '0';
  document.body.appendChild(ta);
  ta.select();
  try { document.execCommand('copy'); sukses(); } catch (e) {}
  document.body.removeChild(ta);
}

// ============================================================
//  Playground (praktikum.php): editor HTML+CSS → render live di iframe
// ============================================================
function buildSrcdoc(css, html) {
  return '<!DOCTYPE html><html lang="id"><head><meta charset="utf-8">' +
         '<style>*{box-sizing:border-box}body{margin:0;' +
         'font-family:Poppins,system-ui,sans-serif;color:#1e293b}' +
         css + '</style></head><body>' + html + '</body></html>';
}

function initPlaygrounds() {
  document.querySelectorAll('.pg').forEach(function (pg) {
    const htmlEl = pg.querySelector('.pg-html');
    const cssEl  = pg.querySelector('.pg-css');
    const frame  = pg.querySelector('.pg-frame');
    if (!htmlEl || !cssEl || !frame) return;

    const render = function () {
      frame.srcdoc = buildSrcdoc(cssEl.value, htmlEl.value);
    };
    htmlEl.addEventListener('input', render);
    cssEl.addEventListener('input', render);
    render();   // render awal

    // Tab → sisipkan 2 spasi, jangan pindah fokus keluar textarea
    [htmlEl, cssEl].forEach(function (ta) {
      ta.addEventListener('keydown', function (e) {
        if (e.key === 'Tab') {
          e.preventDefault();
          const s = ta.selectionStart, en = ta.selectionEnd;
          ta.value = ta.value.slice(0, s) + '  ' + ta.value.slice(en);
          ta.selectionStart = ta.selectionEnd = s + 2;
          render();
        }
      });
    });
  });
}
initPlaygrounds();

// ============================================================
//  Demo CSS interaktif (panduan-css.php): tombol ubah preview + kode
// ============================================================
// Konfigurasi tiap demo: selector yg ditampilkan di kode, baris tetap, & urutan.
const itrDemos = {
  flexDemo: {
    selector: '.container',
    base:  { 'display': 'flex', 'height': '150px' },
    order: ['display', 'justify-content', 'align-items', 'height']
  },
  textDemo: {
    selector: '.teks',
    base:  {},
    order: ['text-align']
  },
  posDemo: {
    selector: '.box',
    base:  { 'top': '20px', 'left': '20px' },
    order: ['position', 'top', 'left']
  }
};

// Nilai dinamis (yg diubah lewat tombol). Harus cocok dgn tombol .active awal.
const itrState = {
  flexDemo: { 'justify-content': 'flex-start', 'align-items': 'flex-start' },
  textDemo: { 'text-align': 'left' },
  posDemo:  { 'position': 'static' }
};

// Susun ulang teks kode CSS dari base + state saat ini.
function renderItrCode(target) {
  const cfg = itrDemos[target];
  const codeEl = document.getElementById(target + '-code');
  if (!cfg || !codeEl) return;

  const semua = Object.assign({}, cfg.base, itrState[target]);
  let teks = cfg.selector + ' {\n';
  cfg.order.forEach(function (nama) {
    if (semua[nama] !== undefined) teks += '  ' + nama + ': ' + semua[nama] + ';\n';
  });
  teks += '}';
  codeEl.textContent = teks;
}

// Terapkan style ke elemen preview sesuai base + state.
function applyItrStyle(target) {
  const el = document.getElementById(target);
  const cfg = itrDemos[target];
  if (!el || !cfg) return;
  const semua = Object.assign({}, cfg.base, itrState[target]);
  Object.keys(semua).forEach(function (prop) {
    el.style.setProperty(prop, semua[prop]);
  });
}

// Pasang event ke semua tombol + render awal.
function initItrDemos() {
  // render awal tiap demo yg ada di halaman ini
  Object.keys(itrDemos).forEach(function (target) {
    if (document.getElementById(target)) {
      applyItrStyle(target);
      renderItrCode(target);
    }
  });

  document.querySelectorAll('.itr-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const target = btn.dataset.target;
      const prop   = btn.dataset.prop;
      const val    = btn.dataset.val;
      if (!itrState[target]) return;

      // tandai tombol aktif dalam grup yg sama
      btn.parentNode.querySelectorAll('.itr-btn').forEach(function (b) {
        b.classList.remove('active');
      });
      btn.classList.add('active');

      // update state → terapkan ke preview → perbarui kode
      itrState[target][prop] = val;
      applyItrStyle(target);
      renderItrCode(target);
    });
  });
}

initItrDemos();

// --- Demo interaktif: kondisional (user input angka sendiri) ---
function runKondisional() {
  const inp = document.getElementById('inp-nilai');
  const out = document.getElementById('out-kondisional');
  if (!inp || !out) return;

  const nilai = parseFloat(inp.value);
  let hasil;
  if (inp.value === '' || isNaN(nilai)) {     // input kosong / bukan angka
    hasil = 'Masukkan angka dulu ya.';
  } else if (nilai >= 80) {                    // logika sama persis dgn kode PHP
    hasil = 'A - Sangat Baik';
  } else if (nilai >= 70) {
    hasil = 'B - Baik';
  } else {
    hasil = 'C - Cukup';
  }

  out.removeAttribute('hidden');
  out.classList.add('show');
  out.querySelector('pre').textContent = hasil;
}

// --- Tombol "Run" pada panduan: tampilkan/sembunyikan output siap-saji ---
function runDemo(id, btn) {
  const out = document.getElementById(id);
  if (!out) return;

  const tampil = out.hasAttribute('hidden');
  if (tampil) {
    out.removeAttribute('hidden');
    out.classList.add('show');
    if (btn) btn.innerHTML = '&#10227; Jalankan ulang';
  } else {
    out.setAttribute('hidden', '');
    out.classList.remove('show');
    if (btn) btn.innerHTML = '&#9654; Run';
  }
}
