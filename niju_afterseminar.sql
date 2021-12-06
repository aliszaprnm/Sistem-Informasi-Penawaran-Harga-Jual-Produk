-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 08:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niju`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jarak` decimal(10,1) NOT NULL COMMENT 'km',
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama_customer`, `alamat`, `jarak`, `telp`, `email`) VALUES
('CUST-001', 'PT Mitsubishi Krama Yudha Motors', 'Jalan Raya Bekasi No.22, RT.8/RW.5', '17.9', '(021) 4602908', 'mkm@mkm.com'),
('CUST-002', 'PT Setia Guna Selaras', 'Jalan Industri Selatan 2 Blok LL No. 2A', '25.3', '(021) 89836938', 'sgs@sgs.com'),
('CUST-003', 'PT Posmi Steel Indonesia', 'Kawasan Industri', '16.3', '(021)4302910', 'psi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `jenis_material` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tebal` decimal(5,2) NOT NULL,
  `lebar` int(11) NOT NULL,
  `panjang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `jenis_material`, `kode_customer`, `harga`, `tebal`, `lebar`, `panjang`) VALUES
(1, 'SPCC', 'CUST-001', 15000, '0.50', 50, 1219);

-- --------------------------------------------------------

--
-- Table structure for table `material_produk`
--

CREATE TABLE `material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `jenis_material` varchar(255) NOT NULL,
  `tebal_material` decimal(6,3) NOT NULL,
  `lebar_material` decimal(6,3) NOT NULL,
  `panjang_material` decimal(7,3) NOT NULL,
  `berat_material` decimal(6,3) NOT NULL,
  `jml_per_sheet` int(11) NOT NULL,
  `berat_produk` decimal(9,3) NOT NULL,
  `harga_material` int(11) NOT NULL,
  `harga_per_produk` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_produk`
--

INSERT INTO `material_produk` (`id`, `kode_produk`, `jenis_material`, `tebal_material`, `lebar_material`, `panjang_material`, `berat_material`, `jml_per_sheet`, `berat_produk`, `harga_material`, `harga_per_produk`) VALUES
(22, 'PROD-001', 'SPHC-PO', '1.600', '290.000', '1219.000', '1.988', 7, '0.284', 12000, '3408.00'),
(23, 'PROD-002', 'SPCC', '1.600', '85.000', '1219.000', '0.656', 41, '0.020', 15000, '300.00'),
(24, 'PROD-003', 'SPHC', '1.600', '285.000', '1219.000', '2.370', 10, '0.240', 10000, '2400.00'),
(26, 'PROD-004', 'SPCC', '1.600', '62.000', '1219.000', '0.660', 30, '0.020', 15000, '300.00'),
(27, 'PROD-005', 'SPHC-PO', '3.000', '34.000', '1219.000', '0.440', 44, '0.010', 12000, '120.00'),
(28, 'PROD-006', 'SPHC ', '6.000', '30.000', '1219.000', '0.800', 40, '0.020', 10000, '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `kode_mesin` varchar(20) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `kekuatan` decimal(5,2) DEFAULT NULL,
  `satuan` enum('Kg','Ton') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`kode_mesin`, `nama_mesin`, `kekuatan`, `satuan`) VALUES
('MSN-001', 'Portable Press', '25.00', 'Ton'),
('MSN-002', 'Portable Press', '35.00', 'Ton'),
('MSN-003', 'Medium Press', '110.00', 'Ton'),
('MSN-004', 'Medium Press', '160.00', 'Ton'),
('MSN-005', 'Medium Press', '200.00', 'Ton'),
('MSN-006', 'High Press', '250.00', 'Ton'),
('MSN-007', 'High Press', '315.00', 'Ton');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL,
  `request_id` bigint(20) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `from_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `request_id`, `type`, `message`, `from_user_id`, `to_user_id`, `date`, `status`) VALUES
(23, 16, 'Order', 'There is new order', 2, 3, '2021-08-09 19:14:33', 'read'),
(24, 12, 'Offer', 'There is new offering', 3, 2, '2021-08-09 19:37:02', 'read'),
(25, 13, 'Offer', 'There is new offering', 3, 2, '2021-08-09 19:40:01', 'read'),
(26, 12, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-10 14:24:09', 'read'),
(27, 14, 'Offer', 'There is new offering', 3, 2, '2021-08-11 08:18:37', 'read'),
(28, 12, 'Offer', 'There is new offering', 3, 2, '2021-08-11 15:02:48', 'read'),
(29, 12, 'Offer', 'There is new offering', 3, 3, '2021-08-11 15:02:59', 'read'),
(30, 13, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-12 16:12:42', 'read'),
(31, 13, 'Reject', 'There is new reject', 3, 2, '2021-08-13 02:05:40', 'read'),
(32, 12, 'Reject', 'There is new reject', 3, 3, '2021-08-13 12:32:09', 'read'),
(33, 17, 'Order', 'There is new order', 2, 3, '2021-08-13 13:37:12', 'read'),
(34, 15, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:02:15', 'read'),
(35, 16, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:02:25', 'read'),
(36, 17, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:02:36', 'read'),
(37, 18, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:02:45', 'read'),
(38, 19, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:02:56', 'read'),
(39, 15, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-13 14:12:47', 'read'),
(40, 16, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-13 14:13:37', 'read'),
(41, 17, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-13 14:13:47', 'read'),
(42, 15, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:21:57', 'read'),
(43, 15, 'Offer', 'There is new offering', 3, 3, '2021-08-13 14:24:37', 'read'),
(44, 16, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:27:43', 'read'),
(45, 17, 'Offer', 'There is new offering', 3, 2, '2021-08-13 14:31:50', 'read'),
(46, 18, 'Order', 'There is new order', 2, 3, '2021-08-14 09:28:31', 'read'),
(47, 20, 'Offer', 'There is new offering', 3, 2, '2021-08-14 09:32:36', 'read'),
(48, 20, 'Negotiate', 'There is new negotiating', 2, 3, '2021-08-14 09:33:19', 'read'),
(49, 20, 'Offer', 'There is new offering', 3, 2, '2021-08-14 09:34:38', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_harga`
--

CREATE TABLE `penawaran_harga` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `process_cost` int(11) NOT NULL,
  `tooling_cost` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `mod_by` int(11) DEFAULT NULL,
  `mod_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penawaran_harga`
--

INSERT INTO `penawaran_harga` (`id`, `pesanan_id`, `kode_customer`, `kode_produk`, `process_cost`, `tooling_cost`, `total`, `status`, `created_by`, `created_date`, `mod_by`, `mod_date`) VALUES
(15, 17, 'CUST-002', 'PROD-001', 6059, 119, 6146, 'Reject', 3, '2021-08-13 14:02:15', 2, '2021-08-13 14:32:07'),
(16, 17, 'CUST-002', 'PROD-002', 1428, 65, 1496, 'Deal', 3, '2021-08-13 14:02:25', 2, '2021-08-13 14:32:14'),
(17, 17, 'CUST-002', 'PROD-003', 3786, 73, 3867, 'Reject', 3, '2021-08-13 14:02:35', 2, '2021-08-13 14:34:09'),
(18, 17, 'CUST-002', 'PROD-004', 529, 42, 571, 'Deal', 3, '2021-08-13 14:02:45', 2, '2021-08-13 14:13:51'),
(19, 17, 'CUST-002', 'PROD-005', 724, 29, 753, 'Deal', 3, '2021-08-13 14:02:56', 2, '2021-08-13 14:13:58'),
(20, 18, 'CUST-003', 'PROD-006', 1081, 56, 1135, 'Deal', 3, '2021-08-14 09:32:36', 2, '2021-08-14 09:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `mod_by` int(11) NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `tanggal`, `kode_customer`, `status`, `created_by`, `created_date`, `mod_by`, `mod_date`) VALUES
(17, 'ORDER-00001', '2020-12-07', 'CUST-002', 'Selesai', 2, '2021-08-13 13:37:12', 2, '2021-08-13 14:34:09'),
(18, 'ORDER-00002', '2021-08-14', 'CUST-003', 'Selesai', 2, '2021-08-14 09:28:30', 2, '2021-08-14 09:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detil`
--

CREATE TABLE `pesanan_detil` (
  `id` bigint(20) NOT NULL,
  `pesanan_id` bigint(20) NOT NULL,
  `kode_produk` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detil`
--

INSERT INTO `pesanan_detil` (`id`, `pesanan_id`, `kode_produk`, `qty`, `keterangan`) VALUES
(21, 17, 'PROD-001', 3000, ''),
(22, 17, 'PROD-002', 4500, ''),
(23, 17, 'PROD-003', 5000, ''),
(24, 17, 'PROD-004', 5000, ''),
(25, 17, 'PROD-005', 5000, ''),
(26, 18, 'PROD-006', 3000, '');

-- --------------------------------------------------------

--
-- Table structure for table `process_cost`
--

CREATE TABLE `process_cost` (
  `id` int(11) NOT NULL,
  `pesanan_id` varchar(255) DEFAULT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `harga_material` int(11) NOT NULL,
  `harga_proses` int(11) NOT NULL,
  `harga_sub_material` int(11) NOT NULL,
  `harga_delivery` int(11) NOT NULL,
  `harga_packing` decimal(3,2) NOT NULL,
  `harga_qc` decimal(3,2) NOT NULL,
  `harga_mtc_dies` decimal(3,2) NOT NULL,
  `profit_dan_OH` decimal(3,2) NOT NULL COMMENT '25%',
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process_cost`
--

INSERT INTO `process_cost` (`id`, `pesanan_id`, `kode_produk`, `harga_material`, `harga_proses`, `harga_sub_material`, `harga_delivery`, `harga_packing`, `harga_qc`, `harga_mtc_dies`, `profit_dan_OH`, `total`) VALUES
(14, '17', 'PROD-001', 3408, 1065, 0, 45, '0.01', '0.01', '0.15', '0.25', 6059),
(15, '17', 'PROD-002', 300, 389, 338, 12, '0.02', '0.03', '0.05', '0.15', 1428),
(16, '17', 'PROD-003', 2400, 835, 158, 2, '0.03', '0.03', '0.10', '0.25', 3786),
(17, '17', 'PROD-004', 300, 85, 0, 5, '0.05', '0.05', '0.10', '0.16', 529),
(18, '17', 'PROD-005', 120, 165, 0, 15, '0.03', '0.03', '0.10', '0.20', 724),
(19, '18', 'PROD-006', 200, 310, 356, 5, '0.03', '0.05', '0.10', '0.25', 1081);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(20) NOT NULL,
  `kode_grup` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `cavity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `mod_by` int(11) NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `kode_grup`, `nama_produk`, `cavity`, `status`, `mod_by`, `mod_date`) VALUES
('PROD-001', 'SGS-48', 'Plate Seat Rear Hook', 0, 'Used', 1, '2021-08-09 17:32:36'),
('PROD-002', 'SGS-49', 'Bracket Fuel Tank Front', 0, 'Used', 1, '2021-08-09 18:37:53'),
('PROD-003', 'SGS-50', 'Rear Bracket Bottom', 0, 'Used', 1, '2021-08-09 18:50:12'),
('PROD-004', 'SGS-51', 'Gusset Plate', 0, 'Used', 1, '2021-08-13 13:16:52'),
('PROD-005', 'SGS-52', 'Lock Plate', 0, 'Used', 1, '2021-08-13 13:28:36'),
('PROD-006', 'PSI-26', 'Stopper Steering', 0, 'Used', 1, '2021-08-14 09:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `proses_produk`
--

CREATE TABLE `proses_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_proses` varchar(255) NOT NULL,
  `kode_mesin` varchar(255) NOT NULL,
  `std_dies_height` decimal(5,2) DEFAULT NULL,
  `harga_dies` int(11) DEFAULT NULL,
  `harga_proses` decimal(8,2) NOT NULL,
  `harga_per_produk` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses_produk`
--

INSERT INTO `proses_produk` (`id`, `kode_produk`, `nama_proses`, `kode_mesin`, `std_dies_height`, `harga_dies`, `harga_proses`, `harga_per_produk`) VALUES
(29, 'PROD-001', 'Blank', 'MSN-004', NULL, 30000000, '1.50', '240.00'),
(30, 'PROD-001', 'Drawing', 'MSN-002', NULL, 26000000, '1.50', '52.50'),
(31, 'PROD-001', 'Trimming', 'MSN-005', NULL, 34000000, '1.50', '300.00'),
(32, 'PROD-001', 'Flange', 'MSN-007', NULL, 39000000, '1.50', '472.50'),
(33, 'PROD-002', 'Blank', 'MSN-002', NULL, 35000000, '1.50', '52.50'),
(34, 'PROD-002', 'Forming', 'MSN-004', NULL, 43000000, '2.10', '336.00'),
(35, 'PROD-003', 'Blank', 'MSN-003', NULL, 21000000, '1.30', '143.00'),
(36, 'PROD-003', 'Forming', 'MSN-004', NULL, 27000000, '1.70', '272.00'),
(37, 'PROD-003', 'Piercing', 'MSN-005', NULL, 31000000, '2.10', '420.00'),
(39, 'PROD-004', 'Blank', 'MSN-001', NULL, 29000000, '1.30', '32.50'),
(40, 'PROD-004', 'Forming', 'MSN-002', NULL, 33000000, '1.50', '52.50'),
(41, 'PROD-005', 'Blank', 'MSN-003', NULL, 31000000, '1.50', '165.00'),
(42, 'PROD-006', 'Blank', 'MSN-004', NULL, 35000000, '1.50', '240.00'),
(43, 'PROD-006', 'Forming', 'MSN-002', NULL, 26000000, '2.00', '70.00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_material_produk`
--

CREATE TABLE `sub_material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `sub_material` varchar(255) NOT NULL,
  `pemakaian` decimal(6,3) NOT NULL,
  `harga_sub_material` int(11) NOT NULL,
  `harga_per_produk` decimal(8,2) NOT NULL COMMENT 'pemakaian*sub_material_produk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_material_produk`
--

INSERT INTO `sub_material_produk` (`id`, `kode_produk`, `sub_material`, `pemakaian`, `harga_sub_material`, `harga_per_produk`) VALUES
(17, 'PROD-002', 'Elpiji', '0.002', 169000, '338.00'),
(18, 'PROD-003', 'Alphasol', '0.001', 158000, '158.00'),
(20, 'PROD-006', 'Alphasol', '0.002', 178000, '356.00');

-- --------------------------------------------------------

--
-- Table structure for table `tooling_cost`
--

CREATE TABLE `tooling_cost` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `harga_dies` int(11) NOT NULL,
  `vol_prod` int(11) NOT NULL,
  `depresiasi_dies` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tooling_cost`
--

INSERT INTO `tooling_cost` (`id`, `pesanan_id`, `kode_produk`, `harga_dies`, `vol_prod`, `depresiasi_dies`, `total`) VALUES
(13, 17, 'PROD-001', 129000000, 45000, 24, 119),
(14, 17, 'PROD-002', 78000000, 50000, 24, 65),
(15, 17, 'PROD-003', 79000000, 45000, 24, 73),
(16, 17, 'PROD-004', 62000000, 62000, 24, 42),
(17, 17, 'PROD-005', 31000000, 45000, 24, 29),
(18, 18, 'PROD-006', 61000000, 45000, 24, 56);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` enum('Administrator','Marketing','Operational Manager') NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`, `email`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Amanda Cantika', 'Administrator', 'amanda@gmail.com'),
(2, 'marketing', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Eka Maulana', 'Marketing', 'eka_m@gmail.com'),
(3, 'op_man', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Soetarman', 'Operational Manager', 'soetarman@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_produk`
--
ALTER TABLE `material_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`kode_mesin`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penawaran_harga`
--
ALTER TABLE `penawaran_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_detil`
--
ALTER TABLE `pesanan_detil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_cost`
--
ALTER TABLE `process_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `proses_produk`
--
ALTER TABLE `proses_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_material_produk`
--
ALTER TABLE `sub_material_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tooling_cost`
--
ALTER TABLE `tooling_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `material_produk`
--
ALTER TABLE `material_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `penawaran_harga`
--
ALTER TABLE `penawaran_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pesanan_detil`
--
ALTER TABLE `pesanan_detil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `process_cost`
--
ALTER TABLE `process_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proses_produk`
--
ALTER TABLE `proses_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `sub_material_produk`
--
ALTER TABLE `sub_material_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tooling_cost`
--
ALTER TABLE `tooling_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
