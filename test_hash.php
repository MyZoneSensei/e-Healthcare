<?php
include 'connect.php';

// Daftar admin dan password lama mereka
$admins = [
    'Dzikri' => 'akujikir',
    'Yuda' => 'akuyuda',
    'Kapa' => 'akukapa',
    'Epan' => 'akuepan',
    'Ardo' => 'akuardo'
];

echo "Memulai proses hash password...<br><br>";

foreach ($admins as $username => $oldPassword) {
    // Hash password lama
    $hashedPassword = password_hash($oldPassword, PASSWORD_DEFAULT);
    
    // Update ke database
    $query = "UPDATE daftar_admin SET password_login = '$hashedPassword' WHERE nama_admin = '$username'";
    
    if (mysqli_query($conn, $query)) {
        echo "✓ Password untuk $username berhasil di-hash<br>";
    } else {
        echo "✗ Error updating $username: " . mysqli_error($conn) . "<br>";
    }
}

echo "<br>Proses selesai! Sekarang Anda bisa login dengan password lama.";
echo "<br><br><strong>HAPUS FILE INI setelah selesai untuk keamanan!</strong>";
?>