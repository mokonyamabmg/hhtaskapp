-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2018 at 04:39 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taskmanagementtool_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `dueDate` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `lastUpdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `dueDate`, `status`, `created`, `lastUpdated`) VALUES
(1, 'php project', '2018-03-14', 'Cancelled', '2018-03-13 18:40:52', '2018-03-13 19:17:19'),
(2, 'vaal triangle project', '2018-03-29', 'Opened', '2018-03-13 19:17:04', '2018-03-13 19:17:04'),
(3, 'funeral project', '2018-03-27', 'Finished', '2018-03-13 19:18:02', '2018-03-13 19:36:01'),
(4, 'test on tuesday', '2018-03-31', 'Closed', '2018-03-13 19:38:38', '2018-03-13 19:38:42'),
(5, 'vacation', '2018-04-10', 'Opened', '2018-03-13 19:41:46', '2018-03-13 19:41:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
