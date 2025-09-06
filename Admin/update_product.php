<?php
// Include db.php from the root directory
$dbPath = realpath(__DIR__ . '/../db.php');
if (file_exists($dbPath)) {
    include $dbPath;
} else {
    die("Database connection file (db.php) not found. Please ensure it exists in the project root.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    if (!$conn) {
        die("Database connection failed.");
    }

    $new_image_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        // Delete old image using prepared statement
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $old_row = $result->fetch_assoc();
            $old_image = $old_row['image'];
            if ($old_image && $old_image !== '' && $old_image !== 'images/products/') { // Validate image path
                $old_image_path = "../images/products/" . $old_image;
                if (file_exists($old_image_path) && is_file($old_image_path)) {
                    unlink($old_image_path);
                }
            }
        }
        $stmt->close();

        // Upload new image
        $target_dir = "../images/products/"; // Adjust path to root images folder
        $image_name = basename($_FILES["image"]["name"]);
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_image_name = uniqid() . '.' . $image_ext;
        $target_file = $target_dir . $new_image_name;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Image upload failed.";
            exit;
        }
    }

    // Prepare the update statement with optional image
    if ($new_image_name) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssdsssi", $name, $category, $price, $stock, $description, $new_image_name, $id); // 7 parameters
    } else {
        $stmt = $conn->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssdssi", $name, $category, $price, $stock, $description, $id); // 6 parameters
    }

    if ($stmt->execute()) {
        header("Location: product.php");
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>