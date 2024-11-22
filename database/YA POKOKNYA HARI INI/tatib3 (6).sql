-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2024 at 11:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatib3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) DEFAULT NULL,
  `password_admin` varchar(255) NOT NULL,
  `id_kelas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_task_log`
--

CREATE TABLE `admin_task_log` (
  `id_log` int NOT NULL,
  `admin_id` int NOT NULL,
  `task_description` text NOT NULL,
  `task_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fakultas_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `fakultas_id`) VALUES
(1, 'Teknik Listrik', 1),
(2, 'Teknik Informatika', 1),
(3, 'Teknik Komputer', 1),
(4, 'Teknik Konstruksi', 2),
(5, 'Teknik Lingkungan', 2),
(6, 'Teknik Otomotif', 3);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `NIP` bigint DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `name`, `department_id`, `email`, `NIP`, `username`, `password`) VALUES
(1, 'Ahmadi Yuli Ananta, ST', 2, 'ahmadi@polinema.ac.id', 198107052005011002, 'ahmadi.yuli', 'AhmadiYuliAnanta2'),
(2, 'Annisa Taufika Firdausi, ST., MT', 2, 'annisa.taufika@polinema.ac.id', NULL, 'annisa.taufika', 'AnnisaTaufikaFirdausi2'),
(3, 'Ariadi Retno Tri Hayati Ririd, S.Kom., M.Kom', 2, 'ariadi.retno@polinema.ac.id', 198108102005012002, 'ariadi.retno', 'AriadiRetnoTriHayatiRirid2'),
(4, 'Arief Prasetyo, S.Kom', 2, 'arief.prasetyo@polinema.ac.id', 197903132008121002, 'arief.prasetyo', 'AriefPrasetyo2'),
(5, 'Atiqah Nurul Asri, S.Pd., M.Pd', 2, 'atiqah.nurul@polinema.ac.id', 197606252005012001, 'atiqah.nurul', 'AtiqahNurulAsri2'),
(6, 'Banni Satria Andoko, S.Kom., M.Si', 2, 'ando@polinema.ac.id', 198108092010121002, 'banni.andoko', 'BanniSatriaAndoko2'),
(7, 'Budi Harijanto, ST., MMkom', 2, 'budi.harijanto@polinema.ac.id', 196201051990031002, 'budi.harijanto', 'BudiHarijanto2'),
(8, 'Cahya Rahmad, ST., M.Kom., Dr. Eng', 2, 'cahya.rahmad@polinema.ac.id', 197202022005011002, 'cahya.rahmad', 'CahyaRahmad2'),
(9, 'Deddy Kusbianto Purwoko Aji, Ir., M.MKom', 2, 'deddy_kusbianto@polinema.ac.id', 196211281988111001, 'deddy.kusbianto', 'DeddyKusbiantoPurwokoAji2'),
(10, 'Dhebys Suryani H, S.Kom., MT', 2, NULL, NULL, 'dhebys.suryani', 'DhebysSuryaniH2'),
(11, 'Dimas Wahyu Wibowo, ST., MT', 2, NULL, NULL, 'dimas.wibowo', 'DimasWahyuWibowo2'),
(12, 'Dwi Puspitasari, S.Kom., M.Kom', 2, 'dwi.puspitasari@polinema.ac.id', 197911152005012002, 'dwi.puspitasari', 'DwiPuspitasari2'),
(13, 'Dyah Ayu Irawati, ST., M.Cs', 2, 'dyah.ayu@polinema.ac.id', 198407082008122001, 'dyah.ayu', 'DyahAyuIrawati2'),
(14, 'Ekojono, ST., M.Kom', 2, 'ekojono2@polinema.ac.id', 195912081985031004, 'ekojono', 'Ekojono2'),
(15, 'Ely Setyo Astuti, ST., MT', 2, 'ely_setyoastuti@polinema.ac.id', 197605152009122001, 'ely.setyo', 'ElySetyoAstuti2'),
(16, 'Erfan Rohadi, ST., M.Eng., Ph.D', 2, 'erfanr@polinema.ac.id', 197201232008011006, 'erfan.rohadi', 'ErfanRohadi2'),
(17, 'Faisal Rahutomo ST., M.Kom., Dr.Eng', 2, 'faisal@polinema.ac.id', 197711162005011008, 'faisal.rahutomo', 'FaisalRahutomo2'),
(18, 'Gunawan Budi Prasetyo, ST., MMT', 2, 'gunawan.budi@polinema.ac.id', 197704242008121001, 'gunawan.budi', 'GunawanBudiPrasetyo2'),
(19, 'Hendra Pradibta, SE., M.Sc', 2, 'hendra.pardibta@polinema.ac.id', 198305212006041003, 'hendra.pradibta', 'HendraPradibta2'),
(20, 'Imam Fahrur Rozi, ST., MT', 2, 'imam.rozi@polinema.ac.id', 198406102008121004, 'imam.rozi', 'ImamFahrurRozi2'),
(21, 'Indra Dharma Wijaya, ST., MMT', 2, 'indra.dharma@polinema.ac.id', 197305102008011010, 'indra.wijaya', 'IndraDharmaWijaya2'),
(22, 'Luqman Affandi, S.Kom., MMSI', 2, NULL, 198211302014041001, 'luqman.affandi', 'LuqmanAffandi2'),
(23, 'Mungki Astiningrum, ST., M.Kom', 2, 'mungki.astingrum@polinema.ac.id', 197710302005012001, 'mungki.astiningrum', 'MungkiAstiningrum2'),
(24, 'Pramana Yoga Saputra, S.KOM., MM', 2, NULL, NULL, 'pramana.yoga', 'PramanaYogaSaputra2'),
(25, 'Putra Prima Arhandi, ST., M.Kom', 2, NULL, 198611032014041001, 'putra.prima', 'PutraPrimaArhandi2'),
(26, 'Rawansyah, Drs., M.Pd', 2, 'rawansyah@polinema.ac.id', 195906201994031001, 'rawansyah', 'Rawansyah2'),
(27, 'Ridwan Rismanto, SST., M.KOM', 2, 'rismanto@polinema.ac.id', 198603182012121001, 'ridwan.rismanto', 'RidwanRismanto2'),
(28, 'Rudy Ariyanto, ST, M.Cs', 2, 'ariyantorudy@polinema.ac.id', 197111101999031002, 'rudy.ariyanto', 'RudyAriyanto2'),
(29, 'Ulla Delfana Rosiani, ST., MT', 2, 'rosiani@polinema.ac.id', 197803272003122002, 'ulla.rosiani', 'UllaDelfanaRosiani2'),
(30, 'Siti Romlah, Dra., MM', 2, 'siti_romlah@polinema.ac.id', 195304161979032002, 'siti.romlah', 'SitiRomlah2'),
(31, 'Widaningsih, S.Psi, SH., MH', 2, 'widaningsih@polinema.ac.id', 198103182010122002, 'widaningsih', 'Widaningsih2'),
(32, 'Yan Watequlis Syaifudin, ST., MMT', 2, 'qulis@polinema.ac.id', 198101052005011005, 'yan.syaifudin', 'YanWatequlisSyaifudin2'),
(33, 'Yushintia Pramitarini, S.ST., M.T', 2, 'yushintia@polinema.ac.id', NULL, 'yushintia.pramitarini', 'YushintiaPramitarini2'),
(34, 'Yuri Ariyanto, S.Kom., M.Kom', 2, 'yuri@polinema.ac.id', 198007162010121002, 'yuri.ariyanto', 'YuriAriyanto2');

-- --------------------------------------------------------

--
-- Table structure for table `dpa`
--

CREATE TABLE `dpa` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `name`) VALUES
(1, 'Teknik Elektro'),
(2, 'Teknik Sipil'),
(3, 'Teknik Mesin');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `tingkat` int NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komisi_discipline_decision`
--

CREATE TABLE `komisi_discipline_decision` (
  `id_decision` int NOT NULL,
  `pelanggaran_id` int NOT NULL,
  `decision` varchar(255) NOT NULL,
  `decision_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sanction_type` varchar(100) DEFAULT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komite_disiplin_mahasiswa`
--

CREATE TABLE `komite_disiplin_mahasiswa` (
  `id_komite` int NOT NULL,
  `nama_komite` varchar(100) NOT NULL,
  `kontak_komite` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `jurisdiction` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kps`
--

CREATE TABLE `kps` (
  `id_kps` int NOT NULL,
  `nama_kps` varchar(100) NOT NULL,
  `department_id` int DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `NIM` varchar(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `total_violation_points` int DEFAULT '0',
  `total_reward_points` int DEFAULT '0',
  `semester` int NOT NULL,
  `tingkat` int NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `department_id`, `email`, `NIM`, `username`, `password`, `total_violation_points`, `total_reward_points`, `semester`, `tingkat`, `foto`) VALUES
(1, 'Ahmad Yazid Ilham Z', 2, 'ahmad.yazid.ilham.z@domain.com', '2341760156', '2341760156', '2341760156', 0, 0, 3, 2, NULL),
(2, 'Amilil', 2, 'amilil@domain.com', '2341760170', '2341760170', '2341760170', 0, 0, 3, 2, NULL),
(3, 'Sabrina Rahmadini', 2, 'sabrina.rahmadini@domain.com', '2341760155', '2341760155', '2341760155', 0, 0, 3, 2, NULL),
(4, 'Safrizal Rahman', 2, 'safrizal.rahman@domain.com', '2341760151', '2341760151', '2341760151', 0, 0, 3, 2, NULL),
(5, 'Shabrina Qottrunnada', 2, 'shabrina.qottrunnada@domain.com', '2341760160', '2341760160', '2341760160', 0, 0, 3, 2, NULL),
(6, 'Raden', 2, 'raden@domain.com', '2341760180', '2341760180', '2341760180', 1, 2, 3, 2, NULL),
(7, 'nadhif', 1, 'nadhif@gmail.com', '123456789', 'nadhif', 'penjagahati', 0, 0, 3, 2, 'CONTOH GAMBAR.jpg'),
(8, 'klebusss', 5, 'sassss@gamil.com', '234176014113232', 'klebusddsd', '', 0, 0, 3, 2, 'LOGIN .png');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `recipient_id` int DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date_sent` timestamp NULL DEFAULT NULL,
  `acknowledged` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_mahasiswa`
--

CREATE TABLE `pelanggaran_mahasiswa` (
  `id_pelanggaran` int NOT NULL,
  `mahasiswa_id` int NOT NULL,
  `violation_type_id` int NOT NULL,
  `reported_by` int NOT NULL,
  `dpa_verification_status` tinyint(1) DEFAULT '0',
  `report_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sanction_status` varchar(50) DEFAULT 'Pending',
  `sanction_start_date` date DEFAULT NULL,
  `sanction_end_date` date DEFAULT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelapor`
--

CREATE TABLE `pelapor` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_archive`
--

CREATE TABLE `reward_archive` (
  `id` int NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `total_reward_points` int DEFAULT NULL,
  `rewards_issued` varchar(255) DEFAULT NULL,
  `recognition_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_points`
--

CREATE TABLE `reward_points` (
  `id` int NOT NULL,
  `mahasiswa_id` int DEFAULT NULL,
  `points_earned` int DEFAULT NULL,
  `date_awarded` timestamp NULL DEFAULT NULL,
  `reward_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_kependidikan`
--

CREATE TABLE `tenaga_kependidikan` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('dosen','dpa','kps','mahasiswa','tendik','komite disiplin','bk','admin','operator') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin123', 'admin'),
(2, 'ERFAN ROHADI', 'erfan_rohadi', 'erfan_rohadi', 'dosen'),
(3, 'CAHYA RAHMAD', 'cahya_rahmad', 'cahya_rahmad', 'dosen'),
(4, 'GUNAWAN BUDIPRASETYO', 'gunawan_budiprasetyo', 'gunawan_budiprasetyo', 'dosen'),
(5, 'ULLA DELFANA ROSIANI', 'ulla_delfana_rosiani', 'ulla_delfana_rosiani', 'dosen'),
(6, 'ROSA ANDRIE ASMARA', 'rosa_andrie_asmara', 'rosa_andrie_asmara', 'dosen'),
(7, 'YAN WATEQULIS SYAIFUDIN', 'yan_watequlis_syaifudin', 'yan_watequlis_syaifudin', 'dosen'),
(8, 'SHOHIB MUSLIM', 'shohib_muslim', 'shohib_muslim', 'dosen'),
(9, 'CHANDRASENA SETIADI', 'chandrasena_setiadi', 'chandrasena_setiadi', 'dosen'),
(10, 'RAWANSYAH', 'rawansyah', 'rawansyah', 'dosen'),
(11, 'RUDY ARIYANTO', 'rudy_ariyanto', 'rudy_ariyanto', 'dosen'),
(12, 'DODIT SUPRIANTO', 'dodit_suprianto', 'dodit_suprianto', 'dosen'),
(13, 'ELY SETYO ASTUTI', 'ely_setyo_astuti', 'ely_setyo_astuti', 'dosen'),
(14, 'ATIQAH NURUL ASRI', 'atiqah_nurul_asri', 'atiqah_nurul_asri', 'dosen'),
(15, 'MUNGKI ASTININGRUM', 'mungki_astiningrum', 'mungki_astiningrum', 'dosen'),
(16, 'ARIEF PRASETYO', 'arief_prasetyo', 'arief_prasetyo', 'dosen'),
(17, 'DWI PUSPITASARI', 'dwi_puspitasari', 'dwi_puspitasari', 'dosen'),
(18, 'FARIDA ULFA', 'farida_ulfa', 'farida_ulfa', 'dosen'),
(19, 'YURI ARIYANTO', 'yuri_ariyanto', 'yuri_ariyanto', 'dosen'),
(20, 'WIDANINGSIH', 'widaningsih', 'widaningsih', 'dosen'),
(21, 'IMAM FAHRUR ROZI', 'imam_fahrur_rozi', 'imam_fahrur_rozi', 'dosen'),
(22, 'DIMAS WAHYU WIBOWO', 'dimas_wahyu_wibowo', 'dimas_wahyu_wibowo', 'dosen'),
(23, 'RIDWAN RISMANTO', 'ridwan_rismanto', 'ridwan_rismanto', 'dosen'),
(24, 'PUTRA PRIMA ARHANDI', 'putra_prima_arhandi', 'putra_prima_arhandi', 'dosen'),
(25, 'ARIE RACHMAD SYULISTYO', 'arie_rachmad_syulistyo', 'arie_rachmad_syulistyo', 'dosen'),
(26, 'TOGA ALDILA CINDERATAMA', 'toga_aldila_cinderatama', 'toga_aldila_cinderatama', 'dosen'),
(27, 'YUSHINTIA PRAMITARINI', 'yushintia_pramitarini', 'yushintia_pramitarini', 'dosen'),
(28, 'MILYUN NI”MA SHOUMI', 'milyun_nima_shoumi', 'milyun_nima_shoumi', 'dosen'),
(29, 'MUSTIKA MENTARI', 'mustika_mentari', 'mustika_mentari', 'dosen'),
(30, 'DIAN HANIFUDIN SUBHI', 'dian_hanifudin_subhi', 'dian_hanifudin_subhi', 'dosen'),
(31, 'AHMAD BAHA’UDDIN AL MU’FARO', 'ahmad_bahauddin_al_mufaro', 'ahmad_bahauddin_al_mufaro', 'dosen'),
(32, 'IRSYAD ARIF MASHUDI', 'irsyad_arif_mashudi', 'irsyad_arif_mashudi', 'dosen'),
(33, 'YOPPY YUNHASNAWA', 'yoppy_yunhasnawa', 'yoppy_yunhasnawa', 'dosen'),
(34, 'SOFYAN NOOR ARIEF', 'sofyan_noor_arief', 'sofyan_noor_arief', 'dosen'),
(35, 'SEPTIAN ENGGAR SUKMANA', 'septian_enggar_sukmana', 'septian_enggar_sukmana', 'dosen'),
(36, 'SATRIO BINUSA SURYADI', 'satrio_binusa_suryadi', 'satrio_binusa_suryadi', 'dosen'),
(37, 'NOPRIANTO', 'noprianto', 'noprianto', 'dosen'),
(38, 'ODHITYA DESTA TRISWIDRANANTA', 'odhitya_desta_triswidrananta', 'odhitya_desta_triswidrananta', 'dosen'),
(39, 'MAMLUATUL HANI”AH', 'mamluatul_haniah', 'mamluatul_haniah', 'dosen'),
(40, 'M. HASYIM RATSANJANI', 'm_hasyim_ratsanjani', 'm_hasyim_ratsanjani', 'dosen'),
(41, 'KADEK SUARJUNA BATUBULAN', 'kadek_suarjuna_batubulan', 'kadek_suarjuna_batubulan', 'dosen'),
(42, 'BAGAS SATYA DIAN NUGRAHA', 'bagas_satya_dian_nugraha', 'bagas_satya_dian_nugraha', 'dosen'),
(43, 'DEASY SANDHYA ELYA IKAWATI', 'deasy_sandhya_elya_ikawati', 'deasy_sandhya_elya_ikawati', 'dosen'),
(44, 'VIPKAS AL HADID FIRDAUS', 'vipkas_al_hadid_firdaus', 'vipkas_al_hadid_firdaus', 'dosen'),
(45, 'MUHAMMAD UNGGUL PAMENANG', 'muhammad_unggul_pamenang', 'muhammad_unggul_pamenang', 'dosen'),
(46, 'IKA KUSUMANING PUTRI', 'ika_kusumaning_putri', 'ika_kusumaning_putri', 'dosen'),
(47, 'MUHAMMAD AFIF HENDRAWAN', 'muhammad_afif_hendrawan', 'muhammad_afif_hendrawan', 'dosen'),
(48, 'ROBBY ANGGRIAWAN', 'robby_anggriawan', 'robby_anggriawan', 'dosen'),
(49, 'ANUGRAH NUR RAHMANTO', 'anugrah_nur_rahmanto', 'anugrah_nur_rahmanto', 'dosen'),
(50, 'HABIBIE ED DIEN', 'habibie_ed_dien', 'habibie_ed_dien', 'dosen'),
(51, 'MUHAMMAD SHULHAN KHAIRY', 'muhammad_shulhan_khairy', 'muhammad_shulhan_khairy', 'dosen'),
(52, 'WILDA IMAMA SABILLA', 'wilda_imama_sabilla', 'wilda_imama_sabilla', 'dosen'),
(53, 'VIVI NUR WIJAYANINGRUM', 'vivi_nur_wijayaningrum', 'vivi_nur_wijayaningrum', 'dosen'),
(54, 'ASTRIFIDHA RAHMA AMALIA', 'astrifidha_rahma_amalia', 'astrifidha_rahma_amalia', 'dosen'),
(55, 'ADEVIAN FAIRUZ PRATAMA', 'adevian_fairuz_pratama', 'adevian_fairuz_pratama', 'dosen'),
(56, 'CANDRA BELLA VISTA', 'candra_bella_vista', 'candra_bella_vista', 'dosen'),
(57, 'Sujadi', 'sujadi', 'sujadi', 'tendik'),
(58, 'Dwi Atmo Nugroho, ST.', 'dwi_atmo_nugroho', 'dwi_atmo_nugroho', 'tendik'),
(59, 'Anggi Putra Woon, A.Md.', 'anggi_putra_woon', 'anggi_putra_woon', 'tendik'),
(60, 'op1', 'op1', 'op123', 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `violation_level`
--

CREATE TABLE `violation_level` (
  `id` int NOT NULL,
  `level_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `violation_level`
--

INSERT INTO `violation_level` (`id`, `level_name`, `description`) VALUES
(1, 'Tingkat I', 'Pelanggaran sangat berat'),
(2, 'Tingkat II', 'Pelanggaran berat'),
(3, 'Tingkat III', 'Pelanggaran cukup berat'),
(4, 'Tingkat IV', 'Pelanggaran sedang'),
(5, 'Tingkat V', 'Pelanggaran ringan');

-- --------------------------------------------------------

--
-- Table structure for table `violation_report`
--

CREATE TABLE `violation_report` (
  `id` int NOT NULL,
  `submitted_by` int DEFAULT NULL,
  `violation_type` int DEFAULT NULL,
  `report_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reviewed_by` int DEFAULT NULL,
  `resolution_date` timestamp NULL DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `dpa_verification_status` tinyint(1) DEFAULT '0',
  `faculty_involved_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `violation_type`
--

CREATE TABLE `violation_type` (
  `id` int NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `level_id` int DEFAULT NULL,
  `penalty_points` int DEFAULT NULL,
  `sanction` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `violation_type`
--

INSERT INTO `violation_type` (`id`, `description`, `level_id`, `penalty_points`, `sanction`) VALUES
(1, 'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain', 5, 1, 'Teguran lisan'),
(2, 'Tidak menggunakan kartu identitas kampus pada saat berada di area kampus', 4, 2, 'Peringatan tertulis'),
(3, 'Merokok di area kampus yang tidak diperbolehkan', 4, 3, 'Peringatan tertulis dan denda'),
(4, 'Melakukan plagiarisme dalam tugas atau ujian', 3, 5, 'Skorsing sementara'),
(5, 'Mengganggu ketertiban umum di area kampus', 3, 5, 'Skorsing sementara'),
(6, 'Menggunakan kekerasan fisik terhadap orang lain di kampus', 2, 10, 'Skorsing jangka panjang'),
(7, 'Menggunakan narkoba di area kampus', 1, 20, 'Dikeluarkan dari kampus'),
(8, 'Melakukan aksi vandalisme terhadap fasilitas kampus', 2, 10, 'Ganti rugi dan skorsing'),
(9, 'Membawa senjata tajam atau berbahaya ke dalam area kampus', 1, 15, 'Skorsing jangka panjang'),
(10, 'Berkelahi dengan mahasiswa lain', 2, 8, 'Skorsing sementara dan konseling wajib'),
(11, 'Mengabaikan prosedur keselamatan dalam laboratorium', 4, 3, 'Peringatan tertulis'),
(12, 'Menggunakan alat laboratorium tanpa izin', 4, 3, 'Teguran tertulis'),
(13, 'Mencoret-coret dinding atau fasilitas kampus lainnya', 3, 5, 'Peringatan tertulis dan ganti rugi'),
(14, 'Menggunakan fasilitas kampus untuk kegiatan ilegal', 1, 20, 'Dikeluarkan dari kampus'),
(15, 'Menyebarkan berita palsu atau hoaks di lingkungan kampus', 3, 5, 'Peringatan tertulis'),
(16, 'Menggunakan perangkat elektronik saat ujian tanpa izin', 4, 4, 'Nilai ujian dibatalkan'),
(17, 'Mengganggu dosen saat proses belajar mengajar', 5, 1, 'Teguran lisan'),
(18, 'Tidak menghadiri pertemuan wajib tanpa alasan yang sah', 5, 2, 'Peringatan tertulis'),
(19, 'Mengajak atau ikut serta dalam perjudian di area kampus', 2, 10, 'Skorsing jangka panjang'),
(20, 'Membawa alkohol dan meminumnya di area kampus', 2, 10, 'Skorsing sementara'),
(21, 'Menggunakan fasilitas kampus tanpa izin atau di luar waktu yang diperbolehkan', 4, 3, 'Peringatan tertulis'),
(22, 'Menyebarkan konten atau materi yang tidak pantas di lingkungan kampus', 3, 5, 'Peringatan tertulis'),
(23, 'Mengambil barang milik kampus atau mahasiswa lain tanpa izin', 2, 10, 'Skorsing sementara dan ganti rugi'),
(24, 'Melanggar hak privasi mahasiswa atau dosen', 3, 5, 'Peringatan tertulis'),
(25, 'Menyalahgunakan kartu identitas kampus', 4, 4, 'Peringatan tertulis dan skorsing sementara'),
(26, 'Melakukan pelecehan dan/atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus', 1, 20, 'Dikeluarkan dari kampus'),
(27, 'Berjudi, mengkonsumsi minuman keras, dan/ atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus Polinema', 1, 15, 'Dikeluarkan dari kampus'),
(28, 'Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah', 1, 20, 'Dikeluarkan dari kampus'),
(29, 'Melakukan pemalsuan data / dokumen / tanda tangan', 1, 15, 'Dikeluarkan dari kampus'),
(30, 'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 2, 10, 'Skorsing sementara'),
(31, 'Tidak menjaga nama baik Polinema di masyarakat dan/ atau mencemarkan nama baik Polinema melalui media apapun', 1, 10, 'Peringatan keras'),
(32, 'Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan atau martabat Negara, Bangsa dan Polinema', 1, 20, 'Dikeluarkan dari kampus'),
(33, 'Menggunakan barang-barang psikotropika dan/ atau zat-zat Adiktif lainnya', 1, 20, 'Dikeluarkan dari kampus'),
(34, 'Mengedarkan serta menjual barang-barang psikotropika dan/ atau zat-zat Adiktif lainnya', 1, 20, 'Dikeluarkan dari kampus'),
(35, 'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh Pengadilan', 1, 20, 'Dikeluarkan dari kampus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `admin_task_log`
--
ALTER TABLE `admin_task_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIP` (`NIP`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `dpa`
--
ALTER TABLE `dpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `komisi_discipline_decision`
--
ALTER TABLE `komisi_discipline_decision`
  ADD PRIMARY KEY (`id_decision`),
  ADD KEY `pelanggaran_id` (`pelanggaran_id`);

--
-- Indexes for table `komite_disiplin_mahasiswa`
--
ALTER TABLE `komite_disiplin_mahasiswa`
  ADD PRIMARY KEY (`id_komite`);

--
-- Indexes for table `kps`
--
ALTER TABLE `kps`
  ADD PRIMARY KEY (`id_kps`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIM` (`NIM`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `idx_violation_points` (`total_violation_points`),
  ADD KEY `idx_reward_points` (`total_reward_points`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Indexes for table `pelanggaran_mahasiswa`
--
ALTER TABLE `pelanggaran_mahasiswa`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`),
  ADD KEY `violation_type_id` (`violation_type_id`),
  ADD KEY `reported_by` (`reported_by`);

--
-- Indexes for table `pelapor`
--
ALTER TABLE `pelapor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_archive`
--
ALTER TABLE `reward_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `violation_level`
--
ALTER TABLE `violation_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `violation_report`
--
ALTER TABLE `violation_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`),
  ADD KEY `violation_type` (`violation_type`),
  ADD KEY `reviewed_by` (`reviewed_by`),
  ADD KEY `faculty_involved_id` (`faculty_involved_id`);

--
-- Indexes for table `violation_type`
--
ALTER TABLE `violation_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_task_log`
--
ALTER TABLE `admin_task_log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dpa`
--
ALTER TABLE `dpa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komisi_discipline_decision`
--
ALTER TABLE `komisi_discipline_decision`
  MODIFY `id_decision` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komite_disiplin_mahasiswa`
--
ALTER TABLE `komite_disiplin_mahasiswa`
  MODIFY `id_komite` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kps`
--
ALTER TABLE `kps`
  MODIFY `id_kps` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggaran_mahasiswa`
--
ALTER TABLE `pelanggaran_mahasiswa`
  MODIFY `id_pelanggaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelapor`
--
ALTER TABLE `pelapor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL;

--
-- Constraints for table `admin_task_log`
--
ALTER TABLE `admin_task_log`
  ADD CONSTRAINT `admin_task_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `komisi_discipline_decision`
--
ALTER TABLE `komisi_discipline_decision`
  ADD CONSTRAINT `komisi_discipline_decision_ibfk_1` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran_mahasiswa` (`id_pelanggaran`);

--
-- Constraints for table `kps`
--
ALTER TABLE `kps`
  ADD CONSTRAINT `kps_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `pelanggaran_mahasiswa`
--
ALTER TABLE `pelanggaran_mahasiswa`
  ADD CONSTRAINT `pelanggaran_mahasiswa_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `pelanggaran_mahasiswa_ibfk_2` FOREIGN KEY (`violation_type_id`) REFERENCES `violation_type` (`id`),
  ADD CONSTRAINT `pelanggaran_mahasiswa_ibfk_3` FOREIGN KEY (`reported_by`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `reward_archive`
--
ALTER TABLE `reward_archive`
  ADD CONSTRAINT `reward_archive_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `reward_points`
--
ALTER TABLE `reward_points`
  ADD CONSTRAINT `reward_points_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `tenaga_kependidikan`
--
ALTER TABLE `tenaga_kependidikan`
  ADD CONSTRAINT `tenaga_kependidikan_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `violation_report`
--
ALTER TABLE `violation_report`
  ADD CONSTRAINT `violation_report_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `violation_report_ibfk_2` FOREIGN KEY (`violation_type`) REFERENCES `violation_type` (`id`),
  ADD CONSTRAINT `violation_report_ibfk_3` FOREIGN KEY (`reviewed_by`) REFERENCES `tenaga_kependidikan` (`id`),
  ADD CONSTRAINT `violation_report_ibfk_4` FOREIGN KEY (`faculty_involved_id`) REFERENCES `dosen` (`id`);

--
-- Constraints for table `violation_type`
--
ALTER TABLE `violation_type`
  ADD CONSTRAINT `violation_type_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `violation_level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
