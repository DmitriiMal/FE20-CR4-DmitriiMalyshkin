-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2023 at 05:20 PM
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
-- Database: `BE20_CR4_DmitriiMalyshkin_BigLibrary`
--
CREATE DATABASE IF NOT EXISTS `BE20_CR4_DmitriiMalyshkin_BigLibrary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `BE20_CR4_DmitriiMalyshkin_BigLibrary`;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `ISBN` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `author_first_name` varchar(50) DEFAULT NULL,
  `author_last_name` varchar(50) DEFAULT NULL,
  `publisher_name` varchar(50) DEFAULT NULL,
  `publisher_address` varchar(50) DEFAULT NULL,
  `publish_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`ISBN`, `title`, `image`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`) VALUES
(1357891747, 'Epic Fantasy Chronicles', '65587859050b2.jpg', 'Embark on a journey through a fantastical realm filled with magic and adventure.', 'book', 'Michael', 'Robinson', 'Enigma Books & Co.', '789 Magic Lane, Enchanted City', '2022-12-05'),
(1563421675, 'Lost in Time', '65587863de0a0.jpg', 'A thrilling time-travel adventure with unexpected twists.', 'cd', 'Olivia', 'Anderson', 'Enigma Books & Co.', '456 Temporal Street, Chrono City', '2022-10-10'),
(1819915074, 'Code Breaker', '655878f159d8a.jpg', 'Unraveling the mysteries of coding and encryption.', 'dvd', 'David', 'Johnson', 'Tech Publications', '789 Code Lane, Cyberspace City', '2023-06-08'),
(2217254165, 'Cooking Adventures', '655878731e23d.jpg', 'Explore the world of culinary delights with these exciting recipes.', 'book', 'Emily', 'Jones', 'VistaPrint Publishing', '789 Food Avenue, Gourmet Town', '2023-03-10'),
(2217262456, 'Financial Success Blueprint', '655878373a693.jpg', 'Strategies for achieving financial success and independence.', 'cd', 'Emma', 'Turner', 'Tech Publications', '123 Wealth Street, Prosperity City', '2023-08-05'),
(2290876826, 'Mystery of the Lost Key', '65587886536d6.jpg', 'Join Detective Smith in solving the mystery of the lost key.', 'book', 'Alice', 'Smith', 'Enigma Books & Co.', '456 Mystery Lane, Enigma City', '2022-11-28'),
(2357363460, 'The Art of Photography', '655878909c096.jpg', 'Mastering the craft of capturing moments through the lens.', 'book', 'Daniel', 'Lee', 'VistaPrint Publishing', '123 Shutter Avenue, Snapshot City', '2023-07-01'),
(2536913680, 'The Science of Data', '655878a1199f0.jpg', 'Exploring the world of data science and analytics.', 'book', 'Jessica', 'Williams', 'Tech Publications', '456 Data Street, Analytics City', '2023-02-20'),
(6412376758, 'The Art of Programming', '655878b02bce3.jpg', 'A comprehensive guide to programming.', 'dvd', 'John', 'Doe', 'Tech Publications', '123 Tech Street, Tech City', '2023-01-15'),
(7096552585, 'Beyond the Stars', '655878b986784.jpg', 'Exploring the wonders of the universe and beyond.', 'book', 'Eleanor', 'Taylor', 'VistaPrint Publishing', '456 Galaxy Lane, Stellar City', '2023-09-22'),
(8410672851, 'The Enchanted Garden', '655878cc1fb5e.jpg', 'A magical tale of a hidden garden and its secrets.', 'book', 'William', 'Martin', 'Enigma Books & Co.', '789 Magic Lane, Enchanted City', '2022-11-15'),
(8586515792, 'Infinite Possibilities', '655878d7372ff.jpg', 'Exploring the limitless potential of the human mind.', 'cd', 'Alexander', 'Harris', 'VistaPrint Publishing', '456 Imagination Avenue, Dream City', '2023-10-30'),
(9178718001, 'Healthy Living Guide', '655878e1e561b.jpg', 'Tips and recipes for a healthy and balanced lifestyle.', 'book', 'Sophie', 'Miller', 'VistaPrint Publishing', '123 Wellness Avenue, Fit City', '2023-04-15'),
(9816729100, 'test', 'product.png', 'test', 'book', 'test', 'test', 'test', 'test', '2020-12-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`ISBN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `ISBN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9816729101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
