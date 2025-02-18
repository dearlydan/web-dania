<?php
include 'koneksi.php';

// Pastikan ID ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL dan sanitasi
    $id_kelas = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil data kelas berdasarkan ID
    $query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$row) {
        die("Data tidak ditemukan.");
    }

    // Proses form jika ada POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

        // Update data kelas
        $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";

        if (mysqli_query($koneksi, $update_query)) {
            header("Location: kelas.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    die("ID tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Edit Kelas</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo htmlspecialchars($row['nama_kelas']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="kelas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>