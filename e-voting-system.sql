-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2019 at 11:06 AM
-- Server version: 5.7.19
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
-- Database: `e-voting-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadministrators`
--

DROP TABLE IF EXISTS `tbadministrators`;
CREATE TABLE IF NOT EXISTS `tbadministrators` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10007 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadministrators`
--

INSERT INTO `tbadministrators` (`admin_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(10001, 'huzefa', 'hussain', 'k163962@nu.edu.pk', 'huzefa.53'),
(10003, 'nida', 'zehra', 'nida@gmail.com', 'nida123'),
(10004, 'any', 'kuchbh', 'any@gmail.com', 'huzefa.53'),
(10006, 'new', 'hussain', 'admin@nu.edu.pk', 'huzefa.53');

-- --------------------------------------------------------

--
-- Table structure for table `tbcandidates`
--

DROP TABLE IF EXISTS `tbcandidates`;
CREATE TABLE IF NOT EXISTS `tbcandidates` (
  `candidate_id` int(5) NOT NULL AUTO_INCREMENT,
  `fk_member_id` int(11) DEFAULT NULL,
  `candidate_name` varchar(45) NOT NULL,
  `candidate_position` varchar(45) NOT NULL,
  `candidate_cvotes` int(11) NOT NULL,
  PRIMARY KEY (`candidate_id`),
  KEY `fk_member_id` (`fk_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcandidates`
--

INSERT INTO `tbcandidates` (`candidate_id`, `fk_member_id`, `candidate_name`, `candidate_position`, `candidate_cvotes`) VALUES
(4, 8, 'Wayne Rooney', 'Chairperson', 28),
(6, 4, 'Thomas Vaemalen', 'Vice-Secretary', 1),
(9, 8, 'Roberto Mancini', 'Secretary', 52),
(10, 4, 'Alex Ferguson', 'Treasurer', 4),
(11, 8, 'Howard Web', 'Vice-Treasurer', 3),
(12, 4, 'Richard Santana', 'Vice-Treasurer', 2),
(13, 4, 'Chemical Reaction', 'Treasurer', 7),
(14, 4, 'Danny Welbeck', 'Vice-Secretary', 1),
(15, 4, 'Paul Allen', 'Organizing-Secretary', 1),
(16, 4, 'Bill Gates', 'Organizing-Secretary', 1),
(17, NULL, 'Exponential Functions', 'Vice-Chairperson', 30),
(18, NULL, 'Algebraic Equations', 'Vice-Chairperson', 14),
(20, 9, 'bisma', 'Secretary', 3),
(21, 9, 'bisma', 'Secretary', 3),
(23, 4, 'gnsdjfdgo', 'fastnu', 1),
(24, 4, 'fdgthfhf', 'fastnu', 1),
(25, 4, 'nida', 'new2', 1),
(26, 12, 'taha', 'Treasurer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbmembers`
--

DROP TABLE IF EXISTS `tbmembers`;
CREATE TABLE IF NOT EXISTS `tbmembers` (
  `member_id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbmembers`
--

INSERT INTO `tbmembers` (`member_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Kimani', 'Kahiga', 'kahiga@gmail.com', '547da2b03f947606f1d06a8dec093e64'),
(2, 'MacDonald', 'Ngowi', 'mcbcrue08@gmail.com', '14b876400a7ae986df9b17fbaffb9eca'),
(3, 'test', 'testt', 'test@example.com', '098f6bcd4621d373cade4e832627b4f6'),
(4, 'huzefa', 'hussain', 'huzefa@nu.edu.pk', '37cfd605ae7123cba387973807ae48d0'),
(7, 'huzefa', 'hussain', 'k163962@nu.edu.pk', '37cfd605ae7123cba387973807ae48d0'),
(8, 'sana', 'arif', 'sanaarif123@gmail.com', '123456'),
(9, 'db', 'fifth', 'db@gmail.com', 'huzefa.53'),
(11, 'newvoter', 'voternew', 'voter@nu.edu.pk', 'huzefa.53'),
(12, 'taha', 'ali', 'taha@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbpositions`
--

DROP TABLE IF EXISTS `tbpositions`;
CREATE TABLE IF NOT EXISTS `tbpositions` (
  `position_id` int(5) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(45) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpositions`
--

INSERT INTO `tbpositions` (`position_id`, `position_name`) VALUES
(1, 'Chairperson'),
(2, 'Secretary'),
(5, 'Vice-Secretary'),
(7, 'Organizing-Secretary'),
(8, 'Treasurer'),
(9, 'Vice-Treasurer'),
(10, 'Vice-Chairperson'),
(11, 'HOD'),
(13, 'new'),
(14, 'new2'),
(17, 'fghfghj');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbcandidates`
--
ALTER TABLE `tbcandidates`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`fk_member_id`) REFERENCES `tbmembers` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
