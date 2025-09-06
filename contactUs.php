
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - ShopNest</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="items/assets/styles.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.ico">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php
    session_start();
    include("navbar.php");
    ?>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-text {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        /* Contact Section */
        .contact-section {
            padding: 60px 0;
            background: var(--light-gray);
        }

        .contact-heading {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 30px;
            text-align: center;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 10px;
        }

        .contact-link {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* Form Styling */
        .form-control {
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 12px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(37, 99, 235, 0.3);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--primary-hover), #1e40af);
            transform: translateY(-2px);
        }

        /* FAQ Section */
        .faq-section {
            padding: 60px 0;
            background: white;
        }

        .faq-card {
            background: var(--light-gray);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
        }

        .faq-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 10px;
        }

        /* Footer */
        .custom-footer {
            background: linear-gradient(to right, #212529, #343a40);
            color: white;
            padding: 40px 0;
        }

        .footer-text {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-text {
                font-size: 1rem;
            }

            .contact-heading {
                font-size: 1.8rem;
            }

            .contact-card {
                margin-bottom: 20px;
            }
        }

        /* Animation */
        .animate__fadeIn {
            animation-duration: 1s;
        }
    </style>
</head>
<body>
    

    <!-- Hero Banner -->
    <section class="hero-section">
        <div class="container hero-content animate__animated animate__fadeIn">
            <h1 class="hero-title">Contact ShopNest</h1>
            <p class="hero-text">
                We're here to assist you! Reach out with any questions, concerns, or feedback.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="contact-heading animate__animated animate__fadeIn">Get in Touch</h2>
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-6 mb-4">
                    <div class="contact-card animate__animated animate__fadeIn" data-wow-delay="0.2s">
                        <h4 class="mb-4">Contact Information</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="bi bi-envelope-fill contact-icon"></i>
                                <strong>Email:</strong>
                                <a href="mailto:support@shopnest.lk" class="contact-link">support@shopnest.lk</a>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-telephone-fill contact-icon"></i>
                                <strong>Phone / WhatsApp:</strong>
                                <a href="tel:+94761234567" class="contact-link">+94 76 123 4567</a><br>
                                <small class="text-muted">Monday to Saturday, 9:00 AM – 6:00 PM</small>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-globe contact-icon"></i>
                                <strong>Social Media:</strong><br>
                                <div class="mt-2">
                                    <i class="bi bi-facebook contact-icon" style="color:#3b5998;"></i>
                                    <a href="https://facebook.com/shopnest.lk" target="_blank" class="contact-link">facebook.com/shopnest.lk</a>
                                </div>
                                <div class="mt-2">
                                    <i class="bi bi-instagram contact-icon" style="color:#E1306C;"></i>
                                    <a href="https://instagram.com/shopnest.lk" target="_blank" class="contact-link">instagram.com/shopnest.lk</a>
                                </div>
                                <div class="mt-2">
                                    <i class="bi bi-tiktok contact-icon" style="color:#000000;"></i>
                                    <a href="https://tiktok.com/@shopnest.lk" target="_blank" class="contact-link">tiktok.com/@shopnest.lk</a>
                                </div>
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-clock-fill contact-icon"></i>
                                <strong>Response Time:</strong>
                                We respond within 1–2 hours during working hours.
                            </li>
                            <li>
                                <i class="bi bi-cart-fill contact-icon"></i>
                                <strong>Help with Orders:</strong>
                                Please include your Order ID when contacting us.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Message Form -->
                <div class="col-md-6 mb-4">
                    <div class="contact-card animate__animated animate__fadeIn" data-wow-delay="0.4s">
                        <h4 class="mb-4">Send Us a Message</h4>
                        <form id="contactForm" action="submit_contact.php" method="post">
                            <div class="form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="message">Message <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div id="formMessage" class="mb-3" style="display: none;"></div>
                            <button type="submit" class="btn btn-submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="contact-heading animate__animated animate__fadeIn">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="faq-card animate__animated animate__fadeIn" data-wow-delay="0.2s">
                        <h3 class="faq-title">How do I track my order?</h3>
                        <p class="about-text">
                            Once your order is shipped, you'll receive a tracking link via email. You can also contact us with your Order ID.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="faq-card animate__animated animate__fadeIn" data-wow-delay="0.4s">
                        <h3 class="faq-title">What is your return policy?</h3>
                        <p class="about-text">
                            We offer free returns within 30 days. Visit our <a href="returns.php" class="contact-link">Returns Page</a> for details.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="faq-card animate__animated animate__fadeIn" data-wow-delay="0.6s">
                        <h3 class="faq-title">How secure is my payment?</h3>
                        <p class="about-text">
                            All payments are processed through secure gateways, ensuring your data is protected.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="faq-card animate__animated animate__fadeIn" data-wow-delay="0.8s">
                        <h3 class="faq-title">Can I change my order?</h3>
                        <p class="about-text">
                            Order changes are possible before shipping. Contact us immediately with your Order ID.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="container text-center">
            <p class="footer-text">
                © 2025 ShopNest. All rights reserved. This website and its content are the property of ShopNest.
                You may not copy, reuse, or distribute any part of this site without permission.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
    <!-- WOW.js for scroll animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();

        // Client-side form validation and feedback
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            const formMessage = document.getElementById('formMessage');

            // Basic validation
            if (name.length < 2) {
                formMessage.style.display = 'block';
                formMessage.className = 'alert alert-danger';
                formMessage.textContent = 'Please enter a valid name (at least 2 characters).';
                return;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                formMessage.style.display = 'block';
                formMessage.className = 'alert alert-danger';
                formMessage.textContent = 'Please enter a valid email address.';
                return;
            }
            if (message.length < 10) {
                formMessage.style.display = 'block';
                formMessage.className = 'alert alert-danger';
                formMessage.textContent = 'Please enter a message (at least 10 characters).';
                return;
            }

            // If validation passes, submit the form
            formMessage.style.display = 'block';
            formMessage.className = 'alert alert-success';
            formMessage.textContent = 'Submitting your message...';
            this.submit();
        });
    </script>
</body>
</html>
