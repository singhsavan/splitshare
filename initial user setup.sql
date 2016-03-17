-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 02:58 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `splitnshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `balance_name` varchar(52) NOT NULL,
  `balance_owes` int(11) NOT NULL,
  `balance_getback` int(11) NOT NULL,
  `group_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`balance_id`, `balance_name`, `balance_owes`, `balance_getback`, `group_name`) VALUES
(1, 'tofiq', 0, 0, 'roommies'),
(2, 'alina', 0, 0, 'roommies'),
(3, 'aqib', 0, 0, 'roommies'),
(4, 'altaf', 0, 0, 'roommies'),
(5, 'sohil', 0, 0, 'roommies'),
(6, 'rashmi', 0, 0, 'roommies');

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
(1, 'roommies', 'tofiq');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(52) NOT NULL,
  `member_email` varchar(52) NOT NULL,
  `member_group` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`member_id`, `member_name`, `member_email`, `member_group`) VALUES
(1, 'tofiq', 'tofiq@yopmail.com', 'roommies'),
(2, 'alina', 'alina@yopmail.com', 'roommies'),
(3, 'aqib', 'aqib@yopmail.com', 'roommies'),
(4, 'altaf', 'altaf@yopmail.com', 'roommies'),
(5, 'sohil', 'sohil@yopmail.com', 'roommies'),
(6, 'rashmi', 'rashmi@yopmail.com', 'roommies');

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
(6, 'rashmi', 'rashmi@yopmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'user', 0, 1);

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
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
