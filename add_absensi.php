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
    <title>Input Absensi - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #7b6744; /* Warna cokelat Jawara */
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
            max-width: 450px;
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

        select, input[type="time"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        select:focus, input:focus {
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
            margin-top: 10px;
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
    <h2>INPUT ABSENSI</h2>
    <form action="create_absensi.php" method="POST">
        <label>Pilih Karyawan</label>
        <select name="id_karyawan" required>
            <option value="">-- Pilih Karyawan --</option>
            <?php
            $sql_karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE status='aktif'");
            while($k = mysqli_fetch_array($sql_karyawan)) {
                echo "<option value='$k[id_karyawan]'>$k[nama] ($k[jabatan])</option>";
            }
            ?>
        </select>

        <label>Status Kehadiran</label>
        <select name="keterangan">
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="alpha">Alpha</option>
        </select>

        <label>Jam Masuk</label>
        <input type="time" name="jam_masuk" value="<?php echo date('H:i'); ?>">

        <button type="submit" name="absen" class="btn-submit">SIMPAN ABSENSI</button>
        <a href="read_absensi.php" class="btn-back">Kembali ke Daftar</a>
    </form>
</div>

</body>
</html>