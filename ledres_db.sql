-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2023 at 05:32 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ledres_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_me`
--

DROP TABLE IF EXISTS `about_me`;
CREATE TABLE IF NOT EXISTS `about_me` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `about_me`
--

INSERT INTO `about_me` (`id`, `title`, `description`) VALUES
(1, 'Web Developer, Singer, Dancer and Musician', 'As an IT Student, I am passionate about creating websites and have been working in this field for 4 years. My journey in this field began with my older sister teaching me about creating websites and introduced me to different programming languages. Over the years, I have had the privilege of working with a diverse range of clients and projects, allowing me to develop a broad skill set and deep expertise in basic programming and editing. I have honed my skills in creating basic website pages and am always eager to learn and grow. Currently, I am studying various programming language, which has given me the opportunity to create databases, websites and many more.<br></br>\r\n\r\nOutside of my work, I have a variety of hobbies and interests that fuel my creativity and drive to excel. In my free time, I love watching Anime, read light novels, cosplaying, and sleep, which has given me a unique perspective and approach to my work. I believe that these hobbies expands my knowledge about several stuffs and gave me confidence and encourage to deepen my knowlege about the world. Additionally, I can play instruments, sing and dance, which have proven to be valuable assets in my work and personal life.<br></br>');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `acc_type`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

DROP TABLE IF EXISTS `contact_submissions`;
CREATE TABLE IF NOT EXISTS `contact_submissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `message`) VALUES
(2, 'Heeseung', 'hee@gmail.com', 'contact testing'),
(4, 'hermione ledres', 'mion@gmail.com', 'another test subject'),
(5, 'Angelo Ledres', 'angelo@gmail.com', 'message test');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acc_type` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `acc_type`) VALUES
(1, 'user', 'user', 'user'),
(2, 'user1', 'user1', 'user'),
(3, 'cholo', 'cholo', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
