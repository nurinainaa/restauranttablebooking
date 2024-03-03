-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 03:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantdb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(101, 'HazeRiNa', '130504');

-- --------------------------------------------------------

--
-- Table structure for table `availabletables`
--

CREATE TABLE `availabletables` (
  `mejaid` int(11) NOT NULL,
  `number_of_seats` int(11) NOT NULL,
  `tblstatus` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availabletables`
--

INSERT INTO `availabletables` (`mejaid`, `number_of_seats`, `tblstatus`) VALUES
(1, 2, 'available'),
(2, 2, 'available'),
(3, 2, 'available'),
(4, 2, 'available'),
(5, 2, 'available'),
(6, 3, 'available'),
(7, 3, 'available'),
(8, 3, 'available'),
(9, 3, 'unavailable'),
(10, 3, 'unavailable'),
(11, 4, 'available'),
(12, 4, 'available'),
(13, 4, 'available'),
(14, 4, 'available'),
(15, 4, 'available'),
(16, 5, 'available'),
(17, 5, 'available'),
(18, 5, 'available'),
(19, 5, 'available'),
(20, 6, 'available'),
(21, 6, 'available'),
(22, 6, 'available'),
(23, 6, 'available'),
(24, 6, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

CREATE TABLE `bookingdetails` (
  `id` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `mejaid` int(11) DEFAULT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`id`, `customerid`, `booking_date`, `booking_time`, `mejaid`, `price`) VALUES
(55, 696, '2024-03-05', '09:54:00', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `customerdetails`
--

CREATE TABLE `customerdetails` (
  `customerid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerdetails`
--

INSERT INTO `customerdetails` (`customerid`, `name`, `phone`, `email`) VALUES
(695, 'Nurin Aina Saffiya', '0163749087', 'nurinaina0504@gmail.com'),
(696, 'Intan', '0190284299', 'intanliyana08@gmail.com'),
(697, '', '', ''),
(698, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payid` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availabletables`
--
ALTER TABLE `availabletables`
  ADD PRIMARY KEY (`mejaid`);

--
-- Indexes for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `mejaid` (`mejaid`);

--
-- Indexes for table `customerdetails`
--
ALTER TABLE `customerdetails`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `availabletables`
--
ALTER TABLE `availabletables`
  MODIFY `mejaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `customerdetails`
--
ALTER TABLE `customerdetails`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=699;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD CONSTRAINT `fk_customerid` FOREIGN KEY (`customerid`) REFERENCES `customerdetails` (`customerid`),
  ADD CONSTRAINT `fk_mejaid` FOREIGN KEY (`mejaid`) REFERENCES `availabletables` (`mejaid`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `bookingdetails` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
