-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 04:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secret_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend_notification_table`
--

CREATE TABLE `friend_notification_table` (
  `notification_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `notification_type` varchar(100) NOT NULL,
  `notification_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friend_notification_table`
--

INSERT INTO `friend_notification_table` (`notification_id`, `user_unique_id`, `username`, `notification_type`, `notification_date`) VALUES
(1, 343815512, 'try1', 'home new post', '2026-02-01 08:35:59'),
(2, 1100557418, 'try3', 'new post', '2026-02-01 08:41:24'),
(3, 343815512, 'try1', 'new post', '2026-02-01 10:50:46'),
(4, 343815512, 'try1', 'new post', '2026-02-01 10:53:28'),
(5, 343815512, 'try1', 'new post', '2026-02-01 11:12:16'),
(6, 1492028031, 'try5', 'home new post', '2026-02-03 14:20:18'),
(7, 1492028031, 'try5', 'new post', '2026-02-03 14:20:44'),
(8, 1395178257, 'try4', 'new post', '2026-02-03 14:22:18'),
(9, 343815512, 'try1', 'new post', '2026-02-03 14:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `home_uploaded`
--

CREATE TABLE `home_uploaded` (
  `post_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `post_texts` text NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `post_img` varchar(250) NOT NULL,
  `post_like` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_uploaded`
--

INSERT INTO `home_uploaded` (`post_id`, `user_unique_id`, `username`, `post_texts`, `post_type`, `upload_id`, `post_img`, `post_like`, `post_date`) VALUES
(1, 343815512, 'try1', 'test test test test test', 'main-post', 679279798, 'amazon3.jpg', 1, '2025-11-03 20:01:37'),
(2, 343815512, 'try1', 'test test test test', 'story-post', 2143057548, 'color-pick-1', 2, '2026-02-01 04:24:54'),
(7, 343815512, 'try1', 'clown', 'main-post', 902248680, 'amazon2.jpg', 1, '2026-02-01 10:31:41'),
(8, 1100557418, 'try3', 'build all these shit up', 'story-post', 238998302, 'color-pick-4', 1, '2026-02-01 10:32:05'),
(9, 343815512, 'try1', 'jhjh', 'story-post', 1238717899, 'color-pick-6', 0, '2026-02-01 11:12:16'),
(10, 1492028031, 'try5', 'hgh', 'main-post', 1363232911, 'amazon4.jpg', 0, '2026-02-03 14:20:18'),
(11, 1492028031, 'try5', 'khjjh', 'story-post', 1276805276, 'color-pick-2', 0, '2026-02-03 14:20:44'),
(12, 1395178257, 'try4', 'nkjk', 'story-post', 1662274639, 'color-pick-5', 0, '2026-02-03 14:22:18'),
(13, 343815512, 'try1', 'like this bitch??', 'story-post', 641117049, 'color-pick-1', 4, '2026-02-03 14:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `profile_story`
--

CREATE TABLE `profile_story` (
  `story_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `user_story` text NOT NULL,
  `user_color` varchar(100) NOT NULL,
  `user_story_like` int(11) NOT NULL,
  `story_unique_id` int(11) NOT NULL,
  `story_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_story`
--

INSERT INTO `profile_story` (`story_id`, `username`, `user_unique_id`, `user_story`, `user_color`, `user_story_like`, `story_unique_id`, `story_date`) VALUES
(2, 'try1', 343815512, 'testing 3', 'color-pick-5', 2, 1390124699, '2026-02-01 06:46:58'),
(3, 'try1', 343815512, 'go crazy', 'color-pick-2', 1, 954321453, '2026-02-01 10:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `profile_story_comment`
--

CREATE TABLE `profile_story_comment` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_owner_username` varchar(100) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_image` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_comment_post` varchar(100) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_story_comment`
--

INSERT INTO `profile_story_comment` (`user_id`, `user_unique_id`, `username`, `comment_owner_username`, `comment_owner_id`, `comment`, `post_image`, `post_id`, `user_comment_post`, `comment_date`) VALUES
(1, 343815512, '343815512', 'try1', 0, 'test test test test', 'color-pick-5', 2, 'amazon6.jpg', '2025-11-03 19:27:00'),
(2, 343815512, '343815512', 'try1', 0, 'test test test test', 'color-pick-5', 2, 'amazon6.jpg', '2025-11-03 19:39:48'),
(3, 343815512, '1100557418', 'try3', 0, 'hh', 'color-pick-5', 2, 'amazon11.jpg', '2026-02-01 06:47:39'),
(4, 343815512, '343815512', 'try1', 0, 'very soon', 'color-pick-2', 3, 'amazon6.jpg', '2026-02-01 10:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `profile_story_like`
--

CREATE TABLE `profile_story_like` (
  `story_like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_clicked` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `liked_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_story_like`
--

INSERT INTO `profile_story_like` (`story_like_id`, `post_id`, `is_clicked`, `user_unique_id`, `liked_date`) VALUES
(1, 2, 'true', 343815512, '2025-11-03 19:26:34'),
(2, 2, 'true', 1100557418, '2026-02-01 06:46:58'),
(3, 3, 'true', 343815512, '2026-02-01 10:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `profile_uploaded`
--

CREATE TABLE `profile_uploaded` (
  `post_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `post_texts` text NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL,
  `post_like` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_uploaded`
--

INSERT INTO `profile_uploaded` (`post_id`, `user_unique_id`, `username`, `post_texts`, `post_type`, `upload_id`, `post_img`, `post_like`, `post_date`) VALUES
(1, 343815512, 'try1', 'testing 1', 'main-post', 1585105896, 'amazon7.jpg', 1, '2026-02-01 08:23:03'),
(4, 343815512, 'try1', 'testing 3', 'story-post', 1390124699, 'color-pick-5', 2, '2026-02-01 06:46:58'),
(5, 1100557418, 'try3', 'big win', 'main-post', 468749337, 'amazon5.jpg', 2, '2026-02-01 10:37:41'),
(6, 343815512, 'try1', 'baggy', 'main-post', 76202850, 'amazon8.jpg', 1, '2026-02-01 10:53:37'),
(7, 343815512, 'try1', 'go crazy', 'story-post', 954321453, 'color-pick-2', 1, '2026-02-01 10:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `search_recent_table`
--

CREATE TABLE `search_recent_table` (
  `search_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `search_result` text NOT NULL,
  `search_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `search_recent_table`
--

INSERT INTO `search_recent_table` (`search_id`, `user_unique_id`, `username`, `search_result`, `search_date`) VALUES
(1, 343815512, '0', 'try2', '2025-12-15 23:22:01'),
(2, 343815512, 'try1', 'try2', '2026-02-03 06:27:37'),
(3, 343815512, 'try1', 'try4', '2026-02-03 06:35:58'),
(4, 343815512, 'try1', 'try5', '2026-02-03 06:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `secret_friend_request`
--

CREATE TABLE `secret_friend_request` (
  `reqeuest_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `request_username` varchar(100) NOT NULL,
  `request_unique_id` int(11) NOT NULL,
  `request_status` varchar(100) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_friend_request`
--

INSERT INTO `secret_friend_request` (`request_id`, `user_unique_id`, `username`, `request_username`, `request_unique_id`, `request_status`, `request_date`) VALUES
(1, 1395178257, 'try4', 'try1', 343815512, 'Request accepted', '2026-02-03 06:21:20'),
(2, 343815512, 'try1', 'try3', 1100557418, 'Request accepted', '2025-11-04 18:00:14'),
(3, 1907748857, 'try2', 'try1', 343815512, 'Not accepted', '2025-12-15 23:22:28'),
(5, 1492028031, 'try5', 'try1', 343815512, 'Request accepted', '2026-02-03 14:19:22'),
(6, 1395178257, 'try4', 'try3', 1100557418, 'Not accepted', '2026-02-03 14:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `secret_friend_table`
--

CREATE TABLE `secret_friend_table` (
  `id` int(11) NOT NULL,
  `friend_unique_id_1` int(11) NOT NULL,
  `friend_username_1` varchar(100) NOT NULL,
  `friend_email_1` varchar(250) NOT NULL,
  `friend_unique_id_2` int(11) NOT NULL,
  `friend_username_2` varchar(100) NOT NULL,
  `friend_email_2` varchar(250) NOT NULL,
  `source_of_friendship` varchar(250) NOT NULL,
  `date_of_friendship` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_friend_table`
--

INSERT INTO `secret_friend_table` (`id`, `friend_unique_id_1`, `friend_username_1`, `friend_email_1`, `friend_unique_id_2`, `friend_username_2`, `friend_email_2`, `source_of_friendship`, `date_of_friendship`) VALUES
(1, 1100557418, 'try3', 'try3@gmail.com', 343815512, 'try1', 'try1@gmail.com', 'try3 add try1', '2025-11-04 18:00:14'),
(2, 343815512, 'try1', 'try1@gmail.com', 1395178257, 'try4', 'try4@gmail.com', 'try1 add try4', '2026-02-03 06:21:20'),
(3, 343815512, 'try1', 'try1@gmail.com', 1492028031, 'try5', 'try5@gmail.com', 'try1 add try5', '2026-02-03 14:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `secret_notification_table`
--

CREATE TABLE `secret_notification_table` (
  `notification_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `friend_unique_id` int(11) NOT NULL,
  `friend_username` varchar(100) NOT NULL,
  `notification_type` varchar(100) NOT NULL,
  `notification_seen` varchar(100) NOT NULL,
  `notification_post_id` int(11) NOT NULL,
  `notification_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_notification_table`
--

INSERT INTO `secret_notification_table` (`notification_id`, `user_unique_id`, `username`, `friend_unique_id`, `friend_username`, `notification_type`, `notification_seen`, `notification_post_id`, `notification_date`) VALUES
(1, 1100557418, 'try3', 343815512, 'try1', 'post comment', 'unseen', 1585105896, '2026-02-01 08:42:56'),
(2, 343815512, 'try1', 1100557418, 'try3', 'post like', 'unseen', 468749337, '2026-02-01 10:37:41'),
(3, 343815512, 'try1', 1100557418, 'try3', 'post comment', 'unseen', 468749337, '2026-02-01 10:40:45'),
(4, 343815512, 'try1', 1100557418, 'try3', 'post comment', 'unseen', 76202850, '2026-02-01 10:53:14'),
(5, 343815512, 'try1', 1100557418, 'try3', 'story comment', 'unseen', 954321453, '2026-02-01 10:53:52'),
(6, 343815512, 'try1', 1100557418, 'try3', 'story comment', 'unseen', 954321453, '2026-02-01 10:53:52'),
(7, 1395178257, 'try4', 343815512, 'try1', 'friend accepted', 'unseen', 0, '2026-02-03 06:21:20'),
(8, 1395178257, 'try4', 1100557418, 'try3', 'friend request', 'unseen', 0, '2026-02-03 06:22:17'),
(9, 343815512, 'try1', 1492028031, 'try5', 'friend request', 'unseen', 0, '2026-02-03 14:05:40'),
(10, 1100557418, 'try3', 1395178257, 'try4', 'friend request', 'unseen', 0, '2026-02-03 14:06:57'),
(11, 1492028031, 'try5', 343815512, 'try1', 'friend accepted', 'unseen', 0, '2026-02-03 14:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `secret_users`
--

CREATE TABLE `secret_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `age` varchar(100) NOT NULL,
  `location` varchar(250) NOT NULL,
  `user_picture` varchar(250) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `user_online` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_users`
--

INSERT INTO `secret_users` (`user_id`, `username`, `user_email`, `password`, `age`, `location`, `user_picture`, `user_unique_id`, `user_online`, `date`) VALUES
(1, 'try1', 'try1@gmail.com', '$2y$10$l0gFEjOt79ET9axMqMHPJecU2ctWrJS29kocqXH9mhKEDsGGT83E.', 'june 03', 'abuja', 'amazon6.jpg', 343815512, 'online', '2026-02-03 14:22:54'),
(2, 'try2', 'try2@gmail.com', '$2y$10$lV/yx7qbNymULLcj4BAesuaXQNz.aEKDSMh3qhxgDLtxT7/fChYuO', 'january 2', 'washiton', 'amazon8.jpg', 1907748857, 'online', '2025-11-03 20:34:38'),
(3, 'try3', 'try3@gmail.com', '$2y$10$oL7nIFF0vwT/i2BteTk0Ku2X/Srj4bhgXhNWX/sGyKqAHHAO2ZW9a', 'july 03', 'abuja', 'amazon11.jpg', 1100557418, 'offline', '2026-02-03 14:26:25'),
(4, 'try4', 'try4@gmail.com', '$2y$10$F2JVAuOQcVaTQjNgocoXGuZCxVNswLHhOsqAT5Eu5WtI.UwLxne6S', 'may 04', 'abuja', 'amazon9.jpg', 1395178257, 'offline', '2026-02-03 14:24:02'),
(5, 'try5', 'try5@gmail.com', '$2y$10$.UltCn5qQn356E4a1iWpPOePjalfynoig/4b7JnsvYQZfxf4VzbAW', 'octoper 05', 'kansas', 'amazon12.jpg', 1492028031, 'online', '2026-02-03 14:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `secret_users_about`
--

CREATE TABLE `secret_users_about` (
  `about_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_work` text NOT NULL,
  `user_place_lived` text NOT NULL,
  `user_relationship` text NOT NULL,
  `user_home_town` text NOT NULL,
  `user_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_users_about`
--

INSERT INTO `secret_users_about` (`about_id`, `user_unique_id`, `username`, `user_work`, `user_place_lived`, `user_relationship`, `user_home_town`, `user_details`) VALUES
(1, 343815512, 'try1', '&plus; Add a WorkPlace', '&plus; Visited Places', '&plus; Relationship Status', '&plus; Home Town', '&plus; Something people need to know!!'),
(2, 1100557418, 'try3', '&plus; Add a WorkPlace', '&plus; Visited Places', '&plus; Relationship Status', '&plus; Home Town', '&plus; Something people need to know!!'),
(3, 1395178257, 'try4', '&plus; Add a WorkPlace', '&plus; Visited Places', '&plus; Relationship Status', '&plus; Home Town', '&plus; Something people need to know!!'),
(4, 1907748857, 'try1', '&plus; Add a WorkPlace', '&plus; Visited Places', '&plus; Relationship Status', '&plus; Home Town', '&plus; Something people need to know!!');

-- --------------------------------------------------------

--
-- Table structure for table `secret_users_bio`
--

CREATE TABLE `secret_users_bio` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_users_bio`
--

INSERT INTO `secret_users_bio` (`user_id`, `user_unique_id`, `username`, `user_bio`) VALUES
(1, 343815512, 'try1', 'test test test test test test test test 111'),
(2, 1395178257, 'try4', 'jhjhhjk');

-- --------------------------------------------------------

--
-- Table structure for table `secret_users_comment`
--

CREATE TABLE `secret_users_comment` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_owner_username` varchar(100) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_img` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_comment_post` varchar(250) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_users_comment`
--

INSERT INTO `secret_users_comment` (`user_id`, `user_unique_id`, `username`, `comment_owner_username`, `comment_owner_id`, `comment`, `post_img`, `post_id`, `user_comment_post`, `comment_date`) VALUES
(3, 1100557418, 'try3', 'try3', 1100557418, 'ujj', 'amazon5.jpg', 3, 'amazon11.jpg', '2026-02-01 06:52:47'),
(4, 343815512, 'try1', 'try3', 1100557418, 'are you there', 'amazon7.jpg', 1, 'amazon11.jpg', '2026-02-01 08:42:56'),
(5, 1100557418, 'try3', 'try1', 343815512, 'lalala', 'amazon5.jpg', 3, 'amazon6.jpg', '2026-02-01 10:40:45'),
(6, 343815512, 'try1', 'try1', 343815512, 'mkjkl', 'amazon8.jpg', 4, 'amazon6.jpg', '2026-02-01 10:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `secret_users_home_post`
--

CREATE TABLE `secret_users_home_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_post_caption` text NOT NULL,
  `user_post_img` varchar(250) NOT NULL,
  `user_post_like` int(11) NOT NULL,
  `post_unique_id` int(11) NOT NULL,
  `user_post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_users_home_post`
--

INSERT INTO `secret_users_home_post` (`id`, `user_id`, `username`, `user_post_caption`, `user_post_img`, `user_post_like`, `post_unique_id`, `user_post_date`) VALUES
(1, 343815512, 'try1', 'test test test test test', 'amazon3.jpg', 0, 1937863987, '2025-11-03 19:53:46'),
(2, 343815512, 'try1', 'test test test test test', 'amazon3.jpg', 1, 679279798, '2025-11-03 20:01:37'),
(6, 343815512, 'try1', 'clown', 'amazon2.jpg', 1, 902248680, '2026-02-01 10:31:41'),
(7, 1492028031, 'try5', 'hgh', 'amazon4.jpg', 0, 1363232911, '2026-02-03 14:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `secret_user_home_comment`
--

CREATE TABLE `secret_user_home_comment` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_owner_username` varchar(100) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_img` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_comment_post` varchar(250) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_user_home_comment`
--

INSERT INTO `secret_user_home_comment` (`user_id`, `user_unique_id`, `username`, `comment_owner_username`, `comment_owner_id`, `comment`, `post_img`, `post_id`, `user_comment_post`, `comment_date`) VALUES
(1, 343815512, 'try1', 'try1', 343815512, 'test test test test test test', 'amazon3.jpg', 2, 'amazon6.jpg', '2025-11-03 20:02:01'),
(2, 343815512, 'try1', 'try3', 1100557418, 'kkfkak', 'amazon3.jpg', 2, 'amazon11.jpg', '2026-02-01 04:54:41'),
(3, 343815512, 'try1', 'try3', 1100557418, 'fdfa', 'amazon3.jpg', 2, 'amazon11.jpg', '2026-02-01 06:28:09'),
(8, 343815512, 'try1', 'try1', 343815512, 'jjkj', 'amazon2.jpg', 6, 'amazon6.jpg', '2026-02-01 08:39:06'),
(9, 343815512, 'try1', 'try3', 1100557418, 'find money ', 'amazon2.jpg', 6, 'amazon11.jpg', '2026-02-01 08:39:29'),
(10, 343815512, 'try1', 'try3', 1100557418, 'lol', 'amazon2.jpg', 6, 'amazon11.jpg', '2026-02-01 10:33:19'),
(11, 343815512, 'try1', 'try3', 1100557418, 'kkk', 'amazon2.jpg', 6, 'amazon11.jpg', '2026-02-01 10:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `secret_user_post`
--

CREATE TABLE `secret_user_post` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `user_post_img` varchar(250) NOT NULL,
  `user_post_caption` text NOT NULL,
  `user_post_like` int(11) NOT NULL,
  `post_unique_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secret_user_post`
--

INSERT INTO `secret_user_post` (`user_id`, `username`, `user_unique_id`, `user_post_img`, `user_post_caption`, `user_post_like`, `post_unique_id`, `post_date`) VALUES
(1, 'try1', 343815512, 'amazon7.jpg', 'testing 1', 1, 1585105896, '2026-02-01 08:23:03'),
(3, 'try3', 1100557418, 'amazon5.jpg', 'big win', 2, 468749337, '2026-02-01 10:37:41'),
(4, 'try1', 343815512, 'amazon8.jpg', 'baggy', 1, 76202850, '2026-02-01 10:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion_remove_table`
--

CREATE TABLE `suggestion_remove_table` (
  `suggestion_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `remove_user_unique_id` int(11) NOT NULL,
  `remove_username` varchar(100) NOT NULL,
  `remove_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestion_remove_table`
--

INSERT INTO `suggestion_remove_table` (`suggestion_id`, `user_unique_id`, `username`, `remove_user_unique_id`, `remove_username`, `remove_date`) VALUES
(1, 1395178257, 'try4', 1100557418, 'try3', '2026-02-03 14:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `users_chat`
--

CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_username` varchar(100) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_username` varchar(100) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_status` varchar(100) NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_chat`
--

INSERT INTO `users_chat` (`msg_id`, `sender_id`, `sender_username`, `receiver_id`, `receiver_username`, `msg_content`, `msg_status`, `msg_date`) VALUES
(1, 343815512, 'try1', 1395178257, 'try4', 'alnassr dey another round of lucky draw', 'later', '2026-02-03 13:54:02'),
(2, 1395178257, 'try4', 343815512, 'try1', 'yes ooo. alhittad fit misbehave and show alnassr pepper.', 'later', '2026-02-03 13:54:39'),
(3, 343815512, 'try1', 1395178257, 'try4', 'nor be lie..dem dey lose before but dey go fit do gra gra give alnassr', 'later', '2026-02-03 13:55:24'),
(4, 1395178257, 'try4', 343815512, 'try1', 'yes ooo. hopefully they nor carry full squad come play', 'later', '2026-02-03 13:55:59'),
(5, 1395178257, 'try4', 343815512, 'try1', 'make they win hopefully', 'later', '2026-02-03 13:58:45'),
(6, 343815512, 'try1', 1395178257, 'try4', 'al hilla and al hali also need to chop some losings', 'later', '2026-02-03 13:59:12'),
(7, 343815512, 'try1', 1395178257, 'try4', 'al hilla never lose and that one that wahala', 'later', '2026-02-03 13:59:34'),
(8, 343815512, 'try1', 1395178257, 'try4', 'the both of them dey give al nassr headache', 'later', '2026-02-03 13:59:54'),
(9, 343815512, 'try1', 1395178257, 'try4', 'make dey kindly draw their next game...................................................................................................................', 'later', '2026-02-03 14:00:41'),
(10, 1395178257, 'try4', 343815512, 'try1', 'we go see', 'later', '2026-02-03 14:02:05'),
(11, 1395178257, 'try4', 343815512, 'try1', 'na two days from now..i don forget to watch my lab goat', 'later', '2026-02-03 14:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_home_like`
--

CREATE TABLE `user_home_like` (
  `home_like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_clicked` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `liked_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_home_like`
--

INSERT INTO `user_home_like` (`home_like_id`, `post_id`, `is_clicked`, `user_unique_id`, `liked_date`) VALUES
(1, 2, 'true', 343815512, '2025-11-03 20:01:37'),
(4, 6, 'true', 1100557418, '2026-02-01 10:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_home_story`
--

CREATE TABLE `user_home_story` (
  `story_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `user_story` text NOT NULL,
  `user_color` varchar(100) NOT NULL,
  `user_story_like` int(11) NOT NULL,
  `story_unique_id` int(11) NOT NULL,
  `story_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_home_story`
--

INSERT INTO `user_home_story` (`story_id`, `username`, `user_unique_id`, `user_story`, `user_color`, `user_story_like`, `story_unique_id`, `story_date`) VALUES
(1, 'try1', 343815512, 'test test test test', 'color-pick-1', 2, 2143057548, '2026-02-01 04:24:54'),
(3, 'try3', 1100557418, 'build all these shit up', 'color-pick-4', 1, 238998302, '2026-02-01 10:32:05'),
(4, 'try1', 343815512, 'jhjh', 'color-pick-6', 0, 1238717899, '2026-02-01 11:12:16'),
(5, 'try5', 1492028031, 'khjjh', 'color-pick-2', 0, 1276805276, '2026-02-03 14:20:44'),
(6, 'try4', 1395178257, 'nkjk', 'color-pick-5', 0, 1662274639, '2026-02-03 14:22:18'),
(7, 'try1', 343815512, 'like this bitch??', 'color-pick-1', 4, 641117049, '2026-02-03 14:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_home_story_comment`
--

CREATE TABLE `user_home_story_comment` (
  `user_id` int(11) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment_owner_username` varchar(100) NOT NULL,
  `comment_owner_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_image` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_comment_post` varchar(250) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_home_story_comment`
--

INSERT INTO `user_home_story_comment` (`user_id`, `user_unique_id`, `username`, `comment_owner_username`, `comment_owner_id`, `comment`, `post_image`, `post_id`, `user_comment_post`, `comment_date`) VALUES
(1, 343815512, 'try1', 'try1', 343815512, 'test test test test', 'color-pick-1', 1, 'amazon6.jpg', '2025-11-03 20:23:44'),
(2, 1100557418, 'try3', 'try1', 343815512, 'hehehehe', 'color-pick-1', 1, 'amazon11.jpg', '2026-02-01 04:29:42'),
(3, 343815512, 'try1', 'try1', 343815512, 'dfaf', 'color-pick-1', 1, 'amazon6.jpg', '2026-02-01 04:49:53'),
(4, 1100557418, 'try3', 'try1', 343815512, 'hdhdh', 'color-pick-1', 1, 'amazon11.jpg', '2026-02-01 06:16:28'),
(5, 343815512, 'try1', 'try3', 1100557418, 'hhjjh', 'color-pick-4', 3, 'amazon6.jpg', '2026-02-01 10:32:19'),
(6, 343815512, 'try1', 'try1', 343815512, 'sgf', 'color-pick-6', 4, 'amazon6.jpg', '2026-02-01 11:13:04'),
(7, 1100557418, 'try3', 'try1', 343815512, 'faf', 'color-pick-6', 4, 'amazon11.jpg', '2026-02-01 11:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_home_story_like`
--

CREATE TABLE `user_home_story_like` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_clicked` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `liked_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_home_story_like`
--

INSERT INTO `user_home_story_like` (`id`, `post_id`, `is_clicked`, `user_unique_id`, `liked_date`) VALUES
(1, 1, 'true', 343815512, '2025-11-03 20:23:32'),
(2, 1, 'true', 1100557418, '2026-02-01 04:24:54'),
(3, 3, 'true', 343815512, '2026-02-01 10:32:05'),
(4, 7, 'true', 1395178257, '2026-02-03 14:23:56'),
(5, 7, 'true', 1100557418, '2026-02-03 14:25:52'),
(6, 7, 'true', 1492028031, '2026-02-03 14:26:50'),
(7, 7, 'true', 343815512, '2026-02-03 14:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile_like`
--

CREATE TABLE `user_profile_like` (
  `profile_like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_clicked` varchar(100) NOT NULL,
  `user_unique_id` int(11) NOT NULL,
  `liked_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile_like`
--

INSERT INTO `user_profile_like` (`profile_like_id`, `post_id`, `is_clicked`, `user_unique_id`, `liked_date`) VALUES
(2, 3, 'true', 1100557418, '2026-02-01 06:52:43'),
(3, 1, 'true', 1100557418, '2026-02-01 08:23:03'),
(4, 3, 'true', 343815512, '2026-02-01 10:37:41'),
(5, 4, 'true', 343815512, '2026-02-01 10:53:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend_notification_table`
--
ALTER TABLE `friend_notification_table`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `home_uploaded`
--
ALTER TABLE `home_uploaded`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `profile_story`
--
ALTER TABLE `profile_story`
  ADD PRIMARY KEY (`story_id`);

--
-- Indexes for table `profile_story_comment`
--
ALTER TABLE `profile_story_comment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `profile_story_like`
--
ALTER TABLE `profile_story_like`
  ADD PRIMARY KEY (`story_like_id`);

--
-- Indexes for table `profile_uploaded`
--
ALTER TABLE `profile_uploaded`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `search_recent_table`
--
ALTER TABLE `search_recent_table`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `secret_friend_request`
--
ALTER TABLE `secret_friend_request`
  ADD PRIMARY KEY (`reqeuest_id`);

--
-- Indexes for table `secret_friend_table`
--
ALTER TABLE `secret_friend_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secret_notification_table`
--
ALTER TABLE `secret_notification_table`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `secret_users`
--
ALTER TABLE `secret_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `secret_users_about`
--
ALTER TABLE `secret_users_about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `secret_users_bio`
--
ALTER TABLE `secret_users_bio`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `secret_users_comment`
--
ALTER TABLE `secret_users_comment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `secret_users_home_post`
--
ALTER TABLE `secret_users_home_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secret_user_home_comment`
--
ALTER TABLE `secret_user_home_comment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `secret_user_post`
--
ALTER TABLE `secret_user_post`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `suggestion_remove_table`
--
ALTER TABLE `suggestion_remove_table`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Indexes for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `user_home_like`
--
ALTER TABLE `user_home_like`
  ADD PRIMARY KEY (`home_like_id`);

--
-- Indexes for table `user_home_story`
--
ALTER TABLE `user_home_story`
  ADD PRIMARY KEY (`story_id`);

--
-- Indexes for table `user_home_story_comment`
--
ALTER TABLE `user_home_story_comment`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_home_story_like`
--
ALTER TABLE `user_home_story_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile_like`
--
ALTER TABLE `user_profile_like`
  ADD PRIMARY KEY (`profile_like_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend_notification_table`
--
ALTER TABLE `friend_notification_table`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home_uploaded`
--
ALTER TABLE `home_uploaded`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profile_story`
--
ALTER TABLE `profile_story`
  MODIFY `story_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile_story_comment`
--
ALTER TABLE `profile_story_comment`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profile_story_like`
--
ALTER TABLE `profile_story_like`
  MODIFY `story_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile_uploaded`
--
ALTER TABLE `profile_uploaded`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `search_recent_table`
--
ALTER TABLE `search_recent_table`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `secret_friend_request`
--
ALTER TABLE `secret_friend_request`
  MODIFY `reqeuest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `secret_friend_table`
--
ALTER TABLE `secret_friend_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `secret_notification_table`
--
ALTER TABLE `secret_notification_table`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `secret_users`
--
ALTER TABLE `secret_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `secret_users_about`
--
ALTER TABLE `secret_users_about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `secret_users_bio`
--
ALTER TABLE `secret_users_bio`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `secret_users_comment`
--
ALTER TABLE `secret_users_comment`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `secret_users_home_post`
--
ALTER TABLE `secret_users_home_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `secret_user_home_comment`
--
ALTER TABLE `secret_user_home_comment`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `secret_user_post`
--
ALTER TABLE `secret_user_post`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suggestion_remove_table`
--
ALTER TABLE `suggestion_remove_table`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_home_like`
--
ALTER TABLE `user_home_like`
  MODIFY `home_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_home_story`
--
ALTER TABLE `user_home_story`
  MODIFY `story_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_home_story_comment`
--
ALTER TABLE `user_home_story_comment`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_home_story_like`
--
ALTER TABLE `user_home_story_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_profile_like`
--
ALTER TABLE `user_profile_like`
  MODIFY `profile_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
