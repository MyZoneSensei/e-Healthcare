<?php
include 'connect.php';

$id = $_GET['id'];
$query = "DELETE FROM doctor WHERE ID_dok = $id";
mysqli_query($conn, $query);

header("Location: admin_dokter.php");
exit;
?>
