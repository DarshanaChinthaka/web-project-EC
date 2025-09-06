<?php
session_start(); // Start session here to avoid multiple calls
include 'db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Product not found.");
}
$stmt->close();

// Handle Add to Cart
if (isset($_POST['add_to_cart'])) {
    $quantity = 1; // Default quantity, can be expanded with a form input
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $item = ['id' => $id, 'name' => $row['name'], 'price' => $row['price'], 'quantity' => $quantity];
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id) {
            $cart_item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
    header("Location: cart/cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShopNest - <?php echo htmlspecialchars($row['name']); ?></title>
    <base href=".">
    <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    
    <link rel="icon" type="image/x-icon" href="images/logo.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --light-gray: #f8fafc;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-primary);
            background-color: #ffffff;
            line-height: 1.6;
        }

        /* Product Detail Styles */
        .product-detail-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            background: #ffffff;
            padding: 20px;
            margin-bottom: 30px;
        }

        .product-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.02);
        }

        .product-info {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-badge {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .product-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .add-to-cart-form {
            background: var(--light-gray);
            padding: 25px;
            border-radius: 15px;
            border: 2px dashed var(--border-color);
            text-align: center;
        }

        .btn-add-to-cart {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-md);
        }

        .btn-add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, var(--primary-hover), #1e40af);
            color: white;
        }

        .btn-add-to-cart:active {
            transform: translateY(0);
        }

        /* Related Products Section */
        .related-products-section {
            padding: 60px 0;
            background: #ffffff;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
            border-radius: 2px;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .product-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-card .card-body {
            padding: 25px;
        }

        .product-card .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .product-card .card-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .btn-view-product {
            background: var(--light-gray);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-product:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* Breadcrumb */
        .custom-breadcrumb {
            background: rgba(248, 250, 252, 0.8);
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
            font-weight: 500;
        }

        /* Footer Enhancement */
        .custom-footer {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: #ffffff;
            padding: 40px 0;
            margin-top: 60px;
        }

        .footer-text {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .product-detail-section {
                padding: 30px 0;
            }
            
            .product-info {
                padding: 25px;
                margin-top: 20px;
            }
            
            .product-title {
                font-size: 2rem;
            }
            
            .product-price {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }

        /* Animation for page load */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <?php include("navbar.php"); ?>

    <!-- Breadcrumb -->
    <div class="custom-breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($row['name']); ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Product Details Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="row fade-in">
                <div class="col-lg-6">
                    <div class="product-image-container">
                        <img src="images/products/<?php echo htmlspecialchars($row['image']); ?>" 
                             class="product-image" 
                             alt="<?php echo htmlspecialchars($row['name']); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-info">
                        <h1 class="product-title"><?php echo htmlspecialchars($row['name']); ?></h1>
                        
                        <div class="product-price">
                            $<?php echo number_format($row['price'], 2); ?>
                            <span class="price-badge">Best Price</span>
                        </div>
                        
                        <div class="product-description">
                            <?php echo htmlspecialchars($row['description']); ?>
                        </div>
                        
                        <div class="add-to-cart-form">
                            <form method="post" action="">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-add-to-cart">
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Add to Cart
                                </button>
                            </form>
                            <small class="text-muted mt-2 d-block">
                                <i class="bi bi-shield-check me-1"></i>
                                Secure checkout guaranteed
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="related-products-section">
        <div class="container">
            <h2 class="section-title">Related Products</h2>
            
            <div class="row">
                <?php
                include 'db.php';
                $category = $row['category'];
                $sql_related = "SELECT * FROM products WHERE category = ? AND id != ? LIMIT 4";
                $stmt_related = $conn->prepare($sql_related);
                $stmt_related->bind_param("si", $category, $id);
                $stmt_related->execute();
                $result_related = $stmt_related->get_result();
                
                if ($result_related->num_rows > 0) {
                    while ($rel_row = $result_related->fetch_assoc()) {
                        echo '
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="product-card">
                                <img src="images/products/' . htmlspecialchars($rel_row['image']) . '" 
                                     class="card-img-top" 
                                     alt="' . htmlspecialchars($rel_row['name']) . '">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($rel_row['name']) . '</h5>
                                    <p class="card-price">$' . number_format($rel_row['price'], 2) . '</p>
                                    <a href="product_detail.php?id=' . $rel_row['id'] . '" 
                                       class="btn-view-product">
                                        <i class="bi bi-eye me-1"></i>
                                        View Product
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '
                    <div class="col-12 text-center">
                        <div class="alert alert-info" style="background: var(--light-gray); border: 1px solid var(--border-color); border-radius: 15px;">
                            <i class="bi bi-info-circle me-2"></i>
                            No related products found in this category.
                        </div>
                    </div>';
                }
                $stmt_related->close();
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="container text-center">
            <p class="footer-text mb-0">© 2025 ShopNest. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.3.1.js"></script>
    
    <script>
        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.8s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>