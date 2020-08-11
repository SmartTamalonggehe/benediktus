-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 23.15
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benediktus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `NIDN` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_dosen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenkel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `matkul_id` bigint(20) UNSIGNED NOT NULL,
  `ruang_id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_seles` time NOT NULL,
  `semester_ak` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ak` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `nm_kelas` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuota` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `khs`
--

CREATE TABLE `khs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mhs_id` bigint(20) UNSIGNED NOT NULL,
  `semester_ak` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ak` year(4) NOT NULL,
  `gambar_khs` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IPK` double NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `khs`
--

INSERT INTO `khs` (`id`, `mhs_id`, `semester_ak`, `tahun_ak`, `gambar_khs`, `IPK`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 'GENAP', 2020, 'gambar_khs/1597039994.png', 2.5, 'Aktif', '2020-08-09 16:54:18', '2020-08-09 21:13:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak`
--

CREATE TABLE `kontrak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `krs_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perwalian_id` bigint(20) UNSIGNED NOT NULL,
  `semester_ak` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ak` year(4) NOT NULL,
  `tgl_krs` date NOT NULL,
  `ket` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_matkul` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_matkul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id`, `kd_matkul`, `nm_matkul`, `sks`, `semester`, `created_at`, `updated_at`) VALUES
(1, 'qQgvkevyVY', 'Dolorum possimus iste.', 6, 6, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(2, 'AoiKpBjZjO', 'Ea voluptatem.', 1, 3, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(3, 'ZjdT0hHabe', 'Voluptate dignissimos.', 6, 7, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(4, 'yw06J9fVij', 'Voluptatibus voluptate.', 3, 8, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(5, 'GAPOzpFKeA', 'Repudiandae in sint.', 4, 8, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(6, 'IjkLFOEQEt', 'Praesentium et.', 4, 7, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(7, 'VzSlJCUOco', 'Nulla sed.', 6, 6, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(8, 'jlAmYUOrSb', 'Officiis quia.', 4, 3, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(9, 'W9XZ2h5EuC', 'Fugiat suscipit.', 6, 1, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(10, '4CQqLpU5fA', 'Ut in est.', 4, 2, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(11, 'bNIiynJcEX', 'Ut fugit quaerat.', 6, 2, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(12, 'V07uWg7VY7', 'Ut fugiat.', 2, 7, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(13, 'IA5RfurwqF', 'Iste optio.', 5, 1, '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(14, 'd4InOnWJdE', 'Cum optio ab.', 4, 5, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(15, 'IkG0y7Do8G', 'Mollitia officia.', 1, 1, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(16, '5R499RYM1p', 'Voluptas sequi.', 1, 4, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(17, 'fATFrJL5Ce', 'Ut consequatur eum.', 4, 4, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(18, 'WdB1ZZ6YHw', 'Voluptates sit odio.', 2, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(19, '8iah9fzZy2', 'Nemo aperiam rerum.', 2, 2, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(20, 'ocoV3BUknD', 'Neque sunt.', 1, 2, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(21, 'Ef0mGCAm7U', 'Reprehenderit nobis.', 3, 7, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(22, 'zzbuGVdbhA', 'Odit deleniti aliquid.', 6, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(23, 'c1qxAvxGZ0', 'Unde officia.', 2, 2, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(24, 'ivIRBaUxuA', 'Quos id.', 5, 2, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(25, '5zzlxHxehy', 'Et in.', 2, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(26, 'GdqAkvFKND', 'Qui placeat.', 3, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(27, 'UYioFWsrT4', 'Dignissimos ut.', 1, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(28, '1kiuO4RPcr', 'Maxime et.', 1, 1, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(29, 'mCQfwU20ak', 'Sed expedita.', 5, 2, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(30, 'X6l4CvfkMj', 'Autem voluptatem culpa.', 4, 1, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(31, 'pQ4LjXqKtN', 'Dolorum est.', 2, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(32, 'rykpKyOnmu', 'Rerum sed.', 4, 6, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(33, '8FXUXqc0pW', 'Qui sapiente.', 3, 5, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(34, '0gxWDGEsOZ', 'Facere sit.', 4, 7, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(35, 'dDTJnmsz8k', 'Omnis aperiam esse.', 4, 8, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(36, 'ROSQL7uDVg', 'Et voluptates.', 6, 5, '2020-08-09 14:56:37', '2020-08-09 14:56:37'),
(37, '8Z7prRstL0', 'Pariatur voluptates rem.', 4, 5, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(38, '2dWVytrBSd', 'Sit quam necessitatibus.', 2, 5, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(39, 'syrzrU9E8q', 'Quia omnis vitae.', 1, 4, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(40, 'LzWr7saxXq', 'Et et incidunt.', 1, 7, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(41, 'TlWjPPQ65f', 'Quidem quod.', 2, 1, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(42, 'ei0IXaLa72', 'Voluptatem saepe nam.', 1, 2, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(43, 'rOZhDk26EO', 'Aut qui.', 2, 4, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(44, '6qFqP0saYV', 'Reiciendis esse.', 2, 2, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(45, 'HXWJz67WaE', 'Est non quaerat.', 5, 5, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(46, 'VNQ2Igevm9', 'Temporibus praesentium.', 5, 8, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(47, 'pcqHHyh0vh', 'Itaque natus deserunt.', 3, 5, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(48, 'EiAhZ1pfEN', 'Qui quos.', 6, 8, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(49, 'gWPw7V9hT0', 'Aliquid nulla.', 2, 7, '2020-08-09 14:56:38', '2020-08-09 14:56:38'),
(50, 'Wo1BSpmYtT', 'Et eligendi.', 3, 1, '2020-08-09 14:56:38', '2020-08-09 14:56:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs`
--

CREATE TABLE `mhs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NPM` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `nm_mhs` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenkel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` year(4) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mhs`
--

INSERT INTO `mhs` (`id`, `NPM`, `prodi_id`, `nm_mhs`, `password`, `jenkel`, `angkatan`, `alamat`, `created_at`, `updated_at`) VALUES
(3, '5720140010', 1, 'Moncex', 'E3T2C5II', 'Laki-laki', 2014, '-', '2020-08-09 14:58:50', '2020-08-09 14:58:50'),
(4, '5720140011', 1, 'Vamix', 'MHP5SLIH', 'Laki-laki', 2014, '-', '2020-08-09 14:59:18', '2020-08-09 14:59:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_033606_create_prodi_table', 1),
(5, '2020_01_11_144623_create_matkul_table', 1),
(6, '2020_01_11_144732_create_mhs_table', 1),
(7, '2020_01_11_144748_create_ruang_table', 1),
(8, '2020_01_11_144818_create_dosen_table', 1),
(9, '2020_01_11_153522_create_jadwal_table', 1),
(10, '2020_04_28_013258_create_kelas_table', 1),
(11, '2020_06_10_072358_create_perwalian_table', 1),
(12, '2020_06_24_214143_create_tools_table', 1),
(13, '2020_08_07_122115_create_krs_table', 1),
(14, '2020_08_07_122559_create_permission_tables', 1),
(15, '2020_08_07_123348_create_kontrak_table', 1),
(16, '2020_08_07_123444_create_khs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(3, 'App\\User', 2),
(4, 'App\\User', 3),
(4, 'App\\User', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perwalian`
--

CREATE TABLE `perwalian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mhs_id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_prodi` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_prodi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `kd_prodi`, `nm_prodi`, `created_at`, `updated_at`) VALUES
(1, 'SI', 'Sistem Informasi', '2020-08-09 14:56:35', '2020-08-09 14:56:35'),
(2, 'TG', 'Teknik Geologi', '2020-08-09 14:56:36', '2020-08-09 14:56:36'),
(3, 'BI', 'Biologi', '2020-08-09 14:56:36', '2020-08-09 14:56:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-08-09 14:56:35', '2020-08-09 14:56:35'),
(2, 'Dosen', 'web', '2020-08-09 14:56:35', '2020-08-09 14:56:35'),
(3, 'Staf', 'web', '2020-08-09 14:56:35', '2020-08-09 14:56:35'),
(4, 'Mahasiswa', 'web', '2020-08-09 14:56:35', '2020-08-09 14:56:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_ruang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_ruang` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tools`
--

CREATE TABLE `tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_tool` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prodi` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenkel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_tool` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tools`
--

INSERT INTO `tools` (`id`, `nm_tool`, `id_prodi`, `username`, `password`, `jenkel`, `jabatan`, `alamat`, `foto_tool`, `created_at`, `updated_at`) VALUES
(2, 'Maria', 1, 'sistemmaria', 'O4OEMRLJ', 'Perempuan', 'Staf', '-', 'images/Tidak Ada.jpg', '2020-08-09 14:57:30', '2020-08-09 14:57:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', 'admin@mail.com', NULL, '$2y$10$H0GZW1w4Tm1KJmTEV1TLj.7wyOC/GXkrQGIdc6EagGwcvY8nti6DG', NULL, '2020-08-09 14:56:35', '2020-08-09 14:56:35'),
(2, 'sistemmaria', 'sistemmaria', NULL, '$2y$10$/6mZARDn1N6J2la/giaU4.gkYYCWs/PUQiKQ2YW.ys/P24yFzR1K.', NULL, '2020-08-09 14:57:30', '2020-08-09 14:57:30'),
(3, '5720140010', '5720140010', NULL, '$2y$10$2n0W1e2XyeZxoASTG1DN/ugHqbPZd3MitBB9gRelFSGeqJ1ye9VVW', NULL, '2020-08-09 14:58:50', '2020-08-09 14:58:50'),
(4, '5720140011', '5720140011', NULL, '$2y$10$KgBs3hrjMMIDIIMYlOZP.Olxvg2onBygPhkMYD3fpgHDmef3aw5MK', NULL, '2020-08-09 14:59:18', '2020-08-09 14:59:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosen_nidn_unique` (`NIDN`),
  ADD KEY `dosen_prodi_id_foreign` (`prodi_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_prodi_id_foreign` (`prodi_id`),
  ADD KEY `jadwal_matkul_id_foreign` (`matkul_id`),
  ADD KEY `jadwal_ruang_id_foreign` (`ruang_id`),
  ADD KEY `jadwal_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_jadwal_id_foreign` (`jadwal_id`);

--
-- Indeks untuk tabel `khs`
--
ALTER TABLE `khs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khs_mhs_id_foreign` (`mhs_id`);

--
-- Indeks untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontrak_krs_id_foreign` (`krs_id`),
  ADD KEY `kontrak_jadwal_id_foreign` (`jadwal_id`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `krs_perwalian_id_foreign` (`perwalian_id`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matkul_kd_matkul_unique` (`kd_matkul`);

--
-- Indeks untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mhs_npm_unique` (`NPM`),
  ADD KEY `mhs_prodi_id_foreign` (`prodi_id`);

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
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perwalian`
--
ALTER TABLE `perwalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perwalian_mhs_id_foreign` (`mhs_id`),
  ADD KEY `perwalian_dosen_id_foreign` (`dosen_id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodi_kd_prodi_unique` (`kd_prodi`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruang_kd_ruang_unique` (`kd_ruang`);

--
-- Indeks untuk tabel `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tools_username_unique` (`username`),
  ADD KEY `tools_id_prodi_foreign` (`id_prodi`);

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
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `khs`
--
ALTER TABLE `khs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perwalian`
--
ALTER TABLE `perwalian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tools`
--
ALTER TABLE `tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ruang_id_foreign` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `khs`
--
ALTER TABLE `khs`
  ADD CONSTRAINT `khs_mhs_id_foreign` FOREIGN KEY (`mhs_id`) REFERENCES `mhs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  ADD CONSTRAINT `kontrak_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontrak_krs_id_foreign` FOREIGN KEY (`krs_id`) REFERENCES `krs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_perwalian_id_foreign` FOREIGN KEY (`perwalian_id`) REFERENCES `perwalian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ketidakleluasaan untuk tabel `perwalian`
--
ALTER TABLE `perwalian`
  ADD CONSTRAINT `perwalian_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perwalian_mhs_id_foreign` FOREIGN KEY (`mhs_id`) REFERENCES `mhs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
