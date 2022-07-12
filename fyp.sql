-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 02:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--
CREATE DATABASE IF NOT EXISTS `fyp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fyp`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `username`, `password`, `name`, `email`, `phone`, `user_type`) VALUES
(2, 'admin1', '$2y$10$PzVZrvMbbN8/ANiT2.9OBu2j1/exOdblgYA.l8UF/NHAC2Q7Y/5Aq', 'Test', 'test@mail.com', 98765432, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `staff_ID` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_description` varchar(255) NOT NULL,
  `booking_type` varchar(20) NOT NULL,
  `booking_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_ID`, `company_ID`, `homeowner_ID`, `staff_ID`, `booking_date`, `booking_description`, `booking_type`, `booking_status`) VALUES
(3, 3, 2, NULL, '2022-06-30', 'Pipes Broken', 'problem', 'In Progress'),
(25, 2, 3, NULL, '2022-10-05', 'testing booking', 'problem', 'In Progress'),
(26, 1, 3, NULL, '2022-07-27', 'asd', 'problem', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `case_ID` int(11) NOT NULL,
  `case_subject` varchar(30) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `case_date` varchar(15) NOT NULL,
  `case_status` varchar(10) NOT NULL,
  `case_description` varchar(500) NOT NULL,
  `case_reply` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`case_ID`, `case_subject`, `company_ID`, `homeowner_ID`, `case_date`, `case_status`, `case_description`, `case_reply`) VALUES
(24, '123', 1, 2, '2022-06-24', 'Replied', '123', 'hu'),
(25, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(26, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(27, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(31, 'Homeowner 3 problem', 3, 3, '2022-07-05', 'Awaiting', 'Homeowner 3 problem details', NULL),
(32, 'test', 1, 3, '2022-07-05', 'Replied', 'testing', 'Testing Reply\r\n'),
(34, 'asdasd', 2, 3, '2022-07-05', 'Awaiting', 'test', NULL),
(35, 'test', 2, 3, '2022-07-05', 'Awaiting', 'test', NULL),
(36, 'test', 2, 5, '2022-07-12', 'Awaiting', 'Hello', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `description`, `user_type`, `suspended`, `verified`) VALUES
(1, 'company1', '$2y$10$0AJV74vgbUUuNMg6kaUSh.dINaglwMnDBc8KtrbC.8ch5TAHTFlD.', 'Company One', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2191', 123942, 'test', 'company', 0, 0),
(2, 'company2', '$2y$10$N/4f/SnOelWGRAGKjmiVn.9CMZgCVoVj4PEAtn6cWm9GRLeX4Yo1q', 'Company Two', 'test@mail.com', 98765432, '421 Something Avenue 6 #1-2492', 123942, '', 'company', 0, 0),
(3, 'company3', '$2y$10$QIvZG0d3GxA6DQQllMyBBu0Db21d4Mu1LhSJps2KrxzQeh0s4cHES', 'Company Three', 'company3@sma.net', 98765432, '123 Test Avenue 12 #4-2192', 239423, '', 'company', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_services`
--

CREATE TABLE `company_services` (
  `service_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `price` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_services`
--

INSERT INTO `company_services` (`service_ID`, `company_ID`, `price`) VALUES
(1, 1, NULL),
(2, 1, NULL),
(49, 1, NULL),
(52, 1, NULL),
(2, 2, NULL),
(73, 2, NULL),
(1, 3, NULL),
(2, 3, NULL),
(52, 3, NULL),
(77, 3, NULL),
(78, 3, NULL),
(1, 1, NULL),
(2, 1, NULL),
(49, 1, NULL),
(52, 1, NULL),
(2, 2, NULL),
(73, 2, NULL),
(1, 3, NULL),
(2, 3, NULL),
(52, 3, NULL),
(77, 3, NULL),
(78, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `homeowners`
--

CREATE TABLE `homeowners` (
  `homeowner_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `home_type` varchar(30) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeowners`
--

INSERT INTO `homeowners` (`homeowner_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `home_type`, `user_type`, `suspended`) VALUES
(2, 'homeowner2', '$2y$10$xZglMrSjvQX6OsqgIcHc0en1XGBKRKQD54UNR0VAKbumBjfHHdExq', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'exec', 'homeowner', 0),
(3, 'homeowner5', '$2y$10$BXkqQo2q2zqQPH2HE9ju8OmGO4njqP/WmjEF1y5oMr7bV.yQiZgJe', 'Ang Jing Hian', 'Angjinghian@gmail.com', 97307997, 'Block 511 Ang Mo Kio Avenue 8 #11-2770', 560511, '2room', 'homeowner', 0),
(4, 'homeowner1111', '$2y$10$v4wKpvpubMGqaJKIuJpMQOmoe8B8D8teLdXM1UXcxsBzqIlMAj9x2', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '4room', 'homeowner', 0),
(5, 'homeowner1', '$2y$10$A70oK8EuIeeGvOXv7vNxBOT9HiCDp5c8IcPNIGSUZoxWmHf8zc1ri', 'Mark Lee', 'Marklee@mail.com', 98765432, '421 Test Avenue 122 #64-21', 1239422, 'exec', 'homeowner', 0);

-- --------------------------------------------------------

--
-- Table structure for table `homeowner_services`
--

CREATE TABLE `homeowner_services` (
  `service_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeowner_services`
--

INSERT INTO `homeowner_services` (`service_ID`, `homeowner_ID`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(82, 4),
(1, 2),
(1, 5),
(2, 5),
(85, 5);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_equipment`
--

CREATE TABLE `maintenance_equipment` (
  `equipment_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `equipment_name` varchar(30) NOT NULL,
  `quantity` int(15) NOT NULL,
  `installation_date` varchar(15) NOT NULL,
  `warranty_date` varchar(15) NOT NULL,
  `expiry_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_equipment`
--

INSERT INTO `maintenance_equipment` (`equipment_ID`, `company_ID`, `equipment_name`, `quantity`, `installation_date`, `warranty_date`, `expiry_date`) VALUES
(3, 1, 'iansutarjieq', 4, '2022-06-22', '2022-06-23', '2022-06-10'),
(6, 1, 'eq1', 33, '2022-07-06', '2022-07-14', '2022-07-12'),
(7, 1, 'ianeeqqqq', 1234321, '2022-06-29', '2022-06-30', '2022-07-07'),
(8, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(9, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(19, 2, 'Water Tank', 2, '2022-04-19', '2022-07-14', '2023-04-12'),
(22, 1, 'test', 12, '2022-07-07', '2022-07-06', '2022-07-27'),
(23, 2, 'Reverse Osmosis Filters', 20, '2022-07-04', '2022-09-02', '2024-05-15'),
(25, 2, 'test', 123, '2022-07-05', '2022-07-15', '2022-07-27'),
(26, 2, 'Alkaline Solution', 521, '2022-06-27', '2022-08-05', '2022-10-19'),
(27, 2, 'test11', 123, '2022-07-20', '2022-07-28', '2022-08-03'),
(28, 1, 'Reverse Osmosis Filters', 20, '2022-07-08', '2022-07-29', '2022-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_staff`
--

CREATE TABLE `maintenance_staff` (
  `staff_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `staff_role` varchar(30) NOT NULL,
  `staff_name` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(20) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_staff`
--

INSERT INTO `maintenance_staff` (`staff_ID`, `company_ID`, `staff_role`, `staff_name`, `email`, `phone`, `status`) VALUES
(11, 1, 'Customer Service', 'John Doe', 'jd@mail.sg', 98762521, ''),
(12, 1, 'Plumber', 'Jane Smith', 'js@mail.sg', 46109281, ''),
(16, 1, 'Customer Service', 'Tan Ah Kow', 'TaK@mail.com', 95719243, ''),
(21, 2, 'Customer Service', 'Jing Hian', 'jh@mail.com', 92837621, ''),
(22, 2, 'Plumber', 'John Doe', 'test@mail.com', 12345678, ''),
(23, 1, 'Customer Service', 'John Doe', 'test@mail.com', 12345678, ''),
(24, 1, 'Plumber', 'Jane Smith', 'dsad@mail.com', 98765432, '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_ID` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_ID`, `service_name`) VALUES
(85, ''),
(82, 'aaa'),
(78, 'Customer Service'),
(49, 'Fireworks'),
(77, 'Inspections'),
(2, 'Maintenence'),
(7, 'One'),
(73, 'Parties'),
(52, 'Pipes'),
(1, 'Water Supply');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_ID`),
  ADD KEY `FK_bookings_company_ID` (`company_ID`),
  ADD KEY `FK_bookings_homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_ID`),
  ADD KEY `FK_cases_homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `company_services`
--
ALTER TABLE `company_services`
  ADD KEY `FK_company_services_company_ID` (`company_ID`),
  ADD KEY `FK_company_services_service_ID` (`service_ID`);

--
-- Indexes for table `homeowners`
--
ALTER TABLE `homeowners`
  ADD PRIMARY KEY (`homeowner_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `homeowner_services`
--
ALTER TABLE `homeowner_services`
  ADD KEY `FK_homeowner_services_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_homeowner_services_service_ID` (`service_ID`);

--
-- Indexes for table `maintenance_equipment`
--
ALTER TABLE `maintenance_equipment`
  ADD PRIMARY KEY (`equipment_ID`);

--
-- Indexes for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_ID`),
  ADD UNIQUE KEY `service_name` (`service_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenance_equipment`
--
ALTER TABLE `maintenance_equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_bookings_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bookings_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `FK_cases_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_services`
--
ALTER TABLE `company_services`
  ADD CONSTRAINT `FK_company_services_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_company_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `services` (`service_ID`) ON DELETE CASCADE;

--
-- Constraints for table `homeowner_services`
--
ALTER TABLE `homeowner_services`
  ADD CONSTRAINT `FK_homeowner_services_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_homeowner_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `services` (`service_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
