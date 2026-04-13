-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 13 Apr 2026 pada 16.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@klinik.com', '$2y$10$eImiSW68Fv/3qL.S7vV.7e9fVf.BvO/jKxYh.TzG/6V5Xj.z.G.yW', 'admin'),
(2, 'user1', 'test1@gmail.com', '$2y$10$4ILTO4aOibrfwZA4w5I/a.Ibl/VhZ5drc2Ns/DF4/I8EFQ.ieyxzO', 'user'),
(3, 'admin1', 'admintest1@gmail.com', '$2y$10$9sHOGZRfrSiwBrB.KX632elLFSZ00YIEX7ZM30ZZ8hEkvWhQ7iuEO', 'user'),
(4, 'admin1', 'admintest1@gmail.com', '$2y$10$AX9yMROLruteYIG9FQCgt.uBxk2THd8WxXcv0eWRLjffLYVxn81Ia', 'admin'),
(5, 'admin2', 'admin2@gmail.com', '$2y$10$oiWy4Af8IhuVqp7kYI4GUeW3I1s5plch.pIFvBcQkq1bTOjYwrdym', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
