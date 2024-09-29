-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 02:34 PM
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
-- Database: `iclinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(10) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `personal_address` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_no` varchar(12) NOT NULL,
  `emergency_contact_address` varchar(100) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `birthdate`, `age`, `sex`, `contact_no`, `personal_address`, `occupation`, `emergency_contact_name`, `emergency_contact_no`, `emergency_contact_address`, `profile`, `deleted`) VALUES
(4, 15, 'FRIEDA', 'TREVOR', 'REISS', 'NA', '2001-05-09', 23, 'FEMALE', '09111111111', 'ILANG ILANG STREET', 'STAFF', 'RALPH CUSTODIO', '09222222222', 'PUROK 6, TAUGTOG, BOTOLAN, ZAMBALES', 'REISS_15_20240713023617.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `appointment_id` int(11) NOT NULL,
  `appointment_no` varchar(255) NOT NULL,
  `appointment_description` varchar(255) NOT NULL,
  `appointment_description_others` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_status` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--

INSERT INTO `appointment_tbl` (`appointment_id`, `appointment_no`, `appointment_description`, `appointment_description_others`, `appointment_date`, `appointment_status`, `user_id`, `deleted`) VALUES
(3, 'APT-20240801-14-952c', 'MEDICAL CHECKUP', 'NONE', '2024-08-01', 'COMPLETED', 14, 0),
(4, 'APT-20240803-14-94b7', 'OTHERS', 'TEST', '2024-09-04', 'COMPLETED', 14, 0),
(8, 'APT-20240804-14-e6a4', 'OTHERS', 'TEST 2AAA', '2024-08-04', 'APPROVED', 14, 0),
(9, 'APT-20240817-14-a811', 'MEDICAL CHECKUP', 'NONE', '2024-08-17', 'APPROVED', 14, 0),
(10, 'APT-20240909-16-c02b', 'OTHERS', 'TEST', '2024-09-09', 'COMPLETED', 16, 0),
(11, 'APT-20240804-14-e6a4', 'OTHERS', 'TEST 2AAA', '2024-07-09', 'COMPLETED', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_vitals_tbl`
--

CREATE TABLE `appointment_vitals_tbl` (
  `appointment_vitals_id` int(11) NOT NULL,
  `blood_pressure` varchar(50) NOT NULL,
  `temperature` int(50) NOT NULL,
  `weight` int(50) NOT NULL,
  `height` int(50) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `date_completed` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_vitals_tbl`
--

INSERT INTO `appointment_vitals_tbl` (`appointment_vitals_id`, `blood_pressure`, `temperature`, `weight`, `height`, `diagnosis`, `appointment_id`, `date_completed`, `deleted`) VALUES
(1, '120/80', 36, 52, 160, 'NORMAL', 4, '2024-08-27 02:09:04', 0),
(2, '120/80', 38, 60, 156, 'FEVER', 3, '2024-08-27 04:26:23', 0),
(3, '120/80', 37, 52, 163, 'FEVER', 10, '2024-09-07 14:10:32', 0),
(4, '120/80', 37, 52, 163, 'FEVER', 11, '2024-07-24 14:10:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(10) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `personal_address` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_no` varchar(12) NOT NULL,
  `emergency_contact_address` varchar(100) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`employee_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `birthdate`, `age`, `sex`, `contact_no`, `personal_address`, `occupation`, `emergency_contact_name`, `emergency_contact_no`, `emergency_contact_address`, `profile`, `deleted`) VALUES
(4, 16, 'SATOURO', '', 'GOJO', 'NA', '2001-05-09', 23, 'MALE', '09123456777', 'ILANG ILANG', 'INSTRUCTOR', 'GETO SUGURO', '09123456666', 'ILANG ILANG', 'GOJO_16_20240906071753.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_release_tbl`
--

CREATE TABLE `item_release_tbl` (
  `release_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_released` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  `released_to` int(11) NOT NULL,
  `released_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_release_tbl`
--

INSERT INTO `item_release_tbl` (`release_id`, `item_id`, `quantity_released`, `release_date`, `released_to`, `released_by`) VALUES
(1, 1, 5, '2024-09-29 13:09:22', 14, 15),
(2, 1, 5, '2024-09-29 13:09:22', 16, 15);

-- --------------------------------------------------------

--
-- Table structure for table `item_tbl`
--

CREATE TABLE `item_tbl` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `expiry_date` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_tbl`
--

INSERT INTO `item_tbl` (`item_id`, `item_name`, `description`, `quantity_in_stock`, `unit`, `expiry_date`, `added_by`, `deleted`) VALUES
(1, 'PARACETAMOL', 'PARACETAMOL', 15, 'MG', '2024-09-25', 15, 0),
(2, 'AMOXICILLIN', 'AMOXICILLIN', 30, 'MG', '2025-09-01', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transaction_tbl`
--

CREATE TABLE `stock_transaction_tbl` (
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_by` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_transaction_tbl`
--

INSERT INTO `stock_transaction_tbl` (`transaction_id`, `item_id`, `transaction_type`, `quantity`, `transaction_date`, `transaction_by`, `remarks`) VALUES
(7, 2, 'STOCKS REDUCED', -5, '2024-09-29 07:49:02', 15, 'STOCK ADJUSTMENT'),
(8, 1, 'STOCKS REDUCED', -5, '2024-09-29 07:51:19', 15, 'STOCK ADJUSTMENT'),
(11, 2, 'STOCKS ADDED', 4, '2024-09-29 08:09:19', 15, 'STOCK ADJUSTMENT'),
(12, 2, 'STOCKS REDUCED', -5, '2024-09-29 08:09:41', 15, 'STOCK ADJUSTMENT');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(10) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `personal_address` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year_level` tinyint(5) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_no` varchar(12) NOT NULL,
  `emergency_contact_address` varchar(100) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `birthdate`, `age`, `sex`, `contact_no`, `personal_address`, `course`, `year_level`, `emergency_contact_name`, `emergency_contact_no`, `emergency_contact_address`, `profile`, `deleted`) VALUES
(3, 14, 'RALPH', 'DOCUTIN', 'CUSTODIO', 'II', '2001-05-09', 22, 'MALE', '09123456789', 'PUROK 6, TAUGTOG, BOTOLAN, ZAMBALES', 'BSFi', 3, 'FRIEDA REISS', '09123456789', 'ILANG ILANG STREET', 'CUSTODIO_14_20240713023209.png', 0),
(5, 17, 'LEVI', 'ORIENTAL', 'ACKERMAN', 'IV', '2024-09-20', 0, 'MALE', '09123456789', 'ILANG ILANG STREET, TAUGTOG, BOTOLAN, ZAMBALES', 'BSFi', 4, 'MIKASA ACKERMAN', '09123456789', 'ILANG ILANG STREET, TAUGTOG, BOTOLAN, ZAMBALES', 'ACKERMAN_17_20240921150339.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = deleted, 0 = not deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `no`, `email`, `password`, `role`, `status`, `deleted`) VALUES
(14, '20-00237', 'ralphcustodio@proton.me', '$2y$10$Ik0x7voh7NKupx/yrvH3eeWe5FQnZh5WuLhuxjNIeL37A5dzgbnCi', 'STUDENT', 'APPROVED', 0),
(15, '20-00238', 'friedareiss@proton.me', '$2y$10$SaHjeR0XMwNrCoKfKC0E0e/krZcqiaInVi7SwlsTXZocJ5vp3WjJi', 'ADMIN', 'APPROVED', 0),
(16, '20-00239', 'gojosaturo@gmail.com', '$2y$10$/vFrWeidquBhhnX37oNHx.jhfnbFxL/wlmlorMTWbyq6x/LMSq7tO', 'EMPLOYEE', 'APPROVED', 0),
(17, '20-00232', 'leviackerman@gmail.com', '$2y$10$YCX5NLhGjcT2tQeWhhOQhOSFkD/Qi1wuCXDPsrnLCuH2IM0mJRiCC', 'STUDENT', 'APPROVED', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointment_vitals_tbl`
--
ALTER TABLE `appointment_vitals_tbl`
  ADD PRIMARY KEY (`appointment_vitals_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `item_release_tbl`
--
ALTER TABLE `item_release_tbl`
  ADD PRIMARY KEY (`release_id`);

--
-- Indexes for table `item_tbl`
--
ALTER TABLE `item_tbl`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `stock_transaction_tbl`
--
ALTER TABLE `stock_transaction_tbl`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `appointment_vitals_tbl`
--
ALTER TABLE `appointment_vitals_tbl`
  MODIFY `appointment_vitals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_release_tbl`
--
ALTER TABLE `item_release_tbl`
  MODIFY `release_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_tbl`
--
ALTER TABLE `item_tbl`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_transaction_tbl`
--
ALTER TABLE `stock_transaction_tbl`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
