<?php
include '../../config/config.php';
if (isset($_POST['order_id'])) {
    $order_id= $_POST['order_id'];
    $sql="delete from orders where order_id=$order_id";
    $sqlQuery=$conn->prepare($sql);
    $sqlQuery->execute();
}
// var_dump($_POST);

if ($sqlQuery) {
    echo "Order #$order_id has been canceled successfully.";
    header("Location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/project/Cafeteria_php/pages/myorder.php");
    exit();

} else {
    echo "Failed to cancel the order.";
}
