-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2020 at 09:08 AM
-- Server version: 5.5.28
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hkblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `name`, `createtime`) VALUES
(33, '2020-05-14', 1589443764),
(34, '2020-05-14', 1589444023),
(35, '2020-05-14', 1589445106);

-- --------------------------------------------------------

--
-- Table structure for table `note_content`
--

CREATE TABLE `note_content` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `content` varchar(255) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `note_content`
--

INSERT INTO `note_content` (`id`, `note_id`, `type`, `content`, `finished`) VALUES
(127, 33, 0, '1111111111', 1),
(128, 33, 0, '222222', 1),
(129, 33, 1, '1111111111', 1),
(130, 33, 2, '33333333', 0),
(131, 33, 3, '444444444444', 0),
(132, 34, 0, '1111111111', 1),
(133, 34, 0, '222222', 0),
(134, 34, 0, '333333', 0),
(135, 34, 1, '1111111111', 0),
(136, 34, 2, '33333333', 0),
(137, 34, 3, '444444444444', 0),
(138, 35, 0, '1111111111', 0),
(139, 35, 0, '222222', 0),
(140, 35, 1, '1111111111', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `note_content`
--
ALTER TABLE `note_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `note_content`
--
ALTER TABLE `note_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
