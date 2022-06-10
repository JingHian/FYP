-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 03:09 PM
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
(1, 'company1', '$2y$10$EMN7mmj/Bjue7q65NStNJ.Xtp01Bmj6xUb5U4s/pt5IxL1EECZAW6', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123456, 'company', 0, 0),
(2, 'company2', '$2y$10$VNtfG56fmaO4tkp6323zzuM7ojJA0/jjhU1WkDRxQVgXUlJPi6GmC', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'company', 0, 0);

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
(1, 'homeowner1', '$2y$10$9AkQyZGG2V3iOcMzHiNCSetykaq0aT8lSahw4v3QB8hmGVcZuPTdS', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '4room', 'homeowner', 0),
(2, 'homeowner2', '$2y$10$dJN9fv.Z.Roeh0/qOU99Nup8da4Sk6NHHQDphrh6HRInU7cgKqPM2', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '4room', 'homeowner', 0),
(3, 'homeowner3', '$2y$10$CQ0/ugRdlZQFeJkLX8ty8exjXdE8A9RzTyYrzQi1J7rCuCDMqtNP.', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '5room', 'homeowner', 0),
(4, 'homeowner4', '$2y$10$Ndy574KevKhZbby5BHb9bOZNCTVWHQ3NpfBTX7lRbM8gRKX3H.Gpm', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, '2room', 'homeowner', 0),
(5, 'homeowner6', '$2y$10$t8cbQun8xyivIpv51FMZ.OnqZwuLqz78oQeyTdQpln9iUvnfuwzg.', 'Test', 'test@mail.com', 98765432, '123 Test Avenue 12 #4-2192', 123942, 'condo', 'homeowner', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `homeowners`
--
ALTER TABLE `homeowners`
  ADD PRIMARY KEY (`homeowner_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homeowners`
--
ALTER TABLE `homeowners`
  MODIFY `homeowner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
