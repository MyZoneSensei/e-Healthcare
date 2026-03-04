<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Hapus data obat berdasarkan ID
$query = "DELETE FROM medicines WHERE id_medicines = '$id'";
mysqli_query($conn, $query);

header("Location: admin_obat.php");
exit;
?>