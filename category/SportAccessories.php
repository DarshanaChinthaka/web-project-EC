<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ShopNest - Sport Accessories</title>
  <!-- Bootstrap -->
  <link href="../css/bootstrap-4.3.1.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="../items/assets/styles.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico" />

  <style>
    /* General Enhancements */
    body {
      background-color: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    h2, h3, h4, h5 {
      font-weight: 600;
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
  include("../navbar.php");
  ?>

  <!-- Category Banner -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-12"><img src="../images/category/b1 (4).jpg" alt="Sport Accessories Banner" width="1920" height="640" class="img-fluid"/></div>
    </div>
    <hr>
  </div>

  <!-- Category Title -->
  <h2 class="text-center">Sport Accessories</h2>
  <hr>

  <!-- Products Section -->
  <div class="container">
    <div class="row text-center">
      <?php
      include '../db.php';
      $sql = "SELECT * FROM products WHERE category = 'Sport Accessories' ORDER BY id DESC";
      $result = $conn->query($sql);
      $count = 0;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          if ($count > 0 && $count % 3 == 0) {
            echo '</div><div class="row text-center mt-4">';
          }
          echo '
          <div class="col-md-4 pb-1 pb-md-0 mb-5">
            <div class="card h-100" onclick="window.location.href=\'../product_detail.php?id=' . $row['id'] . '\';">
              <img class="card-img-top img-fluid" src="../images/products/' . $row['image'] . '" alt="' . $row['name'] . '">
              <div class="card-body p-4">
                <h5 class="card-title">' . $row['name'] . '</h5>
                <p class="card-text">' . substr($row['description'], 0, 80) . '...</p>
                <button class="btn btn-outline-secondary">$' . $row['price'] . '</button>
              </div>
            </div>
          </div>';
          $count++;
        }
      } else {
        echo '<p class="text-center">No sport accessories available.</p>';
      }
      $conn->close();
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-4 mt-5">
    <div class="container text-center">
      <p class="m-0 text-white">© 2025 ShopNest. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap-4.3.1.js"></script>

  <!-- Fix for navbar links and logo path in subdirectory -->
  <script>
    $(document).ready(function() {
      // Adjust logo image path if it's broken
      var logoImg = $('.navbar-brand img');
      if (logoImg.length && logoImg.attr('src') && !logoImg.attr('src').startsWith('http')) {
        logoImg.attr('src', '../' + logoImg.attr('src').replace('../', ''));
      }

      // Adjust relative links
      $('a').each(function() {
        var href = $(this).attr('href');
        if (href && !href.startsWith('http') && !href.startsWith('#') && !href.startsWith('../') && !href.startsWith('/') && href !== '') {
          $(this).attr('href', '../' + href);
        }
      });
    });
  </script>
</body>
</html>