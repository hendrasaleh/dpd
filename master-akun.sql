-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2021 pada 04.52
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
-- Database: `akunhk2`
--

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
(3, 'Menu', 2),
(4, 'Kurikulum', 4),
(6, 'Hotel', 5),
(7, 'Layanan', 6);

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
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Admin Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 4, 'Report List', 'kurikulum', 'fas fa-fw fa-file-upload', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(9, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(11, 1, 'User Management', 'admin/users', 'fas fa-fw fa-users', 1),
(12, 2, 'Upload Raport', 'user/grouplist', 'fas fa-fw fa-upload', 1),
(13, 4, 'User Assignment', 'kurikulum/users', 'fas fa-fw fa-edit', 1),
(14, 6, 'Hotel Dashboard', 'hotel', 'fas fa-fw fa-hotel', 1),
(15, 6, 'Daftar Tamu', 'hotel/tamu', 'fas fa-fw fa-suitcase', 1),
(16, 6, 'Manajemen Kamar', 'hotel/tipekamar', 'fas fa-fw fa-bed', 1),
(17, 6, 'Daftar Kamar', 'hotel/kamar', 'fas fa-fw fa-bed', 1),
(18, 7, 'Booking Kamar', 'layanan', 'fas fa-fw fa-book', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
