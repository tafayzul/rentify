-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentify`
--

-- --------------------------------------------------------

--
-- Table structure for table `interested`
--

CREATE TABLE `interested` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interested`
--

INSERT INTO `interested` (`id`, `user_id`, `property_id`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `hospitals_nearby` varchar(255) DEFAULT NULL,
  `colleges_nearby` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `title`, `description`, `bedrooms`, `bathrooms`, `area`, `place`, `hospitals_nearby`, `colleges_nearby`, `likes`) VALUES
(1, 1, 'New Bulding', 'Very Nice', 2, 1, '1200', 'Hyd', 'new', 'old', 3),
(2, 1, 'Pathan Manzil', '2 Floor Bulding with New Furtnutre', 3, 2, '1200 Sq Foor', 'Hyderabad', 'Salman', 'Osmania', 0),
(3, 4, 'Pathan Manzil 2', 'Very Nice Property', 1, 1, '100 Sq Foot', 'MH', 'City', 'City', 0),
(4, 4, 'Pathan Manzil 2', 'Very Nice Property', 1, 1, '100 Sq Foot', 'MH', 'City', 'City', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('seller','buyer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `user_type`) VALUES
(1, 'Seller 1', 'Selling', 'seller@gmail.com', '93475 70380', '$2y$10$YMmUbXQ70SqSXGMvSXzu5O9/NOjDtfpS45Jnm7YhbRUgAuN/v5yM.', 'seller'),
(3, 'Buyer 1', 'Buying', 'buyer@gmail.com', '6303052334', '$2y$10$HWSGEPrgtsFJ6gl/Pn5Vquc5NDpeyyZXhcA.M4mfmr6cfIgQTDvlC', 'buyer'),
(4, 'Tafayzul ', 'Pathan', 'tafayzulpathan2@gmail.com', '7769074175', '$2y$10$sDd.zQB5uXPzH8UHrsINH.2cMlWwDZCWWyK8hq0ca6rREq6zIwhmO', 'seller'),
(5, 'Tafayzul Buyer', 'Pathan', 'tafayzulpathan2@yahoo.com', '1234567890', '$2y$10$4G9CQ9xhSGCF/G2LxkPBH.VcFHwwMH5NWWa5XzHclpi1mFSRxSJY2', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `interested`
--
ALTER TABLE `interested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interested`
--
ALTER TABLE `interested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interested`
--
ALTER TABLE `interested`
  ADD CONSTRAINT `interested_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `interested_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
