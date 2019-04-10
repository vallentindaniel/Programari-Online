-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 13, 2019 at 10:01 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfop`
--

-- --------------------------------------------------------

--
-- Table structure for table `programari_mar`
--

DROP TABLE IF EXISTS `programari_mar`;
CREATE TABLE IF NOT EXISTS `programari_mar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ora_select` int(11) NOT NULL,
  `zi_select` int(11) NOT NULL,
  `luna_select` int(11) NOT NULL,
  `an_select` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programari_mar`
--

INSERT INTO `programari_mar` (`id`, `ora_select`, `zi_select`, `luna_select`, `an_select`) VALUES
(1, 13, 13, 2, 2019),
(2, 14, 13, 2, 2019),
(3, 8, 14, 2, 2019);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
