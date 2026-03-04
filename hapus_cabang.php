<?php
session_start();
include 'connect.php';

$id = $_GET['id'];

// Ambil nama file gambar sebelum menghapus data
$result = mysqli_query($conn, "SELECT hospital_pict FROM branch_hospitals WHERE id_hospital = '$id'");
$row = mysqli_fetch_assoc($result);
$gambarFile = $row['hospital_pict'];

// Hapus data dari database
$query = "DELETE FROM branch_hospitals WHERE id_hospital = '$id'";
mysqli_query($conn, $query);

// Hapus file gambar dari folder img (opsional)
if ($gambarFile && file_exists('img/' . $gambarFile)) {
    unlink('img/' . $gambarFile);
}

header("Location: admin_cabang.php");
exit;
?>