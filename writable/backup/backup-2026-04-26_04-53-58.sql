-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: perpus
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES (1,'Wendy','Bandung','08386549145'),(2,'karina','Bandung',NULL),(3,'Tata','Sumedang',NULL),(4,'gesya','sumedang','082216345133'),(5,'karina','bandung','08386549145');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tersedia` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (2,'Fate Took The Long Way Home',1,3,3,1,2026,19,20,'','1776958900_b23c8dd0dece70bd81c6.jpg','978-602-5921-75-3'),(7,'Dilan',7,4,4,1,2014,9,9,'','1776960292_794e4b76b21a8ce20f86.jpg',''),(9,'Destiny Wore The Right Name',1,3,3,1,2025,10,12,'','1777051307_0d4376e77ac07c3057ba.avif',''),(10,'Make U Mine',7,3,3,1,2024,20,20,'','1776959341_6a3096fd55b7d3bb88a9.avif','978-623-8668-20-5');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah_denda` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'belum_bayar',
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_kembali` varchar(20) DEFAULT 'belum',
  PRIMARY KEY (`id_detail`),
  KEY `id_buku` (`id_buku`),
  KEY `detail_peminjaman_ibfk_1` (`id_peminjaman`),
  CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE,
  CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'fiksi'),(2,'non fiksi'),(3,''),(4,'non fiksi'),(5,'fiksi'),(6,'non fiksi'),(7,'Novel'),(8,'Komik'),(9,'Novel'),(10,'Komik');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','kembali') DEFAULT 'dipinjam',
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `batas_kembali` date DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `id_petugas` int(11) DEFAULT NULL,
  `status_bayar` enum('belum','lunas') DEFAULT 'belum',
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (12,1,'2026-04-25','2026-04-25','',2,NULL,NULL,1000,1,'lunas','1776958900_b23c8dd0dece70bd81c6.jpg');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbit`
--

LOCK TABLES `penerbit` WRITE;
/*!40000 ALTER TABLE `penerbit` DISABLE KEYS */;
INSERT INTO `penerbit` VALUES (1,'Gramedia'),(2,'Elex Media'),(3,'Cloudbook Publishing'),(4,'Pastel Books (Mizan)');
/*!40000 ALTER TABLE `penerbit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `terlambat` int(11) DEFAULT 0,
  `denda` int(11) DEFAULT 0,
  `status` varchar(20) DEFAULT 'dikembalikan',
  `nama` int(11) NOT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (1,NULL,NULL,1,2000,'dikembalikan',0);
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penulis`
--

DROP TABLE IF EXISTS `penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penulis`
--

LOCK TABLES `penulis` WRITE;
/*!40000 ALTER TABLE `penulis` DISABLE KEYS */;
INSERT INTO `penulis` VALUES (1,'Tere Liye'),(2,'Andrea Hirata'),(3,'Indah Aini'),(4,'Pidi Baiq');
/*!40000 ALTER TABLE `penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES (1,'gesha','gheisya','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','no'),(2,'Gheisya',NULL,'$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S',NULL);
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rak`
--

DROP TABLE IF EXISTS `rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(100) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rak`
--

LOCK TABLES `rak` WRITE;
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` VALUES (1,'Rak A',NULL),(2,'Rak A',NULL),(3,'Rak B',NULL);
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'gheisya ','gheisya@gmail.com','gheisyasafarina','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1775929199_052747b5fd40dc6f6447.jpg','aktif','2026-04-11 04:49:13'),(3,'markeu','markeu@gmail.com','onyourmark','$2y$10$do4WBrkd7otQPxQOAOQFVufq5J2Jk8mb/wWiJFBOX9RiVErLwPKhe','anggota','1775931614_ec5434f27a0458d3e6ee.jpg','aktif','2026-04-11 04:51:29'),(4,'mutiara laila','mutiaralaila@gmail.com','mutiara','$2y$10$dbwlqsdg0/6jLb278ohS9.eihrMqExaoPUm1GDaJskT3J1GEclcqG','anggota','1775888581_8e2a44bc7a46638fe426.jpg','aktif','2026-04-11 06:23:01'),(6,'karina','karina@gmail.com','karina','$2y$10$pUPo31Qk/PQXPMq2aAmqIeMufhmqCCKbTjebS9Mhl6Zpk8kwfrLRu','anggota','1776220099_0443e06331fac7dce8d9.jpg','aktif','2026-04-15 02:28:19'),(7,'dinda','dinda@gmail.com','dinda','$2y$10$p318NNC5V3ndkyw5h/MpLOpjsiWxkPmp.komY8LptodJGMRr9AIHS','anggota','1776220194_0f45e3e8eed981f03342.jpg','aktif','2026-04-15 02:29:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-25 21:53:59
