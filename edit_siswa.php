<?php
include 'koneksi.php';

// Pastikan ID ada di URL
if (isset($_GET['id'])) {
    // Ambil ID dari URL dan sanitasi
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil data siswa berdasarkan ID
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$row) {
        die("Data tidak ditemukan.");
    }

    // Proses form jika ada POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
        $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
        $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
        $id_wali = mysqli_real_escape_string($koneksi, $_POST['id_wali']);

        // Update data siswa
        $update_query = "UPDATE siswa SET nis = '$nis', nama_siswa = '$nama_siswa', jenis_kelamin = '$jenis_kelamin', 
                         tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', id_kelas = '$id_kelas', 
                         id_wali = '$id_wali' WHERE id_siswa = '$id_siswa'";

        if (mysqli_query($koneksi, $update_query)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    die("ID tidak ditemukan.");
}

// Ambil data kelas dan wali untuk dropdown
$kelas_query = "SELECT * FROM kelas";
$kelas_result = mysqli_query($koneksi, $kelas_query);

$wali_query = "SELECT * FROM wali_murid";
$wali_result = mysqli_query($koneksi, $wali_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Edit Siswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo htmlspecialchars($row['nis']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo htmlspecialchars($row['nama_siswa']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" <?php echo ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo htmlspecialchars($row['tempat_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo htmlspecialchars($row['tanggal_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select class="form-select" id="id_kelas" name="id_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) : ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>" <?php echo ($kelas['id_kelas'] == $row['id_kelas']) ? 'selected' : ''; ?>>
                            <?php echo $kelas['nama_kelas']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_wali" class="form-label">Wali Murid</label>
                <select class="form-select" id="id_wali" name="id_wali" required>
                    <option value="">Pilih Wali Murid</option>
                    <?php while ($wali = mysqli_fetch_assoc($wali_result)) : ?>
                        <option value="<?php echo $wali['id_wali']; ?>" <?php echo ($wali['id_wali'] == $row['id_wali']) ? 'selected' : ''; ?>>
                            <?php echo $wali['nama_wali']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>