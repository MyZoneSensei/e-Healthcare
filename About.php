<!DOCTYPE html>
<html lang="en">
<!-- Bagian Head: Memuat font, title, CSS & JavaScript -->
<head>
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
  <title>eHealthCare - Homepage</title>
  <link rel="stylesheet" href="script/stylee-about.css">
  <script src="script/script-about.js" defer></script>
</head>
<body>
  <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
  ?>

<!-- Hero Section: Bagian pembuka dengan tagline dan fitur utama -->
  <section class="hero">
    <div class="hero-text">
      <h2>Your Journey To Health <br> Begins Here</h2>
      <p>Our team of dedicated professionals is here to ensure your well-being.</p>
      <ul class="features-list">
        <li>
          <span class="line1">⦾ 24/7 emergency room</span>
        </li>
        <li>
          <span class="line1">⦾ Health screening</span>
        </li>
        <li>
          <span class="line1">⦾ Internal medicine</span>
        </li>
        <li>
          <span class="line1">⦾ Surgery room</span>
        </li>
      </ul>      
    </div>
    <div class="hero-images">
      <img src="img/doc.png" id="g1" alt="Foto Dokter">
    </div>
  </section>

<!-- Features Section: Menampilkan fasilitas unggulan rumah sakit -->
  <section class="features">
    <h2 class="title-page2">Choose health amenities suited to your needs</h2>

    <div class="feature-item">
      <div class="text">
        <h3>Surgery Room</h3>
        <p class="text-feature">From minor surgeries to complex interventions, our surgeons leverage the latest advancements in medical technology to optimize patient outcomes.</p>
        <p class="text-feature">Our commitment to excellence in surgical care extends beyond the operating room, with a focus on preoperative and postoperative support to ensure a seamless and comfortable patient experience.</p>
      </div>
      <img src="img/operation.png" alt="Surgery Room">
    </div>

    <div class="feature-item">
      <img src="img/medicine.png" alt="Internal Medicine">
      <div class="text">
        <h3>Internal Medicine</h3>
        <p class="text-feature">Whether addressing chronic illnesses, managing complex medical cases, or promoting overall wellness, our internal medicine team combines expertise and compassion to provide patient-centered care.</p>
        <p class="text-feature">Our goal is to be your trusted partner in achieving and maintaining optimal health throughout every stage of life.</p>
      </div>
    </div>
  </section>

<!-- Stats Section: Menampilkan statistik pencapaian eHealthCare -->
  <section class="stats">
    <h2 class="stats-list">We are really proud of the stats</h2>
    <p class="stats-detail">eHealthCare has a long list of accomplishments that <br> reflect its commitment to healthcare excellence.</p>

    <div class="stat-cards">
      <?php
      include 'connect.php';
      $sql = "SELECT established_year FROM hospital_info LIMIT 1";
      $result = $conn->query($sql);

      $years = 0;
      if ($result && $row = $result->fetch_assoc()) {
          $startYear = (int)$row['established_year'];
          $currentYear = (int)date("Y");
          $years = $currentYear - $startYear;
      }
      ?>
      <div class="card">
        <img src="img/icon_stethoscope.png" alt="Years Icon" style="width: 50px; height: 50px; margin-bottom: 20px;">
        <h3><strong><?php echo $years; ?>+ Years</strong></h3>
        <p>Providing trusted care since <?php echo $startYear; ?> to people across the country.</p>
      </div>
      <div class="card" onclick="openHospitalModal()" style="cursor: pointer;">
        <img src="img/icon-hospital.png" alt="Hospital Icon" style="background-color: white; padding: 20px; border-radius: 10px; width: 15%;">
        <h3 style="margin: 0 0 25px 0;"><strong>3+ Hospitals</strong></h3>
        <p style="margin: 0;">Our network spans across multiple cities, ensuring accessible care wherever you are.</p>
      </div>
      <div class="card" id="doctorCard" onclick="openModal()">
        <img src="img/icon_doctor.png" alt="Doctors Icon" class="stat-icon">
        <h3>11+ Doctors</h3>
        <p>Meet our highly skilled and compassionate medical professionals.</p>
      </div>
    </section>

  <!-- Modal Dokter: Muncul saat klik pada card dokter -->
    <div id="doctorModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Our Doctors</h2>
        <?php
        include 'connect.php';

        $sql = "SELECT Nama_Dokter, Spesialis, Departement, photo FROM doctor";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="doctor-card">';
                
                // Tampilkan gambar dari folder img/
                if (!empty($row['photo'])) {
                    $photoPath = 'img/' . htmlspecialchars($row['photo']);
                    echo '<img src="' . $photoPath . '" alt="Doctor Photo" class="doctor-photo" style="width:80px;height:80px;border-radius:50%;object-fit:cover;margin-bottom:10px;">';
                }

                echo '<h4>' . htmlspecialchars($row['Nama_Dokter']) . '</h4>';
                echo '<p>Spesialis: ' . htmlspecialchars($row['Spesialis']) . '</p>';
                echo '<p>Departement: ' . htmlspecialchars($row['Departement']) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No doctors found.</p>";
        }
        ?>

      </div>
  </div>

  <div id="hospitalModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeHospitalModal()">&times;</span>
      <h2>Hospital Branches</h2>
      <div class="branch-container">
              <?php
        include 'connect.php';

        $sql = "SELECT hospital_name, hospital_location, phone, hospital_pict FROM branch_hospitals";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                // Ambil nama file gambar dari kolom 'hospital_pict'
                if (!empty($row['hospital_pict'])) {
                    $imageSrc = 'img/' . htmlspecialchars($row['hospital_pict']);
                } else {
                    // Optional: fallback jika tidak ada gambar
                    $imageSrc = 'img/default-hospital.jpg';
                }

                echo '<div class="branch-card-with-bg" style="background-image: url(\'' . $imageSrc . '\');">';
                echo '<div class="overlay">';
                echo '<h4>' . htmlspecialchars($row['hospital_name']) . '</h4>';
                echo '<p>📍 ' . htmlspecialchars($row['hospital_location']) . '</p>';
                echo '<p>📞 ' . htmlspecialchars($row['phone']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No branches found.</p>";
        }
        ?>
      </div>
    </div>
  </div>

<!-- Modal Dokter: Muncul saat klik pada card dokter -->
<section class="testimonials">
  <h2>What Our Patients Say</h2>
  <div class="testimonial-layout">  
    <div class="testimonial-list">
        <?php
        include 'connect.php';

        $sql = "SELECT name, message, rating FROM testimonials ORDER BY created_at DESC LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="testimonial-item">';
                echo '<p class="quote">' . str_repeat('⭐', $row['rating']) . '<br><br>"' . htmlspecialchars($row['message']) . '"</p>';
                echo '<p class="author">– ' . htmlspecialchars($row['name']) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Belum ada testimoni.</p>";
        }
        ?>
      </div>
    <form method="POST" action="submit_testimoni.php" id="testimonialForm">
      <h3 class="header-form">Bagikan Pengalaman Anda</h3>
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="name" required>
      </div>
      <div class="form-group">
        <label for="pesan">Pesan:</label>
        <textarea id="pesan" name="message" required></textarea>
      </div>
      <div class="form-group">
        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
          <option value="">-- Pilih Rating --</option>
          <option value="1">⭐</option>
          <option value="2">⭐⭐</option>
          <option value="3">⭐⭐⭐</option>
          <option value="4">⭐⭐⭐⭐</option>
          <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
      </div>
      <button type="submit">Kirim</button>
    </form>
  </div>
</section>

  <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
  ?>
  <script src="script-about.js"></script>
</body>
</html>