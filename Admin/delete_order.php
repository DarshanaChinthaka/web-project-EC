<?php
// delete_order.php
include '../db.php';

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $order_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $order_id);
    
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: orders.php");
        exit;
    } else {
        $stmt->close();
        die("Error deleting order: " . $conn->error);
    }
} else {
    die("Invalid order ID.");
}
?>