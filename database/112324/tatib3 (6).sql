-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2024 at 10:18 AM
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
(1, 'Ade Ismail', 2, 'Ade Ismail@gmail.com', 199107042019031021, 'Ade Ismail', 'Ade Ismail'),
(2, 'Adevian Fairuz Pratama', 2, 'Adevian Fairuz Pratama@gmail.com', 200482071, 'Adevian Fairuz Pratama', 'Adevian Fairuz Pratama'),
(3, 'Agung Nugroho Pramudhita', 2, 'Agung Nugroho Pramudhita@gmail.com', 198902102019031020, 'Agung Nugroho Pramudhita', 'Agung Nugroho Pramudhita'),
(4, 'Ahmad Bahauddin Almufaro', 2, 'Ahmad Bahauddin Almufaro@gmail.com', 170361025, 'Ahmad Baha\'uddin Almu\'faro', 'Ahmad Baha\'uddin Almu\'faro'),
(5, 'Ahmadi Yuli Ananta', 2, 'Ahmadi Yuli Ananta@gmail.com', 198107052005011002, 'Ahmadi Yuli Ananta', 'Ahmadi Yuli Ananta'),
(6, 'Andika Kurnia Adi Pradana', 2, 'Andika Kurnia Adi Pradana@gmail.com', 190791131, 'Andika Kurnia Adi Pradana', 'Andika Kurnia Adi Pradana'),
(7, 'Annisa Puspa Kirana', 2, 'Annisa Puspa Kirana@gmail.com', 198901232019032016, 'Annisa Puspa Kirana', 'Annisa Puspa Kirana'),
(8, 'Annisa Taufika Firdausi', 2, 'Annisa Taufika Firdausi@gmail.com', 198712142019032012, 'Annisa Taufika Firdausi', 'Annisa Taufika Firdausi'),
(9, 'Anugrah Nur Rahmanto', 2, 'Anugrah Nur Rahmanto@gmail.com', 199112302019031016, 'Anugrah Nur Rahmanto', 'Anugrah Nur Rahmanto'),
(10, 'Ariadi Retno Tri Hayati Ririd', 2, 'Ariadi Retno Tri Hayati Ririd@gmail.com', 198108102005012002, 'Ariadi Retno Tri Hayati Ririd', 'Ariadi Retno Tri Hayati Ririd'),
(11, 'Arie Rachmad Syulistyo', 2, 'Arie Rachmad Syulistyo@gmail.com', 198708242019031010, 'Arie Rachmad Syulistyo', 'Arie Rachmad Syulistyo'),
(12, 'Arief Prasetyo', 2, 'Arief Prasetyo@gmail.com', 197903132008121002, 'Arief Prasetyo', 'Arief Prasetyo'),
(13, 'Ariyanti', 2, 'Ariyanti@gmail.com', 200482030, 'Ariyanti', 'Ariyanti'),
(14, 'Arwin Datumaya Wahyudi Sumari', 2, 'Arwin Datumaya Wahyudi Sumari@gmail.com', 190881249, 'Arwin Datumaya Wahyudi Sumari', 'Arwin Datumaya Wahyudi Sumari'),
(15, 'Astrifidha Rahma Amalia', 2, 'Astrifidha Rahma Amalia@gmail.com', 199405212022032000, 'Astrifidha Rahma Amalia', 'Astrifidha Rahma Amalia'),
(16, 'Atiqah Nurul Asri', 2, 'Atiqah Nurul Asri@gmail.com', 197606252005012001, 'Atiqah Nurul Asri', 'Atiqah Nurul Asri'),
(17, 'Bagas Satya Dian Nugraha', 2, 'Bagas Satya Dian Nugraha@gmail.com', 199006192019031017, 'Bagas Satya Dian Nugraha', 'Bagas Satya Dian Nugraha'),
(18, 'Banni Satria Andoko', 2, 'Banni Satria Andoko@gmail.com', 198108092010121002, 'Banni Satria Andoko', 'Banni Satria Andoko'),
(19, 'Budi Harijanto', 2, 'Budi Harijanto@gmail.com', 196201051990031002, 'Budi Harijanto', 'Budi Harijanto'),
(20, 'Cahya Rahmad', 2, 'Cahya Rahmad@gmail.com', 197202022005011002, 'Cahya Rahmad', 'Cahya Rahmad'),
(21, 'Candra Bella Vista', 2, 'Candra Bella Vista@gmail.com', 199412172019032020, 'Candra Bella Vista', 'Candra Bella Vista'),
(22, 'Chandrasena Setiadi', 2, 'Chandrasena Setiadi@gmail.com', 123, 'Chandrasena Setiadi', 'Chandrasena Setiadi'),
(23, 'Deasy Sandhya Elya Ikawati', 2, 'Deasy Sandhya Elya Ikawati@gmail.com', 170962038, 'Deasy Sandhya Elya Ikawati', 'Deasy Sandhya Elya Ikawati'),
(24, 'Deddy Kusbianto Purwoko Aji', 2, 'Deddy Kusbianto Purwoko Aji@gmail.com', 196211281988111001, 'Deddy Kusbianto Purwoko Aji', 'Deddy Kusbianto Purwoko Aji'),
(25, 'Dhebys Suryani Hormansyah', 2, 'Dhebys Suryani Hormansyah@gmail.com', 198311092014042001, 'Dhebys Suryani Hormansyah', 'Dhebys Suryani Hormansyah'),
(26, 'Dian Hanifudin Subhi', 2, 'Dian Hanifudin Subhi@gmail.com', 198806102019031018, 'Dian Hanifudin Subhi', 'Dian Hanifudin Subhi'),
(27, 'Dika Rizky Yunianto', 2, 'Dika Rizky Yunianto@gmail.com', 199206062019031017, 'Dika Rizky Yunianto', 'Dika Rizky Yunianto'),
(28, 'Dimas Wahyu Wibowo', 2, 'Dimas Wahyu Wibowo@gmail.com', 198410092015041001, 'Dimas Wahyu Wibowo', 'Dimas Wahyu Wibowo'),
(29, 'Dodit Suprianto', 2, 'Dodit Suprianto@gmail.com', 180461020, 'Dodit Suprianto', 'Dodit Suprianto'),
(30, 'Dwi Puspitasari', 2, 'Dwi Puspitasari@gmail.com', 197911152005012002, 'Dwi Puspitasari', 'Dwi Puspitasari'),
(31, 'Eka Larasati Amalia', 2, 'Eka Larasati Amalia@gmail.com', 198807112015042005, 'Eka Larasati Amalia', 'Eka Larasati Amalia'),
(32, 'Ekojono', 2, 'Ekojono@gmail.com', 195912081985031004, 'Ekojono', 'Ekojono'),
(33, 'Elok Nur Hamdana', 2, 'Elok Nur Hamdana@gmail.com', 198610022019032011, 'Elok Nur Hamdana', 'Elok Nur Hamdana'),
(34, 'Ely Setyo Astuti', 2, 'Ely Setyo Astuti@gmail.com', 197605152009122001, 'Ely Setyo Astuti', 'Ely Setyo Astuti'),
(35, 'Endah Lestari Dwirokhmeiti', 2, 'Endah Lestari Dwirokhmeiti@gmail.com', 456, 'Endah Lestari Dwirokhmeiti', 'Endah Lestari Dwirokhmeiti'),
(36, 'Endah Septa Sintiya', 2, 'Endah Septa Sintiya@gmail.com', 199401312022032007, 'Endah Septa Sintiya', 'Endah Septa Sintiya'),
(37, 'Erfan Rohadi', 2, 'Erfan Rohadi@gmail.com', 197201232008011006, 'Erfan Rohadi', 'Erfan Rohadi'),
(38, 'Faiz Ushbah Mubarok', 2, 'Faiz Ushbah Mubarok@gmail.com', 199305052019031018, 'Faiz Ushbah Mubarok', 'Faiz Ushbah Mubarok'),
(39, 'Farid Angga Pribadi', 2, 'Farid Angga Pribadi@gmail.com', 198910072020121003, 'Farid Angga Pribadi', 'Farid Angga Pribadi'),
(40, 'Farida Ulfa', 2, 'Farida Ulfa@gmail.com', 170962046, 'Farida Ulfa', 'Farida Ulfa'),
(41, 'Gunawan Budiprasetyo', 2, 'Gunawan Budiprasetyo@gmail.com', 197704242008121001, 'Gunawan Budiprasetyo', 'Gunawan Budiprasetyo'),
(42, 'Habibie Ed Dien', 2, 'Habibie Ed Dien@gmail.com', 199204122019031013, 'Habibie Ed Dien', 'Habibie Ed Dien'),
(43, 'Hendra Pradibta', 2, 'Hendra Pradibta@gmail.com', 198305212006041003, 'Hendra Pradibta', 'Hendra Pradibta'),
(44, 'Henny Purwaningsih', 2, 'Henny Purwaningsih@gmail.com', 195911101986032000, 'Henny Purwaningsih', 'Henny Purwaningsih'),
(45, 'Ika Kusumaning Putri', 2, 'Ika Kusumaning Putri@gmail.com', 199110142019032020, 'Ika Kusumaning Putri', 'Ika Kusumaning Putri'),
(46, 'Imam Fahrur Rozi', 2, 'Imam Fahrur Rozi@gmail.com', 198406102008121004, 'Imam Fahrur Rozi', 'Imam Fahrur Rozi'),
(47, 'Indra Dharma Wijaya', 2, 'Indra Dharma Wijaya@gmail.com', 197305102008011010, 'Indra Dharma Wijaya', 'Indra Dharma Wijaya'),
(48, 'Irsyad Arif Mashudi', 2, 'Irsyad Arif Mashudi@gmail.com', 198902012019031009, 'Irsyad Arif Mashudi', 'Irsyad Arif Mashudi'),
(49, 'Kadek Suarjuna Batubulan', 2, 'Kadek Suarjuna Batubulan@gmail.com', 199003202019031016, 'Kadek Suarjuna Batubulan', 'Kadek Suarjuna Batubulan'),
(50, 'Luqman Affandi', 2, 'Luqman Affandi@gmail.com', 198211302014041001, 'Luqman Affandi', 'Luqman Affandi'),
(51, 'M. Hasyim Ratsanjani', 2, 'M. Hasyim Ratsanjani@gmail.com', 199003052019031013, 'M. Hasyim Ratsanjani', 'M. Hasyim Ratsanjani'),
(52, 'Mamluatul Hani\'ah', 2, 'Mamluatul Hani\'ah@gmail.com', 199002062019032013, 'Mamluatul Hani\'ah', 'Mamluatul Hani\'ah'),
(53, 'Meyti Eka Apriyani', 2, 'Meyti Eka Apriyani@gmail.com', 198704242019032017, 'Meyti Eka Apriyani', 'Meyti Eka Apriyani'),
(54, 'Milyun Nima Shoumi', 2, 'Milyun Nima Shoumi@gmail.com', 198805072019032012, 'Milyun Nima Shoumi', 'Milyun Nima Shoumi'),
(55, 'Moch. Zawaruddin Abdullah', 2, 'Moch. Zawaruddin Abdullah@gmail.com', 198902102019031019, 'Moch. Zawaruddin Abdullah', 'M och. Zawaruddin Abdullah'),
(56, 'Muhammad Afif Hendrawan', 2, 'Muhammad Afif Hendrawan@gmail.com', 199111282019031013, 'Muhammad Afif Hendrawan', 'Muhammad Afif Hendrawan'),
(57, 'Muhammad Shulhan Khairy', 2, 'Muhammad Shulhan Khairy@gmail.com', 199205172019031020, 'Muhammad Shulhan Khairy', 'Muhammad Shulhan Khairy'),
(58, 'Muhammad Unggul Pamenang', 2, 'Muhammad Unggul Pamenang@gmail.com', 180461018, 'Muhammad Unggul Pamenang', 'Muhammad Unggul Pamenang'),
(59, 'Mungki Astiningrum', 2, 'Mungki Astiningrum@gmail.com', 197710302005012001, 'Mungki Astiningrum', 'Mungki Astiningrum'),
(60, 'Mustika Mentari', 2, 'Mustika Mentari@gmail.com', 198806072019032016, 'Mustika Mentari', 'Mustika Mentari'),
(61, 'Noprianto', 2, 'Noprianto@gmail.com', 198911082019031020, 'Noprianto', 'Noprianto'),
(62, 'Odhitya Desta Triswidrananta', 2, 'Odhitya Desta Triswidrananta@gmail.com', 170961035, 'Odhitya Desta Triswidrananta', 'Odhitya Desta Triswidrananta'),
(63, 'Pramana Yoga Saputra', 2, 'Pramana Yoga Saputra@gmail.com', 198805042015041001, 'Pramana Yoga Saputra', 'Pramana Yoga Saputra'),
(64, 'Priska Choirina', 2, 'Priska Choirina@gmail.com', 210982139, 'Priska Choirina', 'Priska Choirina'),
(65, 'Putra Prima Arhandi', 2, 'Putra Prima Arhandi@gmail.com', 198611032014041001, 'Putra Prima Arhandi', 'Putra Prima Arhandi'),
(66, 'Qonitatul Hasanah', 2, 'Qonitatul Hasanah@gmail.com', 789, 'Qonitatul Hasanah', 'Qonitatul Hasanah'),
(67, 'Rakhmat Arianto', 2, 'Rakhmat Arianto@gmail.com', 198701082019031004, 'Rakhmat Arianto', 'Rakhmat Arianto'),
(68, 'Rawansyah', 2, 'Rawansyah@gmail.com', 195906201994031001, 'Rawansyah', 'Rawansyah'),
(69, 'Retno Damayanti', 2, 'Retno Damayanti@gmail.com', 198910042019032023, 'Retno Damayanti', 'Retno Damayanti'),
(70, 'Ridwan Rismanto', 2, 'Ridwan Rismanto@gmail.com', 198603182012121001, 'Ridwan Rismanto', 'Ridwan Rismanto'),
(71, 'Rizdania', 2, 'Rizdania@gmail.com', 210982138, 'Rizdania', 'Rizdania'),
(72, 'Rizki Putri Ramadhani', 2, 'Rizki Putri Ramadhani@gmail.com', 199004102019092001, 'Rizki Putri Ramadhani', 'Rizki Putri Ramadhani'),
(73, 'Rizky Ardiansyah', 2, 'Rizky Ardiansyah@gmail.com', 1011, 'Rizky Ardiansyah', 'Rizky Ardiansyah'),
(74, 'Robby Anggriawan', 2, 'Robby Anggriawan@gmail.com', 190861226, 'Robby Anggriawan', 'Robby Anggriawan'),
(75, 'Rokhimatul Wakhidah', 2, 'Rokhimatul Wakhidah@gmail.com', 198903192019032013, 'Rokhimatul Wakhidah', 'Rokhimatul Wakhidah'),
(76, 'Rosa Andrie Asmara', 2, 'Rosa Andrie Asmara@gmail.com', 198010102005011001, 'Rosa Andrie Asmara', 'Rosa Andrie Asmara'),
(77, 'Rudy Ariyanto', 2, 'Rudy Ariyanto@gmail.com', 197111101999031002, 'Rudy Ariyanto', 'Rudy Ariyanto'),
(78, 'Satrio Binusa Suryadi', 2, 'Satrio Binusa Suryadi@gmail.com', 180461015, 'Satrio Binusa Suryadi', 'Satrio Binusa Suryadi'),
(79, 'Septian Enggar Sukmana', 2, 'Septian Enggar Sukmana@gmail.com', 198909012019031010, 'Septian Enggar Sukmana', 'Septian Enggar Sukmana'),
(80, 'Shohib Muslim', 2, 'Shohib Muslim@gmail.com', 198507222014041001, 'Shohib Muslim', 'Shohib Muslim'),
(81, 'Siti Romlah', 2, 'Siti Romlah@gmail.com', 1213, 'Siti Romlah', 'Siti Romlah'),
(82, 'Sofyan Noor Arief', 2, 'Sofyan Noor Arief@gmail.com', 198908132019031017, 'Sofyan Noor Arief', 'Sofyan Noor Arief'),
(83, 'Toga Aldila Cinderatama', 2, 'Toga Aldila Cinderatama@gmail.com', 198710112022031000, 'Toga Aldila Cinderatama', 'Toga Aldila Cinderatama'),
(84, 'Triana Fatmawati', 2, 'Triana Fatmawati@gmail.com', 1415, 'Triana Fatmawati', 'Triana Fatmawati'),
(85, 'Ulla Delfana Rosiani', 2, 'Ulla Delfana Rosiani@gmail.com', 197803272003122002, 'Ulla Delfana Rosiani', 'Ulla Delfana Rosiani'),
(86, 'Usman Nurhasan', 2, 'Usman Nurhasan@gmail.com', 198609232015041001, 'Usman Nurhasan', 'Usman Nurhasan'),
(87, 'Very Sugiarto', 2, 'Very Sugiarto@gmail.com', 1617, 'Very Sugiarto', 'Very Sugiarto'),
(88, 'Vipkas Al Hadid Firdaus', 2, 'Vipkas Al Hadid Firdaus@gmail.com', 199105052019031029, 'Vipkas Al Hadid Firdaus', 'Vipkas Al Hadid Firdaus'),
(89, 'Vit Zuraida', 2, 'Vit Zuraida@gmail.com', 198901092020122005, 'Vit Zuraida', 'Vit Zuraida'),
(90, 'Vivi Nur Wijayaningrum', 2, 'Vivi Nur Wijayaningrum@gmail.com', 199308112019032025, 'Vivi Nur Wijayaningrum', 'Vivi Nur Wijayaningrum'),
(91, 'Vivin Ayu Lestari', 2, 'Vivin Ayu Lestari@gmail.com', 199106212019032020, 'Vivin Ayu Lestari', 'Vivin Ayu Lestari'),
(92, 'Wilda Imama Sabilla', 2, 'Wilda Imama Sabilla@gmail.com', 199208292019032023, 'Wilda Imama Sabilla', 'Wilda Imama Sabilla'),
(93, 'Yan Watequlis Syaifudin', 2, 'Yan Watequlis Syaifudin@gmail.com', 198101052005011005, 'Yan Watequlis Syaifudin', 'Yan Watequlis Syaifudin'),
(94, 'Yoppy Yunhasnawa', 2, 'Yoppy Yunhasnawa@gmail.com', 198906212019031013, 'Yoppy Yunhasnawa', 'Yoppy Yunhasnawa'),
(95, 'Yuri Ariyanto', 2, 'Yuri Ariyanto@gmail.com', 198007162010121002, 'Yuri Ariyanto', 'Yuri Ariyanto'),
(96, 'Yushintia Pramitarini', 2, 'Yushintia Pramitarini@gung akan@gmail.com', 1819, 'Yushintia Pramitarini', 'Yushintia Pramitarini'),
(97, 'Zulmy Faqihuddin Putera', 2, 'Zulmy Faqihuddin Putera@gmail.com', 199005112019091000, 'Zulmy Faqihuddin Putera', 'Zulmy Faqihuddin Putera');

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
  `NIP` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kps`
--

INSERT INTO `kps` (`id_kps`, `nama_kps`, `department_id`, `email`, `NIP`, `created_at`, `updated_at`) VALUES
(1, 'Imam Fahrur Rozi', 2, 'Imam Fahrur Rozi@gmail.com', 198406102008121004, '2024-11-23 10:15:04', '2024-11-23 10:15:04'),
(2, 'Mungki Astiningrum', 2, 'Mungki Astiningrum@gmail.com', 197710302005012001, '2024-11-23 10:15:04', '2024-11-23 10:15:04'),
(3, 'Hendra Pradibta', 2, 'Hendra Pradibta@gmail.com', 198305212006041003, '2024-11-23 10:15:04', '2024-11-23 10:15:04'),
(4, 'Rudy Ariyanto', 2, 'Rudy Ariyanto@gmail.com', 197111101999031002, '2024-11-23 10:15:04', '2024-11-23 10:15:04'),
(5, 'Rosa Andrie Asmara', 2, 'Rosa Andrie Asmara@gmail.com', 198010102005011001, '2024-11-23 10:15:04', '2024-11-23 10:15:04'),
(6, 'Yan Watequlis Syaifudin', 2, 'Yan Watequlis Syaifudin@gmail.com', 198101052005011005, '2024-11-23 10:15:04', '2024-11-23 10:15:04');

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
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `department_id`, `email`, `NIM`, `username`, `password`, `total_violation_points`, `total_reward_points`, `semester`, `tingkat`, `foto`, `status`) VALUES
(1, 'Ahmad Yazid Ilham Z', 1, 'ahmad.yazid.ilham.z@domain.com', '2341760156', '2341760156', '2341760156', 0, 0, 3, 2, 'upload foto berhasil.jpg', 'Aktif'),
(2, 'Amilil', 2, 'amilil@domain.com', '2341760170', '2341760170', '2341760170', 0, 0, 3, 2, NULL, 'Aktif'),
(3, 'Sabrina Rahmadini', 2, 'sabrina.rahmadini@domain.com', '2341760155', '2341760155', '2341760155', 0, 0, 3, 2, NULL, 'Aktif'),
(4, 'Safrizal Rahman', 2, 'safrizal.rahman@domain.com', '2341760151', '2341760151', '2341760151', 0, 0, 3, 2, NULL, 'Aktif'),
(5, 'Shabrina Qottrunnada', 2, 'shabrina.qottrunnada@domain.com', '2341760160', '2341760160', '2341760160', 0, 0, 3, 2, NULL, 'Aktif'),
(6, 'Raden', 2, 'raden@domain.com', '2341760180', '2341760180', '2341760180', 1, 2, 3, 2, NULL, 'Aktif'),
(7, 'nadhif', 1, 'nadhif@gmail.com', '123456789', 'nadhif', 'penjagahati', 0, 0, 3, 2, 'CONTOH GAMBAR.jpg', 'Aktif'),
(8, 'klebusss', 5, 'sassss@gamil.com', '234176014113232', 'klebusddsd', '', 0, 0, 3, 2, 'LOGIN .png', 'Lulus'),
(9, 'lyodr5a', 4, 'lyodr5a@gmail.com', '213232', 'lyodr5a', 'lyodr5a', 0, 0, 2, 1, 'CONTOH GAMBAR.jpg', 'Aktif');

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
  MODIFY `id_kps` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON UPDATE RESTRICT;

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
