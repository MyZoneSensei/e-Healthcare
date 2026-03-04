<?php
include 'connect.php';

if ($_SERVER ["REQUEST_METHOD"]=="POST"){
  
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST ['email'];
    $phone_number = $_POST ['phone_number'];
    $appointment_date = $_POST ['appointment_date'];

    $doctor = $_POST['doctor'];
    $note = $_POST ['note'];
    $doctor_id = $_POST['doctor'];


$query = "INSERT INTO appointment (
    first_name, last_name, email, phone_number, appointment_date, doctor_id, note
) VALUES (
    '$first_name', '$last_name', '$email', '$phone_number', '$appointment_date', '$doctor_id', '$note'
)";



mysqli_query($conn, $query);

header("location: Contact.php?success=true");

exit;

}
$doctor = [];

$doctor_result = mysqli_query($conn, "SELECT ID_DOK, Nama_Dokter, Spesialis, Departement, photo, jadwal_dokter FROM doctor");
while ($row = mysqli_fetch_assoc($doctor_result)) {
    $doctors[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Pengaturan karakter dan responsive viewport -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Menghubungkan font dari Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


  <!-- Menghubungkan file CSS eksternal -->
  <link rel="stylesheet" href="static/Contact-style.css" />
  <title>Contact</title>

</head>

<body>
<script>
  window.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    if (params.get("success") === "true") {
      alert("Data berhasil disimpan ke database.");
      // Hilangkan parameter success dari URL tanpa reload
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
</script>

  <!-- Bagian Topbar -->
    <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
    ?>

  <!-- Bagian Hero atau judul halaman -->
  <section class="hero">
    <h2>Book an Appointment</h2>
    <h2>Book your Appointment for Exceptional Care</h2>
    <p>Experience Convenient Scheduling and Priority Access to Our Dedicated Healthcare Professionals.</p>
  </section>

  <!-- Bagian Formulir Pendaftaran -->
  <section class="form-section">
    <form action="Contact.php" method="POST">

  <!-- Row 1: First Name + Last Name -->
  <div class="form-row">
    <div class="form-group">
      <label for="first_name">First Name*</label>
      <input type="text" name="first_name" required />
    </div>
    <div class="form-group">
      <label for="last_name">Last Name*</label>
      <input type="text" name="last_name" required />
    </div>
  </div>

  <!-- Row 2: Email -->
  <div class="form-row">
    <div class="form-group" style="width: 100%;">
      <label for="email">Email*</label>
      <input type="email" name="email" required />
    </div>
  </div>

  <!-- Row 3: Phone + Appointment Date -->
  <div class="form-row">
    <div class="form-group">
      <label for="phone_number">Phone</label>
      <input type="text" name="phone_number" required />
    </div>
    <div class="form-group">
      <label for="appointment_date">Appointment Date*</label>
      <input type="date" name="appointment_date" required />
    </div>
  </div>

  <!-- Row 4.1: Doctor -->
<!-- Row 4.1: Doctor -->
<div class="form-row">
  <div class="form-group" style="width: 100%;">
    <label for="doctor">Doctor*</label>
<select name="doctor" id="doctor" required>
  <option value="">- select -</option>
  <?php foreach ($doctors as $doc): ?>
    <option 
      value="<?= $doc['ID_DOK'] ?>"
      data-jadwal="<?= htmlspecialchars($doc['jadwal_dokter']) ?>"
    >
      <?= htmlspecialchars($doc['Nama_Dokter']) ?>
    </option>
  <?php endforeach; ?>
</select>
<div id="jadwal-text" style="margin-top: 10px; font-style: italic; color: #2563eb;"></div>



  </div>
</div>


  <!-- Row 5: Note -->
  <div class="form-row">
    <div class="form-group" style="width: 100%;">
      <label for="note">Note</label>
      <input type="text" name="note" />
    </div>
  </div>

  <button type="submit" class="submit-button">Submit</button>
</form>
    <div class="photo-wrapper">
      <div class="doctor-photo">
        <img src="img/dr tirta.jpeg" alt="Foto Dokter" />
      </div>
    </div>
  </section>

  <!-- Bagian informasi kontak -->
  <section class="Contact-section">
    <div class="contact-container">
      <div class="location-photo">
        <img src="img/esaunggul.jpg" alt="Foto Lokasi" />
      </div>
      <div class="contact-info">
        <h4>Contact Info</h4>
        <h3>Get In Touch With Our Hospital Center</h3>
        <div class="contact-item">
          <div class="icon">
            <img src="img/Email.png" alt="Mail Icon" />
          </div>
          <div class="text">
            <p>Contact us to the mail below.</p>
            <strong>email@eHealthcare.com</strong>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon">
            <img src="img/Phone.png" alt="Phone Icon" />
          </div>
          <div class="text">
            <p>Call us for intermediate assistance.</p>
            <strong>+62 8147 8888 933</strong>
          </div>
        </div>
        <div class="contact-item">
          <div class="icon">
            <img src="img/Location.png" alt="Location Icon" />
          </div>
          <div class="text">
            <p>Visit our clinic for a consultation.</p>
            <strong>Harapan Indah, Bekasi</strong>
          </div>
        </div>
      </div>
      
    <!-- Peta OSM -->
      <div id="map" style="width: 100%; height: 400px; border-radius: 12px; margin-top: 20px;"></div>
    </div>
  </section>
    <script>
    // Koordinat Harapan Indah, Bekasi
    var latitude = -6.1815;
    var longitude = 106.9784;

    // Inisialisasi peta
    var map = L.map('map').setView([latitude, longitude], 15);

    // Tambahkan layer OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker
    L.marker([latitude, longitude]).addTo(map)
      .bindPopup('Harapan Indah, Bekasi')
      .openPopup();


  document.addEventListener('DOMContentLoaded', function () {
    const doctorSelect = document.getElementById('doctor');
    const jadwalText = document.getElementById('jadwal-text');

    doctorSelect.addEventListener('change', function () {
      const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];
      const jadwal = selectedOption.getAttribute('data-jadwal');
      jadwalText.textContent = jadwal ? "Jadwal Dokter: " + jadwal : "";
    });
  });


  </script>

</body>

  <!-- Bagian Footer -->
<!-- <footer class="footer">
    <div class="footer-container">
      <div class="footer-col logo-col">
        <img src="Static/logo_ehc.png" alt="eHealthCare Logo" class="footer-logo" />
        <p>At eHealthCare we are committed to providing the highest standard of medical services and cutting-edge treatments.</p>
      </div>
      <div class="footer-col">
        <h4>Departments</h4>
        <ul>
          <li>Cardiology</li>
          <li>Ophtalmology</li>
          <li>Neurology</li>
          <li>Odontology</li>
          <li>Pneumology</li>
          <li>Gynecology</li>
        </ul>
      </div>
      <div class="footer-col contact-info">
        <h4>Contact Info</h4>
        <ul>
          <li><img src="Static/icon-email.png" alt=""> email@eHealthcare.com</li>
          <li><img src="Static/icon-phone.png" alt=""> +6281478888933</li>
          <li><img src="Static/icon-location.png" alt=""> Harapan Indah, Bekasi</li>
          <li><img src="Static/icon-clock.png" alt=""> Mon – Fri: 9:00am to 5:00pm<br>Sunday: closed</li>
        </ul>
      </div>
    </div>
    <hr />
    <p class="footer-bottom-text">Copyright 2025 eHealth Care. All Rights Reserved</p>
  </footer> -->
  
    <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
    ?>
</html>
