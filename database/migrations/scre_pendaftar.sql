-- phpMyAdmin SQL Dump
-- Table structure for table `scre_pendaftar`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `scre_pendaftar`
--

DROP TABLE IF EXISTS `scre_pendaftar`;
CREATE TABLE `scre_pendaftar` (
  `id` varchar(15) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ktp` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_exist` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `scre_pendaftar`
--
ALTER TABLE `scre_pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

COMMIT;
