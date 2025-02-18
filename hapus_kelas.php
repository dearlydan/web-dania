<?php
include 'koneksi.php';

// ambil id kelas dari parameter url
$id_kelas = $_GET['id'];

$query = "DELETE FROM kelas WHERE id_kelas = $id_kelas";

if (mysqli_query($koneksi, $query)) {
    header("Location kelas.php");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>