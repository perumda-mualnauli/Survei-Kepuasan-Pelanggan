-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2025 pada 11.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_survei`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aduan`
--

CREATE TABLE `aduan` (
  `id_aduan` varchar(20) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `prioritas` enum('Penting','Biasa') NOT NULL DEFAULT 'Biasa',
  `pesan` text NOT NULL,
  `pelapor` varchar(100) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `status` enum('Pending','Selesai') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aduan`
--

INSERT INTO `aduan` (`id_aduan`, `id_pelanggan`, `nama`, `alamat`, `no_telp`, `prioritas`, `pesan`, `pelapor`, `nomor_hp`, `status`, `created_at`, `updated_at`, `rating`, `comment`) VALUES
('106993#', '1601140050', 'MEI WARSIH SINAGA', 'ABDULLAH SYUKUR', '082267903164', 'Penting', 'Air Tidak Mengalir', 'MEI WARSIH SINAGA', '082267903164', 'Pending', '2024-12-20 08:18:20', '2025-01-09 03:34:25', 4, 'contoh lagi'),
('107083#', '1601090004', 'MUHAMMAD SOFYAN, S.SOS', 'KH.DEWANTARA ', '6281361133301', 'Penting', ' Kebocoran Pipa Dinas', 'MUHAMMAD SOFYAN', '6281361133301', 'Pending', '2024-12-20 07:40:10', '2025-01-09 03:40:41', 1, 'ALLAH SWT'),
('107084#', '1603070055', 'ANDRA WANDI PANGGABEAN - 1', 'JEND.MARADEN PANGGABEAN ', '6285135868417', 'Penting', 'KEBOCORAN PIPA DINAS', 'ANDRA WANDI', '6285135868417', 'Pending', '2024-12-20 08:20:41', '2025-01-09 03:22:38', 5, 'sesekali'),
('107145#', '0301006017', 'RESMINA SILITONGA', '', '', 'Biasa', '', '', '', 'Pending', '2025-01-09 09:42:04', '2025-01-09 09:48:24', 2, 'asd'),
('107323#', '1601010913', 'NADIR SIMATUPANG', '', '', 'Biasa', '', '', '', 'Pending', '2025-01-09 09:49:45', '2025-01-09 09:51:37', 1, ' Air Mati'),
('107333#', '1601220091', 'AZWAR CANIAGO - II', '', '', 'Biasa', '', '', '', 'Pending', '2025-01-09 09:53:29', '2025-01-09 09:53:29', 2, 'LAKSAMANA M.NAPITUPULU '),
('12312321#', '09802391283', 'asdsadasd', '', '', 'Biasa', '', '', '', 'Pending', '2025-01-09 09:53:49', '2025-01-09 09:53:49', 2, 'adasdasd'),
('123407145#', '#234234', 'aku kamu', '', '', 'Biasa', '', '', '', '', '2025-01-09 10:10:01', '2025-01-09 10:10:01', 1, 'sdfsdf'),
('345345#', '#90i09809342', 'sdfsdf ', '', '', 'Biasa', '', '', '', 'Pending', '2025-01-09 09:57:09', '2025-01-09 09:57:09', 3, 'sdfsdf');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aduan`
--
ALTER TABLE `aduan`
  ADD PRIMARY KEY (`id_aduan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
