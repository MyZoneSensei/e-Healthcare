<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odontology Services | eHealthCare</title>
    <link rel="stylesheet" href="static/styleDPT.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php
    // Memasukkan (include) file header.php untuk bagian header situs
    include 'header.php';
    ?>

    <section class="hero">
        <div class="container">
           <a href="#" class="icon-card active">
                        <img src="img/icon-odontology.png" alt="" class="icon-departement">
                        <span>Odontology</span>
                    </a>
            <h1>Your Health, Our Priority</h1>
            <h2>Dental excellence: Your trusted partner for a bright, healthy smile, diagnosis and treatment</h2>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <div class="services-inner">
                <div class="services-text">
                    <h3>Odontology services: diagnostic and treatments</h3>
                    <ul class="services-list">
                        <li>
                            <strong>General Dentistry</strong>
                            <p>Our general dentistry services cover a wide range of oral health needs</p>
                        </li>
                        <li>
                            <strong>Specialized Services</strong>
                            <p>Our odontology department offers specialized services to address specific oral health concern</p>
                        </li>
                    </ul>
                </div>
                <div class="services-image">
                    <img src="img/Odon2.jpeg" alt="Doctor">
                </div>
            </div>
            
            <div class="faq">
                <h4>Frequently Asked Questions</h4>
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-1">What are the visiting hours for patients?</button>
                    <div id="faq-answer-1" class="faq-answer" role="region">
                        <div class="faq-answer-content">
                            <p>Visiting hours are from 9:00 am to 5:00 pm, but exceptions can be made for special circumstances. Please check with the nursing staff or front desk for more information.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-2">Can I access my medical records online?</button>
                    <div id="faq-answer-2" class="faq-answer" role="region">
                        <div class="faq-answer-content">
                            <p>Yes, you can access your medical records securely through our online patient portal. If you encounter any issues or have questions, feel free to contact our medical records department.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-3">How do I schedule an appointment with a doctor?</button>
                    <div id="faq-answer-3" class="faq-answer" role="region">
                        <div class="faq-answer-content">
                            <p>You can schedule an appointment by calling our appointment hotline, using our online appointment booking system on the website, or visiting the hospital in person.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="patient-info">
        <div class="container">
            <h2>Make Informed Decisions About Your Health</h2>
            <div class="patient-steps">
                <div class="step">
                    <strong>Step 1: Book an appointment</strong>
                    <p>Contact our specialists for an initial consultation.</p>
                </div>
                <div class="step">
                    <strong>Step 2: Diagnostics</strong>
                    <p>Undergo assessments and vision tests.</p>
                </div>
                <div class="step">
                    <strong>Step 3: Treatment</strong>
                    <p>Get personalized treatment options based on your test results.</p>
                </div>
            </div>
            <div class="info-icons">
                <div class="info-box">
                    <img src="img/icon-rumahsakit.png" alt="Emergency">
                    <p>Emergency Services Available</p>
                </div>
                <div class="info-box">
                    <img src="img/icon-doctor.png" alt="Qualified Doctor">
                    <p>Qualified Doctors and Nurses</p>
                </div>
                <div class="info-box">
                    <img src="img/icon-report.png" alt="Reports">
                    <p>Online Medical Reports</p>
                </div>
            </div>
        </div>
    </section>

    <?php
    include 'inc-contact.php';
    ?>

    <?php
    // Memasukkan (include) file footer.php untuk bagian footer situs
    include 'footer.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /* DROPDOWN MENU ANIMATION */
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const dropdownContent = dropdown.querySelector('.dropdown-content');

                // Set initial styles for animation
                if (dropdownContent) {
                    dropdownContent.style.opacity = '0';
                    dropdownContent.style.transform = 'translateY(-10px)';
                    dropdownContent.style.transition = 'opacity 0.3s ease, transform 0.3s ease, display 0.3s ease';
                    dropdownContent.style.display = 'none';
                }

                dropdown.addEventListener('mouseenter', () => {
                    if (dropdownContent) {
                        dropdownContent.style.display = 'block';
                        // Force reflow to make transition work
                        dropdownContent.offsetHeight; // eslint-disable-line
                        dropdownContent.style.opacity = '1';
                        dropdownContent.style.transform = 'translateY(0)';
                    }
                });

                dropdown.addEventListener('mouseleave', () => {
                    if (dropdownContent) {
                        dropdownContent.style.opacity = '0';
                        dropdownContent.style.transform = 'translateY(-10px)';
                        
                        // Wait for animation to finish before hiding the element
                        setTimeout(() => {
                            // Only hide if not hovering over the dropdown
                            if (!dropdown.matches(':hover')) {
                                dropdownContent.style.display = 'none';
                            }
                        }, 300); // Match with transition duration
                    }
                });
            });

            /* FAQ SECTION FUNCTIONALITY */
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const questionButton = item.querySelector('.faq-question');
                const answerDiv = item.querySelector('.faq-answer');

                if (questionButton && answerDiv) {
                    questionButton.addEventListener('click', () => {
                        const isActive = item.classList.contains('active');

                        // Close all other active FAQ items
                        faqItems.forEach(otherItem => {
                            if (otherItem !== item && otherItem.classList.contains('active')) {
                                otherItem.classList.remove('active');
                                otherItem.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                                const otherAnswer = otherItem.querySelector('.faq-answer');
                                if (otherAnswer) {
                                    otherAnswer.style.maxHeight = '0';
                                }
                            }
                        });

                        // Toggle current item
                        if (isActive) {
                            item.classList.remove('active');
                            questionButton.setAttribute('aria-expanded', 'false');
                            answerDiv.style.maxHeight = '0';
                        } else {
                            item.classList.add('active');
                            questionButton.setAttribute('aria-expanded', 'true');
                            // Set max-height to scrollHeight to allow dynamic content
                            answerDiv.style.maxHeight = answerDiv.scrollHeight + 'px';
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>