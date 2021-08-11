-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2021 at 12:31 AM
-- Server version: 10.3.30-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denmaulc_niju`
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

-- --------------------------------------------------------

--
-- Table structure for table `material_produk`
--

CREATE TABLE `material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `jenis_material` varchar(255) NOT NULL,
  `tebal_material` decimal(5,2) NOT NULL,
  `lebar_material` decimal(5,2) NOT NULL,
  `panjang_material` decimal(5,2) NOT NULL,
  `berat_material` decimal(5,2) NOT NULL,
  `jml_per_sheet` int(11) NOT NULL,
  `berat_produk` decimal(8,2) NOT NULL,
  `harga_material` int(11) NOT NULL,
  `harga_per_produk` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `sub_material_produk`
--

CREATE TABLE `sub_material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `sub_material` varchar(255) NOT NULL,
  `pemakaian` decimal(5,2) NOT NULL,
  `harga_sub_material` int(11) NOT NULL,
  `harga_per_produk` decimal(8,2) NOT NULL COMMENT 'pemakaian*sub_material_produk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin Ngab', 'Administrator', 'sgs@sgs.com'),
(2, 'marketing', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Marketing Ngab', 'Marketing', 'sgs@sgs.com'),
(3, 'om', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Operational Ngab', 'Operational Manager', 'sgs@sgs.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

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
-- AUTO_INCREMENT for table `material_produk`
--
ALTER TABLE `material_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penawaran_harga`
--
ALTER TABLE `penawaran_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan_detil`
--
ALTER TABLE `pesanan_detil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `process_cost`
--
ALTER TABLE `process_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proses_produk`
--
ALTER TABLE `proses_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sub_material_produk`
--
ALTER TABLE `sub_material_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tooling_cost`
--
ALTER TABLE `tooling_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
