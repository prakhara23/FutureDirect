-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2015 at 12:52 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `futuredirectdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `product_id` int(11) NOT NULL,
  `total_units_sold` int(11) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
`id` int(11) NOT NULL,
  `lastname` text NOT NULL,
  `firstname` text NOT NULL,
  `credit card number` text NOT NULL,
  `credit card date` int(4) NOT NULL,
  `username` text NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL,
  `subtotal` text NOT NULL,
  `tax` text NOT NULL,
  `total` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `picture`) VALUES
(1, 'PlayStation 3 500GB Assassin''s Creed III Bundle', 'It Only Does Everything!', 249, 'product1.jpg'),
(2, 'PlayStation 4 500GB Bundle', 'It is a PS4!', 399, 'product2.jpg'),
(3, 'XBOX 360 250GB Matte Console', 'It is a 360!', 299, 'product3.jpg'),
(4, 'XBOX ONE with Kinect ', 'It is a XBox!', 499, 'product4.jpg'),
(5, 'HTC One Smartphone - Silver', 'The HTC One is an ultra thin and sleek smartphone that runs on Android 4.2 Jelly Bean to give you an incredibly smooth and powerful experience. \n<br>\nThe 4.7" SoLux touchscreen makes graphics and texts and out in ultra sharp Full HD, while awesome features like BoomSound,\nHTCZOE, Full HD video recording, and BlinkFeed make life on the go even more fun.', 550, 'product5.jpg'),
(6, 'Samsung Galaxy S4 Smartphone - Black', 'Just when you thought smartphones couldn''t get any more amazing, the Samsung Galaxy S4 arrives. Beyond the gorgeous 5-inch display that lets you enjoy Full HD visuals, this ultra-thin genius features Dual Cameras with super-smart functions, Multi Window, and Air View with Smart Gestures. And that''s just the beginning.', 650, 'product6.jpg'),
(7, ' LG Nexus 4 Smartphone', 'The Google Nexus 4 smartphone is effortlessly cool. Powered by Android and a Qualcomm Snapdragon S4 Pro processor, you get the speed and performance you need to zip around the web, enjoy 3D graphics and games, and multitask with ease. Create incredible Photo Spheres that capture your world in a dimension you''ve never seen before.', 399, 'product7.jpg'),
(8, 'Lenovo IdeaPad Y510 Laptop ', 'Intel Core i7-3630QM Processor (2.4 GHz)\n<br>\n8 GB DDR3 RAM\n<br>\n1 TB 5400 rpm Hard Drive\n<br>\n15.6-Inch Screen, NVIDIA Dual SLI GT650M\n<br>\nWindows 8, 3-hour battery life', 869, 'product8.png'),
(9, 'Alienware M14x R2 AM14XR2-7223BK 14.0-Inch Laptop', '3rd Generation Intel Core i7-3630QM Processor(3.4GHz)\n<br>\n8 GB DDR3 RAM\n<br>\n750 GB 7200 rpm Hard Drive\n<br>\n14.0-Inch Screen\n<br>\nWindows 8', 1328, 'product9.jpg'),
(10, 'ASUS Republic of Gamers G75VW-AH71 17.3-Inch Gaming Laptop', 'Intel Core i7-3610QM Quad-core 2.3GHz Processor\n<br>\n8 GB DDR3\n<br>\n750 GB 7200 rpm Hard Drive\n<br>\n17.3-Inch Full-HD LED Screen, Nvidia GTX \n660M 2G GDDR5 Graphics\n<br>\nWindows 8', 1349, 'product10.jpg'),
(11, 'Apple MacBook Pro ME665LL/A 15.4-Inch Laptop with Retina Display ', '2.7 GHz Quad-Core Intel Core i7 Processor with Turbo Boost up to 3.7 GHz\n<br>\n16 GB 1600MHz DDR3L Memory\n<br>\n512 GB Flash Storage\n<br>\n15.4-inch Retina Display; 2880x1800 \nResolution; \n<br>\nNVIDIA GeForce GT 650M Graphics\n<br>\nMac OS X v10.7 Lion, 7 Hour Battery Life', 2629, 'product11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
