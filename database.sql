-- ============================================================
--  database.sql  →  Struktur database (DDL) + data contoh
--  Import lewat phpMyAdmin atau:  mysql -u root < database.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_kampus
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_kampus;

-- ---- Tabel mahasiswa ----
CREATE TABLE IF NOT EXISTS mahasiswa (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100) NOT NULL,
    npm        VARCHAR(20)  UNIQUE NOT NULL,
    email      VARCHAR(150) UNIQUE NOT NULL,
    jurusan    VARCHAR(100),
    semester   INT DEFAULT 1,
    foto       VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---- Data contoh mahasiswa (untuk demo CRUD) ----
INSERT INTO mahasiswa (nama, npm, email, jurusan, semester) VALUES
  ('Budi Santoso', '231063001', 'budi@email.com',  'Sistem Informasi', 4),
  ('Siti Rahayu',  '231063002', 'siti@email.com',  'Sistem Informasi', 4),
  ('Ahmad Fauzi',  '231063003', 'ahmad@email.com', 'Sistem Informasi', 2);

-- CATATAN: tidak ada login/akun. Demo CRUD terbuka untuk publik (materi belajar).
