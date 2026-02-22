<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Management User - Jawara Jamur</title>
<style>
        /* CSS INTERNAL */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgba(123, 103, 68, 1); /* Warna Cokelat Jawara */
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            background-color: rgba(255, 255, 255, 1); /* Putih Bersih */
            padding: 40px;
            border-radius: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        h1 {
            color: rgba(123, 103, 68, 1);
            font-weight: 800;
            margin-bottom: 25px;
            text-align: center;
        }

        .action-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn-add {
            background-color: rgba(123, 103, 68, 1);
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-back {
            color: rgba(123, 103, 68, 1);
            text-decoration: none;
            font-weight: 600;
            border: 2px solid rgba(123, 103, 68, 1);
            padding: 10px 20px;
            border-radius: 15px;
            transition: 0.3s;
        }

        .btn-add:hover, .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Tabel Styling */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        th {
            background-color: rgba(123, 103, 68, 1);
            color: white;
            padding: 18px;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        th:first-child { border-radius: 15px 0 0 15px; }
        th:last-child { border-radius: 0 15px 15px 0; }

        td {
            padding: 15px 18px;
            background-color: #fcfaf7; /* Cokelat sangat muda agar teks terlihat */
            color: #444;
            font-size: 0.95rem;
        }

        tr td:first-child { border-radius: 15px 0 0 15px; }
        tr td:last-child { border-radius: 0 15px 15px 0; }

        tr:hover td {
            background-color: #f2ede4;
        }

        /* Badge Status */
        .badge {
            padding: 6px 15px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .status-aktif { background-color: #d1e7dd; color: #0f5132; }
        .status-non { background-color: #f8d7da; color: #842029; }

        /* Link Aksi */
        .edit-link { color: #2196F3; text-decoration: none; font-weight: 700; }
        .delete-link { color: #f44336; text-decoration: none; font-weight: 700; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar User / Admin</h1>
        <a href="add_user.php" class="btn-add">+ Tambah User Baru</a>
        <a href="index.php" style="margin-left: 10px; text-decoration: none; color: #3E2F2C;">← Dashboard</a>
        
        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Tipe User</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM admin ORDER BY id_admin DESC");
            while($row = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['username']; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td><span style="background: #F0E7D5; padding: 5px 10px; border-radius: 10px; font-size: 0.8rem; font-weight: bold;">ADMIN</span></td>
                <td>
                    <a href="delete_user.php?id=<?= $row['id_admin']; ?>" style="color: red; text-decoration: none;" onclick="return confirm('Hapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>