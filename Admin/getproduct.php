<?php
header('Content-Type: application/json');

$servername = "localhost";  // change if needed
$username   = "root";       // your MySQL username
$password   = "";           // your MySQL password
$dbname     = "shopnest";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$rows = [];
while($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

echo json_encode($rows);
$conn->close();
?>