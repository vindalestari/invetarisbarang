-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 09:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
(1, 1),
(3, 1),
(5, 1),
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
(1, 3),
(2, 3),
(3, 3),
(1, 42),
(1, 110),
(1, 113),
(1, 114),
(1, 115),
(1, 112),
(1, 111),
(1, 120),
(6, 120),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 121),
(6, 121),
(1, 92),
(6, 92);

-- --------------------------------------------------------

--
-- Table structure for table `kelola_barang`
--

CREATE TABLE `kelola_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_barang`
--

INSERT INTO `kelola_barang` (`id`, `nama_barang`, `jumlah`, `merk`) VALUES
(2, 'Meja Kerjas', '0', 'IKEA'),
(3, 'fdf', '0', 'fdgf'),
(4, 'LEMARI', '', 'IKEA'),
(5, 'KURSI', '0', 'LIGNA');

-- --------------------------------------------------------

--
-- Table structure for table `kelola_barang_keluar`
--

CREATE TABLE `kelola_barang_keluar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jml_barang_keluar` varchar(20) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelola_barang_masuk`
--

INSERT INTO `kelola_barang_masuk` (`id`, `id_user`, `id_supplier`, `harga_barang`, `jml_barang_masuk`, `tgl_masuk`) VALUES
(1, 10, 2, '1000000', '2', '2022-07-02'),
(2, 10, 2, '1000000', '2', '2022-07-02'),
(3, 10, 2, '90', '3', '2022-07-02'),
(4, 10, 1, '40', '2', '2022-07-02'),
(5, 10, 1, '100000', '2', '2022-07-06');

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
(1, 'NB MEBEL', '089776543994', 'Jl. Cihanjuang'),
(2, 'Cahahaya Abadi Mebel', '083166764253', 'Jl. Katumiri No.6');

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
(110, 12, 1, 0, 'fab fa-amazon-pay', 'DEV', '#', '#', 1),
(111, 14, 2, 110, 'fas fa-cog', 'Settting', 'setting', 'setting', 1),
(112, 13, 2, 110, 'fas fa-equals', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(113, 3, 2, 92, 'fas fa-address-book', 'Kelola User', '#', '#', 1),
(114, 4, 3, 113, 'fas fa-address-card', 'Users', 'user', '1', 1),
(115, 5, 3, 113, 'far fa-address-book', 'Groups', 'groups', '1', 1),
(116, 6, 2, 92, 'far fa-id-badge', 'Kelola Supplier', 'kelola_supplier', '#', 1),
(117, 7, 2, 92, 'fas fa-cart-plus', 'Kelola Barang', 'kelola_barang', '#', 1),
(118, 8, 2, 92, 'fas fa-cart-plus', 'Kelola Barang Masuk', 'kelola_barang_masuk', '#', 1),
(119, 9, 2, 92, 'fas fa-cart-plus', 'Kelola Barang Keluar', 'kelola_barang_keluar', '#', 1),
(120, 11, 2, 92, 'fas fa-chart-area', 'Laporan', '#', '#', 1),
(121, 10, 2, 92, 'far fa-save', 'Pengajuan', 'pengajuan', '#', 1);

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
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `id_barang`, `jumlah_barang`, `tanggal_pengajuan`, `status`, `harga_barang`, `id_supplier`) VALUES
(9, 2, '2', '2022-07-02', 1, '20', 1),
(10, 5, '5', '2022-07-05', 0, '100000', 1),
(11, 2, '2', '2022-07-06', 1, '50000', 1);

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
  `NIK` varchar(50) NOT NULL,
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

INSERT INTO `users` (`id`, `NIK`, `password`, `email`, `active`, `first_name`, `last_name`, `phone`, `image`) VALUES
(1, '0', '$2y$08$Pzs37WpnTNtr1xZpsIdz5OcUb2q3tqpcwXs9hiJroy7hP7byfn7Y.', 'admin@trisman.com', 1, 'Trisman', 'Sopandi', 'admin@trisman.com', '_CPC3217_copy.jpg'),
(10, '0', '$2y$08$qQBqt.uD7bf5aUaC4L.BnuNhoDLbJvauvPbCRgrvJio3V6HR.xDXm', 'kepaladinas@rony.com', 1, 'Mochamad', 'Rony', '088278891023', 'teacher4.png');

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
(34, 1, 1),
(35, 10, 6);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelola_barang_keluar`
--
ALTER TABLE `kelola_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelola_barang_masuk`
--
ALTER TABLE `kelola_barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelola_supplier`
--
ALTER TABLE `kelola_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
