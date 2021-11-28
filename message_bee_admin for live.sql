-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 12:53 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

CREATE TABLE `account_info` (
  `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `account_num` varchar(25) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `home_town` varchar(16) DEFAULT NULL,
  `city` varchar(16) DEFAULT NULL,
  `country` varchar(16) DEFAULT NULL,
  `work` varchar(25) DEFAULT NULL,
  `company` varchar(70) DEFAULT NULL,
  `cirtificate` varchar(25) DEFAULT NULL,
  `institute` varchar(70) DEFAULT NULL,
  `relationship` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(50) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `sent_id` varchar(50) DEFAULT NULL,
  `receive_id` varchar(50) DEFAULT NULL,
  `sender_deletion` varchar(11) DEFAULT NULL,
  `receiver_deletion` varchar(11) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `reply_with_id`	int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `sent_id` varchar(20) DEFAULT NULL,
  `receive_id` varchar(20) DEFAULT NULL,
  `sender_session` varchar(12) DEFAULT NULL,
  `receiver_session` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `unique_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
