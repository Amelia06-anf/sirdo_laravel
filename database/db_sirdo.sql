-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2026 at 05:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sirdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `no_registrasi` varchar(30) NOT NULL,
  `cif` varchar(30) NOT NULL,
  `nama_debitur` varchar(100) NOT NULL,
  `nomor_rekening` varchar(30) DEFAULT NULL,
  `nama_pengambil` varchar(100) DEFAULT NULL,
  `unit_pengambil` varchar(100) DEFAULT NULL,
  `jaminan` enum('Ya','Tidak') DEFAULT NULL,
  `keterangan_jaminan` text DEFAULT NULL,
  `ruangan` varchar(10) DEFAULT NULL,
  `lemari` varchar(10) DEFAULT NULL,
  `rak` varchar(10) DEFAULT NULL,
  `baris` varchar(10) DEFAULT NULL,
  `status_terakhir` enum('Masuk','Keluar') DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `no_registrasi`, `cif`, `nama_debitur`, `nomor_rekening`, `nama_pengambil`, `unit_pengambil`, `jaminan`, `keterangan_jaminan`, `ruangan`, `lemari`, `rak`, `baris`, `status_terakhir`, `id_petugas`) VALUES
(7, 'REG-26-0001', 'TFW9885', 'Tarkim / Juniah', NULL, NULL, NULL, NULL, NULL, 'I', 'D', '2', '54', 'Masuk', 1),
(8, 'REG-26-0002', 'DBGH8714', 'DEWI SUGIARTI', NULL, NULL, NULL, 'Ya', 'SHM AN DEWI SUGIARTI', 'I', 'A', '3', '58', 'Masuk', 1),
(9, 'REG-26-0003', 'SEHFQ94', 'SADURI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'J', '3', '6', 'Masuk', 1),
(10, 'REG-26-0004', 'SLBRM55', 'SAHROZI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'J', '1', '30', 'Masuk', 1),
(11, 'REG-26-0005', 'SFKAG59', 'SURYADI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'J', '4', '79', 'Masuk', 1),
(12, 'REG-26-0006', 'CO60680', 'CARYADI', NULL, NULL, NULL, 'Ya', 'SHM AN MARSONO', 'I', 'E', '2', '42', 'Masuk', 1),
(13, 'REG-26-0007', 'RAGL659', 'RAHAYU', NULL, NULL, NULL, 'Ya', 'SHM AN RAHAYU', 'I', 'J', '1', '29', 'Masuk', 1),
(14, 'REG-26-0008', 'SAOOA79', 'SATINI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'C', '1', '38', 'Masuk', 1),
(15, 'REG-26-0009', 'SIPJ765', 'SRIIYATI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'B', '4', '27', 'Masuk', 1),
(16, 'REG-26-0010', 'JC94497', 'JABIDIN', NULL, NULL, NULL, 'Ya', 'SHM AN WARSINIH', 'I', 'E', '2', '27', 'Masuk', 1),
(17, 'REG-26-0011', 'BS83486', 'BENY PRASETYO', NULL, NULL, NULL, 'Ya', 'BPKB', 'I', 'A', '4', '1', 'Masuk', 1),
(18, 'REG-26-0012', 'EF83577', 'ENDANG MAHPUDIN', NULL, NULL, NULL, 'Ya', 'AJB', 'I', 'B', '4', '18', 'Masuk', 1),
(19, 'REG-26-0013', 'SEZID54', 'SUWITO', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'D', '4', '3', 'Masuk', 1),
(20, 'REG-26-0014', 'SZUH334', 'SAKTIYONO', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'F', '3', '20', 'Masuk', 1),
(21, 'REG-26-0015', 'KVB0882', 'KHOERUNISA', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '3', '14', 'Masuk', 1),
(22, 'REG-26-0016', 'AFTPK42', 'ABDUL ZAKARIA', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'I', '1', '25', 'Masuk', 1),
(23, 'REG-26-0017', 'CO14598', 'CARA BIN KAMAD', NULL, NULL, NULL, 'Ya', 'SPAGT AN CARA', 'I', 'D', '3', '40', 'Masuk', 1),
(24, 'REG-26-0018', 'C913167', 'CECEP ISWANTO', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '3', '52', 'Masuk', 1),
(25, 'REG-26-0019', 'SICUR60', 'SOPIAH', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '1', '9', 'Masuk', 1),
(26, 'REG-26-0020', 'EKQ3410', 'ESIH SANTIKA YANTI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'B', '2', '32', 'Masuk', 1),
(27, 'REG-26-0021', 'RDBL663', 'RISMAN FADILAH', NULL, 'ABDUL ROUF', 'MANTRI', 'Ya', NULL, 'I', 'G', '2', '7', 'Keluar', 1),
(28, 'REG-26-0022', 'KXF7459', 'KARTINI', NULL, 'REIHAN ADI NUGROHO', 'MANTRI', 'Ya', NULL, 'I', 'B', '4', '41', 'Keluar', 1),
(29, 'REG-26-0023', 'KAJX140', 'KATEM BT TAMA', NULL, 'REIHAN ADI NUGROHO', 'MANTRI', 'Tidak', NULL, 'I', 'J', '3', '18', 'Keluar', 1),
(30, 'REG-26-0024', 'TCB5597', 'IWAN SETIAWAN', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '4', '17', 'Masuk', 1),
(31, 'REG-26-0025', 'FU59999', 'FIRMNSYAH', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'J', '4', '45', 'Masuk', 1),
(32, 'REG-26-0026', 'TCB5597', 'ASEP SUMARNA', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '2', '33', 'Masuk', 1),
(33, 'REG-26-0027', 'MCZA907', 'MUHAMAD MAHMUDI', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'I', '3', '40', 'Masuk', 1),
(34, 'REG-26-0028', 'SEJAD19', 'SULAEMAN', NULL, NULL, NULL, 'Tidak', NULL, 'I', 'H', '2', '23', 'Masuk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`) VALUES
(1, 'admin', '$2y$10$5I.o4XE1k9ZkhtPBvdAsCOCh/lvX3WeW603lAqZTt//bonsgdRyxC', 'Staff Arsip');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_dokumen`
--

CREATE TABLE `riwayat_dokumen` (
  `id_riwayat` int(11) NOT NULL,
  `id_dokumen` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `status` enum('Masuk','Keluar') DEFAULT NULL,
  `tanggal_status` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_dokumen`
--

INSERT INTO `riwayat_dokumen` (`id_riwayat`, `id_dokumen`, `id_petugas`, `status`, `tanggal_status`, `keterangan`) VALUES
(11, 7, 1, 'Masuk', '2026-07-03 10:15:28', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh Dadan Aji Saputra (CS). LUPUS -  JAMINAN DIAMBIL 03/07/2026'),
(12, 8, 1, 'Masuk', '2026-07-07 14:27:47', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: SHM AN DEWI SUGIARTI'),
(13, 9, 1, 'Masuk', '2026-07-07 14:28:49', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(14, 10, 1, 'Masuk', '2026-07-07 14:29:34', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(15, 11, 1, 'Masuk', '2026-07-07 14:30:30', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(16, 12, 1, 'Masuk', '2026-07-07 14:31:34', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: SHM AN MARSONO'),
(17, 13, 1, 'Masuk', '2026-07-07 14:32:37', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: SHM AN RAHAYU'),
(18, 14, 1, 'Masuk', '2026-07-07 14:38:11', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). JAMINAN DIAMBIL TGL 30/06/2026'),
(19, 15, 1, 'Masuk', '2026-07-07 14:39:25', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(20, 16, 1, 'Masuk', '2026-07-07 14:40:17', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: SHM AN WARSINIH'),
(21, 17, 1, 'Masuk', '2026-07-07 14:48:31', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: BPKB. BERKAS BLM DI TTD PA BAMBANG'),
(22, 18, 1, 'Masuk', '2026-07-07 14:49:45', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: AJB. BERKAS BELUM DI TTD'),
(23, 19, 1, 'Masuk', '2026-07-07 14:50:47', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(24, 20, 1, 'Masuk', '2026-07-07 14:51:36', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(25, 21, 1, 'Masuk', '2026-07-07 14:52:25', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(26, 22, 1, 'Masuk', '2026-07-07 14:53:21', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(27, 23, 1, 'Masuk', '2026-07-07 14:54:30', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). Membawa jaminan: SPAGT AN CARA. BERKAS BELUM TTD'),
(28, 24, 1, 'Masuk', '2026-07-07 14:55:36', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(29, 25, 1, 'Masuk', '2026-07-07 14:56:19', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). BERKAS BELUM TTD'),
(30, 26, 1, 'Masuk', '2026-07-07 15:00:17', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS). LUPUS - JAMINAN DIAMBIL 07/07/2026'),
(31, 27, 1, 'Keluar', '2026-07-08 08:26:23', 'Diambil oleh ABDUL ROUF (MANTRI). Membawa jaminan'),
(32, 28, 1, 'Keluar', '2026-07-08 08:51:07', 'Diambil oleh REIHAN ADI NUGROHO (MANTRI). Membawa jaminan'),
(33, 29, 1, 'Keluar', '2026-07-08 08:52:27', 'Diambil oleh REIHAN ADI NUGROHO (MANTRI)'),
(34, 30, 1, 'Masuk', '2026-07-08 10:28:42', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(35, 31, 1, 'Masuk', '2026-07-08 10:29:36', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(36, 32, 1, 'Masuk', '2026-07-08 10:32:07', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(37, 33, 1, 'Masuk', '2026-07-08 10:34:11', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)'),
(38, 34, 1, 'Masuk', '2026-07-08 10:34:57', 'Dokumen lama pertama kali dicatat saat masuk. Dikembalikan oleh DADAN AJI SAPUTRA (CS)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `riwayat_dokumen`
--
ALTER TABLE `riwayat_dokumen`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_dokumen` (`id_dokumen`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_dokumen`
--
ALTER TABLE `riwayat_dokumen`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);

--
-- Constraints for table `riwayat_dokumen`
--
ALTER TABLE `riwayat_dokumen`
  ADD CONSTRAINT `riwayat_dokumen_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen` (`id_dokumen`),
  ADD CONSTRAINT `riwayat_dokumen_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
