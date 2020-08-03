-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2020 at 08:01 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GDMGDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `parent_id`, `name`) VALUES
(1, NULL, 'CAT1'),
(2, NULL, 'CAT2'),
(3, NULL, 'CAT3'),
(4, 1, 'CAT1-1'),
(5, 4, 'CAT1-1-1'),
(6, 5, 'CAT1-1-1-1'),
(7, 6, 'CAT1-1-1-1-1'),
(8, 2, 'CAT2-1'),
(9, 8, 'CAT2-1-1'),
(10, 9, 'CAT2-1-1-1'),
(11, 10, 'CAT2-1-1-1-1'),
(12, 2, 'CAT2-2');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`) VALUES
(1, 'product 1', '10.00'),
(2, 'product 2', '20.00'),
(3, 'product 3', '30.00'),
(4, 'product 4', '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `ProductToCategory`
--

CREATE TABLE `ProductToCategory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ProductToCategory`
--

INSERT INTO `ProductToCategory` (`id`, `product_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 3),
(4, 1, 7),
(5, 3, 6),
(6, 3, 8),
(8, 4, 2),
(9, 4, 1),
(10, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_To_Parent_Category` (`parent_id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductToCategory`
--
ALTER TABLE `ProductToCategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_To_Product` (`product_id`),
  ADD KEY `FK_To_Category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ProductToCategory`
--
ALTER TABLE `ProductToCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `FK_To_Parent_Category` FOREIGN KEY (`parent_id`) REFERENCES `Category` (`id`);

--
-- Constraints for table `ProductToCategory`
--
ALTER TABLE `ProductToCategory`
  ADD CONSTRAINT `FK_To_Category` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_To_Product` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
