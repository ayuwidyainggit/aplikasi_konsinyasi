-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2019 pada 23.53
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kons`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kd_akun` char(11) NOT NULL,
  `kd_rekening` int(11) DEFAULT NULL,
  `nm_akun` char(30) DEFAULT NULL,
  `debet` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `keterangan` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kd_akun`, `kd_rekening`, `nm_akun`, `debet`, `kredit`, `keterangan`) VALUES
('10000001', 100, 'Kas', 0, 0, 'default account'),
('10000002', 100, 'Barang-barang Konsinyasi', 0, 0, 'default account'),
('10000003', 100, 'Persediaan Produk Jadi', 0, 0, 'default account'),
('10000004', 500, 'Penjualan Konsinyasi', 0, 0, 'default account'),
('10000005', 300, 'Piutang Dagang', 0, 0, 'default account'),
('10000006', 700, 'Barang-barang Konsinyasi-Ongki', 0, 0, 'default account'),
('10000007', 700, 'Barang-barang Konsinyasi-penge', 0, 0, 'default account'),
('10000008', 800, 'Harga Pokok Penjualan', 0, 0, 'default account'),
('10000009', 600, 'Penjualan', 0, 0, 'default account'),
('10000010', 700, 'Komisi Penjualan', 0, 0, 'default account');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kd_brg` char(11) NOT NULL,
  `nm_brg` char(30) DEFAULT NULL,
  `jml_brg` int(11) DEFAULT NULL,
  `hrg_pokok_brg` int(11) DEFAULT NULL,
  `hrg_jual_brg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `kd_barangmasuk` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kd_brg` char(11) NOT NULL,
  `jml_brg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailjual`
--

CREATE TABLE `detailjual` (
  `id_det_jual` int(9) NOT NULL,
  `id_jual` char(9) DEFAULT NULL,
  `kd_brg` char(11) DEFAULT NULL,
  `qty` char(11) DEFAULT NULL,
  `hasil_komisi` int(11) DEFAULT NULL,
  `total_hpp` int(11) DEFAULT NULL,
  `kas_diterima` int(11) DEFAULT NULL,
  `hasiljual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailretur`
--

CREATE TABLE `detailretur` (
  `id_det_retur` int(11) NOT NULL,
  `kd_retur` char(8) DEFAULT NULL,
  `kd_brg` char(8) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `jmlretur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jurnal`
--

CREATE TABLE `detail_jurnal` (
  `no_det_ju` int(11) NOT NULL,
  `no_ju` char(8) NOT NULL,
  `kd_akun` char(11) DEFAULT NULL,
  `total_debet` int(11) DEFAULT NULL,
  `total_kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnalumum`
--

CREATE TABLE `jurnalumum` (
  `no_ju` char(8) NOT NULL,
  `bukti` char(8) DEFAULT NULL,
  `tgl_jurnal` date DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kirimdetail`
--

CREATE TABLE `kirimdetail` (
  `kd_det_kirim` int(11) NOT NULL,
  `id_kirim` char(11) DEFAULT NULL,
  `kd_brg` char(11) DEFAULT NULL,
  `jml_kirim` int(11) DEFAULT NULL,
  `biaya_kirim` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sisakirim` int(11) DEFAULT NULL,
  `penerimaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kirimselesai`
--

CREATE TABLE `kirimselesai` (
  `id_kirim` char(11) NOT NULL,
  `id_toko` char(11) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `totalkirim` int(11) DEFAULT NULL,
  `totalbiaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_jual` char(9) NOT NULL,
  `tgl_jual` date DEFAULT NULL,
  `id_kirim` char(11) DEFAULT NULL,
  `id_toko` char(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tot_komisi` int(11) DEFAULT NULL,
  `kas` int(11) DEFAULT NULL,
  `hpp_total` int(11) DEFAULT NULL,
  `piutang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `kd_rekening` int(11) NOT NULL,
  `nm_rekening` char(30) DEFAULT NULL,
  `keterangan` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`kd_rekening`, `nm_rekening`, `keterangan`) VALUES
(100, 'AKTIVA LANCAR', 'default'),
(200, 'AKTIVA TETAP', 'default'),
(300, 'PIUTANG DAGANG', 'default'),
(400, 'HUTANG DAGANG', 'default'),
(500, 'PENDAPATAN KONSINYASI', 'default'),
(600, 'PENDAPATAN USAHA', 'default'),
(700, 'BEBAN USAHA', 'default'),
(800, 'HPP', 'default');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur`
--

CREATE TABLE `retur` (
  `kd_retur` char(9) NOT NULL,
  `id_kirim` char(11) DEFAULT NULL,
  `tgl_retur` date DEFAULT NULL,
  `id_toko` char(11) DEFAULT NULL,
  `totalretur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `terimapenjualan`
--

CREATE TABLE `terimapenjualan` (
  `id_terima` char(8) NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `id_jual` char(8) DEFAULT NULL,
  `kas` int(11) DEFAULT NULL,
  `hpp_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` char(11) NOT NULL,
  `nm_toko` char(30) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(13) DEFAULT NULL,
  `komisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `Jabatan` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `Jabatan`) VALUES
(9, 'direktur', 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'direktur'),
(8, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(25, 'manager', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kd_akun`),
  ADD KEY `kd_rekening` (`kd_rekening`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indeks untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`kd_barangmasuk`),
  ADD KEY `kd_brg` (`kd_brg`);

--
-- Indeks untuk tabel `detailjual`
--
ALTER TABLE `detailjual`
  ADD PRIMARY KEY (`id_det_jual`),
  ADD KEY `kd_brg` (`kd_brg`);

--
-- Indeks untuk tabel `detailretur`
--
ALTER TABLE `detailretur`
  ADD PRIMARY KEY (`id_det_retur`),
  ADD KEY `kd_brg` (`kd_brg`),
  ADD KEY `kd_retur` (`kd_retur`);

--
-- Indeks untuk tabel `detail_jurnal`
--
ALTER TABLE `detail_jurnal`
  ADD PRIMARY KEY (`no_det_ju`),
  ADD KEY `kd_akun` (`kd_akun`),
  ADD KEY `no_ju` (`no_ju`);

--
-- Indeks untuk tabel `jurnalumum`
--
ALTER TABLE `jurnalumum`
  ADD PRIMARY KEY (`no_ju`);

--
-- Indeks untuk tabel `kirimdetail`
--
ALTER TABLE `kirimdetail`
  ADD PRIMARY KEY (`kd_det_kirim`);

--
-- Indeks untuk tabel `kirimselesai`
--
ALTER TABLE `kirimselesai`
  ADD PRIMARY KEY (`id_kirim`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_jual`),
  ADD KEY `id_kirim` (`id_kirim`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`kd_rekening`);

--
-- Indeks untuk tabel `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`kd_retur`),
  ADD KEY `id_kirim` (`id_kirim`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `terimapenjualan`
--
ALTER TABLE `terimapenjualan`
  ADD PRIMARY KEY (`id_terima`),
  ADD KEY `id_jual` (`id_jual`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `kd_barangmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `detailjual`
--
ALTER TABLE `detailjual`
  MODIFY `id_det_jual` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detailretur`
--
ALTER TABLE `detailretur`
  MODIFY `id_det_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_jurnal`
--
ALTER TABLE `detail_jurnal`
  MODIFY `no_det_ju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `kirimdetail`
--
ALTER TABLE `kirimdetail`
  MODIFY `kd_det_kirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`kd_rekening`) REFERENCES `rekening` (`kd_rekening`);

--
-- Ketidakleluasaan untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`);

--
-- Ketidakleluasaan untuk tabel `detailjual`
--
ALTER TABLE `detailjual`
  ADD CONSTRAINT `detailjual_ibfk_1` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`);

--
-- Ketidakleluasaan untuk tabel `detailretur`
--
ALTER TABLE `detailretur`
  ADD CONSTRAINT `detailretur_ibfk_1` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`),
  ADD CONSTRAINT `detailretur_ibfk_2` FOREIGN KEY (`kd_retur`) REFERENCES `retur` (`kd_retur`);

--
-- Ketidakleluasaan untuk tabel `detail_jurnal`
--
ALTER TABLE `detail_jurnal`
  ADD CONSTRAINT `detail_jurnal_ibfk_1` FOREIGN KEY (`kd_akun`) REFERENCES `akun` (`kd_akun`),
  ADD CONSTRAINT `detail_jurnal_ibfk_2` FOREIGN KEY (`no_ju`) REFERENCES `jurnalumum` (`no_ju`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_kirim`) REFERENCES `kirimselesai` (`id_kirim`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Ketidakleluasaan untuk tabel `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`id_kirim`) REFERENCES `kirimselesai` (`id_kirim`),
  ADD CONSTRAINT `retur_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Ketidakleluasaan untuk tabel `terimapenjualan`
--
ALTER TABLE `terimapenjualan`
  ADD CONSTRAINT `terimapenjualan_ibfk_1` FOREIGN KEY (`id_jual`) REFERENCES `penjualan` (`id_jual`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
