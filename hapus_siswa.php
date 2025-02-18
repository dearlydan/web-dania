<?php
include 'koneksi.php';

// Pastikan ID ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL dan sanitasi
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data siswa berdasarkan ID
    $delete_query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $delete_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    die("ID tidak ditemukan.");
}