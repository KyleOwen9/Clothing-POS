-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 07:39 AM
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
-- Database: `pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `created_at`) VALUES
(92, 2647.00, '2024-06-29 12:29:39'),
(93, 1050.00, '2024-06-30 14:09:30'),
(94, 0.00, '2024-06-30 14:09:42'),
(95, 350.00, '2024-06-30 14:57:15'),
(96, 350.00, '2024-06-30 14:59:56'),
(97, 700.00, '2024-06-30 15:06:42'),
(98, 1240.00, '2024-06-30 15:07:52'),
(99, 0.00, '2024-06-30 15:21:05'),
(100, 0.00, '2024-06-30 15:22:18'),
(101, 0.00, '2024-06-30 15:22:24'),
(102, 0.00, '2024-06-30 15:22:35'),
(103, 0.00, '2024-06-30 15:22:56'),
(104, 0.00, '2024-06-30 15:23:05'),
(105, 6337.00, '2024-06-30 15:25:57'),
(106, 12674.00, '2024-06-30 15:26:36'),
(107, 25348.00, '2024-06-30 15:29:43'),
(108, 50696.00, '2024-06-30 15:29:50'),
(109, 101392.00, '2024-06-30 15:33:22'),
(110, 700.00, '2024-06-30 17:11:11'),
(111, 350.00, '2024-06-30 17:20:43'),
(116, 560.00, '2024-06-30 17:26:59'),
(124, 830.00, '2024-06-30 17:44:26'),
(125, 1000.00, '2024-06-30 18:00:45'),
(126, 0.00, '2024-06-30 18:00:49'),
(127, 550.00, '2024-06-30 18:00:51'),
(128, 800.00, '2024-06-30 18:00:57'),
(130, 500.00, '2024-06-30 18:03:24'),
(131, 1240.00, '2024-06-30 18:03:28'),
(132, 1100.00, '2024-06-30 18:04:23'),
(133, 0.00, '2024-06-30 18:04:25'),
(134, 1860.00, '2024-06-30 18:04:34'),
(135, 1240.00, '2024-06-30 18:04:38'),
(136, 1100.00, '2024-06-30 18:07:41'),
(137, 350.00, '2024-06-30 18:17:58'),
(139, 350.00, '2024-07-01 04:44:33'),
(140, 350.00, '2024-07-01 04:46:03'),
(141, 280.00, '2024-07-01 04:47:04'),
(142, 1598.00, '2024-07-01 04:47:34'),
(143, 560.00, '2024-07-01 05:18:20'),
(144, 2508.00, '2024-07-01 05:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(94, 143, 3, 2, 560.00),
(95, 144, 2, 2, 1398.00),
(96, 144, 3, 2, 560.00),
(97, 144, 4, 1, 550.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stocks` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stocks`) VALUES
(1, 'Sleeveless (W)', 350.00, 50),
(2, 'Sweater (M/W)', 699.00, 48),
(3, 'Croptop (W)', 280.00, 42),
(4, 'Dress (W)', 550.00, 42),
(5, 'Oversized (W/M)', 450.00, 48),
(6, 'Polo-shirt (M)', 500.00, 49),
(7, 'Dri-fit (M)', 350.00, 47),
(8, 'Polo (M)', 620.00, 43),
(9, 'Denim Pants (W/M)', 799.00, 48),
(10, 'Ripped Jeans (W/M)', 699.00, 50),
(11, 'Shorts (M)', 449.00, 50),
(12, 'Skirts (W)', 499.00, 50),
(13, 'Cargo Pants (W/M)', 999.00, 50),
(14, 'Watch (W/M)', 3499.00, 50),
(15, 'Bracelet (W)', 1450.00, 50),
(16, 'Anklet (W)', 1200.00, 50),
(17, 'Necklace (W/M)', 2500.00, 50),
(18, 'Earrings (W/M)', 1199.00, 50),
(19, 'Ring (W/M)', 2199.00, 50),
(20, 'Cap (M/W)', 500.00, 50);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
