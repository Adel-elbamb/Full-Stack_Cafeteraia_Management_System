-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2025 at 09:47 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Beverages', '2025-03-04 22:13:01', '2025-03-04 22:13:01'),
(2, 'Snacks', '2025-03-04 22:13:01', '2025-03-04 22:13:01'),
(3, 'Desserts', '2025-03-04 22:13:01', '2025-03-04 22:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` decimal(10,2) DEFAULT NULL,
  `unit_price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`, `amount`, `unit_price`) VALUES
(11, 11, 750.00, 'pending', '2025-03-08 21:23:28', '2025-03-09 21:12:31', 5.00, 150.00),
(20, 10, 50.00, 'pending', '2025-03-01 08:00:00', '2025-03-09 04:27:31', NULL, 10.00),
(21, 12, 75.00, 'pending', '2025-03-02 09:15:00', '2025-03-09 04:27:31', NULL, 15.00),
(22, 11, 40.00, 'pending', '2025-03-03 07:30:00', '2025-03-09 04:27:31', NULL, 2.00),
(26, 11, 0.00, 'pending', '2025-03-09 21:13:45', '2025-03-09 21:13:45', NULL, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `product_id`, `quantity`) VALUES
(11, NULL, 29, 1),
(12, NULL, 30, 1),
(13, NULL, 31, 1),
(17, 20, 29, 2),
(18, 21, 30, 3),
(19, 22, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `productName` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `productName`, `price`, `product_description`, `product_img`) VALUES
(29, 1, 'Coffee', 20.00, 'Hot Coffee', '../assets/imgs/coffee.jfif\r\n'),
(30, 1, 'Tea', 15.00, 'Refreshing Tea', '../assets/imgs/tea.jpg'),
(31, 1, 'Orange Juice', 25.00, 'Fresh Orange Juice', '../assets/imgs/orangejuice.jfif'),
(32, 1, 'Burger', 50.00, 'Delicious Beef Burger', '../assets/imgs/burger.jfif'),
(33, 1, 'Pizza', 80.00, 'Cheese Pizza', '../assets/imgs/pizza.jpg'),
(34, 2, 'Latte', 30.00, 'Delicious hot latte', '../assets/imgs/latte.jfif'),
(35, 2, 'Cheesecake', 50.00, 'Creamy cheesecake with strawberry topping', '../assets/imgs/cheesecake.jfif'),
(36, 2, 'Grilled Chicken', 70.00, 'Juicy grilled chicken with herbs', '../assets/imgs/grilledchicken.jfif'),
(44, 1, 'tea', 40.00, 'Beverages', '1741554874.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int NOT NULL,
  `room_capacity` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','occupied','maintenance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_capacity`, `price`, `status`) VALUES
(1, '2', 100.00, 'available'),
(2, '4', 200.00, 'available'),
(3, '6', 300.00, 'occupied'),
(4, '3', 150.00, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `role`, `user_img`) VALUES
(10, 'admin', 'admin123', 'admin@example.com', '0123456789', 'admin', 'admin.png'),
(11, 'john_doe', 'password123', 'john@example.com', '0123456788', 'user', 'john.png'),
(12, 'jane_smith', 'securepass', 'jane@example.com', '0123456787', 'user', 'jane.png'),
(13, 'adel', '$2y$10$oxP8ji2F4F8aUgPnSjgwGO3QCkYZwgHoiWz4U/T/KlC31W65C3vEC', 'engadel987654321@gmail.com', '01094921017', 'admin', 'uploads/default.jpg'),
(14, 'Adel Elbamby', '6ebe76c9fb411be97b3b0d48b791a7c9', 'adel@gmail.com', '01094921017', 'user', 'images/1741474866.jpg'),
(15, 'elbamby', '6ebe76c9fb411be97b3b0d48b791a7c9', 'elbamby@gmail.com', '01094921017', 'user', 'images/1741475052.jpg'),
(16, 'adel', '$2y$10$4TdBzsj0Gh2qcLInLovP9OkESuqZX/mpeZm2JsRuKKdnQq8Cnefdm', 'ad@gmail.com', '01094921017', 'admin', 'uploads/cover (2).jpg'),
(17, 'e', '$2y$10$PtD1QceNbuIYJNRpltyvEugZkXd8d7.j.V.L7rRLqH2LOSBPFkOeO', 'e@gmail.com', '01094921017', 'user', 'uploads/default.jpg'),
(18, 'adel', '$2y$10$Zyf3UbeMzRbA/wttn3ohTeZgIfZ2HwXnY.FhRnnxtCUoJ3LaBmxOS', 'd@gmail.com', '01094921017', 'user', 'uploads/licensed-image.jpg'),
(19, 'menna', '6ebe76c9fb411be97b3b0d48b791a7c9', 'mss@gmail.com', '01094921017', 'user', 'images/1741550162.jpg'),
(20, 'adel', '$2y$10$BoIdkfNPLJRNqIOJeUTiY.Wcqa2u4C5BhizUyiTxrXWdG2vS/86MW', 'l@gmail.com', '01094921017', 'user', 'uploads/me.jpg'),
(21, 'adel', '$2y$10$tcgLt5s4ktSkjKAn6NpOXOH1p491G6zB07fAJd0/bqI08kQBZKj9y', 'adell@gmail.com', '01094921017', 'user', 'uploads/me.jpg'),
(22, 'Adel Elbamby', '6ebe76c9fb411be97b3b0d48b791a7c9', 'adelee@gmail.com', '01094921017', 'user', 'images/1741555034.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
