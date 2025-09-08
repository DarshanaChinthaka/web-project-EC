<?php
// Include db.php from the root directory
$dbPath = realpath(__DIR__ . '/../db.php');
if (file_exists($dbPath)) {
    include $dbPath;
} else {
    die("Database connection file (db.php) not found. Please ensure it exists in the project root.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    if (!$conn) {
        die("Database connection failed.");
    }

    $target_dir = "../images/products/"; // Adjust path to root images folder
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $image_name = basename($_FILES["image"]["name"]);
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $new_image_name = uniqid() . '.' . $image_ext;
    $target_file = $target_dir . $new_image_name;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO products (name, category, price, stock, image, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiss", $name, $category, $price, $stock, $new_image_name, $description);
        if ($stmt->execute()) {
            header("Location: product.php");
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Image upload failed.";
    }
}
$conn->close();
?>