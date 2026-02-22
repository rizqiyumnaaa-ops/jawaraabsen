<?php
session_start();
if(isset($_POST['upload'])) { 
    include "connection.php"; // Nama file koneksi kamu

    $folder = ''; // Kosongkan jika foto ditaruh di folder yang sama dengan file PHP, atau isi 'uploads/' jika ada foldernya
    $file_tmp = $_FILES['new_photo']['tmp_name'];
    $file_name = $_FILES['new_photo']['name'];

    // Menghindari duplikasi nama file dengan menambahkan prefix ID
    $new_file_name = "user_" . $_SESSION['user_id'] . "_" . $file_name;

    if(move_uploaded_file($file_tmp, $folder . $new_file_name)) {

        // Query: Tabel 'user', kolom 'userphoto', filter 'user_id'
        $query = "UPDATE user SET userphoto='$new_file_name' WHERE user_id='$_SESSION[user_id]'";

        // Gunakan variabel $koneksi sesuai file connection.php kamu
        $upload = mysqli_query($koneksi, $query);

        if($upload) { 
            // Hapus foto lama jika bukan default.png agar tidak menumpuk di folder
            if($_POST['old_photo'] !== 'default.png' && file_exists($folder . $_POST['old_photo'])) {
                unlink($folder . $_POST['old_photo']); 
            }

            // Update session photo supaya di dashboard langsung berubah fotonya
            $_SESSION['userphoto'] = $new_file_name;

            echo "<script>alert('Ganti foto profil berhasil!'); window.location.replace('index.php'); </script>";
        } else {
            echo "<script>alert('Gagal update database!'); window.location.replace('user_photo.php');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload file ke folder!'); window.location.replace('user_photo.php');</script>";
    }
} else {
    header("location:user_photo.php");
}
?>