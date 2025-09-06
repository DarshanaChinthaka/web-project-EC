<?php
session_start();

$servername = "localhost";
$username   = "root";   // XAMPP default
$password   = "";       // XAMPP default password is empty

// 🔹 Connect without database
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 🔹 Create database if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS shopnest");
$conn->select_db("shopnest");

// 🔹 Create users table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT DEFAULT 2,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $pass     = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

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
    $stmt->close();

    // Hash password
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
    // Set role: 1 for admin (@shopnest.com), 2 for normal user
    $role = (substr($email, -13) === "@shopnest.com") ? 1 : 2;

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role_id, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssi", $name, $email, $hashedPass, $role);

    if ($stmt->execute()) {
        $_SESSION['user_id']  = $conn->insert_id;
        $_SESSION['role_id']  = $role;
        $_SESSION['username'] = $name;

        // Redirect to index.php for all users
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Error creating account: " . $stmt->error . "'); window.location='signup.html';</script>";
    }

    $stmt->close();
}
$conn->close();
?>