<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #7b6744; /* Warna cokelat utama Jawara Jamur */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #7b6744;
            text-align: center;
            font-weight: 800;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #7b6744;
        }

        button {
            background-color: #7b6744;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #5f4f34;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #7b6744;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-card">
        <h2>Tambah Admin</h2>
        <form action="create_user.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username untuk login" required>
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>
            
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" placeholder="Nama asli admin" required>
            
            <button type="submit" name="simpan">Simpan User</button>
            <a href="read_user.php" class="btn-back">Batal & Kembali</a>
        </form>
    </div>
</body>
</html>