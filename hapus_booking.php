<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM appointment WHERE id_nama = $id";
    mysqli_query($conn, $query);
}

header("Location: admin_booking.php");
exit;
