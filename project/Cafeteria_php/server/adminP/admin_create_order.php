<?php

function getProducts() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsers() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getRooms() {
    global $conn;
    $stmt = $conn->query("SELECT * FROM rooms");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// function createOrder($user_id, $total_price) {
//     global $conn;
//     $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (:user_id, :total_price, 'pending')");
//     $stmt->bindParam(':user_id', $user_id);
//     $stmt->bindParam(':total_price', $total_price);
//     $stmt->execute();
// }


function createOrder($user_id, $unit_price) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO orders (user_id, unit_price, status) VALUES (:user_id, :unit_price, 'pending')");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':unit_price', $unit_price);
    $stmt->execute();
}

function getLatestOrder($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_id DESC LIMIT 1");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>