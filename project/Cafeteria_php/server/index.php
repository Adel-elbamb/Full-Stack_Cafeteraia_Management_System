<?php
include '../config/config.php';


$selected_user = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-t');

// Fetch users
$user_query = "SELECT user_id, username FROM users";
$user_result = $conn->query($user_query);

// Fetch orders grouped by users
$order_query = "SELECT users.user_id, users.username, SUM(orders.total_price) AS total_amount
               FROM orders 
               JOIN users ON orders.user_id = users.user_id
               WHERE orders.created_at BETWEEN '$start_date' AND '$end_date'";
if ($selected_user) {
    $order_query .= " AND orders.user_id = $selected_user";
}
$order_query .= " GROUP BY users.user_id";
$user_orders = $conn->query($order_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Checks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Checks</h2>
    <form method="GET" class="mb-3">
        <label>Date from:</label>
        <input type="date" name="start_date" value="<?php echo $start_date; ?>" required>
        
        <label>Date to:</label>
        <input type="date" name="end_date" value="<?php echo $end_date; ?>" required>
        
        <label>User:</label>
        <select name="user_id">
            <option value="">All Users</option>
            <?php while ($user = $user_result->fetch_assoc()) { ?>
                <option value="<?php echo $user['user_id']; ?>" <?php echo ($selected_user == $user['user_id']) ? 'selected' : ''; ?>>
                    <?php echo $user['username']; ?>
                </option>
            <?php } ?>
        </select>
        
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $user_orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <button class="toggle-orders btn btn-link" data-user="<?php echo $row['user_id']; ?>">+</button>
                        <?php echo $row['username']; ?>
                    </td>
                    <td><?php echo $row['total_amount']; ?> EGP</td>
                </tr>
                <tr class="order-details" id="orders-<?php echo $row['user_id']; ?>" style="display: none;">
                    <td colspan="2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $order_details_query = "SELECT order_id, created_at, total_price FROM orders WHERE user_id = " . $row['user_id'] . " AND created_at BETWEEN '$start_date' AND '$end_date'";
                                $order_details_result = $conn->query($order_details_query);
                                while ($order = $order_details_result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><button class="toggle-items btn btn-link" data-order="<?php echo $order['order_id']; ?>">+</button> <?php echo $order['created_at']; ?></td>
                                        <td><?php echo $order['total_price']; ?> EGP</td>
                                    </tr>
                                    <tr class="item-details" id="items-<?php echo $order['order_id']; ?>" style="display: none;">
                                        <td colspan="2">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $items_query = "SELECT products.productName, products.price, order_details.quantity
                                                                   FROM order_details
                                                                   JOIN products ON order_details.product_id = products.product_id
                                                                   WHERE order_details.order_id = " . $order['order_id'];
                                                    $items_result = $conn->query($items_query);
                                                    while ($item = $items_result->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo $item['productName']; ?></td>
                                                            <td><?php echo $item['price']; ?> EGP</td>
                                                            <td><?php echo $item['quantity']; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $(".toggle-orders").click(function() {
        var userId = $(this).data("user");
        $("#orders-" + userId).toggle();
    });
    
    $(".toggle-items").click(function() {
        var orderId = $(this).data("order");
        $("#items-" + orderId).toggle();
    });
});
</script>
</body>
</html>