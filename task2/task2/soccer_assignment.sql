-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2024 at 05:07 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soccer_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `football_scores_and_fixtures`
--

DROP TABLE IF EXISTS `football_scores_and_fixtures`;
CREATE TABLE IF NOT EXISTS `football_scores_and_fixtures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `home_team` varchar(45) DEFAULT NULL,
  `away_team` varchar(45) DEFAULT NULL,
  `home_score` int DEFAULT NULL,
  `away_score` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `football_scores_and_fixtures`
--

INSERT INTO `football_scores_and_fixtures` (`id`, `home_team`, `away_team`, `home_score`, `away_score`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Arsenal', 'Man-u', 2, 1, 1, '2024-05-02 17:42:24', '2024-05-02 17:42:24'),
(2, 'Aston Villa', 'Chelsea', 1, 4, 1, '2024-05-02 17:43:04', '2024-05-02 17:43:04'),
(3, 'Aston Villa', 'Chelsea', 3, 4, 1, '2024-05-05 10:18:12', '2024-05-05 10:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `premier_league_table`
--

DROP TABLE IF EXISTS `premier_league_table`;
CREATE TABLE IF NOT EXISTS `premier_league_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `season` varchar(45) DEFAULT NULL,
  `position` int DEFAULT NULL,
  `team` varchar(45) DEFAULT NULL,
  `played` int DEFAULT NULL,
  `won` int DEFAULT NULL,
  `drawn` int DEFAULT NULL,
  `lost` int DEFAULT NULL,
  `goals_for` int DEFAULT NULL,
  `goals_against` int DEFAULT NULL,
  `points` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `premier_league_table`
--

INSERT INTO `premier_league_table` (`id`, `season`, `position`, `team`, `played`, `won`, `drawn`, `lost`, `goals_for`, `goals_against`, `points`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'season 10', 2, 'Arsenal', 21, 12, 2, 10, 12, 10, 12, 1, '2024-05-02 18:12:02', '2024-05-02 18:12:02'),
(2, 'season 10', 1, 'Manu u', 21, 12, 2, 10, 12, 10, 13, 1, '2024-05-03 09:22:22', '2024-05-03 09:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `premier_league_top_scorers`
--

DROP TABLE IF EXISTS `premier_league_top_scorers`;
CREATE TABLE IF NOT EXISTS `premier_league_top_scorers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `season` varchar(45) DEFAULT NULL,
  `rank` int DEFAULT NULL,
  `player_name` varchar(45) DEFAULT NULL,
  `team` varchar(45) DEFAULT NULL,
  `goals` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `premier_league_top_scorers`
--

INSERT INTO `premier_league_top_scorers` (`id`, `season`, `rank`, `player_name`, `team`, `goals`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'season 10', 1, 'christiano', 'arsenal', 30, 1, '2024-05-02 18:12:02', '2024-05-02 18:12:02'),
(2, 'season 10', 1, 'Henry Thierry', 'Arsenal', 40, 1, '2024-05-02 18:37:07', '2024-05-02 18:37:07'),
(3, 'season 10', 3, 'Roney', 'Manu u', 44, 1, '2024-05-03 09:08:40', '2024-05-03 09:08:40'),
(4, 'season 10', 2, 'Van Persie', 'Arsenal', 45, 1, '2024-05-03 09:21:13', '2024-05-03 09:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `sex`, `photo`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Joshua MS', 'm', NULL, 'mojjysolo1@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997 ', '2024-05-02 06:15:22', '2024-05-02 06:15:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
