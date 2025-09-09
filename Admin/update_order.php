<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $status   = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $order_date = date('Y-m-d H:i:s');

    if ($order_id && $status) {
        $stmt = $conn->prepare("UPDATE orders SET status = ?, order_date = ? WHERE order_id = ?");
        $stmt->bind_param("ssi", $status, $order_date, $order_id);

        if ($stmt->execute()) {
            echo "success";
        } else {
            http_response_code(500);
            echo "DB error: " . $conn->error;
        }
        $stmt->close();
    } else {
        http_response_code(400);
        echo "Invalid input.";
    }
}
?>
