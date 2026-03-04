<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Departments - Hospitalia</title>
    <link rel="stylesheet" href="static/styleDPTPAGE.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php
    // Memasukkan (include) file header.php untuk bagian header situs
    include 'header.php';
    ?>

    <main>
        <section class="hero">
            <div class="container">
                <h4>OUR MEDICAL SERVICES</h4>
                <h1>Your Health, Our Priority</h1>
                <p>Exceptional Medical Services Tailored to Your Needs: Putting Your Health and Well-being First.</p>
            </div>
        </section>

        <section class="department-icons">
            <div class="container">
                <div class="icons-grid">
                    <a href="Cardiology.php" class="icon-card">
                        <div class="icon-wrapper">🫀</div>
                        <span>Cardiology</span>
                    </a>
                    <a href="Ophtalmology.php" class="icon-card">
                        <div class="icon-wrapper">👁️</div>
                        <span>Ophthalmology</span>
                    </a>
                    <a href="Neurology.php" class="icon-card active">
                        <div class="icon-wrapper">🧠</div>
                        <span>Neurology</span>
                    </a>
                    <a href="Odontology.php" class="icon-card">
                        <div class="icon-wrapper">🦷</div>
                        <span>Odontology</span>
                    </a>
                    <a href="Pneumology.php" class="icon-card">
                        <div class="icon-wrapper">🫁</div>
                        <span>Pneumology</span>
                    </a>
                    <a href="Gynecology.php" class="icon-card">
                        <div class="icon-wrapper">🚺</div>
                        <span>Gynecology</span>
                    </a>
                </div>
            </div>
        </section>
        
        <section class="content">
            <div class="container">
                <div class="content-intro">
                    <h2>Neurology</h2>
                    <p>We offer comprehensive care for patients with neurological conditions. Our advanced diagnostic services are designed to accurately assess neurological health.</p>
                </div>

                <div class="content-grid">
                    <div class="text-block">
                        <h3>diagnostics Services</h3>
                        <ul>
                            <li>Electroencephalographye</li>
                            <li>Electromyography</li>
                            <li>Magnetic Resonance</li>
                            <li>Neuropsychological testing</li>
                        </ul>
                    </div>
                    <div class="image-block">
                        <img src="img/Neu1.jpeg" alt="Personalized diagnosis">
                        <div class="image-caption">Personalized diagnosis</div>
                    </div>
                </div>

                <div class="content-grid reverse">
                    <div class="text-block">
                        <h3>Treatment options</h3>
                        <p>Specialized care by our expert team. Diagnosis, monitoring, and personalized treatment plans based on your heart's needs.</p>
                        <ul>
                            <li>Stroke Care</li>
                            <li>Migraine Care</li>
                            <li>Epilepsy Managementn</li>
                            <li>Neuromuscular Disorder</li>
                        </ul>
                    </div>
                    <div class="image-block">
                       <img src="img/Neu2.jpeg" alt="Treatment Solutions">
                       <div class="image-caption">Treatment Solutions</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq">
            <div class="container faq-container">
                <div class="faq-image">
                    <img src="img/Dokter FAQ.jpg" alt="FAQ Image">
                </div>
                <div class="faq-content">
                    <h3>FAQ</h3>
                    <h2>Everything You Need To Know About Us</h2>
                    <div class="accordion">
                        <details>
                            <summary>
                                What are the visiting hours for patients?
                                <span class="plus-minus">+</span>
                            </summary>
                            <p>Visiting hours are from 9:00 am to 5:00 pm, but exceptions can be made for special circumstances. Please check with the nursing staff or front desk for more information.</p>
                        </details>
                        <details>
                            <summary>
                                Can I access my medical records online?
                                <span class="plus-minus">+</span>
                            </summary>
                            <p>Yes, you can access your medical records securely through our online patient portal. If you encounter any issues or have questions, feel free to contact our medical records department.</p>
                        </details>
                        <details>
                            <summary>
                                How do I schedule an appointment with a doctor
                                <span class="plus-minus">+</span>
                            </summary>
                            <p>You can schedule an appointment by calling our appointment hotline, using our online appointment booking system on the website, or visiting the hospital in person.</p>
                        </details>
                           <details>
                            <summary>
                               What insurance do you accept at the hospital?
                                <span class="plus-minus">+</span>
                            </summary>
                            <p>Our hospital provides a comprehensive range of medical services, including emergency care, surgery, maternity services, diagnostics, and specialized treatments in various medical fields.</p>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include 'inc-cta.php';
        ?>
    </main>

    <?php
    // Memasukkan (include) file header.php untuk bagian header situs
    include 'footer.php';
    ?>

</body>
</html>