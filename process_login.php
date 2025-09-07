<?php
session_start();
include "db.php"; // Database connection

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'index.php';

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute query to fetch user details
    $stmt = $conn->prepare("SELECT user_id, name, password, role_id FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $hashedPass, $role_id);
    $stmt->fetch();
    $stmt->close();

    // Verify password and proceed if valid
    if ($id && (password_verify($pass, $hashedPass) || $pass === $hashedPass)) {
        // Regenerate session ID for security
        session_regenerate_id(true);

        $_SESSION['user_id']  = $id;
        $_SESSION['role_id']  = $role_id;
        $_SESSION['username'] = $name;

        // Determine role and redirect
        if ($role_id == 1) { // Admin role
            header("Location: Admin/admin.html"); // Redirect to admin products page
        } else {
            header("Location: " . $redirect); // Redirect to the intended page
        }
        exit();
    } else {
        header("Location: login.php?error=invalid&redirect=" . urlencode($redirect));
        exit();
    }

    $conn->close();
}
?>