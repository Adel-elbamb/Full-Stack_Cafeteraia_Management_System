<?php include '../include/header.php' ?>

<?php  
require "../config/config.php";; // Include database connection

$query = "SELECT o.order_id, u.username, o.total_price, o.created_at
          FROM orders o
          JOIN users u ON o.user_id = u.user_id
          WHERE o.status = 'pending'
          ORDER BY o.created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin_orders.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="css/myorder.css"> <!-- Custom CSS -->
</head>
<body>

<div class="container admin-container   mt-5">
    <h2 class="text-center admin-title">Pending Orders</h2>

    <?php if (!empty($orders)): ?>
        <table class="table table-hover admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Room</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td>$<?= number_format($order['total_price'], 2) ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td><?= rand(0,30) ?></td>
                        <td>
                            <a href="order_details.php?order_id=<?= $order['order_id'] ?>" class="btn btn-sm btn-dark">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-muted">No pending orders found.</p>
    <?php endif; ?>
</div>

</body>
</html>
<?php include '../include/footer.php'; ?>