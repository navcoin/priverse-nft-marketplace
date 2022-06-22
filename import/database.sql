-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2022 at 12:55 PM
-- Server version: 8.0.28
-- PHP Version: 5.6.40-57+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nft`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` tinytext NOT NULL,
  `tag` tinytext NOT NULL,
  `icon` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `tag`, `icon`) VALUES
(1, 'Art', 'art', 'fa-solid fa-paintbrush'),
(2, 'Game Content', 'game_content', 'fa-solid fa-gamepad'),
(3, 'Collectibles', 'collectibles', 'fa-solid fa-boxes-stacked'),
(4, 'Music', 'music', 'fa-solid fa-music'),
(5, 'Photography', 'photography', 'fa-solid fa-camera'),
(6, 'Sports', 'sports', 'fa-solid fa-person-running'),
(7, 'Trading Cards', 'trading_cards', 'fa-solid fa-diamond'),
(8, 'Utility', 'utility', 'fa-solid fa-wrench');

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` int NOT NULL,
  `token_id` tinytext NOT NULL,
  `name` text NOT NULL,
  `supply` bigint NOT NULL,
  `version` int NOT NULL,
  `metadata` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `nfts`
--

CREATE TABLE `nfts` (
  `id` int NOT NULL,
  `token_id` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nft_id` int NOT NULL,
  `metadata` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `token_id` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nft_id` int NOT NULL,
  `metadata` json DEFAULT NULL,
  `hash` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nout` int NOT NULL,
  `new_hash` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `nft_order` json NOT NULL,
  `verification_date` datetime NOT NULL,
  `invalidated_date` datetime DEFAULT NULL,
  `is_valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `proofs`
--

CREATE TABLE `proofs` (
  `id` int NOT NULL,
  `project_id` int DEFAULT NULL,
  `link_code` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `private_address` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token_id` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nft_id` int NOT NULL,
  `hash` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nout` int NOT NULL,
  `new_hash` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `verification_date` datetime DEFAULT NULL,
  `invalidated_date` datetime DEFAULT NULL,
  `is_valid` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfts`
--
ALTER TABLE `nfts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proofs`
--
ALTER TABLE `proofs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfts`
--
ALTER TABLE `nfts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proofs`
--
ALTER TABLE `proofs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
