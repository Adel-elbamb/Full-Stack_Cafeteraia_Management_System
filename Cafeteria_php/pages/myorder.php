<?php
include '../config/config.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="./css/myorder.css">
    
</head>
<body>
    <h2>My Orders</h2>
    <form method="GET" action="../server/admin/Filter_data.php" class="filter_data">
    <label>From: <input type="date" name="start_date"></label>
    <label>To: <input type="date" name="end_date"></label>
    <button type="submit">Filter</button>
</form>
<section class="container">
    
<table>
        <thead>
        <tr onclick="fetchOrderDetails(<?= $order['order_id'] ?>)" style="cursor: pointer;">
                <th>Order Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>price</th>
                <th>Total price</th>
                
              
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td class="order-details"><?= $order['created_at'] ?></td>
            <td><?= $order['status'] ?></td>
            <td>
                <form method="POST" action="../server/admin/Amount.php">
                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                    <button type="submit" name="change_amount" value="-1">-</button>
                    <?= (int)$order['Amount'] ?> 
                    <button type="submit" name="change_amount" value="1">+</button>
                </form>
            </td>

           
            <td><?= $order['unit_price'] ?></td>
            <td>
               <?= $order['total_price'] ?>
            </td>

            <td>
                <?php if ($order['status'] == 'pending'): ?>
                    <form method="POST" action="../server/admin/cancel_order.php">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <button type="submit">Cancel</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    

</tbody>


    </table>
    <?php foreach ($orders as $order): ?>
    <div id="orderDetails" style="display: none; border: 1px solid black; padding: 10px; margin-top: 20px;">
    <h3 style="display: flex; justify-content: center; text-align: center; font-size: 30px;">Order Details</h3>
    <p>Click on an order to see details...</p>
</div>
<?php endforeach; ?>


</section>
<script src="./main.js"></script>



    
</body>
</html>
