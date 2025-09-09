<?php
// orders.php
session_start();
/*
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../login.html");
    exit;
}
*/

include realpath(__DIR__ . '/../db.php');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Orders - ShopNest Admin</title>
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
            padding: 2rem;
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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
            gap: 1rem;
        }

        @keyframes slideInDown {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .search-container {
            display: flex;
            align-items: center;
            max-width: 400px;
            width: 100%;
        }

        .search-container input {
            border-radius: 10px 0 0 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            flex: 1;
        }

        .search-container button {
            border-radius: 0 10px 10px 0;
            padding: 12px;
            background: var(--primary-gradient);
            border: none;
            color: white;
        }

        .table-responsive {
            max-height: 500px;
            overflow: auto;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            background: white;
        }

        .table th, .table td {
            vertical-align: middle;
            padding: 15px;
            text-align: center;
        }

        .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            border: none;
            position: relative;
            overflow: hidden;
            margin: 0 5px;
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

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                max-width: 100%;
            }
        }

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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutters">
            <!-- Sidebar -->
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
                        <a class="nav-link d-flex align-items-center" href="product.php">
                            <i class="bi-box-seam mr-2"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="#">
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

            <main class="col-md-10 main-content">
                <div class="header-section">
                    <div>
                        <h3 class="m-0" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Orders</h3>
                        <p class="text-muted mb-0">Manage your store's orders.</p>
                    </div>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by any field">
                        <button class="btn"><i class="bi-search"></i></button>
                    </div>
                </div>

                <div class="table-responsive" id="ordersContainer">
                    <?php include "orders_table.php"; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Edit Order Modal (Status Only) -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editOrderForm">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi-pencil-square mr-2"></i>Change Order Status</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select name="status" id="edit_status" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Packed">Packed</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <small class="text-muted">Order date will update automatically.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap-4.3.1.js"></script>
    <script>
        $(document).ready(function () {
            // Dynamic search with AJAX
            $("#searchInput").on("keyup", function () {
                var searchTerm = $(this).val();
                $.ajax({
                    url: "orders_table.php",
                    type: "GET",
                    data: { search: searchTerm },
                    success: function (data) {
                        $("#ordersContainer").html(data);
                    },
                    error: function () {
                        $("#ordersContainer").html("<p>Error loading orders.</p>");
                    }
                });
            });

            // Pass order data into modal
            $(document).on("click", ".edit-order", function () {
                $("#edit_id").val($(this).data("id"));
                $("#edit_status").val($(this).data("status"));
            });

            // AJAX form submit for updating order
            $("#editOrderForm").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "update_order.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response === "success") {
                            $("#editOrderModal").modal("hide");
                            loadOrders();
                        } else {
                            alert("Error updating order: " + response);
                        }
                    },
                    error: function () {
                        alert("Error updating order.");
                    }
                });
            });

            // Reload table dynamically
            function loadOrders() {
                $.get("orders_table.php", function (data) {
                    $("#ordersContainer").html(data);
                });
            }

            // Remove focus from buttons after click
            $('.btn').on('click', function() {
                $(this).blur();
            });
        });
    </script>
</body>
</html>