<?php
session_start();
include 'connect.php';

// Ambil data patients dan medicines untuk dropdown
$patients = mysqli_query($conn, "SELECT * FROM patients");
$medicines = mysqli_query($conn, "SELECT * FROM medicines");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_patients = $_POST['id_patients'];
    $id_medicines = $_POST['id_medicines'];
    $quantity = $_POST['quantity'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];
    
    // Ambil harga obat untuk menghitung total
    $medicine_query = mysqli_query($conn, "SELECT price FROM medicines WHERE id_medicines = '$id_medicines'");
    $medicine = mysqli_fetch_assoc($medicine_query);
    $total_price = $medicine['price'] * $quantity;
    
    $order_date = date('Y-m-d H:i:s');

    $query = "INSERT INTO orders (id_patients, id_medicines, quantity, total_price, order_date, payment_method, payment_status) 
              VALUES ('$id_patients', '$id_medicines', '$quantity', '$total_price', '$order_date', '$payment_method', '$payment_status')";
    mysqli_query($conn, $query);    

    header("Location: admin_order.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin-Order Obat</title>
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
                <a href="admin_obat.php">Daftar Obat</a>
                <a href="admin_order.php" class="active">Order Obat</a>
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Admin - Order Obat</h1>
        </div>
        <div class="action head">
            <a href="#" class="btn-database" onclick="openPopup()">Tambah Order</a>
            <div class="search admin">
                <input type="text" class="form search" placeholder="Cari order">
                <button type="submit">Cari</button>
            </div>
        </div>

        <table class="table admin">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Order</th>
                    <th>Nama Pasien</th>
                    <th>Obat</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Order</th>
                    <th>Metode Bayar</th>
                    <th>Status Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "
                    SELECT o.*, p.full_name AS patient_name, m.name AS medicine_name 
                    FROM orders o 
                    JOIN patients p ON o.id_patients = p.id_patients 
                    JOIN medicines m ON o.id_medicines = m.id_medicines 
                    ORDER BY o.order_date DESC
                ");

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $status_class = ($row['payment_status'] == 'Lunas') ? 'status-paid' : 'status-pending';
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['id_orders']}</td>
                            <td>{$row['patient_name']}</td>
                            <td>{$row['medicine_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>Rp " . number_format($row['total_price'], 0, ',', '.') . "</td>
                            <td>" . date('d/m/Y H:i', strtotime($row['order_date'])) . "</td>
                            <td>{$row['payment_method']}</td>
                            <td><span class='{$status_class}'>{$row['payment_status']}</span></td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='edit_order.php?id={$row['id_orders']}' class='btn-edit'>Edit</a>
                                    <a href='hapus_order.php?id={$row['id_orders']}' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?');\">Delete</a>
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
            <h2>Tambah Order Obat</h2>
            <form method="POST">
                <label for="id_patients">Pasien:</label>
                <select id="id_patients" name="id_patients" required>
                    <option value="" disabled selected>Pilih pasien</option>
                    <?php 
                    mysqli_data_seek($patients, 0); // Reset pointer
                    while ($patient = mysqli_fetch_assoc($patients)): ?>
                        <option value="<?= $patient['id_patients']; ?>"><?= $patient['full_name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="id_medicines">Obat:</label>
                <select id="id_medicines" name="id_medicines" required onchange="updatePrice()">
                    <option value="" disabled selected>Pilih obat</option>
                    <?php 
                    mysqli_data_seek($medicines, 0); // Reset pointer
                    while ($medicine = mysqli_fetch_assoc($medicines)): ?>
                        <option value="<?= $medicine['id_medicines']; ?>" data-price="<?= $medicine['price']; ?>">
                            <?= $medicine['name']; ?> - Rp <?= number_format($medicine['price'], 0, ',', '.'); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required onchange="updateTotal()">

                <label for="total_preview">Total Harga (Preview):</label>
                <input type="text" id="total_preview" readonly style="background-color: #f0f0f0;">

                <label for="payment_method">Metode Pembayaran:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="" disabled selected>Pilih metode pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="Kartu Kredit">Kartu Kredit</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>

                <label for="payment_status">Status Pembayaran:</label>
                <select id="payment_status" name="payment_status" required>
                    <option value="" disabled selected>Pilih status pembayaran</option>
                    <option value="Pending">Pending</option>
                    <option value="Lunas">Lunas</option>
                </select>

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

        function updatePrice() {
            updateTotal();
        }

        function updateTotal() {
            const medicineSelect = document.getElementById('id_medicines');
            const quantityInput = document.getElementById('quantity');
            const totalPreview = document.getElementById('total_preview');
            
            const selectedOption = medicineSelect.options[medicineSelect.selectedIndex];
            if (selectedOption && selectedOption.dataset.price) {
                const price = parseFloat(selectedOption.dataset.price);
                const quantity = parseInt(quantityInput.value) || 1;
                const total = price * quantity;
                
                totalPreview.value = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                totalPreview.value = '';
            }
        }
    </script>

    <style>
        .status-paid {
            color: green;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
    </style>
</body>
</html>