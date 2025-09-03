<?php
session_start();
include "db.php"; // Updated path to match the actual location

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validate passwords match
    if ($pass !== $confirm) {
        echo "<script>alert('Passwords do not match!'); window.location='signup.html';</script>";
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already exists!'); window.location='signup.html';</script>";
        exit();
    }

    // Hash password for security
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    // Assume role_id = 2 for a regular user
    $role = 2;

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssi", $name, $email, $hashedPass, $role);
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['role_id'] = $role;
        header("Location: index.html");
        exit();
    } else {
        echo "<script>alert('Error creating account: " . $stmt->error . "'); window.location='signup.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>