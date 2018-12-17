-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2018 at 05:43 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ridealongdb`
--
CREATE DATABASE IF NOT EXISTS `ridealongdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ridealongdb`;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_rating` int(11) NOT NULL,
  `trips_completed` int(11) NOT NULL,
  `trips_cancelled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `driver_id`, `driver_rating`, `trips_completed`, `trips_cancelled`) VALUES
(19, 23, 0, 0, 0);

--
-- Triggers `driver`
--
DELIMITER $$
CREATE TRIGGER `new_passanger_added` AFTER INSERT ON `driver` FOR EACH ROW INSERT INTO passanger (passenger_id, passenger_rating, p_trips_cancelled, p_trips_completed, trip_reserved)
    VALUES ((SELECT MAX(id) FROM users), 0, 0, 0, NULL)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `passanger`
--

CREATE TABLE `passanger` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `passenger_rating` int(11) NOT NULL,
  `p_trips_completed` int(11) NOT NULL,
  `p_trips_cancelled` int(11) NOT NULL,
  `trip_reserved` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`id`, `passenger_id`, `passenger_rating`, `p_trips_completed`, `p_trips_cancelled`, `trip_reserved`) VALUES
(13, 23, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `trip_start_date` date NOT NULL,
  `trip_start_time` time NOT NULL,
  `trip_from` varchar(32) NOT NULL,
  `trip_to` varchar(32) NOT NULL,
  `price` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `driver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(32) NOT NULL,
  `l_name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `gender`, `password`) VALUES
(23, 'Laurynas', 'Kirdeika', 'laurynas@kirdeika.lt', 'male', '$2y$10$Vi1MGdS5gLSzm5Ke5JTVT.rt0PtJ5j.pY4ADlRoTjYPQ1Z.zcGN6i');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `new_user_added` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO driver (driver_id, driver_rating, trips_cancelled, trips_completed)
	VALUES ((SELECT MAX(id) FROM users), 0, 0, 0)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `driver_rating` (`driver_rating`);

--
-- Indexes for table `passanger`
--
ALTER TABLE `passanger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_reserved` (`trip_reserved`),
  ADD KEY `passenger_id_constraint` (`passenger_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id_constraint` (`driver`),
  ADD KEY `driver_rating_constraint` (`rating`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `passanger`
--
ALTER TABLE `passanger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `passanger`
--
ALTER TABLE `passanger`
  ADD CONSTRAINT `passenger_id_constraint` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_reserved` FOREIGN KEY (`trip_reserved`) REFERENCES `trips` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `driver_id_constraint` FOREIGN KEY (`driver`) REFERENCES `driver` (`driver_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_rating_constraint` FOREIGN KEY (`rating`) REFERENCES `driver` (`driver_rating`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;