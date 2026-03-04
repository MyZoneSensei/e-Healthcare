<?php
include 'connect.php';

// Simpan data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_admin']);
    $password = $_POST['password_login'];
    
    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO daftar_admin (nama_admin, password_login) VALUES ('$nama', '$hashedPassword')";
    
    if (mysqli_query($conn, $query)) {
        $success_message = "Admin berhasil ditambahkan!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

// Ambil data semua admin
$result = mysqli_query($conn, "SELECT * FROM daftar_admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Admin - Daftar Admin</title>
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
                <a href="admin_daftar.php" class="active">Daftar Admin</a>
                <a href="admin_dokter.php">Dokter</a>
                <a href="admin_booking.php">Jadwal Booking</a>
                <a href="admin_cabang.php">Cabang</a>
                <a href="admin_obat.php">Daftar Obat</a>
                <a href="admin_order.php">Order Obat</a>
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>               
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Daftar Admin</h1>
        </div>

        <div class="action head">
            <a href="#" class="btn-database" onclick="openPopup()">Tambah Admin</a>
        </div>

        <!-- Pesan sukses atau error -->
        <?php if (isset($success_message)): ?>
            <div class="alert success"><?= $success_message ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="alert error"><?= $error_message ?></div>
        <?php endif; ?>

        <table class="table admin">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Admin</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama_admin']}</td>
                            <td>••••••••••••••••</td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='edit_admin.php?id={$row['ID_admin']}' class='btn-edit'>Edit</a>
                                    <a href='hapus_admin.php?id={$row['ID_admin']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?');\">Delete</a>
                                </div>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pop-up form -->
    <div class="popup-form" id="popupForm" style="display: none;">
        <div class="form-container">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Tambah Admin</h2>
            <form method="POST">
                <label for="nama_admin">Nama Admin:</label>
                <input type="text" id="nama_admin" name="nama_admin" required>

                <label for="password_login">Password:</label>
                <input type="password" id="password_login" name="password_login" required>
                
                <small style="color: #666; font-size: 12px;">
                    Password akan di-hash secara otomatis untuk keamanan
                </small>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <style>
        /* Style untuk alert messages */
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .alert.success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .alert.error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>

</body>
</html>