-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 05:10 PM
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
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `login_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`login_id`, `username`, `password`) VALUES
(5, 'admin', '$2y$10$kL.BU9BaguzigN3oA3yJ/..sJmQ9M2fgiEvGASjp7xtGD7YLRa5zW');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(2) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `tingkat_prioritas` int(2) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `tingkat_prioritas`, `bobot`) VALUES
(1, 'C1', 'Akreditas', 1, 0.456),
(2, 'C2', 'Biaya', 2, 0.256),
(3, 'C3', 'Sarpras', 3, 0.156),
(4, 'C4', 'Jarak', 4, 0.09),
(5, 'C5', 'Kuota SNBP', 5, 0.04);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `sekolah_id`, `kriteria_id`, `subkriteria_id`, `nilai`) VALUES
(5, 15, 1, 1, 0.611),
(6, 15, 2, 9, 0.111),
(7, 15, 3, 4, 0.611),
(9, 15, 5, 13, 0.611),
(10, 5, 1, 1, 0.611),
(11, 5, 2, 8, 0.277),
(12, 5, 3, 6, 0.111),
(13, 5, 5, 13, 0.611),
(14, 19, 1, 1, 0.611),
(15, 19, 2, 8, 0.277),
(16, 19, 3, 4, 0.611),
(17, 19, 5, 13, 0.611),
(18, 18, 1, 1, 0.611),
(19, 18, 2, 7, 0.611),
(20, 18, 3, 4, 0.611),
(21, 18, 5, 13, 0.611),
(22, 21, 1, 2, 0.277),
(23, 21, 2, 7, 0.611),
(24, 21, 3, 4, 0.611),
(25, 21, 5, 14, 0.277),
(26, 11, 1, 1, 0.611),
(27, 11, 2, 8, 0.277),
(28, 11, 3, 4, 0.611),
(29, 11, 5, 13, 0.611),
(30, 1, 1, 3, 0.111),
(31, 1, 2, 8, 0.277),
(32, 1, 3, 5, 0.277),
(33, 1, 5, 15, 0.111),
(34, 6, 1, 1, 0.611),
(35, 6, 2, 7, 0.611),
(36, 6, 3, 4, 0.611),
(37, 6, 5, 13, 0.611),
(38, 4, 1, 2, 0.277),
(39, 4, 2, 7, 0.611),
(40, 4, 3, 6, 0.111),
(41, 4, 5, 14, 0.277),
(42, 7, 1, 2, 0.277),
(43, 7, 2, 7, 0.611),
(44, 7, 3, 5, 0.277),
(45, 7, 5, 14, 0.277),
(46, 16, 1, 1, 0.611),
(47, 16, 2, 9, 0.111),
(48, 16, 3, 5, 0.277),
(49, 16, 5, 13, 0.611),
(50, 22, 1, 1, 0.611),
(51, 22, 2, 9, 0.111),
(52, 22, 3, 5, 0.277),
(53, 22, 5, 13, 0.611),
(54, 17, 1, 1, 0.611),
(55, 17, 2, 8, 0.277),
(56, 17, 3, 4, 0.611),
(57, 17, 5, 13, 0.611),
(58, 12, 1, 1, 0.611),
(59, 12, 2, 7, 0.611),
(60, 12, 3, 4, 0.611),
(61, 12, 5, 13, 0.611),
(62, 20, 1, 1, 0.611),
(63, 20, 2, 9, 0.111),
(64, 20, 3, 5, 0.277),
(65, 20, 5, 13, 0.611),
(66, 10, 1, 1, 0.611),
(67, 10, 2, 8, 0.277),
(68, 10, 3, 4, 0.611),
(69, 10, 5, 13, 0.611),
(70, 9, 1, 1, 0.611),
(71, 9, 2, 7, 0.611),
(72, 9, 3, 5, 0.277),
(73, 9, 5, 13, 0.611),
(74, 8, 1, 1, 0.611),
(75, 8, 2, 7, 0.611),
(76, 8, 3, 5, 0.277),
(77, 8, 5, 13, 0.611),
(78, 13, 1, 1, 0.611),
(79, 13, 2, 8, 0.277),
(80, 13, 3, 4, 0.611),
(81, 13, 5, 13, 0.611),
(82, 14, 1, 1, 0.611),
(83, 14, 2, 7, 0.611),
(84, 14, 3, 4, 0.611),
(85, 14, 5, 13, 0.611),
(86, 25, 1, 2, 0.277),
(87, 25, 2, 7, 0.611),
(88, 25, 3, 5, 0.277),
(89, 25, 5, 14, 0.277),
(90, 24, 1, 2, 0.277),
(91, 24, 2, 2, 0.277),
(92, 24, 3, 4, 0.611),
(93, 24, 5, 14, 0.277),
(94, 23, 1, 1, 0.611),
(95, 23, 2, 8, 0.277),
(96, 23, 3, 4, 0.611),
(97, 23, 5, 13, 0.611);

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `akreditas` varchar(10) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `sarpras` int(50) NOT NULL,
  `kuota_snbp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `akreditas`, `biaya`, `sarpras`, `kuota_snbp`, `alamat`, `latitude`, `longitude`) VALUES
(1, 'SMAS Katolik ST Ignatius', 'C', '762.000', 21, '5%', 'JL.BINJAI KM 8,5 PSR V GG. MAKMUR', 3.59624960, 98.61135360),
(4, 'SMAS NAHDATUL ULAMA', 'B', '130.000', 17, '25%', 'Jl. H. A. Manaf Lubis No.2, Tj. Gusta, Kec. Medan Helvetia, Kota Medan, Sumatera Utara', 3.60470010, 98.62688950),
(5, 'SMAS AN NIZAM', 'A', '600.000', 16, '40%', 'Jl. Perjuangan Jl. Tuba II No.62, Tegal Sari Mandala III, Kec. Medan Denai, Kota Medan, Sumatera Utara', 3.57714150, 98.71773030),
(6, 'SMAS KATOLIK TRI SAKTI', 'A', '410.000', 41, '40%', 'Jl. Raya Menteng Gg. Benteng No.21, Binjai, Kec. Medan Denai, Kota Medan, Sumatera Utara', 3.56651120, 98.71970310),
(7, 'SMAS PGRI 12 MEDAN', 'B', '140.000', 20, '25%', 'Jl. Kapten Rahmad Buddin, Rengas Pulau, Kec. Medan Marelan, Kota Medan, Sumatera Utara', 3.70863460, 98.65309100),
(8, 'SMA Swasta Plus Taruna Akterlis Medan', 'A', '550.000', 25, '40%', 'Jl. Karya Tani No.1, Pangkalan Masyhur, Kec. Medan Johor, Kota Medan, Sumatera Utara', 3.53850360, 98.66456540),
(9, 'SMAS ST PETRUS MEDAN', 'A', '400.000', 29, '40%', 'Jl. Luku I No.1, Kwala Bekala, Kec. Medan Johor, Kota Medan, Sumatera Utara', 3.54166040, 98.65787570),
(10, 'SMAS ST. IGNASIUS MEDAN', 'A', '762.000', 34, '40%', 'Jl. Karya Wisata, Gedung Johor, Kec. Medan Johor, Kota Medan, Sumatera Utara', 3.52774680, 98.66201670),
(11, 'SMAS KATOLIK BUDI MURNI 2', 'A', '600.000', 38, '40%', 'Jl. Kapiten Purba Jl. Kapitan Purba II No.18, Mangga, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara', 3.52436020, 98.63532570),
(12, 'SMAS SANTO YOSEPH MEDAN', 'A', '310.000', 34, '40%', 'Jl. Flamboyan Raya No.139, Tj. Selamat, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara', 3.53948470, 98.60454700),
(13, 'SMAS WR SUPRATMAN 1', 'A', '720.000', 36, '40%', 'Jl. Asia No.143, Sei Rengas I, Kec. Medan Kota, Kota Medan, Sumatera Utara', 3.58463880, 98.69035890),
(14, 'SMAS YPK MEDAN', 'A', '330.000', 34, '40%', 'Jl. Sakti Lubis Gg Amal. 25, Jl. Sakti Lubis Gg. Pegawai No.8, Kota Medan, Sumatera Utara', 3.55430420, 98.69430160),
(15, 'SMAS AL FITYAN', 'A', '1.323.000', 32, '40%', 'Jl. Keluarga, Asam Kumbang, Kec. Medan Selayang, Kota Medan, Sumatera Utara', 3.55233480, 98.61530020),
(16, 'SMAS PRIMEONE SCHOOL', 'A', '4.000.000', 29, '40%', 'Jl. Jenderal Besar A.H. Nasution No.88A, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara', 3.53876980, 98.69429840),
(17, 'SMAS SANTO THOMAS 2 MEDAN', 'A', '850.000', 54, '40%', 'Jl. S. Parman No.107, Petisah Hulu, Kec. Medan Baru, Kota Medan, Sumatera Utara', 3.58930510, 98.66860070),
(18, 'SMAS DHARMAWANGSA', 'A', '450.000', 73, '40%', 'Jl. KL. Yos Sudarso No.224, Glugur Kota, Kec. Medan Bar., Kota Medan, Sumatera Utara', 3.61351420, 98.67296940),
(19, 'SMAS CAHAYA MEDAN', 'A', '805.000', 42, '40%', 'Jl. Hayam Wuruk No.11, Petisah Hulu, Kec. Medan Baru, Kota Medan, Sumatera Utara', 3.58107570, 98.66556160),
(20, 'SMAS SPK SAMPOERNA ACADEMY', 'A', '8.000.000', 19, '40%', 'Jl. Jamin Ginting, Titi Rantai, Kec. Medan Baru, Kota Medan, Sumatera Utara', 3.54816360, 98.65538960),
(21, 'SMAS GKPI PADANG BULAN', 'B', '200.000', 33, '25%', 'Jl. Jamin Ginting No.21, Padang Bulan, Kec. Medan Baru, Kota Medan, Sumatera Utara', 3.56044300, 98.66290800),
(22, 'SMAS SANTO NICHOLAS', 'A', '3.200.000', 22, '40%', 'Jl. Mojopahit No.117, Petisah Hulu, Kec. Medan Baru, Kota Medan, Sumatera Utara', 3.58021360, 98.66638620),
(23, 'SMAS BUDI AGUNG', 'A', '750.000', 60, '40%', 'Jl. Platina Raya No.7, Rengas Pulau, Kec. Medan Marelan, Kota Medan', 3.68947100, 98.65802230),
(24, 'SMAS TAMAN SISWA SINGOSARI', 'B', '520.000', 37, '25%', 'Jl. Singosari No.11, Sei Rengas Permata, Kec. Medan Area, Kota Medan', 3.58406500, 98.69483060),
(25, 'SMAS TRI MURNI', 'B', '420.000', 23, '25%', 'Jl. KL. Yos Sudarso Gg. Famili No.KM.6 5, Tj. Mulia, Kec. Medan Deli, Kota Medan', 3.63798520, 98.66753130);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `nama_subkriteria` varchar(255) NOT NULL,
  `tingkat_prioritas` int(5) NOT NULL,
  `bobot_subkriteria` float NOT NULL,
  `kriteria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_subkriteria`, `nama_subkriteria`, `tingkat_prioritas`, `bobot_subkriteria`, `kriteria_id`) VALUES
(1, 'A', 1, 0.611, 1),
(2, 'B', 2, 0.277, 1),
(3, 'C', 3, 0.111, 1),
(4, 'Sangat Lengkap', 1, 0.611, 3),
(5, 'Lengkap', 2, 0.277, 3),
(6, 'Kurang Lengkap ', 3, 0.111, 3),
(7, '0 - 599.999', 1, 0.611, 2),
(8, '600.000 - 1.000.000', 2, 0.277, 2),
(9, '> 1.000.000', 3, 0.111, 2),
(10, 'Dekat', 1, 0.611, 4),
(11, 'Sedang', 2, 0.277, 4),
(12, 'Jauh', 3, 0.111, 4),
(13, '40%', 1, 0.611, 5),
(14, '25%', 2, 0.277, 5),
(15, '5%', 3, 0.111, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `sekolah_id` (`sekolah_id`),
  ADD KEY `subkriteria_id` (`subkriteria_id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`sekolah_id`) REFERENCES `sekolah` (`id_sekolah`),
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`subkriteria_id`) REFERENCES `sub_kriteria` (`id_subkriteria`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
