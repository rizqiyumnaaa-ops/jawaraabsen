<?php
session_start();
include 'connection.php';

if (isset($_POST['update'])) {
    $id            = $_POST['id_karyawan'];
    $nik           = $_POST['nik'];
    $nama          = $_POST['nama'];
    $jabatan       = $_POST['jabatan'];
    $gaji_per_hari = $_POST['gaji_per_hari'];
    $alamat        = $_POST['alamat'];
    $status        = $_POST['status'];

    $query = "UPDATE karyawan SET 
                nik='$nik', 
                nama='$nama', 
                jabatan='$jabatan', 
                gaji_per_hari='$gaji_per_hari', 
                alamat='$alamat', 
                status='$status' 
              WHERE id_karyawan='$id'";

    $exec = mysqli_query($koneksi, $query);

    if ($exec) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.replace('read_karyawan.php');</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!'); window.history.back();</script>";
    }
} else {
    header("location:read_karyawan.php");
}
?>