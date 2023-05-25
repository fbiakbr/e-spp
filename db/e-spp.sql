-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 05:23 PM
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
-- Database: `e-spp`
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
(32, '::1', 'admin@smknutirto.sc.id', 1, '2023-05-25 15:20:56', 1);

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
  `kembalian` int(11) NOT NULL,
  `status_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('6120', '0000000000', 'M KHOIRUL ANAM', 7, 'PEKALONGAN', '2000-05-25', 'PEKALONGAN', '08123456789'),
('6282', '0008456784', 'AHMAD AZRIL AFIF', 6, 'PEKALONGAN', '2003-02-18', 'PEKALONGAN', '08123456789'),
('6283', '0008456718', 'ANGGELI WULAN SAFITRI', 6, 'PEKALONGAN', '2000-01-09', 'PEKALONGAN', '08123456789'),
('6284', '0008476540', 'ASSEGAF', 6, 'PEKALONGAN', '2000-04-05', 'PEKALONGAN', '08123456789'),
('6285', '0008476491', 'DEVI AZIFATUL AZMI', 6, 'PEKALONGAN', '2000-04-06', 'PEKALONGAN', '08123456789'),
('6286', '0008476419', 'DINA NOVIANA', 6, 'PEKALONGAN', '2000-04-07', 'PEKALONGAN', '08123456789'),
('6288', '0009510543', 'EMA FATIMATUZZAHRO', 6, 'PEKALONGAN', '2000-04-08', 'PEKALONGAN', '08123456789'),
('6289', '0009465386', 'FATKHUL MANAN', 6, 'PEKALONGAN', '2000-04-09', 'PEKALONGAN', '08123456789'),
('6290', '0009465395', 'M FADHIL FERDIANSYAH', 6, 'PEKALONGAN', '2000-04-10', 'PEKALONGAN', '08123456789'),
('6291', '0009531418', 'M. WILDAN ILMI', 6, 'PEKALONGAN', '2000-04-11', 'PEKALONGAN', '08123456789'),
('6292', '0000000000', 'M.ANDIKA AL FAIZIN', 6, 'PEKALONGAN', '2000-04-12', 'PEKALONGAN', '08123456789'),
('6293', '0000000000', 'M.FIKRI ARIS SETIAWAN', 6, 'PEKALONGAN', '2000-04-13', 'PEKALONGAN', '08123456789'),
('6294', '0000000000', 'M.RIZQI ALFATDILLAH', 6, 'PEKALONGAN', '2000-04-14', 'PEKALONGAN', '08123456789'),
('6295', '0000000000', 'MAULANA FAJAR RAHMAN SIDIQ', 6, 'PEKALONGAN', '2000-04-15', 'PEKALONGAN', '08123456789'),
('6296', '0000000000', 'MOHAMMAD ABDUL HALIM', 6, 'PEKALONGAN', '2000-04-16', 'PEKALONGAN', '08123456789'),
('6297', '0000000000', 'MUHAMAD IPNU FAIQ', 6, 'PEKALONGAN', '2000-04-17', 'PEKALONGAN', '08123456789'),
('6298', '0000000000', 'MUHAMMAD IQBAL SURYA ADI', 6, 'PEKALONGAN', '2000-04-18', 'PEKALONGAN', '08123456789'),
('6299', '0000000000', 'NUR HIDAYAH', 6, 'PEKALONGAN', '2000-04-19', 'PEKALONGAN', '08123456789'),
('6300', '0000000000', 'NURUL ROJAFINA', 6, 'PEKALONGAN', '2000-04-20', 'PEKALONGAN', '08123456789'),
('6301', '0000000000', 'PANJI SALMAN AL FARISI', 6, 'PEKALONGAN', '2000-04-21', 'PEKALONGAN', '08123456789'),
('6302', '0000000000', 'REVA OKTAVIA', 6, 'PEKALONGAN', '2000-04-22', 'PEKALONGAN', '08123456789'),
('6303', '0000000000', 'SASKIA RAYA WULAN', 6, 'PEKALONGAN', '2000-04-23', 'PEKALONGAN', '08123456789'),
('6304', '0000000000', 'SITI DALILAH MUSTAQIMAH', 6, 'PEKALONGAN', '2000-04-24', 'PEKALONGAN', '08123456789'),
('6305', '0000000000', 'SULISTIO NUGROHO', 6, 'PEKALONGAN', '2000-04-25', 'PEKALONGAN', '08123456789'),
('6306', '0000000000', 'TRI ISNAINI', 6, 'PEKALONGAN', '2000-04-26', 'PEKALONGAN', '08123456789'),
('6307', '0000000000', 'ACHMAD BACHRUL ULUM', 7, 'PEKALONGAN', '2000-04-29', 'PEKALONGAN', '08123456789'),
('6309', '0000000000', 'ALDO ALDINO FEBRIAN ADHA', 7, 'PEKALONGAN', '2000-04-30', 'PEKALONGAN', '08123456789'),
('6310', '0000000000', 'ARYA AGUNG PRATAMA', 7, 'PEKALONGAN', '2000-05-01', 'PEKALONGAN', '08123456789'),
('6311', '0000000000', 'AYU KURNIANINGSIH', 7, 'PEKALONGAN', '2000-05-02', 'PEKALONGAN', '08123456789'),
('6312', '0000000000', 'DINA FAZA AMALIA', 7, 'PEKALONGAN', '2000-05-03', 'PEKALONGAN', '08123456789'),
('6313', '0000000000', 'ELA SAFANA', 7, 'PEKALONGAN', '2000-05-04', 'PEKALONGAN', '08123456789'),
('6314', '0000000000', 'FAREL ALISSANAYA', 7, 'PEKALONGAN', '2000-05-05', 'PEKALONGAN', '08123456789'),
('6315', '0000000000', 'FRIZY ANANDA', 7, 'PEKALONGAN', '2000-05-06', 'PEKALONGAN', '08123456789'),
('6316', '0000000000', 'ISTIANA RISQI', 7, 'PEKALONGAN', '2000-05-07', 'PEKALONGAN', '08123456789'),
('6317', '0000000000', 'M. AUVAL HANA', 7, 'PEKALONGAN', '2000-05-08', 'PEKALONGAN', '08123456789'),
('6318', '0000000000', 'M.ALEIF FATIH', 7, 'PEKALONGAN', '2000-05-09', 'PEKALONGAN', '08123456789'),
('6319', '0000000000', 'M.ASYRIL MAULA', 7, 'PEKALONGAN', '2000-05-10', 'PEKALONGAN', '08123456789'),
('6320', '0000000000', 'M.IBROHIM', 7, 'PEKALONGAN', '2000-05-11', 'PEKALONGAN', '08123456789'),
('6321', '0000000000', 'M.TAUFIK HIDAYAT', 7, 'PEKALONGAN', '2000-05-12', 'PEKALONGAN', '08123456789'),
('6322', '0000000000', 'MOHAMAD YUDIS ALFAREZI', 7, 'PEKALONGAN', '2000-05-13', 'PEKALONGAN', '08123456789'),
('6323', '0000000000', 'MOHAMMAD NURFAHROZI', 7, 'PEKALONGAN', '2000-05-14', 'PEKALONGAN', '08123456789'),
('6324', '0000000000', 'MUHAMMAD ARJUNNAJAH', 7, 'PEKALONGAN', '2000-05-15', 'PEKALONGAN', '08123456789'),
('6325', '0000000000', 'MUHAMMAD ZAHRIE TIYYAS HABIBIE', 7, 'PEKALONGAN', '2000-05-16', 'PEKALONGAN', '08123456789'),
('6326', '0000000000', 'NURJANAH', 7, 'PEKALONGAN', '2000-05-17', 'PEKALONGAN', '08123456789'),
('6327', '0000000000', 'PUTRI ANDINI', 7, 'PEKALONGAN', '2000-05-18', 'PEKALONGAN', '08123456789'),
('6328', '0000000000', 'RINA WATI', 7, 'PEKALONGAN', '2000-05-19', 'PEKALONGAN', '08123456789'),
('6329', '0000000000', 'SAJI TRI WIJOYO', 7, 'PEKALONGAN', '2000-05-20', 'PEKALONGAN', '08123456789'),
('6330', '0000000000', 'SEPTIA IKFI TANIA', 7, 'PEKALONGAN', '2000-05-21', 'PEKALONGAN', '08123456789'),
('6331', '0000000000', 'TIWI ARINI', 7, 'PEKALONGAN', '2000-05-22', 'PEKALONGAN', '08123456789'),
('6332', '0000000000', 'YUSTIFAN ARIF HIDAYATULLAH', 7, 'PEKALONGAN', '2000-05-23', 'PEKALONGAN', '08123456789'),
('6335', '0000000000', 'NUNUNG NOVIANI', 6, 'PEKALONGAN', '2000-04-27', 'PEKALONGAN', '08123456789'),
('6337', '0000000000', 'MUHAMMAD GHOZALI', 7, 'PEKALONGAN', '2000-05-24', 'PEKALONGAN', '08123456789'),
('6340', '0000000000', 'NASRUL ANNAM', 6, 'PEKALONGAN', '2000-04-28', 'PEKALONGAN', '08123456789'),
('6342', '0000000000', 'VITA NABILA', 7, 'PEKALONGAN', '2000-05-26', 'PEKALONGAN', '08123456789');

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
(1, 'admin@smknutirto.sc.id', 'admin', '$2y$10$WQCXRbPYaJ1s00QGNw2skuqIPGYttX3dTI80cEwyZKUPVpuajfmJK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-16 06:05:16', '2023-05-16 06:05:16', NULL);

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
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
