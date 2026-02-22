<?php
session_start();
include 'connection.php'; 

if(!isset($_SESSION['login'])) {
    echo "<script>alert('Please login first !');window.location.replace('form_login.php')</script>";
    exit;
}

// LOGIKA EXCEL: Jika ada parameter ?export=excel di URL, paksa browser download file
if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Rekap_Gaji_JawaraJamur_".date('m_Y').".xls");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan - Jawara Jamur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f1ec;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        h2 { color: #7b6744; margin-bottom: 5px; }
        p { color: #666; margin-bottom: 25px; }
        
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #7b6744;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 0.9rem;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
            color: #333;
        }
        tr:hover { background-color: #faf9f7; }
        .total-gaji { font-weight: 800; color: #2d5a27; }

        /* Button Styling */
        .btn-group { margin-bottom: 20px; display: flex; gap: 10px; }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-back { background: #eee; color: #333; }
        .btn-excel { background: #2d5a27; color: white; }
        .btn-print { background: #7b6744; color: white; }
        .btn:hover { opacity: 0.8; transform: translateY(-2px); }

        /* CSS KHUSUS PRINT */
        @media print {
            .btn-group { display: none; }
            body { background: white; padding: 0; }
            .container { box-shadow: none; border: none; width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>REKAP GAJI & KEHADIRAN</h2>
    <p>Periode: <strong><?php echo date('F Y'); ?></strong></p>
    
    <div class="btn-group">
        <a href="index.php" class="btn btn-back">Kembali</a>
        <a href="?export=excel" class="btn btn-excel">Download Excel</a>
        <button onclick="window.print()" class="btn btn-print">Cetak PDF / Print</button>
    </div>

    <table id="tabel-rekap">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Gaji /Hari</th>
                <th>Total Hadir</th>
                <th>Total Gaji (Bulan Ini)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT 
                        k.nama, 
                        k.jabatan, 
                        k.gaji_per_hari,
                        COUNT(a.id_absensi) as total_masuk,
                        (COUNT(a.id_absensi) * k.gaji_per_hari) as total_gaji
                      FROM karyawan k
                      LEFT JOIN absensi a ON k.id_karyawan = a.id_karyawan 
                      AND a.keterangan = 'hadir' 
                      AND MONTH(a.tanggal) = MONTH(CURRENT_DATE())
                      AND YEAR(a.tanggal) = YEAR(CURRENT_DATE())
                      GROUP BY k.id_karyawan";

            $sql = mysqli_query($koneksi, $query);
            
            while($row = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td>Rp <?= number_format($row['gaji_per_hari'], 0, ',', '.'); ?></td>
                <td><?= $row['total_masuk']; ?> Hari</td>
                <td class="total-gaji">Rp <?= number_format($row['total_gaji'], 0, ',', '.'); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>