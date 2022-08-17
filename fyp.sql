-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2022 at 02:55 AM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--
CREATE DATABASE IF NOT EXISTS `fyp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
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
(2, 'admin1', '$2y$10$PzVZrvMbbN8/ANiT2.9OBu2j1/exOdblgYA.l8UF/NHAC2Q7Y/5Aq', 'Test', 'test@mail.com', 98765432, 'admin', 0, 1),
(3, 'admin2', '$2y$10$0iYfj9OoXidNNX0YDBVS..wo.9oTGCWsPHmG94uwwfJmyHXQFSMZS', 'Admin Two', 'admin2@mail.com', 81234567, 'admin', 0, 1),
(4, 'admin3', '$2y$10$peq7JKBeNYxlgYZTT9fNDuBSkU3FMMm8elZrDlOroN6M5KO8oi1OC', 'Admin Three', 'admin@mail.com', 98765432, 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Bills`
--

CREATE TABLE `Bills` (
  `bill_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `client_ID` int(11) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `bill_due_date` date NOT NULL,
  `bill_status` varchar(20) NOT NULL DEFAULT 'pending',
  `bill_payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `booking_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `staff_ID` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Cases`
--

CREATE TABLE `Cases` (
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
-- Dumping data for table `Cases`
--

INSERT INTO `Cases` (`case_ID`, `case_subject`, `company_ID`, `homeowner_ID`, `case_date`, `case_status`, `case_description`, `case_reply`) VALUES
(24, '123', 1, 2, '2022-06-24', 'Replied', '123', '456'),
(25, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(26, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(27, '123', 2, 2, '2022-06-24', 'Awaiting', '123', NULL),
(31, 'Homeowner 3 problem', 3, 3, '2022-07-05', 'Awaiting', 'Homeowner 3 problem details', NULL),
(32, 'test', 1, 3, '2022-07-05', 'Replied', 'testing', 'Testing Reply\r\n'),
(34, 'asdasd', 2, 3, '2022-07-05', 'Awaiting', 'test', NULL),
(35, 'test', 2, 3, '2022-07-05', 'Awaiting', 'test', NULL),
(36, 'test', 2, 1, '2022-07-12', 'Awaiting', 'Hello Test', NULL),
(37, 'new', 5, 1, '2022-08-08', 'Replied', 'Do you support', 'Lolno');

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
(1, 'company1', '$2y$10$Walm.A37GJ6HYfD5JGl2LOmvaYQIxaUKFH6474V6.q6nh/FO66Nn.', 'Company One', 'test@mail.com', 98765432, '123 Test A42111', 123520, 'Testing', 'company', 0, 1),
(2, 'company2', '$2y$10$N/4f/SnOelWGRAGKjmiVn.9CMZgCVoVj4PEAtn6cWm9GRLeX4Yo1q', 'Company Two', 'test@mail.com', 98765432, '421 Something Avenue 6 #1-2492', 123942, 'Hello we are company 2', 'company', 0, 1),
(3, 'company3', '$2y$10$QIvZG0d3GxA6DQQllMyBBu0Db21d4Mu1LhSJps2KrxzQeh0s4cHES', 'Company Three', 'company3@sma.net', 98765432, '123 Test Avenue 12 #4-2192', 239423, 'Hello we are company three', 'company', 0, 1),
(4, 'company4', '$2y$10$KL2pPxj97pnCOazUynfgNOStA2jPc/DdBX.zFnSCDDFnu0Y16U116', 'Company Four', 'compfour@mail.com', 67876543, '93 Lorum Avenue 1 #05-98', 52821, 'Bringing fresh water right to your homes', 'company', 0, 1),
(5, 'company5', '$2y$10$.YFGFGMcLbK1Sq66S5G.6e/YpicGLLJDyQ7BqsAxkCwbcecKlS5TO', 'Company Five', 'company5@mail.com', 89876544, '358 Random Lane 7 #2-223', 798628, 'We are number 5', 'company', 0, 1),
(20, 'company34', '$2y$10$FTfAwCYsKMKuEI2RtLLIp.xbCNBJFBFcK1wt3IX5Fws1NGsJHjbsm', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'No description has been set by the company yet', 'company', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Company_Services`
--

CREATE TABLE `Company_Services` (
  `cs_ID` int(11) NOT NULL,
  `service_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `price` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Company_Services`
--

INSERT INTO `Company_Services` (`cs_ID`, `service_ID`, `company_ID`, `price`) VALUES
(1, 1, 1, 2.55),
(2, 2, 1, 50.50),
(3, 4, 1, NULL),
(4, 5, 1, NULL),
(5, 2, 2, 56.00),
(7, 1, 3, 2.56),
(8, 2, 3, 46.00),
(9, 5, 3, NULL),
(10, 6, 3, NULL),
(11, 3, 3, NULL),
(12, 1, 4, 0.25),
(45, 1, 5, NULL),
(46, 2, 5, NULL),
(47, 3, 5, NULL),
(50, 1, 20, 12.56),
(52, 20, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Discounts`
--

CREATE TABLE `Discounts` (
  `discount_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `discount_name` varchar(100) NOT NULL,
  `discount_start_date` varchar(15) NOT NULL,
  `discount_end_date` varchar(15) NOT NULL,
  `discount_description` varchar(500) NOT NULL,
  `discount_modifier` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Discounts`
--

INSERT INTO `Discounts` (`discount_ID`, `company_ID`, `discount_name`, `discount_start_date`, `discount_end_date`, `discount_description`, `discount_modifier`) VALUES
(5, 2, 'Sign up bonus', '2022-07-15', '2022-08-01', 'Sign up now and get 15% off', 15),
(12, 4, 'Sign up bonus', '2022-07-01', '2022-08-31', 'Sign up by August and get 25% off your Bill for life!', 25),
(13, 1, '30% off your Total bill', '2022-07-07', '2022-07-30', 'test', 12),
(15, 5, 'New Adopter', '2022-08-04', '2022-12-28', '14', 15);

-- --------------------------------------------------------

--
-- Table structure for table `Enquiries`
--

CREATE TABLE `Enquiries` (
  `enquiry_ID` int(11) NOT NULL,
  `admin_ID` int(10) DEFAULT NULL,
  `user_ID` int(11) NOT NULL,
  `user_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_date` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_subject` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_reply` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Enquiries_Company`
--

CREATE TABLE `Enquiries_Company` (
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
-- Dumping data for table `Enquiries_Company`
--

INSERT INTO `Enquiries_Company` (`ec_ID`, `admin_ID`, `company_ID`, `user_type`, `enquiry_date`, `enquiry_subject`, `enquiry_description`, `enquiry_status`, `enquiry_reply`) VALUES
(100, 2, 1, 'company', '2022-07-14', 'test', '123', 'Replied', 'no'),
(101, 2, 1, 'company', '2022-07-14', 'test', 'asd', 'Replied', 'Test Company Enquiry Reply'),
(102, NULL, 1, 'company', '2022-07-15', 'test', '123', 'Awaiting', NULL),
(103, NULL, 5, 'company', '2022-07-30', 'Enquiry from Company 5', 'Enquiry from Company 5 details', 'Awaiting', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Enquiries_Homeowner`
--

CREATE TABLE `Enquiries_Homeowner` (
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
-- Dumping data for table `Enquiries_Homeowner`
--

INSERT INTO `Enquiries_Homeowner` (`eh_ID`, `admin_ID`, `homeowner_ID`, `user_type`, `enquiry_date`, `enquiry_subject`, `enquiry_description`, `enquiry_status`, `enquiry_reply`) VALUES
(200, 2, 1, 'homeowner', '2022-07-14', 'asdasd', '123', 'Replied', 'Test ENQUIRY homeowner Reply'),
(201, NULL, 1, 'homeowner', '2022-07-15', 'test', 'asdasd', 'Awaiting', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Homeowners`
--

CREATE TABLE `Homeowners` (
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
-- Dumping data for table `Homeowners`
--

INSERT INTO `Homeowners` (`homeowner_ID`, `username`, `password`, `name`, `email`, `phone`, `address`, `postal_code`, `home_type`, `user_type`, `suspended`, `verified`) VALUES
(1, 'homeowner1', '$2y$10$A70oK8EuIeeGvOXv7vNxBOT9HiCDp5c8IcPNIGSUZoxWmHf8zc1ri', 'Mark Lee', 'MarkLee@mail.com', 98765432, '421 Lee Avenue 92 #6-2123', 123456, 'exec', 'homeowner', 0, 1),
(2, 'homeowner2', '$2y$10$xZglMrSjvQX6OsqgIcHc0en1XGBKRKQD54UNR0VAKbumBjfHHdExq', 'Test', 'test@mail.com', 92658976, '123 Test Avenue 12 #4-2192', 123942, 'exec', 'homeowner', 0, 1),
(3, 'homeowner5', '$2y$10$BXkqQo2q2zqQPH2HE9ju8OmGO4njqP/WmjEF1y5oMr7bV.yQiZgJe', 'Ang Jing Hian', 'jh@mail.com', 98762826, 'Block 241 Ang Mo Kio Avenue 12 #2-2420', 560241, '2room', 'homeowner', 0, 1),
(4, 'homeowner4', '$2y$10$v4wKpvpubMGqaJKIuJpMQOmoe8B8D8teLdXM1UXcxsBzqIlMAj9x2', 'Jamie Poh', 'four@mail.com', 86532469, '24 Poh Avenue 2 #02-451', 526975, '4room', 'homeowner', 0, 1),
(6, 'homeowner3', '$2y$10$pggC5TgFDNr4Wjf4vRpB2u5ZXP19CpJc0ALhc7YgOAqfbSnnyONGa', 'Andrew Sim', 'test@mail.com', 98764892, '123 Random Street 7 #16-24', 416123, '2room', 'homeowner', 0, 1),
(9, 'homeowner11', '$2y$10$XlVcbU9uRljQDl9LHWmEkuJUkLvENtAApW5xvSSgA/5qyTT8nrqUi', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0, 0),
(10, 'homeowner7', '$2y$10$15DFEZvCdoZwaQ5hKN3ZM.O7xys2uaOhVcK40BvNNVbe/nWMCkoqe', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0, 0),
(15, 'homeowner6', '$2y$10$3syjRB/fdDiYYTkjld74oOULsT7JS0Q19dY44LNZqj/Pp80KYkM9a', 'Sunny Yew', 'Syew@mail.sg', 71028921, 'Fake Street 92 #6-1252', 259612, '5room', 'homeowner', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Homeowner_Services`
--

CREATE TABLE `Homeowner_Services` (
  `hs_ID` int(11) NOT NULL,
  `service_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Homeowner_Services`
--

INSERT INTO `Homeowner_Services` (`hs_ID`, `service_ID`, `homeowner_ID`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(4, 2, 4),
(5, 1, 1),
(6, 2, 1),
(7, 1, 6),
(8, 2, 6),
(9, 1, 9),
(10, 1, 10),
(17, 1, 15),
(18, 2, 15),
(19, 3, 15),
(20, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `Maintenance_Equipment`
--

CREATE TABLE `Maintenance_Equipment` (
  `equipment_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `equipment_name` varchar(30) NOT NULL,
  `quantity` int(15) NOT NULL,
  `installation_date` varchar(15) NOT NULL,
  `warranty_date` varchar(15) NOT NULL,
  `expiry_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Maintenance_Equipment`
--

INSERT INTO `Maintenance_Equipment` (`equipment_ID`, `company_ID`, `equipment_name`, `quantity`, `installation_date`, `warranty_date`, `expiry_date`) VALUES
(2, 1, 'eq1', 33, '2022-07-06', '2022-07-14', '2022-07-12'),
(3, 1, 'ianeeqqqq', 1234321, '2022-06-29', '2022-06-30', '2022-07-07'),
(4, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(5, 1, 'dcqwdf', 21, '2022-05-06', '2022-06-06', '2022-06-04'),
(6, 2, 'Water Tank', 2, '2022-04-19', '2022-07-14', '2023-04-12'),
(7, 1, 'Water Meters', 800, '2022-07-12', '2022-07-22', '2022-07-30'),
(8, 2, 'Reverse Osmosis Filters', 20, '2022-07-04', '2022-09-02', '2024-05-15'),
(9, 2, 'test', 123, '2022-07-05', '2022-07-15', '2022-07-27'),
(10, 2, 'Alkaline Solution', 521, '2022-06-27', '2022-08-05', '2022-10-19'),
(11, 2, 'test11', 123, '2022-07-20', '2022-07-28', '2022-08-03'),
(12, 1, 'Reverse Osmosis Filters', 20, '2022-07-08', '2022-07-29', '2022-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `Maintenance_Staff`
--

CREATE TABLE `Maintenance_Staff` (
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
-- Dumping data for table `Maintenance_Staff`
--

INSERT INTO `Maintenance_Staff` (`staff_ID`, `company_ID`, `booking_ID`, `staff_role`, `staff_name`, `email`, `phone`, `status`) VALUES
(1, 1, 4, 'Customer Service', 'John Doe', 'jd@mail.sg', 5551234, 'Assigned'),
(2, 1, 5, 'Plumber', 'Jane Smith', 'js@mail.sg', 46109281, 'Assigned'),
(3, 1, 1, 'Customer Service', 'Tan Ah Kow', 'TaK@mail.com', 95719243, 'Not Assigned'),
(4, 2, NULL, 'Customer Service', 'Jing Hian', 'jh@mail.com', 92837621, 'Not Assigned'),
(5, 2, NULL, 'Plumber', 'John Doe', 'test@mail.com', 12345678, 'Not Assigned'),
(6, 1, 2, 'Customer Service', 'John Doe', 'test@mail.com', 12345678, 'Assigned'),
(7, 1, NULL, 'Plumber', 'Jane Smith', 'dsad@mail.com', 98765432, 'Not Assigned'),
(8, 1, NULL, 'Customer Service', 'John Doe', 'test@mail.com', 89735145, 'Not Assigned'),
(9, 1, NULL, 'Plumber', 'Tan Ah Kow', 'Angjinghian@gmail.com', 98785474, 'Not Assigned'),
(10, 1, NULL, 'Plumber', 'John Doe', 'Angjinghian@gmail.com', 97846523, 'Not Assigned'),
(11, 5, NULL, 'Water Executive', 'James Lee', 'JLee@Jmail.com', 55123456, 'Not Assigned'),
(13, 1, NULL, 'Technician', 'James Lee', 'JL@comp1.com', 78945612, 'Not Assigned');

-- --------------------------------------------------------

--
-- Table structure for table `Past_Clients`
--

CREATE TABLE `Past_Clients` (
  `client_ID` int(11) NOT NULL,
  `company_ID` int(11) NOT NULL,
  `homeowner_ID` int(11) NOT NULL,
  `cancellation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Past_Clients`
--

INSERT INTO `Past_Clients` (`client_ID`, `company_ID`, `homeowner_ID`, `cancellation_date`) VALUES
(10, 5, 1, '2022-08-18');

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
(2, 5, 1, '3.5', 'Testing review 2'),
(3, 1, 1, '4.0', 'TEST'),
(4, 3, 1, '5.0', 'Yet to install looks good'),
(5, 4, 1, '4.0', 'Would recommend their services to my family and friends!');

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
(20, 'Pipes installation'),
(27, 'test'),
(28, 'Testing'),
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
(19, 1, 2, '2022-07-23', 'July', 10.05),
(20, 1, 1, '2022-08-17', 'August', 15.00),
(21, 4, 1, '2022-08-14', 'August', 1250.00),
(22, 1, 1, '2022-08-14', 'August', 1250.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `Bills`
--
ALTER TABLE `Bills`
  ADD PRIMARY KEY (`bill_ID`),
  ADD KEY `FK_bills_company_ID` (`company_ID`),
  ADD KEY `FK_bills_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_bills_client_ID` (`client_ID`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`booking_ID`),
  ADD KEY `FK_bookings_client_ID` (`client_ID`),
  ADD KEY `FK_bookings_company_ID` (`company_ID`),
  ADD KEY `FK_bookings_homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `Cases`
--
ALTER TABLE `Cases`
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
-- Indexes for table `Company_Services`
--
ALTER TABLE `Company_Services`
  ADD PRIMARY KEY (`cs_ID`),
  ADD KEY `FK_company_services_company_ID` (`company_ID`),
  ADD KEY `FK_company_services_service_ID` (`service_ID`);

--
-- Indexes for table `Discounts`
--
ALTER TABLE `Discounts`
  ADD PRIMARY KEY (`discount_ID`),
  ADD KEY `FK_discounts_company_ID` (`company_ID`);

--
-- Indexes for table `Enquiries`
--
ALTER TABLE `Enquiries`
  ADD PRIMARY KEY (`enquiry_ID`);

--
-- Indexes for table `Enquiries_Company`
--
ALTER TABLE `Enquiries_Company`
  ADD PRIMARY KEY (`ec_ID`),
  ADD KEY `FK_enquiriescomp_company_ID` (`company_ID`);

--
-- Indexes for table `Enquiries_Homeowner`
--
ALTER TABLE `Enquiries_Homeowner`
  ADD PRIMARY KEY (`eh_ID`),
  ADD KEY `FK_enquirieshome_homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `Homeowners`
--
ALTER TABLE `Homeowners`
  ADD PRIMARY KEY (`homeowner_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Homeowner_Services`
--
ALTER TABLE `Homeowner_Services`
  ADD PRIMARY KEY (`hs_ID`),
  ADD KEY `FK_homeowner_services_homeowner_ID` (`homeowner_ID`),
  ADD KEY `FK_homeowner_services_service_ID` (`service_ID`);

--
-- Indexes for table `Maintenance_Equipment`
--
ALTER TABLE `Maintenance_Equipment`
  ADD PRIMARY KEY (`equipment_ID`),
  ADD KEY `FK_maint_eq_company_ID` (`company_ID`);

--
-- Indexes for table `Maintenance_Staff`
--
ALTER TABLE `Maintenance_Staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `FK_staff_company_ID` (`company_ID`);

--
-- Indexes for table `Past_Clients`
--
ALTER TABLE `Past_Clients`
  ADD UNIQUE KEY `client_ID` (`client_ID`),
  ADD UNIQUE KEY `company_ID` (`company_ID`),
  ADD UNIQUE KEY `homeowner_ID` (`homeowner_ID`);

--
-- Indexes for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD PRIMARY KEY (`rating_ID`),
  ADD KEY `FK_ratings_company_ID` (`company_ID`),
  ADD KEY `FK_ratings_homeowner_ID` (`homeowner_ID`);

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
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Bills`
--
ALTER TABLE `Bills`
  MODIFY `bill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Cases`
--
ALTER TABLE `Cases`
  MODIFY `case_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Company_Services`
--
ALTER TABLE `Company_Services`
  MODIFY `cs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `Discounts`
--
ALTER TABLE `Discounts`
  MODIFY `discount_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Enquiries`
--
ALTER TABLE `Enquiries`
  MODIFY `enquiry_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Enquiries_Company`
--
ALTER TABLE `Enquiries_Company`
  MODIFY `ec_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `Enquiries_Homeowner`
--
ALTER TABLE `Enquiries_Homeowner`
  MODIFY `eh_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `Homeowners`
--
ALTER TABLE `Homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Homeowner_Services`
--
ALTER TABLE `Homeowner_Services`
  MODIFY `hs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Maintenance_Equipment`
--
ALTER TABLE `Maintenance_Equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Maintenance_Staff`
--
ALTER TABLE `Maintenance_Staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Ratings`
--
ALTER TABLE `Ratings`
  MODIFY `rating_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Services`
--
ALTER TABLE `Services`
  MODIFY `service_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `Water_Tracking`
--
ALTER TABLE `Water_Tracking`
  MODIFY `tracking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bills`
--
ALTER TABLE `Bills`
  ADD CONSTRAINT `FK_bills_client_ID` FOREIGN KEY (`client_ID`) REFERENCES `Clients` (`client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bills_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bills_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `FK_bookings_client_ID` FOREIGN KEY (`client_ID`) REFERENCES `Clients` (`client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bookings_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bookings_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Cases`
--
ALTER TABLE `Cases`
  ADD CONSTRAINT `FK_cases_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Clients`
--
ALTER TABLE `Clients`
  ADD CONSTRAINT `FK_clients_company_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_discounts_discount_ID` FOREIGN KEY (`discount_ID`) REFERENCES `Discounts` (`discount_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_clients_homeowners_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Company_Services`
--
ALTER TABLE `Company_Services`
  ADD CONSTRAINT `FK_company_services_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_company_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `Services` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Discounts`
--
ALTER TABLE `Discounts`
  ADD CONSTRAINT `FK_discounts_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Enquiries_Company`
--
ALTER TABLE `Enquiries_Company`
  ADD CONSTRAINT `FK_enquiriescomp_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Enquiries_Homeowner`
--
ALTER TABLE `Enquiries_Homeowner`
  ADD CONSTRAINT `FK_enquirieshome_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Homeowner_Services`
--
ALTER TABLE `Homeowner_Services`
  ADD CONSTRAINT `FK_homeowner_services_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_homeowner_services_service_ID` FOREIGN KEY (`service_ID`) REFERENCES `Services` (`service_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Maintenance_Equipment`
--
ALTER TABLE `Maintenance_Equipment`
  ADD CONSTRAINT `FK_maint_eq_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Maintenance_Staff`
--
ALTER TABLE `Maintenance_Staff`
  ADD CONSTRAINT `FK_staff_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ratings`
--
ALTER TABLE `Ratings`
  ADD CONSTRAINT `FK_ratings_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ratings_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Water_Tracking`
--
ALTER TABLE `Water_Tracking`
  ADD CONSTRAINT `FK_watertracking_company_ID` FOREIGN KEY (`company_ID`) REFERENCES `Company` (`company_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_watertracking_homeowner_ID` FOREIGN KEY (`homeowner_ID`) REFERENCES `Homeowners` (`homeowner_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
