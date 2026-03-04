<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO medicines (name, price) VALUES ('$name', '$price')";
    mysqli_query($conn, $query);    

    header("Location: admin_obat.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-Obat</title>
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
                <a href="admin_cabang.php">Cabang</a>
                <a href="admin_obat.php" class="active">Daftar Obat</a>
                <a href="admin_order.php">Order Obat</a>                
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Admin - Daftar Obat</h1>
        </div>
        <div class="action head">
            <a href="#" class="btn-database" onclick="openPopup()">Tambah Data</a>
            <div class="search admin">
                <input type="text" class="form search" placeholder="Cari nama obat">
                <button type="submit">Cari</button>
            </div>
        </div>

        <table class="table admin">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM medicines");
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['id_medicines']}</td>
                            <td>{$row['name']}</td>
                            <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='edit_obat.php?id={$row['id_medicines']}' class='btn-edit'>Edit</a>
                                    <a href='hapus_obat.php?id={$row['id_medicines']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?');\">Delete</a>
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
            <h2>Tambah Data Obat</h2>
            <form method="POST">
                <label for="name">Nama Obat:</label>
                <input type="text" id="name" name="name" required>

                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" min="0" step="100" required>

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