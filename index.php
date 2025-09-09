
<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ShopNest</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="items/assets/styles.css" rel="stylesheet">
  <link href="css/modern-styles.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="images/logo.ico" />

  <style>
    /* General Enhancements */
    body {
      background-color: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    h2, h3, h4, h5 {
      font-weight: 600;
    }

    /* Carousel caption styling */
    .carousel-caption h5 {
      font-size: 1.8rem;
      font-weight: bold;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .carousel-caption p {
      font-size: 1.1rem;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    /* Features section */
    .feature-box {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .feature-box:hover {
      transform: translateY(-5px);
    }

    /* Category section */
    .category-item img {
      border: 5px solid #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-item img:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    /* Product cards */
    .card {
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .card-body h5 {
      font-weight: 600;
      color: #333;
    }

    .btn-outline-secondary {
      border-radius: 25px;
      font-weight: 500;
    }

    /* Footer */
    footer {
      background: linear-gradient(to right, #212529, #343a40);
    }
  </style>
</head>
<body>
 <?php
  session_start();
  include("navbar.php");
  ?>
  <!-- Carousel -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-12">
        <div id="carouselExampleControls" class="carousel slide shadow-sm rounded" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleControls" data-slide-to="1"></li>
            <li data-target="#carouselExampleControls" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100 rounded" src="images/recommended/Flux_Dev_Modern_smart_gadgets_like_wireless_earbuds_smartwatch_3.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <h5>Smart Gadgets for Smart Living</h5>
                <p>Upgrade your life with tech that fits your lifestyle.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100 rounded" src="images/recommended/Flux_Dev_A_luxurious_collection_of_mens_and_womens_wristwatche_3.jpg" alt="Second slide">
              <div class="carousel-caption d-none d-md-block">
                <h5>Timeless Watches for Every Style</h5>
                <p>Discover elegant timepieces that elevate your everyday look.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100 rounded" src="images/recommended/Flux_Dev_A_stylish_flat_lay_of_fashion_accessories_including_s_2.jpg" alt="Third slide">
              <div class="carousel-caption d-none d-md-block">
                <h5>Accessories That Speak for You</h5>
                <p>From bold to classy – find the perfect touch for every outfit.</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Features -->
  <div class="container mt-5">
    <div class="row text-center">
      <div class="col-md-4 mb-3">
        <div class="feature-box">
          <img class="rounded-circle mb-2" src="images/icon (2).jpg" alt="Free Shipping" width="60">
          <h4>Free Shipping</h4>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="feature-box">
          <img class="rounded-circle mb-2" src="images/icon (1).jpg" alt="Free Returns" width="60">
          <h4>Free Returns</h4>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="feature-box">
          <img class="rounded-circle mb-2" src="images/icon (3).jpg" alt="Low Prices" width="60">
          <h4>Low Prices</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Categories -->
  <div class="container mt-5">
    <div class="text-center mb-4">
      <h2 class="text-dark">Browse Categories</h2>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4 text-center category-item">
        <a href="category/Watches.php"><img class="rounded-circle mb-3" src="images/category/gig3 (2).jpg" width="140" height="140"></a>
        <h5>Watches</h5>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 text-center category-item">
        <a href="category/DigitalCameras.php"><img class="rounded-circle mb-3" src="images/category/cat (8).jpg" width="140" height="140"></a>
        <h5>Digital Cameras</h5>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 text-center category-item">
        <a href="category/ToysAndGames.php"><img class="rounded-circle mb-3" src="images/category/cat (6).jpg" width="140" height="140"></a>
        <h5>Toys & Games</h5>
      </div>
      <!-- Continue the same for other categories -->
    </div>
  </div>

  <!-- Recommended Products -->
  <div class="container mt-5">
    <h2 class="text-center">Recommended Products</h2>
    <hr>
    <?php
    include 'db.php';
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
    $result = $conn->query($sql);
    $count = 0;
    echo '<div class="row">';
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($count > 0 && $count % 3 == 0) {
          echo '</div><div class="row mt-4">';
        }
        echo '
        <div class="col-md-4 mb-4">
          <div class="card h-100" onclick="window.location.href=\'product_detail.php?id=' . $row['id'] . '\';">
            <img class="card-img-top" src="images/products/' . $row['image'] . '" alt="' . $row['name'] . '">
            <div class="card-body">
              <h5 class="card-title">' . $row['name'] . '</h5>
              <p class="card-text">' . substr($row['description'], 0, 80) . '...</p>
              <button class="btn btn-outline-secondary">$' . $row['price'] . '</button>
            </div>
          </div>
        </div>';
        $count++;
      }
    } else {
      echo '<p class="text-center">No recommended products available.</p>';
    }
    echo '</div>';
    $conn->close();
    ?>
  </div>

  <!-- Footer -->
  <footer class="py-4 mt-5">
    <div class="container text-center">
      <p class="m-0 text-white">© 2025 ShopNest. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.3.1.js"></script>
</body>