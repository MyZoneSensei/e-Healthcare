<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Ambil data cabang berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM branch_hospitals WHERE id_hospital = '$id'");
$cabang = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_name = $_POST['hospital_name'];
    $hospital_location = $_POST['hospital_location'];
    $phone = $_POST['phone'];

    // Cek apakah ada gambar baru yang diupload
    if (!empty($_FILES['hospital_pict']['name'])) {
        $gambarName = $_FILES['hospital_pict']['name'];
        $gambarTmp = $_FILES['hospital_pict']['tmp_name'];
        $gambarPath = 'img/' . basename($gambarName);

        if (move_uploaded_file($gambarTmp, $gambarPath)) {
            // Update dengan gambar baru
            $query = "UPDATE branch_hospitals SET 
                        hospital_name = '$hospital_name', 
                        hospital_location = '$hospital_location', 
                        phone = '$phone', 
                        hospital_pict = '$gambarName' 
                      WHERE id_hospital = '$id'";
        } else {
            echo "Upload gambar gagal.";
            exit;
        }
    } else {
        // Update tanpa mengubah gambar
        $query = "UPDATE branch_hospitals SET 
                    hospital_name = '$hospital_name', 
                    hospital_location = '$hospital_location', 
                    phone = '$phone' 
                  WHERE id_hospital = '$id'";
    }

    mysqli_query($conn, $query);
    header("Location: admin_cabang.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cabang</title>
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
                <a href="admin_cabang.php" class="active">Cabang</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Edit Cabang Rumah Sakit</h1>
        </div>

        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <label for="hospital_pict">Upload Gambar Baru (opsional):</label>
                <input type="file" id="hospital_pict" name="hospital_pict" accept="image/*">
                
                <div class="current-image">
                    <p>Gambar saat ini:</p>
                    <img src="img/<?= $cabang['hospital_pict']; ?>" alt="Current Image" width="100">
                </div>

                <label for="hospital_name">Nama Rumah Sakit:</label>
                <input type="text" id="hospital_name" name="hospital_name" value="<?= htmlspecialchars($cabang['hospital_name']); ?>" required>

                <label for="hospital_location">Lokasi:</label>
                <input type="text" id="hospital_location" name="hospital_location" value="<?= htmlspecialchars($cabang['hospital_location']); ?>" required>

                <label for="phone">Telepon:</label>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($cabang['phone']); ?>" required>

                <div class="form-buttons">
                    <button type="submit">Update</button>
                    <a href="admin_cabang.php" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>