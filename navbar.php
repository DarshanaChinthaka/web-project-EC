<?php
// Calculate cart item count
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<style>
.custom-navbar {
  background: linear-gradient(135deg, #8B5CF6 0%, #10B981 100%);
  box-shadow: 0 4px 20px rgba(139, 92, 246, 0.3);
  border-bottom: 3px solid #10B981;
}

.navbar-brand {
  font-weight: 700;
  font-size: 1.8rem;
  color: white !important;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  color: #F3E8FF !important;
  transform: translateY(-2px);
}

.navbar-brand img {
  border-radius: 50%;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: transform 0.3s ease;
}

.navbar-brand:hover img {
  transform: rotate(5deg) scale(1.05);
}

.navbar-nav .nav-link {
  color: white !important;
  font-weight: 500;
  padding: 8px 16px !important;
  border-radius: 25px;
  margin: 0 4px;
  transition: all 0.3s ease;
  position: relative;
}

.navbar-nav .nav-link:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.navbar-nav .nav-link.active {
  background: rgba(16, 185, 129, 0.3);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.dropdown-menu {
  background: linear-gradient(135deg, #8B5CF6 0%, #10B981 100%);
  border: none;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
  padding: 10px 0;
}

.dropdown-item {
  color: white !important;
  padding: 10px 20px;
  transition: all 0.3s ease;
  border-radius: 10px;
  margin: 2px 10px;
}

.dropdown-item:hover {
  background: rgba(255, 255, 255, 0.2) !important;
  color: #F3E8FF !important;
  transform: translateX(5px);
}

.btn-outline-dark {
  background: rgba(255, 255, 255, 0.15);
  border: 2px solid white;
  color: white !important;
  font-weight: 600;
  border-radius: 25px;
  padding: 8px 20px;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.btn-outline-dark:hover {
  background: white;
  color: #8B5CF6 !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
}

.badge {
  background: #EF4444 !important;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

.btn-success {
  background: linear-gradient(45deg, #10B981, #059669) !important;
  border: none;
  border-radius: 25px;
  padding: 8px 20px;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
  transition: all 0.3s ease;
}

.btn-success:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
  background: linear-gradient(45deg, #059669, #047857) !important;
}

.btn-danger {
  background: linear-gradient(45deg, #EF4444, #DC2626) !important;
  border: none;
  border-radius: 25px;
  padding: 8px 20px;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
  transition: all 0.3s ease;
}

.btn-danger:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(239, 68, 68, 0.6);
  background: linear-gradient(45deg, #DC2626, #B91C1C) !important;
}

.btn-outline-primary {
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid rgba(255, 255, 255, 0.5);
  color: white !important;
  border-radius: 25px;
  padding: 8px 16px;
  font-weight: 600;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: white;
  transform: translateY(-1px);
}

.btn-warning {
  background: linear-gradient(45deg, #F59E0B, #D97706) !important;
  border: none;
  border-radius: 25px;
  padding: 8px 20px;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
  transition: all 0.3s ease;
  color: white !important;
}

.btn-warning:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
  background: linear-gradient(45deg, #D97706, #B45309) !important;
  color: white !important;
}

.navbar-toggler {
  border: 2px solid white;
  border-radius: 10px;
  padding: 8px;
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-toggler:focus {
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.5);
}

/* User section styling */
.user-section {
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-greeting {
  color: white !important;
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 25px;
  padding: 8px 16px;
  font-weight: 500;
  backdrop-filter: blur(10px);
  white-space: nowrap;
  font-size: 0.9rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.user-greeting:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.auth-buttons {
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Cart button styling */
.cart-section {
  margin-right: 15px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .custom-navbar {
    background: linear-gradient(135deg, #8B5CF6 0%, #10B981 100%);
  }
  
  .navbar-nav {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 15px;
    margin-top: 10px;
    backdrop-filter: blur(10px);
  }
  
  .user-section {
    flex-direction: column;
    align-items: stretch;
    gap: 10px;
    margin-top: 15px;
  }
  
  .auth-buttons {
    flex-direction: column;
    gap: 10px;
  }
  
  .cart-section {
    margin-right: 0;
    margin-bottom: 15px;
  }
  
  .user-greeting {
    text-align: center;
  }
}

@media (max-width: 576px) {
  .user-greeting {
    font-size: 0.8rem;
    padding: 6px 12px;
  }
  
  .btn {
    font-size: 0.9rem;
    padding: 6px 16px;
  }
}
</style>

<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
  <div class="container px-4 px-lg-5"> 
    <a class="navbar-brand" href="index.php"> 
      <img src="images/logo.png" width="50" height="50" alt="Logo" class="d-inline-block mr-2 img-fluid pt-0"> ShopNest 
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link active" href="contactUs.php">Contact Us</a></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="category/Watches.php">Watches</a></li>
            <li><a class="dropdown-item" href="category/DigitalCameras.php">Digital Cameras</a></li>
            <li><a class="dropdown-item" href="category/ToysAndGames.php">Toys & Games</a></li>
            <li><a class="dropdown-item" href="category/Jewelry.php">Jewellery</a></li>
            <li><a class="dropdown-item" href="category/HomeAccessories.php">Home Accessories</a></li>
            <li><a class="dropdown-item" href="category/SportAccessories.php">Sport Accessories</a></li>
            <li><a class="dropdown-item" href="category/CapAndHat.php">Cap & Hat</a></li>
            <li><a class="dropdown-item" href="category/ComputerAccessories.php">Computer Accessories</a></li>
            <li><a class="dropdown-item" href="category/Sunglass.php">Sunglass</a></li>
          </ul>
        </li>
      </ul>

      <!-- Cart Section -->
      <div class="cart-section">
        <a href="cart/cart.php" class="btn btn-outline-dark">
          <i class="bi-cart-fill me-1"></i>
          Cart
          <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $cart_count; ?></span>
        </a>
      </div>

      <!-- Authentication Section -->
      <div class="user-section">
        <?php if (!isset($_SESSION['user_id'])): ?>
          <div class="auth-buttons">
            <a href="signup.html" class="btn btn-success">SIGN IN</a>
            <a href="login.php" class="btn btn-danger">LOGIN</a>
          </div>
        <?php else: ?>
          <?php if ($_SESSION['role_id'] == 1): ?>
            <a href="Admin/admin.html" class="user-greeting">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
          <?php else: ?>
            <span class="user-greeting">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
          <?php endif; ?>
          <a href="logout.php" class="btn btn-warning">LOGOUT</a>
        <?php endif; ?>   
      </div>
    </div>
  </div>
</nav>