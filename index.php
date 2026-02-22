<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['login'])) {
    header("location:form_login.php");
    exit;
}

// Data untuk Grafik: Hitung jumlah status absensi bulan ini
$tgl_sekarang = date('Y-m');
$q_grafik = mysqli_query($koneksi, "SELECT keterangan, COUNT(*) as jumlah FROM absensi WHERE tanggal LIKE '$tgl_sekarang%' GROUP BY keterangan");
$labels = [];
$counts = [];
while($data_g = mysqli_fetch_assoc($q_grafik)){
    $labels[] = strtoupper($data_g['keterangan']);
    $counts[] = $data_g['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Jawara Jamur</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="uploads/LOGO.png" alt="Logo"> 
            <h3>Cv. Kaysan Jawara Jamur</h3>
        </div>
        
        <div class="nav-menu">
            <a href="read_karyawan.php">Management Karyawan</a>
            <a href="read_absensi.php">Input Absensi</a>
            <a href="rekap_absensi.php">Rekap Absensi</a>
            <a href="read_user.php">Pengaturan User</a>
            <a href="logout.php" style="background-color: #fff; margin-top: 50px; color: #d9534f;">Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header-title">Dashboard Absensi Karyawan</div>

        <div class="top-widgets">
            <div class="card">
                <div class="profile-section">
                    <img src="<?= $_SESSION['userphoto']; ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                    <div>
                        <strong>Welcome, <?= $_SESSION['fullname']; ?></strong><br>
                        <span>You Are Login As Admin</span><br>
                        <a href="user_photo.php" class="edit-profile-btn" style="text-decoration: none; display: inline-block; text-align: center;">Edit Profile</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <canvas id="absensiChart" style="max-height: 120px;"></canvas>
            </div>
        </div>

        <div class="bottom-table-card">
            <h3 style="margin-top: 0;">Absensi Karyawan Hari Ini (<?= date('d-m-Y'); ?>)</h3>
            <table width="100%" cellpadding="10" style="border-collapse: collapse;">
                <thead>
                    <tr style="background-color: rgba(123, 103, 68, 0.1);">
                        <th align="left">Nama Karyawan</th>
                        <th align="left">Jam Masuk</th>
                        <th align="left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tgl = date('Y-m-d');
                    $sql_absensi = mysqli_query($koneksi, "SELECT a.*, k.nama FROM absensi a JOIN karyawan k ON a.id_karyawan = k.id_karyawan WHERE a.tanggal = '$tgl' LIMIT 5");
                    if(mysqli_num_rows($sql_absensi) > 0){
                        while($row = mysqli_fetch_array($sql_absensi)) {
                            echo "<tr>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['jam_masuk']}</td>
                                    <td><span class='badge'>{$row['keterangan']}</span></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' align='center'>Belum ada data absen hari ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('absensiChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels); ?>,
                datasets: [{
                    label: 'Jumlah Status Absen',
                    data: <?= json_encode($counts); ?>,
                    backgroundColor: 'rgba(123, 103, 68, 0.7)',
                    borderRadius: 5
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>