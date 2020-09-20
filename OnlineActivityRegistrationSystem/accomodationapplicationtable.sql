-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 01:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

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
-- Table structure for table `accomodationapplicationtable`
--

CREATE TABLE `accomodationapplicationtable` (
  `applicationNo` int(254) NOT NULL,
  `date` datetime NOT NULL,
  `ID` varchar(9) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accomodationapplicationtable`
--

INSERT INTO `accomodationapplicationtable` (`applicationNo`, `date`, `ID`, `from`, `to`, `reason`, `status`) VALUES
(66, '2020-06-18 10:31:21', 'WIF180064', '2020-06-18', '2020-06-26', 'Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons Reasons ', 'Approved'),
(67, '2020-06-18 10:42:38', 'WIF180064', '2020-06-18', '2020-06-19', 'Reasons ', 'Rejected'),
(68, '2020-06-18 10:44:13', 'WIF180064', '2020-07-14', '2020-07-21', 'many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts many texts ', 'Pending'),
(69, '2020-06-18 10:44:44', 'WIF180064', '2020-07-13', '2020-07-14', 'Reasons  Reasons  Reasons Reasons Reasons s11', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomodationapplicationtable`
--
ALTER TABLE `accomodationapplicationtable`
  ADD PRIMARY KEY (`applicationNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodationapplicationtable`
--
ALTER TABLE `accomodationapplicationtable`
  MODIFY `applicationNo` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
