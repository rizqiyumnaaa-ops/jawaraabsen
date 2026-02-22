<?php
include 'connection.php';

if(isset($_POST['simpan'])) {
    $user = $_POST['username'];
    $pass = $_POST['password']; // Di dunia nyata sebaiknya pakai password_hash
    $nama = $_POST['nama_lengkap'];

    $query = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$user', '$pass', '$nama')";
    $exec = mysqli_query($koneksi, $query);

    if($exec) {
        echo "<script>alert('User Berhasil Dibuat!'); window.location.replace('read_user.php');</script>";
    } else {
        echo "<script>alert('Gagal: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
?>