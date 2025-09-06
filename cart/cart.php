<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShopNest - Shopping Cart</title>
    <base href="/WEB-PROJECT-EC/">
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
    include '../db.php';
    
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Fetch product images from DB for all cart items (efficient single query)
    $product_images = [];
    if (!empty($_SESSION['cart'])) {
        $ids = array_column($_SESSION['cart'], 'id');
        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $sql_images = "SELECT id, image FROM products WHERE id IN ($placeholders)";
            $stmt_images = $conn->prepare($sql_images);
            $stmt_images->bind_param(str_repeat('i', count($ids)), ...$ids);
            $stmt_images->execute();
            $result_images = $stmt_images->get_result();
            while ($row_img = $result_images->fetch_assoc()) {
                $product_images[$row_img['id']] = $row_img['image'];
            }
            $stmt_images->close();
        }
    }
    ?>

    <?php include("../navbar.php"); ?>

    <!-- Cart Page Wrapper - Scopes all cart styles -->
    <div class="cart-page">
        <!-- Cart Header -->
        <div class="cart-header">
            <div class="container">
                <div class="text-center">
                    <h1 class="cart-title">
                        <i class="bi bi-cart3 me-3"></i>
                        Your Shopping Cart
                    </h1>
                    <p class="cart-subtitle">Review your items and proceed to checkout</p>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <!-- Alert Messages -->
            <div class="alert-container">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div class="alert custom-alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Login Required:</strong> You must <a href="login.php" class="alert-link">log in</a> to proceed to checkout.
                    </div>
                <?php elseif (empty($_SESSION['cart'])): ?>
                    <div class="alert custom-alert alert-warning" role="alert">
                        <i class="bi bi-cart-x-fill me-2"></i>
                        <strong>Empty Cart:</strong> Your cart is empty. Add items before checking out.
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Cart Items Section -->
                    <div class="cart-section">
                        <?php
                        $total = 0;
                        if (!empty($_SESSION['cart'])):
                        ?>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr>
                                            <th><i class="bi bi-image me-2"></i>Image</th>
                                            <th><i class="bi bi-box me-2"></i>Product</th>
                                            <th><i class="bi bi-123 me-2"></i>Quantity</th>
                                            <th><i class="bi bi-currency-dollar me-2"></i>Price</th>
                                            <th><i class="bi bi-trash me-2"></i>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION['cart'] as $index => $item) {
                                            // Validate item data
                                            if (!isset($item['name']) || !isset($item['price']) || !isset($item['quantity'])) {
                                                continue;
                                            }
                                            
                                            $subtotal = floatval($item['price']) * intval($item['quantity']);
                                            $total += $subtotal;
                                            
                                            // Use fetched image
                                            $image_name = isset($product_images[$item['id']]) ? $product_images[$item['id']] : '';
                                            $image_src = 'images/placeholder.jpg'; // Fallback
                                            if (!empty($image_name)) {
                                                $image_src = 'images/products/' . $image_name;
                                            }
                                            
                                            echo "<tr class='cart-item-row'>
                                                <td>
                                                    <img src='" . htmlspecialchars($image_src) . "' 
                                                         class='product-image' 
                                                         alt='" . htmlspecialchars($item['name']) . "'
                                                         loading='lazy'>
                                                </td>
                                                <td>
                                                    <div class='product-name'>" . htmlspecialchars($item['name']) . "</div>
                                                </td>
                                                <td>
                                                    <span class='product-quantity'>" . intval($item['quantity']) . "</span>
                                                </td>
                                                <td>
                                                    <span class='product-price'>$" . number_format($subtotal, 2) . "</span>
                                                </td>
                                                <td>
                                                    <a href='cart/remove_from_cart.php?index=" . intval($index) . "' class='btn-remove' data-confirm='true'>
                                                        <i class='bi bi-trash'></i>
                                                        Remove
                                                    </a>
                                                </td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-cart">
                                <div class="empty-cart-icon">
                                    <i class="bi bi-cart-x"></i>
                                </div>
                                <h3>Your Cart is Empty</h3>
                                <p>Looks like you haven't added any items to your cart yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="continue-shopping">
                        <a href="../products.php" class="btn-continue">
                            <i class="bi bi-arrow-left"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Cart Summary -->
                    <div class="cart-summary">
                        <h3 class="summary-title">
                            <i class="bi bi-receipt me-2"></i>
                            Order Summary
                        </h3>
                        
                        <div class="summary-row">
                            <span class="summary-label">Subtotal:</span>
                            <span class="summary-value">$<?php echo number_format($total, 2); ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">
                                Shipping:
                                <span class="shipping-badge">Fast</span>
                            </span>
                            <span class="summary-value">$5.00</span>
                        </div>
                        
                        <div class="summary-row summary-total">
                            <span class="summary-label">Total:</span>
                            <span class="summary-value">$<?php echo number_format($total + 5, 2); ?></span>
                        </div>

                        <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['cart'])): ?>
                            <a href="cart/checkout.php" class="btn-checkout">
                                <i class="bi bi-credit-card me-2"></i>
                                Proceed to Checkout
                            </a>
                        <?php else: ?>
                            <button class="btn-checkout disabled" disabled>
                                <i class="bi bi-lock me-2"></i>
                                Proceed to Checkout
                            </button>
                        <?php endif; ?>

                        <!-- Security Badges -->
                        <div class="security-badges">
                            <div class="security-badge">
                                <i class="bi bi-shield-check"></i>
                                Secure
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-truck"></i>
                                Fast Shipping
                            </div>
                            <div class="security-badge">
                                <i class="bi bi-arrow-clockwise"></i>
                                Easy Returns
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
                    You may have not copy, reuse, or distribute any part of this site without permission.
                </p>
            </div>
        </footer>
    </div>
    <!-- End Cart Page Wrapper -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
    
    <script>
        // Prevent multiple script executions
        if (!window.cartInitialized) {
            window.cartInitialized = true;
            
            // Add smooth scroll behavior
            document.documentElement.style.scrollBehavior = 'smooth';
            
            // Simplified loading animation - no conflicts
            document.addEventListener('DOMContentLoaded', function() {
                // Remove any existing animations first
                const style = document.createElement('style');
                style.textContent = `
                    .cart-page * {
                        animation: none !important;
                        transition: none !important;
                    }
                `;
                document.head.appendChild(style);
                
                // Re-enable animations after a brief moment
                setTimeout(() => {
                    document.head.removeChild(style);
                }, 100);
            });

            // Confirm removal with event delegation
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-remove[data-confirm="true"]')) {
                    if (!confirm('Are you sure you want to remove this item from your cart?')) {
                        e.preventDefault();
                        return false;
                    }
                }
            });
            
            // Image loading error handling
            document.addEventListener('error', function(e) {
                if (e.target.tagName === 'IMG' && e.target.classList.contains('product-image')) {
                    e.target.src = 'images/placeholder.jpg';
                }
            }, true);
        }
    </script>
</body>
</html>