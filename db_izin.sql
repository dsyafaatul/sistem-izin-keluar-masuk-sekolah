-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jan 2019 pada 04.27
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_izin`
--
CREATE DATABASE IF NOT EXISTS `db_izin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_izin`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `level` enum('admin','operator') COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'operator', '4b583376b2767b923c3e1da60d10de59', 'operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(11) NOT NULL,
  `id_kode` int(11) NOT NULL,
  `nis` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nis2` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_keluar` time NOT NULL,
  `waktu_masuk` time NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','T') COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `izin`
--

INSERT INTO `izin` (`id_izin`, `id_kode`, `nis`, `nis2`, `tanggal`, `waktu_keluar`, `waktu_masuk`, `keterangan`, `status`) VALUES
(1, 1, '10160312', '', '2018-10-31', '08:00:00', '00:00:00', 'Makan Cilor', 'T'),
(3, 1, '10160313', '', '2018-10-30', '07:00:00', '00:00:00', 'FotoCopy KTP', 'T'),
(4, 1, '10160316', '', '2018-11-01', '21:04:43', '00:00:00', 'beli pulpen', 'T'),
(5, 1, '10160312', '', '2018-11-06', '08:27:58', '08:31:36', '-', 'Y'),
(6, 10, '10160337', '', '2019-01-16', '08:37:49', '08:41:15', 'fotocopy', 'Y'),
(11, 4, '10160331', '10160330', '2019-01-17', '14:13:36', '14:15:27', 'Fotocopy ke Reza', 'Y'),
(12, 4, '10160331', '10160333', '2019-01-17', '14:18:33', '14:19:22', 'NGAMBIL BAJU DI RUMAH', 'Y'),
(13, 4, '10160339', '-', '2019-01-17', '14:21:59', '14:22:24', 'JAJAN', 'Y'),
(14, 4, '10160331', '-', '2019-01-18', '07:14:00', '07:14:22', 'Fotocopy', 'Y'),
(15, 4, '10160335', '-', '2019-01-18', '07:52:34', '07:53:24', 'fotocopy Ke Reza Fotocopy', 'Y'),
(16, 4, '10160332', '-', '2019-01-18', '07:56:42', '08:01:42', 'fotocopy', 'Y'),
(17, 4, '10160335', '123312', '2019-01-18', '08:02:41', '08:02:50', 'legalisir ke smp 1', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '10 RPL 1'),
(2, '10 RPL 2'),
(3, '10 TKJ 1'),
(4, '10 TKJ 2'),
(5, '10 TP 1'),
(6, '10 TP 2'),
(7, '10 TP 3'),
(8, '10 TKR 1'),
(9, '10 TKR 2'),
(10, '10 TKR 3'),
(11, '10 TKR 4'),
(12, '10 TKR 5'),
(13, '10 TITL'),
(14, '10 TAV'),
(15, '11 RPL'),
(16, '11 TKJ 1'),
(17, '11 TKJ 2'),
(18, '11 TP 1'),
(19, '11 TP 2'),
(20, '11 TP 3'),
(21, '11 TKR 1'),
(22, '11 TKR 2'),
(23, '11 TKR 3'),
(24, '11 TKR 4'),
(25, '11 TKR 5'),
(26, '11 TITL'),
(27, '11 TAV'),
(28, '12 RPL'),
(29, '12 TKJ'),
(30, '12 TP 1'),
(31, '12 TP 2'),
(32, '12 TP 3'),
(33, '12 TKR 1'),
(34, '12 TKR 2'),
(35, '12 TKR 3'),
(36, '12 TKR 4'),
(37, '12 TKR 5'),
(38, '12 TITL'),
(39, '12 TAV');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode`
--

CREATE TABLE `kode` (
  `id_kode` int(11) NOT NULL,
  `kode` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `kode`
--

INSERT INTO `kode` (`id_kode`, `kode`) VALUES
(4, '0003206862'),
(3, '0003364507'),
(10, '0003432154'),
(1, '12345531601200'),
(2, '12345677097096');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_siswa` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE latin1_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `id_kelas`, `jenis_kelamin`, `no_hp`) VALUES
(1, '10160312', 'Aef Supardi', 28, 'L', '-'),
(2, '10160313', 'Anna Siti Hasanah', 28, 'P', '-'),
(3, '10160314', 'Asri Nurul Hayati', 28, 'P', '-'),
(4, '10160315', 'Ayu Rosdiana', 28, 'P', '-'),
(5, '10160316', 'D.Syafaatul Anbiya', 28, 'L', '-'),
(6, '10160317', 'Depi Meliyani', 28, 'P', '-'),
(7, '10160318', 'Dewi Sri Mulyati', 28, 'P', '-'),
(8, '10160319', 'Diana Julianti', 28, 'P', '-'),
(9, '10160321', 'Fajar Jahada Purnama', 28, 'L', '-'),
(10, '10160322', 'Fuji Utama Rachmalia', 28, 'P', '-'),
(11, '10160323', 'Hani Yuliani', 28, 'P', '-'),
(12, '10160324', 'Indriani', 28, 'P', '-'),
(13, '10160325', 'Ira Erlina', 28, 'P', '-'),
(14, '10160326', 'Ira Mirani', 28, 'P', '-'),
(15, '10160327', 'Kartimah', 28, 'P', '-'),
(16, '10160328', 'Mirnawati Dewi', 28, 'P', '-'),
(17, '10160329', 'Nandi Septiadi', 28, 'L', '-'),
(18, '10160330', 'Neni Setiani', 28, 'P', '-'),
(19, '10160331', 'Nisa Ratna Dila', 28, 'P', '-'),
(20, '10160332', 'Ocatavia Fitria Rahayu', 28, 'P', '-'),
(21, '10160333', 'Pitri Kholifah', 28, 'P', '-'),
(22, '10160334', 'Rahman Hidayat', 28, 'L', '-'),
(23, '10160335', 'Rai Fachry Ardilean', 28, 'L', '-'),
(24, '10160336', 'Rani Nurlina Rohmah', 28, 'P', '-'),
(25, '10160337', 'Rena Senja Oktafia', 28, 'P', '-'),
(26, '10160338', 'Rima Sukmawati', 28, 'P', '-'),
(27, '10160339', 'Robiatul Adawiah', 28, 'P', '-'),
(28, '10160340', 'Susi Susanti', 28, 'P', '-'),
(29, '101603441', 'Tia Listiani', 28, 'P', '-'),
(30, '10160342', 'Viany Sri Dewi Yulianti', 28, 'P', '-'),
(31, '123312', 'Saha wae', 8, 'L', '0856484564875');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kode` (`id_kode`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kode`
--
ALTER TABLE `kode`
  ADD PRIMARY KEY (`id_kode`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kode`
--
ALTER TABLE `kode`
  MODIFY `id_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `izin`
--
ALTER TABLE `izin`
  ADD CONSTRAINT `izin_ibfk_1` FOREIGN KEY (`id_kode`) REFERENCES `kode` (`id_kode`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `izin_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
