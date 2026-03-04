<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Hapus data order berdasarkan ID
$query = "DELETE FROM orders WHERE id_orders = '$id'";
mysqli_query($conn, $query);

header("Location: admin_order.php");
exit;
?>