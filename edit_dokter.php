<?php
include 'connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID dokter tidak ditemukan di URL.");
}

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM doctor WHERE ID_dok = $id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data dokter tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $departemen = $_POST['departemen'];

    $query = "UPDATE doctor SET 
        Nama_Dokter = '$nama',
        Spesialis = '$spesialis',
        Departement = '$departemen'
        WHERE ID_dok = $id";

    mysqli_query($conn, $query);
    header("Location: admin_dokter.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Dokter</title>
    <link rel="stylesheet" href="static/jikri_style.css">
</head>
<body>
    <div class="page-edit-admin">
        <div class="edit-admin-container">
            <h2 class="edit-admin-title">Edit Data Dokter</h2>
            <form method="POST" class="edit-admin-form">
                <label for="nama" class="edit-admin-label">Nama Dokter:</label>
                <input type="text" id="nama" name="nama" value="<?= $data['Nama_Dokter'] ?>" required class="edit-admin-input">

                <label for="spesialis" class="edit-admin-label">Spesialis:</label>
                <input type="text" id="spesialis" name="spesialis" value="<?= $data['Spesialis'] ?>" required class="edit-admin-input">

                <label for="departemen" class="edit-admin-label">Departemen:</label>
                <input type="text" id="departemen" name="departemen" value="<?= $data['Departement'] ?>" required class="edit-admin-input">

                <button type="submit" class="edit-admin-button">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
