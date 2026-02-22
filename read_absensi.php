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
    <title>Data Absensi - Jawara Jamur</title>
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
        <h1>Absensi Hari Ini (<?php echo date('d-m-Y'); ?>)</h1>
        <div class="action-group">
            <a href="add_absensi.php" class="btn btn-add">Tambah Absen</a>
            <a href="index.php" class="btn btn-back">Kembali ke Dashboard</a>
        </div>
        
        <table>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jam Masuk</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $tgl = date('Y-m-d');
            $query = mysqli_query($koneksi, "SELECT a.*, k.nama FROM absensi a JOIN karyawan k ON a.id_karyawan = k.id_karyawan WHERE a.tanggal = '$tgl'");
            while($row = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jam_masuk']; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td>
                    <a href="edit_absensi.php?id=<?= $row['id_absensi']; ?>">Edit</a> | 
                    <a href="delete_absensi.php?id=<?= $row['id_absensi']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>