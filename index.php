<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>eHealthCare</title>
  <link rel="stylesheet" href="static/style.css">
</head>

<body>
    <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
    ?>
  
  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-text">
      <h2>Smart Healthcare for a Better <span>Tomorrow</span></h2>
      <p>Experience seamless, technology-driven
        medical care with eHealthCare.</p>
        <div class="hero-buttons">
          <a href="Contact.php" class="appointment-btn">
            <img src="img/icon-Calendar.png" alt="Calendar Icon" class="button-icon">
            Appointment
          </a>
          <a href="pharmacy.php" class="medicines-btn">Buy Medicines →</a>
        </div>
    </div>
    <div class="hero-image">
      <img src="img/DocU1.png" alt="Doctor1" class="img-doctor1">
    </div>
  </section>

  <!--Info Boxes-->
  <section class="info-boxes">
    <div class="box">
      <div class="box-main">
        <img src="img/icon_stethoscope.png" alt="Stethoscope Icon" class="box-icon" />
        <span>15+ <br>Years</span>
      </div>
      <div class="box-desc">Trusted experience in healthcare</div>
    </div>
    <div class="box">
      <div class="box-main">
        <img src="img/icon-Hospital.png" alt="Hospital Icon" class="box-icon" />
        <span>5+ <br>Hospitals</span>
      </div>
      <div class="box-desc">Our growing network of hospitals</div>
    </div>
    <div class="box">
      <div class="box-main">
        <img src="img/icon-Doctor.png" alt="Doctor Icon" class="box-icon" />
        <span>11+ <br>Doctors</span>
      </div>
      <div class="box-desc">Experienced and certified doctors</div>
    </div>
  </section>
  

  <!-- Services -->
  <section class="services">
    <div class="services-header">
      <div class="services-image">
        <img src="img/DocU2.png" alt="Doctor2" class ="img-doctor2">
      </div>
      <div class="services-text">
        <h4>Our Departments</h4>
        <h3>Specialities That Meet Your Needs</h3>
        <p>Experience comprehensive, personalized care from our expert medical team. 
          With advanced diagnostics and tailored treatments.</p>
        <a href="Cardiology.php">See All Departments →</a>
      </div>
    </div>

    <div class="service-list">
      <div class="card fade-in">
        <h4>Cardiology</h4>
        <p>Hearth healthcare and cardiovascular disease, diagnosis, and treatment for 
          all heart conditions</p>
        <a href="NAV-Cardiology.php">Learn More</a>
      </div>
      <div class="card fade-in">
        <h4>Ophthalmology</h4>
        <p>Your trusted partner for comprehensive eye care and vision solutions 
          to enhance your eyes conditions</p>
        <a href="NAV-Ophthalmology.php">Learn More</a>
      </div>
      <div class="card fade-in">
        <h4>Neurology</h4>
        <p>Leading-edge neurology: Dedicated to understanding, treating, and enhancing 
          brain health with expertise</p>
        <a href="NAV-Neurology.php">Learn More</a>
      </div>
      <div class="card fade-in">
        <h4>Odontology</h4>
        <p>Dental excellence: your trusted partner for a bright, healthy smile, diagnosis, 
          and treatment</p>
        <a href="NAV-Odontology.php">Learn More</a>
      </div>
    </div>
  </section>

  <!-- Doctors -->
  <section class="doctors">
    <div class="doctors-text">
      <h4>Meet Our Doctors</h4>
      <h3>Our Best Medical Team</h3>
      <p>Our experienced doctors are dedicated to providing 
      exceptional care.</p>
      <a href="doctor.php">See All Doctors →</a>
    </div>
    
    <div class="doctor-list">
      <div class="doctor-frame">
    <?php
      include 'connect.php';
      $sql = "SELECT Nama_Dokter, Spesialis, Departement, photo, jadwal_dokter FROM doctor";
      $result = $conn->query($sql);
      $count = 0;
      while ($row = mysqli_fetch_assoc($result)):
         if ($count >= 4) break;
    ?>
        <div class="doctor-img fade-in">
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
      <?php 
          $count++; // Tambah jumlah yang sudah ditampilkan
          endwhile; 
      ?>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq fade-in">
    <div class="faq-img-txt">
      <div class="faq-image">
        <img src="img/DocU3.png" alt="Doctor3" class="img-doctor3">
      </div>
      <div class="faq-text">
        <h4>FAQs</h4>
        <h3>Frequently Asked Questions</h3>
        <p>We understand that navigating healthcare can sometimes raise questions, and we're here to ensure you have all the information you need.</p>
        <a href="faqs.php">See All FAQs →</a>
      </div>
    </div>
    
    <div class="faq-list">
      <details>
        <summary>What are the visiting hours?</summary>
        <div class="faq-answer">
          Visiting hours are from 9:00 am to 5:00 pm, but exceptions can be made for special circumstances. Please check with the nursing staff or front desk for more information.
        </div>
      </details>
      <details>
        <summary>Can I access my records online?</summary>
        <div class="faq-answer">
          Yes, you can access your medical records securely through our online patient portal. If you encounter any issues or have questions, feel free to contact our medical records department.
        </div>
      </details>
      <details>
        <summary>How to book an appointment?</summary>
        <div class="faq-answer">
          You can schedule an appointment by calling our appointment hotline, using our online appointment booking system on the website, or visiting the hospital in person.
        </div>
      </details>
      <details>
        <summary>What insurance do you accept?</summary>
        <div class="faq-answer">
          We accept a wide range of insurance plans. Please check with our billing department or your insurance provider to confirm coverage details.
        </div>
      </details>
      <details>
        <summary>What should I do in case of a medical emergency?</summary>
        <div class="faq-answer">
          In case of a medical emergency, please call 911 immediately. If you are already on our premises, contact the nearest hospital staff or use the emergency call buttons located throughout the facility.
        </div>
      </details>
      <details>
        <summary>What services are offered?</summary>
        <div class="faq-answer">
          Our hospital provides a comprehensive range of medical services, including emergency care, surgery, maternity services, diagnostics, and specialized treatments in various medical fields.
        </div>
      </details>
    </div>
  </section>

    <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
    ?>

  <a href="admin_login.php" class="floating-login" title="Login">
    🔒
  </a>


  <script src="script/index.js"></script>
</body>
</html>
