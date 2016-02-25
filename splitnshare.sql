-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2016 at 10:20 PM
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, ''),
(2, ''),
(3, 'roadtrip'),
(4, ''),
(5, 'road'),
(6, '123'),
(7, ''),
(8, 'fhfdf'),
(9, 'fhfdf');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(52) NOT NULL,
  `member_email` int(11) NOT NULL,
  `member_groupid` int(11) NOT NULL,
  `member_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'tofiq', '5630a34b7dcaad80b684530e5414d604', 'admin'),
(2, 'tofiq', '5630a34b7dcaad80b684530e5414d604', 'admin'),
(6, 'alina', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(52) NOT NULL,
  `email_address` varchar(52) NOT NULL,
  `password` varchar(52) NOT NULL,
  `usertype` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email_address`, `password`, `usertype`) VALUES
(2, 'tofiq', 'tofiq@mailinator.com', '5630a34b7dcaad80b684530e5414d604', 'admin'),
(3, 'aqib', '', 'test123', ''),
(4, 'altaf', 'aqib@mailinator.com', 'test123', ''),
(5, '123', '123@mailinator.com', 'test123', 'admin'),
(6, 'alina', 'alina@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(7, 'sohil', 'sohil@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(8, 'rashmin', 'rashmin@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(9, 'tofiq1', 'tofiq1@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(10, 'tofiq2', 'tofiq2@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(11, 'tofiq3', 'tofiq3@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(12, 'savan', 'savantest@mailinator.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
