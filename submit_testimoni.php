<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name']    ?? '');
    $message = trim($_POST['message'] ?? '');
    $rating  = intval($_POST['rating'] ?? 0);

    if ($name && $message && $rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare(
            "INSERT INTO testimonials (name, message, rating) VALUES (?, ?, ?)"
        );
        if ($stmt) {
            $stmt->bind_param("ssi", $name, $message, $rating);
            $stmt->execute();
            $stmt->close();
            header("Location: About.php?status=success#testimonialForm");
            exit();
        }
    }
    header("Location: About.php?status=error#testimonialForm");
    exit();
}
// jika bukan POST
header("Location: About.php");
exit();
?>