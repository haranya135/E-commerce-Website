-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 10:14 AM
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
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$f3xCnesPk0rGGkKtDEBptOrCwdyNcucd.LMAnNEyp69ZcQXCrmgGC');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Earrings'),
(2, 'Necklace'),
(3, 'Bracelets'),
(4, 'Ring'),
(5, 'Anklets');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_no`, `product_id`, `quantity`, `order_status`) VALUES
(1, 3, 1968442621, 2, 1, 'pending'),
(3, 3, 179859700, 2, 1, 'pending'),
(6, 3, 61039404, 1, 1, 'pending'),
(8, 3, 1266230614, 12, 1, 'pending'),
(9, 3, 806135829, 8, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `product_image1`, `product_price`, `date`, `status`) VALUES
(1, 'Butterfly studs', 'Charming butterfly stud earrings crafted from high-quality sterling silver and coloured beads.', 'Butterflystuds,studs,earrings,butterfly', 1, 'butterfly_studs.jpg', 348, '2024-02-26 17:22:10', 'true'),
(2, 'Owl Drop Earring', 'Elegant owl drop earrings crafted to add a touch of nature-inspired sophistication to your look.', 'owl,earring,dropdown', 1, '71rSkHin2PL._SL1500_.jpg', 399, '2024-02-26 17:19:24', 'true'),
(5, 'Green Delight Quilled Earrings', 'Quirky quilling earrings showcasing intricate paper coils, perfect for creative touch to your outfit.', 'Earrings', 1, 'quiling-1.jpg', 249, '2024-02-26 17:20:07', 'true'),
(6, 'Rustic Brown Earrings', 'Light weight, made out of specialty quilling papers. Try out its something different, suitable for all occasions.', 'earrings', 1, 'quiling-2.jpg', 269, '2024-02-26 17:20:53', 'true'),
(7, 'Contemporary Parrot Studs Earring', 'Elegant owl drop earrings featuring intricate detailing to add a great look.', 'parrot earring', 1, 'parrot-2.jpg', 359, '2024-02-26 17:23:58', 'true'),
(8, 'Crystal Beads Combo Layered Bracelets', 'Find the magic You have been missing and we present  Yoga Inspired Jewelry.', 'bracelet,bracelets', 3, 'bracelet-1.jpg', 329, '2024-02-27 08:45:51', 'true'),
(9, 'Eye Beaded Bracelet', 'The bracelet is wards off evil spirits and protect the wearer from harm and encourages emotional expression.', 'bracelet,bracelets', 3, 'bracelet-2.jpg', 249, '2024-02-27 08:46:19', 'true'),
(10, 'Green Jade Bracelet', 'Green JadeBracelet is a symbol of purity and serenity and is associated with the heart chakra. ', 'bracelet,bracelets', 3, 'bracelet-3.jpg', 149, '2024-02-27 08:46:35', 'true'),
(11, 'Rose Quartz Bracelet', 'Graceful rose quartz bracelet, adorned with soothing gemstones to enhance love, compassion, and inner harmony.', 'bracelet,bracelets', 3, 'bracelet-4.jpg', 219, '2024-02-27 08:46:42', 'true'),
(12, 'Resin Beaded Necklace', 'These traditional necklaces add a hint of raw ethnic beauty to any look,a classic fusion of exquisite craftsmanship.', 'necklace', 2, 'necklace-1.jpg', 379, '2024-02-26 17:44:25', 'true'),
(13, 'Three Layer Onyx Stone Bead Necklace', 'The color range is exclusively handpicked to give a Real Precious Stone Look. ', 'necklace', 2, 'necklace-2.jpg', 459, '2024-02-26 17:41:03', 'true'),
(14, 'Five Layer Onyx Stone Bead Necklace', 'Get the Bollywood Diva Look.Light in weight & gives you a Rich Look. ', 'necklace', 2, 'necklace-3.jpg', 379, '2024-02-26 17:43:51', 'true'),
(15, 'Pink Yellow Agate Stone Bead Necklace', 'High Quality Stones Look necklace (Made with Real Onyx Stones).', 'neckalce', 2, 'necklace-4.jpg', 247, '2024-02-17 13:37:29', 'true'),
(16, 'Ethnic Adjustable Ring', 'Loved by the fashionistas for their trendy designs, ethnic finger rings are nothing short of fashion statements.', 'ring', 4, 'ring-1.jpg', 109, '2024-02-26 17:34:53', 'true'),
(17, 'Flower Ethnic Finger Ring', 'Looking for the perfect ring? well!!! you have just found it. This dazzling ring is perfectly crafted to suit you. ', 'ring', 4, 'ring-2.jpg', 129, '2024-02-26 17:35:15', 'true'),
(18, 'Rose Gold Cubic Rings', 'There is no jewelry type that has been left untouched by this alluring cubic zirconia diamonds.', 'ring', 4, 'ring-3.jpg', 359, '2024-02-17 13:37:51', 'true'),
(19, 'Combo of 2 adjustable ring', 'Let your fingers do all the talking with this enamel-work finger ring crafted with great quality stones. ', 'ring', 4, 'ring-4.jpg\r\n', 356, '2024-02-26 17:35:53', 'true'),
(20, 'Rose Gold Plated Butterfly Anklet', ' A mere look will be enough for you to fall in love with these pretty anklets.', 'anklet,anklets', 5, 'anklet-1.jpg', 251, '2024-02-27 08:45:10', 'true'),
(21, 'Oxidised Floral Anklet', 'Stylish one piece oxidized silver anklet.Adjustable length suitable for most feet.', 'anklet,anklets', 5, 'anklet-2.jpg', 225, '2024-02-27 08:45:16', 'true'),
(22, 'Infinity Shape Anklet', 'A very stylish, trendy and luxurious crystal Anklet With Solitaire Crystal Diamonds for girls and women.', 'anklet,anklets', 5, 'anklet-3.jpg', 392, '2024-02-27 08:45:27', 'true'),
(23, 'Solitaire Crystal Diamond Star Shaped Anklet', 'Very feminine, this design can be worn on any Occasion to boost up your style.', 'anklet,anklets', 5, 'anklet-4.jpg', 391, '2024-02-27 08:45:31', 'true'),
(24, 'Yellow Chimes Anklets ', 'Gold-plated double layered charm anklet looking fashionable and pretty elegent and stylish.', 'anklet,anklets', 5, 'anklet-5.jpg', 328, '2024-02-27 08:45:37', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount`, `invoice_no`, `total_products`, `order_date`, `order_state`) VALUES
(1, 3, 399, 1968442621, 1, '2024-02-13 12:44:15', 'confirmed'),
(3, 3, 399, 179859700, 1, '2024-02-13 12:55:32', 'confirmed'),
(6, 3, 348, 61039404, 1, '2024-02-13 13:06:03', 'confirmed'),
(7, 3, 1044, 1239789173, 1, '2024-02-13 13:06:28', 'pending'),
(8, 3, 379, 1266230614, 1, '2024-02-27 08:44:05', 'confirmed'),
(9, 3, 329, 806135829, 1, '2024-02-27 08:59:03', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_no`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 1968442621, 399, 'cashback', '2024-02-13 12:44:15'),
(2, 1, 1968442621, 399, 'cashback', '2024-02-13 12:44:46'),
(3, 0, 50231680, 0, 'cashback', '2024-02-13 12:54:45'),
(4, 3, 179859700, 399, 'cashback', '2024-02-13 12:55:32'),
(5, 6, 61039404, 348, 'cashback', '2024-02-13 13:06:03'),
(6, 8, 1266230614, 379, 'cashback', '2024-02-27 08:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_ip`, `user_address`, `user_mobile`) VALUES
(2, 'rupa', 'sad@gmail.com', '$2y$10$ML7mkoGmAUtmAqKTMcKUmOGqGyAsUiW9NLk6j9mihk6fQY35H99ci', '::1', 'asdfaas', 'asd'),
(3, 'rr', 'asd@gmail.com', '$2y$10$H9DYR6icS.oW3CuUKpCzl.yhNmcvO483lYN0xqgWKw1COOvzBON5u', '::1', 'asd', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
