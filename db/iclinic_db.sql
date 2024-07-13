-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2024 at 07:50 AM
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
(3, 15, 'FRIEDA', 'TREVOR', 'REISS', 'NA', '2001-05-09', 23, 'FEMALE', '09111111111', 'ILANG ILANG STREET', 'STAFF', 'RALPH CUSTODIO', '09222222222', 'PUROK 6, TAUGTOG, BOTOLAN, ZAMBALES', 'REISS_15_20240713023617.png', 0);

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
(3, 14, 'RALPH', 'DOCUTIN', 'CUSTODIO', 'II', '2001-09-05', 22, 'MALE', '09123456789', 'PUROK 6, TAUGTOG, BOTOLAN, ZAMBALES', 'BSIT', 3, 'FRIEDA REISS', '09123456789', 'ILANG ILANG STREET', 'CUSTODIO_14_20240713023209.png', 0);

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
(14, '20-00237', 'ralphcustodio@proton.me', '$2y$10$.FOqNGlceW0fxcGgr2K9EuWeAKkbh6jidapvpu2T8K0CQibaoZ1qe', 'STUDENT', 'PENDING', 0),
(15, '20-00238', 'friedareiss@proton.me', '$2y$10$SaHjeR0XMwNrCoKfKC0E0e/krZcqiaInVi7SwlsTXZocJ5vp3WjJi', 'EMPLOYEE', 'PENDING', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`employee_id`);

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
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
