<?php
include 'koneksi.php';

// Ambil ID kelas dari parameter URL
$id_kelas = $_GET['id'];

// Query untuk menghapus data kelas
$query = "DELETE FROM kelas WHERE id_kelas = $id_kelas";

if (mysqli_query($koneksi, $query)) {
    header("Location: kelas.php");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>