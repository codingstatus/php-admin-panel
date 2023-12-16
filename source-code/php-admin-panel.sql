-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 01:01 PM
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
-- Database: `php-admin-panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `mobileNumber` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `gender`, `emailAddress`, `mobileNumber`, `pass`, `profileImage`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Super', 'Admin', 'male', 'admin@gmail.com', '1234567890', 'admin', 'super-admin.jpg', 0, '2023-11-27 16:24:15.122141', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `created_at`, `updated_at`) VALUES
(39, 'category-1', '2023-11-28 15:50:56.490888', '0000-00-00'),
(40, 'category-2', '2023-11-28 15:51:06.383103', '0000-00-00'),
(41, 'category-3', '2023-11-28 15:51:13.546000', '0000-00-00'),
(42, 'category-4', '2023-11-28 15:51:20.879156', '0000-00-00'),
(43, 'category-5', '2023-11-28 15:51:27.085593', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(10) NOT NULL,
  `categoryId` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `categoryId`, `title`, `description`, `thumbnail`, `created_at`, `updated_at`) VALUES
(13, '39', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', 'backgroundDefault.jpg', '2023-11-28 15:53:46.580379', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `siteidentity`
--

CREATE TABLE `siteidentity` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siteidentity`
--

INSERT INTO `siteidentity` (`id`, `name`, `favicon`, `logo`) VALUES
(3, 'My Website', 'cropped-codingstatus-icon.jpg', 'cropped-codingstatus-logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sitemenu`
--

CREATE TABLE `sitemenu` (
  `id` int(10) NOT NULL,
  `sitemenuName` varchar(255) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitemenu`
--

INSERT INTO `sitemenu` (`id`, `sitemenuName`, `created_at`, `updated_at`) VALUES
(11, 'menu-1', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(12, 'menu-2', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(13, 'menu-3', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(14, 'menu-4', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(15, 'menu-5', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `siteseo`
--

CREATE TABLE `siteseo` (
  `id` int(10) NOT NULL,
  `metaKeyword` varchar(255) NOT NULL,
  `metaDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siteseo`
--

INSERT INTO `siteseo` (`id`, `metaKeyword`, `metaDescription`) VALUES
(3, 'Best PHP Admin Panel', 'This is the best admin panel that can be used to manage varoius type of web applications');

-- --------------------------------------------------------

--
-- Table structure for table `sitesubmenu`
--

CREATE TABLE `sitesubmenu` (
  `id` int(10) NOT NULL,
  `sitesubmenuName` varchar(255) NOT NULL,
  `sitemenuId` int(10) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitesubmenu`
--

INSERT INTO `sitesubmenu` (`id`, `sitesubmenuName`, `sitemenuId`, `created_at`, `updated_at`) VALUES
(5, 'menu-1.1', 11, '2023-11-28 16:22:07.550429', '0000-00-00 00:00:00.000000'),
(6, 'menu-1.2', 11, '2023-11-28 16:22:13.448836', '0000-00-00 00:00:00.000000'),
(7, 'menu-2.1', 12, '2023-11-28 16:22:31.031464', '0000-00-00 00:00:00.000000'),
(10, 'menu-3.1', 13, '2023-11-28 16:23:20.159907', '0000-00-00 00:00:00.000000'),
(11, 'menu-3.2', 13, '2023-11-28 16:23:33.534479', '0000-00-00 00:00:00.000000'),
(12, 'menu-3.3', 13, '2023-11-28 16:23:44.835422', '0000-00-00 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siteidentity`
--
ALTER TABLE `siteidentity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemenu`
--
ALTER TABLE `sitemenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siteseo`
--
ALTER TABLE `siteseo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitesubmenu`
--
ALTER TABLE `sitesubmenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `siteidentity`
--
ALTER TABLE `siteidentity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sitemenu`
--
ALTER TABLE `sitemenu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `siteseo`
--
ALTER TABLE `siteseo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sitesubmenu`
--
ALTER TABLE `sitesubmenu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
