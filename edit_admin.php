<?php
include 'connect.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM daftar_admin WHERE ID_admin = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = "UPDATE daftar_admin SET 
        nama_admin = '$nama',
        password_login = '$password'
        WHERE ID_admin = $id";

    mysqli_query($conn, $query);
    header("Location: admin_daftar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="static/jikri_style.css">
</head>
<body>
<body>
    <div class="page-edit-admin">
        <div class="edit-admin-container">
            <h2 class="edit-admin-title">Edit Data Admin</h2>
            <form method="POST" class="edit-admin-form">
                <label for="nama" class="edit-admin-label">Nama Admin:</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama_admin'] ?>" required class="edit-admin-input">

                <label for="password" class="edit-admin-label">Password:</label>
                <input type="text" id="password" name="password" value="<?= $data['password_login'] ?>" required class="edit-admin-input">

                <button type="submit" class="edit-admin-button">Update</button>
            </form>
        </div>
    </div>
</body>

</body>
</html>
