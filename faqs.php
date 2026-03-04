<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FAQs | eHealthCare</title>
  <link rel="stylesheet" href="static/style.css" />
</head>

<body>
    <?php
    // Memasukkan (include) file footer.php
    include 'header.php';
    ?>
  <!-- Hero FAQ -->
  <section class="hero">
    <div class="hero-text">
      <h2>Frequently Asked Questions at <span>eHealthCare</span></h2>
      <p>Find answers to common queries about our services, appointments, and patient resources for a seamless healthcare experience.</p>
    </div>
    <div class="hero-image">
      <img src="img/DocU3.png" alt="Doctor3" class="img-doctor3">
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="faq">
    <div class="faq-text faq-heading">
      <h2>General Questions</h2>
      <h3>Essential Information for Every Patient</h3>
      <p>Unveiling the Answers to General Queries about eHealthCare Facilities, Policies, and Services.</p>
    </div>

    <div class="faq-list">
      <details>
        <summary>What are the visiting hours for patients?</summary>
        <div class="faq-answer">
          Visiting hours are from 9:00 AM to 5:00 PM. For special circumstances, please contact our front desk.
        </div>
      </details>
      <details>
        <summary>Can I access my medical records online?</summary>
        <div class="faq-answer">
          Yes, your medical records are available through our secure online patient portal.
        </div>
      </details>
      <details>
        <summary>How do I schedule an appointment with a doctor?</summary>
        <div class="faq-answer">
          Appointments can be made via our website, phone call, or directly at the hospital reception.
        </div>
      </details>
      <details>
        <summary>What insurance plans do you accept?</summary>
        <div class="faq-answer">
          We accept a wide range of insurance plans. Contact our billing office for specific providers.
        </div>
      </details>
      <details>
        <summary>What should I do in case of a medical emergency?</summary>
        <div class="faq-answer">
          Dial 911 immediately or approach the nearest medical staff in our facility.
        </div>
      </details>
      <details>
        <summary>What services does the hospital offer?</summary>
        <div class="faq-answer">
          We offer services including emergency care, diagnostics, surgery, maternity, and specialty clinics.
        </div>
      </details>
      <details>
        <summary>What measures are in place for patient safety and privacy?</summary>
        <div class="faq-answer">
          Our facilities follow strict health protocols and data privacy regulations to ensure your safety and confidentiality.
        </div>
      </details>
      <details>
        <summary>How do I pay my hospital bill?</summary>
        <div class="faq-answer">
          Payments can be made online, at our billing counter, or via mobile banking. We also offer installment plans for large bills.
        </div>
      </details>
    </div>
  </section>

  <?php
    // Memasukkan (include) file footer.php
    include 'footer.php';
  ?>
</body>
</html>
