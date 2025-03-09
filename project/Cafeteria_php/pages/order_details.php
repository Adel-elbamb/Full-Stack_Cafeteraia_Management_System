<?php include '../include/header.php' ?>

<?php  
require "../config/config.php";
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid order ID");
}

$order_id = intval($_GET['order_id']);

$query = "SELECT p.productName, od.quantity, p.price, (od.quantity * p.price) AS total
          FROM order_details od
          JOIN products p ON od.product_id = p.product_id
          WHERE od.order_id = :order_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
$stmt->execute();
$orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details Delivery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin_orders.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="css/myorder.css"> <!-- Custom CSS -->
</head>
<body>

<div class="container admin-container  mt-5">
    <h2 class="text-center admin-title">Order Details Delivery</h2>

    <table class="table table-hover admin-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetails as $detail): ?>
                <tr>
                    <td><?= htmlspecialchars($detail['productName']) ?></td>
                    <td><?= $detail['quantity'] ?></td>
                    <td>$<?= number_format($detail['price'], 2) ?></td>
                    <td>$<?= number_format($detail['total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_orders.php" class="btn btn-secondary">Back to Orders</a>
</div>

</body>
</html>
<?php include '../include/footer.php'; ?>
