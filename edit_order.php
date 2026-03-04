<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Ambil data order berdasarkan ID
$result = mysqli_query($conn, "
    SELECT o.*, p.full_name AS patient_name, m.name AS medicine_name 
    FROM orders o 
    JOIN patients p ON o.id_patients = p.id_patients 
    JOIN medicines m ON o.id_medicines = m.id_medicines 
    ORDER BY o.order_date DESC
");

$order = mysqli_fetch_assoc($result);

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

    $query = "UPDATE orders SET 
                id_patients = '$id_patients', 
                id_medicines = '$id_medicines', 
                quantity = '$quantity', 
                total_price = '$total_price', 
                payment_method = '$payment_method', 
                payment_status = '$payment_status' 
              WHERE id_orders = '$id'";
    mysqli_query($conn, $query);

    header("Location: admin_order.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
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
                <a href="admin_obat.php">Daftar Obat</a>
                <a href="admin_order.php" class="active">Order Obat</a>
                <a href="logout.php" class="logout-btn" style="color: red; font-weight: bold;">Logout</a>
            </nav>
        </aside>
    </div>

    <div class="admin main">
        <div class="heading page">
            <h1>Edit Order Obat</h1>
        </div>
        
        <div class="form-container">
            <form method="POST">
                <label for="id_patients">Pasien:</label>
                <select id="id_patients" name="id_patients" required>
                    <?php while ($patient = mysqli_fetch_assoc($patients)): ?>
                        <option value="<?= $patient['id_patients']; ?>" 
                            <?= ($patient['id_patients'] == $order['id_patients']) ? 'selected' : ''; ?>>
                            <?= $patient['full_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="id_medicines">Obat:</label>
                <select id="id_medicines" name="id_medicines" required onchange="updatePrice()">
                    <?php while ($medicine = mysqli_fetch_assoc($medicines)): ?>
                        <option value="<?= $medicine['id_medicines']; ?>" 
                            data-price="<?= $medicine['price']; ?>"
                            <?= ($medicine['id_medicines'] == $order['id_medicines']) ? 'selected' : ''; ?>>
                            <?= $medicine['name']; ?> - Rp <?= number_format($medicine['price'], 0, ',', '.'); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="<?= $order['quantity']; ?>" required onchange="updateTotal()">

                <label for="total_preview">Total Harga (Preview):</label>
                <input type="text" id="total_preview" readonly style="background-color: #f0f0f0;" value="Rp <?= number_format($order['total_price'], 0, ',', '.'); ?>">

                <label for="payment_method">Metode Pembayaran:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="Cash" <?= ($order['payment_method'] == 'Cash') ? 'selected' : ''; ?>>Cash</option>
                    <option value="Transfer Bank" <?= ($order['payment_method'] == 'Transfer Bank') ? 'selected' : ''; ?>>Transfer Bank</option>
                    <option value="Kartu Kredit" <?= ($order['payment_method'] == 'Kartu Kredit') ? 'selected' : ''; ?>>Kartu Kredit</option>
                    <option value="E-Wallet" <?= ($order['payment_method'] == 'E-Wallet') ? 'selected' : ''; ?>>E-Wallet</option>
                </select>

                <label for="payment_status">Status Pembayaran:</label>
                <select id="payment_status" name="payment_status" required>
                    <option value="Pending" <?= ($order['payment_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Lunas" <?= ($order['payment_status'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                </select>

                <button type="submit">Update</button>
                <a href="admin_order.php" class="btn-cancel">Batal</a>
            </form>
        </div>
    </div>

    <script>
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
            }
        }

        // Initialize total on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script>
</body>
</html>