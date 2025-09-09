<?php
// Include db.php from the root directory
$dbPath = realpath(__DIR__ . '/../db.php');
if (file_exists($dbPath)) {
    include $dbPath;
} else {
    die("Database connection file (db.php) not found. Please ensure it exists in the project root.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!$conn) {
        die("Database connection failed.");
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "../images/products/" . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: product.php");
}
$conn->close();
?>