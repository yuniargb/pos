-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2021 pada 14.33
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_desc`, `date`) VALUES
('001', 'Roti', 'Makanan RFingan', '2021-02-11 13:00:57'),
('002', 'test2', 'testing', '2021-02-11 13:01:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `customer_phone`, `customer_address`, `date`) VALUES
('CUST0001', 'Yen - Yen', '', 'fsdfdsfsd', '2021-01-18 23:55:16'),
('CUST0002', 'mail', '082374757575', 'jl. punggawa medan', '2021-02-11 12:59:58'),
('CUST0003', 'iki', '083747574747', 'jalan master satu medan', '2021-02-11 13:00:24'),
('CUST0004', 'andrew', '082373647333', 'babababab', '2021-02-17 01:40:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `expense_account`
--

CREATE TABLE `expense_account` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status_akun` int(11) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `expense_account`
--

INSERT INTO `expense_account` (`id`, `code`, `name`, `status_akun`, `createdby`, `createdDate`, `updatedby`, `updatedDate`) VALUES
(1, 'code001', 'Pegawai', 0, 'admin', '2021-02-17 00:00:00', NULL, NULL),
(2, 'code002', 'ADIRA', 0, 'admin', '2021-02-17 00:00:00', NULL, NULL),
(3, 'code003', 'Satpam', 0, 'admin', '2021-02-17 00:00:00', 'admin', '2021-02-17 09:44:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `akun_id`, `tanggal`, `jumlah`, `keterangan`) VALUES
(2, 2, '2021-02-17', 100000, 'Adira finance'),
(6, 3, '2021-01-06', 50000, 'bayar rokok satpam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 0,
  `sale_price` int(20) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `sale_price_type1` int(20) NOT NULL,
  `sale_price_type2` int(20) NOT NULL,
  `sale_price_type3` int(20) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `product_name`, `category_id`, `product_desc`, `product_qty`, `sale_price`, `buy_price`, `sale_price_type1`, `sale_price_type2`, `sale_price_type3`, `date`) VALUES
('001', 'Roti', '001', 'roti ringan makanan anak2', 1, 10000, 5000, 2000, 3000, 5000, '2021-02-11 13:01:52'),
('002', 'COCA COLA', '002', 'COCA COLA', 289, 15000, 10000, 7500, 9000, 15000, '2021-02-11 13:02:47'),
('123', '123', '002', '123', 1, 200, 100, 200, 200, 300, '2021-03-03 08:28:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyeksi_laba`
--

CREATE TABLE `proyeksi_laba` (
  `id` int(11) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `tot_pendapatan` varchar(20) DEFAULT NULL,
  `hpp` varchar(20) DEFAULT NULL,
  `tot_biaya` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `tot_laba_rugi` varchar(20) DEFAULT NULL,
  `tot_laba_rugi_kotor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyeksi_laba`
--

INSERT INTO `proyeksi_laba` (`id`, `month`, `year`, `tot_pendapatan`, `hpp`, `tot_biaya`, `keterangan`, `tot_laba_rugi`, `tot_laba_rugi_kotor`) VALUES
(4, 2, '2021', '226500', '100000', '100000', 'Untung', '26500', '126500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Purchase Transaction, 0=Purchase Retur',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `transaction_id`, `product_id`, `category_id`, `quantity`, `price_item`, `subtotal`, `type`, `date`) VALUES
(2, '001', '001', '001', '5', '10000', '50000', 1, '2021-02-11 19:06:27'),
(3, '002', '001', '001', '2', '2000', '4000', 1, '2021-02-11 19:07:10'),
(4, 'XXX', '001', '001', '35', '200000', '7000000', 1, '2021-03-03 08:58:49'),
(5, '004', '002', '002', '100', '300000', '30000000', 1, '2021-03-03 13:20:21'),
(6, 'S', '123', '002', '2', '100', '200', 1, '2021-03-03 14:33:48'),
(7, 'RETP1614821155', '123', '002', '1', '100', '100', 1, '2021-03-04 01:25:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_retur`
--

CREATE TABLE `purchase_retur` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_retur_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_return` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `return_by` enum('1','0') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Retur by 1 = barang, 0 = uang',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `purchase_retur`
--

INSERT INTO `purchase_retur` (`id`, `sales_retur_id`, `total_price`, `total_item`, `is_return`, `return_by`, `date`) VALUES
('RETP1614821155', 'S', '100', '1', '0', '1', '2021-03-03 19:25:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_transaction`
--

CREATE TABLE `purchase_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` int(20) NOT NULL,
  `total_item` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `purchase_transaction`
--

INSERT INTO `purchase_transaction` (`id`, `total_price`, `total_item`, `date`, `supplier_id`) VALUES
('001', 50000, 5, '2021-02-11 19:06:27', 'SUP003'),
('002', 4000, 2, '2021-02-11 19:07:09', 'SUP003'),
('004', 30000000, 100, '2021-03-03 13:20:21', 'SUP003'),
('S', 200, 2, '2021-03-03 14:33:48', 'SUP003'),
('XXX', 7000000, 35, '2021-03-03 08:58:48', 'SUP004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_data`
--

CREATE TABLE `sales_data` (
  `id` int(11) NOT NULL,
  `sales_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reserv` int(11) NOT NULL,
  `price_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Sales Transaction, 0=Sales Retur',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sales_data`
--

INSERT INTO `sales_data` (`id`, `sales_id`, `product_id`, `category_id`, `quantity`, `reserv`, `price_item`, `subtotal`, `type`, `date`) VALUES
(1, 'OUT1613070504', '001', '001', '10', 0, '10000', '100000', 1, '2021-02-11 19:08:47'),
(2, 'OUT1613754601', '001', '001', '10', 0, '10000', '100000', 1, '2021-02-19 17:10:54'),
(3, 'OUT1613755700', '001', '001', '2', 0, '2000', '4000', 1, '2021-02-19 17:28:40'),
(4, 'OUT1613755700', '002', '002', '3', 0, '7500', '22500', 1, '2021-02-19 17:28:40'),
(5, 'OUT1614143474', '001', '001', '10', 0, '3000', '30000', 1, '2021-02-24 05:11:57'),
(6, 'OUT1614143474', '002', '002', '50', 0, '9000', '450000', 1, '2021-02-24 05:11:57'),
(7, 'OUT1614747340', '001', '001', '0', 22, '10000', '220000', 1, '2021-03-03 04:55:46'),
(8, 'OUT1614747418', '001', '001', '13', 9, '10000', '220000', 1, '2021-03-03 05:44:01'),
(9, 'OUT1614760899', '002', '002', '12', 0, '15000', '180000', 1, '2021-03-03 08:49:22'),
(10, 'OUT1614760899', '001', '001', '1', 0, '10000', '10000', 1, '2021-03-03 13:55:02'),
(11, 'OUT1614761370', '001', '001', '1', 0, '10000', '10000', 1, '2021-03-03 13:49:45'),
(12, 'OUT1614777541', '002', '002', '400', 0, '15000', '6000000', 1, '2021-03-03 13:49:02'),
(13, 'OUT1614781747', '123', '002', '2', 0, '200', '400', 1, '2021-03-03 14:34:07'),
(16, 'RETS1614821142', '123', '002', '2', 0, '200', '400', 0, '2021-03-04 01:53:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_retur`
--

CREATE TABLE `sales_retur` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_item` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_return` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sales_retur`
--

INSERT INTO `sales_retur` (`id`, `sales_id`, `total_price`, `total_item`, `is_return`, `date`) VALUES
('RETS1614821142', 'OUT1614781747', '400', '2', '0', '2021-03-03 19:25:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_transaction`
--

CREATE TABLE `sales_transaction` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_cash` tinyint(1) NOT NULL,
  `total_price` int(100) NOT NULL,
  `total_item` int(100) NOT NULL,
  `pay_deadline_date` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `sales_transaction`
--

INSERT INTO `sales_transaction` (`id`, `customer_id`, `is_cash`, `total_price`, `total_item`, `pay_deadline_date`, `date`, `status_product`) VALUES
('OUT1613070504', 'CUST0003', 1, 100000, 10, '2021-02-11', '2021-02-24 05:03:57', 1),
('OUT1613754601', 'CUST0002', 1, 100000, 10, '2021-02-19', '2021-02-24 05:04:01', 1),
('OUT1613755700', 'CUST0001', 1, 26500, 5, '2021-02-19', '2021-02-24 05:04:06', 1),
('OUT1614143474', 'CUST0004', 0, 480000, 60, '2021-03-26', '2021-02-24 07:16:04', 0),
('OUT1614747340', 'CUST0001', 1, 220000, 22, '2021-03-03', '2021-03-03 04:56:41', 1),
('OUT1614747418', 'CUST0001', 1, 220000, 22, '2021-03-03', '2021-03-03 04:57:19', NULL),
('OUT1614760899', 'CUST0001', 1, 190000, 13, '2021-03-03', '2021-03-03 08:49:21', NULL),
('OUT1614761370', 'CUST0001', 1, 10000, 1, '2021-03-03', '2021-03-03 08:56:13', NULL),
('OUT1614777541', 'CUST0001', 1, 6000000, 400, '2021-03-03', '2021-03-03 13:19:30', NULL),
('OUT1614781747', 'CUST0003', 1, 400, 2, '2021-03-03', '2021-03-04 01:25:32', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id` int(11) NOT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `stock_fisik` int(11) DEFAULT NULL,
  `selisih_stock` int(11) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock_opname`
--

INSERT INTO `stock_opname` (`id`, `product_id`, `tanggal`, `stock_fisik`, `selisih_stock`, `keterangan`) VALUES
(3, '002', '2021-02-20', 400, 0, 'barang nya rusak atau hilang'),
(4, '001', '2021-02-20', 20, -5, 'barang di gudang bertambah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_address` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `supplier_phone`, `supplier_address`, `date`) VALUES
('SUP003', 'PT. Bogasari Four Mils', '', 'ijhhh', '2021-01-18 23:54:25'),
('SUP004', 'PT. Susu', '082737475755', 'Medan', '2021-02-11 12:58:44'),
('SUP005', 'PT. Prima Jaya', '082333727373', 'Medan Indonesia', '2021-02-11 12:59:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `no_plot_truk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_jalan`
--

INSERT INTO `surat_jalan` (`id`, `customer_id`, `tanggal_terima`, `tanggal_kirim`, `no_plot_truk`) VALUES
('SJ1614844818', 'CUST0001', '0000-00-00', '2021-03-05', 'asd'),
('SJ1614848960', 'CUST0003', '0000-00-00', '2021-03-05', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_jalan_detail`
--

CREATE TABLE `surat_jalan_detail` (
  `id` int(11) NOT NULL,
  `surat_jalan_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_jalan_detail`
--

INSERT INTO `surat_jalan_detail` (`id`, `surat_jalan_id`, `product_id`, `qty`) VALUES
(2, 'SJ1614844818', '001', 1),
(3, 'SJ1614848960', '123', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo_profile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedby` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `photo_profile`, `password`, `createdby`, `createdDate`, `updatedby`, `updatedDate`) VALUES
(1, 'admin', 'admin@admin.com', 'uploads/3b6322dbc21bd6942277a875d6b8e01b.jpg', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 'admin', '2021-02-17 00:00:00'),
(11, 'ww', 'aa@aa.com', 'uploads/d351029679cccacb66e7c564a16b3716.png', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2021-02-11 00:00:00', NULL, NULL),
(14, 'aaa', 'aaa@aaa.com', 'uploads/2faee2867e18b1c6d278564957d268fb.png', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2021-02-11 00:00:00', 'admin', '2021-02-17 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  `status_access` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access`
--

INSERT INTO `user_access` (`id`, `user_id`, `page`, `status_access`) VALUES
(125, 1, 'Home', 1),
(126, 1, 'Supplier', 1),
(127, 1, 'Pelanggan', 1),
(128, 1, 'Kategori', 1),
(129, 1, 'Produk', 1),
(130, 1, 'Transaksi Penjualan', 1),
(131, 1, 'Transaksi Pembelian', 1),
(132, 1, 'Tunggakan', 1),
(133, 1, 'Retur Penjualan', 1),
(134, 1, 'Retur Purhcase', 1),
(135, 1, 'User Management', 1),
(136, 1, 'Master Biaya', 1),
(137, 1, 'Stock Opname', 1),
(138, 1, 'Laporan', 1),
(139, 11, 'Home', 1),
(140, 11, 'Supplier', 0),
(141, 11, 'Pelanggan', 0),
(142, 11, 'Kategori', 0),
(143, 11, 'Produk', 0),
(144, 11, 'Transaksi Penjualan', 0),
(145, 11, 'Transaksi Pembelian', 0),
(146, 11, 'Tunggakan', 0),
(147, 11, 'Retur Penjualan', 0),
(148, 11, 'Retur Purhcase', 0),
(149, 11, 'User Management', 0),
(150, 11, 'Master Biaya', 0),
(151, 11, 'Stock Opname', 0),
(152, 11, 'Laporan', 1),
(154, 1, 'Stok Konsumen', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `expense_account`
--
ALTER TABLE `expense_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeks untuk tabel `proyeksi_laba`
--
ALTER TABLE `proyeksi_laba`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `purchase_retur`
--
ALTER TABLE `purchase_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeks untuk tabel `purchase_transaction`
--
ALTER TABLE `purchase_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeks untuk tabel `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sales_retur`
--
ALTER TABLE `sales_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `sales_transaction`
--
ALTER TABLE `sales_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeks untuk tabel `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_jalan_detail`
--
ALTER TABLE `surat_jalan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `expense_account`
--
ALTER TABLE `expense_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `proyeksi_laba`
--
ALTER TABLE `proyeksi_laba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_jalan_detail`
--
ALTER TABLE `surat_jalan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
