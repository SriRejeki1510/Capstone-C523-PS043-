-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2023 at 05:28 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelasmm3_capstonemm3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `role`) VALUES
(16, 'pep', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(17, 'admin', 'admin4@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `oauth_uid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('member') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_uid`, `first_name`, `last_name`, `email`, `password`, `profile_pic`, `gender`, `local`, `role`) VALUES
(13, '', 'muhammad', 'paldi', 'user@gmail.com', '', '', NULL, NULL, 'member'),
(60, '105411667164973114635', 'aji', 'kurniawan', 'ajikurniawan190403@gmail.com', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocJMYBMtn3RdL6XGadeQtGgvVm0wqIOZHyt4Y4RhLcJ9=s96-c', '', '', 'member'),
(61, '108861778457832925534', 'Rifan', 'Fakhri', 'rifanfakhri23@gmail.com', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocIU-hE1j6FinoGRvmgJQSbWSLd8KFv0iRKOYwqzPUd9=s96-c', '', '', 'member'),
(62, '110224219189484802516', 'Sri Rejeki', 'S120XB465', 's120xb465@dicoding.org', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocIYw1d0qarF4abExDNFGEbxtPKztv05v9-tLtJAC_ak=s96-c', '', '', 'member'),
(63, '109502507600114763450', 'Muhammad Fauzan', 'Naufaldy', 'm.fauzan.faldy17@gmail.com', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocLk15TlgDrVX9wikOxx_fB0ywy6kTb458CP8o0wUiVo=s96-c', '', '', 'member'),
(64, '112179212463498573252', 'absen 14', '', 'yayayyyy1526@gmail.com', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocLqhKlOAsmyd89WL0EWf5WyvZI5IUGvGCedK2ym8_gTnQ=s96-c', '', '', 'member'),
(65, '118021171462176489204', 'ʜɑɴɴɴ', '', 'fm011404@gmail.com', 'A{x4Ne[^0t@x', 'https://lh3.googleusercontent.com/a/ACg8ocJ45xbZ2Z621vSRsdRO3T_vksE_xIj1s9bqwBi2FzBR240=s96-c', '', '', 'member'),
(66, '101263060456711129494', 'RIFAN', 'NURFAKHRI', '21102117@ittelkom-pwt.ac.id', '', 'https://lh3.googleusercontent.com/a/ACg8ocLy9EPQacDxbAq56ydEkjjRaowCEQ4SGRyexjtINGQ=s96-c', '', '', 'member'),
(67, '109242938600261289578', 'Rifan', 'Nurfakhri', 'fakhririfan86@gmail.com', '', 'https://lh3.googleusercontent.com/a/ACg8ocJzAsLg7M0ZD6OpWinS5NBNU2ML787tfmbsCj1gFyXvPQ=s96-c', '', '', 'member'),
(68, '108075168411882874336', 'Puput', 'Rahmawati', 'putrahmawatiii@gmail.com', '', 'https://lh3.googleusercontent.com/a/ACg8ocKRWOhZaamtExROA18M4Sy6cFyD085ggttTKwa0htlu=s96-c', '', '', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `activity_duration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `input_date` datetime NOT NULL,
  `is_lack_of_sleep` tinyint(1) NOT NULL,
  `day_of_week` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recommendation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `first_name`, `activity_duration`, `input_date`, `is_lack_of_sleep`, `day_of_week`, `recommendation`) VALUES
(142, 'RIFAN', '8', '2023-12-18 20:33:44', 0, 'Senin', 'Cukup istirahat.'),
(143, 'aji', '8', '2023-12-18 21:05:50', 0, 'Senin', 'Cukup istirahat.'),
(144, '', '10', '2023-12-18 21:59:19', 0, 'Senin', 'Anda butuh istirahat.'),
(145, 'Rifan', '8', '2023-12-18 21:59:48', 0, 'Senin', 'Cukup istirahat.'),
(146, 'Muhammad Fauzan', '6', '2023-12-19 08:21:48', 0, 'Selasa', 'Cukup istirahat.'),
(147, 'absen 14', '12', '2023-12-19 08:25:44', 0, 'Selasa', 'Anda butuh istirahat.'),
(148, 'ʜɑɴɴɴ', '10', '2023-12-19 08:35:10', 0, 'Selasa', 'Anda butuh istirahat.'),
(149, 'ʜɑɴɴɴ', '10', '2023-12-19 08:35:49', 0, 'Selasa', 'Anda butuh istirahat.'),
(150, 'RIFAN', '8', '2023-12-19 09:19:34', 0, 'Selasa', 'Cukup istirahat.'),
(151, 'RIFAN', '8', '2023-12-19 09:49:14', 0, 'Selasa', 'Cukup istirahat.'),
(152, 'Puput', '8', '2023-12-19 10:18:48', 0, 'Selasa', 'Cukup istirahat.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `oauth_uid` (`oauth_uid`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
