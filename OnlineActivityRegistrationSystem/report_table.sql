-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 04:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_activity_registration_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `report_table`
--

CREATE TABLE `report_table` (
  `reportno` int(254) NOT NULL,
  `ID` varchar(9) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `Title` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `status` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_table`
--

INSERT INTO `report_table` (`reportno`, `ID`, `Location`, `Title`, `Type`, `Description`, `status`) VALUES
(1, 'WIF180078', 'Block B Wing A', 'Dirty toilet', 'Toilet Issue', 'Unflushable and caused disgusting smell', 'Completed'),
(2, 'WIF180078', 'Parking Slot in front of kk', 'Stranger appears', 'Safety issue', 'Dark shadow appears outside the parking area during midnight', 'In Progress'),
(3, 'WIF180078', 'B332', 'Fan malfunction', 'Appliances issue', 'Fan is not working', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report_table`
--
ALTER TABLE `report_table`
  ADD PRIMARY KEY (`reportno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report_table`
--
ALTER TABLE `report_table`
  MODIFY `reportno` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
