<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $stock_quantity = filter_input(INPUT_POST, 'stock_quantity', FILTER_SANITIZE_NUMBER_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate inputs
    $errors = [];
    if (empty($name)) $errors[] = "Product name is required.";
    if (empty($category_id)) $errors[] = "Category is required.";
    if (empty($price) || $price <= 0) $errors[] = "Valid price is required.";
    if (empty($stock_quantity) || $stock_quantity < 0) $errors[] = "Valid stock quantity is required.";

    // Handle file upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;

        // Validate file type (e.g., allow only images)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['image']['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Only JPEG, PNG, and GIF images are allowed.";
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) { // 5MB limit
            $errors[] = "Image size must be less than 5MB.";
        } else {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $errors[] = "Failed to upload image.";
            }
        }
    }

    // If no errors, insert into database
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO products (name, category_id, price, stock_quantity, description, image)
                VALUES (:name, :category_id, :price, :stock_quantity, :description, :image)
            ");
            $stmt->execute([
                'name' => $name,
                'category_id' => $category_id,
                'price' => $price,
                'stock_quantity' => $stock_quantity,
                'description' => $description ?: null,
                'image' => $image_path ? str_replace('../', '', $image_path) : null
            ]);
            // Redirect back to product page with success message
            header('Location: product.html?success=Product added successfully');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // If errors, redirect with error messages
    if (!empty($errors)) {
        $error_string = implode(',', $errors);
        header("Location: product.html?error=" . urlencode($error_string));
        exit;
    }
} else {
    header('Location: product.html?error=Invalid request');
    exit;
}
?>