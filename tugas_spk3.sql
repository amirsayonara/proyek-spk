-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Des 2019 pada 13.36
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_spk3`
--

DROP DATABASE IF EXISTS tugas_spk3;
CREATE DATABASE IF NOT EXISTS tugas_spk3;
USE tugas_spk3;

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nama` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`) VALUES
(530, 'Api Alam Konang'),
(531, 'Gunung Geger'),
(532, 'Kerapan Sapi'),
(533, 'Kolla Langgundih'),
(534, 'Makam Air Mata Ibu'),
(535, 'Makam Sultan Abdul Kadirun'),
(536, 'Makam Syeichona Cholil'),
(537, 'Mercusuar'),
(538, 'Museum Bangkalan'),
(539, 'Pantai Maneron'),
(540, 'Pantai Rongkang'),
(541, 'Pantai Siring Kemuning'),
(542, 'Taman Rekreasi Kota'),
(543, 'Bukit Kapur Jaddih'),
(544, 'Pelalangan'),
(545, 'Hutan Mangrove Kec, Sepuluh'),
(546, 'Makam Sunan Cendana'),
(547, 'Air Terjun Bidadari Dhurjan'),
(548, 'Air Terjun Kec, Galis'),
(549, 'Pantai Anyar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `atribut`
--

CREATE TABLE `atribut` (
  `id` int(11) NOT NULL,
  `nama` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `atribut`
--

INSERT INTO `atribut` (`id`, `nama`) VALUES
(1, 'Benefit'),
(2, 'Cost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `kriteria_1` int(11) NOT NULL,
  `kriteria_2` int(11) NOT NULL,
  `bobot` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`kriteria_1`, `kriteria_2`, `bobot`) VALUES
(26, 27, '3/1'),
(26, 28, '1/3'),
(27, 28, '1/5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` char(50) DEFAULT NULL,
  `atribut` int(11) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `atribut`, `bobot`) VALUES
(26, 'Pengunjung', 1, 0.26049795615013),
(27, 'Jarak', 2, 0.10615632354763),
(28, 'Rating', 1, 0.63334572030224);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `keterangan` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `keterangan`) VALUES
(0, 'Admin'),
(1, 'Petugas'),
(2, 'Pakar/Ahli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `id` char(36) NOT NULL,
  `pengguna` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`id`, `pengguna`) VALUES
('b7c4bc0d-0d8c-11ea-aaea-7a1b192e9b80', 'admin'),
('bbe771ad-0ab3-11ea-a4b9-68ccc88749d6', 'pakar'),
('4cc65a27-0cd6-11ea-8941-87bc1a4d341c', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `alternatif` int(11) DEFAULT NULL,
  `kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`alternatif`, `kriteria`, `nilai`) VALUES
(530, 26, 2301),
(530, 27, 90),
(530, 28, 3.9),
(531, 26, 3236),
(531, 27, 35),
(531, 28, 4.1),
(532, 26, 1950),
(532, 27, 2.3),
(532, 28, 4.1),
(533, 26, 978),
(533, 27, 5.5),
(533, 28, 4.3),
(534, 26, 626016),
(534, 27, 15),
(534, 28, 4.2),
(535, 26, 46452),
(535, 27, 0.5),
(535, 28, 4),
(536, 26, 607680),
(536, 27, 2),
(536, 28, 4.7),
(537, 26, 1606),
(537, 27, 9),
(537, 28, 4.1),
(538, 26, 844),
(538, 27, 2.5),
(538, 28, 4),
(539, 26, 1892),
(539, 27, 42),
(539, 28, 3.7),
(540, 26, 1538),
(540, 27, 30),
(540, 28, 3.4),
(541, 26, 11499),
(541, 27, 42),
(541, 28, 3.9),
(542, 26, 29862),
(542, 27, 2),
(542, 28, 4.1),
(543, 26, 4767),
(543, 27, 9.7),
(543, 28, 4),
(544, 26, 969),
(544, 27, 17),
(544, 28, 4.2),
(545, 26, 1217),
(545, 27, 35),
(545, 28, 4.1),
(546, 26, 979),
(546, 27, 30),
(546, 28, 4.4),
(547, 26, 1750),
(547, 27, 60),
(547, 28, 4.2),
(548, 26, 2045),
(548, 27, 31),
(548, 28, 3.6),
(549, 26, 1558),
(549, 27, 48),
(549, 28, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` char(50) NOT NULL,
  `password` char(64) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `nama` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `level`, `nama`) VALUES
('admin', SHA2('admin', 0), 0, 'Rahma Nur Layla Sari'),
('amir', SHA2('amir', 0), 1, 'Moch. Amir'),
('pakar', SHA2('pakar', 0), 2, 'Natiq Hasbi Alim'),
('petugas', SHA2('petugas', 0), 1, 'Rachmad Agung Pambudi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `atribut`
--
ALTER TABLE `atribut`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD KEY `kriteria_1` (`kriteria_1`),
  ADD KEY `kriteria_2` (`kriteria_2`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_ibfk_1` (`atribut`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masuk_ibfk_1` (`pengguna`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD KEY `alternatif` (`alternatif`),
  ADD KEY `kriteria` (`kriteria`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=550;

--
-- AUTO_INCREMENT untuk tabel `atribut`
--
ALTER TABLE `atribut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`kriteria_1`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`kriteria_2`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`atribut`) REFERENCES `atribut` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`pengguna`) REFERENCES `pengguna` (`username`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`alternatif`) REFERENCES `alternatif` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`kriteria`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
