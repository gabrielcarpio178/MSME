-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 07:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'sample admin', 'admin@gmail.com', '$2y$10$lJBF5PPBE9rEyHb1S4KZjOBQkhvfKHvbIOmMfwctId/hzvXnOzzke', '2025-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `customer_id`, `created_at`) VALUES
(3, 3, 1, '2025-07-24'),
(4, 5, 1, '2025-07-24'),
(7, 2, 1, '2025-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `supplier_id`, `name`, `description`, `status`, `created_at`) VALUES
(23, 1, 'coffee', 'locally roasted in small batches, our coffee blends ethical sourcing with expert craftsmanship. bold, smooth, and full of flavor—crafted with care for true coffee lovers.', 'active', '2025-07-22'),
(24, 1, 'condiments', 'handcrafted in small batches using fresh, locally sourced ingredients. our condiments are bold in flavor, free from additives, and made to elevate every meal—from casual bites to gourmet plates.', 'active', '2025-07-22'),
(25, 1, 'food', 'crafted with care and tradition, our artisan foods are made in small batches using high-quality, locally sourced ingredients. each item is thoughtfully prepared to deliver authentic flavor, rich texture, and a homemade touch you can taste in every bite.', 'active', '2025-07-22'),
(26, 1, 'spread', 'rich, smooth, and full of flavor, our handcrafted spreads are made in small batches using natural, locally sourced ingredients. whether sweet or savory, each jar is thoughtfully blended to elevate your toast, cheese board, or favorite recipe with a touch of gourmet goodness.\n', 'active', '2025-07-22'),
(27, 1, 'sugar', 'naturally sweet and minimally processed, our artisan sugar is crafted in small batches to preserve its rich, molasses-kissed flavor and delicate texture. ideal for baking, stirring into coffee, or finishing dishes with a touch of rustic sweetness—it’s sugar, elevated.', 'active', '2025-07-22'),
(28, 1, 'wine', 'handcrafted in limited batches, our artisan wine reflects the character of the land and the passion of local vintners. made with carefully selected grapes and traditional methods, each bottle offers a balanced, expressive flavor—perfect for savoring and sharing.', 'active', '2025-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`, `password_hash`, `address`, `phone`, `created_at`) VALUES
(1, 'customer', 'customer@gmail.com', '$2y$10$t3fikFz2XuW8C73eVNIo5Osn/Lyi6px41ONiH0DWR6Bc4rUMLO7YS', 'brgy. Poblasion', '9123456789', '2025-07-12'),
(2, 'sample', 'samplecustomer@gmail.com', '$2y$10$2TG8fIik1ihOhKbi4OULVelHgA6BLVLdnJxAMVbv2FpNywHJsDRkS', 'sample', '9123456782', '2025-07-15'),
(4, 'elsa lee', 'elsa@gmail.com', '$2y$10$/.tU07Ze3C6p8nDFUsvtxeGQwCwVeUlsU01HeM4z1HO22TyNp0pwS', 'brgy.taluk', '9636545679', '2025-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `featured_product`
--

CREATE TABLE `featured_product` (
  `featured_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_product`
--

INSERT INTO `featured_product` (`featured_id`, `product_id`, `created_at`) VALUES
(1, 2, '2025-07-23'),
(2, 5, '2025-07-23'),
(3, 7, '2025-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `product_id`, `quantity`, `price`, `created_at`) VALUES
(1, 3, 1, 100.00, 0),
(2, 3, 3, 100.00, 0),
(3, 3, 3, 100.00, 0),
(4, 2, 1, 50.00, 0),
(5, 7, 1, 50.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `supplier_id`, `category_id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `status`, `created_at`) VALUES
(2, 1, 25, 'Banana chips', 'Thinly sliced and gently crisped to perfection, our banana chips are made from ripe, locally sourced bananas. Lightly sweet with a natural crunch, they’re a wholesome snack—simple, satisfying, and free from artificial additives.', 50.00, 100, 'file_687f1a2210fb59.79130408.jpg', 'active', '2025-07-22'),
(3, 1, 28, 'bignay', 'Made from handpicked bignay berries, this small-batch creation highlights the fruit’s naturally bold, tangy-sweet flavor. Rich in antioxidants and crafted with care, our bignay product offers a uniquely local taste—vibrant, earthy, and unmistakably Filipino.', 250.00, 200, 'file_687f1a5c4c2a53.34418053.jpg', 'active', '2025-07-22'),
(4, 1, 27, 'mascubado', 'Rich, dark, and full of natural molasses, our muscovado sugar is minimally refined to preserve its deep, caramel-like flavor and moist texture. Handcrafted in small batches, it adds a bold, complex sweetness perfect for baking, cooking, or enhancing your favorite drinks.', 150.00, 100, 'file_687f1aa90a74a8.80430213.jpg', 'active', '2025-07-22'),
(5, 1, 23, 'corn coffe', 'A unique blend crafted from carefully roasted corn kernels, our artisan corn coffee delivers a naturally sweet, nutty flavor with a smooth, caffeine-free finish. Perfect for those seeking a comforting and wholesome alternative to traditional coffee, made in small batches with local care.', 50.00, 200, 'file_687f1ae58c1528.12557451.jpg', 'active', '2025-07-22'),
(6, 1, 24, 'sinamak', 'Crafted in small batches, our sinamak is a flavorful spiced vinegar made from carefully fermented local cane vinegar infused with natural spices like chili, garlic, and ginger. Bold, tangy, and aromatic, it’s the perfect condiment to brighten up your grilled dishes, kinilaw, and more.', 100.00, 100, 'file_687f1b2a39df03.50491134.jpg', 'active', '2025-07-22'),
(7, 1, 26, 'papaya jam', 'Bursting with tropical sweetness, our papaya jam is handcrafted in small batches using ripe, juicy papayas and just the right amount of natural sweetness. Smooth, vibrant, and perfect for spreading on toast or pairing with cheese, it’s a delicious taste of the islands in every jar.', 200.00, 100, 'file_687f1ba2986f48.06214607.jpg', 'active', '2025-07-22');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `orders_id`, `rating`) VALUES
(1, 1, 5),
(3, 2, 5),
(4, 3, 3),
(5, 4, 5),
(6, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `rider_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'unavailable',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`rider_id`, `name`, `email`, `password_hash`, `phone`, `status`, `created_at`) VALUES
(1, 'rider', 'rider@gmail.com', '$2y$10$H0AgyvsSQgb5G10I/Hcc1O4mdoonW9GEsVAh/akOl7/qbZfV/gU0K', '09246813579', 'unavailable', '2025-07-12'),
(2, 'chris jhon campanil', 'campanilchrisjhon28@gmail.com', '$2y$10$H1cY5mS1HZktW1SiXapkx.wj6kB7Rpzs4ipFfh/aRjvUAwmGdv8fC', '9506506709', 'unavailable', '2025-07-24'),
(3, 'chris jhon campanil', 'cj@gmail.com', '$2y$10$faCzQFtvbhBp1jGKMnzGl.5x56kl.vPvEsoTU0GFEZJTCyQCqfBA6', '9560867941', 'unavailable', '2025-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `bussiness_name` varchar(100) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image_profile` text NOT NULL DEFAULT 'file_687b804156d389.23427492.jpeg',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `bussiness_name`, `owner_name`, `email`, `password_hash`, `address`, `phone`, `image_profile`, `created_at`) VALUES
(1, 'bussines name', 'owner', 'supplier@gmail.com', '$2y$10$3ThLzwN0X5UISYw58t5U7.JJ5vObxN7BCHF.LsBoAZvMrnPq//JZ2', 'brgy. calumangan', '9567891232', 'file_687f1d88eed0e6.92579172.jpeg', '2025-07-12'),
(2, 'sample bussiness name', 'sample owner name', 'supplierSample@gmail.com', '$2y$10$p7P/JBXykS.06qtV3CUhIOaXMG5Gi8LEBw5wOPELZwvJmDBm9xzm6', 'sample address', '9123456789', 'file_687f1d81094044.05969673.jpeg', '2025-07-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `featured_product`
--
ALTER TABLE `featured_product`
  ADD PRIMARY KEY (`featured_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_ibfk_1` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`rider_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `featured_product`
--
ALTER TABLE `featured_product`
  MODIFY `featured_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rider`
--
ALTER TABLE `rider`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `featured_product`
--
ALTER TABLE `featured_product`
  ADD CONSTRAINT `featured_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
