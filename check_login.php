<?php
session_start();
include 'connection.php'; 

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // SESUAI DATABASE: Tabel 'user', kolom password adalah 'passwordd'
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND passwordd='$password'");
    $cek = mysqli_num_rows($query);

    if($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['user_id']; 
        $_SESSION['username'] = $data['username'];
        
        // PERBAIKAN DI SINI: Ganti 'nama_lengkap' menjadi 'fullname' sesuai kolom DB kamu
        $_SESSION['fullname'] = $data['fullname']; 
        
        $_SESSION['userphoto'] = $data['userphoto'];

        header("location:index.php");
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location.replace('form_login.php');</script>";
    }
}
?>