-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2024 at 01:07 PM
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
  `NIP` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `NIM` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `total_violation_points` int DEFAULT '0',
  `total_reward_points` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin123');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
