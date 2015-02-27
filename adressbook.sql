-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2015 at 01:32 AM
-- Server version: 5.5.25
-- PHP Version: 5.5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adressbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `cId` tinyint(11) NOT NULL,
  `rId` tinyint(11) NOT NULL,
  UNIQUE KEY `index1` (`cId`,`rId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`cId`, `rId`) VALUES
(1, 0),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 2),
(19, 2),
(30, 2),
(41, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parentId` tinyint(11) DEFAULT NULL,
  `email` char(255) NOT NULL,
  `positionId` tinyint(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `parentId` (`parentId`),
  KEY `id` (`id`),
  KEY `posit` (`positionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `parentId`, `email`, `positionId`, `password`) VALUES
(1, 'Igor M&#228;nd', 0, 'dsad@fgdgh.ru1', 2, ''),
(4, 'Hans Jørgen Doe', 1, 'adsaf', 4, 'dfw'),
(11, 'Mikael Blomkvist', 12, 'dasd@gfh.ru', 3, ''),
(12, 'Hans J&#248;rgen Doe', 1, 'fsdf@gfh.uu', 3, ''),
(13, 'Nat&#257;lija Iz&#257;ks K&#363;ks', 0, '777@7777.772233', 4, 'asdf'),
(14, 'Roland Charts', 4, '777@771177.77', 3, ''),
(15, 'horoshsoAdmin', 1, 'sss@ss.ss', 3, 'b51171302a95d44aa47cd8d4487a9ba9'),
(16, 'Mike Click', 15, 'jkjkjkjkjk@fgfd.ru', 1, ''),
(17, 'Lee Burrows', 4, 'das222d@gfh.ru', 3, 'aaa'),
(18, 'adminUser', 1, 'asdmin@admin.ad', 4, 'd41d8cd98f00b204e9800998ecf8427e'),
(19, 'testeAdmin', 11, 'admin@teste.ee', 3, '827ccb0eea8a706c4c34a16891f84e7b'),
(29, 'testeAdmin2', 11, 'adsad@fddddd3g.ru', 3, 'd41d8cd98f00b204e9800998ecf8427e'),
(37, 'aqweqwezdfd', 4, 'fdsf12.fdgfdg.RU', 1, '35a322a37e6fb34b2aaea6f4ed30aa7f');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`) VALUES
(1, 'Tester'),
(2, 'developer'),
(3, 'Team Coordinator'),
(4, 'Project Leader'),
(5, 'Business Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint(11) NOT NULL,
  `rolename` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ggg` (`rolename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rolename`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `posit` FOREIGN KEY (`positionId`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
