-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 06:33 PM
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
-- Database: `db_maverick_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_notifs`
--

CREATE TABLE `candidate_notifs` (
  `notification_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_notifs`
--

INSERT INTO `candidate_notifs` (`notification_id`, `type`, `message`, `is_read`, `created_at`) VALUES
(1, 'candidate_add', 'Added candidate: FEU TECH', 0, '2025-07-15 15:57:20'),
(2, 'candidate_update', 'Updated candidate: Joselito Mariones', 0, '2025-07-15 16:02:37'),
(3, 'candidate_update', 'Updated candidate: Joselito Mario', 0, '2025-07-15 16:02:50'),
(4, 'candidate_add', 'Added candidate: Jose Ferrer', 0, '2025-07-15 16:03:05'),
(5, 'candidate_add', 'Added candidate: Mariano Teeves', 0, '2025-07-15 16:03:43'),
(6, 'candidate_add', 'Added candidate: Grand Theft Auto 6', 0, '2025-07-15 16:06:42'),
(7, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:07:01'),
(8, 'candidate_update', 'Updated candidate: Allas De Alas', 0, '2025-07-15 16:07:55'),
(9, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:08:18'),
(10, 'candidate_update', 'Updated candidate: Allas De Alas', 0, '2025-07-15 16:08:32'),
(11, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:26:30'),
(12, 'candidate_update', 'Updated candidate: Allas De Alas', 0, '2025-07-15 16:26:53'),
(13, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:27:19'),
(14, 'candidate_update', 'Updated candidate: Allas De Alas', 0, '2025-07-15 16:29:00'),
(15, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_tbl`
--

CREATE TABLE `candidate_tbl` (
  `candidate_id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `position_id` int(11) NOT NULL,
  `partylist_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `candidate_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_tbl`
--

INSERT INTO `candidate_tbl` (`candidate_id`, `full_name`, `position_id`, `partylist_id`, `election_id`, `created_at`, `candidate_image`) VALUES
(1, 'Allas De Alasa', 1, 1, 1, '2025-07-15 04:42:17', NULL),
(2, 'Juan Dela Cruz', 2, 1, 1, '2025-07-15 04:43:05', NULL),
(3, 'Jan Smiths', 3, 1, 1, '2025-07-15 04:43:19', NULL),
(4, 'Local Kandidato', 4, 1, 1, '2025-07-15 04:43:39', NULL),
(5, 'Mucho Choco', 5, 1, 1, '2025-07-15 04:43:50', NULL),
(6, 'Sandwich Cookie', 6, 1, 1, '2025-07-15 04:43:59', NULL),
(7, 'Nationwide Peace', 7, 1, 1, '2025-07-15 04:44:20', NULL),
(8, 'Joselito Mario', 1, 2, 1, '2025-07-15 04:44:35', NULL),
(9, 'Maria Cruz Santos', 2, 2, 1, '2025-07-15 04:44:50', 'cand_68766627518508.39826392.jpg'),
(11, 'Bello Pineda', 3, 2, 1, '2025-07-15 04:45:09', NULL),
(12, 'Christian Mucho', 4, 2, 1, '2025-07-15 04:45:33', NULL),
(13, 'Nicho San Juan', 5, 2, 1, '2025-07-15 04:45:57', NULL),
(14, 'Richard Converge', 6, 2, 1, '2025-07-15 04:46:26', NULL),
(15, 'Michael De Los Reyes', 7, 2, 1, '2025-07-15 04:46:42', NULL),
(17, 'Hwang In-ho', 1, 3, 1, '2025-07-15 04:47:16', NULL),
(18, 'Seong Gi-Hun', 2, 3, 1, '2025-07-15 04:47:25', 'cand_687663b06e1d66.49014018.jpg'),
(19, 'Kim Jun-hee', 3, 3, 1, '2025-07-15 04:48:49', NULL),
(20, 'Lee Myung-gi', 4, 3, 1, '2025-07-15 04:49:13', NULL),
(21, 'Cho Hyun-ju', 5, 3, 1, '2025-07-15 04:49:37', NULL),
(22, 'Choi Woo-seok', 6, 3, 1, '2025-07-15 04:50:03', NULL),
(23, 'Hwang Jun-ho', 7, 3, 1, '2025-07-15 04:50:26', NULL),
(25, 'Nasan Ang Sabaw', 1, 4, 1, '2025-07-15 12:40:34', 'cand_68766edc5946b3.62151643.png'),
(26, 'FEU', 1, 5, 1, '2025-07-15 15:38:25', 'cand_687675f1ed2f34.14463433.png'),
(27, 'FEU TECH', 2, 5, 1, '2025-07-15 15:57:20', 'default_candidate_image.jpg'),
(28, 'Jose Ferrer', 6, 5, 1, '2025-07-15 16:03:05', 'default_candidate_image.jpg'),
(29, 'Mariano Teeves', 7, 5, 1, '2025-07-15 16:03:43', 'default_candidate_image.jpg'),
(30, 'Grand Theft Auto 6', 1, 8, 1, '2025-07-15 16:06:42', 'default_candidate_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `election_tbl`
--

CREATE TABLE `election_tbl` (
  `election_id` int(11) NOT NULL,
  `election_name` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `election_tbl`
--

INSERT INTO `election_tbl` (`election_id`, `election_name`, `start_date`, `end_date`) VALUES
(1, '2025 Mavericks Student Government Election', '2025-07-14', '2025-07-20'),
(2, '2024 Peterson Student Council Election', '2024-07-04', '2025-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `partylist_tbl`
--

CREATE TABLE `partylist_tbl` (
  `partylist_id` int(11) NOT NULL,
  `partylist_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partylist_tbl`
--

INSERT INTO `partylist_tbl` (`partylist_id`, `partylist_name`, `created_at`, `deleted_at`) VALUES
(1, 'Seven Eleven', '2025-07-15 04:40:40', NULL),
(2, 'Anak-Pawis', '2025-07-15 04:40:50', NULL),
(3, 'Squid Game', '2025-07-15 04:41:03', NULL),
(4, 'Panlarong Pusit', '2025-07-15 04:41:11', NULL),
(5, 'TMRWFTW', '2025-07-15 04:41:40', NULL),
(6, 'Ako Pinoy', '2025-07-15 04:41:50', NULL),
(7, 'Kagubatan', '2025-07-15 14:22:34', '2025-07-15 22:22:41'),
(8, 'GeForce RTX 5070 Ti', '2025-07-15 16:06:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `position_tbl`
--

CREATE TABLE `position_tbl` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position_tbl`
--

INSERT INTO `position_tbl` (`position_id`, `position_name`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'Secretary'),
(4, 'Treasurer'),
(5, 'Auditor'),
(6, 'Public Information Officer'),
(7, 'Peace Officer');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`log_id`, `admin_id`, `action`, `created_at`) VALUES
(1, 1, 'Admin logged out', '2025-07-14 16:37:07'),
(2, 1, 'Added a New Candidate: ', '2025-07-14 16:38:40'),
(3, 1, 'Added a New Candidate: Choco Mucho', '2025-07-14 16:38:53'),
(4, 1, 'Added a New Candidate: ', '2025-07-14 16:39:06'),
(5, 1, 'Added a New Candidate: CookieSandwich', '2025-07-14 16:40:28'),
(6, 1, 'Admin logged out', '2025-07-14 16:44:09'),
(7, 1, 'Logged In', '2025-07-14 16:44:13'),
(8, 1, 'Admin logged out', '2025-07-14 17:25:53'),
(9, 1, 'Logged In', '2025-07-14 23:14:34'),
(10, 1, 'Logged In', '2025-07-14 23:53:27'),
(11, 1, 'Admin logged out', '2025-07-14 23:56:37'),
(12, 1, 'Logged In', '2025-07-14 23:56:42'),
(13, 1, 'Logged In', '2025-07-14 23:57:20'),
(14, 1, 'Logged In', '2025-07-15 00:03:47'),
(15, 1, 'Logged In', '2025-07-15 00:03:52'),
(16, 1, 'Logged In', '2025-07-15 00:04:39'),
(17, 1, 'Admin logged out', '2025-07-15 01:41:27'),
(18, 1, 'Logged In', '2025-07-15 01:42:30'),
(19, 1, 'Deleted Candidate: CookieSandwich', '2025-07-15 02:46:29'),
(20, 1, 'Updated Candidate: Choco Mucho 1', '2025-07-15 02:46:43'),
(21, 1, 'Added a New Candidate: Sino To', '2025-07-15 02:58:07'),
(22, 1, 'Added a New Candidate: Sino To', '2025-07-15 02:59:15'),
(23, 1, 'Deleted Candidate: Sino To', '2025-07-15 03:10:41'),
(24, 1, 'Deleted Candidate: Sino To', '2025-07-15 03:26:06'),
(25, 1, 'Logged In', '2025-07-15 04:35:38'),
(26, 1, 'Admin logged out', '2025-07-15 04:35:58'),
(27, 1, 'Logged In', '2025-07-15 04:40:07'),
(28, 1, 'Added a New Partylist: Seven Eleven', '2025-07-15 04:40:40'),
(29, 1, 'Added a New Partylist: Anak-Pawis', '2025-07-15 04:40:50'),
(30, 1, 'Added a New Partylist: Squid Game', '2025-07-15 04:41:03'),
(31, 1, 'Added a New Partylist: Panlarong Pusit', '2025-07-15 04:41:11'),
(32, 1, 'Added a New Partylist: TMRWFTW', '2025-07-15 04:41:40'),
(33, 1, 'Added a New Partylist: Ako Pinoy', '2025-07-15 04:41:50'),
(34, 1, 'Added a New Candidate: Allas De Alas', '2025-07-15 04:42:17'),
(35, 1, 'Added a New Candidate: Juan Dela Cruz', '2025-07-15 04:43:05'),
(36, 1, 'Added a New Candidate: Jan Smiths', '2025-07-15 04:43:19'),
(37, 1, 'Added a New Candidate: Local Kandidato', '2025-07-15 04:43:39'),
(38, 1, 'Added a New Candidate: Mucho Choco', '2025-07-15 04:43:50'),
(39, 1, 'Added a New Candidate: Sandwich Cookie', '2025-07-15 04:43:59'),
(40, 1, 'Added a New Candidate: Nationwide Peace', '2025-07-15 04:44:20'),
(41, 1, 'Added a New Candidate: Joselito Mario', '2025-07-15 04:44:35'),
(42, 1, 'Added a New Candidate: Maria Cruz Santos', '2025-07-15 04:44:50'),
(43, 1, 'Added a New Candidate: Bello Pineda', '2025-07-15 04:44:59'),
(44, 1, 'Deleted Candidate: Bello Pineda', '2025-07-15 04:45:03'),
(45, 1, 'Added a New Candidate: Bello Pineda', '2025-07-15 04:45:09'),
(46, 1, 'Added a New Candidate: Christian Mucho', '2025-07-15 04:45:33'),
(47, 1, 'Added a New Candidate: Nicho San Juan', '2025-07-15 04:45:57'),
(48, 1, 'Added a New Candidate: Richard Converge', '2025-07-15 04:46:26'),
(49, 1, 'Added a New Candidate: Michael De Los Reyes', '2025-07-15 04:46:42'),
(50, 1, 'Added a New Candidate: Seong Gi-Hun', '2025-07-15 04:47:01'),
(51, 1, 'Deleted Candidate: Seong Gi-Hun', '2025-07-15 04:47:09'),
(52, 1, 'Added a New Candidate: Hwang In-ho', '2025-07-15 04:47:16'),
(53, 1, 'Added a New Candidate: Seong Gi-Hun', '2025-07-15 04:47:25'),
(54, 1, 'Added a New Candidate: Kim Jun-hee', '2025-07-15 04:48:49'),
(55, 1, 'Added a New Candidate: Lee Myung-gi', '2025-07-15 04:49:13'),
(56, 1, 'Added a New Candidate: Cho Hyun-ju', '2025-07-15 04:49:37'),
(57, 1, 'Added a New Candidate: Choi Woo-seok', '2025-07-15 04:50:03'),
(58, 1, 'Added a New Candidate: Hwang Jun-ho', '2025-07-15 04:50:26'),
(59, 1, 'Admin logged out', '2025-07-15 04:52:28'),
(60, 1, 'Logged In', '2025-07-15 05:00:08'),
(61, 1, 'Added a New Candidate: Peterson Nicholas', '2025-07-15 10:23:45'),
(62, 1, 'Deleted Candidate: Peterson Nicholas', '2025-07-15 10:23:52'),
(63, 1, 'Admin logged in', '2025-07-15 12:24:54'),
(64, 1, 'Added a New Candidate: Nasan Ang Sabaw', '2025-07-15 12:40:34'),
(65, 1, 'Admin logged in', '2025-07-15 14:12:13'),
(66, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 14:16:02'),
(67, 1, 'Updated Candidate: Seong Gi-Hun', '2025-07-15 14:20:32'),
(68, 1, 'Added a New Partylist: Kagubatan', '2025-07-15 14:22:34'),
(69, 1, 'Deleted Partylist: Kagubatan', '2025-07-15 14:22:41'),
(70, 1, 'Updated Candidate: Maria Cruz Santos', '2025-07-15 14:31:03'),
(71, 1, 'Admin logged out', '2025-07-15 14:33:58'),
(72, 1, 'Admin logged in', '2025-07-15 14:34:05'),
(73, 1, 'Updated Candidate: Player 456', '2025-07-15 14:34:30'),
(74, 1, 'Updated Candidate: Seong Gi-Hun', '2025-07-15 14:34:56'),
(75, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:00:07'),
(76, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:00:22'),
(77, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:00:29'),
(78, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:00:35'),
(79, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:02:42'),
(80, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:02:53'),
(81, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:06:14'),
(82, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:06:30'),
(83, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:07:18'),
(84, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:08:05'),
(85, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:08:12'),
(86, 1, 'Updated Candidate: ', '2025-07-15 15:30:35'),
(87, 1, 'Updated Candidate: ', '2025-07-15 15:30:40'),
(88, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:30:47'),
(89, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:31:32'),
(90, 1, 'Updated Candidate: Nasan Ang Sabaw', '2025-07-15 15:34:16'),
(91, 1, 'Added a New Candidate: FEU', '2025-07-15 15:38:25'),
(92, 1, 'Added a New Candidate: FEU TECH', '2025-07-15 15:57:20'),
(93, 1, 'Updated Candidate: Joselito Mariones', '2025-07-15 16:02:37'),
(94, 1, 'Updated Candidate: Joselito Mario', '2025-07-15 16:02:50'),
(95, 1, 'Added a New Candidate: Jose Ferrer', '2025-07-15 16:03:05'),
(96, 1, 'Added a New Candidate: Mariano Teeves', '2025-07-15 16:03:43'),
(97, 1, 'Added a New Partylist: GeForce RTX 5070 Ti', '2025-07-15 16:06:16'),
(98, 1, 'Added a New Candidate: Grand Theft Auto 6', '2025-07-15 16:06:42'),
(99, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:07:01'),
(100, 1, 'Updated Candidate: Allas De Alas', '2025-07-15 16:07:55'),
(101, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:08:18'),
(102, 1, 'Updated Candidate: Allas De Alas', '2025-07-15 16:08:32'),
(103, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:26:30'),
(104, 1, 'Updated Candidate: Allas De Alas', '2025-07-15 16:26:53'),
(105, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:27:19'),
(106, 1, 'Updated Candidate: Allas De Alas', '2025-07-15 16:29:00'),
(107, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

CREATE TABLE `user_tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_done` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_initial` varchar(10) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year_level` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `student_id`, `first_name`, `middle_initial`, `last_name`, `suffix`, `section`, `course`, `year_level`, `password`, `role`, `created_at`) VALUES
(1, 'admin001', NULL, 'Petercen', 'R.', 'Giron', NULL, NULL, NULL, NULL, '$2y$10$aY1.YWVGAqBiHb/IpO752.dYCmtvy9F9zuVnZX3McP/Qz7XJnb2tG', 'admin', '2025-07-14 04:50:59'),
(5, NULL, '202512345', 'Student 1', 'A', 'Government', '', 'AA01', 'BSIT', '1', '$2y$10$qzzLsimRnVYwxruPHjMriuP9AUGE8d0MCguRt/UK7s6xIv5oCTk.K', 'student', '2025-07-15 04:36:54'),
(6, NULL, '202500910', 'Student 2', 'B', 'Government', '', 'AB01', 'BSCS', '1', '$2y$10$93Vd1G/G8jYYi4lQm9scw.clLz8XFZZ5UhK5ZGtOUho0ih/jNoZZy', 'student', '2025-07-15 04:37:18'),
(7, NULL, '202599810', 'Student 1', 'B', 'Government', 'Jr.', 'AA02', 'BSIT', '1', '$2y$10$acDvrNra7lJ.WUznW8HTSee6Rb3hbfjj0gGj4UYXBSGVbTJC0DJYa', 'student', '2025-07-15 04:37:41'),
(8, NULL, '202557192', 'Student 3', 'C', 'Government', 'Jr.', 'CD21', 'BSIT', '3', '$2y$10$VXZ0yVnMojQzC4hivQcR.Oww9Pwy0B0dUymuFcI2u3OZq1paZEJke', 'student', '2025-07-15 04:38:43'),
(9, NULL, '202567710', 'Retep', 'R', 'Nap', 'Sr.', 'XC41', 'BSBA', '4', '$2y$10$gHCz8.E7wLbWGWhlzUQ3SO9ck0.QyKhQy8459Cnu38HnNo9iGHtxO', 'student', '2025-07-15 04:39:26'),
(10, NULL, '202571921', 'Student 5', 'D', 'Government', '', 'TX77', 'BSIT', '2', '$2y$10$iUMgXOrRd5rojbZDTKZT.uzI.Ac7D.bfbPBjzWOkOyuqC5mCYcM8.', 'student', '2025-07-15 04:55:53'),
(11, NULL, '202500456', 'Gi-hun', 'F', 'Fan', '', 'MM02', 'BSMA', '3', '$2y$10$iolHqK7hngbqPepzzpckmumO1JeUYMA/NR/KiU2aG70HEzEI2E98G', 'student', '2025-07-15 04:57:06'),
(12, NULL, '202512912', 'Allan', 'B', 'Reyes', '', 'TN211', 'BSCS', '2', '$2y$10$B14B0Bp/pcH4Yoj2LqvAdOwUF5IcXs1rCviH0hIOawcvWVg6yr1Xu', 'student', '2025-07-15 04:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `vote_tbl`
--

CREATE TABLE `vote_tbl` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `vote_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `position_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_tbl`
--

INSERT INTO `vote_tbl` (`vote_id`, `user_id`, `candidate_id`, `vote_date`, `position_id`, `created_at`) VALUES
(1, 5, 17, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(2, 5, 18, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(3, 5, 19, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(4, 5, 20, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(5, 5, 21, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(6, 5, 22, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(7, 5, 15, '2025-07-15 04:53:22', NULL, '2025-07-15 04:53:22'),
(8, 6, 17, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(9, 6, 18, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(10, 6, 11, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(11, 6, 4, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(12, 6, 5, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(13, 6, 6, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(14, 6, 7, '2025-07-15 04:53:50', NULL, '2025-07-15 04:53:50'),
(15, 7, 1, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(16, 7, 2, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(17, 7, 3, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(18, 7, 4, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(19, 7, 5, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(20, 7, 6, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(21, 7, 7, '2025-07-15 04:54:16', NULL, '2025-07-15 04:54:16'),
(22, 8, 8, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(23, 8, 9, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(24, 8, 11, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(25, 8, 12, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(26, 8, 13, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(27, 8, 14, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(28, 8, 15, '2025-07-15 04:54:31', NULL, '2025-07-15 04:54:31'),
(29, 9, 8, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(30, 9, 18, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(31, 9, 19, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(32, 9, 4, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(33, 9, 21, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(34, 9, 22, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(35, 9, 7, '2025-07-15 04:55:19', NULL, '2025-07-15 04:55:19'),
(36, 10, 1, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(37, 10, 18, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(38, 10, 3, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(39, 10, 4, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(40, 10, 5, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(41, 10, 6, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(42, 10, 7, '2025-07-15 04:56:20', NULL, '2025-07-15 04:56:20'),
(43, 11, 8, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(44, 11, 18, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(45, 11, 11, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(46, 11, 4, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(47, 11, 13, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(48, 11, 6, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(49, 11, 15, '2025-07-15 04:57:23', NULL, '2025-07-15 04:57:23'),
(50, 12, 17, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(51, 12, 18, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(52, 12, 3, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(53, 12, 12, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(54, 12, 5, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(55, 12, 22, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43'),
(56, 12, 15, '2025-07-15 04:59:43', NULL, '2025-07-15 04:59:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_notifs`
--
ALTER TABLE `candidate_notifs`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `candidate_tbl`
--
ALTER TABLE `candidate_tbl`
  ADD PRIMARY KEY (`candidate_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `partylist_id` (`partylist_id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `election_tbl`
--
ALTER TABLE `election_tbl`
  ADD PRIMARY KEY (`election_id`);

--
-- Indexes for table `partylist_tbl`
--
ALTER TABLE `partylist_tbl`
  ADD PRIMARY KEY (`partylist_id`);

--
-- Indexes for table `position_tbl`
--
ALTER TABLE `position_tbl`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vote_tbl`
--
ALTER TABLE `vote_tbl`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`position_id`),
  ADD KEY `fk_vote_candidate` (`candidate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate_notifs`
--
ALTER TABLE `candidate_notifs`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `candidate_tbl`
--
ALTER TABLE `candidate_tbl`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `election_tbl`
--
ALTER TABLE `election_tbl`
  MODIFY `election_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partylist_tbl`
--
ALTER TABLE `partylist_tbl`
  MODIFY `partylist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `position_tbl`
--
ALTER TABLE `position_tbl`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vote_tbl`
--
ALTER TABLE `vote_tbl`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_tbl`
--
ALTER TABLE `candidate_tbl`
  ADD CONSTRAINT `candidate_tbl_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position_tbl` (`position_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidate_tbl_ibfk_2` FOREIGN KEY (`partylist_id`) REFERENCES `partylist_tbl` (`partylist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidate_tbl_ibfk_3` FOREIGN KEY (`election_id`) REFERENCES `election_tbl` (`election_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD CONSTRAINT `user_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);

--
-- Constraints for table `vote_tbl`
--
ALTER TABLE `vote_tbl`
  ADD CONSTRAINT `fk_vote_candidate` FOREIGN KEY (`candidate_id`) REFERENCES `candidate_tbl` (`candidate_id`),
  ADD CONSTRAINT `fk_vote_user` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`),
  ADD CONSTRAINT `vote_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_tbl_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidate_tbl` (`candidate_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
