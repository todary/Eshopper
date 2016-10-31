-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2016 at 05:36 PM
-- Server version: 5.6.27-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(100) NOT NULL,
  `number` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `des` varchar(10000) NOT NULL,
  `parent` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `number`, `name`, `des`, `parent`) VALUES
(12, 3, 'man + man', 'sadasdas', 0),
(13, 5, 'femal', 'sdsfd', 0),
(14, 3, 'asdas', 'sdf', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `des_product` varchar(10000) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `cat_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopp_cart`
--

CREATE TABLE IF NOT EXISTS `shopp_cart` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `birthday` date NOT NULL,
  `job` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `credit` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `birthday`, `job`, `address`, `username`, `email`, `password`, `credit`, `image`, `type`) VALUES
(1, 'abanoub', '1992-02-07', 'programer', 'mina', '', 'todary', '123', '100', '', 1),
(2, 'metyas', '1994-03-19', 'php', 'mina', '', 'mets', '123', '200', '', 0),
(3, 'baker', '1993-10-05', 'php and learing ', 'samalot', '', 'baker', '123', '300', '', 0),
(4, 'btm', '0000-00-00', '', '', '', 'btm', '123', '400', '', 0),
(10, '', '0000-00-00', '', '', '', '', '', '', '', 0),
(11, '', '0000-00-00', '', '', '', 'aa@yahoo.com', '', '', '', 0),
(16, '', '0000-00-00', '', '', '', 'aaa@yahoo.com', '', '', '', 0),
(17, '', '0000-00-00', '', '', '', 'saaa@yahoo.com', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD KEY `parent` (`parent`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `shopp_cart`
--
ALTER TABLE `shopp_cart`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `product_id` (`product_id`), ADD KEY `user_id_2` (`user_id`), ADD KEY `product_id_2` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopp_cart`
--
ALTER TABLE `shopp_cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopp_cart`
--
ALTER TABLE `shopp_cart`
ADD CONSTRAINT `shopp_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `shopp_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
