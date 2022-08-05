-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2022 at 09:39 PM
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
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`admin_ID`, `username`, `password`, `name`, `email`, `phone`, `user_type`, `suspended`, `verified`) VALUES
(2, 'admin1', '$2y$10$PzVZrvMbbN8/ANiT2.9OBu2j1/exOdblgYA.l8UF/NHAC2Q7Y/5Aq', 'Test', 'test@mail.com', 98765432, 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `client_ID` int(11) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `bill_due_date` date NOT NULL,
  `bill_status` varchar(20) NOT NULL DEFAULT 'pending',
  `bill_payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_ID`, `company_ID`, `homeowner_ID`, `client_ID`, `bill_date`, `bill_due_date`, `bill_status`, `bill_payment_date`) VALUES
(1, 1, 1, 3, '2022-07-30', '2022-08-01', 'Paid', '2022-08-05'),
(3, 1, 1, 3, '2022-08-30', '2022-09-01', 'pending', NULL),
(4, 1, 2, 4, '2022-01-31', '2022-02-28', 'pending', NULL),
(12, 1, 2, 4, '2022-02-28', '2022-03-31', 'pending', NULL);

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
  `booking_status` varchar(20) NOT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_ID`, `company_ID`, `homeowner_ID`, `staff_ID`, `booking_date`, `booking_description`, `booking_type`, `booking_status`, `completion_date`) VALUES
(1, 1, 3, 3, '2022-07-27', 'asd', 'problem', 'Completed', '2022-08-05'),
(2, 1, 1, 6, '2022-07-23', 'Hi', 'installation', 'Assigned', NULL),
(3, 3, 2, NULL, '2022-06-30', 'Pipes Broken', 'problem', 'In Progress', NULL),
(4, 1, 1, 1, '2022-07-21', '123123123', 'problem', 'Assigned', NULL),
(5, 1, 1, 2, '2022-08-23', 'This is an augest booking', 'problem', 'Assigned', NULL),
(6, 2, 3, NULL, '2022-10-05', 'testing booking', 'problem', 'In Progress', NULL),
(7, 3, 1, NULL, '2022-07-28', 'sadasdasdasd', 'installation', 'In Progress', NULL),
(8, 4, 1, NULL, '2022-07-27', 'sadasdasd', 'installation', 'In Progress', NULL),
(9, 1, 1, NULL, '2022-08-23', 'Installation from Homeowner one to Company One', 'installation', 'In Progress', NULL),
(10, 1, 2, NULL, '2022-08-04', 'asd', 'installation', 'In Progress', NULL);

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
(36, 'test', 2, 1, '2022-07-12', 'Awaiting', 'Hello', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `client_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `discount_ID` int(11) DEFAULT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`client_ID`, `company_ID`, `homeowner_ID`, `discount_ID`, `start_date`) VALUES
(1, 4, 1, NULL, '2022-06-29'),
(2, 5, 1, 12, '2022-07-08'),
(3, 1, 1, 13, '2022-08-23'),
(4, 1, 2, 13, '2022-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
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
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`company_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `description`, `user_type`, `suspended`, `verified`) VALUES
(1, 'company1', '$2y$10$0AJV74vgbUUuNMg6kaUSh.dINaglwMnDBc8KtrbC.8ch5TAHTFlD.', 'Company One', 'test@mail.com', 98765432, '123 Test A42111', 123520, 'Testing', 'company', 0, 1),
(2, 'company2', '$2y$10$N/4f/SnOelWGRAGKjmiVn.9CMZgCVoVj4PEAtn6cWm9GRLeX4Yo1q', 'Company Two', 'test@mail.com', 98765432, '421 Something Avenue 6 #1-2492', 123942, 'Hello we are company 2', 'company', 0, 1),
(3, 'company3', '$2y$10$QIvZG0d3GxA6DQQllMyBBu0Db21d4Mu1LhSJps2KrxzQeh0s4cHES', 'Company Three', 'company3@sma.net', 98765432, '123 Test Avenue 12 #4-2192', 239423, 'Hello we are company three', 'company', 0, 1),
(4, 'company4', '$2y$10$ASJ5hTD3X9gbM4MSBnAGLuh8IallE5CFYJLqV8G6PM6tyZT0lizOC', 'Company Four', 'test@mail.com', 98765432, '93 Lorum Avenue 1 #52', 52821, 'No description has been set by the company yet', 'company', 0, 1),
(5, 'company5', '$2y$10$.YFGFGMcLbK1Sq66S5G.6e/YpicGLLJDyQ7BqsAxkCwbcecKlS5TO', 'Company Five', 'company5@mail.com', 89876544, '358 Random Lane 7 #2-223', 798628, 'No description has been set by the company yet', 'company', 0, 1);

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
(3, 4, 1, NULL),
(4, 5, 1, NULL),
(5, 2, 2, 56.00),
(7, 1, 3, 2.56),
(8, 2, 3, 46.00),
(9, 5, 3, NULL),
(10, 6, 3, NULL),
(11, 3, 3, NULL),
(12, 1, 4, NULL),
(45, 1, 5, NULL),
(46, 2, 5, NULL),
(47, 3, 5, NULL);

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
(5, 2, NULL, 'Sign up bonus', '2022-07-15', '2022-08-01', 'Sign up now and get 15% off', 15),
(12, 15, NULL, 'Sign up bonus', '2022-07-01', '2022-08-31', 'Sign up by August and get 25% off your Bill for life!', 25),
(13, 1, NULL, '30% off your Total bill', '2022-07-07', '2022-07-30', 'test', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Enquiries`
--

CREATE TABLE `Enquiries` (
  `enquiry_ID` int(11) NOT NULL,
  `admin_ID` int(10) DEFAULT NULL,
  `user_ID` int(11) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `enquiry_date` varchar(15) NOT NULL,
  `enquiry_subject` varchar(30) NOT NULL,
  `enquiry_description` varchar(500) NOT NULL,
  `enquiry_status` varchar(10) NOT NULL,
  `enquiry_reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries_company`
--

CREATE TABLE `enquiries_company` (
  `ec_ID` int(11) NOT NULL,
  `admin_ID` int(10) DEFAULT NULL,
  `company_ID` int(11) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `enquiry_date` varchar(15) NOT NULL,
  `enquiry_subject` varchar(30) NOT NULL,
  `enquiry_description` varchar(500) NOT NULL,
  `enquiry_status` varchar(10) NOT NULL,
  `enquiry_reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiries_company`
--

INSERT INTO `enquiries_company` (`ec_ID`, `admin_ID`, `company_ID`, `user_type`, `enquiry_date`, `enquiry_subject`, `enquiry_description`, `enquiry_status`, `enquiry_reply`) VALUES
(100, NULL, 1, 'company', '2022-07-14', 'test', '123', 'Awaiting', NULL),
(101, 2, 1, 'company', '2022-07-14', 'test', 'asd', 'Replied', 'Test Company Enquiry Reply'),
(102, NULL, 1, 'company', '2022-07-15', 'test', '123', 'Awaiting', NULL),
(103, NULL, 5, 'company', '2022-07-30', 'Enquiry from Company 5', 'Enquiry from Company 5 details', 'Awaiting', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries_homeowner`
--

CREATE TABLE `enquiries_homeowner` (
  `eh_ID` int(11) NOT NULL,
  `admin_ID` int(10) DEFAULT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `enquiry_date` varchar(15) NOT NULL,
  `enquiry_subject` varchar(30) NOT NULL,
  `enquiry_description` varchar(500) NOT NULL,
  `enquiry_status` varchar(10) NOT NULL,
  `enquiry_reply` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enquiries_homeowner`
--

INSERT INTO `enquiries_homeowner` (`eh_ID`, `admin_ID`, `homeowner_ID`, `user_type`, `enquiry_date`, `enquiry_subject`, `enquiry_description`, `enquiry_status`, `enquiry_reply`) VALUES
(200, 2, 1, 'homeowner', '2022-07-14', 'asdasd', '123', 'Replied', 'Test ENQUIRY homeowner Reply'),
(201, NULL, 1, 'homeowner', '2022-07-15', 'test', 'asdasd', 'Awaiting', NULL);

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
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homeowners`
--

INSERT INTO `homeowners` (`homeowner_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `home_type`, `user_type`, `suspended`, `verified`) VALUES
(1, 'homeowner1', '$2y$10$A70oK8EuIeeGvOXv7vNxBOT9HiCDp5c8IcPNIGSUZoxWmHf8zc1ri', 'Mark Lee', 'Marklee@mail.com', 98765432, '421 Lee Avenue 92 #6-2123', 123456, 'exec', 'homeowner', 0, 1),
(2, 'homeowner2', '$2y$10$xZglMrSjvQX6OsqgIcHc0en1XGBKRKQD54UNR0VAKbumBjfHHdExq', 'Test', 'test@mail.com', 92658976, '123 Test Avenue 12 #4-2192', 123942, 'exec', 'homeowner', 0, 1),
(3, 'homeowner5', '$2y$10$BXkqQo2q2zqQPH2HE9ju8OmGO4njqP/WmjEF1y5oMr7bV.yQiZgJe', 'Ang Jing Hian', 'jh@mail.com', 98762826, 'Block 241 Ang Mo Kio Avenue 12 #2-2420', 560241, '2room', 'homeowner', 0, 1),
(4, 'homeowner4', '$2y$10$v4wKpvpubMGqaJKIuJpMQOmoe8B8D8teLdXM1UXcxsBzqIlMAj9x2', 'Jamie Poh', 'four@mail.com', 86532469, '24 Poh Avenue 2 #02-451', 526975, '4room', 'homeowner', 0, 1),
(6, 'homeowner3', '$2y$10$pggC5TgFDNr4Wjf4vRpB2u5ZXP19CpJc0ALhc7YgOAqfbSnnyONGa', 'Test', 'test@mail.com', 98764892, '123 Random Street 7 #16-24', 416123, '2room', 'homeowner', 0, 1),
(9, 'homeowner11', '$2y$10$XlVcbU9uRljQDl9LHWmEkuJUkLvENtAApW5xvSSgA/5qyTT8nrqUi', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0, 0),
(10, 'homeowner7', '$2y$10$15DFEZvCdoZwaQ5hKN3ZM.O7xys2uaOhVcK40BvNNVbe/nWMCkoqe', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0, 0);

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
(5, 1, 1),
(6, 2, 1),
(7, 1, 6),
(8, 2, 6),
(9, 1, 9),
(10, 1, 10);

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
(1, 1, 'iansutarjieq', 4, '2022-06-22', '2022-06-23', '2022-06-10'),
(2, 1, 'eq1', 33, '2022-07-06', '2022-07-14', '2022-07-12'),
(3, 1, 'ianeeqqqq', 1234321, '2022-06-29', '2022-06-30', '2022-07-07'),
(4, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(5, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(6, 2, 'Water Tank', 2, '2022-04-19', '2022-07-14', '2023-04-12'),
(7, 1, 'test', 12, '2022-07-07', '2022-07-06', '2022-07-27'),
(8, 2, 'Reverse Osmosis Filters', 20, '2022-07-04', '2022-09-02', '2024-05-15'),
(9, 2, 'test', 123, '2022-07-05', '2022-07-15', '2022-07-27'),
(10, 2, 'Alkaline Solution', 521, '2022-06-27', '2022-08-05', '2022-10-19'),
(11, 2, 'test11', 123, '2022-07-20', '2022-07-28', '2022-08-03'),
(12, 1, 'Reverse Osmosis Filters', 20, '2022-07-08', '2022-07-29', '2022-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_staff`
--

CREATE TABLE `maintenance_staff` (
  `staff_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `booking_ID` int(11) DEFAULT NULL,
  `staff_role` varchar(30) NOT NULL,
  `staff_name` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(20) NOT NULL,
  `status` varchar(30) DEFAULT 'Not Assigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_staff`
--

INSERT INTO `maintenance_staff` (`staff_ID`, `company_ID`, `booking_ID`, `staff_role`, `staff_name`, `email`, `phone`, `status`) VALUES
(1, 1, 4, 'Customer Service', 'John Doe', 'jd@mail.sg', 98762521, 'Assigned'),
(2, 1, 5, 'Plumber', 'Jane Smith', 'js@mail.sg', 46109281, 'Assigned'),
(3, 1, 1, 'Customer Service', 'Tan Ah Kow', 'TaK@mail.com', 95719243, 'Not Assigned'),
(4, 2, NULL, 'Customer Service', 'Jing Hian', 'jh@mail.com', 92837621, 'Not Assigned'),
(5, 2, NULL, 'Plumber', 'John Doe', 'test@mail.com', 12345678, 'Not Assigned'),
(6, 1, 2, 'Customer Service', 'John Doe', 'test@mail.com', 12345678, 'Assigned'),
(7, 1, NULL, 'Plumber', 'Jane Smith', 'dsad@mail.com', 98765432, 'Not Assigned'),
(8, 1, NULL, 'Customer Service', 'John Doe', 'test@mail.com', 89735145, 'Not Assigned'),
(9, 1, NULL, 'Plumber', 'Tan Ah Kow', 'Angjinghian@gmail.com', 98785474, 'Not Assigned'),
(10, 1, NULL, 'Plumber', 'John Doe', 'Angjinghian@gmail.com', 97846523, 'Not Assigned');

-- --------------------------------------------------------

--
-- Table structure for table `Ratings`
--

CREATE TABLE `Ratings` (
  `rating_ID` int(11) NOT NULL,
  `company_ID` int(10) DEFAULT NULL,
  `homeowner_ID` int(10) NOT NULL,
  `score` decimal(5,1) NOT NULL,
  `review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ratings`
--

INSERT INTO `Ratings` (`rating_ID`, `company_ID`, `homeowner_ID`, `score`, `review`) VALUES
(1, 5, 1, '4.0', 'Testing Review'),
(2, 5, 1, '3.5', 'Testing review 2');

-- --------------------------------------------------------

--
-- Table structure for table `Services`
--

CREATE TABLE `Services` (
  `service_ID` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Services`
--

INSERT INTO `Services` (`service_ID`, `service_name`) VALUES
(3, 'Customer Service'),
(4, 'Fireworks'),
(6, 'Inspections'),
(2, 'Maintenance'),
(5, 'Pipes'),
(1, 'Water Supply');

-- --------------------------------------------------------

--
-- Table structure for table `Water_Tracking`
--

CREATE TABLE `Water_Tracking` (
  `tracking_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `usage_date` date NOT NULL,
  `month` varchar(20) NOT NULL,
  `water_usage` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Water_Tracking`
--

INSERT INTO `Water_Tracking` (`tracking_ID`, `company_ID`, `homeowner_ID`, `usage_date`, `month`, `water_usage`) VALUES
(3, 1, 1, '2022-07-27', 'July', 24.00),
(4, 2, 1, '2022-07-30', 'July', 24.00),
(5, 1, 1, '2022-07-28', 'July', 42.23),
(6, 1, 1, '2022-08-04', 'August', 22.00),
(7, 1, 2, '2022-07-27', 'July', 72.00),
(8, 1, 2, '2022-07-28', 'July', 9.70),
(9, 1, 1, '2022-08-27', 'August', 242.00),
(10, 1, 1, '2022-07-13', 'July', 150.00),
(11, 1, 1, '2022-07-30', 'July', 11.00),
(12, 1, 1, '2022-05-24', 'May', 24.00),
(13, 1, 1, '2022-06-01', 'June', 32.10),
(14, 1, 1, '2022-04-01', 'April', 200.00),
(15, 1, 1, '2022-07-12', 'July', 111.00),
(16, 1, 2, '2022-08-03', 'August', 64.65),
(17, 1, 2, '2022-08-01', 'August', 25.00),
(18, 1, 2, '2022-08-02', 'August', 13.42),
(19, 1, 2, '2022-07-23', 'July', 10.05);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_ID`),
  ADD KEY `FK_bills_company_ID` (`company_ID`),
  ADD KEY `FK_bills_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_bills_client_ID` (`client_ID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_ID`),
  ADD KEY `FK_bookings_company_ID` (`company_ID`),
  ADD KEY `FK_bookings_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_bookings_staff_ID` (`staff_ID`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_ID`),
  ADD KEY `FK_cases_homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`client_ID`),
  ADD KEY `FK_clients_homeowners_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_clients_company_company_ID` (`company_ID`),
  ADD KEY `FK_clients_discounts_discount_ID` (`discount_ID`);

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
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
-- Indexes for table `Enquiries`
--
ALTER TABLE `Enquiries`
  ADD PRIMARY KEY (`enquiry_ID`);

--
-- Indexes for table `enquiries_company`
--
ALTER TABLE `enquiries_company`
  ADD PRIMARY KEY (`ec_ID`),
  ADD KEY `FK_enquiriescomp_company_ID` (`company_ID`);

--
-- Indexes for table `enquiries_homeowner`
--
ALTER TABLE `enquiries_homeowner`
  ADD PRIMARY KEY (`eh_ID`),
  ADD KEY `FK_enquirieshome_homeowner_ID` (`homeowner_ID`);

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
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `FK_staff_company_ID` (`company_ID`);

--
-- Indexes for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD PRIMARY KEY (`rating_ID`);

--
-- Indexes for table `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`service_ID`),
  ADD UNIQUE KEY `service_name` (`service_name`);

--
-- Indexes for table `Water_Tracking`
--
ALTER TABLE `Water_Tracking`
  ADD PRIMARY KEY (`tracking_ID`),
  ADD KEY `FK_watertracking_company_ID` (`company_ID`),
  ADD KEY `FK_watertracking_homeowner_ID` (`homeowner_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `company_services`
--
ALTER TABLE `company_services`
  MODIFY `cs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Enquiries`
--
ALTER TABLE `Enquiries`
  MODIFY `enquiry_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries_company`
--
ALTER TABLE `enquiries_company`
  MODIFY `ec_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `enquiries_homeowner`
--
ALTER TABLE `enquiries_homeowner`
  MODIFY `eh_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `homeowner_services`
--
ALTER TABLE `homeowner_services`
  MODIFY `hs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `maintenance_equipment`
--
ALTER TABLE `maintenance_equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Ratings`
--
ALTER TABLE `Ratings`
  MODIFY `rating_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Services`
--
ALTER TABLE `Services`
  MODIFY `service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Water_Tracking`
--
ALTER TABLE `Water_Tracking`
  MODIFY `tracking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `FK_bills_client_ID` FOREIGN KEY (`client_ID`) REFERENCES `Clients` (`client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bills_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bills_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_bookings_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bookings_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bookings_staff_ID` FOREIGN KEY (`staff_ID`) REFERENCES `maintenance_staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `FK_cases_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Clients`
--
ALTER TABLE `Clients`
  ADD CONSTRAINT `FK_clients_company_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_discounts_discount_ID` FOREIGN KEY (`discount_ID`) REFERENCES `discounts` (`discount_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_homeowners_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company_services`
--
ALTER TABLE `company_services`
  ADD CONSTRAINT `FK_company_services_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_company_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `services` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enquiries_company`
--
ALTER TABLE `enquiries_company`
  ADD CONSTRAINT `FK_enquiriescomp_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enquiries_homeowner`
--
ALTER TABLE `enquiries_homeowner`
  ADD CONSTRAINT `FK_enquirieshome_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homeowner_services`
--
ALTER TABLE `homeowner_services`
  ADD CONSTRAINT `FK_homeowner_services_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_homeowner_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `services` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_staff`
--
ALTER TABLE `maintenance_staff`
  ADD CONSTRAINT `FK_staff_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Water_Tracking`
--
ALTER TABLE `Water_Tracking`
  ADD CONSTRAINT `FK_watertracking_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_watertracking_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
