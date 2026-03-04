<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_name = $_POST['hospital_name'];
    $hospital_location = $_POST['hospital_location'];
    $phone = $_POST['phone'];

    $gambarName = $_FILES['hospital_pict']['name'];
    $gambarTmp = $_FILES['hospital_pict']['tmp_name'];
    $gambarPath = 'img/' . basename($gambarName);

    if (move_uploaded_file($gambarTmp, $gambarPath)) {
        $query = "INSERT INTO branch_hospitals (hospital_name, hospital_location, phone, hospital_pict)
                VALUES ('$hospital_name', '$hospital_location', '$phone', '$gambarName')";

        mysqli_query($conn, $query);    
    } else {
        echo "Upload gambar gagal.";
    }

    header("Location: admin_cabang.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-Cabang</title>
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
                <a href="admin_booking.php">Jadwal Booking</a>
                <a href="admin_cabang.php" class="active">Cabang</a>
                <a href="admin_obat.php">Daftar Obat</a>
                <a href="admin_order.php">Order Obat</a>
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Admin - Cabang Rumah Sakit</h1>
        </div>
        <div class="action head">
            <a href="#" class="btn-database" onclick="openPopup()">Tambah Data</a>
            <div class="search admin">
                <input type="text" class="form search" placeholder="Cari nama rumah sakit">
                <button type="submit">Cari</button>
            </div>
        </div>

        <table class="table admin">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama Rumah Sakit</th>
                    <th>Lokasi</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM branch_hospitals");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td><img src='img/{$row['hospital_pict']}' alt='foto' width='60'></td>
                            <td>{$row['hospital_name']}</td>
                            <td>{$row['hospital_location']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='edit_cabang.php?id={$row['id_hospital']}' class='btn-edit'>Edit</a>
                                    <a href='hapus_cabang.php?id={$row['id_hospital']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?');\">Delete</a>
                                </div>
                            </td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

    </div>

    <div class="popup-form" id="popupForm" style="display:none;">
        <div class="form-container">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Tambah Data Cabang Rumah Sakit</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="hospital_pict">Upload Gambar:</label>
                <input type="file" id="hospital_pict" name="hospital_pict" accept="image/*" required>

                <label for="hospital_name">Nama Rumah Sakit:</label>
                <input type="text" id="hospital_name" name="hospital_name" required>

                <label for="hospital_location">Lokasi:</label>
                <input type="text" id="hospital_location" name="hospital_location" required>

                <label for="phone">Telepon:</label>
                <input type="tel" id="phone" name="phone" required>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("popupForm").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popupForm").style.display = "none";
        }
    </script>
</body>
</html>