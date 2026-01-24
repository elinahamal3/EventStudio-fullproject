-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2026 at 05:15 AM
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
-- Database: `event_studio`
--

-- --------------------------------------------------------
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `package` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `image_name`, `uploaded_at`) VALUES
(1, '696debeb2d145.jpg', '2026-01-19 08:31:39'),
(2, '696decd559b9b.jpg', '2026-01-19 08:35:33'),
(3, '696decf183b57.jpg', '2026-01-19 08:36:01'),
(4, '696ded039e5c8.jpg', '2026-01-19 08:36:19'),
(5, '696ded137ade7.jpg', '2026-01-19 08:36:35'),
(6, '696ded285af83.jpg', '2026-01-19 08:36:56'),
(7, '696ded367fdb3.jpg', '2026-01-19 08:37:10'),
(9, '696ded5790087.jpg', '2026-01-19 08:37:43'),
(13, '696deda2b2e00.jpg', '2026-01-19 08:38:58'),
(14, '696dedb913830.jpg', '2026-01-19 08:39:21'),
(15, '696dedcddc0a3.jpg', '2026-01-19 08:39:41'),
(17, '696dee2900371.jpg', '2026-01-19 08:41:13'),
(18, '696dee3a5dd05.jpg', '2026-01-19 08:41:30'),
(19, '696dee5035e78.jpg', '2026-01-19 08:41:52'),
(20, '696dee64d75de.jpg', '2026-01-19 08:42:12'),
(22, '696dee9801724.jpg', '2026-01-19 08:43:04'),
(23, '696deead1f84b.jpg', '2026-01-19 08:43:25'),
(24, '696deebc815b1.jpg', '2026-01-19 08:43:40'),
(25, '696deecb3aded.jpg', '2026-01-19 08:43:55'),
(26, '696deedc8b64b.jpg', '2026-01-19 08:44:12'),
(27, '696deeeb9c52d.jpg', '2026-01-19 08:44:27'),
(28, '696deefed0cd2.jpg', '2026-01-19 08:44:46'),
(29, '696df05d0079d.jpg', '2026-01-19 08:50:37'),
(30, '696df1574eec7.jpg', '2026-01-19 08:54:47'),
(32, '6971dd834e279.jpg', '2026-01-22 08:19:15'),
(33, '6971dd94142b4.jpg', '2026-01-22 08:19:32'),
(34, '6971dda13cbe8.jpg', '2026-01-22 08:19:45'),
(35, '6971ddb9e4ef2.jpg', '2026-01-22 08:20:09'),
(36, '6971de54f24bb.jpg', '2026-01-22 08:22:44'),
(37, '6971ded8b7d95.jpg', '2026-01-22 08:24:56'),
(38, '6971df94f3288.jpg', '2026-01-22 08:28:05');

-- --------------------------------------------------------
-- Table structure for table `our_work`
--

CREATE TABLE `our_work` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` varchar(100) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_work`
--

INSERT INTO `our_work` (`id`, `image`, `label`, `uploaded_at`) VALUES
(7, '6971daa694721.jpg', 'concert', '2026-01-22 08:07:02'),
(8, '6971dac0bc84f.jpg', 'annaprashan', '2026-01-22 08:07:28'),
(9, '6971dad977ae6.jpg', 'firework', '2026-01-22 08:07:53'),
(10, '6971daee5e2c8.jpg', 'weddingcard', '2026-01-22 08:08:14'),
(11, '6971db11ac091.jpg', 'welcomeboard', '2026-01-22 08:08:49'),
(12, '6971db2530694.jpg', 'homedecor', '2026-01-22 08:09:09'),
(13, '6971db389099f.jpg', 'bouquet', '2026-01-22 08:09:28'),
(14, '6971db5746330.jpg', 'proposaldecor', '2026-01-22 08:09:59'),
(15, '6971db6b03a05.jpg', 'aniversary', '2026-01-22 08:10:19'),
(16, '6971db84e5b8c.jpg', 'varmala', '2026-01-22 08:10:44'),
(18, '6971dbadd45a7.jpg', 'outsidedecor', '2026-01-22 08:11:25'),
(19, '6971dbc0f32be.jpg', 'dinningarea', '2026-01-22 08:11:45'),
(20, '6971dbe7728b5.jpg', 'corporateevent', '2026-01-22 08:12:23'),
(21, '6971dc0662a3f.jpg', 'mandap', '2026-01-22 08:12:54'),
(22, '6971dc20159e5.jpg', 'cake', '2026-01-22 08:13:20'),
(23, '6971dc391125e.jpg', 'car', '2026-01-22 08:13:45'),
(24, '6971dc40b9a67.jpg', 'bridetobe', '2026-01-22 08:13:52'),
(25, '6971dc582d200.jpg', 'birthday', '2026-01-22 08:14:16'),
(26, '6971dc6c5d393.jpg', 'mehendi', '2026-01-22 08:14:36'),
(31, '6971f0bb795aa.jpg', 'baby shower', '2026-01-22 09:41:15'),
(32, '6971f0cd3aa4d.jpg', 'haldi', '2026-01-22 09:41:33'),
(33, '6971f0fc0492b.jpg', 'stage decor', '2026-01-22 09:42:20'),
(35, '6971f1356c8c2.jpg', 'photo booth', '2026-01-22 09:43:17'),
(37, '6971f17adabed.jpg', 'entrance gate', '2026-01-22 09:44:26');

-- --------------------------------------------------------
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `features` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `features`, `created_at`) VALUES
(8, 'basic package', '$4000', '4 hrs coverage\r\nBasic decoration\r\nProfessional photography\r\nEdited digital images\r\nLight snacks & drinks', '2026-01-18 11:42:03'),
(9, 'Standard Package', '$6000', '6 hrs coverage\r\nStandard decoration\r\nPhotography + short video\r\nEdited digital images\r\nComplimentary event consultation\r\nBuffet service(standard menu)', '2026-01-18 11:42:39'),
(10, 'premium package', '$8000', '8 hrs coverage\r\nRoyal theme decoration with lighting setup\r\nPhotography & Full HD video\r\nCustom luxury 8×8 album\r\nEdited digital images\r\nFree drone shot (if outdoor)\r\nBuffet service (premium menu)', '2026-01-18 11:43:15'),
(11, 'deluxe package', '$10000', '10 hrs coverage\r\nLuxury decoration with flowers, stage & lighting\r\nPhotography & cinematic video shoot\r\nCanvas print\r\nCustom 8×8 album\r\nHighlight film for social media\r\n2 parent albums\r\nVIP team service\r\nFull-course buffet (custom menu)', '2026-01-18 11:43:45');

-- --------------------------------------------------------
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon_class`, `created_at`) VALUES
(1, 'Wedding Planning', 'Complete wedding planning services from venue selection to day-of\r\n              coordination. We handle every detail to make your special day\r\n              perfect.', 'fas fa-ring', '2026-01-18 10:09:54'),
(2, 'Corporate Events', 'Professional corporate event management including conferences,\r\n              seminars, product launches, and team building activities.', 'fas fa-briefcase', '2026-01-18 10:11:24'),
(3, 'Private Parties', 'Birthday parties, anniversaries, and private celebrations planned\r\n              to perfection with attention to every personal detail.', 'fas fa-birthday-cake', '2026-01-18 10:12:12'),
(4, 'Entertainment Events', 'Concerts, festivals, and entertainment events with full production\r\n              management and technical coordination.', 'fas fa-music', '2026-01-18 10:13:31'),
(5, 'Catering Services', 'Premium catering solutions with diverse menu options, dietary\r\n              accommodations, and professional service staff.', 'fas fa-utensils', '2026-01-18 10:14:22'),
(7, 'Event Photography', 'Professional photography and videography services to capture all\r\n              the precious moments of your special event.', 'fas fa-camera', '2026-01-18 10:17:02');

-- --------------------------------------------------------
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_work`
--
ALTER TABLE `our_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `our_work`
--
ALTER TABLE `our_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
