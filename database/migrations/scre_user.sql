-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2025 at 01:50 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sc_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `scre_user`
--

DROP TABLE IF EXISTS `scre_user`;
CREATE TABLE `scre_user` (
  `id` varchar(15) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT 'A = Admin, OL = Operator Loket, OK = Operator Kesehatan, OP = Operator Pelatihan, OA = Operator Akademik'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scre_user`
--
ALTER TABLE `scre_user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
