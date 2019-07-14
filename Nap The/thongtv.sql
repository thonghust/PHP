-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2018 at 12:48 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thongtv`
--

-- --------------------------------------------------------

--
-- Table structure for table `danhba`
--

CREATE TABLE `danhba` (
  `id` int(20) NOT NULL,
  `ten` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `danhba`
--

INSERT INTO `danhba` (`id`, `ten`, `sdt`) VALUES
(28, 'thong', '0971130703'),
(29, 'donal trump', '0999999999');

-- --------------------------------------------------------

--
-- Table structure for table `hang`
--

CREATE TABLE `hang` (
  `id` int(20) NOT NULL,
  `tenhang` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `hang`
--

INSERT INTO `hang` (`id`, `tenhang`) VALUES
(8, 'viettel'),
(9, 'mobiphone'),
(10, 'vinaphone');

-- --------------------------------------------------------

--
-- Table structure for table `menhgia`
--

CREATE TABLE `menhgia` (
  `id` int(20) NOT NULL,
  `tien` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `menhgia`
--

INSERT INTO `menhgia` (`id`, `tien`) VALUES
(32, 10000),
(33, 20000),
(34, 50000),
(35, 200000),
(40, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(20) NOT NULL,
  `taikhoan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `matkhau` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `taikhoan`, `matkhau`) VALUES
(1, 'thonghust', '12345'),
(2, 'admin', '1'),
(3, 'hoa', 'hoalt');

-- --------------------------------------------------------

--
-- Table structure for table `thongtin`
--

CREATE TABLE `thongtin` (
  `id` int(20) NOT NULL,
  `sdt` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sotien` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `hang` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ma` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `thongtin`
--

INSERT INTO `thongtin` (`id`, `sdt`, `sotien`, `hang`, `ma`) VALUES
(7, '0971130703', '1140000', 'Vinaphone', '9507c'),
(10, '093xxxxxxx', '200000', 'Mobiphone', '3b292');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhba`
--
ALTER TABLE `danhba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hang`
--
ALTER TABLE `hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menhgia`
--
ALTER TABLE `menhgia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thongtin`
--
ALTER TABLE `thongtin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhba`
--
ALTER TABLE `danhba`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hang`
--
ALTER TABLE `hang`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menhgia`
--
ALTER TABLE `menhgia`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thongtin`
--
ALTER TABLE `thongtin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
