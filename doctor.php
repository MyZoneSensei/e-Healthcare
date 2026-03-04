<?php
include 'connect.php'; // koneksi ke database db_ehc

$result = mysqli_query($conn, "SELECT * FROM doctor");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Page</title>
    <link rel="stylesheet" href="static/admin-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
    ?>
</header>

<div class="doctor-text">
    <p class="subheading">Meet our doctors</p>
    <h2>Meet Our Dedicated <br> Healtcare Team</h2>
    <p class="description">Get to know the compassionate and highly skilled professionals who make your care their priority.</p>
</div>

<div class="doctor-frame">
    <?php
     
    while ($row = mysqli_fetch_assoc($result)): 
    ?>
        <div class="doctor-img">
            <img src="img/<?= htmlspecialchars($row['photo']) ?>" alt="Foto Dokter">
            <div class="doctor-desc">
                <h3><?= htmlspecialchars($row['Nama_Dokter']) ?></h3>
                <p><?= htmlspecialchars($row['Spesialis']) ?></p>
                <a href="<?= strtolower($row['Departement']) ?>.php">
                    <?= htmlspecialchars($row['Departement']) ?>
                </a>
                <p><strong>Jadwal:</strong> <?= htmlspecialchars($row['jadwal_dokter']) ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>

  <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
  ?>

</body>
</html>
