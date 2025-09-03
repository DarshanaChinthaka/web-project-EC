<?php
session_start();
include "db.php"; // connection

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // ✅ name column එකත් ගන්න
    $stmt = $conn->prepare("SELECT user_id, name, password, role_id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $hashedPass, $role);
    $stmt->fetch();
    $stmt->close();

    // ✅ check password
    if ($id && (password_verify($pass, $hashedPass) || $pass === $hashedPass)) {
        $_SESSION['user_id']  = $id;
        $_SESSION['role_id']  = $role;
        $_SESSION['username'] = $name; // DB එකෙන් name එක ගන්නවා

        // ✅ admin check
        if (substr($email, -13) === "@shopnest.com") {
            header("Location: Admin/admin.html");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password!'); window.location='login.html';</script>";
    }
}
?>
