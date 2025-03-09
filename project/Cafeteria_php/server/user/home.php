<?php

// Function to get all products
// function getProducts(PDO $conn) {
//     $stmt = $conn->prepare("SELECT * FROM products");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// Function to get all users
function getUsers(PDO $conn) {
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// Function to get all products
function getProducts(PDO $conn) {
    $stmt = $conn->query("SELECT * FROM products");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

// Function to get all rooms
function getRooms(PDO $conn) {
    $stmt = $conn->query("SELECT * FROM rooms");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

// Function to get all rooms
// function getRooms(PDO $conn) {
//     $stmt = $conn->prepare("SELECT * FROM rooms");
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// Function to create an order
// function createOrder(PDO $conn, int $user_id, float $total_price) {
//     $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (:user_id, :total_price, 'pending')");
//     $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//     $stmt->bindParam(':total_price', $total_price, PDO::PARAM_STR);
//     return $stmt->execute(); // Returns true if successful
// }



function createOrder(PDO $conn, int $user_id, float $total_price) {
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (:user_id, :total_price, 'pending')");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':total_price', $total_price, PDO::PARAM_STR);
    return $stmt->execute(); // Returns true if successful
}

// Function to get the latest order for a user
function getLatestOrder(PDO $conn, int $user_id) {
    $query = "SELECT products.productName, products.product_img, orders.total_price 
              FROM orders 
              JOIN order_details ON orders.order_id = order_details.order_id 
              JOIN products ON order_details.product_id = products.product_id 
              WHERE orders.user_id = :user_id 
              ORDER BY orders.order_id DESC 
              LIMIT 1";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC); // Returns false if no result
}

?>
