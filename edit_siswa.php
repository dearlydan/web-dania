<?php
include 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Ambil data siswa berdasarkan ID
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $result = mysqli_query($koneksi, $query);
    $siswa = mysqli_fetch_assoc($result);

    // Jika siswa tidak ditemukan
    if (!$siswa) {
        echo "Siswa tidak ditemukan!";
        exit;
    }

    $query_kelas = "SELECT * FROM kelas";
    $result_kelas = mysqli_query($koneksi, $query_kelas);

    $query_wali = "SELECT * FROM wali_murid";
    $result_wali = mysqli_query($koneksi, $query_wali);
} else {
    echo "ID siswa tidak valid!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $update_query = "UPDATE siswa 
                     SET nis = '$nis', nama_siswa = '$nama_siswa', jenis_kelamin = '$jenis_kelamin', 
                         tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', 
                         id_kelas = '$id_kelas', id_wali = '$id_wali' 
                     WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Data siswa berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data siswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Siswa</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" value="<?php echo htmlspecialchars($siswa['nis']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" value="<?php echo htmlspecialchars($siswa['nama_siswa']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" <?php echo ($siswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($siswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($siswa['tempat_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($siswa['tanggal_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <?php while ($row = mysqli_fetch_assoc($result_kelas)) : ?>
                        <option value="<?php echo $row['id_kelas']; ?>" <?php echo ($row['id_kelas'] == $siswa['id_kelas']) ? 'selected' : ''; ?>><?php echo $row['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <?php while ($row = mysqli_fetch_assoc($result_wali)) : ?>
                        <option value="<?php echo $row['id_wali']; ?>" <?php echo ($row['id_wali'] == $siswa['id_wali']) ? 'selected' : ''; ?>><?php echo $row['nama_wali']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>