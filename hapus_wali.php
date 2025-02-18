<?php
include_once("koneksi.php");

// Pastikan ID ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL dan sanitasi
    $id_wali = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Jalankan query DELETE
    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: wali_murid.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>