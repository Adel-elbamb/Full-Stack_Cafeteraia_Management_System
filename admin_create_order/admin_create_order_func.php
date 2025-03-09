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

function getLatestOrder($user_id) {
    global $conn;
    return $conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY order_id DESC LIMIT 1")->fetch_assoc();
}
?>