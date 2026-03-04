<?php
session_start();
include 'connect.php';

    $departments = mysqli_query($conn, "SELECT * FROM departments");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];
    $departemen = $_POST['departemen'];
    $jadwal = $_POST['jadwal']; // Tambahkan ini

    $gambarName = $_FILES['gambar']['name'];
    $gambarTmp = $_FILES['gambar']['tmp_name'];
    $gambarPath = 'img/' . basename($gambarName);

    if (move_uploaded_file($gambarTmp, $gambarPath)) {
        // Update query dengan kolom jadwal_dokter
        $query = "INSERT INTO doctor (Nama_Dokter, Spesialis, Departement, photo, jadwal_dokter)
                VALUES ('$nama', '$spesialis', '$departemen', '$gambarName', '$jadwal')";

        mysqli_query($conn, $query);    
    } else {
        echo "Upload gambar gagal.";
    }

    header("Location: admin_dokter.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-Dokter</title>
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
                <a href="admin_dokter.php" class="active">Dokter</a>
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
            <h1>Admin</h1>
        </div>
        <div class="action head">
            <a href="#" class="btn-database" onclick="openPopup()">Tambah Data</a>
            <div class="search admin">
                <input type="text" class="form search" placeholder="Cari nama">
                <button type="submit">Cari</button>
            </div>
        </div>

        <table class="table admin">
    <thead>
        <tr>
            <th>No.</th>
            <th>Foto</th>
            <th>Nama Dokter</th>
            <th>Spesialis</th>
            <th>Departemen</th>
            <th>Jadwal</th> <!-- Kolom baru -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM doctor");
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td><img src='img/{$row['photo']}' alt='foto' width='60'></td>
                    <td>{$row['Nama_Dokter']}</td>
                    <td>{$row['Spesialis']}</td>
                    <td>{$row['Departement']}</td>
                    <td>{$row['jadwal_dokter']}</td>
                    <td>
                        <div class='action-buttons'>
                            <a href='edit_dokter.php?id={$row['ID_dok']}' class='btn-edit'>Edit</a>
                            <a href='hapus_dokter.php?id={$row['ID_dok']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?');\">Delete</a>
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
        <h2>Tambah Data Dokter</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="gambar">Upload Gambar:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" required>

            <label for="nama">Nama Dokter:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="spesialis">Spesialis:</label>
            <input type="text" id="spesialis" name="spesialis" required>

            <label for="departemen">Departemen:</label>
            <select id="departemen" name="departemen" required>
                <option value="" disabled selected>Pilih departemen</option>
                <?php while ($dept = mysqli_fetch_assoc($departments)): ?>
                    <option value="<?= $dept['Departments']; ?>"><?= $dept['Departments']; ?></option>
                <?php endwhile; ?>
            </select>

            <!-- Input Jadwal Baru -->
            <label for="jadwal">Jadwal Dokter:</label>
            <textarea id="jadwal" name="jadwal" rows="3" placeholder="Contoh: Senin-14.00 - 15.00 WIB, Rabu-09.00 - 11.00 WIB" required></textarea>

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
