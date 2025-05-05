-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 09:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujian_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_a` varchar(255) NOT NULL,
  `pilihan_b` varchar(255) NOT NULL,
  `pilihan_c` varchar(255) NOT NULL,
  `pilihan_d` varchar(255) NOT NULL,
  `jawaban_benar` char(1) NOT NULL,
  `alasan_jawaban` text DEFAULT NULL,
  `kategori` varchar(50) DEFAULT 'Umum',
  `level` enum('Mudah','Menengah','Sulit') DEFAULT 'Mudah',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban_benar`, `alasan_jawaban`, `kategori`, `level`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Apa ibu kota Indonesia?', 'Surabaya', 'Bandung', 'Jakarta', 'Yogyakarta', 'C', 'Jakarta adalah ibu kota Indonesia berdasarkan keputusan pemerintah.', 'Geografi', 'Mudah', NULL, '2025-05-05 07:03:52', '2025-05-05 07:03:52'),
(2, 'Siapa penemu telepon?', 'Nikola Tesla', 'Alexander Graham Bell', 'Thomas Edison', 'Albert Einstein', 'B', 'Alexander Graham Bell dikenal sebagai penemu telepon pertama yang berhasil.', 'Ilmu Pengetahuan', 'Mudah', 'gambar_telepon.jpg', '2025-05-05 07:03:52', '2025-05-05 07:03:52'),
(3, 'Apa yang dimaksud dengan gravitasi?', 'Gaya tarik benda ke bumi', 'Gaya yang mempengaruhi suhu', 'Gaya yang membuat benda bergerak', 'Gaya yang menyebabkan benda melayang', 'A', 'Gravitasi adalah gaya tarik bumi terhadap benda yang ada di permukaannya.', 'Fisika', 'Menengah', NULL, '2025-05-05 07:03:52', '2025-05-05 07:03:52'),
(4, 'Hidup Jokowi', 'Hidup Jokowi', 'Hidup Jokowia', 'Hidup Jokowib', 'Hidup Jokowic', 'C', 'Hidup Jokowib', 'Umum', 'Mudah', NULL, '2025-05-05 07:11:33', '2025-05-05 07:11:33'),
(5, 'WI WOK DE  TOK NOT ONLE TOK DE TOK', 'S2 RILL', 'S2 PALSU', 'S2 ILMU PENGETAHUAN', 'S22AN', 'A', 'WI WOK DE TOK NOT ONLE TOK DE TOK', 'MEME', 'Mudah', NULL, '2025-05-05 07:16:00', '2025-05-05 07:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(24) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `create_at`, `update_at`) VALUES
(1, 'ajimaulana', 'rahasia89', 'user', '2025-05-05 06:53:10', '2025-05-05 06:53:10'),
(2, 'bayu', 'rahasia', 'user', '2025-05-05 06:53:34', '2025-05-05 06:53:34'),
(3, 'admin', 'admin', 'admin', '2025-05-05 06:57:44', '2025-05-05 06:57:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
