-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2016 at 03:18 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a4086541_splitn`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `balance_name` varchar(52) NOT NULL,
  `total_balance` int(11) NOT NULL,
  `share` int(11) NOT NULL,
  `balance_value` int(11) NOT NULL,
  `group_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `balance_name`, `total_balance`, `share`, `balance_value`, `group_name`) VALUES
(1, 'tofiq', 1210, 261, -949, 'roommies'),
(2, 'alina', 0, 261, 261, 'roommies'),
(3, 'aqib', 0, 261, 261, 'roommies'),
(4, 'altaf', 117, 261, 144, 'roommies'),
(5, 'sohil', 240, 261, 21, 'roommies'),
(6, 'rashmi', 0, 261, 261, 'roommies'),
(7, 'savan', 0, 170, 170, 'Calgary'),
(8, 'tofiq', 0, 170, 170, 'Calgary'),
(9, 'manoj', 510, 170, -340, 'Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_desc` varchar(500) NOT NULL,
  `expense_amount` int(11) NOT NULL,
  `expense_by` varchar(52) NOT NULL,
  `expense_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_desc`, `expense_amount`, `expense_by`, `expense_date`, `group_name`) VALUES
(2, 'abc', 120, 'sohil', '2016-03-16 01:42:34', 'roommies'),
(3, 'rent', 200, 'tofiq', '2016-03-16 01:43:10', 'roommies'),
(4, 'chips', 10, 'tofiq', '2016-03-16 01:45:05', 'roommies'),
(7, 'hru', 117, 'altaf', '2016-03-16 08:55:23', 'roommies'),
(9, 'testing', 100, 'tofiq', '2016-03-17 12:09:46', 'roommies'),
(10, 'testing', 100, 'tofiq', '2016-03-17 12:09:55', 'roommies'),
(11, 'testing', 100, 'tofiq', '2016-03-17 12:10:03', 'roommies'),
(12, 'testing', 100, 'tofiq', '2016-03-17 12:10:21', 'roommies'),
(13, 'testing', 100, 'tofiq', '2016-03-20 03:03:43', 'roommies'),
(14, 'testing', 100, 'tofiq', '2016-03-20 06:14:19', 'roommies'),
(15, 'transport', 500, 'manoj', '2016-03-24 22:14:05', 'Calgary'),
(16, 'drinks', 10, 'manoj', '2016-03-24 22:43:26', 'Calgary'),
(17, 'loblaw', 120, 'sohil', '2016-03-27 00:40:49', 'roommies'),
(18, 'testing', 100, 'tofiq', '2016-03-27 12:06:03', 'roommies');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(52) NOT NULL,
  `created_by` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `created_by`) VALUES
(1, 'roommies', 'tofiq'),
(3, 'Calgary', 'savan');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(52) NOT NULL,
  `member_email` varchar(52) NOT NULL,
  `member_group` varchar(52) NOT NULL,
  `user_type` varchar(52) NOT NULL,
  `created_group` tinyint(1) NOT NULL,
  `member_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`member_id`, `member_name`, `member_email`, `member_group`, `user_type`, `created_group`, `member_active`) VALUES
(1, 'tofiq', 'tofiq@yopmail.com', 'roommies', 'admin', 1, 1),
(2, 'alina', 'alina@yopmail.com', 'roommies', 'user', 0, 1),
(3, 'aqib', 'aqib@yopmail.com', 'roommies', 'user', 0, 1),
(4, 'altaf', 'altaf@yopmail.com', 'roommies', 'user', 0, 1),
(5, 'sohil', 'sohil@yopmail.com', 'roommies', 'user', 0, 1),
(6, 'rashmi', 'rashmi@yopmail.com', 'roommies', 'user', 0, 1),
(8, 'savan', 'savan@yopmail.com', 'Calgary', 'admin', 1, 1),
(9, 'tofiq', 'tofiq@yopmail.com', 'Calgary', 'user', 0, 1),
(10, 'manoj', 'manoj@yopmail.com', 'Calgary', 'user', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(52) NOT NULL,
  `password` varchar(52) NOT NULL,
  `usertype` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `usertype`) VALUES
(1, 'tofiq', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(4, 'altaf', 'cc03e747a6afbbcbf8be7668acfebee5', 'user'),
(5, 'sohil', 'cc03e747a6afbbcbf8be7668acfebee5', 'user'),
(9, 'manoj', 'cc03e747a6afbbcbf8be7668acfebee5', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `settle_up`
--

CREATE TABLE `settle_up` (
  `id` int(11) NOT NULL,
  `paid_by` varchar(52) NOT NULL,
  `paid_to` varchar(52) NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settle_up`
--

INSERT INTO `settle_up` (`id`, `paid_by`, `paid_to`, `amount`, `timestamp`) VALUES
(1, 'alina', 'tofiq', 183, '2016-03-27 02:28:00'),
(6, 'aqib', 'sohil', 50, '2016-03-27 03:47:33'),
(7, 'rashmi', 'sohil', 7, '2016-03-27 03:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(52) NOT NULL,
  `email_address` varchar(52) NOT NULL,
  `password` varchar(52) NOT NULL,
  `usertype` varchar(52) NOT NULL,
  `group_created` tinyint(1) NOT NULL,
  `member_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email_address`, `password`, `usertype`, `group_created`, `member_active`) VALUES
(1, 'tofiq', 'tofiq@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin', 1, 1),
(2, 'alina', 'alina@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1),
(3, 'aqib', 'aqib@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1),
(4, 'altaf', 'altaf@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1),
(5, 'sohil', 'sohil@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1),
(6, 'rashmi', 'rashmi@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1),
(8, 'savan', 'savan@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin', 1, 1),
(9, 'manoj', 'manoj@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settle_up`
--
ALTER TABLE `settle_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `settle_up`
--
ALTER TABLE `settle_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
