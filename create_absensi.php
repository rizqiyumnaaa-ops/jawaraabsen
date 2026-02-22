<?php
session_start();
include 'connection.php';

if (isset($_POST['absen'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $keterangan  = $_POST['keterangan'];
    $jam_masuk   = $_POST['jam_masuk'];
    $tanggal     = date('Y-m-d');

   
    $cek = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_karyawan='$id_karyawan' AND tanggal='$tanggal'");
    
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Karyawan ini sudah absen hari ini!'); window.location.replace('add_absensi.php');</script>";
    } else {
        $query = "INSERT INTO absensi (id_karyawan, tanggal, jam_masuk, keterangan) 
                  VALUES ('$id_karyawan', '$tanggal', '$jam_masuk', '$keterangan')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Absensi berhasil disimpan!'); window.location.replace('read_absensi.php');</script>";
        } else {
            echo "<script>alert('Gagal!'); window.history.back();</script>";
        }
    }
}
?>