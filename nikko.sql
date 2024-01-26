-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 07:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nikko`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(2, 'Nikko Belgian Beer'),
(3, 'Special Package'),
(1, 'The Nikko Monkeys');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `member_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `no_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `member_name`, `phone_number`, `address`, `no_id`, `password`, `token`) VALUES
(1, 'Mr. A', '08971187202', 'Downtown', '1234567890123456', '10470c3b4b1fed12c3baac014be15fac67c6e815', '14e1b600b1fd579f47433b88e8d85291');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `size` int(5) NOT NULL,
  `stock` int(11) NOT NULL,
  `sold_quantity` int(11) NOT NULL,
  `ingredients` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Not Active') NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `category`, `price`, `size`, `stock`, `sold_quantity`, `ingredients`, `description`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Pale Ale', 'The Nikko Monkeys', 690, 330, 10, 2, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 1, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(2, 'Premium Lager', 'The Nikko Monkeys', 690, 330, 10, 12, 'ABV: 5% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 1, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(3, 'Un - Belgian Blonde', 'Nikko Belgian Beer', 440, 330, 10, 5, 'ABV: 6% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(4, 'Deux - Belgian White', 'Nikko Belgian Beer', 440, 330, 7, 10, 'ABV: 7% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 1, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(5, 'Trois - Strawberry Ale', 'Nikko Belgian Beer', 550, 330, 10, 5, 'ABV: 5% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(6, 'Hiver - Yuzu Saison', 'Nikko Belgian Beer', 550, 330, 10, 10, 'ABV: 6% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(7, 'été - Sansho Saison', 'Nikko Belgian Beer', 440, 330, 10, 5, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(8, 'Nikko Monkeys', 'Special Package', 1380, 330, 10, 20, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(9, 'Nikko Belgian Beer', 'Special Package', 1380, 330, 10, 5, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(10, '6 Bottles Set', 'Special Package', 3640, 330, 10, 10, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 1, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(11, '3 Bottles Set - Belgian Beer', 'Special Package', 2040, 330, 10, 10, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30'),
(12, '3 Bottle Set - Mix', 'Special Package', 2040, 330, 10, 10, 'ABV: 4% \n<br>\n原材料:麦芽・ホップ・ハーブスパイス', 'ホップにシトラとシムコーを贅沢に使用した、パッションフルーツの様なアロマと、 フレッシュな柑橋系のフレーバーが爽やかなアメリカンペールエールです。', 'Active', 0, '2024-01-22 05:17:30', '2024-01-22 05:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `sales_date` date NOT NULL,
  `total_cost` float NOT NULL,
  `shipping_cost` float NOT NULL,
  `discount_code` varchar(10) DEFAULT NULL,
  `discount_size` float DEFAULT NULL,
  `pending` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `member_id`, `sales_date`, `total_cost`, `shipping_cost`, `discount_code`, `discount_size`, `pending`, `created_at`, `updated_at`) VALUES
(5, NULL, '2024-01-25', 880, 0, NULL, NULL, 1, '2024-01-24 23:51:57', '2024-01-24 23:51:57'),
(6, NULL, '2024-01-25', 880, 0, NULL, NULL, 1, '2024-01-25 00:45:26', '2024-01-25 00:45:26'),
(7, NULL, '2024-01-25', 880, 0, NULL, NULL, 1, '2024-01-25 00:45:30', '2024-01-25 00:45:30'),
(8, NULL, '2024-01-25', 880, 0, NULL, NULL, 1, '2024-01-25 00:45:56', '2024-01-25 00:45:56'),
(9, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:47:21', '2024-01-25 00:47:21'),
(10, NULL, '2024-01-25', 440, 0, NULL, NULL, 1, '2024-01-25 00:47:57', '2024-01-25 00:47:57'),
(11, NULL, '2024-01-25', 440, 0, NULL, NULL, 1, '2024-01-25 00:49:32', '2024-01-25 00:49:32'),
(12, NULL, '2024-01-25', 440, 0, NULL, NULL, 1, '2024-01-25 00:49:53', '2024-01-25 00:49:53'),
(13, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:51:25', '2024-01-25 00:51:25'),
(14, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:51:46', '2024-01-25 00:51:46'),
(15, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:52:04', '2024-01-25 00:52:04'),
(16, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:52:22', '2024-01-25 00:52:22'),
(17, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:52:30', '2024-01-25 00:52:30'),
(18, NULL, '2024-01-25', 690, 0, NULL, NULL, 1, '2024-01-25 00:52:40', '2024-01-25 00:52:40'),
(19, NULL, '2024-01-25', 6900, 0, NULL, NULL, 1, '2024-01-25 01:38:39', '2024-01-25 01:38:39'),
(20, NULL, '2024-01-26', 440, 0, NULL, NULL, 1, '2024-01-25 22:54:57', '2024-01-25 22:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itemPrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`id`, `sales_id`, `product_name`, `quantity`, `itemPrice`, `totalPrice`, `created_at`, `updated_at`) VALUES
(5, 5, 'Un - Belgian Blonde', 2, 440, 880, '2024-01-24 23:51:57', '2024-01-24 23:51:57'),
(6, 6, 'Un - Belgian Blonde', 2, 440, 880, '2024-01-25 00:45:26', '2024-01-25 00:45:26'),
(7, 7, 'Un - Belgian Blonde', 2, 440, 880, '2024-01-25 00:45:30', '2024-01-25 00:45:30'),
(8, 8, 'Un - Belgian Blonde', 2, 440, 880, '2024-01-25 00:45:56', '2024-01-25 00:45:56'),
(9, 9, 'Premium Lager', 1, 690, 690, '2024-01-25 00:47:21', '2024-01-25 00:47:21'),
(10, 10, 'Deux - Belgian White', 1, 440, 440, '2024-01-25 00:47:57', '2024-01-25 00:47:57'),
(11, 11, 'Deux - Belgian White', 1, 440, 440, '2024-01-25 00:49:32', '2024-01-25 00:49:32'),
(12, 12, 'Deux - Belgian White', 1, 440, 440, '2024-01-25 00:49:53', '2024-01-25 00:49:53'),
(13, 13, 'Pale Ale', 1, 690, 690, '2024-01-25 00:51:25', '2024-01-25 00:51:25'),
(14, 14, 'Pale Ale', 1, 690, 690, '2024-01-25 00:51:46', '2024-01-25 00:51:46'),
(15, 15, 'Premium Lager', 1, 690, 690, '2024-01-25 00:52:04', '2024-01-25 00:52:04'),
(16, 16, 'Premium Lager', 1, 690, 690, '2024-01-25 00:52:22', '2024-01-25 00:52:22'),
(17, 17, 'Premium Lager', 1, 690, 690, '2024-01-25 00:52:30', '2024-01-25 00:52:30'),
(18, 18, 'Premium Lager', 1, 690, 690, '2024-01-25 00:52:40', '2024-01-25 00:52:40'),
(19, 19, 'Premium Lager', 10, 690, 6900, '2024-01-25 01:38:39', '2024-01-25 01:38:39'),
(20, 20, 'Deux - Belgian White', 1, 440, 440, '2024-01-25 22:54:57', '2024-01-25 22:54:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_name` (`product_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `sales_id` (`sales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_name`) REFERENCES `product` (`product_name`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`category_name`);

--
-- Constraints for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD CONSTRAINT `sales_detail_ibfk_1` FOREIGN KEY (`product_name`) REFERENCES `product` (`product_name`),
  ADD CONSTRAINT `sales_detail_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
