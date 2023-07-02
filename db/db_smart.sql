-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 10:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'a', NULL, '2023-05-16 06:15:30', 0),
(2, '::1', 'admin', NULL, '2023-05-16 06:15:37', 0),
(3, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:15:49', 1),
(4, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:19:42', 1),
(5, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:20:08', 1),
(6, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:21:22', 1),
(7, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:24:34', 1),
(8, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:28:34', 1),
(9, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:29:02', 1),
(10, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:30:23', 1),
(11, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:32:25', 1),
(12, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:34:21', 1),
(13, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:35:04', 1),
(14, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:35:40', 1),
(15, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:37:16', 1),
(16, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:38:40', 1),
(17, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:39:09', 1),
(18, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:42:01', 1),
(19, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:46:10', 1),
(20, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:51:29', 1),
(21, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:51:48', 1),
(22, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:53:07', 1),
(23, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-16 06:53:37', 1),
(24, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-17 03:11:22', 1),
(25, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-17 03:11:46', 1),
(26, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-19 08:16:18', 1),
(27, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-19 09:56:30', 1),
(28, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-20 09:00:32', 1),
(29, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-20 10:24:45', 1),
(30, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-22 09:04:56', 1),
(31, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-25 08:39:52', 1),
(32, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-25 15:20:56', 1),
(33, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-25 17:06:53', 1),
(34, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-27 11:40:32', 1),
(35, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-29 17:35:35', 1),
(36, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-30 01:05:16', 1),
(37, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-30 02:17:11', 1),
(38, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-30 03:14:45', 1),
(39, '127.0.0.1', 'admin', NULL, '2023-05-30 03:15:12', 0),
(40, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-30 03:15:18', 1),
(41, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-30 03:16:32', 1),
(42, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-30 07:53:58', 1),
(43, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-30 09:03:24', 1),
(44, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-30 09:36:29', 1),
(45, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-30 09:36:53', 1),
(46, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-31 03:58:22', 1),
(47, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-31 04:02:13', 1),
(48, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-05-31 04:04:51', 1),
(49, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-31 04:26:50', 1),
(50, '192.168.10.160', 'admin@smknutirto.sc.id', 1, '2023-05-31 05:00:51', 1),
(51, '192.168.10.230', 'admin@smknutirto.sc.id', 1, '2023-05-31 05:07:21', 1),
(52, '192.168.10.160', 'admin@smknutirto.sc.id', 1, '2023-05-31 05:12:20', 1),
(53, '192.168.10.160', 'admin2@smknutirto.sch.id', 3, '2023-05-31 05:26:50', 1),
(54, '192.168.10.160', 'admin@smknutirto.sc.id', 1, '2023-05-31 05:31:18', 1),
(55, '192.168.10.230', 'admin2@smknutirto.sch.id', 3, '2023-05-31 06:02:35', 1),
(56, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-05-31 06:37:48', 1),
(57, '::1', 'admin2@smknutirto.sch.id', 3, '2023-05-31 06:38:41', 1),
(58, '127.0.0.1', 'admin4', NULL, '2023-06-07 04:01:53', 0),
(59, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-06-07 04:02:00', 1),
(60, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-07 04:02:16', 1),
(61, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-07 09:02:42', 1),
(62, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-07 10:42:33', 1),
(63, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 05:31:14', 1),
(64, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-06-12 05:38:33', 1),
(65, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 05:41:39', 1),
(66, '127.0.0.1', 'admin2@smknutirto.sch.id', 3, '2023-06-12 07:29:42', 1),
(67, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 10:39:30', 1),
(68, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 11:31:28', 1),
(69, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 11:33:00', 1),
(70, '127.0.0.1', 'admin@smknutirto.sc.id', 1, '2023-06-12 22:40:53', 1),
(71, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-12 23:38:13', 1),
(72, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 06:05:07', 1),
(73, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 11:50:09', 1),
(74, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 12:43:17', 1),
(75, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 12:48:51', 1),
(76, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 13:01:53', 1),
(77, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 13:02:16', 1),
(78, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 13:04:46', 1),
(79, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 13:05:04', 1),
(80, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 14:22:08', 1),
(81, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 14:23:05', 1),
(82, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 14:27:57', 1),
(83, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-13 14:33:35', 1),
(84, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-14 00:09:36', 1),
(85, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-20 15:06:11', 1),
(86, '::1', 'admin2@smknutirto.sch.id', 3, '2023-06-20 15:09:47', 1),
(87, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-20 15:19:14', 1),
(88, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-20 16:20:12', 1),
(89, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-21 04:13:25', 1),
(90, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-21 04:56:24', 1),
(91, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-21 04:58:29', 1),
(92, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-21 05:00:16', 1),
(93, '192.168.10.155', 'admin@smknutirto.sc.id', 1, '2023-06-21 05:32:24', 1),
(94, '192.168.10.155', 'admin@smknutirto.sc.id', 1, '2023-06-21 05:32:49', 1),
(95, '192.168.10.155', 'admin@smknutirto.sc.id', 1, '2023-06-21 05:35:42', 1),
(96, '192.168.10.155', 'admin@smknutirto.sc.id', 1, '2023-06-21 05:38:05', 1),
(97, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-24 06:32:28', 1),
(98, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-24 06:34:22', 1),
(99, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-24 06:35:49', 1),
(100, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-24 06:45:52', 1),
(101, '::1', 'admin', NULL, '2023-06-24 11:45:07', 0),
(102, '::1', 'admin@smknutirto.sc.id', 1, '2023-06-24 11:45:18', 1),
(103, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-01 10:14:34', 1),
(104, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-01 10:15:23', 1),
(105, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-01 10:17:18', 1),
(106, '::1', 'admin', NULL, '2023-07-02 07:45:58', 0),
(107, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-02 07:46:02', 1),
(108, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-02 08:10:15', 1),
(109, '::1', 'admin@smknutirto.sc.id', 1, '2023-07-02 08:10:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `tagihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `tagihan`) VALUES
(1, 'X TJKT 1', 120000),
(2, 'X TJKT 2', 120000),
(5, 'X TJKT 3', 120000),
(6, 'XI TJKT 1', 110000),
(7, 'XI TJKT 2', 110000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1684215885, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` date NOT NULL,
  `jam` time NOT NULL,
  `nis` varchar(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tgl_pemasukan`, `jam`, `nis`, `nama_siswa`, `kelas`, `jumlah`, `keterangan`) VALUES
(59, '2023-07-02', '15:07:39', '6282', 'AHMAD AZRIL AFIF', 'XI TJKT 1', 200000, 'ISI SALDO');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jam` time NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `sisa_tagihan` int(11) NOT NULL,
  `status_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jam` time NOT NULL,
  `nis` varchar(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tgl_pengeluaran`, `jam`, `nis`, `nama_siswa`, `kelas`, `jumlah`, `keterangan`) VALUES
(62, '2023-07-02', '15:08:06', '6282', 'AHMAD AZRIL AFIF', 'XI TJKT 1', 200000, 'PENARIKAN SALDO');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `nis` varchar(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `nis`, `saldo`) VALUES
(9, '6290', 0),
(10, '6291', 0),
(11, '6282', 0),
(12, '6289', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(11) NOT NULL,
  `rfid` varchar(20) NOT NULL DEFAULT '0000000000',
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `rfid`, `nama_siswa`, `kelas`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`) VALUES
('6282', '0008456784', 'AHMAD AZRIL AFIF', 6, 'PEKALONGAN', '2003-02-18', 'PEKALONGAN', '08123456789'),
('6289', '0009465386', 'FATKHUL MANAN', 6, 'PEKALONGAN', '2000-04-09', 'PEKALONGAN', '08123456789'),
('6290', '0009465395', 'M FADHIL FERDIANSYAH', 6, 'PEKALONGAN', '2000-04-10', 'PEKALONGAN', '08123456789'),
('6291', '0009531418', 'M. WILDAN ILMI', 6, 'PEKALONGAN', '2000-04-11', 'PEKALONGAN', '08123456789');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@smknutirto.sc.id', 'admin', '$2y$10$WQCXRbPYaJ1s00QGNw2skuqIPGYttX3dTI80cEwyZKUPVpuajfmJK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-16 06:05:16', '2023-05-16 06:05:16', NULL),
(3, 'admin2@smknutirto.sch.id', 'admin2', '$2y$10$miuWeouGsbMhg6O1taNiNeO49AYVtxbr.E6KNt7iyRaYkvN8yaDv6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-30 02:59:19', '2023-05-30 02:59:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
