-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2018 at 06:51 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `cake_id` int(11) NOT NULL,
  `cake_name` varchar(100) NOT NULL,
  `cake_category` varchar(100) NOT NULL,
  `cake_price` int(100) NOT NULL,
  `cake_pic` varchar(200) NOT NULL,
  `cake_description` text NOT NULL,
  `cake_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`cake_id`, `cake_name`, `cake_category`, `cake_price`, `cake_pic`, `cake_description`, `cake_created_at`) VALUES
(8, 'kake name here', 'Wedding', 123, 'Screenshot from 2018-09-11 15-47-41.png', 'asfafd asfasfsfd', '2018-09-30 19:13:28'),
(10, 'qwe', 'Birthday', 178, 'Screenshot from 2018-09-11 15-47-41.png', 'qwe qwqwe', '2018-09-30 19:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cake_id` int(100) NOT NULL,
  `order_user_id` int(100) NOT NULL,
  `order_cake_size` varchar(100) DEFAULT NULL,
  `order_cake_status_admin` tinyint(1) DEFAULT NULL,
  `order_cake_status_user` tinyint(1) DEFAULT NULL,
  `order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cake_id`, `order_user_id`, `order_cake_size`, `order_cake_status_admin`, `order_cake_status_user`, `order_created_at`) VALUES
(22, 8, 1, NULL, NULL, NULL, '2018-10-07 13:02:41'),
(23, 8, 2, '1', NULL, 0, '2018-10-07 13:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) DEFAULT NULL COMMENT '1 for admin',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'salman', 'salman@salman.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2018-09-28 20:56:33'),
(2, 'salmans_bayt', 'salman@salmasadn.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, '2018-10-06 14:17:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`cake_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `cake_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
