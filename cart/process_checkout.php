<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?redirect=cart/checkout.php");
    exit;
}
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $card_number = $_POST['card_number'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    $total_with_shipping = $total + 5;

    $conn->begin_transaction();
    try {
        foreach ($_SESSION['cart'] as $item) {
            $item_total_price = $item['price'] * $item['quantity']; // Store the calculated total
            $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $user_id, $item['id'], $item['quantity'], $item_total_price);
            $stmt->execute();
            $stmt->close();
        }
        $conn->commit();
        // Clear cart after successful order
        unset($_SESSION['cart']);
        header("Location: ../index.php?order=success");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error processing order: " . $e->getMessage();
    }
}
$conn->close();
?>