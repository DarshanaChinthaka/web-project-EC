<?php
include '../db.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM orders";
if ($search) {
    $sql .= " WHERE order_id LIKE '%$search%' 
              OR user_id LIKE '%$search%' 
              OR product_id LIKE '%$search%' 
              OR quantity LIKE '%$search%' 
              OR total_price LIKE '%$search%' 
              OR order_date LIKE '%$search%' 
              OR status LIKE '%$search%'";
}
$sql .= " ORDER BY order_id DESC";

$result = $conn->query($sql);

echo '<table class="table table-striped" id="ordersTable">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Total Price (LKR)</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $order_id = $row['order_id'];
        echo "<tr>
                <td>{$order_id}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['quantity']}</td>
                <td>" . number_format($row['total_price'], 2) . "</td>
                <td>" . date('Y-m-d H:i', strtotime($row['order_date'])) . "</td>
                <td><span class='badge badge-info'>{$row['status']}</span></td>
                <td>
                    <button class='btn btn-sm btn-warning edit-order' data-toggle='modal' data-target='#editOrderModal'
                        data-id='{$order_id}' data-status='{$row['status']}'>Change Status</button>
                    <a href='delete_order.php?id={$order_id}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No orders found.</td></tr>";
}
echo "</tbody></table>";

$conn->close();
?>