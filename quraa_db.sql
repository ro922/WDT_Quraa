-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 03:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quraa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `khatmat`
--

CREATE TABLE `khatmat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('current','public') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `surah_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khatmat`
--

INSERT INTO `khatmat` (`id`, `user_id`, `name`, `status`, `start_date`, `end_date`, `surah_id`) VALUES
(1, 2, 'تيست', 'current', '2025-05-13', '2025-05-21', 16),
(2, 10, 'تيست2', 'current', '2025-05-14', '2025-05-30', 12),
(3, 2, 'تيست3', 'current', '2025-05-05', '2025-05-22', 3),
(4, 12, 'الكهف', 'current', '2025-05-06', '2025-05-15', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'yomna', 'yomnadahab990@gmail.com', '$2y$10$1mPW3RUXjvUQ7au9quL.0.EU96RzsyOpab40FjriPhXhQFm7ruEYi', '2025-05-02 09:30:51'),
(2, 'omar', 'omardahab930@gmail.com', '$2y$10$zSl7kyBMuj7qAXe8457bBusbGwApffC5qOZZTrdPhOu7c4FcFynFi', '2025-05-02 09:36:25'),
(3, 'مريم', 'mmmm@gmail.com', '$2y$10$ZUZ187c7O5TfAISQjf0xhu06T5.SE2FW2MfZ.GIJ7ZgnyxTzhMzhy', '2025-05-02 11:24:33'),
(4, 'reem', 'nnn@gmail.com', '$2y$10$0hz9G3kMnSuSQQ7L0QRbUOq9NXF/AFpFbqAFksw7inuSj42PDgcIy', '2025-05-02 14:00:51'),
(5, 'yomna', 'nnnnnnn@gmail.com', '$2y$10$0JZNGLPJS2u8zD56JB8HPeMAJQeOQPrlI6Cj3GArpw367gXDk/KPq', '2025-05-02 14:23:46'),
(6, 'منى', 'mmnoah@gmail.com', '$2y$10$HFb00GfIgNadR0p1a/a66Of0E5N6QnaZVgpdCiRAB6cBAq4hILb5C', '2025-05-02 16:52:16'),
(7, 'yomna', 'uofty@gmao.vom', '$2y$10$ytQ3RcgtRiOsXb1N.zxcI.cxanMx.clWa9Qz1ddj5AdyGrFaLK3r2', '2025-05-03 05:26:18'),
(8, 'menna', 'mnmnmnm@hh.com', '$2y$10$/FFqY.HVAPYDd3027Snhrukl1OilLk6AbfYeM7jasBhoI2Bn5.C.q', '2025-05-03 05:42:47'),
(9, 'لولى', 'llllllll@eeee.com', '$2y$10$4PK4JBlpabhoeNtW2jsKAe9gVDP8STXzmTj.9oOgaxdzvg72V6rNW', '2025-05-03 11:02:10'),
(10, 'مريم', 'ppppp@ppppp.com', '$2y$10$7cQtv.qAaJ9f0s1Uwk1yyOVJrH1WpOZQBPhqPQdr54ll6H7EIdnQS', '2025-05-03 11:27:10'),
(11, 'مريم', 'yyyyyy@rrrrr.com', '$2y$10$ldrRGqfeqxAFIHId1BGqfOCCfajRl7/KyXDXhPuA1Oih7XNKsvxYC', '2025-05-04 00:22:20'),
(12, 'منه', 'uuuuu@eeeeee.nnom', '$2y$10$fooQtxdF1.H.RVabhhvtPuLmCHcwzlaZgu35cdB6Xg7MTfxCX3Bp.', '2025-05-04 00:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `progress` int(11) DEFAULT 0,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`id`, `user_id`, `activity_type`, `progress`, `last_updated`) VALUES
(1, 4, 'daily_prayers', 3, '2025-05-02 14:22:31'),
(2, 1, 'daily_prayers', 9, '2025-05-02 14:24:08'),
(3, 2, 'daily_prayers', 6, '2025-05-02 17:24:50'),
(4, 8, 'daily_prayers', 0, '2025-05-03 05:54:12'),
(5, 2, 'daily_prayers', 0, '2025-05-03 11:31:26'),
(6, 12, 'daily_prayers', 6, '2025-05-04 00:35:43'),
(7, 2, 'daily_prayers', 0, '2025-05-04 00:37:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `khatmat`
--
ALTER TABLE `khatmat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khatmat`
--
ALTER TABLE `khatmat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `khatmat`
--
ALTER TABLE `khatmat`
  ADD CONSTRAINT `khatmat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
