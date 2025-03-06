<?php
$servername = "localhost";
$username = "root";
$password = "sara1234$";
$dbname = "cafeteria";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!-- func -->
 

<?php

function getProducts() {
    global $conn;
    return $conn->query("SELECT * FROM products");
}
function getUsers() {
    global $conn;
    return $conn->query("SELECT * FROM users");
}
function getRooms() {
    global $conn;
    return $conn->query("SELECT * FROM rooms");
}
function createOrder($user_id, $total_price) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("id", $user_id, $total_price); 
    $stmt->execute();
    $stmt->close();
}

// function getLatestOrder($user_id) {
//     global $conn;
//     return $conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY order_id DESC LIMIT 1")->fetch_assoc();
// }




function getLatestOrder($user_id) {
    global $conn;
    $query = "SELECT products.productName, products.product_img, orders.total_price 
              FROM orders 
              JOIN order_details ON orders.order_id = order_details.order_id 
              JOIN products ON order_details.product_id = products.product_id 
              WHERE orders.user_id = ? 
              ORDER BY orders.order_id DESC 
              LIMIT 1";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();


    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    
    return $result->fetch_assoc(); 
}



?>