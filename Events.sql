-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 01:21 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tennisevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(4) NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `event_date` datetime NOT NULL,
  `event_location` int(4) NOT NULL,
  `event_host_id` int(4) NOT NULL,
  `event_description` mediumtext COLLATE utf8mb4_bin,
  `event_price` int(4) DEFAULT NULL,
  `event_age_restriction` int(2) DEFAULT NULL,
  `event_image_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_location`, `event_host_id`, `event_description`, `event_price`, `event_age_restriction`, `event_image_id`) VALUES
(1, 'tennis match MARS 2020', '2019-03-12 00:00:00', 1, 1, 'Just a nice tennis match under sun.', 2500, 18, 0),
(2, 'Tenns KarlsKrona cup', '2020-05-14 14:22:00', 2, 2, 'Just another single match in KarlsKrona town in IdrottsKlubhall under sun.', 300, 20, 0),
(3, 'Football', '2020-02-01 06:00:00', 2, 1, 'Football match summer 2021', 500, 18, 0),
(4, 'Gdansk tennis match', '2020-10-01 14:30:00', 6, 3, 'Some amazing fall Wimbledon match in beautiful Gdansk - ', 250, 22, 0),
(5, 'Footballs Tehran', '2020-04-02 12:00:00', 8, 4, 'Footbal match in  Tehran ', 500, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `guest_list`
--

CREATE TABLE `guest_list` (
  `response_id` int(6) NOT NULL,
  `event_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `is_user_going_to_event` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `loc_id` int(4) NOT NULL,
  `street` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(2) COLLATE utf8mb4_bin NOT NULL,
  `zip` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`loc_id`, `street`, `city`, `state`, `zip`) VALUES
(1, 'Kungengatan 88', 'Sollentuna', 'St', 19161),
(2, 'Duvbovägen 3G', 'karls', 'Ka', 14205),
(3, 'Kungengatan 88', 'Sollentuna', 'St', 19161),
(4, 'Duvbovägen 3G', 'karls', 'Ka', 14205),
(5, 'Graniczna 32a ', 'Gdansk', 'Po', 40018),
(6, 'Graniczna 32a ', 'Gdansk', 'Po', 40018),
(7, 'Tehran vägen', 'Tehran', 'Te', 12365),
(8, 'Tehran vägen', 'Tehran', 'Te', 12365);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `event_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `date` date NOT NULL,
  `ticket_pin` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `ticket_holder` int(50) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_bin NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event_name`, `date`, `ticket_pin`, `ticket_holder`, `status`) VALUES
(400, '4', '0000-00-00', '7963', 1, 'Used'),
(401, '4', '0000-00-00', '0911', 1, 'pending'),
(402, '4', '0000-00-00', '6669', 1, 'pending'),
(403, '4', '0000-00-00', '1702', 1, 'pending'),
(404, '4', '0000-00-00', '3472', 1, 'pending'),
(405, '4', '0000-00-00', '5519', 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `user_username` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `user_fullname` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `user_pin` int(4) NOT NULL,
  `user_age` int(3) NOT NULL,
  `user_bio` mediumtext COLLATE utf8mb4_bin,
  `user_pic` int(6) DEFAULT NULL,
  `user_twitter` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL,
  `user_facebook` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_fullname`, `user_pin`, `user_age`, `user_bio`, `user_pic`, `user_twitter`, `user_facebook`) VALUES
(1, 'amrosoliman', 'Amro Soliman', 12345, 30, 'IT student', 0, 'lkvj/twitter.com', 'vkmke/facebook.com'),
(2, 'testuser88', 'Test Uerr', 445678, 32, 'Engenir', 0, 'kjk/twitter.com', 'mhkjk/facebook.com'),
(3, 'Aneta', 'Aneta Cimimrska', 4569, 20545, NULL, 0, NULL, NULL),
(4, 'Javad', 'Javad Imami', 3535, 20, 'mjkjk', NULL, NULL, NULL),
(5, 'Javad', 'Javad Imami', 3535, 20, 'mjkjk', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guest_list`
--
ALTER TABLE `guest_list`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guest_list`
--
ALTER TABLE `guest_list`
  MODIFY `response_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `loc_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
