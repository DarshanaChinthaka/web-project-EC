<?php
header('Content-Type: application/json');

// Include db.php from the root directory
$dbPath = realpath(__DIR__ . '/db.php');
if (file_exists($dbPath)) {
    include $dbPath;
} else {
    die(json_encode(["error" => "Database connection file (db.php) not found."]));
}

if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$rows = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} else {
    $rows = ["error" => "Query failed: " . $conn->error];
}

echo json_encode($rows);
$conn->close();
?>