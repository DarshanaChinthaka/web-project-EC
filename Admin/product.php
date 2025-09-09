<?php
// Start session and check authentication at the very top
session_start();

// Include database connection
$dbPath = realpath(__DIR__ . '/../db.php');
if (file_exists($dbPath)) {
    include $dbPath;
} else {
    die("Database connection file (db.php) not found. Please ensure it exists in the project root.");
}

$conn = isset($conn) ? $conn : null;
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch all products for real-time filtering
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
$products = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products - ShopNest Admin</title>

    <!-- Bootstrap 4 CSS -->
    <link href="../css/bootstrap-4.3.1.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --sidebar-bg: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
            --hover-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Animated Background Particles */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="200" cy="200" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="800" cy="300" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="400" cy="600" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="100" cy="800" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="700" cy="100" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s infinite linear;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(360deg); }
        }

        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255,255,255,0.1);
            transform: translateX(0);
            animation: slideInLeft 0.3s ease-out;
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .sidebar a {
            color: #cfd8dc;
            border-radius: 8px;
            margin: 5px 0;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .sidebar a:hover::before {
            left: 100%;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
            text-decoration: none;
        }

        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .brand {
            font-weight: 700;
            color: #fff;
            text-align: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .main-content {
            animation: fadeInUp 0.4s ease-out;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px 0 0 20px;
            min-height: 100vh;
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .card-stats {
            border-radius: 16px;
            border: none;
            background: white;
            box-shadow: var(--card-shadow);
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }

        .table-responsive {
            max-height: 420px;
            overflow: auto;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            background: white;
        }

        .table th, .table td {
            vertical-align: middle;
            padding: 15px;
        }

        .table img {
            border-radius: 8px;
            object-fit: cover;
        }

        .header-section {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            animation: slideInDown 0.3s ease-out;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        @keyframes slideInDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .btn {
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: var(--warning-gradient);
            box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
        }

        .btn-danger {
            background: var(--secondary-gradient);
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.4);
        }

        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: scale(1.02);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.8);
        }

        /* Responsive animations */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
        }

        /* Hover effects for navigation */
        .nav-item {
            position: relative;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            width: 3px;
            height: 0;
            background: #fff;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: height 0.3s ease;
        }

        .nav-item:hover::after,
        .nav-item.active::after {
            height: 60%;
        }

        /* Search bar styling */
        .search-bar {
            display: flex;
            align-items: center;
            max-width: 300px;
            width: 100%;
        }

        .search-bar .form-control {
            border: none;
            border-radius: 25px 0 0 25px;
            padding-left: 40px;
            background: #f8f9fa;
            box-shadow: none;
        }

        .search-bar .input-group-append .btn {
            border-radius: 0 25px 25px 0;
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 10px 20px;
        }

        .search-bar .input-group-append .btn:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .search-bar .input-group {
            position: relative;
            width: 100%;
        }

        .search-bar .input-group > .bi-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutters">
            <nav class="col-md-2 sidebar p-3">
                <div class="mb-4 text-center">
                    <img src="../images/logo.png" alt="logo" width="60" class="img-fluid mb-2">
                    <div class="brand">ShopNest Admin</div>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin.html">
                            <i class="bi-speedometer2 mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="#">
                            <i class="bi-box-seam mr-2"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="orders.php">
                            <i class="bi-card-list mr-2"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="users.php">
                            <i class="bi-people mr-2"></i> Users
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="btn btn-danger btn-block" href="../index.php">
                            <i class="bi-shop mr-2"></i> Go to Store
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../logout.php">
                            <i class="bi-box-arrow-right mr-2"></i> Sign out
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-10 main-content p-4">
                <div class="header-section">
                    <div>
                        <h3 class="m-0" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Products</h3>
                        <p class="text-muted mb-0">Manage your store's product inventory.</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="search-bar">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search products..." autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn" type="button"><i class="bi-search"></i></button>
                                </div>
                                <i class="bi-search"></i>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#addProductModal">
                            <i class="bi-plus-circle mr-1"></i> Add Product
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="productsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price (LKR)</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($products)) {
                                $i = 1;
                                foreach ($products as $row) {
                                    echo "<tr>
                                        <td>$i</td>
                                        <td><img src='../images/products/{$row['image']}' width='50' alt='{$row['name']}'></td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['price']}</td>
                                        <td>{$row['stock']}</td>
                                        <td>{$row['category']}</td>
                                        <td>
                                            <a href='#' class='edit btn btn-sm btn-warning' data-toggle='modal' data-target='#editProductModal'
                                               data-id='{$row['id']}' data-name='{$row['name']}' data-category='{$row['category']}' 
                                               data-price='{$row['price']}' data-stock='{$row['stock']}' data-description='{$row['description']}'>Edit</a>
                                            <a href='delete_product.php?id={$row['id']}' class='btn btn-sm btn-danger ml-2' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </td>
                                    </tr>";
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='7'>No products found</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="add_product.php" enctype="multipart/form-data" id="addProductForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductLabel"><i class="bi-plus-circle mr-2"></i>Add New Product</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="prodName" class="font-weight-bold">Product Name</label>
                                <input name="name" type="text" class="form-control" id="prodName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prodCategory" class="font-weight-bold">Category</label>
                                <select name="category" id="prodCategory" class="form-control" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <option>Watches</option>
                                    <option>Digital Cameras</option>
                                    <option>Toys & Games</option>
                                    <option>Jewellery</option>
                                    <option>Home Accessories</option>
                                    <option>Sport Accessories</option>
                                    <option>Cap & Hat</option>
                                    <option>Computer Accessories</option>
                                    <option>Sunglass</option>
                                    <option>Audio</option>
                                    <option>Accessories</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="prodPrice" class="font-weight-bold">Price (LKR)</label>
                                <input name="price" type="number" step="0.01" class="form-control" id="prodPrice" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prodStock" class="font-weight-bold">Stock Quantity</label>
                                <input name="stock" type="number" class="form-control" id="prodStock" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prodImage" class="font-weight-bold">Image</label>
                                <input name="image" type="file" class="form-control-file" id="prodImage" style="padding: 12px; border: 2px solid #e9ecef; border-radius: 10px;" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prodDesc" class="font-weight-bold">Description</label>
                            <textarea name="description" id="prodDesc" rows="3" class="form-control" placeholder="Enter product description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi-x-circle mr-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi-check-circle mr-1"></i>Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" action="update_product.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title" id="editProductLabel"><i class="bi-pencil-square mr-2"></i>Edit Product</h3>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="edit_name" class="font-weight-bold">Product Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_category" class="font-weight-bold">Category</label>
                                <select name="category" id="edit_category" class="form-control" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <option>Watches</option>
                                    <option>Digital Cameras</option>
                                    <option>Toys & Games</option>
                                    <option>Jewellery</option>
                                    <option>Home Accessories</option>
                                    <option>Sport Accessories</option>
                                    <option>Cap & Hat</option>
                                    <option>Computer Accessories</option>
                                    <option>Sunglass</option>
                                    <option>Audio</option>
                                    <option>Accessories</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="edit_price" class="font-weight-bold">Price (LKR)</label>
                                <input type="number" name="price" id="edit_price" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_stock" class="font-weight-bold">Stock Quantity</label>
                                <input type="number" name="stock" id="edit_stock" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_image" class="font-weight-bold">Image (optional)</label>
                                <input type="file" name="image" class="form-control-file" id="edit_image" style="padding: 12px; border: 2px solid #e9ecef; border-radius: 10px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_description" class="font-weight-bold">Description</label>
                            <textarea name="description" id="edit_description" rows="3" class="form-control" placeholder="Enter product description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi-x-circle mr-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi-check-circle mr-1"></i>Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 JS -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.3.1.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn').on('click', function() {
                $(this).blur();
            });

            const editButtons = document.querySelectorAll('.edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('edit_id').value = this.dataset.id;
                    document.getElementById('edit_name').value = this.dataset.name;
                    document.getElementById('edit_category').value = this.dataset.category;
                    document.getElementById('edit_price').value = this.dataset.price;
                    document.getElementById('edit_stock').value = this.dataset.stock;
                    document.getElementById('edit_description').value = this.dataset.description;
                });
            });

            if (document.getElementById('addProductForm')) {
                document.getElementById('addProductForm').addEventListener('submit', function(e){
                    const form = this;
                    const inputs = form.querySelectorAll('input[required], select[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.style.borderColor = '#dc3545';
                            isValid = false;
                        } else {
                            input.style.borderColor = '#28a745';
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        alert('Please fill in all required fields.');
                    }
                });
            }

            // Real-time search functionality
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.querySelector('#productsTable tbody');
            const rows = tableBody.getElementsByTagName('tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    for (let i = 1; i < cells.length - 1; i++) { // Skip # and Actions columns
                        if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                            match = true;
                            break;
                        }
                    }

                    row.style.display = match ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>