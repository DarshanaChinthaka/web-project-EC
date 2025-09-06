<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to ShopNest</title>
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="items/assets/styles.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.ico" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        .bg-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            background: #28a745;
            border-radius: 50%;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            background: #6f42c1;
            border-radius: 20px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
            transform: rotate(45deg);
        }

        .shape-3 {
            width: 60px;
            height: 60px;
            background: #28a745;
            border-radius: 20px;
            top: 10%;
            right: 25%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(20px) rotate(240deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 100px;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            transform: translateY(20px);
            animation: slideUp 0.8s ease-out forwards;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #2d3436;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.2rem;
        }

        .brand-accent {
            background: linear-gradient(45deg, #28a745, #6f42c1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: #636e72;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            color: #2d3436;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #74b9ff;
            pointer-events: none;
        }

        .form-check {
            margin: 20px 0;
        }

        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .form-check-label {
            color: #636e72;
            margin-left: 8px;
        }

        .login-btn {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
            background: linear-gradient(45deg, #20c997, #28a745);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .signup-link a {
            color: #6f42c1;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #28a745;
            text-decoration: none;
        }

        /* Loading animation */
        .loading {
            display: none;
        }

        .login-btn.loading {
            pointer-events: none;
        }

        .login-btn.loading::after {
            content: '';
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            display: inline-block;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive design */
        @media (max-width: 576px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }
            
            .login-header h1 {
                font-size: 1.8rem;
            }
        }

        /* Error message styling */
        .error-message {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="bg-animation">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h1><span class="brand-accent">Shop</span>Nest</h1>
                <p class="login-subtitle">Welcome back! Please sign in to your account</p>
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
                <div class="error-message">
                    <i class="bi bi-exclamation-triangle"></i> Invalid email or password!
                </div>
            <?php endif; ?>

            <form method="post" action="process_login.php" id="loginForm">
                <div class="form-group">
                    <label for="email">
                        <i class="bi bi-envelope"></i> Email Address
                    </label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me for next time
                    </label>
                </div>

                <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'index.php'; ?>">
                
                <button type="submit" class="btn login-btn" id="loginBtn">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </button>
            </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="signup.html">Create one here</a></p>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>

    <script>
        // Form submission animation
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="bi bi-box-arrow-in-right"></i> Signing In...';
        });

        // Input focus animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Page load animation
        window.addEventListener('load', function() {
            document.querySelector('.login-container').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.login-container').style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>