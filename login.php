<?php
session_start();
include "db.php"; // you must create this db.php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, password, role_id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPass, $role);
    $stmt->fetch();
    $stmt->close();

    if ($id && password_verify($pass, $hashedPass)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['role_id'] = $role;

        // ✅ Correct check for @shopnest.com
        if (substr($email, -13) === "@shopnest.com") {
            header("Location: admin.html");
        } else {
            header("Location: index.html");
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password!'); window.location='login.html';</script>";
    }
}
?>
