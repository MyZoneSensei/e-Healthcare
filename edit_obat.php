<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Ambil data obat berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM medicines WHERE id_medicines = '$id'");
$obat = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "UPDATE medicines SET name = '$name', price = '$price' WHERE id_medicines = '$id'";
    mysqli_query($conn, $query);

    header("Location: admin_obat.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Obat</title>
    <link rel="stylesheet" href="static/jikri_style.css">
</head>
<body>
    <div class="sidebar">
        <aside class="sidenav">
            <div class="sidebar_logo">
                <img src="img/logo_ehc.png" alt="Logo eHealthCare" class="img_sidebar">
            </div>
            <nav>
                <a href="index.html">Web Utama</a>
                <a href="admin_daftar.php">Daftar Admin</a>
                <a href="admin_dokter.php">Dokter</a>
                <a href="admin_booking.php">Jadwal Booking</a>
                <a href="admin_cabang.php">Cabang</a>
                <a href="admin_obat.php" class="active">Daftar Obat</a>
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Edit Data Obat</h1>
        </div>
        
        <div class="form-container">
            <form method="POST">
                <label for="name">Nama Obat:</label>
                <input type="text" id="name" name="name" value="<?= $obat['name']; ?>" required>

                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" value="<?= $obat['price']; ?>" min="0" step="100" required>

                <button type="submit">Update</button>
                <a href="admin_obat.php" class="btn-cancel">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>