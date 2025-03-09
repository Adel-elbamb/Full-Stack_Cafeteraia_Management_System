<?php
include 'db_connection.php';

$order_id = $_GET['order_id'] ?? 0;

$sql = "SELECT products.productName, products.price, order_details.quantity 
        FROM order_details 
        JOIN products ON order_details.product_id = products.product_id
        WHERE order_details.order_id = $order_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>

    <h2>Order Details</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (EGP)</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $item['productName'] ?></td>
                    <td><?= $item['price'] ?> EGP</td>
                    <td><?= $item['quantity'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="admin_orders.php">Back to Orders</a>

</body>
</html>

<?php $conn->close(); ?>
