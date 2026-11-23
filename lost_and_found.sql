-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2026 at 01:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost_and_found`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Bags'),
(2, 'Electronics'),
(3, 'Wallets'),
(4, 'Keys'),
(5, 'Clothing'),
(6, 'School Supplies'),
(7, 'Clothing'),
(8, 'Accessories'),
(9, 'Documents'),
(10, 'Books'),
(11, 'Water Bottles');

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `ClaimID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ClaimDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ClaimDetails` text NOT NULL,
  `PhotoClaim` varchar(255) DEFAULT NULL,
  `Status` enum('Pending','Manual Verification','Approved','Rejected') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`ClaimID`, `ItemID`, `UserID`, `ClaimDate`, `ClaimDetails`, `PhotoClaim`, `Status`) VALUES
(11, 35, 9, '2026-11-22 10:14:43', 'HAHAHAH', '6b013d147f22d4.52397328.png', 'Approved'),
(12, 36, 13, '2026-11-22 08:03:35', 'afasfasdqwqcqwwq', '6b01a71c183612.02733375.jpeg', 'Manual Verification'),
(16, 36, 9, '2026-11-22 00:14:07', 'fafasasfwq', '6b01c34feaf570.77258182.png', 'Pending'),
(17, 37, 9, '2026-11-22 08:05:03', 'assacwqq', '6b025a0fd6f9c8.33173070.png', 'Manual Verification'),
(18, 56, 9, '2026-11-22 16:50:08', 'hocqocqwcbq', NULL, 'Pending'),
(19, 55, 9, '2026-11-22 16:50:12', 'cqcqcqqvq', NULL, 'Pending'),
(20, 54, 9, '2026-11-22 16:50:16', 'cqcqcqvqv', NULL, 'Pending'),
(21, 56, 13, '2026-11-22 17:05:42', 'awqcqcqcq', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `ReportType` enum('Lost','Found') NOT NULL,
  `DateLost` datetime DEFAULT NULL,
  `DateFound` datetime DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Status` enum('Lost','Available','Claimed','Returned') NOT NULL,
  `DateReturned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `UserID`, `CategoryID`, `LocationID`, `ItemName`, `Description`, `ReportType`, `DateLost`, `DateFound`, `Photo`, `Status`, `DateReturned`) VALUES
(26, 21, 1, 1, 'Black Backpack', 'Black backpack with notebooks inside', 'Lost', '2026-11-20 00:00:00', NULL, NULL, 'Lost', NULL),
(27, 22, 2, 2, 'Blue Water Bottle', 'Blue water bottle with a sticker', 'Lost', '2026-11-20 00:00:00', NULL, NULL, 'Returned', NULL),
(30, 13, 2, 1, 'af qwfqqc', 'aqwqcqqwcq', 'Lost', '2026-11-17 00:00:00', NULL, '6b011b26ae7d47.39277903.jpeg', 'Lost', NULL),
(34, 9, 3, 2, 'afqwqw', 'HAHAHAH', 'Lost', '2026-11-04 00:00:00', NULL, '6b012b90ecd650.68619791.png', 'Returned', NULL),
(35, 9, 2, 2, 'Blue backpack', 'acqwqcwqdwqw', 'Found', NULL, '2026-11-09 00:00:00', '6b01383baa14f4.52009336.png', 'Available', NULL),
(36, 9, 2, 1, 'RED BACKPACK', 'aaqwqcq', 'Found', NULL, '2026-11-19 00:00:00', '6b013a2f210d49.31002668.png', 'Available', NULL),
(37, 9, 3, 2, 'afafw', 'afaasasfa', 'Found', NULL, '2026-11-25 00:00:00', '6b019799b12434.27220011.png', 'Available', NULL),
(38, 9, 3, 2, 'Black wallet', '12345', 'Lost', '2026-11-09 00:00:00', NULL, '6b01d027511f75.42284627.png', 'Returned', NULL),
(39, 9, 2, 3, 'afacascac', 'aascascw', 'Lost', '2026-11-12 00:00:00', NULL, NULL, 'Lost', NULL),
(40, 13, 2, 1, 'afwqwqw', 'awqqwq', 'Lost', '2026-11-22 00:00:00', NULL, '6b028104db1d20.86148318.jpeg', 'Lost', NULL),
(41, 13, 2, 2, 'awqqwqw', 'aasqwcqw', 'Lost', '2026-11-22 00:00:00', NULL, '6b028405d28c97.71656685.jpeg', 'Lost', NULL),
(44, 13, 3, 2, 'aaxca', 'cacaa', 'Lost', '2026-11-22 07:08:52', NULL, NULL, 'Lost', NULL),
(50, 11, 1, 3, 'aqwqw', 'aqwcqw', 'Found', NULL, '2026-11-22 07:36:19', '6b028d633fc273.96495979.png', 'Available', NULL),
(51, 9, 1, 2, 'aaqwcqwc', 'acqwcqwcqw', 'Lost', '2026-11-22 09:43:49', NULL, '6b02ab45ca88f6.85725249.png', 'Lost', NULL),
(52, 9, 3, 2, 'aqwqwcqw', 'aqwcqwcqw', 'Lost', '2026-11-22 09:44:08', NULL, NULL, 'Lost', NULL),
(53, 9, 3, 2, 'aqwwqqw', 'aqwcqwq', 'Lost', '2026-11-22 09:44:20', NULL, '6b02ab64b9c048.90665569.png', 'Lost', NULL),
(54, 11, 4, 2, 'aqwcqcq', 'qqcqcqcqwc', 'Found', NULL, '2026-11-22 09:48:21', '6b02ac555a07b2.74221444.png', 'Available', NULL),
(55, 11, 3, 2, 'cqwcqcqcq', 'acqcqcqwc', 'Found', NULL, '2026-11-22 09:48:37', '6b02ac65487c46.72806125.png', 'Available', NULL),
(56, 11, 3, 1, 'acqwcqwcwv', 'qcqcqcqc', 'Found', NULL, '2026-11-22 09:48:57', '6b02ac7979ded3.73384377.png', 'Available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`) VALUES
(1, 'Library'),
(2, 'Canteen'),
(3, 'Office'),
(4, 'Computer Laboratory'),
(5, 'Classroom'),
(6, 'School Gymnasium'),
(7, 'Comfort Room'),
(8, 'School Grounds');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `fullname` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('User','Admin') NOT NULL DEFAULT 'User',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `fullname`, `email`, `password_hash`, `role`, `created_at`) VALUES
(9, 'john doe', 'john@gmail.com', '$2y$10$dZmCnU8xMgkzDJZZ0sGXZO/klk1VcHY4LYnPn993ESR1WQmUis4Be', 'User', '2026-11-09 13:47:41'),
(11, 'System Administrator', 'Administrator@lostandfound.com', '$2y$10$kbH/D/qoXRAkYOcioyZVrO1jeJWE8ooCmuBeqd.tG1oEv7URde.UW', 'Admin', '2026-11-09 16:00:39'),
(12, 'she', 'she@gmail.com', '$2y$10$pGdDYauO15954kPJNRBrFuMe5qp80oO9L9E0cccwrUIXNW8CfcSCG', 'User', '2026-11-15 13:54:55'),
(13, 'SEI', 'sei@90', '$2y$10$4rIKWWt84BfgiJmffVrtrO.Q.VFbMzecTkfzvZsd/uV2RHka7uGCO', 'User', '2026-11-20 13:02:51'),
(20, 'Brix Daus', 'brixdaus@gmail.com', 'password', 'Admin', '2026-11-20 14:35:10'),
(21, 'Nhecos', 'nhecos@gmail.com', 'password', 'User', '2026-11-20 14:35:10'),
(22, 'John', 'johnhumphrey@gmail.com', 'password', 'User', '2026-11-20 14:35:10'),
(23, 'HAHAHA', 'haahahah@123', '$2y$10$43G3WtAYTHtDipvWVwi8bOw.WkIf4LTzJ7CZtuvX7rmMBi1kiL6Oe', 'User', '2026-11-22 09:24:44'),
(24, 'LALA', 'lalla@123', '$2y$10$9gYcVkaOGK2bqPvmtHE/POk9X79Y2.yrvYayb3inbvX..a8SH.QPK', 'User', '2026-11-22 09:25:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`ClaimID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `LocationID` (`LocationID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `ClaimID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim`
--
ALTER TABLE `claim`
  ADD CONSTRAINT `claim_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `claim_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`),
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
