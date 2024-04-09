-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 12:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`, `phone`, `profile_image`, `address`, `user_type`, `last_login_ip`, `last_login`, `last_logout`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', '9830098300', 'uploads/no-user-image.jpg', 'Dum Dum,700053', 'Admin Level', '::1', '2024-04-08 21:56:29', '2024-04-08 23:53:29'),
(2, 'senior', 'e10adc3949ba59abbe56e057f20f883e', 'senior@gmail.com', '9830098310', 'uploads/no-user-image.jpg', 'Kolkata,700054', 'Senior Level', '::1', '2024-04-08 21:52:47', '2024-04-08 21:52:58'),
(3, 'entry', 'e10adc3949ba59abbe56e057f20f883e', 'entry@gmail.com', '9830098100', 'uploads/no-user-image.jpg', 'salt lake,700055', 'Entry Level', '::1', '2024-04-08 23:54:50', '2024-04-09 00:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `schemes`
--

CREATE TABLE `schemes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `authorized_by` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schemes`
--

INSERT INTO `schemes` (`id`, `name`, `authorized_by`, `status`) VALUES
(1, 'L1', 2, 1),
(2, 'L2', 1, 1),
(3, 'L4', 1, 1),
(4, 'L3', 2, 1),
(6, 'L5', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `scheme_type` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `forwarded_by` int(11) NOT NULL,
  `forwarded_to` int(11) NOT NULL,
  `forwarded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_to` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_by` int(11) NOT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `full_name`, `email`, `phone`, `date_of_birth`, `gender`, `scheme_type`, `created_by`, `updated_by`, `forwarded_by`, `forwarded_to`, `forwarded_at`, `created_at`, `updated_at`, `approved_to`, `approved_by`, `approved_at`, `rejected_by`, `rejected_at`) VALUES
(1, 'arnab', 'saha', 'arnab saha', 'abc90@gmail.com', '1234567893', '2022-02-02', 'Male', 1, 3, 0, 2, 2, '0000-00-00 00:00:00', '2024-04-08 06:33:15', NULL, 1, 1, '0000-00-00 00:00:00', 0, NULL),
(2, 'akash', 'roy', 'akash roy', 'asd@gmail.com', '1234567899', '2023-09-08', 'Male', 2, 3, 0, 3, 1, '0000-00-00 00:00:00', '2024-04-08 07:43:16', NULL, 0, 0, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00'),
(4, 'Sumi', 'Debnath', 'Sumi Debnath', 'adb@gmail.com', '1234567879', '2023-12-12', 'Female', 3, 3, 3, 0, 0, NULL, '2024-04-08 22:00:41', '0000-00-00 00:00:00', 0, 0, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schemes`
--
ALTER TABLE `schemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schemes`
--
ALTER TABLE `schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
