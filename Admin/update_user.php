<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);
    $status = $conn->real_escape_string($_POST['status']);

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role_id = ?, status = ? WHERE user_id = ?");
    $stmt->bind_param("sssii", $name, $email, $role, $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        http_response_code(500);
        echo "DB error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>