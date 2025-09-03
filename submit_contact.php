<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $servername = "localhost";
         $username = "root";
         $password = "";
         $dbname = "shopnest";

         $conn = new mysqli($servername, $username, $password, $dbname);

         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }

         $name = $conn->real_escape_string($_POST['name']);
         $email = $conn->real_escape_string($_POST['email']);
         $message = $conn->real_escape_string($_POST['message']);
         $date = date('Y-m-d H:i:s');

         $sql = "INSERT INTO contacts (name, email, message, submission_date) VALUES ('$name', '$email', '$message', '$date')";

         if ($conn->query($sql) === TRUE) {
             echo "Thank you for your message! We will get back to you soon.";
         } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }

         $conn->close();
     }
     ?>