<?php
include 'connection.php';
if(isset($_POST['update'])) {
    $id = $_POST['id_absensi'];
    $keterangan = $_POST['keterangan'];
    
    $query = "UPDATE absensi SET keterangan='$keterangan' WHERE id_absensi='$id'";
    mysqli_query($koneksi, $query);
    
    echo "<script>alert('Data berhasil diupdate!'); window.location.replace('read_absensi.php');</script>";
}
?>