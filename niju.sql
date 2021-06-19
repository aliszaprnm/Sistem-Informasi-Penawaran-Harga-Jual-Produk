-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 03:07 PM
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
  `kode_customer` varchar(255) NOT NULL,
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
('CUST-001', 'PT Mitsubishi Krama Yudha Motors and Manufacturing', 'Jalan Raya Bekasi No.22, RT.8/RW.5, Rw. Terate, Kec. Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13930', '16.0', '(021) 4602908', 'mitsubishi-motors@mitsubishi-motors.co.id'),
('CUST-002', 'PT Setia Guna Selaras', 'Jalan Industri Selatan 2 Blok LL No. 2A, Pasirsari, Cikarang Sel., Bekasi, Jawa Barat 17530', '15.9', '(021) 89836938', 'sgs@sgs.com');

-- --------------------------------------------------------

--
-- Table structure for table `material_produk`
--

CREATE TABLE `material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `jenis_material` varchar(255) NOT NULL,
  `tebal_material` decimal(5,2) NOT NULL,
  `lebar_material` decimal(7,2) NOT NULL,
  `panjang_material` decimal(7,2) NOT NULL,
  `berat_material` decimal(5,2) NOT NULL,
  `jml_per_sheet` int(11) NOT NULL,
  `berat_produk` decimal(3,2) NOT NULL,
  `harga_material` int(11) NOT NULL,
  `harga_per_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_produk`
--

INSERT INTO `material_produk` (`id`, `kode_produk`, `jenis_material`, `tebal_material`, `lebar_material`, `panjang_material`, `berat_material`, `jml_per_sheet`, `berat_produk`, `harga_material`, `harga_per_produk`) VALUES
(1, 'PROD-001', 'SPCC', '0.15', '50.00', '1219.00', '0.24', 24, '0.01', 15000, 150),
(2, 'PROD-001', 'SPCC', '0.35', '243.00', '1024.00', '0.24', 24, '0.01', 15000, 150),
(3, 'PROD-001', 'SPCC', '0.35', '243.00', '1024.00', '0.24', 24, '0.01', 15000, 150),
(4, 'PROD-002', 'SPCk', '0.35', '243.00', '1024.00', '0.35', 70, '0.01', 20000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `kode_mesin` varchar(255) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `kekuatan` decimal(5,2) NOT NULL,
  `satuan` enum('Kg','Ton') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`kode_mesin`, `nama_mesin`, `kekuatan`, `satuan`) VALUES
('MSN-001', 'High Press', '200.00', 'Ton'),
('MSN-002', 'Medium Press', '35.00', 'Ton'),
('MSN-003', 'Medium Press', '110.00', 'Ton');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_harga`
--

CREATE TABLE `penawaran_harga` (
  `id` int(11) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `process_cost` int(11) NOT NULL,
  `tooling_cost` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penawaran_harga`
--

INSERT INTO `penawaran_harga` (`id`, `kode_customer`, `kode_produk`, `process_cost`, `tooling_cost`, `total`) VALUES
(0, 'CUST-001', 'PROD-001', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT curdate(),
  `kode_customer` varchar(255) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `kode_pesanan`, `tanggal`, `kode_customer`, `kode_produk`, `qty`, `keterangan`) VALUES
(1, 'ORDER-00001', '2021-06-15', 'CUST-001', 'PROD-001', 5000, 'material berasal dari customer'),
(2, 'ORDER-00001', '2021-06-15', 'CUST-001', 'PROD-002', 4000, 'material berasal dari customer');

-- --------------------------------------------------------

--
-- Table structure for table `process_cost`
--

CREATE TABLE `process_cost` (
  `id` int(11) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
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

INSERT INTO `process_cost` (`id`, `kode_customer`, `kode_produk`, `harga_material`, `harga_proses`, `harga_sub_material`, `harga_delivery`, `harga_packing`, `harga_qc`, `harga_mtc_dies`, `profit_dan_OH`, `total`) VALUES
(1, 'CUST-001', 'PROD-001', 0, 0, 0, 15000, '0.05', '0.05', '0.10', '0.25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(255) NOT NULL,
  `kode_grup` varchar(255) NOT NULL,
  `kode_customer` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `cavity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `kode_grup`, `kode_customer`, `nama_produk`, `cavity`) VALUES
('PROD-001', 'IK176', 'CUST-001', 'Oil Seal Step 1', 2),
('PROD-002', 'SGS36', 'CUST-002', 'Bkt. Rear', 2);

-- --------------------------------------------------------

--
-- Table structure for table `proses_produk`
--

CREATE TABLE `proses_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `nama_proses` varchar(255) NOT NULL,
  `kode_mesin` varchar(255) NOT NULL,
  `std_dies_height` decimal(5,1) DEFAULT NULL,
  `harga_dies` int(11) NOT NULL,
  `harga_proses` decimal(3,1) NOT NULL,
  `harga_per_produk` decimal(5,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses_produk`
--

INSERT INTO `proses_produk` (`id`, `kode_produk`, `nama_proses`, `kode_mesin`, `std_dies_height`, `harga_dies`, `harga_proses`, `harga_per_produk`) VALUES
(2, 'PROD-001', 'Blank', 'MSN-001', '253.5', 39000000, '1.5', '472.5'),
(4, 'PROD-001', 'Draw', 'MSN-002', '243.9', 34000000, '1.5', '375.0'),
(5, 'PROD-001', 'Piercing', 'MSN-001', '212.0', 30000000, '1.5', '472.5'),
(6, 'PROD-002', 'Forming', 'MSN-003', '223.2', 39000000, '2.0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_material_produk`
--

CREATE TABLE `sub_material_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `sub_material` varchar(255) NOT NULL,
  `pemakaian` decimal(5,5) NOT NULL,
  `harga_sub_material` int(11) NOT NULL,
  `harga_per_produk` int(11) NOT NULL COMMENT 'pemakaian*sub_material_produk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_material_produk`
--

INSERT INTO `sub_material_produk` (`id`, `kode_produk`, `sub_material`, `pemakaian`, `harga_sub_material`, `harga_per_produk`) VALUES
(2, 'PROD-001', 'Alphasol', '0.00020', 168000, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tooling_cost`
--

CREATE TABLE `tooling_cost` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(255) NOT NULL,
  `harga_dies` int(11) NOT NULL,
  `vol_prod` int(11) NOT NULL,
  `depresiasi_dies` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tooling_cost`
--

INSERT INTO `tooling_cost` (`id`, `kode_produk`, `harga_dies`, `vol_prod`, `depresiasi_dies`, `total`) VALUES
(0, 'PROD-001', 0, 45000, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `level` enum('Administrator','Bagian Marketing','Operational Manager') NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `level`, `email`) VALUES
(1, 'admin', 'admin', 'Nur Khalisza Purnama Putri', 'Administrator', 'aliszaprnm@gmail.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `process_cost`
--
ALTER TABLE `process_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proses_produk`
--
ALTER TABLE `proses_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_material_produk`
--
ALTER TABLE `sub_material_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
