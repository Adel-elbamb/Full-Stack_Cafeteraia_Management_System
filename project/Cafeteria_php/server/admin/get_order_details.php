<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// include '../../config/config.php';

// if (isset($_GET['order_id'])) {
//     $order_id = (int)$_GET['order_id'];
//      $sql = "SELECT Amount, unit_price, total_price FROM orders WHERE order_id = $order_id";
//     $stmt = $conn->prepare($sql);
//     if ($stmt->execute()) {
//         $order = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($order) {
//             echo "<h3>Order Details</h3>";
//             echo "<p><strong>Amount:</strong> {$order['Amount']} </p>";
//             echo "<p><strong>Unit Price:</strong> {$order['unit_price']} EGP</p>";
//             echo "<p><strong>Total Price:</strong> {$order['total_price']} EGP</p>";
//         } else {
//             echo "<p>No details found for this order.</p>";
//         }
//     } else {
//         echo "<p style='color:red;'>Database query failed.</p>";
//     }
// } else {
//     echo "<p style='color:red;'>No order_id received.</p>";
// }


include '../../config/config.php';

if (isset($_GET['order_id'])) {
    $order_id = (int)$_GET['order_id'];
     $sql = "SELECT Amount, unit_price, total_price FROM orders WHERE order_id = $order_id";
    $select_sql = $conn->prepare($sql);
    $response=$select_sql->execute();
    if ($response) {
        $order = $select_sql->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            echo '<h3 style="color: #dac1a4";">Order Details</h3>';
            echo '<p><strong style="color:rgb(94, 78, 62)">Amount : </strong> <span style="color: #dac1a4">'  . (int)$order['Amount'] . '</span></p>';
            echo '<p><strong style="color:rgb(94, 78, 62)">Unit Price : </strong> <span style="color: #dac1a4">'  . $order['unit_price'] . ' EGP</span></p>';
            echo '<p><strong style="color:rgb(94, 78, 62)">Total Price : </strong> <span style="color: #dac1a4">'  . $order['total_price'] . ' EGP</span></p>';
            
        } else {
            echo "<p>No details found for this order.</p>";
        }
    } else {
        echo "<p style='color:red;'>Database query failed.</p>";
    }
} else {
    echo "<p style='color:red;'>No order_id received.</p>";
}

?>
