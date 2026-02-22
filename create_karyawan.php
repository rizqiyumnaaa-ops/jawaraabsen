<?php
session_start();
include 'connection.php';

if(isset($_POST['simpan'])) {
    
    $nik           = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan       = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $gaji_per_hari = mysqli_real_escape_string($koneksi, $_POST['gaji_per_hari']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $status        = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Query INSERT
    $query = "INSERT INTO karyawan (nik, nama, jabatan, gaji_per_hari, alamat, status) 
              VALUES ('$nik', '$nama', '$jabatan', '$gaji_per_hari', '$alamat', '$status')";
    
    $simpan = mysqli_query($koneksi, $query);

    if($simpan) {
        // Jika berhasil, munculkan alert dan balik ke halaman daftar karyawan
        echo "<script>
                alert('Berhasil! Karyawan $nama telah ditambahkan.');
                window.location.replace('read_karyawan.php');
              </script>";
    } else {
        // Jika gagal
        echo "<script>
                alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }

} else {
    // Jika mencoba akses file ini secara langsung tanpa melalui form
    header("location:add_karyawan.php");
}
?>