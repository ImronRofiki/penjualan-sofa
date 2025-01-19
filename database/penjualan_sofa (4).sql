-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2025 pada 05.43
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_sofa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori_id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_stok` int NOT NULL,
  `harga_barang` int NOT NULL,
  `foto_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `kategori_id`, `deskripsi`, `jumlah_stok`, `harga_barang`, `foto_barang`) VALUES
(2, 'Kasur 2 in 1 - Nyaman dan Praktis', 2, 'Kasur 2 in 1 adalah solusi tidur yang sempurna untuk Anda dan keluarga. Dirancang khusus dengan fungsi ganda, kasur ini dilengkapi dengan kasur utama dan kasur tambahan yang bisa ditarik saat dibutuhkan. Dengan desain modern dan bahan berkualitas tinggi, kasur ini menawarkan kenyamanan maksimal dan daya tahan yang luar biasa.', 99, 1200000, '3a9440cba4bb97d5b5acd83aadd22f43.jpg'),
(3, 'Lemari Kaca 2 Pintu', 3, 'Lemari Kaca adalah pilihan ideal untuk menyimpan dan memajang barang berharga Anda. Dengan desain elegan dan kaca transparan berkualitas tinggi, lemari ini memberikan sentuhan modern sekaligus melindungi koleksi Anda dari debu dan kerusakan. Cocok untuk digunakan di ruang tamu, ruang kerja, atau kamar tidur, lemari kaca ini menawarkan kombinasi estetika dan fungsionalitas yang sempurna.', 48, 2900000, '6078e60255d90597a3ee6fdbd46f4891.jpg'),
(4, 'Sofa Kulit ', 5, 'Sofa Kulit adalah pilihan mewah yang memadukan kenyamanan dan gaya. Dibuat dari bahan kulit berkualitas tinggi, sofa ini memiliki tampilan elegan dan daya tahan luar biasa. Cocok untuk melengkapi ruang tamu Anda, sofa kulit memberikan sentuhan eksklusif sekaligus mudah dibersihkan, menjadikannya pilihan sempurna untuk kenyamanan dan kepraktisan sehari-hari.', 0, 6500000, 'bf3dbd099898185234d84b6785329c8e.jpg'),
(5, 'Rak Sepatu', 6, 'Rak Sepatu adalah solusi praktis untuk menyimpan dan mengatur koleksi sepatu Anda. Dengan desain minimalis dan bahan berkualitas, rak ini tidak hanya menjaga sepatu tetap rapi, tetapi juga hemat ruang. Cocok untuk digunakan di area pintu masuk, kamar, atau ruang penyimpanan, rak sepatu memberikan kombinasi fungsionalitas dan estetika yang sempurna.', 49, 390000, '9493494f745890f39ca575529501b8af.jpg'),
(6, 'Meja Belajar', 1, 'Meja Belajar adalah pilihan ideal untuk mendukung produktivitas dan kenyamanan saat belajar atau bekerja. Dirancang dengan desain ergonomis dan bahan berkualitas, meja ini menyediakan ruang yang cukup untuk buku, laptop, dan perlengkapan lainnya. Cocok untuk anak-anak maupun dewasa, meja belajar ini menghadirkan kombinasi sempurna antara fungsionalitas dan gaya moderen.', 248, 50000, '0c363dfe7ec5beee01dc45e2c44f9eff.jpg'),
(8, 'Springbed 160x200', 2, 'Springbed adalah kasur yang dirancang untuk memberikan kenyamanan tidur optimal dengan menggunakan sistem pegas yang mendukung tubuh secara merata. Dilengkapi dengan lapisan busa lembut dan tahan lama, springbed ini menawarkan kenyamanan ekstra dan daya tahan yang panjang. Cocok untuk berbagai jenis ruangan, springbed ini memastikan tidur yang nyenyak setiap malam, menjadikannya pilihan sempurna untuk Anda dan keluarga.', 50, 1300000, '73e60fd7333a5c69905ac10775702ad9.jpg'),
(9, 'Kursi Kayu Minimalis', 4, 'Kursi Minimalis adalah pilihan sempurna untuk ruang modern yang mengutamakan desain simpel namun elegan. Dengan bentuk yang bersih dan material berkualitas, kursi ini memberikan kenyamanan dan gaya tanpa memakan banyak ruang. Ideal untuk digunakan di ruang tamu, ruang kerja, atau bahkan kamar tidur, kursi minimalis ini menghadirkan fungsionalitas dan estetika yang cocok dengan berbagai tema dekorasi.', 295, 50000, '25efb51c7210d53c0fa817d4ad1f5f1c.jpg'),
(10, 'Lemari Laci 8', 3, 'Lemari Laci 8 adalah solusi penyimpanan praktis dengan 8 laci yang luas, ideal untuk mengatur barang-barang pribadi atau perlengkapan rumah tangga. Dengan desain yang elegan dan material berkualitas, lemari ini memberikan tampilan rapi sekaligus fungsional. Cocok untuk digunakan di kamar tidur, ruang kerja, atau ruang penyimpanan, lemari laci 8 menawarkan kemudahan akses dan efisiensi ruang.', 30, 425000, 'fea685c94727442b50ad1c3dceeb0612.jpg'),
(11, 'Kursi Aesthetic', 4, 'Kursi Aesthetic adalah pilihan furnitur yang menggabungkan desain artistik dengan kenyamanan. Dengan tampilan modern dan detail yang menarik, kursi ini dapat menjadi elemen dekoratif yang memperindah ruangan Anda. Dibalut dengan bahan berkualitas dan warna yang elegan, kursi aesthetic cocok untuk ruang tamu, ruang kerja, atau area santai, memberikan sentuhan unik yang sesuai dengan gaya hidup kontemporer.', 99, 100000, '02c37710a94ba99b452e547e2b73bce6.jpg'),
(12, 'Kursi Kayu Panjang', 4, 'Kursi Kayu Panjang adalah pilihan sempurna untuk mempercantik ruang tamu atau teras Anda. Dibuat dari kayu berkualitas tinggi, kursi ini dirancang dengan estetika yang elegan dan kokoh. Dengan ukuran yang memadai, kursi ini mampu menampung beberapa orang sekaligus, menjadikannya ideal untuk bersantai bersama keluarga atau tamu. Sentuhan akhir yang halus dan desain ergonomis memastikan kenyamanan serta daya tahan yang luar biasa.', 24, 500000, '5d3e33e9a589ab688362df579d46a2ba.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int NOT NULL,
  `pembelian_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `jumlah` int NOT NULL,
  `subtotal_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `pembelian_id`, `barang_id`, `jumlah`, `subtotal_harga`) VALUES
(7, 25, 9, 2, 100000),
(8, 26, 9, 5, 250000),
(11, 29, 6, 2, 100000),
(12, 30, 5, 3, 1170000),
(13, 31, 3, 2, 5800000),
(14, 32, 11, 1, 100000),
(15, 33, 6, 1, 50000),
(16, 34, 6, 1, 50000),
(17, 35, 5, 1, 390000),
(18, 36, 5, 1, 390000),
(19, 37, 5, 1, 390000),
(20, 38, 5, 1, 390000),
(21, 39, 6, 1, 50000),
(22, 40, 12, 1, 500000),
(23, 41, 9, 1, 50000),
(24, 42, 6, 1, 50000),
(25, 43, 8, 1, 1300000),
(26, 44, 8, 1, 1300000),
(27, 45, 6, 1, 50000),
(28, 46, 5, 1, 390000),
(29, 47, 2, 2, 2400000),
(30, 48, 5, 1, 390000),
(31, 49, 2, 1, 1200000),
(32, 50, 5, 1, 390000),
(33, 51, 3, 2, 5800000),
(34, 52, 11, 1, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Meja'),
(2, 'Kasur'),
(3, 'Lemari'),
(4, 'Kursi'),
(5, 'Sofa'),
(6, 'Rak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_harga` int NOT NULL,
  `metode_pembayaran` enum('COD','E-BANKING','E-WALLET') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT CURRENT_TIMESTAMP,
  `alasan_pembatalan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `user_id`, `penerima`, `no_hp`, `alamat`, `total_harga`, `metode_pembayaran`, `status`, `tanggal_pembelian`, `alasan_pembatalan`) VALUES
(25, 11, 'Moh Imron Rofiki', '0833333412', 'pamekasan', 100000, 'COD', 'Cancelled', '2025-01-05 05:12:14', 'gajadi'),
(26, 11, 'fdadfa', '082132102876', 'rafeweqt', 250000, 'COD', 'Cancelled', '2025-01-05 05:14:22', 'coba'),
(29, 11, 'fdadfa', '0833333412', 'rafeweqt', 100000, 'COD', 'Cancelled', '2025-01-05 05:45:58', 'ada lah'),
(30, 11, 'Moh Imron Rofiki', '082132102876', 'pamekasan', 1170000, 'COD', 'Cancelled', '2025-01-05 05:53:28', 'coba gagal'),
(31, 11, 'qqddss', '1144221442142', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 5800000, 'COD', 'Cancelled', '2025-01-05 05:55:45', 'tidak ada'),
(32, 11, 'imron rofiki', '+6282132102097', 'laden pamekasan', 100000, 'COD', 'Approved', '2025-01-11 05:47:46', NULL),
(33, 11, 'Moh Imron Rofiki', '+623255225', 'rafeweqt', 50000, 'COD', 'Cancelled', '2025-01-11 05:56:23', 'aa'),
(34, 11, 'Moh Imron Rofiki', '+62411313441313', 'aefaaagaadg', 50000, 'COD', 'Approved', '2025-01-11 06:00:12', NULL),
(35, 11, 'Moh Imron Rofiki', '+62893839133142', 'pamekasan', 390000, 'COD', 'Cancelled', '2025-01-11 11:31:24', 'lasfmalvavalalvmlv01401'),
(36, 11, 'Moh Imron Rofiki', '+62325352532', 'rafeweqt', 390000, 'COD', 'Cancelled', '2025-01-11 11:35:52', 'aoam'),
(37, 11, 'Moh Imron Rofiki', '+62325352532', 'rafeweqt', 390000, 'COD', 'Cancelled', '2025-01-11 11:37:35', 'ggsd'),
(38, 11, 'Moh Imron Rofiki', '+62325352532', 'rafeweqt', 390000, 'COD', 'Cancelled', '2025-01-11 11:37:40', 'sss'),
(39, 11, 'coba', '+623234135', 'rafeweqt', 50000, 'COD', 'Cancelled', '2025-01-11 11:38:10', 'dsgga'),
(40, 11, 'fdadfa', '+62532235523235', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 500000, 'COD', 'Cancelled', '2025-01-11 11:41:45', 'gsg'),
(41, 11, 'eqqqtqt', '+62515353151', 'rafeweqt', 50000, 'COD', 'Cancelled', '2025-01-11 11:42:36', 'pengen coba'),
(42, 11, 'Moh Imron Rofiki', '+62411242', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 50000, 'COD', 'Cancelled', '2025-01-11 11:53:31', 'coba allert'),
(43, 11, 'Moh Imron Rofiki', '+62828283513551', 'aefaaagaadg', 1300000, 'COD', 'Cancelled', '2025-01-13 05:33:20', 'c'),
(44, 11, 'ddaa', '+62531531511355', 'pamekasan', 1300000, 'COD', 'Cancelled', '2025-01-13 05:35:35', 'c'),
(45, 11, 'Moh Imron Rofiki', '+6291489', 'rafeweqt', 50000, 'COD', 'Rejected', '2025-01-13 05:36:03', NULL),
(46, 11, 'fdadfa', '+62355115153', 'rafeweqt', 390000, 'COD', 'Cancelled', '2025-01-13 05:37:08', 'ssf'),
(47, 11, 'fdadfa', '+6282132102876', 'rafeweqt', 2400000, 'COD', 'Cancelled', '2025-01-13 05:37:57', 'fe'),
(48, 14, 'afaas', '+6241234234', 'fdfd', 390000, 'COD', 'Pending', '2025-01-16 06:21:08', NULL),
(49, 14, 'ewrwer', '+6232552325', 'wewef', 1200000, 'COD', 'Approved', '2025-01-16 06:21:54', NULL),
(50, 15, 'imron rofiki', '+6282132102097', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 390000, 'COD', 'Pending', '2025-01-17 02:06:28', NULL),
(51, 15, 'imron rofiki', '+6282132102097', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 5800000, 'COD', 'Approved', '2025-01-17 02:07:09', NULL),
(52, 15, 'imron rofiki', '+6282132102097', 'Jalan Teja Desa Laden Kecamatan Pamekasan Kabupaten Pamekasan', 100000, 'COD', 'Cancelled', '2025-01-17 02:07:39', 'ingin merubah alamat pemesanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'fiki12345', 'fiki12345@mail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(2, 'aku', 'aku@gmail.com', '$2y$10$rgJ4S1D9muVF0.tD/n6iSu/rk0rPes/Rd84to6XlwU6ws15GLirFK', 'admin'),
(3, 'av', 'av@gmail.com', '$2y$10$AftpaGBsiLzXgO1EyC92R.kljOrAZ0cce19v1SsxXWlwmSeAahlTa', 'user'),
(4, 'fikii', 'fik@gmail.com', '$2y$10$WW4zYbDkg9s4shwEawLz/.95BQCXDiEBc8IJwqmspbYDnt4huJR7G', 'user'),
(5, 'viki', 'viki@gmail.com', '$2y$10$2Z40QPKVsn91FLtpywNbp.jao9G4goL0VY3/jvpQlzzugg3WlnS2S', 'user'),
(6, 'coba', 'coba@gmail.com', '$2y$10$qy9NafkLteeI5HwqB.J1lO/HcPyF9DYdWIrtYOSqp.HQ98llbcOOS', 'user'),
(8, 'jaja', 'jaja11@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(9, 'anomali', 'anomali@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(10, 'adabidu', 'adabidu@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(11, 'user', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(12, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(13, 'fiky', 'fiky@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(14, 'asfasf', 'af@a', '202cb962ac59075b964b07152d234b70', 'user'),
(15, 'Imron Rofiki', 'imron_rofiki@gmail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_ibfk_1` (`kategori_id`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id` (`pembelian_id`),
  ADD KEY `detal_pembelian_ibfk_2` (`barang_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detal_pembelian_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
