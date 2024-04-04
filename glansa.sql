-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 07:18 AM
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
-- Database: `glansa`
--

-- --------------------------------------------------------

--
-- Table structure for table `anita`
--

CREATE TABLE `anita` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `datatypes`
--

CREATE TABLE `datatypes` (
  `id` int(10) NOT NULL,
  `dtypeName` varchar(225) NOT NULL,
  `dtypeSize` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datatypes`
--

INSERT INTO `datatypes` (`id`, `dtypeName`, `dtypeSize`) VALUES
(1, 'int', 10),
(2, 'varchar', 255);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(50) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `group_id` varchar(50) NOT NULL,
  `head` varchar(50) NOT NULL,
  `createdOn` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `group_id`, `head`, `createdOn`, `status`) VALUES
(3, 'Design', 'Shree', 'shree@glansa.in', '2024-04-01', '1'),
(4, 'Digital', 'Rahul Rajput', 'rahull@glansa.in', '2024-04-01', '1'),
(5, 'Development', 'Krishna', 'krishna@gmail.com', '2024-04-01', '1'),
(6, 'All', 'Naresh', 'naresh@glansa.in', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lead_design`
--

CREATE TABLE `lead_design` (
  `id` int(11) NOT NULL,
  `Total` int(10) DEFAULT NULL,
  `Accepted` int(10) DEFAULT NULL,
  `Rejected` int(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lead_design`
--

INSERT INTO `lead_design` (`id`, `Total`, `Accepted`, `Rejected`, `created_date`, `modified_date`) VALUES
(1, 90, 10, 10, '2024-04-03 13:31:45', '2024-04-03 13:31:45'),
(2, 90, 10, 10, '2024-04-04 04:24:59', '2024-04-04 04:24:59'),
(3, 90, 10, 10, '2024-04-04 04:26:19', '2024-04-04 04:26:19'),
(4, 90, 10, 10, '2024-04-04 04:26:58', '2024-04-04 04:26:58'),
(5, 90, 10, 10, '2024-04-04 04:30:15', '2024-04-04 04:30:15'),
(6, 90, 10, 10, '2024-04-04 04:30:24', '2024-04-04 04:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(255) NOT NULL,
  `dept_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `submodule_name` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `dept_id`, `name`, `submodule_name`, `created_on`, `created_by`, `status`) VALUES
(1, 3, 'lead', 'lead_Design', '2024-04-03 17:25:47', 'Naresh', 1),
(2, 4, 'Sales', 'Sales_Digital', '2024-04-03 18:35:24', 'Naresh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `email`, `name`, `department`, `password`, `created_on`, `created_by`) VALUES
(3, 'Ramya', 'anitaseth1997@gmail.com', 'Anita', 'test', '$2y$10$fzVio0NogUFcMWHWlmhZF.4hojcFFuUsREgMPKNA8vOLPPBnCM/JW', '0000-00-00', ''),
(4, 'anita seth', 'anita@glansa.in', 'test', 'HR', '$2y$10$LbCHUUdQsBJiXFiEoZramussw1xNvJ77MpyBvhiPAMWZnhG5pvzSO', '0000-00-00', ''),
(5, 'anita ', 'anita.glansa@gmail.com', 'Anita', 'HR', '$2y$10$783SxsAI0si6NrrGG63Ode5.SehXh0gOV9qLjCgAW/oA61gtAg4L2', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(50) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `createdOn`) VALUES
(1, 'user', '2024-04-01 08:25:48'),
(2, 'admin', '2024-04-01 08:26:10'),
(3, 'department', '2024-04-01 08:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `sales_digital`
--

CREATE TABLE `sales_digital` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_digital`
--

INSERT INTO `sales_digital` (`id`, `name`, `email`, `phone`, `created_date`, `modified_date`) VALUES
(1, 'anita', 'anita', 'anita', '2024-04-03 13:14:23', '2024-04-03 13:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '1',
  `role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `department`, `mobile`, `email`, `password`, `emp_id`, `status`, `role`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Anita', 'Development', '9918277764', 'anitaseth1997@gmail.com', '$2y$10$4EzOiV5FsEmoA1GMqpIC7usAhjn08s.cQUxRiztDBVoFjLReDOarC', 'EMP -1', '1', 'user', '2024-04-01 15:51:02', '', '0000-00-00 00:00:00', ''),
(2, 'soumya', 'Development', '89917288875', 'soumya@glansa.in', '$2y$10$yPtQOtgHF5ToDYNov9dNh.ZmK9gnx0IvFmogA7auo1DrFTLGO9UtG', 'EMP -2', '1', 'user', '2024-04-01 15:51:52', '', '0000-00-00 00:00:00', ''),
(3, 'Bindu', 'Digital', '9125676090', 'Bindu@glansa.in', '$2y$10$f2XOKWykKxgaozUzMy93Be7NExn7oDvVsZF7ROfVNmeEWXctph4.u', 'EMP-3', '1', 'user', '2024-04-01 15:53:04', '', '0000-00-00 00:00:00', ''),
(5, 'Naresh', 'All', '9125676090', 'anita@glansa.in', '$2y$10$A6p4L6cq0qbQxlUJEHHDK.0Bd74GZjCFbFo9BDT6OnKbAikvcg2jK', 'EMP-0', '1', 'admin', '2024-04-01 15:55:54', '', '0000-00-00 00:00:00', ''),
(6, 'Krishna', 'Development', '9918277764', 'anita.glansa@gmail.com', '$2y$10$wSiwu00P1PK.xtzyTs4eMeiDQ8o6BqyMlSMrwAq4nihZwg4DSGm.O', 'EMP -4', '1', 'department', '2024-04-01 16:00:38', '', '0000-00-00 00:00:00', ''),
(7, 'sasi', 'Development', '9918277764', 'sasianarchi@gmail.com', '$2y$10$ZZ9wvna6oDdiE.U7HN908.vbQxWDQoQWLXyHMh0JmQ4C62s24ubYa', 'EMP-7', '1', 'user', '2024-04-02 11:28:07', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `vishal`
--

CREATE TABLE `vishal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anita`
--
ALTER TABLE `anita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datatypes`
--
ALTER TABLE `datatypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_design`
--
ALTER TABLE `lead_design`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_digital`
--
ALTER TABLE `sales_digital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vishal`
--
ALTER TABLE `vishal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anita`
--
ALTER TABLE `anita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datatypes`
--
ALTER TABLE `datatypes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lead_design`
--
ALTER TABLE `lead_design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_digital`
--
ALTER TABLE `sales_digital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vishal`
--
ALTER TABLE `vishal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
