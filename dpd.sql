-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2021 pada 11.38
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET utf8 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL,
  `timestamp` int(10) UNSIGNED DEFAULT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('i9fmg5nas9idhfgk8iqtr5j64dg8anou', '::1', 1614147849, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343134373834393b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('c39s4hsi9qeddrm2l42jat8ro1rjh5pe', '::1', 1614148359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343134383335393b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('kplptc38lhi4a98h26dg7rr4h7jas5eb', '::1', 1614160165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136303136353b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('llipsm5ca8ir14a04e06jhcpcuqjatmi', '::1', 1614160687, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136303638373b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('h4jhos0h50jl905t8jma7pm9vlu737vj', '::1', 1614161058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136313035383b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('8d766h90eld0j9k1piuh9u180b6docp6', '::1', 1614161369, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136313336393b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('9kaoe6jj3gg4usocqa3kqbgbhq3qa4v3', '::1', 1614161708, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136313730383b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('bjv5atgmumvj3rmf7hpn5qu1a0vs1t32', '::1', 1614162304, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136323330343b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('qrtvmc2rpj855todqbgpro7tbqkli2kc', '::1', 1614162622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136323632323b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('0rluctrdjknngk0dc8shh94iv0snc1s5', '::1', 1614163018, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136333031383b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b),
('2r3jhcs2vqphj9qfvra7p06j925v7do3', '::1', 1614163055, 0x5f5f63695f6c6173745f726567656e65726174657c693a313631343136333031383b656d61696c7c733a32313a2268656e64726173616c656840676d61696c2e636f6d223b726f6c655f69647c733a313a2231223b6d6573736167657c733a36383a223c64697620636c6173733d22616c65727420616c6572742d737563636573732220726f6c653d22616c657274223e205375626d656e7520656469746564213c2f6469763e223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `date_modified`) VALUES
(2, 'Dede Maryam', 'maryam@gmail.com', 'bk.png', '$2y$10$QdDDNq7mOJ/xWhhs.5a92..uJkeixQhPHa3ESKNj/WWP3orgnkCfC', 4, 1, 1597107848, 1609858884),
(8, 'Hendra Karunia A., Lc., M.H.', 'hendrasaleh@gmail.com', 'Foto_Formal_(2).jpg', '$2y$10$XBnbQw2g779dEooZOYU1Bu61sWc8oc0jnurJfPlfua5Lf3K5RuFs6', 1, 1, 1607950063, 1609840824),
(9, 'Admin 1', 'role1@excellenz.id', 'default.jpg', '$2y$10$ff9laJc1dU0DpIaeUQje1.gWa/fabmBS/bu0.yJYj9tU00k7KgKaG', 3, 1, 1608127461, 1608127461),
(10, 'Admin 2', 'role2@excellenz.id', 'default.jpg', '$2y$10$lkIzuxx5CgsSHy2kav20duoFaIaRwlXkZMuSGzvvSGAZ8kJhvyqc6', 3, 1, 1608127490, 1608127490),
(11, 'Admin 3', 'role3@excellenz.id', 'default.jpg', '$2y$10$GD7BLJRZlQLKwOER7/4IdOWrVALo5hwbVfgEHQbr9MgrqQ5tJAapq', 3, 1, 1608127517, 1608127517),
(12, 'Admin 4', 'role4@excellenz.id', 'default.jpg', '$2y$10$bGUgKAUOlAGcA5Jdd0bXgeuj6Bwev5wvV6DQVve2dFOJ6Hg/tQKkm', 3, 1, 1608127542, 1608127542),
(13, 'Admin 5', 'role5@excellenz.id', 'default.jpg', '$2y$10$E1axIWEJtmEKr7sdKm4FX.JDAvNEwYvXjQ.kb8r8SXjRocBGGpGju', 3, 1, 1608127569, 1608127569),
(14, 'Admin 6', 'role6@excellenz.id', 'default.jpg', '$2y$10$KruL2qfm6hemkHNtxAJ3ReFsw2FMy/.2ola.ikZRls1F4Cgushh3W', 3, 1, 1608127592, 1608127592),
(15, 'Admin 7', 'role7@excellenz.id', 'default.jpg', '$2y$10$vrvtLquycIaK1KMaZB.AlOOk83hxO2KGpYKL2pul7EcJZfBtcGcc.', 3, 1, 1608127617, 1608127617),
(17, 'Kurikulum', 'admin@excellenz.id', 'default.jpg', '$2y$10$azpVXjABJDywAIoSrqOQMuDViJAtICMx.lYnxOXN5SihP.uFllZRu', 2, 1, 1608256025, 1609849156);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(6, 3, 2),
(8, 2, 4),
(9, 1, 4),
(10, 1, 6),
(11, 4, 2),
(12, 4, 6),
(13, 1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `sequence`) VALUES
(1, 'Admin', 1),
(2, 'User', 3),
(3, 'Menu', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Kurikulum'),
(3, 'Member'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `submenu_sequence` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `submenu_sequence`, `is_active`) VALUES
(1, 1, 'Admin Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1, 1),
(2, 2, 'My Profile', 'user/profile', 'fas fa-fw fa-user', 0, 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 0, 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 0, 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 0, 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 2, 1),
(9, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 0, 1),
(11, 1, 'User Management', 'admin/users', 'fas fa-fw fa-users', 3, 1),
(19, 2, 'User Dashboard', 'user', 'fas fa-fw fa-tachometer-alt', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
