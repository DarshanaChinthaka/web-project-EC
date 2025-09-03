<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        <li class="nav-item"><a class="nav-link active" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link active" href="contactUs.html">Contact Us</a></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="category/1.html">Watches</a></li>
            <li><a class="dropdown-item" href="category/2.html">Digital Cameras</a></li>
            <li><a class="dropdown-item" href="category/3.html">Toys & Games</a></li>
            <li><a class="dropdown-item" href="category/4.html">Jewellery</a></li>
            <li><a class="dropdown-item" href="category/5.html">Home Accessories</a></li>
            <li><a class="dropdown-item" href="category/6.html">Sport Accessories</a></li>
            <li><a class="dropdown-item" href="category/7.html">Cap & Hat</a></li>
            <li><a class="dropdown-item" href="category/8.html">Computer Accessories</a></li>
            <li><a class="dropdown-item" href="category/9.html">Sunglass</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex mr-4">
        <a href="cart/cart.html" class="btn btn-outline-dark">
          <i class="bi-cart-fill me-1 mt-2 mb-2"></i>
          Cart
          <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
        </a>
      </form>

      <!-- PHP Session Check -->
      <?php if (!isset($_SESSION['user_id'])): ?>
        <form class="d-flex mr-1 mt-2 mb-2">
          <a href="signup.html" class="btn btn-success">SIGN IN</a>
        </form>
        <form class="d-flex mt-2 mb-2">
          <a href="login.html" class="btn btn-danger">LOGIN</a>
        </form>
      <?php else: ?>
        <form class="d-flex mr-1 mt-2 mb-2">
          <span class="btn btn-outline-primary disabled">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </form>
        <form class="d-flex mt-2 mb-2">
          <a href="logout.php" class="btn btn-warning">LOGOUT</a>
        </form>
      <?php endif; ?>   
    </div>
  </div>
</nav>
