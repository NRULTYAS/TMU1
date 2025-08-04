-- phpMyAdmin SQL Dump
-- Table structure for table `scre_pendaftaran`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `scre_pendaftaran`
--

DROP TABLE IF EXISTS `scre_pendaftaran`;
CREATE TABLE `scre_pendaftaran` (
  `id` varchar(15) NOT NULL,
  `pendaftar_id` varchar(15) NOT NULL,
  `diklat_id` varchar(15) NOT NULL,
  `diklat_tahun_id` varchar(15) NOT NULL,
  `jadwal_id` varchar(15) NOT NULL,
  `gelombang` int(2) NOT NULL,
  `periode` varchar(15) NOT NULL,
  `status_pendaftaran` enum('pending','approved','rejected','completed') NOT NULL DEFAULT 'pending',
  `tanggal_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` text,
  `is_bayar` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `is_exist` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `scre_pendaftaran`
--
ALTER TABLE `scre_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftar_id` (`pendaftar_id`),
  ADD KEY `diklat_id` (`diklat_id`),
  ADD KEY `jadwal_id` (`jadwal_id`);

COMMIT;
