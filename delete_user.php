<?php
session_start();
include "connection.php"; // Sesuaikan dengan nama file koneksi kamu

// Proteksi: Hanya yang sudah login yang bisa menghapus
if(!isset($_SESSION['login'])) {
    header("location:form_login.php");
    exit;
}

// Ambil ID dari URL (delete_user.php?id=...)
$id = $_GET['id'];

// Pastikan admin tidak menghapus akunnya sendiri (Opsional tapi penting)
if($id == $_SESSION['user_id']) {
    echo "<script>alert('Anda tidak bisa menghapus akun sendiri yang sedang digunakan!'); window.location.replace('read_user.php');</script>";
    exit;
}

// Query Hapus
$query = "DELETE FROM user WHERE user_id = '$id'";
$delete = mysqli_query($koneksi, $query);

if($delete) {
    echo "<script>alert('User berhasil dihapus!'); window.location.replace('read_user.php');</script>";
} else {
    echo "<script>alert('Gagal menghapus user!'); window.location.replace('read_user.php');</script>";
}
?>