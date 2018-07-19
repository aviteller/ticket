-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 07:01 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DueDate` date NOT NULL,
  `Completed` int(11) NOT NULL DEFAULT '0',
  `Deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `Name`, `Description`, `Company`, `DueDate`, `Completed`, `Deleted`) VALUES
(1, 'Lorem ipsum dolor sit.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis nostrum voluptatibus dolore asperiores impedit, quibusdam omnis eos nobis corporis id culpa eius ullam iusto ab aperiam commodi tempora aut porro!', '\r\nLorem.', '2018-07-10', 0, 1),
(2, 'Lorem ipsum dolor sit.asd', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis nostrum voluptatibus dolore asperiores impedit, quibusdam omnis eos nobis corporis id culpa eius ullam iusto ab aperiam commodi tempora aut porro!', '1sadasda', '2018-07-11', 0, 1),
(3, 'xz', 'zxcxz', '3', '2018-07-28', 0, 1),
(4, 'cxv', 'xvcxc', '3', '2018-07-06', 0, 1),
(5, '', 'sadas', '5', '2018-07-03', 0, 1),
(6, 'asdsa', '', '', '0000-00-00', 0, 1),
(7, 'asdsad', 'asdas', '2', '2018-07-12', 0, 1),
(8, '', '', 'Lorem.', '0000-00-00', 0, 1),
(9, '', '', 'Lorem.', '0000-00-00', 0, 1),
(10, '', '', '', '0000-00-00', 0, 1),
(11, 'asASA', 'AsA', 'asAaaSasa', '2018-06-28', 0, 1),
(12, '', 'dfssd', 'wqeqw', '0000-00-00', 0, 1),
(13, 'asdasd', 'dsasa', 'saddsa', '2018-07-07', 0, 1),
(14, '', '', '', '0000-00-00', 0, 1),
(15, '', '', '', '0000-00-00', 0, 1),
(16, '', '', '', '0000-00-00', 0, 1),
(17, '', '', '', '0000-00-00', 0, 1),
(18, '', '', '', '0000-00-00', 0, 1),
(19, '', '', '', '0000-00-00', 0, 1),
(20, '', '', '', '0000-00-00', 0, 1),
(21, 'shipping other countries', 'make a shipping option for other countries where they get a message saying they should call fabians for delivery option and price', 'fabians', '2018-07-19', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
