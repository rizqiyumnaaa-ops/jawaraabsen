<?php
session_start();
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM karyawan WHERE id_karyawan = '$id'";
    $exec = mysqli_query($koneksi, $query);

    if ($exec) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.replace('read_karyawan.php');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.replace('read_karyawan.php');</script>";
    }
} else {
    header("location:read_karyawan.php");
}
?>