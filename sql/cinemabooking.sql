-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 01:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemabooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `mailsubscribers`
--

CREATE TABLE `mailsubscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailsubscribers`
--

INSERT INTO `mailsubscribers` (`id`, `email`) VALUES
(19, ''),
(18, 'wissem'),
(17, 'wissem.zidi.ofc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pic` varchar(10000) NOT NULL,
  `seats` varchar(400) NOT NULL,
  `showDate` date DEFAULT NULL,
  `genres` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `pic`, `seats`, `showDate`, `genres`) VALUES
(1, 'Jocker', 'Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Arthur wears two masks the one he paints for his day job as a clown, and the guise he projects in a futile attempt to feel like he\'s part of the world around him. Isolated, bullied', 'https://cdn11.bigcommerce.com/s-ydriczk/images/stencil/1280x1280/products/89058/93685/Joker-2019-Final-Style-steps-Poster-buy-original-movie-posters-at-starstills__62518.1669120603.jpg?c=2', 'A1|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-04-15', 'love|crime'),
(2, 'The Witcher', 'Witchers are once-normal humans who got mutated by a combination of medieval science and magic, which made them superhuman (more Captain America than Superman) and able to take potions too toxic for normal people.', 'data:image/jpeg;base64,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', 'A1|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-04-28', 'love|crime');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `userId` int(11) NOT NULL,
  `movieId` int(11) NOT NULL,
  `datePurchase` datetime NOT NULL,
  `seat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`userId`, `movieId`, `datePurchase`, `seat`) VALUES
(6, 1, '2023-04-15 01:04:29', 'A3'),
(6, 1, '2023-04-15 01:04:18', 'B6'),
(6, 2, '2023-04-15 01:04:32', 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(6, 'wissem', 'wissem@gmail.com', '12345678'),
(7, 'wissem', 'wissem@wissem.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mailsubscribers`
--
ALTER TABLE `mailsubscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`movieId`,`seat`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`),
  ADD KEY `datePurchase` (`datePurchase`),
  ADD KEY `seat` (`seat`);

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
-- AUTO_INCREMENT for table `mailsubscribers`
--
ALTER TABLE `mailsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
