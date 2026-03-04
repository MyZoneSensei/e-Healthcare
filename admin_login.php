<?php
session_start();
include 'connect.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $password = $_POST['Password'];

    // Query untuk mengambil data admin berdasarkan username saja
    $query = "SELECT * FROM daftar_admin WHERE nama_admin = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password_login'];
        
        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['admin_login'] = $username; // simpan session
            $_SESSION['admin_id'] = $row['ID_admin']; // simpan ID admin juga
            header("Location: admin_dokter.php");
            exit;
        } else {
            $error = "Username atau Password salah.";
        }
    } else {
        $error = "Username atau Password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="static/jikri_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
</head>

<body>
  <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
  ?>

    <h1 class="login-page-head">Login</h1>

    <div class="Login-border">
        <p class="admin-info">
            <strong>Perhatian:</strong> Halaman login ini hanya diperuntukkan bagi <span class="highlight-admin">Admin</span>. 
            Pengguna umum tidak perlu melakukan login untuk mengakses layanan.
        </p>

        <form method="POST" action="">
            <div class="form-login">
                <label for="Username">Username:</label>
                <input type="text" name="Username" id="Username" placeholder="Username" required>
            </div>
            <div class="form-login">
                <label for="Password">Password:</label>
                <input type="password" name="Password" id="Password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
            <?php if ($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
        </form>
    </div>
    
</body>

</html>