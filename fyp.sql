-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 11:15 PM
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
  `user_type` varchar(20) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `username`, `password`, `name`, `email`, `phone`, `user_type`, `verified`) VALUES
(2, 'admin1', '$2y$10$PzVZrvMbbN8/ANiT2.9OBu2j1/exOdblgYA.l8UF/NHAC2Q7Y/5Aq', 'Test', 'test@mail.com', 98765432, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `bill_date` date DEFAULT NULL,
  `bill_due_date` date NOT NULL,
  `bill_status` varchar(20) NOT NULL DEFAULT 'pending',
  `bill_payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_ID`, `company_ID`, `homeowner_ID`, `bill_date`, `bill_due_date`, `bill_status`, `bill_payment_date`) VALUES
(1, 1, 5, '2022-07-30', '2022-08-01', 'pending', '0000-00-00'),
(3, 1, 5, '2022-08-30', '2022-09-01', 'pending', NULL);

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
(26, 1, 3, NULL, '2022-07-27', 'asd', 'problem', 'In Progress'),
(28, 1, 5, NULL, '2022-07-23', 'Hi', 'installation', 'In Progress'),
(31, 3, 5, NULL, '2022-07-28', 'sadasdasdasd', 'installation', 'In Progress'),
(32, 4, 5, NULL, '2022-07-27', 'sadasdasd', 'installation', 'In Progress'),
(37, 1, 5, NULL, '2022-07-21', '123123123', 'problem', 'In Progress'),
(38, 4, 5, NULL, '2022-07-27', '123', 'installation', 'In Progress'),
(39, 1, 5, NULL, '2022-08-23', 'This is an augest booking', 'problem', 'In Progress');

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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `discount_ID` int(11) DEFAULT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_ID`, `company_ID`, `homeowner_ID`, `discount_ID`, `start_date`) VALUES
(1, 1, 5, 1, '2022-07-23'),
(3, 3, 5, 6, '2022-07-28'),
(8, 4, 5, NULL, '2022-06-29');

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
(1, 'company1', '$2y$10$0AJV74vgbUUuNMg6kaUSh.dINaglwMnDBc8KtrbC.8ch5TAHTFlD.', 'Company One', 'test@mail.com', 98765432, '123 Test A42111', 123521, 'Testing', 'company', 0, 1),
(2, 'company2', '$2y$10$N/4f/SnOelWGRAGKjmiVn.9CMZgCVoVj4PEAtn6cWm9GRLeX4Yo1q', 'Company Two', 'test@mail.com', 98765432, '421 Something Avenue 6 #1-2492', 123942, 'Hello we are company 2', 'company', 0, 1),
(3, 'company3', '$2y$10$QIvZG0d3GxA6DQQllMyBBu0Db21d4Mu1LhSJps2KrxzQeh0s4cHES', 'Company Three', 'company3@sma.net', 98765432, '123 Test Avenue 12 #4-2192', 239423, 'Hello we are company three', 'company', 0, 0),
(4, 'company12', '$2y$10$ASJ5hTD3X9gbM4MSBnAGLuh8IallE5CFYJLqV8G6PM6tyZT0lizOC', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '', 'company', 0, 0),
(14, 'company11234', '$2y$10$lVPrR/4MzTK9bGIJgxTO1OQjDi7tUtzcJ9/1.zv76HrviujI3TxrW', 'Test312321', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'No description has been set by the company yet', 'company', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_services`
--

CREATE TABLE `company_services` (
  `cs_ID` int(11) NOT NULL,
  `service_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `price` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_services`
--

INSERT INTO `company_services` (`cs_ID`, `service_ID`, `company_ID`, `price`) VALUES
(1, 1, 1, 14.20),
(2, 2, 1, 12.56),
(3, 49, 1, NULL),
(4, 52, 1, NULL),
(5, 2, 2, 56.00),
(6, 73, 2, NULL),
(7, 1, 3, 2.56),
(8, 2, 3, 46.00),
(9, 52, 3, NULL),
(10, 77, 3, NULL),
(11, 78, 3, NULL),
(12, 1, 4, NULL),
(41, 1, 14, NULL),
(42, 7, 14, NULL),
(43, 52, 14, NULL),
(44, 73, 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) DEFAULT NULL,
  `discount_name` varchar(100) NOT NULL,
  `discount_start_date` varchar(15) NOT NULL,
  `discount_end_date` varchar(15) NOT NULL,
  `discount_description` varchar(500) NOT NULL,
  `discount_modifier` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_ID`, `company_ID`, `homeowner_ID`, `discount_name`, `discount_start_date`, `discount_end_date`, `discount_description`, `discount_modifier`) VALUES
(1, 1, NULL, 'Sign up bonus', '2022-07-14', '2022-07-30', 'Sign up and get 10% off', 10),
(5, 2, NULL, 'Sign up bonus', '2022-07-15', '2022-08-01', 'Sign up now and get 15% off', 15),
(6, 3, NULL, '30% off your Total bill', '2022-07-01', '2022-09-28', 'Get 30% off your Total bill when you sign up now!', 30);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `enquiry_ID` int(11) NOT NULL,
  `admin_ID` int(10) DEFAULT NULL,
  `user_ID` int(11) NOT NULL,
  `usertype` varchar(15) NOT NULL,
  `enquiry_date` varchar(15) NOT NULL,
  `enquiry_subject` varchar(30) NOT NULL,
  `enquiry_description` varchar(500) NOT NULL,
  `enquiry_status` varchar(10) NOT NULL,
  `enquiry_reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`enquiry_ID`, `admin_ID`, `user_ID`, `usertype`, `enquiry_date`, `enquiry_subject`, `enquiry_description`, `enquiry_status`, `enquiry_reply`) VALUES
(1, NULL, 5, 'homeowner', '2022-07-14', 'asdasd', '123', 'Awaiting', NULL),
(2, NULL, 1, 'company', '2022-07-14', 'test', '123', 'Awaiting', NULL),
(3, NULL, 1, 'company', '2022-07-14', 'test', 'asd', 'Awaiting', NULL),
(4, NULL, 1, 'company', '2022-07-15', 'test', '123', 'Awaiting', NULL),
(5, NULL, 5, 'homeowner', '2022-07-15', 'test', 'asdasd', 'Awaiting', NULL);

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
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeowners`
--

INSERT INTO `homeowners` (`homeowner_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `home_type`, `user_type`, `suspended`, `verified`) VALUES
(2, 'homeowner2', '$2y$10$xZglMrSjvQX6OsqgIcHc0en1XGBKRKQD54UNR0VAKbumBjfHHdExq', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'exec', 'homeowner', 0, 1),
(3, 'homeowner5', '$2y$10$BXkqQo2q2zqQPH2HE9ju8OmGO4njqP/WmjEF1y5oMr7bV.yQiZgJe', 'Ang Jing Hian', 'Angjinghian@gmail.com', 97307997, 'Block 511 Ang Mo Kio Avenue 8 #11-2770', 560511, '2room', 'homeowner', 0, 1),
(4, 'homeowner1111', '$2y$10$v4wKpvpubMGqaJKIuJpMQOmoe8B8D8teLdXM1UXcxsBzqIlMAj9x2', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '4room', 'homeowner', 0, 1),
(5, 'homeowner1', '$2y$10$A70oK8EuIeeGvOXv7vNxBOT9HiCDp5c8IcPNIGSUZoxWmHf8zc1ri', 'Mark Lee', 'Marklee@mail.com', 98765432, '421 Test Avenue 122 #64-21213', 1239422, 'exec', 'homeowner', 0, 1),
(6, 'homeowner3', '$2y$10$pggC5TgFDNr4Wjf4vRpB2u5ZXP19CpJc0ALhc7YgOAqfbSnnyONGa', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0, 1),
(7, 'homeowner111', '$2y$10$RvgLuyLM.eY5M2wIXbXRUeOKn/CSscJ8Zat4CS8n/0NyGNUf8opCO', 'Ang Jing Hian', 'Angjinghian@gmail.com', 97307997, 'Block 511 Ang Mo Kio Avenue 8 #11-2770', 560511, '2room', 'homeowner', 0, 1),
(8, 'homeowner14521', '$2y$10$9CLN7Drryc2vHZeOS8oGXOnGkPnBUO/SPu1/xZYoDAqng44KwPDwm', 'Ang Jing Hian', 'Angjinghian@gmail.com', 97307997, 'Block 511 Ang Mo Kio Avenue 8 #11-2770', 560511, '2room', 'homeowner', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `homeowner_services`
--

CREATE TABLE `homeowner_services` (
  `hs_ID` int(11) NOT NULL,
  `service_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeowner_services`
--

INSERT INTO `homeowner_services` (`hs_ID`, `service_ID`, `homeowner_ID`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 4),
(7, 1, 5),
(8, 2, 5),
(10, 1, 6),
(11, 2, 6),
(12, 1, 7),
(14, 1, 7),
(15, 1, 8),
(16, 2, 8),
(17, 7, 8),
(18, 49, 8),
(19, 52, 8),
(20, 73, 8),
(21, 77, 8),
(22, 78, 8),
(24, 99, 8);

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
  `status` varchar(30) DEFAULT NULL
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
(24, 1, 'Plumber', 'Jane Smith', 'dsad@mail.com', 98765432, ''),
(25, 1, 'Customer Service', 'John Doe', 'test@mail.com', 89735145, ''),
(26, 1, 'Plumber', 'Tan Ah Kow', 'Angjinghian@gmail.com', 98785474, ''),
(27, 1, 'Plumber', 'John Doe', 'Angjinghian@gmail.com', 97846523, 'Not Assigned');

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
(2, 'Maintenance'),
(7, 'One'),
(73, 'Parties'),
(52, 'Pipes'),
(99, 'Testing'),
(1, 'Water Supply');

-- --------------------------------------------------------

--
-- Table structure for table `water_tracking`
--

CREATE TABLE `water_tracking` (
  `tracking_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `usage_date` date NOT NULL,
  `water_usage` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `water_tracking`
--

INSERT INTO `water_tracking` (`tracking_ID`, `company_ID`, `homeowner_ID`, `usage_date`, `water_usage`) VALUES
(3, 1, 5, '2022-07-27', 24.00),
(4, 2, 5, '2022-07-30', 24.00),
(5, 1, 5, '2022-07-28', 42.23),
(6, 1, 5, '2022-08-04', 22.00),
(7, 1, 2, '2022-07-27', 72.00),
(8, 1, 2, '2022-07-28', 23.00),
(9, 1, 5, '2022-08-27', 242.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_ID`),
  ADD KEY `FK_bills_company_ID` (`company_ID`),
  ADD KEY `FK_bills_homeowner_ID` (`homeowner_ID`);

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_ID`),
  ADD KEY `FK_clients_homeowners_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_clients_company_company_ID` (`company_ID`),
  ADD KEY `FK_clients_discounts_discount_ID` (`discount_ID`);

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
  ADD PRIMARY KEY (`cs_ID`),
  ADD KEY `FK_company_services_company_ID` (`company_ID`),
  ADD KEY `FK_company_services_service_ID` (`service_ID`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_ID`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`enquiry_ID`);

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
  ADD PRIMARY KEY (`hs_ID`),
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
-- Indexes for table `water_tracking`
--
ALTER TABLE `water_tracking`
  ADD PRIMARY KEY (`tracking_ID`),
  ADD KEY `FK_watertracking_company_ID` (`company_ID`),
  ADD KEY `FK_watertracking_homeowner_ID` (`homeowner_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `company_services`
--
ALTER TABLE `company_services`
  MODIFY `cs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `enquiry_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `homeowner_services`
--
ALTER TABLE `homeowner_services`
  MODIFY `hs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `maintenance_equipment`
--
ALTER TABLE `maintenance_equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `water_tracking`
--
ALTER TABLE `water_tracking`
  MODIFY `tracking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `FK_bills_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bills_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_clients_company_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_discounts_discount_ID` FOREIGN KEY (`discount_ID`) REFERENCES `discounts` (`discount_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_homeowners_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `water_tracking`
--
ALTER TABLE `water_tracking`
  ADD CONSTRAINT `FK_watertracking_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_watertracking_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
