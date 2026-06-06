-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2026 pada 11.34
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
-- Database: `laboratorium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `ID_Alat` varchar(10) NOT NULL,
  `ID_Ruangan` varchar(10) NOT NULL,
  `Nama_Alat` varchar(100) DEFAULT NULL,
  `Kondisi` varchar(20) DEFAULT NULL,
  `Jumlah_Alat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`ID_Alat`, `ID_Ruangan`, `Nama_Alat`, `Kondisi`, `Jumlah_Alat`) VALUES
('A01', 'R01', 'PLC Scheneider', 'Baik', 11),
('A02', 'R01', 'Modul Sensor Suhu RTD', 'Baik', 15),
('A03', 'R02', 'Oscilloscope Digital', 'Baik', 12),
('A04', 'R02', 'Function Generator', 'Baik', 12),
('A05', 'R03', 'DC Power Supply Regulated', 'Baik', 20),
('A06', 'R03', 'Digital Multimeter', 'Baik', 12),
('A07', 'R01', 'Analog Multimeter', 'Baik', 24),
('A08', 'R04', 'Modul Pressure Transmitter', 'Rusak', 5),
('A09', 'R03', 'Solder Station', 'Baik', 15),
('A10', 'R02', 'IC Op-Amp', 'Baik', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(15) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Jenis_Kelamin` varchar(20) DEFAULT NULL,
  `Nomor_HP` varchar(20) DEFAULT NULL,
  `Kode_MK` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `Nama`, `Jenis_Kelamin`, `Nomor_HP`, `Kode_MK`) VALUES
('21010104', 'Dedi Wijaya', 'Laki-laki', '81456789012', 'MK04'),
('21010108', 'Hendra Kusuma', 'Laki-laki', '81890123456', 'MK04'),
('21010110', 'Jaka Tingkir', 'Laki-laki', '81212345678', 'MK04'),
('21010555', 'Fahmy Islamy', 'Laki-laki', '81567895555', 'MKO1'),
('22010101', 'Ahmad Fauzi', 'Laki-laki', '81234567890', 'MK01'),
('22010102', 'Budi Santoso', 'Laki-laki', '81234567891', 'MK02'),
('22010105', 'Eka Putri', 'Perempuan', '81567890123', 'MK01'),
('22010106', 'Fajar Ramadhan', 'Laki-laki', '81678901234', 'MK02'),
('23010103', 'Citra Lestari', 'Perempuan', '81345678901', 'MK03'),
('23010107', 'Gita Permata', 'Perempuan', '81789012345', 'MK03'),
('23010109', 'Indah Cahyani', 'Perempuan', '81901234567', 'MK03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `Kode_MK` varchar(10) NOT NULL,
  `Nama_MK` varchar(100) DEFAULT NULL,
  `SKS` int(11) DEFAULT NULL,
  `Semester` int(11) DEFAULT NULL,
  `ID_Alat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`Kode_MK`, `Nama_MK`, `SKS`, `Semester`, `ID_Alat`) VALUES
('MKO1', 'Instrumentasi Industri', 2, 4, 'A02'),
('MKO2', 'Praktik Instrumentasi Industri', 2, 4, 'A08'),
('MKO3', 'Praktik Elektronika Analog', 2, 2, 'A03'),
('MKO4', 'PLC', 3, 5, 'A01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `ID_Alat` varchar(10) DEFAULT NULL,
  `ID_Peminjaman` varchar(10) NOT NULL,
  `NIM` varchar(15) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`ID_Alat`, `ID_Peminjaman`, `NIM`, `Jumlah`, `Status`) VALUES
('A02', 'P01', '22010101', 1, 'Dipinjam'),
('A08', 'P02', '22010102', 1, 'Dipinjam'),
('A03', 'P03', '23010103', 1, 'Selesai'),
('A01', 'P04', '21010104', 1, 'Dipinjam'),
('A06', 'P05', '22010105', 2, 'Selesai'),
('A02', 'P06', '22010106', 1, 'Selesai'),
('A10', 'P07', '23010107', 5, 'Dipinjam'),
('A07', 'P08', '21010108', 1, 'Selesai'),
('A05', 'P09', '23010109', 1, 'Dipinjam'),
('A01', 'P10', '21010110', 1, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `ID_Ruangan` varchar(10) NOT NULL,
  `Nama_Ruangan` varchar(50) NOT NULL,
  `Kapasitas` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`ID_Ruangan`, `Nama_Ruangan`, `Kapasitas`, `Status`) VALUES
('R01', 'Lab 1', 30, 'Tersedia'),
('R02', 'Lab 2', 30, 'Tersedia'),
('R03', 'Lab 3', 24, 'Tersedia'),
('R04', 'Lab 4', 24, 'Perbaikan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`ID_Alat`,`ID_Ruangan`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`,`Kode_MK`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`Kode_MK`,`ID_Alat`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`ID_Peminjaman`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`ID_Ruangan`,`Nama_Ruangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
