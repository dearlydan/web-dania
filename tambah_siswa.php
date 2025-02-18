<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    $query = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali) 
              VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

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
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Tambah Siswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" required>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select class="form-select" id="id_kelas" name="id_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) : ?>
                        <option value="<?php echo $kelas['id_kelas']; ?>"><?php echo $kelas['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_wali" class="form-label">Wali Murid</label>
                <select class="form-select" id="id_wali" name="id_wali" required>
                <option value="">Pilih Wali Murid</option>
                    <?php while ($wali = mysqli_fetch_assoc($wali_result)) : ?>
                        <option value="<?php echo $wali['id_wali']; ?>"><?php echo $wali['nama_wali']; ?></option>
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