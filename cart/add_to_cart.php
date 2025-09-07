<?php
session_start();
include '../db.php';

if (isset($_POST['product_id'])) {
    $id = (int)$_POST['product_id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = 1; // Default quantity
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $item = ['id' => $id, 'name' => $row['name'], 'price' => $row['price'], 'quantity' => $quantity];
        $found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id) {
                $cart_item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = $item;
        }
        header("Location: cart.php");
        exit;
    } else {
        echo "Product not found.";
    }
    $stmt->close();
} else {
    echo "No product ID provided.";
}
$conn->close();
?>