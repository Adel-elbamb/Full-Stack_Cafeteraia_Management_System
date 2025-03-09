<?php include '../include/header.php' ?>


<?php 

require "../config/config.php" ;

$selected_user = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-t');

// Fetch Users
$user_stmt = $conn->query("SELECT user_id, username FROM users");
$users = $user_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Orders Grouped by Users
$order_query = "SELECT users.user_id, users.username, SUM(orders.total_price) AS total_amount
                FROM orders 
                JOIN users ON orders.user_id = users.user_id
                WHERE orders.created_at BETWEEN :start_date AND :end_date";

if ($selected_user) {
    $order_query .= " AND orders.user_id = :user_id";
}

$order_query .= " GROUP BY users.user_id";
$order_stmt = $conn->prepare($order_query);
$order_stmt->bindParam(':start_date', $start_date);
$order_stmt->bindParam(':end_date', $end_date);
if ($selected_user) {
    $order_stmt->bindParam(':user_id', $selected_user);
}
$order_stmt->execute();
$user_orders = $order_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./css/check.css">
    <link rel="stylesheet" href="./css/myorder.css">
</head>
<body>

<div class="container custom-container">
    <h1 class="custom-title">☕ Coffee Check  Orders </h1>

    <!-- Filter Form -->
    <form method="GET" class="row g-3 custom-filter-form">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Date from:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= htmlspecialchars($start_date) ?>" required>
        </div>

        <div class="col-md-4">
            <label for="end_date" class="form-label">Date to:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= htmlspecialchars($end_date) ?>" required>
        </div>

        <div class="col-md-4">
            <label for="user_id" class="form-label">User:</label>
            <select id="user_id" name="user_id" class="form-select">
                <option value="">All Users</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['user_id'] ?>" <?= ($selected_user == $user['user_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['username']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn custom-btn">Filter</button>
        </div>
    </form>

    <!-- Orders Table -->
    <table class="table custom-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_orders as $row): ?>
                <tr>
                    <td>
                        <span class="custom-user-link" data-user="<?= $row['user_id'] ?>">
                            <?= htmlspecialchars($row['username']) ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($row['total_amount']) ?> EGP</td>
                </tr>
                <tr class="custom-order-details" id="orders-<?= $row['user_id'] ?>">
                    <td colspan="2">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $order_details_query = "SELECT order_id, created_at, total_price FROM orders 
                                                       WHERE user_id = :user_id AND created_at BETWEEN :start_date AND :end_date";
                                $order_details_stmt = $conn->prepare($order_details_query);
                                $order_details_stmt->bindParam(':user_id', $row['user_id']);
                                $order_details_stmt->bindParam(':start_date', $start_date);
                                $order_details_stmt->bindParam(':end_date', $end_date);
                                $order_details_stmt->execute();
                                $orders = $order_details_stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?= $order['created_at'] ?></td>
                                        <td><?= $order['total_price'] ?> EGP</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $(".custom-user-link").click(function() {
        var userId = $(this).data("user");
        $("#orders-" + userId).toggle();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include '../include/footer.php'; ?>