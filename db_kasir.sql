-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 11:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `p_item`
--

CREATE TABLE `p_item` (
  `item_id` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `kodebarang` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(10) NOT NULL DEFAULT 0,
  `dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`item_id`, `barcode`, `kodebarang`, `nama`, `kategori_id`, `unit_id`, `harga`, `stok`, `dibuat`, `updated`) VALUES
(27, NULL, 'A0001', 'Plastik 10x19', 18, 12, 10000, 87, '2022-07-14 20:59:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_kategori`
--

CREATE TABLE `p_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_kategori`
--

INSERT INTO `p_kategori` (`kategori_id`, `nama`, `dibuat`, `updated`) VALUES
(18, 'Plastik', '2022-07-14 20:57:48', NULL),
(19, 'Mika', '2022-07-14 20:58:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_unit`
--

CREATE TABLE `p_unit` (
  `unit_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_unit`
--

INSERT INTO `p_unit` (`unit_id`, `nama`, `dibuat`, `updated`) VALUES
(12, 'Plastik Medium', '2022-07-14 20:58:24', NULL),
(13, 'Mika Kecil', '2022-07-14 20:58:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suplayer`
--

CREATE TABLE `suplayer` (
  `suplayer_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suplayer`
--

INSERT INTO `suplayer` (`suplayer_id`, `nama`, `phone`, `alamat`, `keterangan`, `created`, `updated`) VALUES
(13, 'Riani', '081234567867', 'Solo', 'Pemasok', '2022-07-14 21:00:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_detailpenjualan`
--

CREATE TABLE `t_detailpenjualan` (
  `detail_id` int(11) NOT NULL,
  `jual_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `potongan_item` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_detailpenjualan`
--

INSERT INTO `t_detailpenjualan` (`detail_id`, `jual_id`, `item_id`, `harga`, `jumlah`, `potongan_item`, `total`) VALUES
(24, 21, 27, 10000, 5, 0, 50000),
(25, 22, 27, 10000, 5, 0, 50000);

--
-- Triggers `t_detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `jual_stok` AFTER INSERT ON `t_detailpenjualan` FOR EACH ROW BEGIN
    UPDATE p_item SET stok = stok -NEW.jumlah
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_jual`
--

CREATE TABLE `t_jual` (
  `jual_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_bar` int(10) NOT NULL,
  `potongan_item` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `final_harga` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `invoice`, `total_harga`, `diskon`, `final_harga`, `pembayaran`, `kembalian`, `catatan`, `tanggal`, `user_id`, `created`) VALUES
(21, 'AJ2207140001', 50000, 2000, 48000, 30000, -18000, '', '2022-07-14', 15, '2022-07-14 21:06:14'),
(22, 'AJ2207140002', 50000, 1500, 48500, 100000, 51500, '', '2022-07-14', 15, '2022-07-14 21:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tipe` enum('in','out') NOT NULL,
  `ditail` varchar(200) NOT NULL,
  `suplayer_id` int(11) DEFAULT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `item_id`, `tipe`, `ditail`, `suplayer_id`, `jumlah`, `tanggal`, `dibuat`, `user_id`) VALUES
(35, 27, 'in', 'Plastik', 13, 100, '2022-07-14', '2022-07-14 21:04:24', 15),
(36, 27, 'out', 'Plastik', NULL, 3, '2022-07-14', '2022-07-14 21:13:34', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin, 2:Kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `level`) VALUES
(15, 'admin1', '$2y$10$/QV7kyh8RYkdl/cw881xdOqQprBLizHCH', 'admin1', 1),
(16, 'kasir1', '$2y$10$cXa9ZgM01t2Yr.GaIScUNOuCa4fvWRtI1', 'kasir1', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `kodebarang` (`kodebarang`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `p_kategori`
--
ALTER TABLE `p_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `p_unit`
--
ALTER TABLE `p_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `suplayer`
--
ALTER TABLE `suplayer`
  ADD PRIMARY KEY (`suplayer_id`);

--
-- Indexes for table `t_detailpenjualan`
--
ALTER TABLE `t_detailpenjualan`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `t_jual`
--
ALTER TABLE `t_jual`
  ADD PRIMARY KEY (`jual_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `suplayer_id` (`suplayer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `p_kategori`
--
ALTER TABLE `p_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suplayer`
--
ALTER TABLE `suplayer`
  MODIFY `suplayer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_detailpenjualan`
--
ALTER TABLE `t_detailpenjualan`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `p_kategori` (`kategori_id`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `p_unit` (`unit_id`);

--
-- Constraints for table `t_detailpenjualan`
--
ALTER TABLE `t_detailpenjualan`
  ADD CONSTRAINT `t_detailpenjualan_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`);

--
-- Constraints for table `t_jual`
--
ALTER TABLE `t_jual`
  ADD CONSTRAINT `t_jual_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_jual_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_stok_ibfk_2` FOREIGN KEY (`suplayer_id`) REFERENCES `suplayer` (`suplayer_id`),
  ADD CONSTRAINT `t_stok_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
