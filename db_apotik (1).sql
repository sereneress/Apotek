-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Nov 2025 pada 14.01
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
-- Database: `db_apotik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apotekers`
--

CREATE TABLE `apotekers` (
  `id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `employment_status` enum('tetap','kontrak','magang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tetap',
  `last_education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `apotekers`
--

INSERT INTO `apotekers` (`id`, `person_id`, `user_id`, `license_number`, `start_date`, `employment_status`, `last_education`, `status`, `profile_image`, `shift`, `created_at`, `updated_at`) VALUES
(6, 8, 7, 'STRA-19910302/STRA-ITB/2021/482813.', '2025-10-31', 'tetap', 'S1', 'aktif', 'profiles/S9vv0uWooO5EWM90cwcP2yM8qBloeB0oHM74hIz0.jpg', 'Pagi', '2025-10-30 19:05:08', '2025-10-30 19:05:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gudangs`
--

CREATE TABLE `gudangs` (
  `id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `employment_status` enum('tetap','kontrak','magang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tetap',
  `last_education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasirs`
--

CREATE TABLE `kasirs` (
  `id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `employment_status` enum('tetap','kontrak','magang') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tetap',
  `last_education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kasirs`
--

INSERT INTO `kasirs` (`id`, `person_id`, `user_id`, `start_date`, `employment_status`, `last_education`, `status`, `profile_image`, `shift`, `created_at`, `updated_at`) VALUES
(2, 10, 9, '2025-10-31', 'tetap', NULL, 'aktif', 'profiles/roZWQ7ASPSexOQOgvCdCGKMannTuKMCBwoIUu9zk.jpg', 'Pagi', '2025-10-30 20:57:15', '2025-10-30 20:57:15'),
(3, 11, 10, '2025-10-31', 'tetap', 'S1', 'aktif', 'profiles/S2wzMa9AZkvqVqLJ3MgUqtQmVqiTZM015FMkzDKd.jpg', 'Pagi', '2025-10-30 21:00:01', '2025-10-30 21:00:01'),
(4, 12, 11, '2025-10-31', 'tetap', 'S1', 'aktif', 'profiles/YHSq3bsz9YPYAAD8q8acTI6VvjyyfzC1jzExJG7q.jpg', 'Pagi', '2025-10-30 21:01:59', '2025-10-30 21:01:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kode_kategori`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, 'OB001', 'Analgesik & Antipiretik', 'Obat pereda nyeri dan penurun demam', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(3, 'OB002', 'Antibiotik', 'Obat untuk mengatasi infeksi bakteri', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(4, 'OB003', 'Antiseptik & Disinfektan', 'Obat untuk membersihkan dan membunuh kuman', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(5, 'OB004', 'Antihistamin', 'Obat untuk alergi', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(6, 'OB005', 'Obat Saluran Pencernaan', 'Obat maag, diare, sembelit', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(7, 'OB006', 'Obat Jantung & Hipertensi', 'Obat untuk penyakit jantung dan tekanan', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(8, 'OB007', 'Obat Diabetes', 'Obat untuk mengontrol gula darah', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(9, 'OB008', 'Vitamin & Suplemen', 'Nutrisi tambahan dan vitamin', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(10, 'OB009', 'Obat Respirasi', 'Obat asma, batuk, pilek', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(11, 'OB010', 'Obat Kulit & Luka', 'Krim, salep, dan obat dermatologi', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(12, 'OB011', 'Obat Mata & Telinga', 'Obat tetes mata, telinga, dll', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(13, 'OB012', 'Obat Saraf & Psikiatri', 'Obat untuk gangguan saraf dan mental', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(14, 'OB013', 'Obat Hormonal & Reproduksi', 'Obat hormon, KB, terapi reproduksi', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(15, 'OB014', 'Obat Anti Inflamasi Non-Steroid', 'Obat untuk mengurangi peradangan', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(16, 'OB015', 'Obat Infeksi Jamur & Parasit', 'Obat untuk infeksi jamur atau parasit', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(17, 'OB016', 'Obat Hati & Ginjal', 'Obat untuk kesehatan hati dan ginjal', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(18, 'OB017', 'Obat Osteoporosis & Tulang', 'Obat untuk tulang dan penguat tulang', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(19, 'OB018', 'Obat Imunomodulator', 'Obat untuk meningkatkan atau menekan imun', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(20, 'OB019', 'Obat Anestesi', 'Obat untuk bius atau penghilang rasa sakit', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(21, 'OB020', 'Obat Kanker & Kemoterapi', 'Obat untuk terapi kanker', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(22, 'OB021', 'Obat Bebas (OTC)', 'Obat yang bisa dibeli tanpa resep', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(23, 'OB022', 'Obat Keras (Resep Dokter)', 'Obat yang harus dengan resep dokter', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(24, 'OB023', 'Obat Tradisional / Herbal', 'Jamu, ekstrak herbal, suplemen alami', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(25, 'OB024', 'Obat Anak & Bayi', 'Obat khusus anak dan bayi', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(26, 'OB025', 'Obat Gigi & Mulut', 'Obat sakit gigi, kumur antiseptik', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(27, 'OB026', 'Obat Endokrin & Metabolisme', 'Obat tiroid, hormon, metabolisme', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(28, 'OB027', 'Obat Sistem Saraf Pusat', 'Obat epilepsi, migrain, Parkinson', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(29, 'OB028', 'Obat Anti Virus', 'Obat untuk infeksi virus', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(30, 'OB029', 'Obat Anti Kanker Targeted', 'Obat kemoterapi modern spesifik sel', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(31, 'OB030', 'Obat Hematologi', 'Obat anemia, anti koagulan', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(32, 'OB031', 'Obat Anti Hipertensi Lainnya', 'ACE inhibitor, beta blocker, dll', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(33, 'OB032', 'Obat Gastrointestinal Spesifik', 'Obat tukak lambung, refluks, IBS', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(34, 'OB033', 'Obat Infeksi Saluran Kemih', 'Obat untuk infeksi saluran kemih', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(35, 'OB034', 'Obat Obesitas / Penurun Berat Badan', 'Obat pengatur metabolisme dan berat', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(36, 'OB035', 'Obat Anti Psikotik & Depresi', 'Obat gangguan mental dan mood', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(37, 'OB036', 'Obat Anti Inflamasi Kortikosteroid', 'Obat steroid untuk peradangan', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(38, 'OB037', 'Obat Endokrin Reproduksi', 'Obat kesuburan dan terapi hormon', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(39, 'OB038', 'Obat Anti Alzheimer & Dementia', 'Obat untuk gangguan kognitif', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(40, 'OB039', 'Obat Anti Parkinson', 'Obat gangguan motorik', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(41, 'OB040', 'Obat Anti Diabetes Injeksi', 'Insulin dan analognya', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(42, 'OB041', 'Obat Infeksi Saluran Pernapasan', 'Obat pneumonia, bronkitis, dll', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(43, 'OB042', 'Obat Anti Malaria & Parasit', 'Obat malaria, cacing, dll', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(44, 'OB043', 'Obat Luka & Perawatan Luka', 'Plester, antiseptik, perban, krim luka', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(45, 'OB044', 'Obat Mata Khusus', 'Glaukoma, infeksi mata, tetes mata', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(46, 'OB045', 'Obat Telinga & Hidung', 'Tetes telinga, hidung tersumbat', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(47, 'OB046', 'Obat Kolesterol & Lipid', 'Obat statin dan pengatur lemak darah', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(48, 'OB047', 'Obat Anti Inflamasi Topikal', 'Gel, salep, krim anti-inflamasi', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(49, 'OB048', 'Obat Anti Rhinitis & Sinusitis', 'Obat alergi hidung dan sinus', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(50, 'OB049', 'Obat Anti Cacing & Infeksi Parasit', 'Deworming dan antiparasit', '2025-10-31 18:35:41', '2025-10-31 18:35:41'),
(51, 'OB050', 'Obat Darurat & Resusitasi', 'Obat untuk ICU, jantung, alergi berat', '2025-10-31 18:35:41', '2025-10-31 18:35:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_10_30_075955_create_people_table', 1),
(5, '2025_10_30_075956_create_users_table', 1),
(6, '2025_10_30_075957_create_roles_table', 1),
(7, '2025_10_30_075958_create_role_user_table', 1),
(8, '2025_10_30_122725_create_apotekers_table', 2),
(9, '2025_10_30_122725_create_gudangs_table', 2),
(10, '2025_10_30_122725_create_kasirs_table', 2),
(11, '2025_10_31_152315_create_inventories_table', 3),
(12, '2025_10_31_175723_create_obats_table', 3),
(13, '2025_10_31_173135_create_kategori_table', 4),
(14, '2025_10_31_202402_create_transaksi_penjualans_table', 5),
(15, '2025_10_31_202410_create_transaksi_penjualan_items_table', 6),
(16, '2025_11_02_122015_create_riwayat_obat_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `harga` bigint NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`id`, `nama`, `stok`, `kategori_id`, `harga`, `deskripsi`, `created_at`, `updated_at`) VALUES
(91, 'Paracetamol 500mg', 100, 2, 1500, 'Pereda nyeri dan penurun demam', '2025-11-02 13:07:27', '2025-11-02 06:09:19'),
(92, 'Ibuprofen 200mg', 100, 2, 2500, 'Obat anti nyeri dan peradangan', '2025-11-02 13:07:27', '2025-11-02 06:09:31'),
(93, 'Aspirin 500mg', 100, 2, 2000, 'Obat untuk nyeri kepala dan nyeri otot', '2025-11-02 13:07:27', '2025-11-02 06:09:50'),
(94, 'Amoxicillin 500mg', 0, 3, 3000, 'Antibiotik untuk infeksi bakteri', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(95, 'Cefadroxil 500mg', 0, 3, 3500, 'Antibiotik untuk infeksi kulit dan saluran kemih', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(96, 'Ciprofloxacin 500mg', 0, 3, 4000, 'Antibiotik spektrum luas', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(97, 'Cetirizine 10mg', 0, 5, 2500, 'Obat alergi dan gatal', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(98, 'Loratadine 10mg', 0, 5, 3000, 'Antihistamin untuk alergi dan rhinitis', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(99, 'Antasida DOEN', 0, 6, 1500, 'Obat maag dan kembung', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(100, 'Domperidone 10mg', 0, 6, 2500, 'Obat mual dan muntah', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(101, 'Loperamide 2mg', 0, 6, 2000, 'Obat diare akut', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(102, 'Captopril 25mg', 0, 7, 2500, 'Obat tekanan darah tinggi', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(103, 'Amlodipine 5mg', 0, 7, 3000, 'Obat hipertensi dan angina', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(104, 'Metformin 500mg', 0, 8, 2500, 'Menurunkan kadar gula darah', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(105, 'Glibenclamide 5mg', 0, 8, 2500, 'Stimulan produksi insulin', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(106, 'Vitamin C 500mg', 0, 9, 1500, 'Meningkatkan daya tahan tubuh', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(107, 'Vitamin B Complex', 0, 9, 2000, 'Meningkatkan energi dan metabolisme', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(108, 'Zinc Tablet', 0, 9, 2000, 'Menjaga sistem imun', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(109, 'Salbutamol Tablet', 0, 10, 2500, 'Meredakan gejala asma', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(110, 'OBH Combi Sirup', 0, 10, 18000, 'Obat batuk berdahak', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(111, 'Betadine Solution', 0, 11, 12000, 'Antiseptik luka luar', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(112, 'Miconazole Cream', 0, 11, 15000, 'Obat infeksi jamur pada kulit', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(113, 'Salep 88', 0, 11, 8000, 'Obat gatal dan iritasi ringan', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(114, 'Insto Tetes Mata', 0, 12, 18000, 'Obat iritasi mata', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(115, 'Otopain Tetes Telinga', 0, 12, 22000, 'Obat sakit telinga dan infeksi', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(116, 'Diazepam 5mg', 0, 13, 3500, 'Obat penenang dan anti cemas', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(117, 'Amitriptyline 10mg', 0, 13, 3000, 'Antidepresan trisiklik', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(118, 'Pil KB Andalan', 0, 14, 18000, 'Kontrasepsi oral kombinasi', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(119, 'Naproxen 500mg', 0, 15, 3500, 'Obat anti nyeri sendi dan otot', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(120, 'Ketoconazole Tablet', 0, 16, 3000, 'Obat infeksi jamur', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(121, 'Hepamax Forte', 0, 17, 35000, 'Suplemen kesehatan hati', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(122, 'Calcium-D Tablet', 0, 18, 2500, 'Suplemen kalsium dan vitamin D', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(123, 'Imboost Tablet', 0, 19, 8000, 'Meningkatkan daya tahan tubuh', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(124, 'Lidocaine Gel', 0, 20, 15000, 'Obat bius lokal', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(125, 'Tamoxifen 20mg', 0, 21, 5000, 'Obat kanker payudara', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(126, 'Bodrex Tablet', 0, 22, 1500, 'Obat sakit kepala dan demam', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(127, 'Panadol Extra', 0, 22, 2500, 'Obat flu dan sakit kepala', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(128, 'Tolak Angin Cair', 0, 24, 3500, 'Suplemen herbal untuk masuk angin', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(129, 'Kapsul Temulawak', 0, 24, 5000, 'Menjaga kesehatan hati', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(130, 'Sanmol Sirup Anak', 0, 25, 12000, 'Penurun panas anak-anak', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(131, 'Betadine Kumur', 0, 26, 15000, 'Antiseptik mulut dan tenggorokan', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(132, 'Paracetamol Drops', 0, 26, 10000, 'Pereda nyeri bayi dan anak kecil', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(133, 'Plester Hansaplast', 0, 44, 3000, 'Plester luka kecil', '2025-11-02 13:07:27', '2025-11-02 13:07:27'),
(134, 'Rivanol Solution', 0, 44, 8000, 'Antiseptik untuk luka ringan', '2025-11-02 13:07:27', '2025-11-02 13:07:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `people`
--

CREATE TABLE `people` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `personable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personable_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `people`
--

INSERT INTO `people` (`id`, `name`, `sex`, `pob`, `dob`, `created_at`, `updated_at`, `personable_type`, `personable_id`) VALUES
(1, 'Administrator', 'P', 'Jakarta', '1990-01-01', '2025-10-30 01:20:42', '2025-10-30 01:20:42', 'admin', NULL),
(8, 'Bima', 'L', 'Cikarjo', '2004-09-20', '2025-10-30 19:05:08', '2025-10-30 19:05:08', 'App\\Models\\Apoteker', 6),
(10, 'henhen', 'L', 'Cimenyan', '2001-02-06', '2025-10-30 20:57:15', '2025-10-30 20:57:15', NULL, NULL),
(11, 'BimBim', 'L', 'Cimenyan', '2000-06-12', '2025-10-30 21:00:01', '2025-10-30 21:00:01', NULL, NULL),
(12, 'tes', 'L', 'Bandung', '2003-02-03', '2025-10-30 21:01:59', '2025-10-30 21:01:59', 'App\\Models\\Kasir', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_obat`
--

CREATE TABLE `riwayat_obat` (
  `id` bigint UNSIGNED NOT NULL,
  `obat_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `tipe` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_obat`
--

INSERT INTO `riwayat_obat` (`id`, `obat_id`, `user_id`, `tipe`, `jumlah`, `harga_satuan`, `total`, `sumber`, `created_at`, `updated_at`) VALUES
(7, 91, 1, 'masuk', 100, 1500.00, 150000.00, 'Transaksi #TRX-20251102-760', '2025-11-02 06:09:19', '2025-11-02 06:09:19'),
(8, 92, 1, 'masuk', 100, 2500.00, 250000.00, 'Transaksi #TRX-20251102-374', '2025-11-02 06:09:31', '2025-11-02 06:09:31'),
(9, 93, 1, 'masuk', 100, 2000.00, 200000.00, 'Transaksi #TRX-20251102-328', '2025-11-02 06:09:50', '2025-11-02 06:09:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `guard_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `guard_name`) VALUES
(1, 'admin', '2025-10-30 01:20:42', '2025-10-30 01:20:42', 'web'),
(2, 'apoteker', '2025-10-30 13:31:46', '2025-10-30 13:31:46', 'web'),
(3, 'kasir', '2025-10-30 13:31:46', '2025-10-30 13:31:46', 'web'),
(4, 'gudang', '2025-10-30 13:31:46', '2025-10-30 13:31:46', 'web');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-10-30 01:20:42', '2025-10-30 01:20:42'),
(5, 7, 2, '2025-10-30 19:05:08', '2025-10-30 19:05:08'),
(7, 9, 3, '2025-10-30 20:57:15', '2025-10-30 20:57:15'),
(8, 10, 3, '2025-10-30 21:00:01', '2025-10-30 21:00:01'),
(9, 11, 3, '2025-10-30 21:01:59', '2025-10-30 21:01:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_obat`
--

CREATE TABLE `transaksi_obat` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_obat`
--

INSERT INTO `transaksi_obat` (`id`, `kode_transaksi`, `obat_id`, `kategori_id`, `supplier`, `jumlah`, `harga_satuan`, `total_harga`, `tanggal_transaksi`, `created_at`, `updated_at`) VALUES
(8, 'TRX-20251102-760', 91, 2, 'PT Marin Liza Farmasi', 100, 1500.00, 150000.00, '2025-11-02', '2025-11-02 06:09:19', '2025-11-02 06:09:19'),
(9, 'TRX-20251102-374', 92, 2, 'PT Marin Liza Farmasi', 100, 2500.00, 250000.00, '2025-11-02', '2025-11-02 06:09:31', '2025-11-02 06:09:31'),
(10, 'TRX-20251102-328', 93, 2, 'PT Marin Liza Farmasi', 100, 2000.00, 200000.00, '2025-11-02', '2025-11-02 06:09:50', '2025-11-02 06:09:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualans`
--

CREATE TABLE `transaksi_penjualans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_penjualans`
--

INSERT INTO `transaksi_penjualans` (`id`, `kode_transaksi`, `tanggal`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'TRX1762085489', '2025-11-02 12:11:29', 0.00, 1, '2025-11-02 05:11:29', '2025-11-02 05:11:29'),
(4, 'TRX1762085725', '2025-11-02 12:15:25', 5000.00, 1, '2025-11-02 05:15:26', '2025-11-02 05:15:26'),
(5, 'TRX1762086754', '2025-11-02 12:32:34', 5000.00, 1, '2025-11-02 05:32:34', '2025-11-02 05:32:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan_items`
--

CREATE TABLE `transaksi_penjualan_items` (
  `id` bigint UNSIGNED NOT NULL,
  `transaksi_penjualan_id` bigint UNSIGNED NOT NULL,
  `obat_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `person_id` bigint UNSIGNED DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `person_id`, `username`, `email`, `password`, `reference_type`, `reference_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin', 'admin@apotik.com', '$2y$12$48q499TiqJKJBS5tqhZg/uNoTlX12Ea7AAb.YaXBm48vpULK4fRvu', 'admin', NULL, NULL, '2025-10-30 01:20:42', '2025-10-30 01:20:42'),
(7, 8, 'BimaApo', 'Bima@apo.com', '$2y$12$ma9HqAvvnKgUso2LOnP1gOuewj1tDVeyjWdu9bJIKr4EDq6bddfqm', 'App\\Models\\Apoteker', 6, NULL, '2025-10-30 19:05:08', '2025-10-30 19:05:08'),
(9, 10, 'HenApo', 'Hen@apo.com', '$2y$12$URShT2CLos1jqNPu1ELXc.GdL5VSk9UKCZNJSHgPP/vSgHmTwSMYu', NULL, NULL, NULL, '2025-10-30 20:57:15', '2025-10-30 20:57:15'),
(10, 11, 'BimApo', 'Bimbim@apo.com', '$2y$12$Zb8GNmddWGec0zvgRzmAJObcLk1TgbAaLuabCSy5d7uxzKGa3b4bO', NULL, NULL, NULL, '2025-10-30 21:00:01', '2025-10-30 21:00:01'),
(11, 12, 'tes', 'tes@apo.com', '$2y$12$92FNNsCDZ/qTrTOr.NTfAuAMFV7Z76pzF69dvZTLhACGaBu8S1mDu', 'App\\Models\\Kasir', 4, NULL, '2025-10-30 21:01:59', '2025-10-30 21:01:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `apotekers`
--
ALTER TABLE `apotekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apotekers_person_id_foreign` (`person_id`),
  ADD KEY `apotekers_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gudangs`
--
ALTER TABLE `gudangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gudangs_person_id_foreign` (`person_id`),
  ADD KEY `gudangs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasirs_person_id_foreign` (`person_id`),
  ADD KEY `kasirs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_kode_kategori_unique` (`kode_kategori`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_obats_kategori` (`kategori_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `people`
--
ALTER TABLE `people`
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
-- Indeks untuk tabel `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_obat_obat_id_foreign` (`obat_id`),
  ADD KEY `riwayat_obat_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_penjualans_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksi_penjualans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `transaksi_penjualan_items`
--
ALTER TABLE `transaksi_penjualan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_penjualan_items_transaksi_penjualan_id_foreign` (`transaksi_penjualan_id`),
  ADD KEY `transaksi_penjualan_items_obat_id_foreign` (`obat_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_person_id_reference_type_reference_id_index` (`person_id`,`reference_type`,`reference_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `apotekers`
--
ALTER TABLE `apotekers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gudangs`
--
ALTER TABLE `gudangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan_items`
--
ALTER TABLE `transaksi_penjualan_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `apotekers`
--
ALTER TABLE `apotekers`
  ADD CONSTRAINT `apotekers_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `apotekers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gudangs`
--
ALTER TABLE `gudangs`
  ADD CONSTRAINT `gudangs_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gudangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  ADD CONSTRAINT `kasirs_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kasirs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD CONSTRAINT `fk_obats_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Ketidakleluasaan untuk tabel `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD CONSTRAINT `riwayat_obat_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_obat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD CONSTRAINT `transaksi_penjualans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualan_items`
--
ALTER TABLE `transaksi_penjualan_items`
  ADD CONSTRAINT `transaksi_penjualan_items_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_penjualan_items_transaksi_penjualan_id_foreign` FOREIGN KEY (`transaksi_penjualan_id`) REFERENCES `transaksi_penjualans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
