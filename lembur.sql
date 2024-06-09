-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:53 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lembur`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bln` int(10) NOT NULL,
  `nama_bln` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bln`, `nama_bln`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `data_absen`
--

CREATE TABLE `data_absen` (
  `id_absen` int(10) NOT NULL,
  `id_form_lembur` int(10) NOT NULL,
  `absen_jam_masuk` datetime NOT NULL,
  `absen_jam_keluar` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_absen`
--

INSERT INTO `data_absen` (`id_absen`, `id_form_lembur`, `absen_jam_masuk`, `absen_jam_keluar`) VALUES
(1, 88, '0000-00-00 00:00:00', '03:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `form_lembur`
--

CREATE TABLE `form_lembur` (
  `id_form_lembur` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `keterangan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_lembur`
--

INSERT INTO `form_lembur` (`id_form_lembur`, `username`, `tanggal`, `jam_mulai`, `jam_selesai`, `keterangan`) VALUES
(33, 'Fahrurzaky01', '2021-07-22', '2021-11-17 12:23:25', '2021-11-18 04:24:52', 'gaming'),
(48, 'febi', '2021-09-13', '2021-11-17 12:24:23', '2021-11-17 20:25:09', 'AAA'),
(50, 'febi', '2021-09-14', '2021-11-17 12:24:30', '2021-11-17 12:25:15', 'AAA'),
(86, 'febi', '2021-09-01', '2021-11-17 12:24:35', '2021-11-17 12:25:20', 'sad'),
(87, 'febi', '2021-09-27', '2021-11-17 12:24:38', '2021-11-17 12:25:22', 'ddda'),
(88, 'Febi', '2021-12-01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hri` int(10) NOT NULL,
  `nama_hri` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hri`, `nama_hri`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jum\'at'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `id_kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `id_kategori`) VALUES
(1, 'cs ', 'I'),
(2, 'driver', 'I'),
(3, 'SMA', 'II'),
(4, 'D3', 'II'),
(5, 'S1', 'III'),
(6, 'S2', 'III'),
(7, 'S3', 'III');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama`) VALUES
('IF', 'informatika'),
('EL', 'elektro'),
('MB', 'manajemen bisnis'),
('MS', 'mesin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `tarif`) VALUES
('I', 13000),
('II', 17000),
('III', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role`) VALUES
(1, 'Kepala Unit'),
(2, 'Keuangan'),
(3, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tanggal`
--

CREATE TABLE `tanggal` (
  `id_tgl` int(10) NOT NULL,
  `nama_tgl` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanggal`
--

INSERT INTO `tanggal` (`id_tgl`, `nama_tgl`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04'),
(5, '05'),
(6, '06'),
(7, '07'),
(8, '08'),
(9, '09'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15'),
(16, '16'),
(17, '17'),
(18, '18'),
(19, '19'),
(20, '20'),
(21, '21'),
(22, '22'),
(23, '23'),
(24, '24'),
(25, '25'),
(26, '26'),
(27, '27');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(10) NOT NULL,
  `nama_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama_unit`) VALUES
(1, 'Tenaga Kependidikan'),
(2, 'Tenaga Kebersihan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `NIK` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `unit` int(30) NOT NULL,
  `jabatan` int(10) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `rekening` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role_id`, `is_active`, `NIK`, `nama`, `jurusan`, `unit`, `jabatan`, `telp`, `rekening`) VALUES
('Beatrice', '1234', 3, 1, '66666', 'Beatrice', 'IF', 1, 5, '8888', '9999'),
('Fahrurzaky01', 'Fahrurzaky01', 1, 1, '331190', 'Fahrurzaky', 'IF', 1, 7, '0896', '1038'),
('Febi', 'febi', 3, 1, '4444', 'Febi', 'IF', 1, 4, '555555', '5555555555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absen`
--
ALTER TABLE `data_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `form_lembur`
--
ALTER TABLE `form_lembur`
  ADD PRIMARY KEY (`id_form_lembur`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absen`
--
ALTER TABLE `data_absen`
  MODIFY `id_absen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_lembur`
--
ALTER TABLE `form_lembur`
  MODIFY `id_form_lembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
