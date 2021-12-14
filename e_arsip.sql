-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Des 2021 pada 02.53
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `jenis_id` int(3) NOT NULL,
  `nama_dokumen` varchar(150) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `no_dokumen` varchar(100) NOT NULL,
  `tahun` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `ukuran` int(20) NOT NULL,
  `tanggal_upload` varchar(50) NOT NULL,
  `download` int(20) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id_dokumen`, `jenis_id`, `nama_dokumen`, `dokumen`, `no_dokumen`, `tahun`, `deskripsi`, `ukuran`, `tanggal_upload`, `download`, `created_date`, `updated_date`) VALUES
(14, 7, 'sk sk-ttr-201821', '1638668565_fcda915108cc57fcdc61.pdf', 'sk sk-ttr-201821-2019-546', 2019, 'surat keputusan', 136, '2021-12-10', 3, '2021-12-05 08:42:45', '0'),
(15, 7, 'sk sk-tpr-201803', '1638668614_ada13590599b09502faa.pdf', 'sk sk-tpr-201803-2019-254', 2019, 'surat keputusan', 136, '2021-12-26', 1, '2021-12-05 08:43:34', '0'),
(16, 8, 'usaha ut2019-as20', '1638668660_508a2aa5287fe54c7d2a.pdf', 'usaha ut2019-as20-2020-315', 2020, 'urusan tenaga', 136, '2021-12-09', 1, '2021-12-05 08:44:20', '0'),
(17, 7, 'sk sk-tpr-201802', '1638668698_584e874d9b1d016fe489.pdf', 'sk sk-tpr-201802-2019-597', 2019, 'surat keputusan', 136, '2021-12-22', 1, '2021-12-05 08:44:58', '0'),
(18, 6, 'sae2017ikl-01', '1638668735_78259e10bc982905c260.pdf', 'sae2017ikl-01-2020-932', 2020, 'dokumen kesehatan', 136, '2021-12-08', 1, '2021-12-05 08:45:35', '0'),
(19, 6, 'sop-2020eng-05', '1638668786_0efaf7218ab92ae15bd9.pdf', 'sop-2020eng-05-2019-916', 2019, 'berkas kerja', 136, '2021-12-08', 0, '2021-12-05 08:46:26', '0'),
(20, 11, 'sop-2020eng-04', '1638668819_e187826b53b3cac132bc.pdf', 'sop-2020eng-04-2021-431', 2021, 'berkas kerja', 136, '2021-12-10', 0, '2021-12-05 08:46:59', '0'),
(21, 11, 'sop-2020eng-03', '1638668845_42458dc7ee59e7782acb.pdf', 'sop-2020eng-03-2021-620', 2021, 'berkas kerja', 136, '2021-12-03', 0, '2021-12-05 08:47:25', '0'),
(22, 11, 'sop-2020eng-02', '1638668871_d95ac187eec02615fc8d.pdf', 'sop-2020eng-02-2019-427', 2019, 'berkas kerja', 136, '2021-12-14', 0, '2021-12-05 08:47:51', '0'),
(23, 11, 'sop-2020eng-01	', '1638668897_a45c690c35365c86aad9.pdf', 'sop-2020eng-01	-2020-803', 2020, 'berkas kerja', 136, '2021-12-05', 0, '2021-12-05 08:48:17', '0'),
(24, 11, 'procedure sop-2020pro-03', '1638668930_6729741869d42970bf74.pdf', 'procedure sop-2020pro-03-2019-174', 2019, 'berkas kerja', 136, '2021-12-02', 0, '2021-12-05 08:48:50', '0'),
(25, 11, 'procedure sop-2020pro-02', '1638668962_413a9815d7a95b9848e8.pdf', 'procedure sop-2020pro-02-2021-529', 2021, 'berkas kerja', 136, '2021-12-05', 0, '2021-12-05 08:49:22', '0'),
(26, 8, 'procedure sop-2020pro-01 a', '1638668984_1cb953195724e3a07f2c.pdf', 'procedure sop-2020pro-01 a-2021-872', 2021, 'berkas kerja', 136, '2021-12-05', 0, '2021-12-05 08:49:44', '0'),
(27, 4, 'dok ua2020-1231', '1638669006_ad756121dcb234efca32.pdf', 'dok ua2020-1231-2021-795', 2021, 'arsip umum', 136, '2021-12-05', 0, '2021-12-05 08:50:06', '0'),
(28, 5, 'surat keluar satker mst kel-202002-11', '1638669033_ecf985ca1cbf57157e79.pdf', 'surat keluar satker mst kel-202002-11-2021-641', 2021, 'arsip surat', 136, '2021-12-05', 0, '2021-12-05 08:50:33', '0'),
(29, 5, 'surat mas-2020-09-d', '1638669055_4f17b1a56cc9f3f1e5a3.pdf', 'surat mas-2020-09-d-2021-720', 2021, 'arsip surat', 136, '2021-12-05', 0, '2021-12-05 08:50:55', '0'),
(30, 1, 'arsip kkdp-pid2019-c04g', '1638669077_e0975bcbfcc0e7887e04.pdf', 'arsip kkdp-pid2019-c04g-2021-695', 2021, 'arsip pidana', 136, '2021-12-05', 0, '2021-12-05 08:51:17', '0'),
(31, 1, 'arsip kkdl pid2019-c14d', '1638669095_05a2bc34a92ee2698fba.pdf', 'arsip kkdl pid2019-c14d-2021-543', 2021, 'arsip pidana', 136, '2021-12-05', 0, '2021-12-05 08:51:35', '0'),
(32, 1, 'arsip kkl pid2019-c11', '1638669113_60d835c5199967159bbd.pdf', 'arsip kkl pid2019-c11-2021-629', 2021, 'arsip pidana', 136, '2021-12-05', 0, '2021-12-05 08:51:53', '0'),
(33, 1, 'arsip kkl pid2019-c12', '1638669133_9ad74a798c83c73ab906.pdf', 'arsip kkl pid2019-c12-2021-617', 2021, 'arsip pidana', 136, '2021-12-05', 0, '2021-12-05 08:52:13', '0'),
(34, 2, 'berkas pht 201608-na47', '1638669153_2f4988f4b76c6983c931.pdf', 'berkas pht 201608-na47-2021-659', 2021, 'berkas internal', 136, '2021-12-05', 0, '2021-12-05 08:52:33', '0'),
(35, 2, 'berkas ih-201709-012', '1638669175_d4776684b16379d8fb8e.pdf', 'berkas ih-201709-012-2021-925', 2021, 'berkas internal', 136, '2021-12-05', 0, '2021-12-05 08:52:55', '0'),
(36, 2, 'arsip int at in-201709-001', '1638669194_213c0fed11cc3ac6ff30.pdf', 'arsip int at in-201709-001-2021-785', 2021, 'berkas internal', 136, '2021-12-05', 0, '2021-12-05 08:53:14', '0'),
(37, 4, 'arsip 201608-d482', '1638669226_b00995f48e763fbbf44a.pdf', 'arsip 201608-d482-2021-914', 2021, 'arsip umum', 136, '2021-12-05', 0, '2021-12-05 08:53:46', '0'),
(38, 4, 'arsip 201608-d481', '1638669245_844a9962a4f06e1f656f.pdf', 'arsip 201608-d481-2021-085', 2021, 'arsip umum', 136, '2021-12-05', 0, '2021-12-05 08:54:05', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(150) NOT NULL,
  `status_jenis` int(3) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `update_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `status_jenis`, `created_date`, `update_date`) VALUES
(1, 'arsip pidana', 1, '', ''),
(2, 'arsip internal', 1, '', ''),
(4, 'arsip umum', 1, '', ''),
(5, 'arsip surat', 1, '', ''),
(6, 'dokumen kesehatan', 1, '', ''),
(7, 'surat keputusan', 1, '', ''),
(8, 'urusan tenaga', 1, '', ''),
(11, 'berkas kerja', 1, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'guru'),
(3, 'siswa'),
(4, 'sekretaris'),
(5, 'bendahara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `sifat_surat` varchar(50) NOT NULL,
  `pengirim` int(3) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `tertuju` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `isi_surat` text NOT NULL,
  `disposisi` varchar(100) NOT NULL,
  `tanggal_disposisi` varchar(50) NOT NULL,
  `ket_disposisi` text NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `file`, `no_surat`, `tanggal`, `sifat_surat`, `pengirim`, `perihal`, `tertuju`, `alamat`, `isi_surat`, `disposisi`, `tanggal_disposisi`, `ket_disposisi`, `created_date`, `updated_date`) VALUES
(10, '1638797984_2dc2ee239a8272638690.pdf', 'DPU/2020/IV/762', '2021-12-15', 'segera', 4, 'pengajuan undangan', 'farozy', 'pasuruan', 'oke, lanjutkan', '0', '0', '0', '2021-12-06 20:16:09', '0'),
(11, '', 'DPU/2020/IV/762', '2021-12-07', 'segera', 5, 'pengajuan undangan', 'farozy', 'pasuruan', 'laksanakan', '0', '0', '0', '2021-12-07 08:30:41', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `sifat_surat` varchar(50) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `isi_surat` text NOT NULL,
  `unit_kerja_id` int(3) NOT NULL,
  `isi_disposisi` text NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `file`, `no_surat`, `tanggal`, `sifat_surat`, `pengirim`, `perihal`, `isi_surat`, `unit_kerja_id`, `isi_disposisi`, `created_date`, `updated_date`) VALUES
(5, '1638604058_c42e6ad971ebac1ce7ce.pdf', 'KCV.13/2020/14-14', '2021-12-07', 'rahasia', 'farozy', 'pengajuan undangan', 'Kunjungan kerja projek No. KU/LK.2020/I/-554 selatan', 4, 'laksanakan', '2021-12-07 08:53:14', '2021-12-04 09:46:21'),
(8, '', 'KCV.13/2020/14-14', '2021-12-07', 'segera', 'farozy', 'pengajuan undangan', 'cobalah', 6, 'ok, kita lanjutkan', '2021-12-07 19:46:26', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(50) NOT NULL,
  `nama_unit_kerja` varchar(150) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`, `created_date`, `updated_date`) VALUES
(4, 'bendahara', '2021-12-03 17:41:23', '2021-12-03 17:47:04'),
(5, 'sekretaris', '2021-12-03 17:47:46', '0'),
(6, 'hubungan masyarakat', '2021-12-03 17:47:52', '2021-12-03 17:48:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role_id` int(3) NOT NULL,
  `is_active` int(3) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `updated_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `username`, `password`, `foto`, `role_id`, `is_active`, `created_date`, `updated_date`) VALUES
(7, 'fakhrur rozy', 'Farozy00@gmail.com', 'farozy', '$2y$10$zh4is/DaL21IiZ2a41N5AOe45X0Bi0xAKHkP6F5eLdP9Vv5oOy2DS', 'default.png', 1, 1, '2021-12-01', '0'),
(10, 'admin', 'admin@admin.com', 'admin', '$2y$10$GdZRPHl8ozNYKm/P0cXWsOA5brvU0BjWz1KgRD6kzYIUrLfA1Nqi2', 'default.png', 1, 1, '2021-12-14', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indeks untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id_unit_kerja`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id_unit_kerja` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
