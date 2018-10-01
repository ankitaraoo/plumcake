-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2018 at 11:34 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Project #1', '2018-09-29 08:08:01', '2018-09-29 08:08:01'),
(2, 'Project #2', '2018-09-29 08:08:16', '2018-09-29 08:08:16'),
(3, 'Project #3', '2018-09-29 18:10:15', '2018-09-29 18:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Unresolved', '2018-09-30 00:00:00', '2018-09-30 00:00:00'),
(2, 'Resolved', '2018-09-30 00:02:00', '2018-09-30 19:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Bug-Low_Priority', '2018-10-01 00:00:00', '2018-10-01 00:00:00'),
(2, 'Bug-High_Priority', '2018-10-01 00:00:00', '2018-10-01 00:00:00'),
(3, 'HR', '2018-09-29 08:06:08', '2018-09-29 08:06:08'),
(5, 'Marketing', '2018-09-29 17:25:02', '2018-09-29 17:25:02'),
(6, 'PR', '2018-09-29 17:39:30', '2018-09-29 17:39:30'),
(7, 'Finance', '2018-09-29 17:39:30', '2018-09-29 17:39:30'),
(8, 'Complaint-Low_Priority', '2018-10-01 00:00:00', '2018-10-01 00:00:00'),
(9, 'Complaint-High_Priority', '2018-10-01 00:00:00', '2018-10-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `status_id`, `project_id`, `title`, `body`, `created`, `modified`, `slug`) VALUES
(49, 2, 1, NULL, 'Authentication Failing', 'The authentication for users is not working in Project X. ', '2018-10-01 09:25:42', '2018-10-01 09:25:42', 'Authentication-Failing'),
(50, 2, 1, NULL, 'Insufficient Coffee', 'There is not enough coffee available in the pantry.', '2018-10-01 09:26:28', '2018-10-01 09:26:28', 'Insufficient-Coffee');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_tags`
--

CREATE TABLE `tickets_tags` (
  `ticket_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_tags`
--

INSERT INTO `tickets_tags` (`ticket_id`, `tag_id`) VALUES
(49, 2),
(50, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'ankita_rao', '$2y$10$LuaEjd1L5YdNdyScOHSPQeNYZllAiKuPVA1DsRqCc/N2O8dwyZJ5u', 'admin', NULL, NULL),
(2, 'user_1', '$2y$10$AikibXg3loJaWFxR9i3QJeqD5YU9cNKPR1IG.q/Ir/Tma8uiF3MBK', 'user', NULL, NULL),
(3, 'user_2', '$2y$10$0gspM6OKyXp0nwTVRr8RUuw54YoVpMcojkelv0MXWTP4491hcwKyK', 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`title`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`title`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`title`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`slug`),
  ADD KEY `status_key` (`status_id`),
  ADD KEY `project_key` (`project_id`);

--
-- Indexes for table `tickets_tags`
--
ALTER TABLE `tickets_tags`
  ADD PRIMARY KEY (`ticket_id`,`tag_id`),
  ADD KEY `tag_key` (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `tickets_tags`
--
ALTER TABLE `tickets_tags`
  ADD CONSTRAINT `tickets_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `tickets_tags_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
