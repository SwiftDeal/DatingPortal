-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2015 at 08:28 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arif_shadi_bihar`
--

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE IF NOT EXISTS `userprofiles` (
  `user_id` text,
  `self_summary` text,
  `favourites` text,
  `ncompromise` text,
  `family_members` text,
  `ftype` text,
  `status` text,
  `smoke` text,
  `drink` text,
  `language` text,
  `height` text,
  `weight` text,
  `rashi` text,
  `profession` text,
  `qualification` text,
  `job_status` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `live` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `live` (`live`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `caste` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `live` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `age` (`age`),
  KEY `religion` (`religion`),
  KEY `caste` (`caste`),
  KEY `password` (`password`),
  KEY `live` (`live`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `mobile`, `age`, `religion`, `caste`, `password`, `admin`, `live`, `deleted`, `created`, `modified`) VALUES
(1, 'Meraj Ahmad Siddiqui', 'Male', 'msiddiqui.jmi@gmail.com', '8010805005', '21', 'Muslim', 'Shaikh', 'db47536c010daaae968fb18058b8473fbbbe0fce', 0, 1, 0, '2015-09-06 10:59:14', '2015-09-06 10:59:14'),
(2, 'Admin', 'Male', 'info@biharshadi.com', '99999', '20', 'Muslim', '', 'e2492e93ded9a846017dbfe6bc668be17a7c221b', 1, 1, 0, '2015-09-10 12:09:12', '2015-09-10 12:09:12'),
(3, 'Arif Ashfaque', 'Male', 'arif_usi@yahoo.com', '8826790104', '28', 'Muslim', 'Siddiqui', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 1, 0, '2015-09-11 06:07:28', '2015-09-11 06:07:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
