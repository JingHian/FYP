-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 07:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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
  `case_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`case_ID`, `case_subject`, `company_ID`, `homeowner_ID`, `case_date`, `case_status`, `case_description`) VALUES
(13, 'Water leak', 2, 1, '2022-06-20', 'Awaiting', 'test'),
(14, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(15, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(16, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(17, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(18, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(19, 'test', 1, 1, '2022-06-20', 'Awaiting', 'hello\r\n'),
(20, 'test', 1, 1, '2022-06-20', 'Awaiting', '1234'),
(21, 'Hello', 1, 1, '2022-06-22', 'Awaiting', 'Just checking if this is still available\r\n'),
(22, 'Broken pipes', 3, 1, '2022-06-22', 'Awaiting', 'Some of my pipes are broken'),
(23, 'Send a technician ', 3, 1, '2022-06-22', 'Awaiting', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod ligula vitae purus ultrices, non fermentum dui bibendum. Ut vel accumsan mi. Vestibulum eget ornare enim, id porttitor ligula. Nunc justo nunc, faucibus at varius sed, hendrerit sit amet nunc. Etiam vulputate malesuada lacus nec auc');

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
  `user_type` varchar(20) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `user_type`, `suspended`, `verified`) VALUES
(1, 'company1', '$2y$10$LC7fQTlrA4YwODzgiV9XKetm1Y5gSUJ/Nwg4QA.QbEko0Rr9/pmIy', 'Company One', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'company', 0, 0),
(2, 'company2', '$2y$10$N/4f/SnOelWGRAGKjmiVn.9CMZgCVoVj4PEAtn6cWm9GRLeX4Yo1q', 'Company Two', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'company', 0, 0),
(3, 'company3', '$2y$10$QIvZG0d3GxA6DQQllMyBBu0Db21d4Mu1LhSJps2KrxzQeh0s4cHES', 'Company Three', 'company3@sma.net', 98765432, '123 Test Avenue 12 #4-2192', 239423, 'company', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_services`
--

CREATE TABLE `company_services` (
  `service_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_services`
--

INSERT INTO `company_services` (`service_ID`, `company_ID`) VALUES
(1, 1),
(2, 1),
(49, 1),
(52, 1),
(2, 2),
(73, 2),
(1, 3),
(2, 3),
(52, 3),
(77, 3),
(78, 3);

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
(1, 'homeowner1', '$2y$10$kDgwOcjxhguKJqUkRw0HPe682D4lYpAmCvUNPmPovqk8sJaz145b.', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0),
(2, 'homeowner2', '$2y$10$xZglMrSjvQX6OsqgIcHc0en1XGBKRKQD54UNR0VAKbumBjfHHdExq', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'exec', 'homeowner', 0);

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
(1, 1),
(2, 1),
(49, 1),
(52, 1),
(1, 2);

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
  `expirydate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_equipment`
--

INSERT INTO `maintenance_equipment` (`equipment_ID`, `company_ID`, `equipment_name`, `quantity`, `installation_date`, `warranty_date`, `expirydate`) VALUES
(1, 1, 'ianwq', 22, '1986', '1986', '1990'),
(2, 1, 'dcqw', 22, '2022-05-30', '2022-06-08', '2022-06-06'),
(3, 1, 'iansutarjieq', 4, '2022-06-22', '2022-06-23', '2022-06-10'),
(5, 1, 'eqiopment', 3, '2022-07-11', '2022-07-20', '2022-07-13'),
(6, 1, 'eq1', 33, '2022-07-06', '2022-07-14', '2022-07-12'),
(7, 1, 'ianeeqqqq', 1234321, '2022-06-29', '2022-06-30', '2022-07-07'),
(8, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(9, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(19, 2, 'qwd', 2, '2022-04-19', '2022-07-14', '2022-07-14'),
(21, 2, 'wcfw2d', 41, '2022-07-19', '2022-06-10', '2022-07-05');

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
(3, 2, 'ffedefvrwq', 'fcwa', 'ferwefq', 54, ''),
(4, 2, 'ewfqe', 'EFW', 'frvfwefwvf', 432123, '');

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
  ADD PRIMARY KEY (`case_ID`);

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
  MODIFY `booking_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance_equipment`
--
ALTER TABLE `maintenance_equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
