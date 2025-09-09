<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $name, $email, $password, $role, $created_at);

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