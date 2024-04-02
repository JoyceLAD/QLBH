-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 08:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `a`
--

CREATE TABLE `a` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a`
--

INSERT INTO `a` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `congty`
--

CREATE TABLE `congty` (
  `id_cty` int(11) NOT NULL,
  `id_giamdoc` int(11) NOT NULL,
  `id_admincty` int(11) NOT NULL,
  `ten_congty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `congty`
--

INSERT INTO `congty` (`id_cty`, `id_giamdoc`, `id_admincty`, `ten_congty`) VALUES
(2, 20, 1, 'Cong ty so 1'),
(3, 25, 24, 'Cong ty so 2'),
(13, 22, 21, 'Cong ty so 10');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id_donhang` int(11) NOT NULL,
  `id_kh` int(11) NOT NULL,
  `id_cty` int(11) NOT NULL,
  `ten_donhang` varchar(100) NOT NULL,
  `ngay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_donhang`, `id_kh`, `id_cty`, `ten_donhang`, `ngay`) VALUES
(7, 21, 12, 'Dưa gang', '2024-03-26'),
(27, 26, 2, 'Lê', '2024-03-05'),
(30, 31, 2, 'Mận', '2024-02-28'),
(31, 31, 2, 'Bưởi', '2024-03-06'),
(33, 32, 2, 'Lê', '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id_kh` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `tuoi` int(11) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `gioi_tinh` varchar(100) NOT NULL,
  `cong_ty` varchar(100) NOT NULL,
  `nghe_nghiep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id_kh`, `ten`, `tuoi`, `dia_chi`, `gioi_tinh`, `cong_ty`, `nghe_nghiep`) VALUES
(21, 'updatetest1', 2, '1', '', '1', '1'),
(26, 'Lê Anh Duy 10', 23, '2', '', '2', '2'),
(30, 'Lê Anh Duy 10', 22, '1', '', '1', '1'),
(31, 'Lê Anh Duy 14', 23, '2', '', '2', '2'),
(32, 'Lê Anh Duy 17', 22, '1', '', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `phanquyen`
--

CREATE TABLE `phanquyen` (
  `id_pq` int(11) NOT NULL,
  `id_tk` int(11) NOT NULL,
  `id_cty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phanquyen`
--

INSERT INTO `phanquyen` (`id_pq`, `id_tk`, `id_cty`) VALUES
(1, 1, 2),
(8, 22, 2),
(9, 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_tk` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id_tk`, `username`, `password`, `ten`) VALUES
(1, 'test123456789', '827ccb0eea8a706c4c34a16891f84e7b', 'test451'),
(3, 'test1', '202cb962ac59075b964b07152d234b70', 'test1'),
(7, 'test4', '202cb962ac59075b964b07152d234b70', 'test4'),
(10, 'test10', 'c1a8e059bfd1e911cf10b626340c9a54', 'Lê Anh Duy 10'),
(12, 'test11', 'f696282aa4cd4f614aa995190cf442fe', 'Lê Anh Duy 11'),
(15, 'test12', '60474c9c10d7142b7508ce7a50acf414', 'Lê Anh Duy 12'),
(19, 'test14', 'b99c94f62fb2a61433c4e44e27406050', 'Lê Anh Duy 14'),
(20, 'test15', '4b377d23309d4ed39c9da5791417aeff', 'Lê Anh Duy 15'),
(21, 'test16', '0c1ccf98666ed505310c0471529429db', 'Lê Anh Duy 16'),
(22, 'test17', 'fcb1a7bbe091b4ee78748946cb762a84', 'Lê Anh Duy 17'),
(24, 'test22', '202cb962ac59075b964b07152d234b70', 'test22'),
(25, 'test100', '827ccb0eea8a706c4c34a16891f84e7b', 'test100'),
(28, 'test201', '202cb962ac59075b964b07152d234b70', 'test201');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a`
--
ALTER TABLE `a`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `congty`
--
ALTER TABLE `congty`
  ADD PRIMARY KEY (`id_cty`),
  ADD UNIQUE KEY `ten_congty` (`ten_congty`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`),
  ADD KEY `id_kh` (`id_kh`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_kh`);

--
-- Indexes for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`id_pq`),
  ADD UNIQUE KEY `id_tk` (`id_tk`),
  ADD KEY `id_cty` (`id_cty`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_tk`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a`
--
ALTER TABLE `a`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `congty`
--
ALTER TABLE `congty`
  MODIFY `id_cty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_kh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `id_pq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id_tk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`id_kh`) REFERENCES `khachhang` (`id_kh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD CONSTRAINT `phanquyen_ibfk_1` FOREIGN KEY (`id_tk`) REFERENCES `taikhoan` (`id_tk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phanquyen_ibfk_2` FOREIGN KEY (`id_cty`) REFERENCES `congty` (`id_cty`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
