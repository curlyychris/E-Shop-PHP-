-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 03:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_acsc476`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productsID` int(11) NOT NULL,
  `pName` varchar(255) NOT NULL,
  `pDescription` longtext NOT NULL,
  `pNutritionFacts` longtext NOT NULL,
  `pPrice` float NOT NULL,
  `pImage` text NOT NULL,
  `pTimeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fksellerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productsID`, `pName`, `pDescription`, `pNutritionFacts`, `pPrice`, `pImage`, `pTimeStamp`, `fksellerID`) VALUES
(17, 'Classic Cheesburger', 'This burger starts with a toasted sesame seed bun, wrapped around a perfectly seasoned, mouth-watering hamburger, topped with your favorite cheese, crisp onion, lettuce, juicy tomato, pickles, ketchup, and mustard! ', 'Provides no sugar and it is a good source of iron, vitamin B6 and B12.', 10, 'burger.jpg', '2022-12-23 10:51:30', 14),
(28, 'Curly Fries', 'test', 'seller2', 5, 'logo.jpg', '2022-12-23 22:24:46', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(255) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`) VALUES
(13, 'Christy', 'christy@gmail.com', '123', 'Customer'),
(14, 'seller test', 'seller@gmail.com', 'seller', 'Seller'),
(15, 'seller two', 'seller2@gmail.com', 'seller', 'Seller'),
(16, 'alexander Great', 'alexander@gmail.com', '123', 'Seller');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `fkproductID` int(11) NOT NULL,
  `fkuserID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `fkproductID`, `fkuserID`, `quantity`) VALUES
(25, 28, 13, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productsID`),
  ADD KEY `fksellerID` (`fksellerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD KEY `fkproductID` (`fkproductID`),
  ADD KEY `fkuserID` (`fkuserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`fksellerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`fkproductID`) REFERENCES `products` (`productsID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`fkuserID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
