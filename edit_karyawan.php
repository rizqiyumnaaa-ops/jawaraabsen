<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['login'])) {
    header("location:form_login.php");
    exit;
}


$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_karyawan = '$id'");
$data = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan...");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Karyawan - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="form-container">
    <h2>EDIT KARYAWAN</h2>
    <form action="update_karyawan.php" method="POST">
        <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">

        <label>NIK</label>
        <input type="text" name="nik" value="<?= $data['nik']; ?>" required>

        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

        <label>Jabatan</label>
        <input type="text" name="jabatan" value="<?= $data['jabatan']; ?>" required>

        <label>Gaji Harian (Rp)</label>
        <input type="number" name="gaji_per_hari" value="<?= $data['gaji_per_hari']; ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3"><?= $data['alamat']; ?></textarea>

        <label>Status</label>
        <select name="status">
            <option value="aktif" <?= ($data['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
            <option value="non-aktif" <?= ($data['status'] == 'non-aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
        </select>

        <button type="submit" name="update" class="btn-update">SIMPAN PERUBAHAN</button>
        <a href="read_karyawan.php" class="btn-back">BATAL</a>
    </form>
</div>

</body>
</html>