-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2025 at 04:21 AM
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
-- Table structure for table `scre_persyaratan`
--

DROP TABLE IF EXISTS `scre_persyaratan`;
CREATE TABLE `scre_persyaratan` (
  `id` varchar(15) NOT NULL,
  `persyaratan` text NOT NULL,
  `jenis_persyaratan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scre_persyaratan`
--

INSERT INTO `scre_persyaratan` (`id`, `persyaratan`, `jenis_persyaratan`) VALUES
('10-69498-92', 'File Scan PDF Nomor Pokok Wajib Pajak (NPWP)', 0),
('10-90654-58', 'File Scan PDF Rating Able Engine', 0),
('12-27060-95', 'File Scan PDF Sertifikat BST-KLM', 0),
('13-32679-83', 'File Scan Piagam Penghargaan Akademik / Non Akademik (Tingkat Provinsi)', 0),
('13-40452-30', 'File Scan PDF ALGT', 0),
('13-51511-54', 'File Scan PDF Sertifikat BOCT', 0),
('15-51390-76', 'File Scan PDF Sertifikat SAT/SSO/SDSD', 0),
('15-88486-35', 'File Scan PDF Ijazah ATT-IV', 0),
('16-39416-57', 'File Scan PDF Sertifikat ERM', 0),
('16-46655-82', 'File Scan PDF Surat Masa Layar di Kapal Tanker Minyak (Oil Tanker) Minimal 3 bulan', 0),
('19-69314-66', 'File Scan PDF SPPK GMDSS', 0),
('22-40316-64', 'File Scan PDF Sertifikat ARPA', 0),
('25-51218-16', 'File Scan PDF AKTE KELAHIRAN', 0),
('28-51369-55', 'File Scan PDF Sertifikat SCRB', 0),
('29-51411-67', 'File Scan PDF Sertifikat GMDSS', 0),
('29-62967-74', 'File Scan PDF Endorsement yang akan diperpanjang', 0),
('30-48660-57', 'File Scan PDF Surat Keterangan Lulus (yang masih kelas XII)', 0),
('30-89939-66', 'File Scan PDF Ijazah ANT-V', 0),
('31-51211-74', 'File Scan PDF SKCK', 0),
('33-51239-56', 'File Scan PDF Sertifikat Kesehatan Poliklinik Poltekpel Banten (Upload Saat Sudah Selesai Cek Kesehatan)', 1),
('33-51383-47', 'File Scan PDF Sertifikat AFF', 0),
('35-54281-73', 'File Scan PDF Minimal Ijazah ANT/ATT-V', 0),
('36-47071-74', 'Usia minimal 16 Tahun', 0),
('36-51353-60', 'File Scan Pas Foto Warna (Latar Belakang Merah untuk Teknika) jpeg', 0),
('38-51489-76', 'File Scan PDF Sertifikat AS', 0),
('39-88510-20', 'File Scan PDF Ijazah ANT-IV', 0),
('40-46518-66', 'File Scan PDF Surat Masa Layar di Kapal Chemical Tanker minimal 3 Bulan', 0),
('40-96211-59', 'File Scan PDF Surat Mutasi ON & OFF Asli dari Perusahaan', 0),
('41-39552-57', 'File Scan PDF Sertifikat CMT', 0),
('43-48185-28', 'File Scan PDF Raport Semester I sd V (khusus yang menggunakan paket C - IPA)', 0),
('43-51532-52', 'File Scan PDF Rekomendasi dari DJPL', 0),
('44-94991-75', 'File Scan PDF Ijazah ANT-III', 0),
('46-39564-36', 'File Scan PDF Sertifikat CMHBT', 0),
('47-38373-61', 'File Scan PDF Sertifikat SSO', 0),
('49-22954-85', 'File Scan PDF Sertifikat Kesehatan Pelaut Logo Garuda atau APPROVED DJPL', 1),
('49-38358-51', 'File Scan PDF Sertifikat SAT', 0),
('51-60025-67', 'File Scan PDF Sertifikat Ahli Nautika Tingkat - IV', 0),
('53-61758-82', 'Sertifikat Kompetensi Kepelautan Bidang Keahlian Nautika', 0),
('57-39351-87', 'File Scan PDF Sertifikat IMDG', 0),
('57-51340-51', 'File Scan PDF Pas Foto Warna (Mengunakan Jas dan Dasi Hitam)', 0),
('58-51735-79', 'File Scan PDF Hasil Evaluasi Masa Berlayar (SKHEPB)', 0),
('58-89954-54', 'File Scan PDF Ijazah ATT-V', 0),
('58-95948-87', 'File Scan PDF SPPK ', 0),
('59-93225-12', 'File Scan PDF Ijazah ANT-D', 0),
('61-51362-69', 'File Scan PDF Sertifikat BST', 0),
('62-93653-35', 'File Scan PDF Surat Masa Layar minimal 1 Tahun dari Syahbandar Utama ', 0),
('64-51205-60', 'File Scan PDF KTP', 0),
('65-95836-52', 'File Scan PDF Ijazah SLTP atau SLTA sederajat', 0),
('66-22768-43', 'File Scan PDF SPPK atau Ijazah Diploma-III', 0),
('68-31178-80', 'File Scan PDF Sertifikat ECDIS', 0),
('68-51519-97', 'File Scan PDF Surat Keterangan Lulus', 0),
('69-51538-80', 'File Scan PDF (CD) Dokumen', 0),
('70-48321-28', 'File Scan PDF Ijazah + Nilai Ijazah (Ijazah Pendidikan Terakhir)', 0),
('70-51525-74', 'File Scan PDF Transkip Nilai', 0),
('71-22849-34', 'File Scan PDF Surat Masa Layar Minimal 6 Bulan dari Syahbandar Utama', 0),
('72-40379-65', 'File Scan PDF Sertifikat AOT', 0),
('73-51549-72', 'File Scan PDF Surat Keterangan Pembelajaran Praktik dengan Transkip Nilai TRB', 0),
('74-51331-24', 'File Scan PDF Ijazah Laut Nautika Kel V', 0),
('74-51347-83', 'File Pas Foto Warna (Latar Belakang Biru untuk Nautika) jpeg', 0),
('76-96134-32', 'File Scan PDF Surat Pernyataan Calon Siswa Diklat (Unduh di Menu Awal Pendaftaran Online)', 0),
('78-51403-88', 'File Scan PDF Sertifikat BRM', 0),
('80-40764-82', 'File Scan PDF Sertifikat ACT', 0),
('80-51231-67', 'File Scan PDF Buku Pelaut', 0),
('81-39247-48', 'File Scan PDF Sertifikat RADAR', 0),
('81-51504-97', 'File Scan PDF Sertifikat BLGTCO', 0),
('81-65581-24', 'File Scan PDF Sertifikat MFA', 0),
('83-39832-68', 'File Scan PDF Pas Foto Terbaru Warna', 0),
('83-51471-91', 'File Scan PDF Sertifikat MC', 0),
('83-51728-20', 'File Scan PDF Masa Berlayar', 0),
('83-95005-32', 'File Scan PDF Ijazah ATT-III', 0),
('85-39888-31', 'File Scan PDF Surat Keterangan Belum Menikah dari Kelurahan Setempat', 0),
('85-46585-48', 'File Scan PDF Surat Masa Layar di Kapal Tanker Gas minimal 3 bulan', 0),
('85-51262-63', 'File Scan PDF Ijazah SMP/MTS', 0),
('86-48345-81', 'SKHUN (bagi yang masih kelas XII)', 0),
('86-51255-34', 'File Scan PDF Ijazah Terakhir', 0),
('86-51477-63', 'File Scan PDF Sertifikat RS', 0),
('87-51496-63', 'File Scan PDF Sertifikat SDSD', 0),
('88-48493-38', 'File Scan PDF Kartu Keluarga', 0),
('89-43980-36', 'File Scan PDF Surat Pernyataan Sanggup Tidak Menikah  (Unduh di Menu Awal Pendaftaran Online)', 0),
('90-69422-23', 'File Pas Photo 4 x 6 Background Putih, Kemeja Putih, dan Berdasi', 0),
('91-51268-20', 'File Scan PDF Ijazah Laut Minimal Kelas V (ANT/ATT-V)', 0),
('91-95803-80', 'File Scan PDF Ijazah ATT-D', 0),
('92-51397-75', 'File Scan PDF Sertifikat ERM/BRM', 0),
('92-62758-28', 'File Scan PDF Ijazah (ANT/ATT) yang akan diperpanjang endorsementnya', 0),
('96-11162-13', 'File Scan Rating Forming Deck/ Engine', 0),
('97-90632-43', 'File Scan PDF Rating Able Deck', 0),
('98-51742-34', 'File Scan PDF SK Lulus UKP Pra Prala', 0),
('99-51376-22', 'File Scan PDF Sertifikat MEFA', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scre_persyaratan`
--
ALTER TABLE `scre_persyaratan`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
