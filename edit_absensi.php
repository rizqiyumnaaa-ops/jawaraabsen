<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi='$id'"));
?>
<form action="update_absensi.php" method="POST">
    <input type="hidden" name="id_absensi" value="<?= $data['id_absensi']; ?>">
    <label>Keterangan:</label>
    <select name="keterangan">
        <option value="hadir" <?= ($data['keterangan'] == 'hadir') ? 'selected' : ''; ?>>Hadir</option>
        <option value="izin" <?= ($data['keterangan'] == 'izin') ? 'selected' : ''; ?>>Izin</option>
        <option value="sakit" <?= ($data['keterangan'] == 'sakit') ? 'selected' : ''; ?>>Sakit</option>
        <option value="alpha" <?= ($data['keterangan'] == 'alpha') ? 'selected' : ''; ?>>Alpha</option>
    </select>
    <button type="submit" name="update">Update Absen</button>
</form>