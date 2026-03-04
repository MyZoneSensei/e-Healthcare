<?php
$host = "sql211.infinityfree.com";
$user = "if0_39487147";
$pass = "pemwebehc123"; 
$db = "if0_39487147_ehc";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
