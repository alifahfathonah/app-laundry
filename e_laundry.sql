-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2019 at 05:21 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `dm_admin_log`
--

CREATE TABLE `dm_admin_log` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dm_barang`
--

CREATE TABLE `dm_barang` (
  `id` int(11) NOT NULL,
  `id_kategori` int(25) DEFAULT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `stock` int(15) NOT NULL,
  `harga_pokok` double NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_barang`
--

INSERT INTO `dm_barang` (`id`, `id_kategori`, `kode_barang`, `nama`, `stock`, `harga_pokok`, `status`, `created_date`, `update_date`) VALUES
(1, 2, 'AA01', 'Rinso', 15, 30000, 'Aktif', '2019-01-03 09:38:22', '2019-01-03 10:08:31'),
(3, 2, 'AA02', 'Molto Pewangi', 10, 20000, 'Aktif', '2019-01-03 10:28:08', '0000-00-00 00:00:00'),
(5, 2, 'AA03', 'Pewangi Ocean', 2, 70000, 'Aktif', '2019-01-03 10:34:47', '0000-00-00 00:00:00'),
(6, 2, 'ATK01', 'Kertas A4 ', 1, 45000, 'Aktif', '2019-01-03 10:36:02', '2019-03-29 15:58:12'),
(7, 3, 'BC001', 'Printer', 1, 1500000, 'Aktif', '2019-01-03 15:57:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dm_customer`
--

CREATE TABLE `dm_customer` (
  `id` varchar(20) NOT NULL,
  `inc` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `nama_customer` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(16) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `disc` double NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_customer`
--

INSERT INTO `dm_customer` (`id`, `inc`, `tanggal_daftar`, `nama_customer`, `alamat`, `telp`, `status`, `disc`, `created_date`, `update_date`) VALUES
('000001', 67, '2019-03-29', 'AMMAR SYAHIDILLAH', 'BENDA BATU CEPER', '0123456789', 'Aktif', 0, '2019-03-29 18:03:16', '0000-00-00 00:00:00'),
('000002', 68, '2019-03-15', 'SANTOSO', 'JL. PEMBANGUNAN 3', '0123456789', 'Aktif', 0, '2019-03-15 11:42:38', '0000-00-00 00:00:00'),
('000003', 69, '2019-01-09', 'RIDVAN FAUZI', 'TANGERANG', '012345678789', 'Aktif', 0, '2019-01-09 10:01:49', '0000-00-00 00:00:00'),
('000004', 70, '2019-01-09', 'FAHMIE AL-KHUDORIE', 'JL. PEMBANGUNAN 3 RT.01/03', '01236597875', 'Aktif', 0, '2019-01-09 10:05:56', '0000-00-00 00:00:00'),
('000005', 71, '2019-01-09', 'BELA NAURA', 'TANGERANG', '0812435847474', 'Aktif', 0, '2019-01-09 10:19:51', '0000-00-00 00:00:00'),
('000006', 72, '2019-01-21', 'MITA SILVIA', 'KEBON CAU', '0123456598', 'Aktif', 0, '2019-01-21 13:28:52', '0000-00-00 00:00:00'),
('000007', 73, '2019-01-09', 'YANYAN RISDIASYAH', 'BAYUR TANGERANG', '0123456789', 'Aktif', 0, '2019-01-09 15:07:21', '0000-00-00 00:00:00'),
('000008', 74, '2019-01-09', 'EKO CAHYO NUGROHO', 'JAKARTA TIMUR', '021387978999', 'Aktif', 0, '2019-01-09 21:14:44', '0000-00-00 00:00:00'),
('000009', 75, '2019-03-29', 'YOSUA ALBERT', 'TANGERANG', '0123456789', 'Aktif', 0, '2019-03-29 10:50:07', '0000-00-00 00:00:00'),
('000010', 76, '2019-01-10', 'AOM MUHARROM', 'TANGERANG', '0234498424928', 'Aktif', 0, '2019-01-10 09:41:27', '0000-00-00 00:00:00'),
('000011', 77, '2019-01-12', 'ANRI SURYANINGRAT', 'TANGERANG', '0123456789', 'Aktif', 0, '2019-01-12 08:51:53', '0000-00-00 00:00:00'),
('000012', 78, '2019-01-21', 'ABDUL SOMAD', 'TANGERANG', '0123456789', 'Aktif', 0, '2019-01-21 10:01:30', '0000-00-00 00:00:00'),
('000013', 79, '2019-02-22', 'MUHAMMAD JONI', 'KAMPUNG BULAK', '0123456789', 'Aktif', 0, '2019-02-22 10:49:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dm_detail_laundry_masuk`
--

CREATE TABLE `dm_detail_laundry_masuk` (
  `id` int(11) NOT NULL,
  `id_laundry_masuk` int(11) NOT NULL,
  `id_layanan_laundry_masuk` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `tanggal_terima` datetime NOT NULL,
  `penerimaan_ke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_detail_laundry_masuk`
--

INSERT INTO `dm_detail_laundry_masuk` (`id`, `id_laundry_masuk`, `id_layanan_laundry_masuk`, `id_paket`, `harga`, `jumlah`, `tanggal_terima`, `penerimaan_ke`) VALUES
(96, 93, 70, 15, 7000, 1, '2019-01-08 15:16:10', 1),
(97, 93, 70, 42, 7000, 2, '2019-01-08 15:16:10', 1),
(98, 94, 71, 42, 7000, 2, '2019-01-08 16:34:55', 1),
(99, 94, 71, 36, 5000, 1, '2019-01-08 16:34:55', 1),
(100, 94, 71, 39, 10000, 1, '2019-01-08 16:34:55', 1),
(101, 95, 72, 42, 7000, 3, '2019-01-08 17:56:48', 1),
(102, 95, 72, 39, 10000, 2, '2019-01-08 17:56:48', 1),
(103, 96, 73, 42, 7000, 5, '2019-01-09 10:01:49', 1),
(104, 96, 73, 17, 10000, 1, '2019-01-09 10:01:49', 1),
(105, 96, 73, 30, 6000, 1, '2019-01-09 10:01:49', 1),
(106, 97, 74, 15, 7000, 1, '2019-01-09 10:05:56', 1),
(107, 97, 74, 13, 10000, 1, '2019-01-09 10:05:56', 1),
(108, 97, 74, 14, 5000, 1, '2019-01-09 10:05:56', 1),
(109, 97, 74, 42, 7000, 4, '2019-01-09 10:05:56', 1),
(110, 98, 75, 17, 10000, 1, '2019-01-09 10:06:22', 1),
(111, 98, 75, 40, 5000, 4, '2019-01-09 10:06:22', 1),
(112, 99, 76, 42, 7000, 4, '2019-01-09 10:19:51', 1),
(113, 99, 76, 39, 10000, 3, '2019-01-09 10:19:51', 1),
(114, 100, 77, 42, 7000, 2, '2019-01-09 10:33:23', 1),
(115, 100, 77, 41, 5000, 3, '2019-01-09 10:33:23', 1),
(116, 101, 78, 15, 7000, 2, '2019-01-09 15:07:21', 1),
(117, 101, 78, 42, 7000, 5, '2019-01-09 15:07:21', 1),
(118, 102, 79, 42, 7000, 3, '2019-01-09 21:14:44', 1),
(119, 102, 79, 30, 6000, 4, '2019-01-09 21:14:44', 1),
(120, 103, 80, 19, 6000, 1, '2019-01-10 09:08:04', 1),
(121, 104, 81, 42, 7000, 3, '2019-01-10 09:41:27', 1),
(122, 104, 81, 40, 5000, 4, '2019-01-10 09:41:27', 1),
(123, 105, 82, 42, 7000, 2, '2019-01-12 08:51:53', 1),
(124, 105, 82, 30, 6000, 4, '2019-01-12 08:51:53', 1),
(125, 106, 83, 42, 7000, 5, '2019-01-21 10:01:30', 1),
(126, 106, 83, 31, 10000, 1, '2019-01-21 10:01:30', 1),
(127, 107, 84, 42, 7000, 15, '2019-01-21 13:28:52', 1),
(128, 108, 85, 36, 5000, 5, '2019-02-22 10:49:14', 1),
(129, 108, 85, 30, 6000, 2, '2019-02-22 10:49:14', 1),
(130, 108, 85, 16, 15000, 1, '2019-02-22 10:49:14', 1),
(131, 108, 85, 13, 10000, 1, '2019-02-22 10:49:14', 1),
(132, 108, 85, 32, 12000, 1, '2019-02-22 10:49:14', 1),
(133, 108, 85, 42, 7000, 3, '2019-02-22 10:49:14', 1),
(134, 109, 86, 31, 10000, 1, '2019-03-15 11:42:38', 1),
(135, 110, 87, 33, 5000, 1, '2019-03-29 10:50:07', 1),
(136, 110, 87, 24, 10000, 5, '2019-03-29 10:50:07', 1),
(137, 111, 88, 42, 7000, 1, '2019-03-29 18:03:16', 1),
(138, 111, 88, 40, 6000, 4, '2019-03-29 18:03:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dm_grant_privileges`
--

CREATE TABLE `dm_grant_privileges` (
  `id` int(11) NOT NULL,
  `id_group_users` int(11) NOT NULL,
  `id_privileges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_grant_privileges`
--

INSERT INTO `dm_grant_privileges` (`id`, `id_group_users`, `id_privileges`) VALUES
(114, 8, 9),
(115, 8, 10),
(122, 9, 13),
(123, 9, 7),
(124, 9, 8),
(125, 9, 2),
(126, 9, 1),
(127, 9, 6),
(128, 9, 3),
(129, 9, 5),
(130, 9, 4),
(131, 9, 12),
(132, 9, 11),
(133, 9, 9),
(134, 9, 10),
(177, 1, 13),
(178, 1, 8),
(179, 1, 2),
(180, 1, 1),
(181, 1, 6),
(182, 1, 4),
(183, 1, 9),
(184, 6, 13),
(185, 6, 8),
(186, 6, 2),
(187, 6, 1),
(188, 6, 6),
(189, 6, 3),
(190, 6, 4),
(191, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `dm_group_users`
--

CREATE TABLE `dm_group_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_group_users`
--

INSERT INTO `dm_group_users` (`id`, `nama`) VALUES
(1, 'Admin'),
(6, 'Super Admin'),
(8, 'Kasir'),
(9, 'Owner');

-- --------------------------------------------------------

--
-- Table structure for table `dm_jabatan`
--

CREATE TABLE `dm_jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_jabatan`
--

INSERT INTO `dm_jabatan` (`id`, `nama`) VALUES
(1, 'Owner'),
(2, 'Staff'),
(3, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `dm_jenis_pewangi`
--

CREATE TABLE `dm_jenis_pewangi` (
  `id` int(11) NOT NULL,
  `nama_pewangi` varchar(255) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_jenis_pewangi`
--

INSERT INTO `dm_jenis_pewangi` (`id`, `nama_pewangi`, `status`) VALUES
(4, 'Aqua Fresh', 'Tidak Aktif'),
(5, 'Akasia / Sakura', 'Aktif'),
(6, 'Apel Fresh', 'Aktif'),
(7, 'Anggur', 'Aktif'),
(8, 'Baby Pofdery', 'Aktif'),
(9, 'Bugenvile', 'Tidak Aktif'),
(10, 'Buoqet', 'Aktif'),
(11, 'Bublegum', 'Aktif'),
(12, 'Dahlia', 'Aktif'),
(13, 'Downy Passion', 'Aktif'),
(14, 'Downy Freshing', 'Aktif'),
(15, 'Downy Mystique', 'Aktif'),
(16, 'Exotic', 'Aktif'),
(17, 'Flash Pink', 'Aktif'),
(18, 'Floral', 'Aktif'),
(19, 'Floral Fruity', 'Aktif'),
(20, 'Floris', 'Aktif'),
(21, 'Flower Blue', 'Aktif'),
(22, 'Grice', 'Aktif'),
(23, 'Greentea', 'Aktif'),
(24, 'Jasmine', 'Aktif'),
(25, 'Jesica', 'Aktif'),
(26, 'JLO Stiler', 'Aktif'),
(27, 'JLO Donisa', 'Aktif'),
(28, 'Jeruk Nipis', 'Aktif'),
(29, 'Kraton Super', 'Aktif'),
(30, 'Kenzo Flower', 'Aktif'),
(31, 'Kisprai', 'Aktif'),
(32, 'Lavender', 'Aktif'),
(33, 'Lily Sweet', 'Aktif'),
(34, 'Lily Red', 'Aktif'),
(35, 'Lemon', 'Aktif'),
(36, 'Lido', 'Aktif'),
(37, 'Lime', 'Aktif'),
(38, 'Luxia', 'Aktif'),
(39, 'Melon', 'Aktif'),
(40, 'Luxury', 'Aktif'),
(41, 'Melon', 'Aktif'),
(42, 'Men Spirit', 'Aktif'),
(43, 'Molto Blue', 'Aktif'),
(44, 'Mocafe', 'Aktif'),
(45, 'Ocean Fresh', 'Aktif'),
(46, 'Pinoil', 'Aktif'),
(47, 'Phonix', 'Aktif'),
(48, 'Rose', 'Aktif'),
(49, 'Stawberry', 'Aktif'),
(50, 'Snapy', 'Aktif'),
(51, 'Snowfall/Blossom', 'Aktif'),
(52, 'Tulip', 'Aktif'),
(53, 'Tropical', 'Aktif'),
(54, 'Vanila', 'Aktif'),
(55, 'Victoria', 'Aktif'),
(56, 'Vinolia', 'Aktif'),
(57, 'Violet', 'Aktif'),
(58, 'White Angel', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `dm_kategori_barang`
--

CREATE TABLE `dm_kategori_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_kategori_barang`
--

INSERT INTO `dm_kategori_barang` (`id`, `nama`, `jenis`) VALUES
(1, 'Alat Tulis Kantor', 'Rumah Tangga'),
(2, 'Perbekalan Rumah Tangga Lainnya', 'Rumah Tangga'),
(3, 'Barang Cetakan', 'Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `dm_laundry_masuk`
--

CREATE TABLE `dm_laundry_masuk` (
  `id` int(11) NOT NULL,
  `no_register` varchar(25) NOT NULL,
  `id_customer` varchar(50) DEFAULT NULL,
  `id_jenis_pewangi` int(11) DEFAULT NULL,
  `waktu_daftar` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `status` enum('Baru','Lama') NOT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_laundry_masuk`
--

INSERT INTO `dm_laundry_masuk` (`id`, `no_register`, `id_customer`, `id_jenis_pewangi`, `waktu_daftar`, `waktu_keluar`, `status`, `id_users`) VALUES
(93, '1901080001', '000001', 7, '2019-01-08 15:16:10', '2019-01-08 15:16:56', 'Baru', 13),
(94, '1901080002', '000002', 13, '2019-01-08 16:34:55', '2019-01-09 09:59:42', 'Baru', 22),
(95, '1901080003', '000001', 16, '2019-01-08 17:56:48', NULL, 'Lama', 13),
(96, '1901090001', '000003', 15, '2019-01-09 10:01:49', NULL, 'Baru', 22),
(97, '1901090002', '000004', 12, '2019-01-09 10:05:56', NULL, 'Baru', 13),
(98, '1901090003', '000001', 18, '2019-01-09 10:06:22', '2019-01-09 10:48:03', 'Lama', 13),
(99, '1901090004', '000005', 17, '2019-01-09 10:19:51', NULL, 'Baru', 22),
(100, '1901090005', '000006', 6, '2019-01-09 10:33:23', '2019-02-23 10:19:11', 'Baru', 22),
(101, '1901090006', '000007', 12, '2019-01-09 15:07:21', '2019-02-28 19:40:44', 'Baru', 13),
(102, '1901090007', '000008', 13, '2019-01-09 21:14:44', '2019-01-12 11:34:20', 'Baru', 13),
(103, '1901100001', '000009', 5, '2019-01-10 09:08:04', NULL, 'Baru', 22),
(104, '1901100002', '000010', 24, '2019-01-10 09:41:27', '2019-01-15 08:15:50', 'Baru', 22),
(105, '1901120001', '000011', 6, '2019-01-12 08:51:53', '2019-01-12 11:34:01', 'Baru', 13),
(106, '1901210001', '000012', 33, '2019-01-21 10:01:30', '2019-01-22 16:07:28', 'Baru', 13),
(107, '1901210002', '000006', 6, '2019-01-21 13:28:52', '2019-07-17 10:51:38', 'Lama', 13),
(108, '1902220001', '000013', 12, '2019-02-22 10:49:14', '2019-02-28 19:40:32', 'Baru', 13),
(109, '1903150001', '000002', 5, '2019-03-15 11:42:38', '2019-03-15 11:42:59', 'Lama', 13),
(110, '1903290001', '000009', 6, '2019-03-29 10:50:07', '2019-03-29 10:50:29', 'Lama', 13),
(111, '1903290002', '000001', 5, '2019-03-29 18:03:16', '2019-04-01 11:14:43', 'Lama', 13);

-- --------------------------------------------------------

--
-- Table structure for table `dm_layanan_laundry_masuk`
--

CREATE TABLE `dm_layanan_laundry_masuk` (
  `id` int(11) NOT NULL,
  `id_laundry_masuk` int(11) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `no_antri` int(11) NOT NULL,
  `status` enum('Request','Proses','Selesai','Batal') NOT NULL,
  `bayar` enum('Belum Lunas','Lunas') NOT NULL,
  `total` double NOT NULL,
  `jumlahbayar` double NOT NULL,
  `piutang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_layanan_laundry_masuk`
--

INSERT INTO `dm_layanan_laundry_masuk` (`id`, `id_laundry_masuk`, `waktu`, `no_antri`, `status`, `bayar`, `total`, `jumlahbayar`, `piutang`) VALUES
(70, 93, '2019-01-08 15:16:10', 1, 'Selesai', 'Lunas', 0, 30000, 0),
(71, 94, '2019-01-08 16:34:55', 2, 'Selesai', 'Lunas', 29000, 30000, 0),
(72, 95, '2019-01-08 17:56:48', 3, 'Proses', 'Lunas', 41000, 41000, 0),
(73, 96, '2019-01-09 10:01:49', 1, 'Proses', 'Belum Lunas', 0, 0, 0),
(74, 97, '2019-01-09 10:05:56', 2, 'Request', 'Belum Lunas', 0, 0, 0),
(75, 98, '2019-01-09 10:06:22', 3, 'Selesai', 'Belum Lunas', 0, 0, 0),
(76, 99, '2019-01-09 10:19:51', 4, 'Proses', 'Belum Lunas', 0, 0, 0),
(77, 100, '2019-01-09 10:33:23', 5, 'Selesai', 'Lunas', 0, 29000, 0),
(78, 101, '2019-01-09 15:07:21', 6, 'Batal', 'Belum Lunas', 0, 0, 0),
(79, 102, '2019-01-09 21:14:44', 7, 'Batal', 'Lunas', 45000, 45000, 0),
(80, 103, '2019-01-10 09:08:04', 1, 'Proses', 'Lunas', 6000, 6000, 0),
(81, 104, '2019-01-10 09:41:27', 2, 'Selesai', 'Lunas', 41000, 50000, 0),
(82, 105, '2019-01-12 08:51:53', 1, 'Selesai', 'Lunas', 38000, 38000, 0),
(83, 106, '2019-01-21 10:01:30', 1, 'Selesai', 'Lunas', 0, 45000, 0),
(84, 107, '2019-01-21 13:28:52', 2, 'Batal', 'Lunas', 105000, 105000, 0),
(85, 108, '2019-02-22 10:49:14', 1, 'Selesai', 'Lunas', 95000, 100000, 0),
(86, 109, '2019-03-15 11:42:38', 1, 'Selesai', 'Lunas', 0, 50000, 0),
(87, 110, '2019-03-29 10:50:07', 1, 'Selesai', 'Lunas', 0, 60000, 0),
(88, 111, '2019-03-29 18:03:16', 2, 'Batal', 'Belum Lunas', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dm_log`
--

CREATE TABLE `dm_log` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `response` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dm_loker`
--

CREATE TABLE `dm_loker` (
  `id` int(11) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL,
  `nomor_transaksi` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dm_module`
--

CREATE TABLE `dm_module` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `urut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_module`
--

INSERT INTO `dm_module` (`id`, `nama`, `controller`, `icon`, `urut`) VALUES
(1, 'Master Data', 'masterdata', 'fa fa-database', 1),
(2, 'Sistem', 'sistem', 'fa fa-gears', 5),
(3, 'Transaksi', 'transaksi', 'fa fa-tasks', 2),
(4, 'Laporan', 'laporan', 'fa fa-print', 4),
(5, 'Keuangan', 'keuangan', 'fa fa-money', 3);

-- --------------------------------------------------------

--
-- Table structure for table `dm_paket`
--

CREATE TABLE `dm_paket` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `satuan_paket` varchar(255) NOT NULL,
  `harga_paket` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_paket`
--

INSERT INTO `dm_paket` (`id`, `nama_paket`, `satuan_paket`, `harga_paket`) VALUES
(13, 'Setelan Safari', 'Buah', 10000),
(14, 'Kemeja', 'Buah', 5000),
(15, 'Baju Safari', 'Buah', 7000),
(16, 'Setelan Jas', 'Buah', 15000),
(17, 'Jaket / Jas', 'Buah', 10000),
(18, 'Blus', 'Buah', 6000),
(19, 'Blazer', 'Buah', 6000),
(20, 'Setelan Blazer', 'Buah', 15000),
(21, 'Selendang', 'Buah', 5000),
(22, 'Dasi', 'Buah', 5000),
(23, 'Kebaya Pendek', 'Buah', 7000),
(24, 'Kebaya Panjang', 'Buah', 10000),
(25, 'Gaun Pendek', 'Buah', 10000),
(26, 'Gaun Panjang', 'Buah', 12000),
(27, 'Kemeja Batik', 'Buah', 6000),
(28, 'Jaket Kulit', 'Buah', 12000),
(29, 'Karpet Tipis', 'Meter', 5000),
(30, 'Karpet Tebal', 'Meter', 6000),
(31, 'Bad Cover Single', 'Buah', 10000),
(32, 'Bad Cover Double', 'Buah', 12000),
(33, 'Boneka Mini', 'Buah', 5000),
(34, 'Boneka Sedang', 'Buah', 10000),
(35, 'Boneka Besar', 'Buah', 15000),
(36, 'Gorden', 'Meter', 5000),
(37, 'Tas Kecil', 'Buah', 3000),
(38, 'Tas Besar', 'Buah', 10000),
(39, 'Sepatu', 'Buah', 10000),
(40, 'Cuci Saja', 'Kg', 6000),
(41, 'Setrika Saja', 'Kg', 5000),
(42, 'Cuci + Setrika', 'Kg', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `dm_pegawai`
--

CREATE TABLE `dm_pegawai` (
  `id` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') DEFAULT NULL,
  `telp` varchar(15) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_pegawai`
--

INSERT INTO `dm_pegawai` (`id`, `id_jabatan`, `nama`, `alamat`, `kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `telp`, `status`, `foto`) VALUES
(13, 1, 'Faiz Muhammad Syam', 'Tangerang', 'L', 'Medan', '2018-12-26', 'Islam', '0123456789', 'Aktif', '1af93042bf688f90c25f855370d9fd97.jpg'),
(22, 1, 'Admin', 'Tangerang', 'L', 'Tangerang', '2019-01-08', 'Islam', '0123456789', 'Aktif', 'e47505bc200cb6911efda8255038275c.png'),
(23, 2, 'Testing', 'Tangerang', 'L', 'Tangerang', '2019-01-08', 'Islam', '0', 'Tidak Aktif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dm_privileges`
--

CREATE TABLE `dm_privileges` (
  `id` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `urutan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_privileges`
--

INSERT INTO `dm_privileges` (`id`, `id_module`, `menu`, `url`, `icon`, `urutan`) VALUES
(1, 1, 'Jenis Pewangi', 'masterdata/jenis_pewangi', 'fa fa-flask', '4'),
(2, 1, 'Jenis Paket', 'masterdata/jenis_paket', 'fa fa-cube', '3'),
(3, 2, 'Account', 'sistem/account', 'fa fa-user', '0'),
(4, 3, 'Laundry Masuk', 'transaksi/laundry_masuk', 'fa fa-share', '1'),
(5, 3, 'Laundry Keluar', 'transaksi/laundry_keluar', 'fa fa-reply', '2'),
(6, 1, 'Pegawai', 'masterdata/pegawai', 'fa fa-users', '2'),
(7, 1, 'Customer', 'masterdata/customer', 'fa fa-users', '1'),
(8, 1, 'Jabatan', 'masterdata/jabatan', 'fa fa-briefcase', '5'),
(9, 5, 'Pembayaran', 'keuangan/pembayaran', 'fa fa-money', '0'),
(10, 5, 'Rekap Billing', 'keuangan/rekap_billing', 'fa fa-list-alt', '0'),
(11, 4, 'Buku Besar', 'laporan/buku_besar', 'fa fa-book', '0'),
(12, 4, 'Akuntansi', 'laporan/akuntansi', 'fa fa-bank', '0'),
(13, 1, 'Barang', 'masterdata/barang', 'fa fa-building', '0');

-- --------------------------------------------------------

--
-- Table structure for table `dm_transaksi`
--

CREATE TABLE `dm_transaksi` (
  `id` int(11) NOT NULL,
  `id_customer` int(25) NOT NULL,
  `nomor_transaksi` int(25) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `tanggal_ambil` datetime NOT NULL,
  `total_item` int(100) NOT NULL,
  `total_harga` double NOT NULL,
  `diskon_transaksi` double NOT NULL,
  `bayar` double NOT NULL,
  `sisa` double NOT NULL,
  `kembali` double NOT NULL,
  `lunas` enum('Belum','Lunas') NOT NULL,
  `keterangan` text NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dm_users`
--

CREATE TABLE `dm_users` (
  `id` int(11) NOT NULL,
  `id_group_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dm_users`
--

INSERT INTO `dm_users` (`id`, `id_group_users`, `username`, `password`) VALUES
(13, 6, 'faiz', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dm_admin_log`
--
ALTER TABLE `dm_admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_barang`
--
ALTER TABLE `dm_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`id_kategori`);

--
-- Indexes for table `dm_customer`
--
ALTER TABLE `dm_customer`
  ADD PRIMARY KEY (`inc`),
  ADD KEY `tanggal_daftar` (`tanggal_daftar`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `dm_detail_laundry_masuk`
--
ALTER TABLE `dm_detail_laundry_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laundry_masuk` (`id_laundry_masuk`),
  ADD KEY `id_layanan_laundry_masuk` (`id_layanan_laundry_masuk`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `dm_grant_privileges`
--
ALTER TABLE `dm_grant_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group_users` (`id_group_users`),
  ADD KEY `id_privileges` (`id_privileges`);

--
-- Indexes for table `dm_group_users`
--
ALTER TABLE `dm_group_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_jabatan`
--
ALTER TABLE `dm_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_jenis_pewangi`
--
ALTER TABLE `dm_jenis_pewangi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_kategori_barang`
--
ALTER TABLE `dm_kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_laundry_masuk`
--
ALTER TABLE `dm_laundry_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_jenis_pewangi` (`id_jenis_pewangi`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `dm_layanan_laundry_masuk`
--
ALTER TABLE `dm_layanan_laundry_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pendaftaran` (`id_laundry_masuk`),
  ADD KEY `waktu` (`waktu`);

--
-- Indexes for table `dm_log`
--
ALTER TABLE `dm_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_loker`
--
ALTER TABLE `dm_loker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_module`
--
ALTER TABLE `dm_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_paket`
--
ALTER TABLE `dm_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dm_pegawai`
--
ALTER TABLE `dm_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group_users` (`id_jabatan`);

--
-- Indexes for table `dm_privileges`
--
ALTER TABLE `dm_privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `dm_transaksi`
--
ALTER TABLE `dm_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `dm_users`
--
ALTER TABLE `dm_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_group_users` (`id_group_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dm_admin_log`
--
ALTER TABLE `dm_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dm_barang`
--
ALTER TABLE `dm_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dm_customer`
--
ALTER TABLE `dm_customer`
  MODIFY `inc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `dm_detail_laundry_masuk`
--
ALTER TABLE `dm_detail_laundry_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `dm_grant_privileges`
--
ALTER TABLE `dm_grant_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `dm_group_users`
--
ALTER TABLE `dm_group_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dm_jabatan`
--
ALTER TABLE `dm_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dm_jenis_pewangi`
--
ALTER TABLE `dm_jenis_pewangi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `dm_kategori_barang`
--
ALTER TABLE `dm_kategori_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dm_laundry_masuk`
--
ALTER TABLE `dm_laundry_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `dm_layanan_laundry_masuk`
--
ALTER TABLE `dm_layanan_laundry_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `dm_log`
--
ALTER TABLE `dm_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dm_loker`
--
ALTER TABLE `dm_loker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dm_module`
--
ALTER TABLE `dm_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dm_paket`
--
ALTER TABLE `dm_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `dm_pegawai`
--
ALTER TABLE `dm_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `dm_privileges`
--
ALTER TABLE `dm_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dm_transaksi`
--
ALTER TABLE `dm_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dm_barang`
--
ALTER TABLE `dm_barang`
  ADD CONSTRAINT `dm_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `dm_kategori_barang` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `dm_detail_laundry_masuk`
--
ALTER TABLE `dm_detail_laundry_masuk`
  ADD CONSTRAINT `dm_detail_laundry_masuk_ibfk_1` FOREIGN KEY (`id_laundry_masuk`) REFERENCES `dm_laundry_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_detail_laundry_masuk_ibfk_2` FOREIGN KEY (`id_layanan_laundry_masuk`) REFERENCES `dm_layanan_laundry_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_detail_laundry_masuk_ibfk_3` FOREIGN KEY (`id_paket`) REFERENCES `dm_paket` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `dm_grant_privileges`
--
ALTER TABLE `dm_grant_privileges`
  ADD CONSTRAINT `dm_grant_privileges_ibfk_1` FOREIGN KEY (`id_group_users`) REFERENCES `dm_group_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_grant_privileges_ibfk_2` FOREIGN KEY (`id_privileges`) REFERENCES `dm_privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dm_laundry_masuk`
--
ALTER TABLE `dm_laundry_masuk`
  ADD CONSTRAINT `dm_laundry_masuk_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `dm_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_laundry_masuk_ibfk_3` FOREIGN KEY (`id_jenis_pewangi`) REFERENCES `dm_jenis_pewangi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_laundry_masuk_ibfk_4` FOREIGN KEY (`id_customer`) REFERENCES `dm_customer` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `dm_layanan_laundry_masuk`
--
ALTER TABLE `dm_layanan_laundry_masuk`
  ADD CONSTRAINT `dm_layanan_laundry_masuk_ibfk_1` FOREIGN KEY (`id_laundry_masuk`) REFERENCES `dm_laundry_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dm_pegawai`
--
ALTER TABLE `dm_pegawai`
  ADD CONSTRAINT `dm_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `dm_jabatan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dm_privileges`
--
ALTER TABLE `dm_privileges`
  ADD CONSTRAINT `dm_privileges_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `dm_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dm_users`
--
ALTER TABLE `dm_users`
  ADD CONSTRAINT `dm_users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `dm_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dm_users_ibfk_2` FOREIGN KEY (`id_group_users`) REFERENCES `dm_group_users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
