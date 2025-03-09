<?php
include '../../config/config.php';

if(isset($_POST['order_id']) && isset($_POST['change_amount'])){
    $order_id = (int)$_POST['order_id'];
    $change = (int)$_POST['change_amount'];

    $sql = "SELECT amount, unit_price FROM orders WHERE order_id = $order_id";
    $sqlQuery = $conn->prepare($sql);
    $sqlQuery->execute();
    $row = $sqlQuery->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $new_amount = $row['amount'] + $change;

      
        if ($new_amount > 0) {
            $unit_price = $row['unit_price'];
            $total_price = $new_amount * $unit_price;
           
            $update_sql = "UPDATE orders SET amount = $new_amount, total_price = $total_price WHERE order_id = $order_id";
            $update_sqlQuery = $conn->prepare($update_sql);
            $update_sqlQuery->execute();
        }else{
            $delete_sql = "DELETE FROM orders WHERE order_id = $order_id";
            $delete_sqlQuery = $conn->prepare($delete_sql);
            $delete_sqlQuery->execute();
        }
    }

    // header("Location: http://localhost/project/Cafeteria_php/pages/myorder.php");
    // exit();
    header("Location: " . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/project/Cafeteria_php/pages/myorder.php");
    exit();

        
}
?>


