-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 10:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
CREATE DATABASE `cinemabooking`;
USE `cinemabooking`;
-- Database: `cinemabooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `access` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `access`) VALUES
(32, 'wissem', 'wissem@gmail.com', '$2y$10$KdaIfGY8ZCmt.PzOdpVTzO.1Mdiij/pNXEuKdLOSiiiY0IUtrGwuq', 3),
(33, 'admin', 'admin@admin.com', '$2y$10$YQlF1i9kma2uA9VE5Ot9.u/.FX3q.7BBcfonByqOtdd4x/1iM.RDu', 1);

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
(24, 'dfqdsfqsdf'),
(18, 'wissem'),
(20, 'wissem@gmail.com');

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
  `showDate` datetime DEFAULT NULL,
  `genres` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `pic`, `seats`, `showDate`, `genres`) VALUES
(1, 'Jocker', 'Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Arthur wears two masks the one he paints for his day job as a clown, and the guise he projects in a futile attempt to feel like he\'s part of the world around him. Isolated, bullied', 'https://cdn11.bigcommerce.com/s-ydriczk/images/stencil/1280x1280/products/89058/93685/Joker-2019-Final-Style-steps-Poster-buy-original-movie-posters-at-starstills__62518.1669120603.jpg?c=2', 'A1|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-04-15 00:00:00', 'love|crime'),
(2, 'Beauty and the beast', 'A French fairy tale about a beautiful and gentle young woman who is taken to live with a man-beast in return for a good deed the Beast did for her father. Beauty is kind to the well-mannered Beast but pines for her family until the Beast allows her to visit them.', 'https://media1.popsugar-assets.com/files/thumbor/z5oKgNC9S4DS6Bay78Aoy5aLO4s/fit-in/728xorig/filters:format_auto-!!-:strip_icc-!!-/2017/01/26/813/n/1922283/055dc333c3280d59_BeautyAndTheBeast58726d5b9fac8/i/Beauty-Beast-2017-Movie-Posters.jpg', 'A1|A2|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-04-30 00:00:00', 'love|drama|thrill'),
(3, 'Iron Man', 'Iron Man is a fictional superhero who wears a suit of armor. His alter ego is Tony Stark. He was created by Stan Lee, Jack Kirby and Larry Lieber for Marvel Comics in Tales of Suspense #39 in the year 1963 and appears in their comic books. He is also one of the main protagonists in the Marvel Cinematic Universe.', 'https://media.comicbook.com/2017/10/iron-man-movie-poster-marvel-cinematic-universe-1038878.jpg', 'A1|A1|A2|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-04-29 00:00:00', 'superpower|action|war|adventure'),
(4, 'Black Panther', 'Black panthers are large felines which come from the big cat family. They have strong and flexible bodies, long tails which give them good balance, and they are powerful hunters with their sharp teeth and claws. Contrary to popular belief, the black panther is not an individual species of cat.', 'https://www.washingtonpost.com/graphics/2019/entertainment/oscar-nominees-movie-poster-design/img/black-panther-web.jpg', 'A1|A2|A2|A3|A4|A5|A6|B1|B2|B3|B4|B5|B6', '2023-05-15 00:00:00', 'action|thriller|war|superhero|adventure');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `img`) VALUES
(16, 'username', 'user@user.com', '$2y$10$raEEJg7/n4iEf.ei.NV92OOmFKeTXfq3CkbsjfpcpQxRh7HIYOOai', 'PP-6446cd448f82c6.15702879.png'),
(17, 'wissem', 'wissem@gmail.com', '$2y$10$Y3foHfM135xTHk.1.ONbaOTXFF6Xb1oLGyJxG2EEVOH5bMzsU6XzS', 'PP-6446cc480453d4.68380220.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mailsubscribers`
--
ALTER TABLE `mailsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
