-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 07:42 PM
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
-- Table structure for table `academictable`
--

CREATE TABLE `academictable` (
  `ID` varchar(9) NOT NULL,
  `Faculty` varchar(254) DEFAULT NULL,
  `Course` varchar(254) DEFAULT NULL,
  `EntryYear` int(4) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `Duration` varchar(9) DEFAULT NULL,
  `Mode` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academictable`
--

INSERT INTO `academictable` (`ID`, `Faculty`, `Course`, `EntryYear`, `Duration`, `Mode`) VALUES
('WIF180078', NULL, NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `activitytable`
--

CREATE TABLE `activitytable` (
  `ID` varchar(9) NOT NULL,
  `Year` int(11) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Activity 1` varchar(254) DEFAULT '-',
  `Activity 2` varchar(254) DEFAULT '-',
  `Activity 3` varchar(254) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contacttable`
--

CREATE TABLE `contacttable` (
  `ID` varchar(9) NOT NULL,
  `Address` varchar(254) DEFAULT NULL,
  `Postcode` int(5) UNSIGNED ZEROFILL NULL DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(30) DEFAULT NULL,
  `Phone` int(11) UNSIGNED ZEROFILL NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacttable`
--

INSERT INTO `contacttable` (`ID`, `Address`, `Postcode`, `City`, `State`, `Phone`) VALUES
('WIF180078', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personaltable`
--

CREATE TABLE `personaltable` (
  `ID` varchar(9) NOT NULL,
  `ProfilePicture` longblob DEFAULT NULL,
  `NewMatrics` varchar(10) DEFAULT NULL,
  `IC` varchar(20) DEFAULT NULL,
  `Nationality` varchar(13) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Birthday` varchar(254) DEFAULT NULL,
  `Race` varchar(10) DEFAULT NULL,
  `Religion` varchar(12) DEFAULT NULL,
  `Marital` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personaltable`
--

INSERT INTO `personaltable` (`ID`, `ProfilePicture`, `NewMatrics`, `IC`, `Nationality`, `Gender`, `Birthday`, `Race`, `Religion`, `Marital`) VALUES
('WIF180049', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('WIF180078', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `ID` int(11) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` varchar(9) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Email`, `Name`, `Password`) VALUES
('WIF180049', 'WIF180049@SISWA.UM.EDU.MY', 'NATHANIEL ONG YII TAK', '82a4dfdccd1dc4e98cc4099d20e0279565b96d579b5cc708ae30ea11f1bda8b7'),
('WIF180078', 'WIF180078@SISWA.UM.EDU.MY', 'YAP JING HONG', '696b3807c724f5c3acc975f506a116753d7d76abb86f2b685ae36859dd4ae364');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academictable`
--
ALTER TABLE `academictable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UA_ID` (`ID`);

--
-- Indexes for table `accomodationapplicationtable`
--
ALTER TABLE `accomodationapplicationtable`
  ADD PRIMARY KEY (`applicationNo`);

--
-- Indexes for table `activitytable`
--
ALTER TABLE `activitytable`
  ADD PRIMARY KEY (`ID`,`Year`,`Semester`),
  ADD UNIQUE KEY `UP_ID` (`ID`,`Year`,`Semester`);

--
-- Indexes for table `contacttable`
--
ALTER TABLE `contacttable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UCON_ID` (`ID`);

--
-- Indexes for table `personaltable`
--
ALTER TABLE `personaltable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UP_ID` (`ID`);

--
-- Indexes for table `report_table`
--
ALTER TABLE `report_table`
  ADD PRIMARY KEY (`reportno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodationapplicationtable`
--
ALTER TABLE `accomodationapplicationtable`
  MODIFY `applicationNo` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `report_table`
--
ALTER TABLE `report_table`
  MODIFY `reportno` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
