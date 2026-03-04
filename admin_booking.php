<?php
include 'connect.php';

$result = mysqli_query($conn, "SELECT * FROM appointment");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin - Jadwal Booking</title>
    <link rel="stylesheet" href="static/jikri_style.css">
    <script src="static/jikriscript.js"></script>
</head>
<body>
    <div class="sidebar">
        <aside class="sidenav">
            <div class="sidebar_logo">
                <img src="img/logo_ehc.png" alt="Logo eHealthCare" class="img_sidebar">
            </div>
            <nav>
                <a href="index.php">Web Utama</a>
                <a href="admin_daftar.php">Daftar Admin</a>
                <a href="admin_dokter.php">Dokter</a>
                <a href="admin_booking.php" class="active">Jadwal Booking</a>
                <a href="admin_cabang.php">Cabang</a>
                <a href="admin_obat.php">Daftar Obat</a>
                <a href="admin_order.php">Order Obat</a>                
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Jadwal Booking</h1>
        </div>

        <table class="table admin">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Tanggal Booking</th>
                    <th>Departemen</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['appointment_date']}</td>
                            <td>{$row['departments']}</td>
                            <td>{$row['note']}</td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='hapus_booking.php?id={$row['id_nama']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus booking ini?');\">Delete</a>
                                </div>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
