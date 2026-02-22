<?php
include 'connection.php';
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM absensi WHERE id_absensi='$id'");

echo "<script>alert('Data berhasil dihapus!'); window.location.replace('read_absensi.php');</script>";
?>