-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 08:38 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.7-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzes`
--
CREATE DATABASE IF NOT EXISTS `quizzes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quizzes`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(41) DEFAULT NULL,
  `is_correct` tinyint(1) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `text`, `is_correct`, `question_id`) VALUES
(2, 'dsdsd', 1, NULL),
(17, 'Atbilde 1', 1, 1),
(18, 'Atbilde 2', 0, 1),
(19, 'Atbilde 3', 0, 1),
(20, 'Atbilde 4', 0, 1),
(21, 'Atbilde 5', 1, 2),
(22, 'Atbilde 6', 1, 2),
(23, 'Atbilde 7', 1, 3),
(24, 'Atbilde 8', 0, 3),
(25, 'Atbilde 1', 1, 1),
(26, 'Atbilde 2', 0, 1),
(27, 'Atbilde 3', 0, 1),
(28, 'Atbilde 4', 0, 1),
(29, 'Atbilde 5', 1, 2),
(30, 'Atbilde 6', 1, 2),
(31, 'Atbilde 7', 1, 3),
(32, 'Atbilde 8', 0, 3),
(33, 'Atbilde 1', 1, 1),
(34, 'Atbilde 2', 0, 1),
(35, 'Atbilde 3', 0, 1),
(36, 'Atbilde 4', 0, 1),
(37, 'Atbilde 5', 1, 2),
(38, 'Atbilde 6', 1, 2),
(39, 'Atbilde 7', 1, 3),
(40, 'Atbilde 8', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `quiz_id`) VALUES
(1, 'Jautajums 1', 1),
(2, 'Jautajums 2', 1),
(3, 'Jautajums 3', 1),
(4, 'Jautajums 1', 1),
(5, 'Jautajums 2', 1),
(6, 'Jautajums 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(1, 'Tests 1'),
(2, 'Tests 2'),
(3, 'shis ir testa tests');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Jānis', '', ''),
(2, 'Sandis', '', ''),
(3, 'peteris', 'sandisrudzats@tvnet.lv', '202cb962ac59075b964b07152d234b70'),
(6, 'dsds', 'liga.rudzate@gmail.com', 'sa'),
(8, 'janis123', 'janis@banis.lv', '$2y$10$wbeFiTN.8US96T8C6cypR.Afs9/kUUsQA13.kdYu5cXoKET5xPLha'),
(12, 'Sandis', 'sandisrudzats@inbox.lv', '$2y$10$7T6eAoOuhGETGLUAqltqDernGrIwxR3hwcZDK0.DPfACFgt6e84au'),
(13, 'peteris1', 'peteris123@123.lv', '$2y$10$ku3YjBp1XaYzrKr6/rluX.jj.eWEA1uYtCnP7KqeO7KdO9KKmgI/W'),
(14, 'andris', 'andis@andis.lv', '$2y$10$Fb975jgu9Z0Xca4v409QQOxHWsqLCrj7K.NeIh0rrGFiXGc4BDwrG'),
(15, 'Sandis123', 'sandisrudzats@gmail.com', '$2y$10$EY5aj997099CdGBMEZAukO1WUWEWWHfgAnHPNBSNTXaJn6yoMInRC'),
(16, 'peteris12321321', 'as@as.lv', '$2y$10$59T48YStqvqkaq4R.dYZMeCAuoNnrvinhBU6cpuaWtgQwQtvLUpsi'),
(17, 'fafa', 'sasda@dadsa.lv', '$2y$10$bbJocwk/BSf5oN8ZlHp6Guw.UXFvMRjgo8hQnppMRAU8vOHJ5w2ei'),
(18, 'adadadada', 'sadnasdn@llll.lv', '$2y$10$SkdvUe/hL.uJcX2MdJkx3uViLJrInegr4nlM.eeTa79Xud0kl8Wa2'),
(19, 'davis', 'hola@hola.lv', '$2y$10$1QSvwgd3W7LclxPgTzepUuoxf53OoSU.y6fZn/.e30yCCZy7Se8TO'),
(20, 'zirgs', 'zirgs@zirgs.lv', '$2y$10$q42w63hbxkv0sKeaunY1zee4/3SIjKZJ1XvBVrVeB45iyror0vK9.'),
(21, 'alnis', 'alnis@alnis.lv', '$2y$10$1i4Ea4DNdgMmqxLEpP4KmOBPuYkH3d8YjubCuRH0Zr5PKfxBjLLAu');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `quiz_id` int(10) UNSIGNED DEFAULT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `answers_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questions_id_fk` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quizzes_id_fk` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_answers_id_fk` (`answers_id`),
  ADD KEY `user_answers_questions_id_fk` (`question_id`),
  ADD KEY `user_answers_quizzes_id_fk` (`quiz_id`),
  ADD KEY `user_answers_users_id_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answers_id_fk` FOREIGN KEY (`answers_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `user_answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `user_answers_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `user_answers_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
