-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 10:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventarisbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(6, 'Kepala Dinas', 'Kepala Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 43),
(1, 44),
(1, 95),
(5, 95),
(1, 96),
(5, 96),
(1, 100),
(5, 100),
(1, 101),
(5, 101),
(1, 102),
(5, 102),
(1, 104),
(5, 104),
(1, 105),
(5, 105),
(1, 106),
(5, 106),
(1, 107),
(5, 107),
(1, 4),
(2, 4),
(3, 4),
(5, 4),
(1, 42),
(1, 113),
(1, 114),
(1, 115),
(1, 112),
(1, 111),
(1, 116),
(1, 117),
(1, 118),
(1, 121),
(6, 121),
(1, 92),
(6, 92),
(1, 120),
(6, 120),
(1, 1),
(6, 1),
(1, 3),
(6, 3),
(1, 122),
(6, 122),
(1, 123),
(6, 123),
(1, 119),
(0, 124),
(1, 110),
(1, 125);

-- --------------------------------------------------------

--
-- Table structure for table `kelola_barang`
--

CREATE TABLE `kelola_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `klasifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_barang`
--

INSERT INTO `kelola_barang` (`id`, `nama_barang`, `jumlah`, `merk`, `klasifikasi`) VALUES
(13, 'Meja Kerja Ekstra-Beech/Black-Include Laci', '5', 'UNO OFFICE', 'Furniture'),
(14, 'LemariI Arsip atas Pintu Kaca maple-white - Arsip ', '0', 'UNO OFFICE', 'Furniture'),
(15, 'Lemari Arsip Sliding Kaca-L33AK', '0', 'LION', 'Furniture'),
(16, 'Filing Cabinet 4 Laci, Filling Cabinet 4 Laci-L44', '0', 'LION', 'Furniture'),
(17, 'kursi p', '0', 'IKEA', 'Furniture'),
(18, 'kursi p', '0', 'IKEA', 'Furniture'),
(19, 'Tas', '0', 'EGER', 'Furniture'),
(20, 'Tas', '0', 'UNO', 'Furniture'),
(21, 'Laptop', '0', 'Asus', 'Furniture'),
(22, 'kunci', '0', 'UNO', 'Furniture'),
(23, 'Gelas', '0', 'OO', 'Furniture'),
(24, 'Kursi Putar', '0', 'UNO', 'Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `kelola_barang_keluar`
--

CREATE TABLE `kelola_barang_keluar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jml_barang_keluar` varchar(20) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `status_penerimaan` enum('Diterima','Belum Diterima') NOT NULL DEFAULT 'Belum Diterima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_barang_keluar`
--

INSERT INTO `kelola_barang_keluar` (`id`, `id_user`, `id_barang`, `jml_barang_keluar`, `tgl_keluar`, `tujuan`, `status_penerimaan`) VALUES
(15, 1, 14, '1', '2022-08-12', 'R.Kadis', 'Belum Diterima'),
(16, 1, 14, '1', '2022-08-13', 'R.Bendahara', 'Belum Diterima'),
(17, 1, 14, '1', '2022-08-13', 'R.Kadis', 'Belum Diterima'),
(18, 1, 13, '1', '2022-08-14', 'R.Kadis', 'Belum Diterima'),
(19, 1, 13, '1', '2022-08-23', 'R.Kadis', 'Belum Diterima'),
(20, 1, 20, '2', '2022-08-27', 'R.Kadis', 'Diterima'),
(21, 1, 21, '1', '2022-08-27', 'R.Kadis', 'Diterima'),
(22, 1, 22, '1', '2022-08-27', 'R.Sekretariat', 'Diterima'),
(23, 1, 22, '1', '2022-08-27', 'R.Sekretariat', 'Diterima'),
(24, 1, 23, '1', '2022-08-29', 'R.Kadis', 'Belum Diterima'),
(25, 1, 24, '1', '2022-08-29', 'R.Bendahara', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `kelola_barang_masuk`
--

CREATE TABLE `kelola_barang_masuk` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_supplier` int(50) NOT NULL,
  `harga_barang` varchar(50) NOT NULL,
  `jml_barang_masuk` varchar(20) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_pengajuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_barang_masuk`
--

INSERT INTO `kelola_barang_masuk` (`id`, `id_user`, `id_supplier`, `harga_barang`, `jml_barang_masuk`, `tgl_masuk`, `status`, `id_pengajuan`, `total_harga`) VALUES
(17, 10, 6, '1500000', '3', '2022-08-12', 1, 25, 4500000),
(18, 10, 6, '100000', '2', '2022-08-13', 1, 26, 200000),
(19, 10, 4, '100000', '1', '2022-08-14', 1, 28, 100000),
(20, 10, 4, '100000', '2', '2022-08-24', 1, 29, 200000),
(21, 10, 4, '13000', '2', '2022-08-27', 1, 31, 26000),
(22, 10, 6, '222222', '2', '2022-08-27', 1, 32, 444444),
(23, 10, 4, '20000000', '1', '2022-08-27', 1, 33, 20000000),
(24, 10, 4, '150000', '1', '2022-08-27', 1, 34, 150000),
(25, 10, 7, '90000', '1', '2022-08-29', 1, 35, 90000),
(26, 10, 9, '1500000', '1', '2022-08-29', 1, 36, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `kelola_supplier`
--

CREATE TABLE `kelola_supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_supplier`
--

INSERT INTO `kelola_supplier` (`id`, `nama`, `telepon`, `alamat`) VALUES
(4, 'Cellini', '(022) 73513777', 'Jl. Gatot Subroto No.74, Lkr. Sel., Kec. Lengkong,'),
(5, 'SOHO.ID Furniture Store', '(022) 73280790', 'Jl. Ibrahim Adjie Jl. Terusan Kiaracondong No.423,'),
(6, 'Diana Eva Furniture', '(022) 6070901', 'Jalan Peta No.177 Lingkar Selatan Bojongloa Kidul,'),
(7, 'Viku Furniture Interior', '0838-2199-9917', 'Jl. A.H. Nasution No.98, Sukamiskin, Kec. Arcamani'),
(8, 'Chandra Karya Cimahi', '(022) 20567766', 'Jl. Pajajaran No.101, Arjuna, Kec. Cicendo, Kota B'),
(9, 'Putri Chika', '08977654399', 'Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 99,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(43, 11, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 12, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(92, 2, 1, 0, 'empty', 'MASTER DATA', '#', 'masterdata', 1),
(110, 16, 2, 124, 'fab fa-amazon-pay', 'DEV', '#', '#', 1),
(111, 18, 3, 110, 'fas fa-cog', 'Settting', 'setting', 'setting', 1),
(112, 17, 3, 110, 'fas fa-equals', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(113, 3, 2, 92, 'fas fa-address-book', 'Kelola User', '#', '#', 1),
(114, 4, 3, 113, 'fas fa-address-card', 'Users', 'user', '1', 1),
(115, 15, 2, 124, 'far fa-address-book', 'Groups', 'groups', '1', 1),
(116, 5, 2, 92, 'far fa-id-badge', 'Kelola Supplier', 'kelola_supplier', '#', 1),
(117, 6, 2, 92, 'fas fa-cart-plus', 'Kelola Barang', 'kelola_barang', '#', 1),
(118, 7, 2, 92, 'fas fa-cart-plus', 'Kelola Barang Masuk', 'kelola_barang_masuk', '#', 1),
(119, 8, 2, 92, 'fas fa-cart-plus', 'Daftar Barang Keluar', 'kelola_barang_keluar', '#', 1),
(120, 11, 2, 92, 'fas fa-chart-area', 'Laporan', 'laporan', '#', 1),
(121, 9, 2, 92, 'far fa-save', 'Pengajuan', 'pengajuan', '#', 1),
(122, 12, 3, 120, 'fab fa-accusoft', 'laporan barang masuk', 'laporan/laporan_barang_masuk', '#', 1),
(123, 13, 3, 120, 'fas fa-ad', 'laporan barang keluar', 'laporan/laporan_barang_keluar', '#', 1),
(124, 14, 1, 0, 'fas fa-birthday-cake', 'hiden', '#', '#', 1),
(125, 10, 2, 92, 'fab fa-accessible-icon', 'Kelola Pengajuan', 'Pengajuan/kelola_pengajuan', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` varchar(50) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` int(11) NOT NULL,
  `harga_barang` varchar(50) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `id_barang`, `jumlah_barang`, `tanggal_pengajuan`, `status`, `harga_barang`, `id_supplier`, `total_harga`, `tujuan`) VALUES
(25, 14, '3', '2022-08-12', 1, '1500000', 6, 4500000, ''),
(26, 13, '2', '2022-08-13', 1, '100000', 6, 200000, ''),
(27, 13, '1', '2022-08-13', 2, '100000', 4, 100000, ''),
(28, 13, '1', '2022-08-14', 1, '100000', 4, 100000, ''),
(29, 13, '2', '2022-08-24', 1, '100000', 4, 200000, ''),
(30, 13, '3', '2022-08-24', 2, '100000', 4, 300000, ''),
(31, 13, '2', '2022-08-27', 1, '13000', 4, 26000, 'R.Sekretariat'),
(32, 20, '2', '2022-08-27', 1, '222222', 6, 444444, 'R.Kadis'),
(33, 21, '1', '2022-08-27', 1, '20000000', 4, 20000000, 'R.Kadis'),
(34, 22, '1', '2022-08-27', 1, '150000', 4, 150000, 'R.Sekretariat'),
(35, 23, '1', '2022-08-29', 1, '90000', 7, 90000, 'R.Kadis'),
(36, 24, '1', '2022-08-29', 1, '1500000', 9, 1500000, 'R.Bendahara');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `kode`, `nama`, `nilai`) VALUES
(1, 'S.png', 'INVENTARIS BARANG DISARDA KOTA CIMAHI', 'www.disarda.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `password`, `email`, `active`, `first_name`, `last_name`, `phone`, `image`) VALUES
(1, '3273076002020003', '$2y$08$wUXF2jQ15kA5zUpTZXnAt.h7OayiQKXzCnfk2x8.37X1zqkQU.aOq', 'admin@trisman.com', 1, 'Trisman', 'Sopandi', 'admin@trisman.com', '_CPC3217_copy.jpg'),
(10, '3273076003030004', '$2y$08$7N4Rh1ltEXYOI8oim0IW5OSYe3RJ2qwZS07jM6fxB0KjiNeD80ttS', 'kepaladinas@ganis.com', 1, 'Ganis', 'Komarianto', '088278891023', 'teacher4.png');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(41, 1, 1),
(44, 10, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelola_barang`
--
ALTER TABLE `kelola_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelola_barang_keluar`
--
ALTER TABLE `kelola_barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelola_barang_masuk`
--
ALTER TABLE `kelola_barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelola_supplier`
--
ALTER TABLE `kelola_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelola_barang`
--
ALTER TABLE `kelola_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kelola_barang_keluar`
--
ALTER TABLE `kelola_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kelola_barang_masuk`
--
ALTER TABLE `kelola_barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kelola_supplier`
--
ALTER TABLE `kelola_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
