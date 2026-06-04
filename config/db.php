<?php
/* ============================================================
   config/db.php  →  Koneksi database (SATU TEMPAT)
   Section 7 Handout: "Koneksi di file terpisah"
   ============================================================ */

// --- Mulai session di sini (sebelum ada output apa pun) ---
// Dipakai untuk flash message di demo CRUD.
if (session_status() === PHP_SESSION_NONE) session_start();

// --- Deteksi lingkungan: Railway/produksi punya env var MYSQLHOST ---
$is_production = getenv('MYSQLHOST') !== false;

// --- BASE_URL: di produksi situs ada di root domain (kosong),
//     di lokal (XAMPP) ada di subfolder /PraktikAAS ---
define('BASE_URL', $is_production ? '' : '/PraktikAAS');

// --- Kredensial database ---
// Produksi (Railway): dari environment variable.
// Lokal (XAMPP): default root tanpa password.
$host   = getenv('MYSQLHOST')     ?: 'localhost';
$port   = getenv('MYSQLPORT')     ?: '3306';
$user   = getenv('MYSQLUSER')     ?: 'root';
$pass   = getenv('MYSQLPASSWORD') ?: '';
$dbname = getenv('MYSQLDATABASE') ?: 'db_kampus';

// --- Buat koneksi MySQLi (sertakan port untuk koneksi remote Railway) ---
$conn = new mysqli($host, $user, $pass, $dbname, (int)$port);

// --- Cek koneksi ---
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// --- Pastikan karakter Indonesia (é, ñ, dll) aman ---
$conn->set_charset("utf8mb4");
