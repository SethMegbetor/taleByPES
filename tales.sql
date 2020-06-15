-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 02:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tales`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`id`, `name`) VALUES
(1, 'Active'),
(2, 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `name`) VALUES
(1, 'Accra Main'),
(2, 'Ho'),
(3, 'Takoradi'),
(4, 'Kumasi');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `created_at`, `updated_at`) VALUES
(1, 'IT450', 'Information Systems', '2020-06-14 15:24:01', NULL),
(3, 'IT267', 'Information Technlogy Law', '2020-06-14 15:30:26', '2020-06-14 15:49:47'),
(4, 'IT222', 'Functional French', '2020-06-14 15:30:48', NULL),
(5, 'IT111', 'Principles of Programming', '2020-06-14 15:31:26', NULL),
(6, 'IT231', 'Principles of Entrepreneurship ', '2020-06-14 15:31:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Faculty of Engineering '),
(2, 'Faculty of IT Business ');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`) VALUES
(1, '100'),
(2, '200'),
(3, '300'),
(4, '400');

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Bsc Information Technology', '2020-06-13 14:23:02', '2020-06-14 06:21:52'),
(4, 'Bsc Administration', '2020-06-13 14:40:48', NULL),
(5, 'Bsc Telecom Engineering ', '2020-06-14 06:05:01', NULL),
(6, 'Bsc Procurement and Logistics ', '2020-06-15 06:10:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `index_no` varchar(10) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `campus_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `index_no`, `department_id`, `level_id`, `programme_id`, `email`, `campus_id`, `address`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Godson Akpah', 'HT4789500', 1, 1, 3, 'akpah@tales.com', 2, 'BOX 77 HO', '$2y$10$fOKgG8KT05PeoQUDWvbwsuJkA1ib1Ap4HyU7X05K93r3xOUwb5d2u', '2020-06-14 22:32:46', NULL),
(2, 'Mabel Amesu', 'HT4789501', 2, 2, 4, 'mabel@tales.com', 1, 'BOX 6 Kpando', '$2y$10$Wig2I0bDMgoM/nNFkQWBz.pLKncACr3RWf2GFZPKLivcrdhT6AFZ2', '2020-06-14 23:07:07', NULL),
(4, 'Marvel Sedorich', 'HT4789503', 1, 4, 5, 'marvel@tales.com', 3, 'BOX 72 Anloga ', '$2y$10$QTVq6qA4uV0ETWFLK2uKeerk7I.HFlylO2p623XhSIkNy6xbmFypq', '2020-06-14 23:29:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `department_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `account_status` int(11) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `department_id`, `category_id`, `email`, `account_status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Seth Megbetor', 1, 1, 'seth@tales.com', 1, '$2y$10$yWMp0MZiQr46YO1DTpfL7.hJteN6l6HfPJI9YZvmZ/nfoL7aBfijq', '2020-06-11 23:16:28', '2020-06-12 04:52:11'),
(2, 'Patience Baniba', 2, 2, 'pat@tales.com', 1, '$2y$10$o4WBqQgiBOF8mFo3hlbW3.GNaoSBUczV1SdmX8AZ6V7o/iJHupRH2', '2020-06-12 04:51:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_categories`
--

INSERT INTO `user_categories` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Faculty ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_status`
--
ALTER TABLE `account_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
