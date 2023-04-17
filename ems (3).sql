-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 05:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift` int(11) NOT NULL COMMENT '0 for day shift, 1 for night 1st half and 2 for night 2nd half',
  `entry_time` time NOT NULL,
  `exit_time` time NOT NULL,
  `holiday` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `user_id`, `shift`, `entry_time`, `exit_time`, `holiday`) VALUES
(1, 1, 0, '09:00:00', '18:00:00', 'Sa'),
(2, 2, 1, '09:00:00', '18:30:00', 'Fr'),
(3, 12, 0, '12:12:00', '12:13:00', 'Fr');

-- --------------------------------------------------------

--
-- Table structure for table `dailycost`
--

CREATE TABLE `dailycost` (
  `ID` int(11) NOT NULL,
  `cost_date` date NOT NULL,
  `cost_purpose` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `paid_by` varchar(40) NOT NULL,
  `money_receipt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dailycost`
--

INSERT INTO `dailycost` (`ID`, `cost_date`, `cost_purpose`, `total_amount`, `paid_by`, `money_receipt`) VALUES
(1, '2023-04-06', 'Daily for training members', 5600, 'Rakib Ahamed', '904867985Pink Floral Watercolor Beauty Quote Facebook Post (2).png'),
(9, '2023-04-09', 'plants for office', 3265, 'Mehedi ', '1425186501Untitled design.png'),
(12, '2023-04-13', 'testing', 1234, 'rakib', '501614336IMG_2500.jpg;111856864Shafin 2.JPEG;578398069Pink Floral Watercolor Beauty Quote Facebook Post.png;');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_salary` int(11) NOT NULL,
  `target_per_month` int(11) NOT NULL,
  `bonus_level` int(11) NOT NULL,
  `update_history` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`ID`, `user_id`, `current_salary`, `target_per_month`, `bonus_level`, `update_history`) VALUES
(1, 3, 16800, 50000, 1, ''),
(2, 1, 25600, 60000, 2, ''),
(3, 12, 122323, 1233, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `take_attendance`
--

CREATE TABLE `take_attendance` (
  `ID` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `cdate` date NOT NULL,
  `entry_time` time DEFAULT NULL,
  `exit_time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 3 COMMENT '1 for late, 2 for halfday, 3 for absent and 4 for present\r\n',
  `comment` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `take_attendance`
--

INSERT INTO `take_attendance` (`ID`, `employee_id`, `cdate`, `entry_time`, `exit_time`, `status`, `comment`, `ip`) VALUES
(1, 'MIT-T01', '2023-04-10', '08:38:46', '18:03:15', 1, '', ''),
(2, 'MIT-T01', '2023-04-08', '08:48:46', '00:00:00', 1, '', ''),
(3, 'MIT-T01', '2023-04-07', '09:13:46', '19:09:15', 1, '', ''),
(4, 'MIT-T01', '2023-04-06', '11:23:57', NULL, 0, '', ''),
(5, 'MIT-T01', '2023-04-09', '08:36:00', '18:36:00', 0, '', ''),
(6, 'MIT-T01', '2023-04-10', '08:36:00', '18:14:00', 0, '', ''),
(13, 'MIT-T01', '2023-04-11', '16:26:29', '16:27:01', 3, '', '::1'),
(14, 'MIT-T01', '2023-04-12', '09:37:46', '00:00:00', 3, '', '::1'),
(15, 'MIT-T01', '2023-04-13', '09:45:16', '14:32:10', 3, '', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `emergency_content` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `official_document` text NOT NULL,
  `joining_date` date NOT NULL,
  `biodata` text NOT NULL,
  `usertype` int(11) NOT NULL COMMENT '0 for intern, 1 for employee, 2 for admin, 3 for super admin',
  `status` int(11) NOT NULL COMMENT '0 for inactive and 1 for active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `email`, `password`, `gender`, `dept`, `position`, `employee_type`, `employee_id`, `phone`, `address`, `dob`, `emergency_content`, `photo`, `official_document`, `joining_date`, `biodata`, `usertype`, `status`) VALUES
(1, 'omarfaruk', 'umarfaruque.tipu@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Male', 'Business', 'Training Coordinator', '1', 'MIT-T01', 1773357272, 'house no 11, road 9, block A, section 11, mirpur 11, dhaka', '1996-01-05', 1851168869, '1885177596oamrt.png', ';back.jpg;NID-Card4.jpg', '2023-03-13', '', 1, 1),
(2, 'fatinnoor', 'fatinnoor885@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Male', 'Business', 'Graphic Designer', '1', 'MIT-T02', 1770265787, 'khilgaon, Dhaka', '2004-04-09', 1790404203, 'fatin.png', 'fatinnid.png', '2022-11-18', '', 1, 1),
(3, 'Testing user', 'test@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', 'Business', '', '', 'MIT-003', 1851168869, '', '', 0, '', '', '2022-04-06', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere dolores aliquid sequi sunt iusto ipsum earum natus omnis asperiores architecto praesentium dignissimos pariatur, ipsa cum? Voluptate vero eius at voluptas?', 0, 1),
(4, 'admin', 'admin@gmail.com', '4120aba3b4022b15b48c4f72df4ff038e31173cc', '', '', '', '', '', 0, '', '', 0, '', '', '0000-00-00', '', 3, 1),
(12, 'Fatin Noor', 'fatin2@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'Male', 'Training', 'Graphic Designer', '1', '01', 1773357272, '', '2023-04-05', 0, '', '', '2022-07-18', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dailycost`
--
ALTER TABLE `dailycost`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `take_attendance`
--
ALTER TABLE `take_attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dailycost`
--
ALTER TABLE `dailycost`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `take_attendance`
--
ALTER TABLE `take_attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
