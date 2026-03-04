<?php
include 'connect.php';

$id = $_GET['id'];
$query = "DELETE FROM daftar_admin WHERE ID_admin = $id";
mysqli_query($conn, $query);

header("Location: admin_daftar.php");
exit;
?>
