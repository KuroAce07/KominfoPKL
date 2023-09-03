-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2023 pada 13.30
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip_lamas`
--

CREATE TABLE `arsip_lamas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_spm` varchar(255) DEFAULT NULL,
  `tanggal_spm` date DEFAULT NULL,
  `nilai_spm` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `uraian_belanja` varchar(255) DEFAULT NULL,
  `sub_kegiatan` varchar(255) DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pph_21` varchar(255) DEFAULT NULL,
  `pph_22` varchar(255) DEFAULT NULL,
  `pph_23` varchar(255) DEFAULT NULL,
  `ppn` varchar(255) DEFAULT NULL,
  `ppnd` varchar(255) DEFAULT NULL,
  `lain_lain` varchar(255) DEFAULT NULL,
  `tanggal_sp2d` varchar(255) DEFAULT NULL,
  `no_sp2d` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baphs`
--

CREATE TABLE `baphs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `baps`
--

CREATE TABLE `baps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `basts`
--

CREATE TABLE `basts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_justifikasi`
--

CREATE TABLE `dokumen_justifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_kontraks`
--

CREATE TABLE `dokumen_kontraks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kontrak` varchar(255) NOT NULL,
  `nama_kegiatan_transaksi` varchar(255) NOT NULL,
  `tanggal_kontrak` date NOT NULL,
  `jumlah_uang` decimal(10,2) NOT NULL,
  `ppn` decimal(10,2) DEFAULT NULL,
  `pph` decimal(10,2) DEFAULT NULL,
  `jumlah_potongan` decimal(10,2) DEFAULT NULL,
  `jumlah_total` decimal(10,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumen_kontraks`
--

INSERT INTO `dokumen_kontraks` (`id`, `jenis_kontrak`, `nama_kegiatan_transaksi`, `tanggal_kontrak`, `jumlah_uang`, `ppn`, `pph`, `jumlah_potongan`, `jumlah_total`, `keterangan`, `upload_dokumen`, `created_at`, `updated_at`, `dpa_id`) VALUES
(3, 'Dokumen Kontrak (SPK)', '123123', '2023-08-24', '1234.00', '12414.00', '2414124.00', '12414.00', '1231.00', '41414', 'D:\\xampp\\tmp\\php3A19.tmp', '2023-08-22 09:18:35', '2023-08-22 09:18:35', 1),
(4, 'Surat Pemesanan', 'asda', '2023-08-13', '123.00', '123.00', '123.00', '123.00', '123.00', 'sadasd', 'D:\\xampp\\tmp\\phpAF33.tmp', '2023-08-23 01:12:40', '2023-08-23 01:12:40', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_pendukungs`
--

CREATE TABLE `dokumen_pendukungs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upload_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumen_pendukungs`
--

INSERT INTO `dokumen_pendukungs` (`id`, `nama`, `tanggal`, `keterangan`, `upload_dokumen`, `created_at`, `updated_at`, `dpa_id`) VALUES
(1, 'qweqwe', '2023-08-30', 'asdaw', 'D:\\xampp\\tmp\\php9E9.tmp', '2023-08-22 09:20:34', '2023-08-22 09:20:34', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dpa`
--

CREATE TABLE `dpa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_dpa` varchar(255) NOT NULL,
  `urusan_pemerintahan` varchar(255) NOT NULL,
  `bidang_urusan` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `nilai_rincian` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id2` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id3` bigint(20) UNSIGNED DEFAULT NULL,
  `rekanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dpa`
--

INSERT INTO `dpa` (`id`, `nomor_dpa`, `urusan_pemerintahan`, `bidang_urusan`, `program`, `kegiatan`, `nilai_rincian`, `user_id`, `user_id2`, `user_id3`, `rekanan_id`, `created_at`, `updated_at`) VALUES
(1, ' DPPA/A.2/2.16.2.20.2.21.01.0000/001/2023', ' 2 URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR', ' 2.16 URUSAN PEMERINTAHAN BIDANG KOMUNIKASI DAN INFORMATIKA', ' 2.16.01 PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA', ' 2.16.01.2.01 Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah', 'Rp10.948.000', 3, 4, 5, NULL, '2023-08-21 21:25:51', '2023-08-21 21:26:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `e_purchasings`
--

CREATE TABLE `e_purchasings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `e_commerce` varchar(255) NOT NULL,
  `id_paket` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_total` decimal(10,2) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `tanggal_ubah` date NOT NULL,
  `nama_pejabat_pengadaan` varchar(255) NOT NULL,
  `nama_penyedia` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_12_173356_create_permission_tables', 1),
(6, '2022_08_18_080043_create_rekanan_table', 1),
(7, '2023_07_19_134151_create_pdf_texts_table', 1),
(8, '2023_07_31_080044_create_dpa_table', 1),
(9, '2023_08_01_194927_create_arsip_lamas_table', 1),
(10, '2023_08_07_145321_create_sub_dpas_table', 1),
(11, '2023_08_08_033447_create_documents_table', 1),
(12, '2023_08_09_065854_create_tasks_table', 1),
(13, '2023_08_21_151347_create_multiple_tables', 1),
(15, '2023_08_23_104406_create_approval_statuses_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pdf_texts`
--

CREATE TABLE `pdf_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `extracted_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2023-08-21 21:23:19', '2023-08-21 21:23:19'),
(2, 'user-create', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(3, 'user-edit', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(4, 'user-delete', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(5, 'role-create', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(6, 'role-edit', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(7, 'role-list', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(8, 'role-delete', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(9, 'permission-list', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(10, 'permission-create', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(11, 'permission-edit', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20'),
(12, 'permission-delete', 'web', '2023-08-21 21:23:20', '2023-08-21 21:23:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilih_rekanans`
--

CREATE TABLE `pilih_rekanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pilih` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `jenis_pengadaan` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekanans`
--

CREATE TABLE `rekanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_rekanan` varchar(255) NOT NULL,
  `jenis_rekanan` enum('Perorangan','Perusahaan') NOT NULL,
  `nik_rekanan` varchar(255) DEFAULT NULL,
  `nomor_npwp` varchar(255) DEFAULT NULL,
  `nama_rekanan` varchar(255) NOT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `jenis_usaha` varchar(255) DEFAULT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `nama_cabang` varchar(255) DEFAULT NULL,
  `nomor_rekening` varchar(255) DEFAULT NULL,
  `nama_rekening` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2023-08-21 21:23:19', '2023-08-21 21:23:19'),
(2, 'User', 'web', '2023-08-21 21:23:19', '2023-08-21 21:23:19'),
(3, 'PPTK', 'web', '2023-08-21 21:24:07', '2023-08-21 21:24:07'),
(4, 'Pejabat Pengadaan', 'web', '2023-08-21 21:24:14', '2023-08-21 21:24:14'),
(5, 'Pembantu PPTK', 'web', '2023-08-21 21:24:20', '2023-08-21 21:24:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_dpa`
--

CREATE TABLE `sub_dpa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dpa_id` bigint(20) UNSIGNED NOT NULL,
  `sub_kegiatan` varchar(255) NOT NULL,
  `kode_rekening` varchar(255) NOT NULL,
  `uraian` text NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `koefisien` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `sumber_dana` text NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `jumlah_anggaran_sub_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_dpa`
--

INSERT INTO `sub_dpa` (`id`, `dpa_id`, `sub_kegiatan`, `kode_rekening`, `uraian`, `jumlah`, `koefisien`, `satuan`, `harga`, `sumber_dana`, `jenis_barang`, `jumlah_anggaran_sub_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, '2.16.01.2.01.01 Penyusunan Dokumen Perencanaan Perangkat Daerah', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor', 'Rp840.000\nRp840.000\nRp840.000\nRp840.000\nRp840.000\nRp840.000', '2100 Lembar', 'Lembar', 400, 'Dana Transfer Umum- Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp840.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(2, 1, '2.16.01.2.01.02 Koordinasi dan Penyusunan Dokumen RKA-SKPD', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor', 'Rp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000', '3125 Lembar', 'Lembar', 400, 'Dana Transfer Umum- Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp1.250.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(3, 1, '2.16.01.2.01.03 Koordinasi dan Penyusunan Dokumen Perubahan RKA-SKPD', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor\n ', 'Rp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000', '3125 Lembar', 'Lembar', 400, 'Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp1.250.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(4, 1, '2.16.01.2.01.04 Koordinasi dan Penyusunan DPA-SKPD', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor', 'Rp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000', '3125 Lembar', 'Lembar', 400, 'Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp1.250.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(5, 1, '2.16.01.2.01.05 Koordinasi dan Penyusunan Perubahan DPA- SKPD', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor', 'Rp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000', '3125 Lembar', 'Lembar', 400, 'Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp1.250.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(6, 1, '2.16.01.2.01.06 Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024\n5.1.02.04\n5.1.02.04.01\n5.1.02.04.01.0001', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor\nBelanja Perjalanan Dinas\nBelanja Perjalanan Dinas Dalam Negeri\nBelanja Perjalanan Dinas Biasa', 'Rp3.858.000\nRp3.858.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp2.608.000\nRp2.608.000\nRp2.608.000\nRp2.608.000\nRp968.000\nRp1.640.000', '3125 Lembar\n4 Orang / Kali\n4 Orang / Hari', 'Lembar\nOrang / Kali\nOrang / Hari', 242410, 'Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum\n [#] DAU Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopySpesifikasi : Biaya Transportasi Darat Dari Kota Batu Ke Kota Surabaya Dalam Provinsi Yang Sama One Way\nSpesifikasi : Uang Harian Perjalanan Dinas Dalam Negeri Luar Kota - Jawa Timur', 'Rp3.858.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51'),
(7, 1, '2.16.01.2.01.07 Evaluasi Kinerja Perangkat Daerah', '5.1\n5.1.02\n5.1.02.01\n5.1.02.01.01\n5.1.02.01.01.0024', 'BELANJA OPERASI\nBelanja Barang dan Jasa\nBelanja Barang\nBelanja Barang Pakai Habis\nBelanja Alat/Bahan untuk Kegiatan Kantor-Alat Tulis Kantor\n', 'Rp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000\nRp1.250.000', '3125 Lembar', 'Lembar', 400, 'Dana Transfer Umum-Dana Alokasi Umum Sumber Dana : Dana Transfer Umum-Dana Alokasi Umum', 'Fotocopy F4/A4 70 Gram Spesifikasi : Foto Copy F4/A4 70 Gram FotoCopy', 'Rp1.250.000', '2023-08-21 21:25:51', '2023-08-21 21:25:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=TA/TP',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile_number`, `email_verified_at`, `password`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@admin.com', '9028187696', NULL, '$2y$10$NG1j60vALA6ooYd97boMU.rFi5QQ5xa6lpkNiX2A3JzPuQVZM456u', 1, 1, NULL, '2023-08-21 21:23:19', '2023-08-21 21:23:19'),
(2, 'Backup', 'Admin', 'back@admin.com', '9028187696', NULL, '$2y$10$FyLk8e4W48DvXj0V1kpcqetc1WFen82TBGMFl.MROSH2Z60499AgW', 2, 1, NULL, '2023-08-21 21:23:19', '2023-08-21 21:23:19'),
(3, 'Muhammad Rifqi', 'Megananda', 'colderthanchernobyl@gmail.com', '1111111111', NULL, '$2y$10$I56kdStSFJbBw.BIIak5zuFld060xOSepjksUSGx920KPGhy9ntCG', 3, 1, NULL, '2023-08-21 21:24:50', '2023-08-22 23:27:17'),
(4, 'Muhammad', 'Pejabat', 'xxx@mail.com', '1111111112', NULL, '$2y$10$6jrGd6u95pSmd4.1Db2Tj.Sj0wAjN7hT6fDQeCZVZ4xLD8FyA/LVC', 4, 1, NULL, '2023-08-21 21:25:11', '2023-08-21 21:25:11'),
(5, 'Muhammad', 'PPPTK', 'mistralmissile98@gmail.com', '1111111113', NULL, '$2y$10$dUuMxjlygsIxHPLS9D1GrOdu2.WvV2I/ed5yTQfvbzcuIjO8sjAK6', 5, 1, NULL, '2023-08-21 21:25:31', '2023-08-23 01:11:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsip_lamas`
--
ALTER TABLE `arsip_lamas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `baphs`
--
ALTER TABLE `baphs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baphs_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `baps`
--
ALTER TABLE `baps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baps_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `basts`
--
ALTER TABLE `basts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basts_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `dokumen_justifikasi`
--
ALTER TABLE `dokumen_justifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_justifikasi_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `dokumen_kontraks`
--
ALTER TABLE `dokumen_kontraks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_kontraks_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `dokumen_pendukungs`
--
ALTER TABLE `dokumen_pendukungs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_pendukungs_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `dpa`
--
ALTER TABLE `dpa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dpa_user_id_foreign` (`user_id`),
  ADD KEY `dpa_user_id2_foreign` (`user_id2`),
  ADD KEY `dpa_user_id3_foreign` (`user_id3`),
  ADD KEY `dpa_rekanan_id_foreign` (`rekanan_id`);

--
-- Indeks untuk tabel `e_purchasings`
--
ALTER TABLE `e_purchasings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `e_purchasings_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pdf_texts`
--
ALTER TABLE `pdf_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pilih_rekanans`
--
ALTER TABLE `pilih_rekanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pilih_rekanans_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `rekanans`
--
ALTER TABLE `rekanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sub_dpa`
--
ALTER TABLE `sub_dpa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_dpa_dpa_id_foreign` (`dpa_id`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `arsip_lamas`
--
ALTER TABLE `arsip_lamas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baphs`
--
ALTER TABLE `baphs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `baps`
--
ALTER TABLE `baps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `basts`
--
ALTER TABLE `basts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumen_justifikasi`
--
ALTER TABLE `dokumen_justifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokumen_kontraks`
--
ALTER TABLE `dokumen_kontraks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dokumen_pendukungs`
--
ALTER TABLE `dokumen_pendukungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dpa`
--
ALTER TABLE `dpa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `e_purchasings`
--
ALTER TABLE `e_purchasings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pdf_texts`
--
ALTER TABLE `pdf_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pilih_rekanans`
--
ALTER TABLE `pilih_rekanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekanans`
--
ALTER TABLE `rekanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sub_dpa`
--
ALTER TABLE `sub_dpa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `baphs`
--
ALTER TABLE `baphs`
  ADD CONSTRAINT `baphs_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `baps`
--
ALTER TABLE `baps`
  ADD CONSTRAINT `baps_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `basts`
--
ALTER TABLE `basts`
  ADD CONSTRAINT `basts_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen_justifikasi`
--
ALTER TABLE `dokumen_justifikasi`
  ADD CONSTRAINT `dokumen_justifikasi_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen_kontraks`
--
ALTER TABLE `dokumen_kontraks`
  ADD CONSTRAINT `dokumen_kontraks_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokumen_pendukungs`
--
ALTER TABLE `dokumen_pendukungs`
  ADD CONSTRAINT `dokumen_pendukungs_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dpa`
--
ALTER TABLE `dpa`
  ADD CONSTRAINT `dpa_rekanan_id_foreign` FOREIGN KEY (`rekanan_id`) REFERENCES `rekanans` (`id`),
  ADD CONSTRAINT `dpa_user_id2_foreign` FOREIGN KEY (`user_id2`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dpa_user_id3_foreign` FOREIGN KEY (`user_id3`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dpa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `e_purchasings`
--
ALTER TABLE `e_purchasings`
  ADD CONSTRAINT `e_purchasings_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pilih_rekanans`
--
ALTER TABLE `pilih_rekanans`
  ADD CONSTRAINT `pilih_rekanans_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_dpa`
--
ALTER TABLE `sub_dpa`
  ADD CONSTRAINT `sub_dpa_dpa_id_foreign` FOREIGN KEY (`dpa_id`) REFERENCES `dpa` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
