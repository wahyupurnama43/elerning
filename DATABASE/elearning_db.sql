-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2021 pada 08.27
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisis`
--

CREATE TABLE `analisis` (
  `id_analisis` int(100) NOT NULL,
  `id_ujian` int(100) NOT NULL,
  `id_soal` int(100) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisis`
--

INSERT INTO `analisis` (`id_analisis`, `id_ujian`, `id_soal`, `id_siswa`, `jawaban`) VALUES
(1, 12, 107, 21, '1'),
(2, 12, 111, 21, '2'),
(3, 12, 112, 21, '2'),
(4, 12, 113, 21, '2'),
(5, 12, 114, 21, '2'),
(6, 13, 115, 22, '2'),
(7, 13, 116, 22, '2'),
(8, 13, 117, 22, '2'),
(9, 13, 118, 22, '0'),
(10, 13, 119, 22, '2'),
(11, 13, 115, 21, '2'),
(12, 13, 116, 21, '3'),
(13, 13, 117, 21, '2'),
(14, 13, 118, 21, '2'),
(15, 13, 119, 21, '2'),
(16, 14, 120, 1, '1'),
(17, 14, 121, 1, '2'),
(18, 14, 122, 1, '2'),
(19, 14, 123, 1, '2'),
(20, 14, 124, 1, '3'),
(21, 14, 120, 2, '1'),
(22, 14, 121, 2, '2'),
(23, 14, 122, 2, '2'),
(24, 14, 123, 2, '2'),
(25, 14, 124, 2, '3'),
(26, 17, 2, 3, 'aaa'),
(27, 17, 2, 3, 'aaa'),
(28, 19, 125, 3, '4'),
(29, 17, 2, 3, 'aaa'),
(30, 17, 2, 3, 'aaa'),
(31, 19, 125, 3, '4'),
(32, 17, 2, 3, 'aaa'),
(33, 17, 2, 3, 'aaa'),
(34, 17, 2, 3, 'aaa'),
(35, 17, 2, 3, 'aaa'),
(36, 20, 126, 6, '1'),
(37, 20, 127, 6, '1'),
(38, 20, 128, 6, '1'),
(39, 20, 126, 8, '1'),
(40, 20, 127, 8, '1'),
(41, 20, 128, 8, '1'),
(42, 21, 130, 8, '1'),
(43, 29, 3, 11, 'asdadsasd'),
(44, 29, 4, 11, '0'),
(45, 29, 5, 11, '0'),
(46, 30, 148, 11, '2'),
(47, 30, 149, 11, '1'),
(48, 30, 150, 11, '1'),
(49, 29, 3, 12, 'a'),
(50, 29, 4, 12, 'a'),
(51, 29, 5, 12, 'a'),
(52, 33, 10, 12, 'Sistem presensi'),
(53, 33, 11, 12, 'Dan tak kenal lelah'),
(54, 33, 12, 12, '0'),
(55, 34, 151, 12, '2'),
(56, 34, 152, 12, '2'),
(57, 34, 153, 12, '2'),
(58, 37, 154, 12, '3'),
(59, 37, 155, 12, '4'),
(60, 37, 156, 12, '5'),
(61, 39, 157, 11, '2'),
(62, 45, 159, 11, '2'),
(63, 45, 160, 11, '2'),
(64, 45, 161, 11, '4'),
(65, 51, 162, 15, '1'),
(66, 51, 163, 15, '1'),
(67, 51, 164, 15, '1'),
(68, 52, 165, 15, '1'),
(69, 52, 166, 15, '1'),
(70, 52, 167, 15, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_roleguru` int(11) NOT NULL,
  `waktu_dibuat` int(191) NOT NULL,
  `batas_waktu` int(11) NOT NULL,
  `waktu_selesai` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_roleguru`, `waktu_dibuat`, `batas_waktu`, `waktu_selesai`) VALUES
(13, 3, 1626181059, 3, 1626191859),
(14, 15, 1627316669, 1, 1627320269),
(21, 21, 1627891967, 2, 1627899167),
(22, 25, 1628025702, 1, 1628029302);

-- --------------------------------------------------------

--
-- Struktur dari tabel `isi_chat`
--

CREATE TABLE `isi_chat` (
  `id_isi_chat` int(11) NOT NULL,
  `id_chat` int(191) NOT NULL,
  `id_user` int(191) NOT NULL,
  `isi_chat` text NOT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `isi_chat`
--

INSERT INTO `isi_chat` (`id_isi_chat`, `id_chat`, `id_user`, `isi_chat`, `tanggal`) VALUES
(18, 13, 12, 'Assalamualaikum', '2021-07-13 19:57:50'),
(19, 13, 9, 'Walaikumsalam', '2021-07-13 19:58:38'),
(20, 14, 16, 'Halo anak-anak, apa itu ayam?', '2021-07-26 23:24:42'),
(31, 20, 16, 'A', '2021-07-31 09:53:57'),
(32, 21, 16, 'Halo', '2021-08-02 15:13:00'),
(33, 21, 11, 'halo', '2021-08-02 15:16:40'),
(34, 22, 16, 'asdasdasd', '2021-08-04 04:21:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `mata_pelajaran_id` varchar(191) NOT NULL,
  `kelas_id` varchar(191) NOT NULL,
  `hari` varchar(191) NOT NULL,
  `jam_mulai` varchar(191) NOT NULL,
  `jam_selesai` varchar(191) NOT NULL,
  `status` enum('belum','dipilih') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `mata_pelajaran_id`, `kelas_id`, `hari`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(13, '23', '14', 'senin', '08:00', '10:00', 'dipilih'),
(14, '29', '14', 'senin', '10:30', '12:30', 'belum'),
(15, '24', '14', 'selasa', '08:00', '10:00', 'belum'),
(16, '27', '14', 'selasa', '10:30', '12:30', 'belum'),
(17, '21', '14', 'rabu', '08:00', '10:00', 'belum'),
(18, '28', '14', 'rabu', '10:30', '12:30', 'belum'),
(19, '25', '14', 'kamis', '08:00', '10:00', 'belum'),
(20, '33', '14', 'kamis', '10:30', '12:30', 'belum'),
(21, '22', '14', 'jumat', '08:00', '10:00', 'belum'),
(22, '26', '14', 'jumat', '10:30', '12:30', 'belum'),
(23, '34', '14', 'sabtu', '08:00', '10:00', 'belum'),
(24, '35', '14', 'sabtu', '10:30', '12:30', 'dipilih'),
(25, '23', '20', 'senin', '08:00', '10:00', 'dipilih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_tugas`
--

CREATE TABLE `kelas_tugas` (
  `id_klstugas` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas_tugas`
--

INSERT INTO `kelas_tugas` (`id_klstugas`, `id_tugas`, `id_kelas`, `aktif`) VALUES
(9, 2, 13, 'N'),
(10, 3, 14, 'Y'),
(11, 4, 14, 'Y'),
(12, 5, 14, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_ujian`
--

CREATE TABLE `kelas_ujian` (
  `id_klsujian` int(11) NOT NULL,
  `id_ujian` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas_ujian`
--

INSERT INTO `kelas_ujian` (`id_klsujian`, `id_ujian`, `id_kelas`, `aktif`) VALUES
(22, 46, 14, 'Y'),
(21, 45, 14, 'Y'),
(20, 40, 14, 'Y'),
(19, 39, 14, 'Y'),
(30, 55, 20, 'Y'),
(24, 42, 14, 'Y'),
(29, 54, 20, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_ujianessay`
--

CREATE TABLE `kelas_ujianessay` (
  `id_klsessay` int(11) NOT NULL,
  `id_ujianessay` int(11) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(10) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_ujian` varchar(100) NOT NULL,
  `acak_soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `sisa_waktu` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `jml_benar` int(5) DEFAULT NULL,
  `jml_kosong` int(5) DEFAULT NULL,
  `jml_salah` int(5) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_materi`
--

CREATE TABLE `notifikasi_materi` (
  `id_notifikasi_materi` int(11) NOT NULL,
  `id_siswa` varchar(191) NOT NULL,
  `id_materi` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi_materi`
--

INSERT INTO `notifikasi_materi` (`id_notifikasi_materi`, `id_siswa`, `id_materi`) VALUES
(7, '12', '11'),
(8, '12', '13'),
(9, '12', '15'),
(10, '11', '11'),
(11, '11', '13'),
(12, '11', '15'),
(13, '11', '16'),
(14, '12', '16'),
(15, '12', '17'),
(16, '12', '18'),
(17, '15', '19'),
(18, '15', '20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_pengumuman`
--

CREATE TABLE `notifikasi_pengumuman` (
  `id_notifikasi_pengumuman` int(191) NOT NULL,
  `id_siswa` varchar(191) NOT NULL,
  `id_pengumuman` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi_pengumuman`
--

INSERT INTO `notifikasi_pengumuman` (`id_notifikasi_pengumuman`, `id_siswa`, `id_pengumuman`) VALUES
(21, '12', '13'),
(22, '11', '13'),
(23, '12', '14'),
(24, '11', '14'),
(25, '15', '16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_tugas`
--

CREATE TABLE `notifikasi_tugas` (
  `id_notifikasi_tugas` int(191) NOT NULL,
  `id_siswa` varchar(191) NOT NULL,
  `id_tugas` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi_tugas`
--

INSERT INTO `notifikasi_tugas` (`id_notifikasi_tugas`, `id_siswa`, `id_tugas`) VALUES
(4, '11', '9'),
(5, '11', '8'),
(6, '11', '7'),
(13, '12', '9'),
(14, '12', '8'),
(15, '12', '7'),
(16, '12', '11'),
(17, '15', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(10) NOT NULL,
  `id_pengirim` varchar(30) NOT NULL,
  `id_penerima` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `isi_pesan` longtext NOT NULL,
  `sudah_dibaca` enum('belum','sudah') NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `tanggal`, `isi_pesan`, `sudah_dibaca`, `id_kelas`) VALUES
(15, 'SMPDW14045', '', '2021-06-29', '<p>ini bahasa bali</p>\r\n', 'belum', 14),
(16, '14042005', 'Kirim Ke', '2021-06-29', 'bukan bahasa padang?', 'belum', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(5) NOT NULL,
  `id_ujian` int(5) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_1` text NOT NULL,
  `pilihan_2` text NOT NULL,
  `pilihan_3` text NOT NULL,
  `pilihan_4` text NOT NULL,
  `pilihan_5` text NOT NULL,
  `kunci` int(2) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `soal`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`, `pilihan_5`, `kunci`, `status`) VALUES
(106, 11, '1+18', '18', '19', '20', '21', '22', 2, 'Y'),
(105, 11, '1+17', '17', '18', '19', '20', '21', 1, 'Y'),
(104, 11, '1+16', '16', '17', '18', '19', '20', 1, 'Y'),
(103, 11, '1+15', '15', '16', '17', '18', '19', 1, 'Y'),
(102, 11, '1+14', '14', '15', '16', '17', '18', 1, 'Y'),
(101, 11, '1+13', '13', '14', '15', '16', '17', 2, 'Y'),
(100, 11, '1+12', '12', '13', '14', '15', '16', 3, 'Y'),
(99, 11, '1+11', '11', '12', '13', '14', '15', 4, 'Y'),
(98, 11, '1+10', '10', '11', '12', '13', '14', 5, 'Y'),
(97, 11, '1+9', '9', '10', '11', '12', '13', 4, 'Y'),
(96, 11, '1+8', '8', '9', '10', '11', '12', 3, 'Y'),
(95, 11, '1+7', '7', '8', '9', '10', '11', 2, 'Y'),
(94, 11, '1+6', '6', '7', '8', '9', '10', 3, 'Y'),
(93, 11, '1+5', '5', '6', '7', '8', '9', 2, 'Y'),
(92, 11, '1+4', '4', '5', '6', '7', '8', 2, 'Y'),
(91, 11, '1+3', '3', '4', '5', '6', '7', 2, 'Y'),
(90, 11, '1+2', '2', '3', '4', '5', '6', 3, 'Y'),
(89, 11, '1+1', '1', '2', '3', '4', '5', 2, 'Y'),
(107, 12, '<p>Pertanyaan 1?</p>\r\n', 'A', 'B', 'C', 'D', 'E', 1, 'Y'),
(113, 12, '1+3', '3', '4', '5', '6', '7', 2, 'Y'),
(112, 12, '1+2', '2', '3', '4', '5', '6', 3, 'Y'),
(111, 12, '1+1', '1', '2', '3', '4', '5', 2, 'Y'),
(114, 12, '1+4', '4', '5', '6', '7', '8', 2, 'Y'),
(115, 13, '1+1', '1', '2', '3', '4', '5', 2, 'Y'),
(116, 13, '1+2', '2', '3', '4', '5', '6', 3, 'Y'),
(117, 13, '1+3', '3', '4', '5', '6', '7', 2, 'Y'),
(118, 13, '1+4', '4', '5', '6', '7', '8', 2, 'Y'),
(119, 13, '1+5', '5', '6', '7', '9', '8', 2, 'Y'),
(120, 14, '<p>Soal nomor satu?</p>\r\n', 'A benar', 'B', 'C', 'D', 'E', 1, 'Y'),
(121, 14, '1+1', '1', '2', '3', '4', '5', 2, 'Y'),
(122, 14, '1+2', '2', '3', '4', '5', '6', 2, 'Y'),
(123, 14, '1+3', '3', '4', '5', '6', '7', 2, 'Y'),
(124, 14, '1+4', '4', '6', '5', '7', '8', 3, 'Y'),
(125, 19, '<p>aa</p>\r\n', 'a', 'b', 'c', 'd', 'e', 4, 'Y'),
(126, 20, '<p>Ayam adalah</p>\r\n', 'Binatang', 'Manusia', 'c', 'd', 'e', 1, 'Y'),
(127, 20, '<p>Saya</p>\r\n', 'a', 'c', 'v', 'aa', '', 2, 'Y'),
(128, 20, '<p>a</p>\r\n', 'a', 'a', 'a', 'a', 'a', 1, 'Y'),
(129, 20, '<p>aaaa</p>\r\n', 'a', 'a', 'a', 'a', 'a', 1, 'Y'),
(130, 21, '<p>Apa itu bahasa bali?</p>\r\n', 'a', 'b', 'c', 'd', 'e', 1, 'Y'),
(131, 21, '<p>dimana bali?</p>\r\n', 'bali', 'sumaera', 'sulawesi', 'kalimantan', 'papua', 1, 'Y'),
(132, 21, '<p>Kenapa</p>\r\n', 'a', 'b', 'c', 'd', 'e', 1, 'Y'),
(133, 22, '<p>Apa itu?</p>\r\n', 'a', 'b', 'c', 'd', 'e', 1, 'Y'),
(134, 23, '<p>a</p>\r\n', 'a', 'a', 'a', 'a', 'a', 4, 'Y'),
(135, 23, '<p>b</p>\r\n', 'b', 'b', 'b', 'b', 'b', 2, 'Y'),
(136, 23, '<p>v</p>\r\n', 'v', 'v', 'v', 'v', 'v', 4, 'Y'),
(137, 24, '<p>a</p>\r\n', 'a', 'a', 'a', 'a', 'a', 2, 'Y'),
(138, 25, '<p>Lama waktu permainan sepak bola adalah ...</p>\r\n', ' 2 X 30 menit', '2 X 40 menit', '2 X 45 menit', '2 X 50 menit', '2 X 60 Menit', 3, 'Y'),
(139, 25, '<p>Pada pertandingan sepak bola pergantian pemain maksimal sebanyak ...</p>\r\n', '1', '2', '3', '4', '5', 5, 'Y'),
(140, 25, '<p>Yang tidak termasuk teknik badan dalam permainan sepak bola adalah ...</p>\r\n', 'Cara berlari', 'Melompat', 'Cara gerak tipu badan', 'Cara mencari daerah kosong', 'Cara menendang bola yang benar', 4, 'Y'),
(141, 26, '<p>a</p>\r\n', 'a', 'a', 'a', 'a', 'a', 1, 'Y'),
(142, 26, '<p>b</p>\r\n', 'b', 'b', 'b', 'b', 'b', 3, 'Y'),
(147, 28, '<p>Dengan apa kita menendang bola?</p>\r\n', 'Kaki', 'Tangan', 'Mata', 'Mulut', 'Hidung', 1, 'Y'),
(148, 30, '<p>asd</p>\r\n', 'asd', 'asd', 'asd', 'asd', 'asd', 1, 'Y'),
(149, 30, '<p>asdasdasd</p>\r\n', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 1, 'Y'),
(150, 30, '<p>asdasd</p>\r\n', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 2, 'Y'),
(151, 34, '<p>1 + 1</p>\r\n', '1', '2', '3', '4', '5', 2, 'Y'),
(152, 34, '<p>1 + 1</p>\r\n', '1', '2', '3', '4', '5', 2, 'Y'),
(153, 34, '<p>1 + 1</p>\r\n', '1', '2', '3', '4', '5', 2, 'Y'),
(154, 37, '<p>1 + 1</p>\r\n', '1', '2', '3', '4', '5', 2, 'Y'),
(155, 37, '<p>2 + 3</p>\r\n', '2', '3', '4', '5', '6', 4, 'Y'),
(156, 37, '<p>4+3</p>\r\n', '3', '4', '5', '6', '7', 5, 'Y'),
(157, 39, '<p>1 + 1</p>\r\n', '1', '2', '3', '4', '5', 2, 'Y'),
(158, 40, '<p>1</p>\r\n', '2', '3', '4', '5', '6', 1, 'Y'),
(159, 45, '<p>1</p>\r\n', '2', '3', '4', '5', '6', 2, 'Y'),
(160, 45, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 4, 'Y'),
(161, 45, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 3, 'Y'),
(162, 51, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(163, 51, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 2, 'Y'),
(164, 51, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(165, 52, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(166, 52, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(167, 52, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(168, 54, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y'),
(169, 55, '<p>1</p>\r\n', '1', '1', '1', '1', '1', 1, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_essay`
--

CREATE TABLE `soal_essay` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `soal` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `soal_essay`
--

INSERT INTO `soal_essay` (`id_soal`, `id_ujian`, `soal`, `status`) VALUES
(2, 17, '<p>Apa maksudmu ?</p>\r\n', 'Y'),
(3, 29, '<p>asdawdasdwasd</p>\r\n', 'Y'),
(4, 29, '<p>asdwasdwasdwasdw</p>\r\n', 'Y'),
(5, 29, '<p>asdwasdwasdwasdwa</p>\r\n', 'Y'),
(7, 32, '<p>Siapa?</p>\r\n', 'Y'),
(8, 32, '<p>Apa</p>\r\n', 'Y'),
(10, 33, '<p>Apa itu&nbsp;</p>\r\n', 'Y'),
(11, 33, '<p>bagaimana</p>\r\n', 'Y'),
(12, 33, '<p>kapan</p>\r\n', 'Y'),
(13, 38, '<p>Tahun berapa</p>\r\n', 'Y'),
(14, 38, '<p>adfadf</p>\r\n', 'Y'),
(15, 38, '<p>Kenapa Komputer</p>\r\n', 'Y'),
(16, 42, '<p>kenapa ?</p>\r\n', 'Y'),
(17, 46, '<p>1</p>\r\n', 'Y'),
(18, 47, '<p>1 + 1</p>\r\n', 'Y'),
(19, 48, '<p>asdasdasdsasd</p>\r\n', 'Y'),
(20, 48, '<p>asdasdasd</p>\r\n', 'Y'),
(21, 53, '<p>1</p>\r\n', 'Y'),
(22, 53, '<p>1</p>\r\n', 'Y'),
(23, 53, '<p>1</p>\r\n', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `aktif` varchar(5) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `aktif`, `foto`) VALUES
(1, 'Admin SMP', 'Admin', 'c0dd98c1f6deb8ba87ceb9afe6adee2781d80ce9', 'Y', '376 GUSTI.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_guru` varchar(120) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL,
  `date_created` date NOT NULL,
  `confirm` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nik`, `nama_guru`, `username`, `password`, `foto`, `status`, `date_created`, `confirm`) VALUES
(16, 'SMPDW01', 'Made Lintang Sanjaya, S.Pd.', 'Made Lintang Sanjaya', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', '58 SUARTAMA.png', 'Y', '2021-07-26', 'Yes'),
(17, 'SMPDW02', 'I Made Jayantara, S.E.', 'I Made Jayantara', '47f4a1281b6b0e1711980f9dc5201ff074aada54', '35.jpg', 'Y', '2021-07-26', 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenisperangkat`
--

CREATE TABLE `tb_jenisperangkat` (
  `id_jenisperangkat` int(11) NOT NULL,
  `jenis_perangkat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenisperangkat`
--

INSERT INTO `tb_jenisperangkat` (`id_jenisperangkat`, `jenis_perangkat`) VALUES
(1, 'RPP'),
(2, 'SILABUS'),
(3, 'MODUL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenistugas`
--

CREATE TABLE `tb_jenistugas` (
  `id_jenistugas` int(11) NOT NULL,
  `jenis_tugas` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenistugas`
--

INSERT INTO `tb_jenistugas` (`id_jenistugas`, `jenis_tugas`) VALUES
(1, 'INDIVIDU'),
(2, 'KELOMPOK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenisujian`
--

CREATE TABLE `tb_jenisujian` (
  `id_jenis` int(11) NOT NULL,
  `jenis_ujian` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenisujian`
--

INSERT INTO `tb_jenisujian` (`id_jenis`, `jenis_ujian`) VALUES
(5, 'Ulangan Tengah Semester'),
(6, 'Ulangan Harian'),
(7, 'Ulangan Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_kelas`
--

CREATE TABLE `tb_master_kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_master_kelas`
--

INSERT INTO `tb_master_kelas` (`id_kelas`, `kelas`) VALUES
(20, 'VII A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_mapel`
--

CREATE TABLE `tb_master_mapel` (
  `id_mapel` int(11) NOT NULL,
  `mapel` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_master_mapel`
--

INSERT INTO `tb_master_mapel` (`id_mapel`, `mapel`) VALUES
(22, 'IPS'),
(23, 'Matematika'),
(24, 'Bahasa Indonesia'),
(25, 'Bahasa Inggris'),
(26, 'Bahasa Bali'),
(27, 'PPKN'),
(28, 'Penjaskes'),
(29, 'Seni Budaya'),
(33, 'Prakarya'),
(34, 'Agama & Budi Pekerti'),
(35, 'Teknologi Informatika'),
(36, 'IPA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_master_semester`
--

CREATE TABLE `tb_master_semester` (
  `id_semester` int(11) NOT NULL,
  `semester` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_master_semester`
--

INSERT INTO `tb_master_semester` (`id_semester`, `semester`) VALUES
(4, 'GENAP'),
(5, 'GANJIL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_materi`
--

CREATE TABLE `tb_materi` (
  `id_materi` int(11) NOT NULL,
  `judul_materi` varchar(120) NOT NULL,
  `materi` text NOT NULL,
  `nama_file` varchar(120) NOT NULL,
  `tipe_file` varchar(20) NOT NULL,
  `ukuran_file` varchar(30) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tgl_entry` date NOT NULL,
  `id_roleguru` int(11) NOT NULL,
  `public` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `roleguru` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`id`, `judul`, `isi`, `tgl`, `roleguru`) VALUES
(5, 'Ujian Praktek', 'Hari ini ujian praktek jangan lupa', '2021-07-14 15:00:23', '7'),
(6, 'Ujian Prkatek seni budaya', 'ujian praktek', '2021-07-15 07:41:48', '8'),
(8, 'Praktek olahraga', 'praktek', '2021-07-19 13:21:34', '14'),
(9, 'libur TELAH TIBA', 'libur hore', '2021-07-19 13:24:17', '14'),
(10, 'aaaa', 'asdasd', '2021-07-27 00:11:54', '16'),
(11, 'Agama adlah mustlak', 'asasdasdasd', '2021-07-27 00:14:09', '15'),
(12, 'asdasd', 'asdsad', '2021-07-27 00:14:18', '15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perangkat`
--

CREATE TABLE `tb_perangkat` (
  `id_perangkat` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_file` varchar(120) NOT NULL,
  `tipe_file` varchar(20) NOT NULL,
  `ukuran_file` varchar(30) NOT NULL,
  `file` varchar(255) NOT NULL,
  `isi_perangkat` text NOT NULL,
  `id_jenisperangkat` int(11) NOT NULL,
  `tgl_entry` date NOT NULL,
  `publish` int(11) NOT NULL,
  `id_roleguru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_roleguru`
--

CREATE TABLE `tb_roleguru` (
  `id_roleguru` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `jadwal_id` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_roleguru`
--

INSERT INTO `tb_roleguru` (`id_roleguru`, `id_guru`, `id_kelas`, `id_mapel`, `id_semester`, `jadwal_id`) VALUES
(29, 16, 20, 23, 4, '25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(120) NOT NULL,
  `kepsek` varchar(120) NOT NULL,
  `textlogo` varchar(120) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sekolah`, `kepsek`, `textlogo`, `logo`, `copyright`) VALUES
(1, 'SMP DHARMA WIWEKA', 'Drs. I Nyoman Mariana M.Si', 'E-LEARNING', 'smpdw.png', 'SMP DHARMA WIWEKA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama_siswa` varchar(120) NOT NULL,
  `jk` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `aktif` varchar(30) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `confirm` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `jk`, `password`, `status`, `aktif`, `tingkat`, `foto`, `id_kelas`, `confirm`) VALUES
(10, '10104001', 'Firizki', 'L', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', 'off', 'Y', '0', 'logo bpn.png', 13, 'Yes'),
(11, '170030089', 'Putu Ryan Jayendra', 'L', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', 'off', 'Y', '0', '58.png', 14, 'Yes'),
(12, '170030010', 'Bagas Kayana Putra', 'L', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', 'selesai', 'Y', '0', '232 MURTIKA.png', 14, 'Yes'),
(13, '170030020', 'Gita Putri', 'P', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', 'off', 'Y', '0', '58 SUARTAMA.png', 14, 'Yes'),
(15, '170030089', 'Putu Ryan Jayendra', 'L', '2f8a199d2aab84b19a71ab38bea6b00981fe9714', 'Online', 'Y', '0', '11.png', 20, 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tugas`
--

CREATE TABLE `tb_tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_jenistugas` int(11) NOT NULL,
  `judul_tugas` varchar(100) NOT NULL,
  `isi_tugas` text NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` int(30) NOT NULL,
  `jml_anggota` int(30) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tugas`
--

INSERT INTO `tb_tugas` (`id_tugas`, `id_jenistugas`, `judul_tugas`, `isi_tugas`, `tanggal`, `waktu`, `jml_anggota`, `id_guru`, `id_mapel`, `id_semester`) VALUES
(1, 1, 'Membuat Kalkulator sederhan dengan PHP', '<p>Segera kerjakan tugas makalah membuat kalkulator berbasis web PHP</p>\r\n', '2020-04-21', 3, 0, 7, 11, 2),
(2, 2, 'tugas', '<p>11111</p>\r\n', '2021-05-21', 1, 0, 8, 11, 1),
(3, 1, 'Agama adlah mustlak', '<p>Bikin makalah 2 bab</p>\r\n', '2021-05-25', 7, 0, 12, 26, 2),
(4, 2, 'Agama adlah mustlak', '<p>Bikin makalah</p>\r\n', '2021-05-25', 7, 3, 12, 24, 2),
(5, 1, 'Sistem Informasi Pengelolaan Tamu Charter Dan Driver Freelance Pada Bali Made Tour Berbasis Web.', '<p>asdasdasdasdada</p>\r\n', '2021-05-24', 2, 0, 12, 26, 2),
(6, 2, 'Membuat makalah tentang bahasa bali', '<p>Buat makalah</p>\r\n', '2021-07-01', 5, 0, 12, 26, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id_tgssiswa` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `subjek` varchar(120) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kelompok` text NOT NULL,
  `nama_file` varchar(120) NOT NULL,
  `tipe_file` varchar(30) NOT NULL,
  `ukuran_file` varchar(30) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tugas_siswa`
--

INSERT INTO `tugas_siswa` (`id_tgssiswa`, `id_tugas`, `subjek`, `id_siswa`, `kelompok`, `nama_file`, `tipe_file`, `ukuran_file`, `file`, `tgl_upload`, `ket`) VALUES
(1, 1, 'Membuat Kalkulator sederhan dengan PHP', 1, '', '1587473255', 'doc', '1483', '../vendor/file/tugasTUGAS-INDIVIDU_1587473255.doc', '2020-04-21', 'Selesai'),
(2, 12, '123123123132', 15, '', '1628024630', 'docx', '219037', '../vendor/file/tugasTUGAS-INDIVIDU_1628024630.docx', '2021-08-04', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(5) NOT NULL,
  `kategori` enum('pilgan','essay') DEFAULT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `jml_soal` int(30) NOT NULL,
  `acak` varchar(100) NOT NULL,
  `tipe` int(1) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `jam_mulai` varchar(191) NOT NULL,
  `jam_selesai` varchar(191) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `kategori`, `judul`, `tanggal`, `waktu`, `jml_soal`, `acak`, `tipe`, `id_jenis`, `id_guru`, `id_mapel`, `id_semester`, `jam_mulai`, `jam_selesai`) VALUES
(54, 'pilgan', 'Aritmatika', '2021-08-04', '00:00:00', 1, 'acak', 0, 7, 16, 23, 4, '12:50', '15:00'),
(55, 'pilgan', 'Aritmatika', '2021-08-04', '03:00:00', 1, 'acak', 0, 7, 16, 23, 4, '15:00', '18:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_essay`
--

CREATE TABLE `ujian_essay` (
  `id_ujianessay` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jml_soal` int(30) NOT NULL,
  `soal_essay` text NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `analisis`
--
ALTER TABLE `analisis`
  ADD PRIMARY KEY (`id_analisis`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indeks untuk tabel `isi_chat`
--
ALTER TABLE `isi_chat`
  ADD PRIMARY KEY (`id_isi_chat`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kelas_tugas`
--
ALTER TABLE `kelas_tugas`
  ADD PRIMARY KEY (`id_klstugas`);

--
-- Indeks untuk tabel `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  ADD PRIMARY KEY (`id_klsujian`);

--
-- Indeks untuk tabel `kelas_ujianessay`
--
ALTER TABLE `kelas_ujianessay`
  ADD PRIMARY KEY (`id_klsessay`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `notifikasi_materi`
--
ALTER TABLE `notifikasi_materi`
  ADD PRIMARY KEY (`id_notifikasi_materi`);

--
-- Indeks untuk tabel `notifikasi_pengumuman`
--
ALTER TABLE `notifikasi_pengumuman`
  ADD PRIMARY KEY (`id_notifikasi_pengumuman`);

--
-- Indeks untuk tabel `notifikasi_tugas`
--
ALTER TABLE `notifikasi_tugas`
  ADD PRIMARY KEY (`id_notifikasi_tugas`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `soal_essay`
--
ALTER TABLE `soal_essay`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_jenisperangkat`
--
ALTER TABLE `tb_jenisperangkat`
  ADD PRIMARY KEY (`id_jenisperangkat`);

--
-- Indeks untuk tabel `tb_jenistugas`
--
ALTER TABLE `tb_jenistugas`
  ADD PRIMARY KEY (`id_jenistugas`);

--
-- Indeks untuk tabel `tb_jenisujian`
--
ALTER TABLE `tb_jenisujian`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_master_kelas`
--
ALTER TABLE `tb_master_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `tb_master_semester`
--
ALTER TABLE `tb_master_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `id_roleguru` (`id_roleguru`);

--
-- Indeks untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD PRIMARY KEY (`id_perangkat`),
  ADD KEY `id_roleguru` (`id_roleguru`);

--
-- Indeks untuk tabel `tb_roleguru`
--
ALTER TABLE `tb_roleguru`
  ADD PRIMARY KEY (`id_roleguru`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_semester` (`id_semester`);

--
-- Indeks untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id_tgssiswa`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `ujian_essay`
--
ALTER TABLE `ujian_essay`
  ADD PRIMARY KEY (`id_ujianessay`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `analisis`
--
ALTER TABLE `analisis`
  MODIFY `id_analisis` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `isi_chat`
--
ALTER TABLE `isi_chat`
  MODIFY `id_isi_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `kelas_tugas`
--
ALTER TABLE `kelas_tugas`
  MODIFY `id_klstugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  MODIFY `id_klsujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `kelas_ujianessay`
--
ALTER TABLE `kelas_ujianessay`
  MODIFY `id_klsessay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_materi`
--
ALTER TABLE `notifikasi_materi`
  MODIFY `id_notifikasi_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_pengumuman`
--
ALTER TABLE `notifikasi_pengumuman`
  MODIFY `id_notifikasi_pengumuman` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_tugas`
--
ALTER TABLE `notifikasi_tugas`
  MODIFY `id_notifikasi_tugas` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `soal_essay`
--
ALTER TABLE `soal_essay`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_jenisperangkat`
--
ALTER TABLE `tb_jenisperangkat`
  MODIFY `id_jenisperangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_jenistugas`
--
ALTER TABLE `tb_jenistugas`
  MODIFY `id_jenistugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jenisujian`
--
ALTER TABLE `tb_jenisujian`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_master_kelas`
--
ALTER TABLE `tb_master_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_master_mapel`
--
ALTER TABLE `tb_master_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_master_semester`
--
ALTER TABLE `tb_master_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_materi`
--
ALTER TABLE `tb_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  MODIFY `id_perangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_roleguru`
--
ALTER TABLE `tb_roleguru`
  MODIFY `id_roleguru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id_tgssiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `ujian_essay`
--
ALTER TABLE `ujian_essay`
  MODIFY `id_ujianessay` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_materi`
--
ALTER TABLE `tb_materi`
  ADD CONSTRAINT `tb_materi_ibfk_1` FOREIGN KEY (`id_roleguru`) REFERENCES `tb_roleguru` (`id_roleguru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD CONSTRAINT `tb_perangkat_ibfk_1` FOREIGN KEY (`id_roleguru`) REFERENCES `tb_roleguru` (`id_roleguru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_roleguru`
--
ALTER TABLE `tb_roleguru`
  ADD CONSTRAINT `tb_roleguru_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_roleguru_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `tb_master_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_roleguru_ibfk_4` FOREIGN KEY (`id_mapel`) REFERENCES `tb_master_mapel` (`id_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_roleguru_ibfk_5` FOREIGN KEY (`id_semester`) REFERENCES `tb_master_semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
