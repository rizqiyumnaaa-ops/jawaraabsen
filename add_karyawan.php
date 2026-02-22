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
    <title>Tambah Karyawan - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #7b6744; /* Warna cokelat background utama kamu */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            color: #7b6744;
            text-align: center;
            font-weight: 800;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            box-sizing: border-box; /* Biar padding nggak bikin input meluber */
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #7b6744;
        }

        .btn-submit {
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
        }

        .btn-submit:hover {
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

<div class="form-container">
    <h2>TAMBAH KARYAWAN</h2>
    <form action="create_karyawan.php" method="POST">
        <label>NIK</label>
        <input type="text" name="nik" placeholder="Masukkan NIK" required>

        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama karyawan" required>

        <label>Jabatan</label>
        <input type="text" name="jabatan" placeholder="Contoh: Admin Produksi" required>

        <label>Gaji Harian (Rp)</label>
        <input type="number" name="gaji_per_hari" placeholder="Contoh: 100000" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" placeholder="Alamat lengkap"></textarea>

        <label>Status</label>
        <select name="status">
            <option value="aktif">Aktif</option>
            <option value="non-aktif">Non-Aktif</option>
        </select>

        <button type="submit" name="simpan" class="btn-submit">SIMPAN DATA</button>
        <a href="read_karyawan.php" class="btn-back">KEMBALI KE DAFTAR</a>
    </form>
</div>

</body>
</html>