<?php
include 'db_connection.php'; 


$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';
$user_id = $_GET['user_id'] ?? '';


$sql = "SELECT orders.order_id, orders.total_price, orders.status, orders.created_at, 
               users.username, products.productName, products.product_img, order_details.quantity 
        FROM orders 
        JOIN users ON orders.user_id = users.user_id 
        JOIN order_details ON orders.order_id = order_details.order_id
        JOIN products ON order_details.product_id = products.product_id
        WHERE orders.status = 'pending'";

// Apply filters
if (!empty($from_date)) {
    $sql .= " AND orders.created_at >= '$from_date 00:00:00'";
}
if (!empty($to_date)) {
    $sql .= " AND orders.created_at <= '$to_date 23:59:59'";
}
if (!empty($user_id)) {
    $sql .= " AND orders.user_id = $user_id";
}

$result = $conn->query($sql);

// Fetch all users for the dropdown filter
$users_result = $conn->query("SELECT user_id, username FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Admin Orders</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        img { width: 50px; height: 50px; border-radius: 5px; }
    </style>
</head>
<body>

    <h2>Admin - Orders</h2>

    <!-- Filter Form -->
    <form method="GET">
        <label for="from_date">From:</label>
        <input type="date" name="from_date" value="<?= $from_date ?>">

        <label for="to_date">To:</label>
        <input type="date" name="to_date" value="<?= $to_date ?>">

        <label for="user_id">User:</label>
        <select name="user_id">
            <option value="">All Users</option>
            <?php while ($user = $users_result->fetch_assoc()) { ?>
                <option value="<?= $user['user_id'] ?>" <?= ($user_id == $user['user_id']) ? 'selected' : '' ?>>
                    <?= $user['username'] ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Filter</button>
    </form>

    <!-- Orders Table -->
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Room No.</th>
                <th>Action </th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $order['username'] ?></td>
                    <td><?= $order['productName'] ?></td>
                    <td><img src="<?= $order['product_img'] ?>" alt="Product Image"></td>
                    <td><?= $order['quantity'] ?></td>
                    <td><?= $order['total_price'] ?> EGP</td>
                    <td><?= ucfirst($order['status']) ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td><?= rand(100, 999) ?></td> <!-- Generates a random room number -->
                    <td>delivery</td>
                    <td><a href="order_details.php?order_id=<?= $order['order_id'] ?>">View Details</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>

<?php $conn->close(); ?>
