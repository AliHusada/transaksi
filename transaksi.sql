-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 Feb 2019 pada 08.36
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaksi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(15) NOT NULL,
  `kode` varchar(255) NOT NULL DEFAULT '0',
  `barcode` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `satuan` varchar(255) NOT NULL DEFAULT '0',
  `stok` int(11) NOT NULL DEFAULT '0',
  `jenis` varchar(255) NOT NULL DEFAULT '0',
  `harga` decimal(15,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode`, `barcode`, `name`, `satuan`, `stok`, `jenis`, `harga`) VALUES
(48, 'B0001', 'ALKQ19JSA12', 'Sepatu', 'Satuan', 30, 'Jenis', '1200'),
(49, 'B0002', 'BKS21JAKL', 'Laptop', 'Unit', -1102, 'Elektronik', '10000'),
(50, 'B0003', 'DJAI1121SD', 'Kipas ', 'Pcs', 20, 'Sepatu', '9000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(15) NOT NULL,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `shop` varchar(255) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `name`, `shop`, `address`) VALUES
(1, 'P0001', 'Cash(tunai)', '', ' '),
(4, 'P0001', 'Mas\'ud', 'Sejahtera', 'Malang'),
(7, 'P0002', 'herman', 'TOkoku', 'Wagir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(10) NOT NULL,
  `tgl_penjualan` varchar(255) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `no_penjualan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  `uang_bayar` decimal(10,0) DEFAULT '0',
  `uang_kembali` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tgl_penjualan`, `id_pelanggan`, `id_supplier`, `no_penjualan`, `keterangan`, `jumlah`, `total`, `uang_bayar`, `uang_kembali`) VALUES
(41, '', 1, 0, 'JL0001', '', 1111, 9887900, '10000000', '112100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(255) DEFAULT '0',
  `name` varchar(255) DEFAULT '0',
  `id_supplier` int(10) DEFAULT '0',
  `id_barang` int(10) DEFAULT '0',
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sementara`
--

CREATE TABLE `sementara` (
  `id` int(11) NOT NULL,
  `id_barang` int(10) DEFAULT '0',
  `no_penjualan` varchar(50) DEFAULT '0',
  `discount` varchar(50) DEFAULT '0',
  `jumlah` varchar(50) DEFAULT '0',
  `sub_total` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT '0',
  `address` varchar(255) DEFAULT '0',
  `no_tlp` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `name`, `address`, `no_tlp`) VALUES
(6, 'S0002', 'Mas\'ud', 'Gunung Kawi', '082233472254'),
(7, 'S0003', 'Mawan', 'Gunung', '083122142152');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_barang` int(10) DEFAULT '0',
  `no_penjualan` varchar(50) DEFAULT '0',
  `discount` varchar(50) DEFAULT '0',
  `jumlah` varchar(50) DEFAULT '0',
  `sub_total` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_barang`, `no_penjualan`, `discount`, `jumlah`, `sub_total`) VALUES
(440, 49, 'JL0001', '11', '1111', '9887900');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `transaksi_after_insert` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	if new.no_penjualan like '%JL%' then
   update barang set stok = barang.stok - new.jumlah where barang.id = new.id_barang;
	else 
	   update barang set stok = barang.stok + new.jumlah where barang.id = new.id_barang;
	end if;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sementara`
--
ALTER TABLE `sementara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sementara`
--
ALTER TABLE `sementara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
