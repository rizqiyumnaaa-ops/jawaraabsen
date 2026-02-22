<?php 
session_start();
// Cek login menggunakan variabel session Jawara Jamur
if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Sesi habis, silakan login ulang!');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Change Photo - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; background-color: #f4f1ec; display: flex; }
        
        /* Sidebar Styling ala Laundry tapi warna Jawara */
        .sidebar { 
            width: 250px; height: 100vh; background: rgba(123, 103, 68, 1); 
            color: white; padding: 30px 20px; display: flex; flex-direction: column; align-items: center;
        }
        .profile-card img { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid white; }
        .nav-links { width: 100%; margin-top: 30px; }
        .nav-links a { 
            display: block; color: white; text-decoration: none; padding: 12px; 
            margin-bottom: 10px; border-radius: 10px; background: rgba(255,255,255,0.1); text-align: center;
        }
        .nav-links a:hover { background: white; color: rgba(123, 103, 68, 1); }

        /* Content Area */
        .main-content { flex: 1; padding: 50px; display: flex; justify-content: center; }
        .inner-container { background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 500px; text-align: center; }
        
        h1 { color: rgba(123, 103, 68, 1); font-weight: 800; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { font-weight: 600; display: block; margin-bottom: 10px; color: #555; }
        input[type="file"] { width: 100%; padding: 10px; border: 1px dashed rgba(123, 103, 68, 1); border-radius: 10px; }
        
        .btn-upload { background: rgba(123, 103, 68, 1); color: white; border: none; padding: 15px 30px; border-radius: 15px; font-weight: bold; cursor: pointer; width: 100%; }
        .btn-cancel { display: block; margin-top: 15px; color: #777; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    
    <aside class="sidebar">
        <div class="profile-card">
            <img src="<?= $_SESSION['userphoto']; ?>" class="profile-img">
        </div>
        <div class="user-info" style="text-align: center; margin-top: 15px;">
            <p>Welcome, <br><strong><?= $_SESSION['fullname']; ?></strong></p>
            <small>Administrator</small>
        </div>
        <nav class="nav-links">
            <a href="index.php">Dashboard</a>
            <a href="read_karyawan.php">Data Karyawan</a>
            <a href="logout.php">Logout</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="inner-container">
            <header>
                <h1>GANTI FOTO</h1>
                <p>Gunakan foto formal untuk profil admin</p>
            </header>

            <?php
                include "connection.php";
                $userid = $_SESSION['user_id']; // ID dari database Jawara
                $query = "SELECT * FROM user WHERE user_id = '$userid'";
                $user = mysqli_query($koneksi, $query);
                $data = mysqli_fetch_assoc($user);
            ?>

                <form method="post" action="update_profile.php" enctype="multipart/form-data">
                <div class="form-group" style="text-align: center;">
                    <label>Foto Saat Ini</label>
                    <img src="<?= $data['userphoto'] ?>" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 5px solid #f4f1ec; margin: 10px 0;">
                </div>

                <div class="form-group">
                    <label>Pilih Foto Baru</label>
                    <input type="file" name="new_photo" required>
                </div>

                <button type="submit" name="upload" class="btn-upload">📤 SIMPAN PERUBAHAN</button>
                <a href="index.php" class="btn-cancel">Batal / Kembali</a>

                <input type="hidden" name="old_photo" value="<?= $data['userphoto'] ?>" />
                <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>" />
            </form>
        </div>
    </main>

</body>
</html>