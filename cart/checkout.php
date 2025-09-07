<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShopNest - Checkout</title>
    <base href="../">
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="items/assets/styles.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="cart/css/cart-styles.css" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?redirect=cart/checkout.php");
        exit;
    }
    include '../db.php';
    
    // Initialize cart if not exists and validate
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (empty($_SESSION['cart'])) {
        header("Location: cart/cart.php?error=empty_cart");
        exit;
    }
    
    $total = 0;
    $valid_items = array();
    
    // Validate cart items and calculate total
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['name']) && isset($item['price']) && isset($item['quantity'])) {
            $valid_items[] = $item;
            $total += floatval($item['price']) * intval($item['quantity']);
        }
    }
    
    // Update cart with only valid items
    $_SESSION['cart'] = $valid_items;
    
    if (empty($valid_items)) {
        header("Location: cart/cart.php?error=invalid_items");
        exit;
    }
    ?>

    <?php include("../navbar.php"); ?>

    <!-- Checkout Page Wrapper - Uses same styling scope as cart -->
    <div class="cart-page checkout-page">
        <!-- Checkout Header -->
        <div class="cart-header">
            <div class="container">
                <div class="text-center">
                    <h1 class="cart-title">
                        <i class="bi bi-credit-card me-3"></i>
                        Secure Checkout
                    </h1>
                    <p class="cart-subtitle">Complete your order with confidence</p>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <!-- Progress Indicator -->
            <div class="checkout-progress fade-in">
                <div class="progress-container">
                    <div class="progress-step completed">
                        <div class="step-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <span class="step-label">Cart</span>
                    </div>
                    <div class="progress-line completed"></div>
                    <div class="progress-step active">
                        <div class="step-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <span class="step-label">Checkout</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <span class="step-label">Complete</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Checkout Form -->
                    <div class="cart-section checkout-form-section fade-in">
                        <form method="post" action="cart/process_checkout.php" id="checkoutForm">
                            <!-- Shipping Information -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="bi bi-truck me-2"></i>
                                    Shipping Information
                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-person me-2"></i>Full Name
                                            </label>
                                            <input type="text" name="full_name" class="form-control-enhanced" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-envelope me-2"></i>Email Address
                                            </label>
                                            <input type="email" name="email" class="form-control-enhanced" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group-enhanced">
                                    <label class="form-label">
                                        <i class="bi bi-geo-alt me-2"></i>Street Address
                                    </label>
                                    <input type="text" name="address" class="form-control-enhanced" required>
                                    <div class="form-feedback"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-building me-2"></i>City
                                            </label>
                                            <input type="text" name="city" class="form-control-enhanced" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-map me-2"></i>State
                                            </label>
                                            <input type="text" name="state" class="form-control-enhanced" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-mailbox me-2"></i>ZIP Code
                                            </label>
                                            <input type="text" name="zip" class="form-control-enhanced" pattern="[0-9]{5}(-[0-9]{4})?" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="bi bi-shield-check me-2"></i>
                                    Payment Information
                                </h3>
                                
                                <div class="payment-security-notice">
                                    <i class="bi bi-shield-lock-fill me-2"></i>
                                    Your payment information is encrypted and secure
                                </div>
                                
                                <div class="form-group-enhanced">
                                    <label class="form-label">
                                        <i class="bi bi-credit-card me-2"></i>Card Number
                                    </label>
                                    <input type="text" name="card_number" class="form-control-enhanced" 
                                           placeholder="1234 5678 9012 3456" 
                                           pattern="[0-9\s]{13,19}" maxlength="19" required>
                                    <div class="form-feedback"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-calendar me-2"></i>Expiry Date
                                            </label>
                                            <input type="text" name="expiry" class="form-control-enhanced" 
                                                   placeholder="MM/YYYY" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" 
                                                   maxlength="7" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-enhanced">
                                            <label class="form-label">
                                                <i class="bi bi-lock me-2"></i>CVV
                                            </label>
                                            <input type="password" name="cvv" class="form-control-enhanced" 
                                                   placeholder="123" pattern="[0-9]{3,4}" maxlength="4" required>
                                            <div class="form-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-actions">
                                <button type="submit" class="btn-checkout btn-confirm-order" id="confirmOrderBtn">
                                    <i class="bi bi-shield-check me-2"></i>
                                    <span class="btn-text">Confirm Secure Order</span>
                                    <div class="btn-loader" style="display: none;">
                                        <i class="bi bi-arrow-repeat spin"></i>
                                        Processing...
                                    </div>
                                </button>
                                
                                <a href="cart/cart.php" class="btn-continue btn-back-to-cart">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Back to Cart
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Order Summary -->
                    <div class="cart-summary order-summary fade-in">
                        <h3 class="summary-title">
                            <i class="bi bi-receipt me-2"></i>
                            Order Summary
                        </h3>
                        
                        <!-- Order Items -->
                        <div class="order-items">
                            <?php foreach ($valid_items as $item): 
                                $subtotal = floatval($item['price']) * intval($item['quantity']);
                                
                                // Safe image handling
                                $image_src = 'images/placeholder.jpg';
                                if (isset($item['image']) && !empty($item['image'])) {
                                    $image_path = 'images/products/' . $item['image'];
                                    if (file_exists($image_path)) {
                                        $image_src = $image_path;
                                    }
                                }
                            ?>
                                <div class="order-item">
                                    <img src="<?php echo htmlspecialchars($image_src); ?>" 
                                         class="item-image" 
                                         alt="<?php echo htmlspecialchars($item['name']); ?>"
                                         loading="lazy">
                                    <div class="item-details">
                                        <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                        <div class="item-quantity">Qty: <?php echo intval($item['quantity']); ?></div>
                                    </div>
                                    <div class="item-price">$<?php echo number_format($subtotal, 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- Summary Totals -->
                        <div class="summary-row">
                            <span class="summary-label">Subtotal:</span>
                            <span class="summary-value">$<?php echo number_format($total, 2); ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">
                                Shipping:
                                <span class="shipping-badge">Express</span>
                            </span>
                            <span class="summary-value">$5.00</span>
                        </div>
                        
                        <div class="summary-row summary-total">
                            <span class="summary-label">Total:</span>
                            <span class="summary-value">$<?php echo number_format($total + 5, 2); ?></span>
                        </div>

                        <!-- Security Features -->
                        <div class="security-badges">
                            <div class="security-badge">
                                <i class="bi bi-shield-check"></i>
                                SSL Secured
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-lock-fill"></i>
                                Encrypted
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-truck"></i>
                                Fast Delivery
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="custom-footer">
            <div class="container text-center">
                <p class="footer-text mb-2">© 2025 ShopNest. All rights reserved.</p>
                <p class="footer-copyright mb-0">
                    This website and its content are the property of ShopNest.<br>
                    You may not copy, reuse, or distribute any part of this site without permission.
                </p>
            </div>
        </footer>
    </div>
    <!-- End Checkout Page Wrapper -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
    
    <script>
        // Prevent multiple script executions
        if (!window.checkoutInitialized) {
            window.checkoutInitialized = true;
            
            // Add smooth scroll behavior
            document.documentElement.style.scrollBehavior = 'smooth';
            
            // Initialize page animations
            document.addEventListener('DOMContentLoaded', function() {
                // Mark page as loaded for CSS animations
                setTimeout(() => {
                    document.querySelector('.checkout-page').classList.add('loaded');
                }, 100);
                
                // Fade in elements
                const fadeElements = document.querySelectorAll('.fade-in');
                fadeElements.forEach((el, index) => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        el.style.transition = 'all 0.6s ease';
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, index * 200);
                });
            });

            // Form Enhancement and Validation
            const form = document.getElementById('checkoutForm');
            const confirmBtn = document.getElementById('confirmOrderBtn');
            
            // Real-time form validation
            const inputs = form.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', validateField);
                input.addEventListener('input', clearFieldError);
            });
            
            function validateField(e) {
                const field = e.target;
                const feedback = field.parentNode.querySelector('.form-feedback');
                
                if (!field.validity.valid) {
                    field.classList.add('error');
                    feedback.textContent = getErrorMessage(field);
                    feedback.classList.add('error');
                } else {
                    field.classList.remove('error');
                    field.classList.add('success');
                    feedback.textContent = '';
                    feedback.classList.remove('error');
                }
            }
            
            function clearFieldError(e) {
                const field = e.target;
                if (field.classList.contains('error')) {
                    field.classList.remove('error');
                    const feedback = field.parentNode.querySelector('.form-feedback');
                    feedback.textContent = '';
                    feedback.classList.remove('error');
                }
            }
            
            function getErrorMessage(field) {
                if (field.validity.valueMissing) {
                    return 'This field is required';
                }
                if (field.validity.typeMismatch) {
                    return 'Please enter a valid ' + field.type;
                }
                if (field.validity.patternMismatch) {
                    switch(field.name) {
                        case 'card_number': return 'Please enter a valid card number';
                        case 'expiry': return 'Please enter MM/YYYY format';
                        case 'cvv': return 'Please enter a valid CVV';
                        case 'zip': return 'Please enter a valid ZIP code';
                        default: return 'Please enter a valid value';
                    }
                }
                return 'Please check this field';
            }
            
            // Card number formatting
            const cardInput = document.querySelector('input[name="card_number"]');
            if (cardInput) {
                cardInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                    e.target.value = value;
                });
            }
            
            // Expiry date formatting
            const expiryInput = document.querySelector('input[name="expiry"]');
            if (expiryInput) {
                expiryInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length >= 2) {
                        value = value.substring(0,2) + '/' + value.substring(2,6);
                    }
                    e.target.value = value;
                });
            }
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate all fields
                let isValid = true;
                inputs.forEach(input => {
                    if (!input.validity.valid) {
                        isValid = false;
                        validateField({target: input});
                    }
                });
                
                if (!isValid) {
                    // Scroll to first error
                    const firstError = form.querySelector('.error');
                    if (firstError) {
                        firstError.scrollIntoView({behavior: 'smooth', block: 'center'});
                        firstError.focus();
                    }
                    return;
                }
                
                // Show loading state
                confirmBtn.classList.add('loading');
                confirmBtn.querySelector('.btn-text').style.display = 'none';
                confirmBtn.querySelector('.btn-loader').style.display = 'inline-flex';
                confirmBtn.disabled = true;
                
                // Submit form after brief delay for UX
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
            
            // Image loading error handling
            document.addEventListener('error', function(e) {
                if (e.target.tagName === 'IMG' && e.target.classList.contains('item-image')) {
                    e.target.src = 'images/placeholder.jpg';
                }
            }, true);
        }
    </script>
    
    <style>
        /* Additional checkout-specific styles */
        .checkout-page .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        
        .checkout-progress {
            margin-bottom: 40px;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
        }
        
        .progress-container {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            z-index: 2;
        }
        
        .step-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-gray);
            color: var(--text-secondary);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .progress-step.completed .step-icon {
            background: var(--success-color);
            color: white;
        }
        
        .progress-step.active .step-icon {
            background: var(--primary-color);
            color: white;
        }
        
        .step-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
        }
        
        .progress-step.completed .step-label,
        .progress-step.active .step-label {
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .progress-line {
            height: 2px;
            width: 100px;
            background: var(--border-color);
            margin: 0 20px;
        }
        
        .progress-line.completed {
            background: var(--success-color);
        }
        
        .checkout-form-section {
            margin-bottom: 30px;
        }
        
        .form-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
        }
        
        .form-group-enhanced {
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control-enhanced {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control-enhanced:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .form-control-enhanced.success {
            border-color: var(--success-color);
        }
        
        .form-control-enhanced.error {
            border-color: var(--danger-color);
            background: rgba(220, 38, 38, 0.05);
        }
        
        .form-feedback {
            margin-top: 8px;
            font-size: 0.85rem;
            min-height: 20px;
        }
        
        .form-feedback.error {
            color: var(--danger-color);
        }
        
        .payment-security-notice {
            background: rgba(5, 150, 105, 0.1);
            border: 2px solid rgba(5, 150, 105, 0.2);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            color: var(--success-color);
            font-weight: 500;
            text-align: center;
        }
        
        .form-actions {
            text-align: center;
            margin-top: 40px;
        }
        
        .btn-confirm-order {
            margin-bottom: 15px;
            position: relative;
        }
        
        .btn-confirm-order.loading {
            background: var(--text-secondary) !important;
            cursor: not-allowed;
        }
        
        .btn-loader {
            align-items: center;
            gap: 10px;
        }
        
        .btn-back-to-cart {
            background: var(--light-gray);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
        }
        
        .order-summary {
            position: sticky;
            top: 20px;
        }
        
        .order-items {
            margin-bottom: 25px;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }
        
        .item-quantity {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }
        
        .item-price {
            font-weight: 600;
            color: var(--success-color);
        }
        
        .spin {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .progress-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .progress-line {
                width: 2px;
                height: 30px;
                margin: 0;
            }
            
            .order-items {
                max-height: 200px;
            }
            
            .item-image {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</body>
</html>