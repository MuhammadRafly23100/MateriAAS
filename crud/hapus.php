<?php
/* ============================================================
   crud/hapus.php  →  DELETE: hapus data by id (publik)
   ============================================================ */
require '../config/db.php';
require '../includes/functions.php';

$id = (int) ($_GET['id'] ?? 0);

// Ambil nama foto dulu agar file fisik bisa ikut dihapus
$stmt = $conn->prepare("SELECT foto FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

// Hapus baris
$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($data && !empty($data['foto']) && file_exists('../uploads/' . $data['foto'])) {
        unlink('../uploads/' . $data['foto']);
    }
    set_flash('success', 'Data berhasil dihapus.');
} else {
    set_flash('error', 'Gagal menghapus data.');
}

header("Location: " . BASE_URL . "/panduan-crud.php");
exit();
