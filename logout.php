<?php
session_start();
session_unset(); // menghapus semua variabel session
session_destroy(); // menghancurkan session
header("Location: index.php"); // redirect ke halaman login
exit;
?>
