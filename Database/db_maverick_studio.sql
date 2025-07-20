-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 11:30 AM
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
(15, 'candidate_update', 'Updated candidate: Allas De Alasa', 0, '2025-07-15 16:29:14'),
(16, 'candidate_update', 'Updated candidate: Player 456', 0, '2025-07-15 16:39:08'),
(17, 'candidate_add', 'Added candidate: Player 001', 0, '2025-07-15 16:39:51'),
(18, 'candidate_update', 'Updated candidate: Song Gi-Hon', 0, '2025-07-16 04:39:51'),
(19, 'candidate_update', 'Updated candidate: Song Gi-Hon', 0, '2025-07-16 04:42:34'),
(20, 'candidate_add', 'Added candidate: Test', 0, '2025-07-17 08:50:42'),
(21, 'candidate_delete', 'Deleted candidate: Grand Theft Auto 6', 0, '2025-07-17 09:07:27'),
(22, 'candidate_delete', 'Deleted candidate: Player 001', 0, '2025-07-17 09:07:31'),
(23, 'candidate_add', 'Added candidate: Allas De Alasaaa', 0, '2025-07-17 09:21:30'),
(24, 'candidate_delete', 'Deleted candidate: FEU', 0, '2025-07-17 09:38:15'),
(25, 'candidate_delete', 'Deleted candidate: FEU TECH', 0, '2025-07-17 09:38:19'),
(26, 'candidate_delete', 'Deleted candidate: Test', 0, '2025-07-17 09:38:24'),
(27, 'candidate_delete', 'Deleted candidate: Mariano Teeves', 0, '2025-07-17 09:38:28'),
(28, 'candidate_delete', 'Deleted candidate: Jose Ferrer', 0, '2025-07-17 09:38:32'),
(29, 'candidate_update', 'Updated candidate: Allas De Alas', 0, '2025-07-19 02:58:37');

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
(1, 'Jose Lopez', 1, 1, 3, '2025-07-19 09:48:01', NULL),
(2, 'Andres Navarro', 2, 1, 3, '2025-07-19 09:48:01', NULL),
(3, 'Elena Navarro', 3, 1, 3, '2025-07-19 09:48:01', NULL),
(4, 'Elena Ramos', 4, 1, 3, '2025-07-19 09:48:01', NULL),
(5, 'Maria Morales', 5, 1, 3, '2025-07-19 09:48:01', NULL),
(6, 'Pedro Alvarez', 6, 1, 3, '2025-07-19 09:48:01', NULL),
(7, 'Juan Bautista', 7, 1, 3, '2025-07-19 09:48:01', NULL),
(8, 'Ramon Navarro', 1, 2, 3, '2025-07-19 09:48:01', NULL),
(9, 'Andres Bautista', 2, 2, 3, '2025-07-19 09:48:01', NULL),
(10, 'Fernando Torres', 3, 2, 3, '2025-07-19 09:48:01', NULL),
(11, 'Miguel Lopez', 4, 2, 3, '2025-07-19 09:48:01', NULL),
(12, 'Carmen Garcia', 5, 2, 3, '2025-07-19 09:48:01', NULL),
(13, 'Maria Alvarez', 6, 2, 3, '2025-07-19 09:48:01', NULL),
(14, 'Carlos Santos', 7, 2, 3, '2025-07-19 09:48:01', NULL),
(15, 'Rosa Rivera', 1, 3, 3, '2025-07-19 09:48:01', NULL),
(16, 'Teresa Domingo', 2, 3, 3, '2025-07-19 09:48:01', NULL),
(17, 'Isabel Castillo', 3, 3, 3, '2025-07-19 09:48:01', NULL),
(18, 'Ana Delos Reyes', 4, 3, 3, '2025-07-19 09:48:01', NULL),
(19, 'Luisa Navarro', 5, 3, 3, '2025-07-19 09:48:01', NULL),
(20, 'Miguel Ramos', 6, 3, 3, '2025-07-19 09:48:01', NULL),
(21, 'Pedro Santos', 7, 3, 3, '2025-07-19 09:48:01', NULL),
(22, 'Ana Garcia', 1, 4, 3, '2025-07-19 09:48:01', NULL),
(23, 'Rosa Alvarez', 2, 4, 3, '2025-07-19 09:48:01', NULL),
(24, 'Andres Mendoza', 3, 4, 3, '2025-07-19 09:48:01', NULL),
(25, 'Carlos Castillo', 4, 4, 3, '2025-07-19 09:48:01', NULL),
(26, 'Carmen Morales', 5, 4, 3, '2025-07-19 09:48:01', NULL),
(27, 'Ramon Reyes', 6, 4, 3, '2025-07-19 09:48:01', NULL),
(28, 'Juan Rivera', 7, 4, 3, '2025-07-19 09:48:01', NULL),
(29, 'Elena Torres', 1, 5, 3, '2025-07-19 09:48:01', NULL),
(30, 'Isabel Mendoza', 2, 5, 3, '2025-07-19 09:48:01', NULL),
(31, 'Fernando Domingo', 3, 5, 3, '2025-07-19 09:48:01', NULL),
(32, 'Jose Navarro', 4, 5, 3, '2025-07-19 09:48:01', NULL),
(33, 'Maria Lopez', 5, 5, 3, '2025-07-19 09:48:01', NULL),
(34, 'Pedro Cruz', 6, 5, 3, '2025-07-19 09:48:01', NULL),
(35, 'Teresa Reyes', 7, 5, 3, '2025-07-19 09:48:01', NULL),
(36, 'Carlos Delos Reyes', 1, 6, 3, '2025-07-19 09:48:01', NULL),
(37, 'Luisa Ramos', 2, 6, 3, '2025-07-19 09:48:01', NULL),
(38, 'Ramon Morales', 3, 6, 3, '2025-07-19 09:48:01', NULL),
(39, 'Andres Lopez', 4, 6, 3, '2025-07-19 09:48:01', NULL),
(40, 'Carmen Torres', 5, 6, 3, '2025-07-19 09:48:01', NULL),
(41, 'Fernando Alvarez', 6, 6, 3, '2025-07-19 09:48:01', NULL),
(42, 'Miguel Rivera', 7, 6, 3, '2025-07-19 09:48:01', NULL);

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
(1, '2025 Mavericks Student Government Election', '2025-07-14', '2025-07-15'),
(2, '2024 Peterson Student Council Election', '2024-03-03', '2024-03-06'),
(3, 'Leadership of Tomorrow: Election of the Tamaraws 2025', '2025-07-18', '2025-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `partylist_tbl`
--

CREATE TABLE `partylist_tbl` (
  `partylist_id` int(11) NOT NULL,
  `partylist_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partylist_tbl`
--

INSERT INTO `partylist_tbl` (`partylist_id`, `partylist_name`, `created_at`, `deleted_at`) VALUES
(1, 'Partido ng Pagbabago', '2025-07-19 09:47:37', NULL),
(2, 'Tinig ng Kabataan', '2025-07-19 09:47:37', NULL),
(3, 'Kilusang Kabataan', '2025-07-19 09:47:37', NULL),
(4, 'Alyansa ng Mag-aaral', '2025-07-19 09:47:37', NULL),
(5, 'Bukluran ng Pag-asa', '2025-07-19 09:47:37', NULL),
(6, 'Nagkakaisang Boses', '2025-07-19 09:47:37', NULL),
(9, 'ABC 1', '2025-07-19 10:01:23', '2025-07-19 10:01:28'),
(10, 'Kalupaan', '2025-07-19 10:02:18', '2025-07-19 10:02:26');

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
(6, 'P.I.O'),
(7, 'P.O');

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
(107, 1, 'Updated Candidate: Allas De Alasa', '2025-07-15 16:29:14'),
(108, 1, 'Admin logged out', '2025-07-15 16:37:53'),
(109, 1, 'Admin logged in', '2025-07-15 16:38:04'),
(110, 1, 'Updated Candidate: Player 456', '2025-07-15 16:39:08'),
(111, 1, 'Added a New Candidate: Player 001', '2025-07-15 16:39:51'),
(112, 1, 'Admin logged out', '2025-07-15 16:40:34'),
(113, 1, 'Admin logged in', '2025-07-15 16:41:44'),
(114, 1, 'Added a New Position: President', '2025-07-15 16:41:53'),
(115, 1, 'Admin logged out', '2025-07-15 16:43:32'),
(116, 1, 'Admin logged in', '2025-07-16 03:24:50'),
(117, 1, 'Updated Candidate: Song Gi-Hon', '2025-07-16 04:39:51'),
(118, 1, 'Updated Candidate: Song Gi-Hon', '2025-07-16 04:42:34'),
(119, 1, 'Admin logged in', '2025-07-17 08:18:33'),
(120, 1, 'Admin logged out', '2025-07-17 08:22:09'),
(121, 1, 'Admin logged in', '2025-07-17 08:22:50'),
(122, 1, 'Added a New Position: president', '2025-07-17 08:23:27'),
(123, 1, 'Added a New Position: President', '2025-07-17 08:23:35'),
(124, 1, 'Admin logged out', '2025-07-17 08:28:11'),
(125, 1, 'Admin logged in', '2025-07-17 08:38:48'),
(126, 1, 'Deleted Partylist: GeForce RTX 5070 Ti', '2025-07-17 08:43:53'),
(127, 1, 'Admin logged out', '2025-07-17 08:44:54'),
(128, 1, 'Admin logged in', '2025-07-17 08:44:59'),
(129, 1, 'Added a New Candidate: Test', '2025-07-17 08:50:42'),
(130, 1, 'Deleted Candidate: Grand Theft Auto 6', '2025-07-17 09:07:27'),
(131, 1, 'Deleted Candidate: Player 001', '2025-07-17 09:07:31'),
(132, 1, 'Deleted Partylist: TMRWFTW', '2025-07-17 09:08:08'),
(133, 1, 'Added a New Partylist: ABC 2', '2025-07-17 09:21:02'),
(134, 1, 'Added a New Candidate: Allas De Alasaaa', '2025-07-17 09:21:30'),
(135, 1, 'Deleted Partylist: ABC 2', '2025-07-17 09:21:47'),
(136, 1, 'Deleted Candidate: FEU', '2025-07-17 09:38:15'),
(137, 1, 'Deleted Candidate: FEU TECH', '2025-07-17 09:38:19'),
(138, 1, 'Deleted Candidate: Test', '2025-07-17 09:38:24'),
(139, 1, 'Deleted Candidate: Mariano Teeves', '2025-07-17 09:38:28'),
(140, 1, 'Deleted Candidate: Jose Ferrer', '2025-07-17 09:38:32'),
(141, 1, 'Added a New Position: Vice President', '2025-07-17 09:41:24'),
(142, 1, 'Deleted Position ID: 11', '2025-07-17 09:41:26'),
(143, 1, 'Admin logged out', '2025-07-17 09:48:42'),
(144, 1, 'Admin logged in', '2025-07-17 10:01:40'),
(145, 1, 'Admin logged out', '2025-07-17 15:28:02'),
(146, 1, 'Admin logged in!', '2025-07-18 16:13:21'),
(147, 1, 'Admin logged out', '2025-07-18 16:21:10'),
(148, 1, 'Admin logged in!', '2025-07-18 16:26:01'),
(149, 1, 'Admin logged out', '2025-07-18 16:26:28'),
(150, 1, 'Admin logged in!', '2025-07-18 16:57:29'),
(151, 1, 'Added a New Position: preisndet', '2025-07-18 16:58:14'),
(152, 1, 'Deleted Position ID: 12', '2025-07-18 16:58:16'),
(153, 1, 'Added a New Partylist: seveneleven', '2025-07-18 17:00:17'),
(154, 1, 'Deleted Partylist: seveneleven', '2025-07-18 17:00:19'),
(155, 1, 'Admin logged in!', '2025-07-19 00:12:57'),
(156, 1, 'Admin logged out', '2025-07-19 00:13:10'),
(157, 1, 'Admin logged in!', '2025-07-19 02:49:25'),
(158, 1, 'Admin logged out', '2025-07-19 02:51:30'),
(159, 1, 'Admin logged in', '2025-07-19 02:58:28'),
(160, 1, 'Updated Candidate: Allas De Alas', '2025-07-19 02:58:37'),
(161, 1, 'Admin logged out', '2025-07-19 02:58:45'),
(162, 1, 'Admin logged in', '2025-07-19 03:48:56'),
(163, 1, 'Admin logged in', '2025-07-19 04:34:05'),
(164, 1, 'Admin logged in', '2025-07-19 04:49:59'),
(165, 1, 'Admin logged out', '2025-07-19 05:09:27'),
(166, 1, 'Admin logged in', '2025-07-19 05:17:23'),
(167, 1, 'Admin logged out', '2025-07-19 05:17:43'),
(168, 1, 'Admin logged in', '2025-07-19 05:19:36'),
(169, 1, 'Admin logged out', '2025-07-19 05:19:47'),
(170, 1, 'Admin logged in', '2025-07-19 05:27:45'),
(171, 1, 'Admin logged out', '2025-07-19 05:27:57'),
(172, 1, 'Admin logged in', '2025-07-19 08:07:36'),
(173, 1, 'Admin logged out', '2025-07-19 08:09:43'),
(174, 1, 'Admin logged in', '2025-07-19 08:09:48'),
(175, 1, 'Admin logged out', '2025-07-19 08:10:39'),
(176, 1, 'Admin logged in', '2025-07-19 08:10:42'),
(177, 1, 'Admin logged out', '2025-07-19 08:11:00'),
(178, 1, 'Admin logged in', '2025-07-19 08:11:04'),
(179, 1, 'Admin logged out', '2025-07-19 08:13:41'),
(180, 1, 'Admin logged in', '2025-07-19 08:15:09'),
(181, 1, 'Admin logged out', '2025-07-19 09:12:15'),
(182, 1, 'Admin logged in', '2025-07-19 09:31:50'),
(183, 1, 'Admin logged in', '2025-07-19 09:32:01'),
(184, 1, 'Added a New Partylist: Partido Liberal', '2025-07-19 09:58:19'),
(185, 1, 'Deleted Partylist: Partido Liberal', '2025-07-19 09:58:24'),
(186, 1, 'Added a New Partylist: Kalupaan', '2025-07-19 10:00:17'),
(187, 1, 'Deleted Partylist: Kalupaan', '2025-07-19 10:00:24'),
(188, 1, 'Added a New Partylist: ABC 1', '2025-07-19 10:01:23'),
(189, 1, 'Deleted Partylist: ABC 1', '2025-07-19 10:01:28'),
(190, 1, 'Added a New Partylist: Kalupaan', '2025-07-19 10:02:18'),
(191, 1, 'Deleted Partylist: Kalupaan', '2025-07-19 10:02:26'),
(192, 1, 'Admin logged out', '2025-07-19 10:38:20'),
(193, 1, 'Admin logged in', '2025-07-19 10:39:32'),
(194, 1, 'Admin logged out', '2025-07-19 10:39:57'),
(195, 1, 'Admin logged in', '2025-07-19 10:51:50'),
(196, 1, 'Admin logged out', '2025-07-19 11:06:00'),
(197, 1, 'Admin logged in', '2025-07-19 11:08:16'),
(198, 1, 'Admin logged out', '2025-07-19 11:27:06'),
(199, 1, 'Admin logged in', '2025-07-19 11:28:41'),
(200, 1, 'Admin logged out', '2025-07-19 11:38:19'),
(201, 1, 'Admin logged in', '2025-07-19 11:38:27'),
(202, 1, 'Admin logged out', '2025-07-19 12:03:23'),
(203, 1, 'Admin logged in', '2025-07-19 12:08:13'),
(204, 1, 'Admin logged out', '2025-07-19 12:20:02'),
(205, 1, 'Admin logged in', '2025-07-19 12:42:56'),
(206, 1, 'Admin logged out', '2025-07-19 12:49:05'),
(207, 1, 'Admin logged in', '2025-07-19 12:49:19'),
(208, 1, 'Admin logged in', '2025-07-19 16:52:04'),
(209, 1, 'Admin logged in', '2025-07-19 17:07:28');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `partylist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `student_id`, `first_name`, `middle_initial`, `last_name`, `suffix`, `section`, `course`, `year_level`, `password`, `role`, `created_at`, `partylist_id`) VALUES
(1, 'admin001', NULL, 'Petercen Nikolai', 'R.', 'Giron', NULL, NULL, NULL, NULL, '$2y$10$N.TwcFDZj.K5EQg0MUDO1OqtNYUiIxOh62.3N5L6CEXC/eoKb29ce', 'admin', '2025-07-14 04:50:59', NULL),
(2, NULL, '202500000', 'Luis', 'M', 'Santos', NULL, 'AB01', 'BSCS', '1st Year', '$2y$10$5PagXWuQWBMGortzUI2viOuBtdT.Al2OXx50Tndu4nmXBmN720kgW', 'student', '2025-07-15 09:24:38', NULL),
(3, NULL, '202500001', 'Marian', 'A', 'Reyes', NULL, 'CD99', 'BSIT', '3rd Year', '$2y$10$EkJOPxr3HD6oM5yqoa9LaenN5IvmyGuxRk0uLxC2N032ILYzG1cCy', 'student', '2025-07-15 09:41:35', NULL),
(4, NULL, '202500002', 'Carlos', 'D', 'Cruz', NULL, 'EF48', 'BSMA', '3rd Year', '$2y$10$ub4rKtge1TgsLa1kCM.rF.iq.HjUV29Yh8xuT0IDVNWErDXlUBbDO', 'student', '2025-07-19 10:14:35', NULL),
(5, NULL, '202500003', 'Elena', 'R', 'Lopez', NULL, 'TE20', 'BSCT', '4th Year', '$2y$10$UevBljhHU6o4FgCWoIx6HuHNGTZX.FmjGT2b3Y.T6foRRnnIHK.rS', 'student', '2025-07-19 10:14:35', NULL),
(6, NULL, '202500004', 'Pedro', 'J', 'Torres', NULL, 'PN23', 'BSMM', '1st Year', '$2y$10$S6CIGjk9VnTrcEbZ0vltYei93RyW4cqkhlSM51kSKMFXc6/6YSlW6', 'student', '2025-07-19 10:14:35', NULL),
(7, NULL, '202500005', 'Teresa', 'V', 'Rivera', NULL, 'XX60', 'BSFTE', '1st Year', '$2y$10$iiq1ZetEau32iaAwtnbGEuczWOdwpMR1Ea.CgIMbPnX7TH4431sYK', 'student', '2025-07-19 10:14:35', NULL),
(8, NULL, '202500006', 'Miguel', 'H', 'Garcia', NULL, 'AB02', 'BSCEM', '2nd Year', '$2y$10$J8Db96WXNJNAfVWPy4mB3e4fIkBS3PUTDSeOGvLMgIvI3jYem3GSq', 'student', '2025-07-19 10:14:35', NULL),
(9, NULL, '202500007', 'Jose', 'L', 'Mendoza', NULL, 'CD98', 'BSCE', '3rd Year', '$2y$10$.HnanMggvW2gVBBjdGMbFOlj2ARZalHDlDiEIiWP8a9yEj7/THPN.', 'student', '2025-07-19 10:14:35', NULL),
(10, NULL, '202500008', 'Ana', 'S', 'Navarro', NULL, 'EF47', 'BSCpE', '4th Year', '$2y$10$3oiXKaPDZaUF0YmwEQPqeudCmO8x7soEkLbjVPCSr1lUIOvRMoh9O', 'student', '2025-07-19 10:14:35', NULL),
(11, NULL, '202500009', 'Isabel', 'B', 'Domingo', NULL, 'XX61', 'BSEE', '1st Year', '$2y$10$mr8KW.jZTgOsVPBa4dF41OO5NuNE7bdUGyUDr7w3GO8dnIOzS5Ho.', 'student', '2025-07-19 10:14:35', NULL),
(12, NULL, '202500010', 'Ramon', 'K', 'Morales', NULL, 'PN24', 'BSECE', '4th Year', '$2y$10$vRzOOwZYh/6NUdMQbB.5fe2o8H00iPNGIPNF80jx97vKehsVxJLw.', 'student', '2025-07-19 10:14:35', NULL),
(13, NULL, '202500011', 'Luisa', '', 'Alvarez', NULL, 'TE21', 'BSME', '1st Year', '$2y$10$WJ6N3DjgOmiAigHNmOVj1OBejdtlciTXWJe963y7CTjxTk4.kGGtu', 'student', '2025-07-19 10:14:35', NULL),
(14, NULL, '202500012', 'Andres', 'T', 'Castillo', NULL, 'XX62', 'BSIT', '2nd Year', '$2y$10$qGNZUx8y/gULC5g6PUGxQuSruPm4J1C/NIIj6K0yZUgdF6RV4YTXC', 'student', '2025-07-19 10:14:35', NULL),
(15, NULL, '202500013', 'Carmen', 'C', 'Domingo', NULL, 'AB01', 'BSFTE', '3rd Year', '$2y$10$tftWPxR3a2.1bOVtrC/VjOTTazImn4g7K8u22xEnh0Y82dvY1a2ve', 'student', '2025-07-19 10:14:35', NULL),
(16, NULL, '202500014', 'Fernando', 'O', 'Ramos', NULL, 'CD99', 'BSCS', '4th Year', '$2y$10$m00PtmFgCV5ukk3Dn2HxuOebUN109cUXhUx2mkqy9TsqOOwWW0MIW', 'student', '2025-07-19 10:14:35', NULL),
(17, NULL, '202500015', 'Maria', 'G', 'Reyes', NULL, 'EF48', 'BSCT', '1st Year', '$2y$10$JvC0elctDfigfh5y3/ehCuMNrdrfPDi1Vdt2wIZl9euCjTwaf.7oO', 'student', '2025-07-19 10:14:35', NULL),
(18, NULL, '202500016', 'Juan', 'E', 'Garcia', NULL, 'PN23', 'BSCE', '1st Year', '$2y$10$JmYV1tV3RZKWc9.NaGORlOsQwLpX9yzZbYPlAql2Ar6xTdaMPKIna', 'student', '2025-07-19 10:14:35', NULL),
(19, NULL, '202500017', 'Josefina', 'Y', 'Delos Reyes', NULL, 'XX61', 'BSMM', '1st Year', '$2y$10$5OIKLzwWX66kDLa3jp.in.Mgyb15Jl81U1KqkSvW023F7DGIDsot6', 'student', '2025-07-19 10:14:35', NULL),
(20, NULL, '202500018', 'Rosa', 'F', 'Cruz', NULL, 'EF47', 'BSMA', '3rd Year', '$2y$10$u/rnSzYXG08p2w2fuvB1IuPIKrItevTrI6aqfZ36A09cQOCE2l0fq', 'student', '2025-07-19 10:14:35', NULL),
(21, NULL, '202500019', 'Carlos', 'I', 'Santos', NULL, 'TE21', 'BSME', '3rd Year', '$2y$10$bfe4OnXYtnYP8en5uxDai.VBeCRCR6TqXDH3y3aAykS9tTwYrwAZa', 'student', '2025-07-19 10:14:35', NULL),
(22, NULL, '202500020', 'Miguel', 'P', 'Dela Fuente', NULL, 'CD98', 'BSCpE', '1st Year', '$2y$10$8pYSs3H3xCuBZM3cEWfwXeZ3UcDp39Xh4VqWXKu47znBsvIxFXiJy', 'student', '2025-07-19 10:14:35', NULL),
(23, NULL, '202500021', 'Luisa', 'W', 'Bautista', NULL, 'XX60', 'BSMA', '4th Year', '$2y$10$hnnDQ5ybtWNgDItRGokoz.t.aKOpna7LT8.xbpsWKM7uufn7XaJsW', 'student', '2025-07-19 10:14:35', NULL),
(24, NULL, '202500022', 'Final', 'T', 'Test', 'Sr.', 'TX21', 'BSIT', '1st Year', '$2y$10$NHEqFPyWG1GdDsYoK9R.Bu5.CaKeauoeDtl2ZpksYsqVIt3TQaERK', 'student', '2025-07-19 11:07:08', NULL),
(25, NULL, '202500023', 'Student 1', 'R', 'Government', 'Jr.', 'AB01', 'BSIT', '3rd Year', '$2y$10$9LCukFPaHgorPA1erPJhve11gyz2Wk3n2fae5Vbi62wBHafXi1pBK', 'student', '2025-07-19 11:27:23', NULL),
(26, NULL, '202500024', 'Student 3', 'B', 'Government', 'Jr.', 'TS01', 'BSBA', '2nd Year', '$2y$10$EmzVLhhOTCeF.bXCzyXg2uqL6SSseWmyyuJRH4vXT0QiLH19./pGS', 'student', '2025-07-19 11:28:10', NULL),
(27, NULL, '202500025', 'Student 32', 'R', 'Dev', 'Jr.', 'CD21', 'BSCS', '2nd Year', '$2y$10$vxuZsefAuhHyCVcoPKzR5.UkfflSTf5TSzrVN1k8QyHb5sVSu3lAO', 'student', '2025-07-19 17:04:58', NULL);

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
(1, 2, 3, '2025-07-15 00:14:23', 1, '2025-07-19 10:29:06'),
(2, 2, 8, '2025-07-15 00:14:23', 2, '2025-07-19 10:29:06'),
(3, 2, 14, '2025-07-15 00:14:23', 3, '2025-07-19 10:29:06'),
(4, 2, 22, '2025-07-15 00:14:23', 4, '2025-07-19 10:29:06'),
(5, 2, 27, '2025-07-15 00:14:23', 5, '2025-07-19 10:29:06'),
(6, 2, 34, '2025-07-15 00:14:23', 6, '2025-07-19 10:29:06'),
(7, 2, 40, '2025-07-15 00:14:23', 7, '2025-07-19 10:29:06'),
(8, 3, 1, '2025-07-15 01:30:15', 1, '2025-07-19 10:29:06'),
(9, 3, 7, '2025-07-15 01:30:15', 2, '2025-07-19 10:29:06'),
(10, 3, 12, '2025-07-15 01:30:15', 3, '2025-07-19 10:29:06'),
(11, 3, 21, '2025-07-15 01:30:15', 4, '2025-07-19 10:29:06'),
(12, 3, 26, '2025-07-15 01:30:15', 5, '2025-07-19 10:29:06'),
(13, 3, 33, '2025-07-15 01:30:15', 6, '2025-07-19 10:29:06'),
(14, 3, 38, '2025-07-15 01:30:15', 7, '2025-07-19 10:29:06'),
(15, 4, 4, '2025-07-15 03:04:52', 1, '2025-07-19 10:29:06'),
(16, 4, 10, '2025-07-15 03:04:52', 2, '2025-07-19 10:29:06'),
(17, 4, 13, '2025-07-15 03:04:52', 3, '2025-07-19 10:29:06'),
(18, 4, 23, '2025-07-15 03:04:52', 4, '2025-07-19 10:29:06'),
(19, 4, 28, '2025-07-15 03:04:52', 5, '2025-07-19 10:29:06'),
(20, 4, 35, '2025-07-15 03:04:52', 6, '2025-07-19 10:29:06'),
(21, 4, 41, '2025-07-15 03:04:52', 7, '2025-07-19 10:29:06'),
(22, 5, 2, '2025-07-15 06:18:06', 1, '2025-07-19 10:29:06'),
(23, 5, 9, '2025-07-15 06:18:06', 2, '2025-07-19 10:29:06'),
(24, 5, 15, '2025-07-15 06:18:06', 3, '2025-07-19 10:29:06'),
(25, 5, 20, '2025-07-15 06:18:06', 4, '2025-07-19 10:29:06'),
(26, 5, 29, '2025-07-15 06:18:06', 5, '2025-07-19 10:29:06'),
(27, 5, 31, '2025-07-15 06:18:06', 6, '2025-07-19 10:29:06'),
(28, 5, 37, '2025-07-15 06:18:06', 7, '2025-07-19 10:29:06'),
(29, 6, 5, '2025-07-15 08:57:42', 1, '2025-07-19 10:29:06'),
(30, 6, 6, '2025-07-15 08:57:42', 2, '2025-07-19 10:29:06'),
(31, 6, 11, '2025-07-15 08:57:42', 3, '2025-07-19 10:29:06'),
(32, 6, 24, '2025-07-15 08:57:42', 4, '2025-07-19 10:29:06'),
(33, 6, 25, '2025-07-15 08:57:42', 5, '2025-07-19 10:29:06'),
(34, 6, 30, '2025-07-15 08:57:42', 6, '2025-07-19 10:29:06'),
(35, 6, 39, '2025-07-15 08:57:42', 7, '2025-07-19 10:29:06'),
(36, 7, 2, '2025-07-16 00:23:11', 1, '2025-07-19 10:29:41'),
(37, 7, 7, '2025-07-16 00:23:11', 2, '2025-07-19 10:29:41'),
(38, 7, 13, '2025-07-16 00:23:11', 3, '2025-07-19 10:29:41'),
(39, 7, 23, '2025-07-16 00:23:11', 4, '2025-07-19 10:29:41'),
(40, 7, 26, '2025-07-16 00:23:11', 5, '2025-07-19 10:29:41'),
(41, 7, 34, '2025-07-16 00:23:11', 6, '2025-07-19 10:29:41'),
(42, 7, 40, '2025-07-16 00:23:11', 7, '2025-07-19 10:29:41'),
(43, 8, 1, '2025-07-16 02:07:42', 1, '2025-07-19 10:29:41'),
(44, 8, 10, '2025-07-16 02:07:42', 2, '2025-07-19 10:29:41'),
(45, 8, 14, '2025-07-16 02:07:42', 3, '2025-07-19 10:29:41'),
(46, 8, 22, '2025-07-16 02:07:42', 4, '2025-07-19 10:29:41'),
(47, 8, 29, '2025-07-16 02:07:42', 5, '2025-07-19 10:29:41'),
(48, 8, 36, '2025-07-16 02:07:42', 6, '2025-07-19 10:29:41'),
(49, 8, 38, '2025-07-16 02:07:42', 7, '2025-07-19 10:29:41'),
(50, 9, 4, '2025-07-16 05:38:10', 1, '2025-07-19 10:29:42'),
(51, 9, 9, '2025-07-16 05:38:10', 2, '2025-07-19 10:29:42'),
(52, 9, 12, '2025-07-16 05:38:10', 3, '2025-07-19 10:29:42'),
(53, 9, 24, '2025-07-16 05:38:10', 4, '2025-07-19 10:29:42'),
(54, 9, 25, '2025-07-16 05:38:10', 5, '2025-07-19 10:29:42'),
(55, 9, 33, '2025-07-16 05:38:10', 6, '2025-07-19 10:29:42'),
(56, 9, 41, '2025-07-16 05:38:10', 7, '2025-07-19 10:29:42'),
(57, 10, 5, '2025-07-16 08:50:33', 1, '2025-07-19 10:29:42'),
(58, 10, 6, '2025-07-16 08:50:33', 2, '2025-07-19 10:29:42'),
(59, 10, 11, '2025-07-16 08:50:33', 3, '2025-07-19 10:29:42'),
(60, 10, 20, '2025-07-16 08:50:33', 4, '2025-07-19 10:29:42'),
(61, 10, 27, '2025-07-16 08:50:33', 5, '2025-07-19 10:29:42'),
(62, 10, 32, '2025-07-16 08:50:33', 6, '2025-07-19 10:29:42'),
(63, 10, 39, '2025-07-16 08:50:33', 7, '2025-07-19 10:29:42'),
(64, 11, 1, '2025-07-17 00:12:22', 1, '2025-07-19 10:30:07'),
(65, 11, 8, '2025-07-17 00:12:22', 2, '2025-07-19 10:30:07'),
(66, 11, 14, '2025-07-17 00:12:22', 3, '2025-07-19 10:30:07'),
(67, 11, 21, '2025-07-17 00:12:22', 4, '2025-07-19 10:30:07'),
(68, 11, 25, '2025-07-17 00:12:22', 5, '2025-07-19 10:30:07'),
(69, 11, 31, '2025-07-17 00:12:22', 6, '2025-07-19 10:30:07'),
(70, 11, 37, '2025-07-17 00:12:22', 7, '2025-07-19 10:30:07'),
(71, 12, 3, '2025-07-17 02:33:15', 1, '2025-07-19 10:30:07'),
(72, 12, 9, '2025-07-17 02:33:15', 2, '2025-07-19 10:30:07'),
(73, 12, 13, '2025-07-17 02:33:15', 3, '2025-07-19 10:30:07'),
(74, 12, 22, '2025-07-17 02:33:15', 4, '2025-07-19 10:30:07'),
(75, 12, 28, '2025-07-17 02:33:15', 5, '2025-07-19 10:30:07'),
(76, 12, 33, '2025-07-17 02:33:15', 6, '2025-07-19 10:30:07'),
(77, 12, 40, '2025-07-17 02:33:15', 7, '2025-07-19 10:30:07'),
(78, 13, 6, '2025-07-17 05:10:44', 1, '2025-07-19 10:30:07'),
(79, 13, 7, '2025-07-17 05:10:44', 2, '2025-07-19 10:30:07'),
(80, 13, 12, '2025-07-17 05:10:44', 3, '2025-07-19 10:30:07'),
(81, 13, 24, '2025-07-17 05:10:44', 4, '2025-07-19 10:30:07'),
(82, 13, 27, '2025-07-17 05:10:44', 5, '2025-07-19 10:30:07'),
(83, 13, 34, '2025-07-17 05:10:44', 6, '2025-07-19 10:30:07'),
(84, 13, 42, '2025-07-17 05:10:44', 7, '2025-07-19 10:30:07'),
(85, 14, 2, '2025-07-17 08:57:09', 1, '2025-07-19 10:30:07'),
(86, 14, 10, '2025-07-17 08:57:09', 2, '2025-07-19 10:30:07'),
(87, 14, 11, '2025-07-17 08:57:09', 3, '2025-07-19 10:30:07'),
(88, 14, 23, '2025-07-17 08:57:09', 4, '2025-07-19 10:30:07'),
(89, 14, 26, '2025-07-17 08:57:09', 5, '2025-07-19 10:30:07'),
(90, 14, 36, '2025-07-17 08:57:09', 6, '2025-07-19 10:30:07'),
(91, 14, 39, '2025-07-17 08:57:09', 7, '2025-07-19 10:30:07'),
(92, 15, 5, '2025-07-18 00:28:16', 1, '2025-07-19 10:30:35'),
(93, 15, 9, '2025-07-18 00:28:16', 2, '2025-07-19 10:30:35'),
(94, 15, 14, '2025-07-18 00:28:16', 3, '2025-07-19 10:30:35'),
(95, 15, 20, '2025-07-18 00:28:16', 4, '2025-07-19 10:30:35'),
(96, 15, 26, '2025-07-18 00:28:16', 5, '2025-07-19 10:30:35'),
(97, 15, 34, '2025-07-18 00:28:16', 6, '2025-07-19 10:30:35'),
(98, 15, 39, '2025-07-18 00:28:16', 7, '2025-07-19 10:30:35'),
(99, 16, 4, '2025-07-18 02:01:47', 1, '2025-07-19 10:30:35'),
(100, 16, 8, '2025-07-18 02:01:47', 2, '2025-07-19 10:30:35'),
(101, 16, 13, '2025-07-18 02:01:47', 3, '2025-07-19 10:30:35'),
(102, 16, 24, '2025-07-18 02:01:47', 4, '2025-07-19 10:30:35'),
(103, 16, 29, '2025-07-18 02:01:47', 5, '2025-07-19 10:30:35'),
(104, 16, 33, '2025-07-18 02:01:47', 6, '2025-07-19 10:30:35'),
(105, 16, 37, '2025-07-18 02:01:47', 7, '2025-07-19 10:30:35'),
(106, 17, 3, '2025-07-18 05:22:33', 1, '2025-07-19 10:30:35'),
(107, 17, 7, '2025-07-18 05:22:33', 2, '2025-07-19 10:30:35'),
(108, 17, 15, '2025-07-18 05:22:33', 3, '2025-07-19 10:30:35'),
(109, 17, 21, '2025-07-18 05:22:33', 4, '2025-07-19 10:30:35'),
(110, 17, 27, '2025-07-18 05:22:33', 5, '2025-07-19 10:30:35'),
(111, 17, 31, '2025-07-18 05:22:33', 6, '2025-07-19 10:30:35'),
(112, 17, 42, '2025-07-18 05:22:33', 7, '2025-07-19 10:30:35'),
(113, 18, 6, '2025-07-18 08:49:05', 1, '2025-07-19 10:30:35'),
(114, 18, 10, '2025-07-18 08:49:05', 2, '2025-07-19 10:30:35'),
(115, 18, 12, '2025-07-18 08:49:05', 3, '2025-07-19 10:30:35'),
(116, 18, 22, '2025-07-18 08:49:05', 4, '2025-07-19 10:30:35'),
(117, 18, 25, '2025-07-18 08:49:05', 5, '2025-07-19 10:30:35'),
(118, 18, 36, '2025-07-18 08:49:05', 6, '2025-07-19 10:30:35'),
(119, 18, 38, '2025-07-18 08:49:05', 7, '2025-07-19 10:30:35'),
(120, 19, 1, '2025-07-19 00:11:24', 1, '2025-07-19 10:31:03'),
(121, 19, 11, '2025-07-19 00:11:24', 2, '2025-07-19 10:31:03'),
(122, 19, 14, '2025-07-19 00:11:24', 3, '2025-07-19 10:31:03'),
(123, 19, 24, '2025-07-19 00:11:24', 4, '2025-07-19 10:31:03'),
(124, 19, 29, '2025-07-19 00:11:24', 5, '2025-07-19 10:31:03'),
(125, 19, 34, '2025-07-19 00:11:24', 6, '2025-07-19 10:31:03'),
(126, 19, 40, '2025-07-19 00:11:24', 7, '2025-07-19 10:31:03'),
(127, 20, 2, '2025-07-19 02:15:42', 1, '2025-07-19 10:31:03'),
(128, 20, 6, '2025-07-19 02:15:42', 2, '2025-07-19 10:31:03'),
(129, 20, 13, '2025-07-19 02:15:42', 3, '2025-07-19 10:31:03'),
(130, 20, 23, '2025-07-19 02:15:42', 4, '2025-07-19 10:31:03'),
(131, 20, 27, '2025-07-19 02:15:42', 5, '2025-07-19 10:31:03'),
(132, 20, 32, '2025-07-19 02:15:42', 6, '2025-07-19 10:31:03'),
(133, 20, 39, '2025-07-19 02:15:42', 7, '2025-07-19 10:31:03'),
(134, 21, 3, '2025-07-19 05:03:10', 1, '2025-07-19 10:31:03'),
(135, 21, 9, '2025-07-19 05:03:10', 2, '2025-07-19 10:31:03'),
(136, 21, 16, '2025-07-19 05:03:10', 3, '2025-07-19 10:31:03'),
(137, 21, 20, '2025-07-19 05:03:10', 4, '2025-07-19 10:31:03'),
(138, 21, 30, '2025-07-19 05:03:10', 5, '2025-07-19 10:31:03'),
(139, 21, 36, '2025-07-19 05:03:10', 6, '2025-07-19 10:31:03'),
(140, 21, 41, '2025-07-19 05:03:10', 7, '2025-07-19 10:31:03'),
(141, 22, 4, '2025-07-19 07:42:55', 1, '2025-07-19 10:31:03'),
(142, 22, 7, '2025-07-19 07:42:55', 2, '2025-07-19 10:31:03'),
(143, 22, 12, '2025-07-19 07:42:55', 3, '2025-07-19 10:31:03'),
(144, 22, 21, '2025-07-19 07:42:55', 4, '2025-07-19 10:31:03'),
(145, 22, 28, '2025-07-19 07:42:55', 5, '2025-07-19 10:31:03'),
(146, 22, 35, '2025-07-19 07:42:55', 6, '2025-07-19 10:31:03'),
(147, 22, 42, '2025-07-19 07:42:55', 7, '2025-07-19 10:31:03'),
(148, 23, 6, '2025-07-19 09:59:01', 1, '2025-07-19 10:31:03'),
(149, 23, 8, '2025-07-19 09:59:01', 2, '2025-07-19 10:31:03'),
(150, 23, 17, '2025-07-19 09:59:01', 3, '2025-07-19 10:31:03'),
(151, 23, 26, '2025-07-19 09:59:01', 4, '2025-07-19 10:31:03'),
(152, 23, 31, '2025-07-19 09:59:01', 5, '2025-07-19 10:31:03'),
(153, 23, 33, '2025-07-19 09:59:01', 6, '2025-07-19 10:31:03'),
(154, 23, 38, '2025-07-19 09:59:01', 7, '2025-07-19 10:31:03'),
(155, 24, 8, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(156, 24, 2, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(157, 24, 10, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(158, 24, 11, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(159, 24, 5, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(160, 24, 27, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(161, 24, 28, '2025-07-19 11:07:37', NULL, '2025-07-19 11:07:37'),
(162, 25, 8, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(163, 25, 16, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(164, 25, 17, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(165, 25, 18, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(166, 25, 19, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(167, 25, 20, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(168, 25, 21, '2025-07-19 11:27:51', NULL, '2025-07-19 11:27:51'),
(169, 26, 8, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(170, 26, 16, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(171, 26, 17, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(172, 26, 18, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(173, 26, 19, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(174, 26, 20, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(175, 26, 21, '2025-07-19 11:28:31', NULL, '2025-07-19 11:28:31'),
(176, 27, 8, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(177, 27, 9, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(178, 27, 38, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(179, 27, 32, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(180, 27, 40, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(181, 27, 13, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55'),
(182, 27, 14, '2025-07-19 17:05:55', NULL, '2025-07-19 17:05:55');

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
  ADD KEY `election_id` (`election_id`),
  ADD KEY `fk_partylist` (`partylist_id`);

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
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `candidate_tbl`
--
ALTER TABLE `candidate_tbl`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `election_tbl`
--
ALTER TABLE `election_tbl`
  MODIFY `election_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partylist_tbl`
--
ALTER TABLE `partylist_tbl`
  MODIFY `partylist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `position_tbl`
--
ALTER TABLE `position_tbl`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vote_tbl`
--
ALTER TABLE `vote_tbl`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_tbl`
--
ALTER TABLE `candidate_tbl`
  ADD CONSTRAINT `candidate_tbl_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position_tbl` (`position_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidate_tbl_ibfk_2` FOREIGN KEY (`partylist_id`) REFERENCES `partylist_tbl` (`partylist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidate_tbl_ibfk_3` FOREIGN KEY (`election_id`) REFERENCES `election_tbl` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_partylist` FOREIGN KEY (`partylist_id`) REFERENCES `partylist_tbl` (`partylist_id`) ON DELETE CASCADE;

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
