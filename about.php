
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - ShopNest</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles -->
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

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/about/shoes-1707494675.jpg') no-repeat center center/cover;
            opacity: 0.2;
            z-index: 1;
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

        .btn-cta {
            background: white;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-cta:hover {
            background: var(--primary-hover);
            color: white;
            border-color: white;
            text-decoration: none;
        }

        /* About Section */
        .about-section {
            padding: 60px 0;
            background: var(--light-gray);
        }

        .about-heading {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 30px;
            text-align: center;
        }

        .about-text {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .about-image {
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            max-width: 100%;
            height: auto;
        }

        /* Mission Section */
        .mission-section {
            padding: 60px 0;
            background: white;
        }

        .mission-card {
            background: var(--light-gray);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease;
        }

        .mission-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .mission-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .mission-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
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

            .about-heading {
                font-size: 1.8rem;
            }

            .mission-card {
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
            <h1 class="hero-title">About ShopNest</h1>
            <p class="hero-text">
                Discover who we are and why we're passionate about bringing you the best shopping experience.
            </p>
            <a href="products.php" class="btn-cta">Shop Now</a>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center animate__animated animate__fadeIn">
                <div class="col-lg-6">
                    <img src="images/about/shoes-1707494675.jpg" alt="About ShopNest" class="about-image img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2 class="about-heading">Our Story</h2>
                    <p class="about-text">
                        ShopNest is your trusted online shopping destination in Sri Lanka, offering a curated selection of
                        quality products ranging from electronics to fashion and home essentials.
                    </p>
                    <p class="about-text">
                        Founded with a vision to simplify online shopping, we prioritize customer satisfaction through fast
                        delivery, secure payments, and exceptional support.
                    </p>
                    <p class="about-text">
                        Our mission is to make high-quality products accessible to everyone, ensuring a seamless and
                        enjoyable shopping experience.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <h2 class="about-heading animate__animated animate__fadeIn">Our Mission</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="mission-card animate__animated animate__fadeIn" data-wow-delay="0.2s">
                        <i class="bi bi-truck mission-icon"></i>
                        <h3 class="mission-title">Fast Delivery</h3>
                        <p class="about-text">
                            We ensure your orders reach you quickly and reliably across Sri Lanka.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="mission-card animate__animated animate__fadeIn" data-wow-delay="0.4s">
                        <i class="bi bi-shield-check mission-icon"></i>
                        <h3 class="mission-title">Secure Shopping</h3>
                        <p class="about-text">
                            Shop with confidence knowing your payments and data are protected.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="mission-card animate__animated animate__fadeIn" data-wow-delay="0.6s">
                        <i class="bi bi-heart mission-icon"></i>
                        <h3 class="mission-title">Customer First</h3>
                        <p class="about-text">
                            Our dedicated support team is here to make your experience exceptional.
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
    </script>
</body>
</html>
```