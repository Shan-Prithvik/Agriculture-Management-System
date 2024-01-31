-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2023 at 04:49 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `is_deleted` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `description`, `is_deleted`) VALUES
(1, 'Extension Services', 'Farmers receive hands-on advice and information on the latest agricultural practices, ensuring they stay updated and implement efficient farming techniques.', 0),
(2, 'Access to Seeds and Fertilizers', 'Farmers gain access to high-quality seeds and fertilizers, crucial for healthy crop growth and increased yield.', 0),
(3, 'Financial Support and Subsidies', 'Providing financial assistance, subsidies, and support programs to alleviate financial burdens and aid in investment for farm enhancements.', 0),
(4, 'Soil Testing and Analysis', 'Analyzing soil quality helps farmers understand its nutrients and conditions, aiding in better crop selection and management.', 0),
(5, 'Crop Insurance', 'Crop insurance safeguards farmers against potential losses due to unpredictable factors like natural disasters or crop failures.', 0),
(6, 'Market Information', 'Access to market trends and pricing information helps farmers make informed decisions about crop sales and cultivation.', 0),
(7, 'Training Programs', 'Educational sessions and workshops enable farmers to develop skills, implement new technologies, and stay updated with the latest agricultural practices.', 0),
(8, 'Research and Development Support', 'Backing research and development initiatives encourages innovation in farming methods, enhancing productivity and sustainability.', 0),
(9, 'Water Management and Irrigation', 'Guidance on efficient water usage and irrigation methods ensures optimal crop growth while conserving water resources.', 0),
(10, 'Support for Organic Farming', 'Support and resources for adopting sustainable farming practices contribute to environmental conservation and healthier produce.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_approval`
--

DROP TABLE IF EXISTS `service_approval`;
CREATE TABLE IF NOT EXISTS `service_approval` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `service` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `is_approval` varchar(250) NOT NULL,
  `is_deleted` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `last_login`, `is_deleted`) VALUES
(1, 'Shan', 'Prithvik', 'shanprithvik@gmail.com', '9f0dbe297c6d62a50a83dd5200e127069fdeb477', 'Admin', '2023-12-17 11:25:06', 0),
(2, 'Officer', '', 'officer@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Officer', '2023-12-16 20:47:29', 0),
(3, 'Guest', '', 'user@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'User', '2023-12-16 23:01:42', 0),
(28, 'Shan', 'Prithvik', '1234@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'User', '2023-12-16 20:58:46', 1),
(29, 'Shan', 'Prithvik', 'abcd@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'User', '2023-12-16 21:28:19', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
