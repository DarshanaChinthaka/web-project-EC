<?php
include '../db.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sql = "SELECT user_id, name, email, role_id, created_at FROM users";
if ($search) {
    $sql .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
}
$sql .= " ORDER BY user_id DESC";

$result = $conn->query($sql);

echo '<table class="table table-striped" id="usersTable">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $role = $row['role_id'] == 1 ? 'Admin' : ($row['role_id'] == 2 ? 'Customer' : 'Staff');
        $status = $row['role_id'] == 1 || $row['role_id'] == 2 ? 'Active' : 'Inactive'; // Assuming role_id 3 (Staff) can be inactive
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td><span class='badge badge-info'>{$role}</span></td>
                <td>" . date('Y-m-d H:i', strtotime($row['created_at'])) . "</td>
                <td>
                    <button class='btn btn-sm btn-warning edit-user' data-toggle='modal' data-target='#editUserModal'
                        data-id='{$row['user_id']}' data-name='{$row['name']}' data-email='{$row['email']}' data-role='{$row['role_id']}' data-status='1'>Edit</button>
                    <button class='btn btn-sm btn-danger delete-user' data-id='{$row['user_id']}'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No users found.</td></tr>";
}
echo "</tbody></table>";

$conn->close();
?>