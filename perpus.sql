-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 04:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(12) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(60) NOT NULL,
  `penerbit` varchar(60) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `isbn`, `judul`, `pengarang`, `penerbit`, `jumlah`, `cover`) VALUES
(1, '978602063100', 'Aplkasi Komputer', 'Yenni Iskandar', 'Gramedia', 9, 'http://localhost/elibrary/uploads/files/vxpz4n9kflstwrh.jfif'),
(2, '978602063215', 'Belajar Codeigniter', 'Budi', 'Gramedia', 10, 'http://localhost/elibrary/uploads/files/ud5p1zyh30cqvmw.png'),
(3, '978602039003', 'Android Studio', 'Yudha yudhanto', 'Gramedia', 11, 'http://localhost/elibrary/uploads/files/_c3vpo7yw4q2tgz.png'),
(4, '978623400036', 'Prgram Linear', 'Hardi Sujana', 'Gramedia', 15, 'http://localhost/elibrary/uploads/files/six7_ozcgm4etk0.jpg'),
(5, '978979221001', 'Game Builder', 'Gama Putra', 'Gramedia', 5, 'http://localhost/elibrary/uploads/files/4gaibu3ntx_7rml.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `detail_k`
--

CREATE TABLE `detail_k` (
  `id_detail_k` int(11) NOT NULL,
  `id_kembali` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jum_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_k`
--

INSERT INTO `detail_k` (`id_detail_k`, `id_kembali`, `id_buku`, `jum_kembali`) VALUES
(2, 3, 5, 2),
(3, 4, 5, 1),
(4, 4, 1, 1),
(5, 5, 2, 1);

--
-- Triggers `detail_k`
--
DELIMITER $$
CREATE TRIGGER `tambahkembali` AFTER INSERT ON `detail_k` FOR EACH ROW BEGIN
UPDATE buku SET jumlah = jumlah + NEW.jum_kembali
WHERE id_buku = NEW.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_p`
--

CREATE TABLE `detail_p` (
  `id_detail` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jum_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_p`
--

INSERT INTO `detail_p` (`id_detail`, `id_pinjam`, `id_buku`, `jum_pinjam`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 1),
(3, 3, 4, 1),
(4, 4, 2, 1),
(5, 4, 4, 1),
(6, 5, 5, 2),
(7, 6, 3, 1),
(8, 6, 4, 1),
(9, 6, 2, 1),
(10, 7, 1, 1),
(11, 7, 3, 2),
(12, 7, 2, 1),
(13, 7, 5, 2),
(14, 7, 4, 2),
(15, 8, 1, 2),
(16, 8, 3, 2),
(17, 8, 5, 1),
(18, 9, 2, 1),
(19, 9, 3, 2);

--
-- Triggers `detail_p`
--
DELIMITER $$
CREATE TRIGGER `tambahpinjam` AFTER INSERT ON `detail_p` FOR EACH ROW BEGIN
UPDATE buku SET jumlah = jumlah - NEW.jum_pinjam
WHERE id_buku = NEW.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama_mhw` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama_mhw`, `alamat`, `kelas`, `foto`) VALUES
(310010111, 'Mahasiswa 2', 'Cibarusah', 'TI.19.A.RPL-1', 'http://localhost/elibrary/uploads/files/93m_vrnceksup2o.jfif'),
(310010112, 'Mahasiswa 3', 'Jakarta', 'TI.19.A.RPL-2', 'http://localhost/elibrary/uploads/files/mr2tyl3_iecx1zf.jfif'),
(310010113, 'Mahasiswa 4', 'Bekasi Timur', 'TI.19.A.RPL-2', 'http://localhost/elibrary/uploads/files/bmk89h0q4f7pul5.jfif'),
(310010114, 'Mahasiswa 5', 'Cikarang Utara', 'TI.19.A.RPL-1', 'http://localhost/elibrary/uploads/files/8lpbsfnrkej9a46.jfif'),
(311910110, 'Mahasiswa 1', 'Cibitung', 'TI.19.A.RPL-2', 'http://localhost/elibrary/uploads/files/zturoja0q7iwpb6.jfif'),
(311910682, 'Fahmi Prayoga', 'Jarakosta', 'TI.19.A.RPL-2', 'http://localhost/elibrary/uploads/files/pa_e1zf6iybkom2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_ptgs` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `nim`, `tgl_pinjam`, `tgl_kembali`, `id_ptgs`, `id_status`) VALUES
(1, 311910657, '2022-11-24', '2022-11-27', 1, 1),
(2, 311910657, '2022-11-24', '2022-11-27', 1, 1),
(3, 317710114, '2022-11-24', '2022-11-27', 4, 1),
(4, 317710113, '2022-11-24', '2022-11-27', 2, 1),
(5, 317710111, '2022-11-24', '2022-11-27', 4, 1),
(6, 317710112, '2022-11-24', '2022-11-27', 3, 2),
(7, 317710111, '2022-11-24', '2022-11-25', 5, 1),
(8, 311910682, '2022-11-24', '2022-11-30', 5, 2),
(9, 311910682, '2022-11-20', '2022-11-25', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_ptgs` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_kembali`, `nim`, `tgl_kembali`, `id_ptgs`, `id_status`, `id_pinjam`) VALUES
(3, 317710112, '2022-11-27', 1, 2, 6),
(4, 311910682, '2022-11-30', 5, 2, 8),
(5, 311910682, '2022-11-25', 4, 2, 8);

--
-- Triggers `pengembalian`
--
DELIMITER $$
CREATE TRIGGER `kembalian` AFTER INSERT ON `pengembalian` FOR EACH ROW BEGIN
UPDATE peminjaman SET id_status = 2
WHERE id_pinjam = NEW.id_pinjam;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_ptgs` int(11) NOT NULL,
  `nama_ptgs` varchar(60) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_ptgs`, `nama_ptgs`, `jabatan`, `foto`) VALUES
(1, 'Petugas 1', 'Admin', 'http://localhost/elibrary/uploads/files/zregd6l7o9pw231.jfif'),
(2, 'Petugas 2', 'Staff', 'http://localhost/elibrary/uploads/files/wkl1jn67bvuopim.jfif'),
(3, 'Petugas 3', 'Staff', 'http://localhost/elibrary/uploads/files/zbu7w0x6_m1cg5e.jfif'),
(4, 'Petugas 4', 'Staff', 'http://localhost/elibrary/uploads/files/5jqup9bodwt83fa.jfif'),
(5, 'Petugas 5', 'Staff', 'http://localhost/elibrary/uploads/files/6dfbqi07h4rus8k.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Dipinjam'),
(2, 'Dikembalikan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `detail_k`
--
ALTER TABLE `detail_k`
  ADD PRIMARY KEY (`id_detail_k`),
  ADD KEY `id_kembali` (`id_kembali`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `detail_p`
--
ALTER TABLE `detail_p`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_ptgs` (`id_ptgs`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `id_ptgs` (`id_ptgs`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_ptgs`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_k`
--
ALTER TABLE `detail_k`
  MODIFY `id_detail_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_p`
--
ALTER TABLE `detail_p`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_ptgs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
