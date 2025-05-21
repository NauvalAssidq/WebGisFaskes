/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.21-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: maps
-- ------------------------------------------------------
-- Server version	10.6.21-MariaDB-0ubuntu0.22.04.2

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
-- Table structure for table `faskes`
--

DROP TABLE IF EXISTS `faskes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `faskes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `amenity` enum('Puskesmas','Rumah Sakit','Klinik') DEFAULT NULL,
  `class` enum('A','B','C','D') DEFAULT NULL,
  `hospital_type` enum('Pemerintah','Swasta') DEFAULT NULL,
  `care_type` enum('Rawat Inap','Non Rawat Inap') DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lng` decimal(10,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faskes`
--

LOCK TABLES `faskes` WRITE;
/*!40000 ALTER TABLE `faskes` DISABLE KEYS */;
INSERT INTO `faskes` VALUES (1,'RS001',NULL,'Rumah Sakit Umum Zainal','Jl. Teuku Umar No. 123','Kuta Alam','Rumah Sakit','A','Pemerintah',NULL,5.550000,95.320000),(2,'RS002',NULL,'Rumah Sakit Meuraxa','Jl. Tgk Daud Beureueh No. 45','Meuraxa','Rumah Sakit','B','Swasta',NULL,5.553100,95.321500),(3,'RS00312',NULL,'Rumah Sakit Cut Meutia','Jl. T. Nyak Arief No. 10','Baiturrahman','Rumah Sakit','A','Pemerintah',NULL,5.561000,95.312000),(4,NULL,NULL,'Puskesmas Meuraxa','Jl. Sultan Iskandar Muda, Meuraxa','Meuraxa','Puskesmas',NULL,NULL,'Non Rawat Inap',5.537860,95.307991),(5,NULL,NULL,'Puskesmas Kuta Alam','Jl. Pocut Baren No.34, Kuta Alam','Kuta Alam','Puskesmas',NULL,NULL,'Non Rawat Inap',5.548589,95.326253),(6,NULL,NULL,'Puskesmas Ulee Kareng','Jl. T Iskandar, Ulee Kareng','Ulee Kareng','Puskesmas',NULL,NULL,'Non Rawat Inap',5.520025,95.354960),(7,NULL,NULL,'Puskesmas Lueng Bata','Jl. T. Nyak Arief, Lueng Bata','Lueng Bata','Puskesmas',NULL,NULL,'Non Rawat Inap',5.527875,95.333210),(8,NULL,NULL,'Puskesmas Jaya Baru','Jl. T. Panglima Nyak Makam, Jaya Baru','Jaya Baru','Puskesmas',NULL,NULL,'Non Rawat Inap',5.539112,95.317420),(9,NULL,NULL,'Puskesmas Syiah Kuala','Jl. Prof Ali Hasyimi, Syiah Kuala','Syiah Kuala','Puskesmas',NULL,NULL,'Non Rawat Inap',5.570365,95.353424),(10,NULL,NULL,'Puskesmas Kuta Raja','Jl. Tgk. Chik Pante Kulu, Kuta Raja','Kuta Raja','Puskesmas',NULL,NULL,'Non Rawat Inap',5.546285,95.312537),(11,NULL,NULL,'Puskesmas Banda Raya','Jl. P. Nyak Makam, Banda Raya','Banda Raya','Puskesmas',NULL,NULL,'Non Rawat Inap',5.545210,95.319842),(12,NULL,NULL,'Puskesmas Jeulingke','Jl. T. Nyak Arief, Jeulingke','Syiah Kuala','Puskesmas',NULL,NULL,'Non Rawat Inap',5.566000,95.340000),(13,NULL,NULL,'Puskesmas Kopelma Darussalam','Jl. Teuku Nyak Arief, Darussalam','Syiah Kuala','Puskesmas',NULL,NULL,'Non Rawat Inap',5.570000,95.350000),(14,NULL,NULL,'Puskesmas Lampulo','Jl. T. Nyak Makam, Lampulo','Kuta Alam','Puskesmas',NULL,NULL,'Non Rawat Inap',5.550000,95.320000),(15,NULL,NULL,'Puskesmas Batoh','Jl. Mr. Teuku Moh Hasan, Batoh','Lueng Bata','Puskesmas',NULL,NULL,'Non Rawat Inap',5.530000,95.330000),(16,NULL,'1747836790_5ee4b2c5fafe5350b1ed.png','Puskesmas Baiturrahman','Jl. Teuku Umar, Baiturrahman','Baiturrahman','Puskesmas',NULL,NULL,'Non Rawat Inap',5.550000,95.320000),(17,NULL,NULL,'Puskesmas Lhong Raya','Jl. Tgk Dilhong I, Lhong Raya','Banda Raya','Puskesmas',NULL,NULL,'Non Rawat Inap',5.545000,95.325000),(18,'0101R001','1747853976_b774887aa908f941200e.jpg','RSUD dr. Zainoel Abidin','Jl. Tgk. Daud Beureueh No. 108, 24415','Kuta Alam','Rumah Sakit','A','Pemerintah','Rawat Inap',5.564759,95.338508),(19,'0101R003',NULL,'RS Iskandar Muda','Jl. T. Hamzah Bendahara No. 1, 24415','Kuta Alam','Rumah Sakit','B','Pemerintah','Rawat Inap',5.556100,95.317900),(20,'0101R004',NULL,'RS Jiwa Aceh','Jl. Dr. T. Syarief Thayeb No. 25, 23126','Kuta Alam','Rumah Sakit','A','Pemerintah','Rawat Inap',5.556214,95.318715),(21,'0101R007',NULL,'RSUD Meuraxa','Jl. Soekarno Hatta Km. 2, Desa Mibo, 23231','Meuraxa','Rumah Sakit','B','Pemerintah','Rawat Inap',5.554376,95.324300),(22,'0101R008',NULL,'RS Harapan Bunda','Jl. Teuku Umar No. 181-185, Seutui, 23243','Baiturrahman','Rumah Sakit','C','Swasta','Rawat Inap',5.550000,95.316000),(23,'0101R009',NULL,'RS Bhayangkara Polda NAD','Jl. Cut Nyak Dhien No. 23, Lamteumen Barat, 23232','Jaya Baru','Rumah Sakit','B','Pemerintah','Rawat Inap',5.557300,95.312200),(24,'0017R012',NULL,'RS Meutia','Jl. Cut Meutia No. 55, Kampung Baru, 23116','Baiturrahman','Rumah Sakit','D','Swasta','Rawat Inap',5.549700,95.311500),(25,'0017R013',NULL,'RS Prince Nayef Bin Abdul Aziz','Jl. Lingkar Kampus No. 1, Kopelma Darussalam, 24411','Syiah Kuala','Rumah Sakit','D','Swasta','Rawat Inap',5.560400,95.314600),(26,'0017R015',NULL,'RSIA Cempaka Az-Zahra','Jl. Pocut Baren No. 36-40, Laksana, 24415','Kuta Alam','Rumah Sakit','C','Swasta','Rawat Inap',5.553800,95.319200),(27,'0017R017',NULL,'RS Pertamedika Ummi Rosnati','Jl. Sekolah No. 5, Gampoeng Ateuk Pahlawan, 23241','Baiturrahman','Rumah Sakit','C','Swasta','Rawat Inap',5.549334,95.326561),(28,'0101R010',NULL,'RSIA Provinsi Aceh','Jl. Prof. A. Madjid Ibrahim I No. 3, Punge Jurong, 23116','Meuraxa','Rumah Sakit','B','Pemerintah','Rawat Inap',5.555600,95.317500),(29,'0101R011',NULL,'RS Cempaka Lima','Jl. Politeknik No. 23, Dusun Meunasah Dayah, Lr. B, Gp. Beurawe, 24415','Kuta Alam','Rumah Sakit','C','Swasta','Rawat Inap',5.552700,95.320300),(30,'0101R012',NULL,'RS Khusus Bedah Sehat Selamat Sejahtera','Jl. Inspeksi Krueng Aceh No. 99, Desa Pangoe Deah, 24415','Ulee Kareng','Rumah Sakit','C','Swasta','Rawat Inap',5.545200,95.310700),(41,NULL,NULL,'Klinik Meurasi Lambaro','Jl. Meuraya No. 1, 24415','Lambaro','Klinik',NULL,NULL,NULL,5.550000,95.320000),(42,NULL,NULL,'Klinik Athari','Jl. Teuku Umar No. 17-19, 23232','Lamteumen Barat','Klinik',NULL,NULL,NULL,5.556000,95.312000),(43,NULL,NULL,'Klinik Tirtana Medikal','Jl. Dr. Mr. Mohd Hasan No. 67-69, 23243','Batoh','Klinik',NULL,NULL,NULL,5.550500,95.316500),(44,NULL,NULL,'Klinik Bunda Thamrin','Jl. Dr. Mr. T. Iskandar No. 45, 24415','Kuta Alam','Klinik',NULL,NULL,NULL,5.553200,95.319800),(45,NULL,NULL,'Klinik Naavagreen','Jl. Pocut Baren No. 36-40, 24415','Laksana','Klinik',NULL,NULL,NULL,5.553800,95.319200),(46,NULL,NULL,'Klinik Fertilitas Indonesia','Jl. Prof. A. Madjid Ibrahim I No. 3, 23116','Punge Jurong','Klinik',NULL,NULL,NULL,5.555600,95.317500),(47,NULL,NULL,'Klinik Utama Kasehat Walafiat','Jl. Banda Aceh-Medan KM 9,5, 23235','Lampreh Lamteungoh','Klinik',NULL,NULL,NULL,5.550000,95.320000),(48,NULL,'1747837839_34686990acdd870a0730.webp','Azqiara Klinik Estetik','Jalan T. Alaidin Mahmudsyah No.4-5, Kp. Baru','Kuta Alam','Klinik',NULL,NULL,NULL,5.553500,95.318000),(51,NULL,NULL,'Klinik Pratama USK','Jl. Teuku Daud Beureueh No. 174 C, 23111','Kuta Alam','Klinik',NULL,NULL,NULL,5.551000,95.319500),(53,NULL,NULL,'Klinik Darfa','Jl. Banda Aceh-Medan KM 9,5, 23235','Lampreh Lamteungoh','Klinik',NULL,NULL,NULL,5.550000,95.320000),(54,NULL,NULL,'Klinik Gigi Basmalah','Jl. T. Panglima Nyak Makam, Depan Kantor BPKP, Belakang Indomaret Simpang BPKP, 23118','Kota Banda Aceh','Klinik',NULL,NULL,NULL,5.550500,95.319000),(57,NULL,NULL,'Klinik Pratama USK','Jl. Teuku Daud Beureueh No. 174 C, 23111','Kuta Alam','Klinik',NULL,NULL,NULL,5.551000,95.319500),(58,NULL,NULL,'Klinik Sentra Medika','Jl. Tgk. Daud Beureueh No. 168-171, 23351','Kuta Alam','Klinik',NULL,NULL,NULL,5.552000,95.320500),(61,NULL,NULL,'Klinik Alfayat','Jl. Sultan Malikul Saleh, Neusu Aceh, 23122','Baiturrahman','Klinik',NULL,NULL,NULL,5.552500,95.319800);
/*!40000 ALTER TABLE `faskes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_facilities`
--

DROP TABLE IF EXISTS `health_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `amenity` enum('Puskesmas','Rumah Sakit','Klinik') DEFAULT NULL,
  `class` enum('A','B','C','D') DEFAULT NULL,
  `hospital_type` enum('Pemerintah','Swasta') DEFAULT NULL,
  `geom` point NOT NULL,
  PRIMARY KEY (`id`),
  SPATIAL KEY `geom` (`geom`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_facilities`
--

LOCK TABLES `health_facilities` WRITE;
/*!40000 ALTER TABLE `health_facilities` DISABLE KEYS */;
INSERT INTO `health_facilities` VALUES (1,NULL,'puskesmas pembantu',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0ìYs∂’W@RY^l1@'),(2,NULL,'Rumah Sakit Umum Zainoel Abidin',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0◊mP˚≠’W@/*Û†ÍA@'),(3,NULL,'Posyandu Putroe Meuraxa',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ååƒ∫ß“W@‡LLb=@'),(4,NULL,'Puskesmas Pembantu Gampong Deah Baro',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0|ÇÙ“W@˙∆!,t?@'),(5,NULL,'Polindes Gampong Alue Deah Teungoh',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0í`”W@ﬂ•‘%„@@'),(6,NULL,'Posyandu Kasih Ibu',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0˛ËÂ¡\'”W@∂àÉﬂ·A@'),(7,NULL,'UPTD Puskesmas Meuraxa',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0’7zFÏ“W@íÅÚ-b6@'),(8,NULL,'MERLIN',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0G!$f—“W@Hè:ïg1@'),(9,NULL,'Sehat Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0àÉÑ(_”W@=ƒıﬁŒ4@'),(10,NULL,'posyandu seurrunee gampong asoe nanggroe',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0q¨ã€h“W@•dﬁO2.@'),(11,'BA-3729','RS Cot Mesjid','Jl. Teuku Umar No.21, Cot Mesjid','Lueng Bata','Rumah Sakit','B','Pemerintah','Ê\0\0\0\0\0±Pköw‘W@ƒB≠iﬁ1@'),(12,NULL,'Dinas Kesehatan Puskesmas Pembantu Surien',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0ªbFx˚“W@Â≠úÔ)@'),(13,NULL,'Poliklinik Polresta Banda Aceh',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¢\\@√”W@∆È⁄Õ2@'),(14,NULL,'Puskesmas Pembantu',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0QeΩΩê”W@UüPÙe>@'),(15,NULL,'Rumah Sakit Malahayati',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0∆–˚e”W@Ñà/n˛\"@'),(16,NULL,'Puskesmas Lampaseh Kota',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0˘£ÌÈ”W@ÃPÀ≈Œ:@'),(17,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0LáÛ…”W@#æ≥^<@'),(18,NULL,'Rumah Sakit Umum Cut Meutia',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0‚Ü)€Q‘W@¯J≈k<@'),(19,NULL,'Klinik Mitra Peduli',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0êƒ&ç,‘W@ù˛¢∫o;@'),(20,NULL,'bungong seulanga',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0“›\Z}q’W@]R2@'),(21,NULL,'klinik alternatif cing cia',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ˇ8	v’W@;K⁄ûj.@'),(22,NULL,'apotek mustajab',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0`k\0Ä-’W@6”]5@'),(23,NULL,'Klinik Pengobatan Sehat',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0°@ÈU.’W@]ı%¿5@'),(24,NULL,'Apotik ayu ningsih',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¢F!…,’W@ÔxÓò5@'),(25,NULL,'Klinik Onkologi',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0H≈´,’W@Yj6Í4@'),(26,NULL,'klinik laboratorium kimia farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ªE`¨o’W@m⁄-@'),(27,NULL,'apotek air mata ibu',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Å∂0f&’W@Ï	\\0@'),(28,NULL,'yayasan pengobatan',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0X˛!¢=’W@t\nÚ≥ë3@'),(29,NULL,'kimia farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ˇMﬁ∂%’W@-ÿ¸Ææ(@'),(30,NULL,'Posyandu Putra-putri Ibu Batoh',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0∏YºX’W@“¨«ÿd(@'),(31,NULL,'klinik bidan Ratna ramlah',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ﬁ]¬¸‘W@Ó!Ü¬\"@'),(32,NULL,'Klinik Rasi',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0›´†≥’W@®ø®N<@'),(33,NULL,'Puskesmas Banda Raya',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0KZÒ\rÖ‘W@§ì\0ên@'),(34,NULL,'Puskesmas Banda Raya',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0è©ª≤ã‘W@—ÓE\Z@'),(35,NULL,'Apotek Kanzul Arasyi\'',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Î‡∂o‘W@Uﬂ˘E	\Z@'),(36,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¬Úå\"ê‘W@¿k·√6;@'),(37,NULL,'Ratu Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0óËál{‘W@Œ∆JÃ≥:@'),(38,NULL,'Puskesmas Pembantu Gampong Lamjamee',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0ÌgŒ;“W@`L8(@'),(39,NULL,'UPTD PUSKESMAS JAYA BARU',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0√Œßé“W@\Z{@Í¿#@'),(40,NULL,'UPTD posyandu kamboja',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ÈZ Ê∑“W@ø´/\\g%@'),(41,NULL,'klinik bersalin nova',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0ÃÛª“W@ÖqÅÒ@'),(42,NULL,'Med-Dent Clinic',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Å∑õ;U”W@R~RÌ”!@'),(43,NULL,'Apotek KITA',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0OOi⁄”W@‹o.)@'),(44,NULL,'Rumah Sakit Harapan Bunda',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0˚ˇ›ßœ”W@]ﬂáÉÑ(@'),(45,NULL,'UPTD PUSKESMAS KOPELMA DARUSSALAM',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0ÿ]EÎM◊W@A)ZπP@'),(46,NULL,'Puskesmas Pembantu GP. Pande',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0•∑‰]\Z‘W@2¬Ä ùF@'),(47,NULL,'RSUD MEURAXA',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0PX=ªW‘W@” ª¡@'),(48,NULL,'Shakihah',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ÇÇúA\r‘W@≥™o™ˇ@'),(49,NULL,'Misrina',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ı;Ÿ!‘W@hô†·(@'),(50,NULL,'Mitra Rontgen',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ﬁØ]5*‘W@k;∑@'),(51,NULL,'Posyandu Jeumpa Puteh',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ËÚã∑∫‘W@≠Mc{- @'),(52,NULL,'Posyandu Kamboja',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ó™¥≈5‘W@Ÿj≈ÌÜ@'),(53,NULL,'Rumah Sakit Pertamedika Ummi Rosnati',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0+¡‚pÊ‘W@UŒ(ßá2@'),(54,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0◊I\"†g‘W@çÊmΩ@'),(55,NULL,'Klinik Cempaka Lima Neusu',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¢•·J,‘W@ä¢QÀ(@'),(56,NULL,'kronik griya fisioterapi',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\07+1O”W@4∆=L±@'),(57,NULL,'KLINIK KESEHATAN ISLAM AL WAFA',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ˆq~‘“W@¡„€ª@'),(58,NULL,'Klinik Teratai',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Xâ’W@»å9æ<@'),(59,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0.$ª-Ï‘W@o˙Ÿõ;@'),(60,NULL,'BPJS Kesehatan Mata',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0_Ã;Ûó‘W@9∂û!;@'),(61,NULL,'Apotek Laris 2',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0M‘w#ò‘W@ºZÓÃ;@'),(62,NULL,'Posyandu Kartika',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\04πΩI¯‘W@¢6ªˇŸ8@'),(63,NULL,'Klinik Produktivitas',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ÂZYG˙‘W@f…√?@'),(64,NULL,'Puskesmas Kuta Alam',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0Üœ1{¥‘W@Ô∏óÍ∏@@'),(65,NULL,'Apotek Berkat',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¯ßTâ‘W@¸ck«;@'),(66,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0»Øƒ®ê‘W@ï◊•°°:@'),(67,NULL,'Posyandu Putik Meulu',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0!p…Ó‘W@Ú’Èõ?@'),(68,NULL,'Puskesmas Pembantu Lambaro Skep',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0Ñ.·–[’W@5(ö∞H@'),(69,NULL,'Posyandu Melur',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0+∏ƒ6N’W@è&Õ’EH@'),(70,NULL,'Bidan Sinarti, SKM',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ß•£\\’W@∞VÌöH@'),(71,NULL,'Berkah Sehat',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ªAYùA’W@_YôG@'),(72,NULL,'Apotek Rakan',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0åõgë’W@Û)∂8C@'),(73,NULL,'Apotek Rizki',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0sÕ.)à’W@x–Ï∫∑B@'),(74,NULL,'posyandu kasih ibu',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0—e ’W@ÔÀÙ¶}.@'),(75,NULL,'KLINIK AD\'HA',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0S\"â^∆’W@Ÿ•W¿6@'),(76,NULL,'Klinik Herbal TASLY',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0¡4±e÷W@\'|\0ú(3@'),(77,NULL,'Dr drg SUZANNA S Sp Kga',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0£#∂z’W@⁄9ÕÌ6@'),(78,NULL,'klinik spesialis kulit dan kelamin',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0√Q®]÷W@ÑΩ‰⁄´:@'),(79,NULL,'polindes ie masen ulee kareng',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0w[3√÷W@Ë)œE8@'),(80,NULL,'Puskesmas Ulee Kareng',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0ß|–÷W@éwG∆j3@'),(81,NULL,'klinik babus salamah',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0.#Pÿ÷W@pÑ˚∑Å1@'),(82,NULL,'UP2K gampong doy',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0µà(&o÷W@ÄM1b˙9@'),(83,NULL,'POLINDES ILIE',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Bk4oã÷W@◊˘∑À~-@'),(84,NULL,'PUSKESMAS PEMBANTU GAMPONG PANGO RAYA',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0`tys8÷W@∏–¡&@'),(85,NULL,'PUSKESMAS PEMBANTU GAMPONG PANGO RAYA',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0\Zù=·6÷W@13\"€&@'),(86,NULL,'PUSKESMAS UPTD ULEE KARENG',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0∂,_óa÷W@{!.J\Z%@'),(87,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\09xÀzV÷W@.†a{w5@'),(88,NULL,'POSYANDU',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0|J)C0÷W@’èÚ8±4@'),(89,NULL,'Apotek Al Hikmah',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0˝Ïëc’W@|3Vˆ@@'),(90,NULL,'Apotek Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0◊‹—ˇr’W@Ëï¸ôãA@'),(91,NULL,'POSKESDES',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0\rÃe˛,÷W@ÍxÃ@e4@'),(92,NULL,'RS Kesdam Iskandar Muda',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0/\nÃT“‘W@oxã—Ñ7@'),(93,NULL,'Rumah Sakit Ibu dan AnakKota Banda Aceh',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0|∂ˆ”W@˛Qäa3@'),(94,NULL,'Rumah Sakit Bhayangkara Banda aceh',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0œÌ ”ﬁ“W@IKÂÌ@'),(95,NULL,'Klinik',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0dÒˆ{=”W@C<mË¡ @'),(96,NULL,'Kimia Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ó0?‹z‘W@µ‚v√7@'),(97,NULL,'RS. Tengku Fakinah',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0g¥˙èq”W@˝ÿ…Öo@'),(98,NULL,'klinil bersalin',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0üÚûπ=÷W@˝∂Ãé˘M@'),(99,NULL,'Toko Obat Bin Amir Farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0⁄‹‚+À÷W@gÉßÎ‰G@'),(100,NULL,'apotek Medika Darussalam',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ıƒ))f◊W@Õ|b¯„I@'),(101,NULL,'Praktek Dokter Bersama',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0êQ˘2‘W@p´jì‘;@'),(102,NULL,'Apotek 46',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0=ª◊§6‘W@‚5T1:=@'),(103,NULL,'Toko Obat Parma Medika',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0–È~£”W@Ñ<Ã®3@'),(104,NULL,'Apotek Rumah Sakit Malahayati',NULL,NULL,'Rumah Sakit',NULL,NULL,'\0\0\0\0\0\0\0Vºëyd”W@oYœ\"@'),(105,NULL,'layanan kesehatan dompet duafa aceh',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Dy’πX’W@÷ÙÍ-/2@'),(106,NULL,'apotik maqaila',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ÖäªãA’W@aûﬂA˝ @'),(107,NULL,'Apotik Anaqi',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0R¨dT’W@UÔ∫»N!@'),(108,NULL,'apotik mustaqim',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0“åE”Y’W@NÅ:ä(@'),(109,NULL,'kimia farma',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0/)%’W@ò/‘Ã(@'),(110,NULL,'drg fakhrurrazi,sp,bm',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0#4›∆’W@¯\\\\ô¶6@'),(111,NULL,'DR SAIFUDDIN ISHAK',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Ào,É≈’W@˛îß6@'),(112,NULL,'Apotek Sakti',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0Ì¿î‹<‘W@Êv/˜)@'),(113,NULL,'Bidan Dian',NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0ÌÔ÷Î”W@ŒQ⁄;@'),(114,NULL,NULL,NULL,NULL,'Klinik',NULL,NULL,'\0\0\0\0\0\0\0:vP’W@çÂßÇõ>@'),(115,NULL,'UPTD Puskesmas Batoh',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0aÓ§œÿ’W@wª^ö\" @'),(116,NULL,'UPTD Puskesmas Jaya Baru',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0@È˙Ùé“W@‹ÎI∫#@'),(117,NULL,'UPTD Puskesmas Jeulingke',NULL,NULL,'Puskesmas',NULL,NULL,'\0\0\0\0\0\0\0f˘∫ˇ’W@ƒÃ>èQN@');
/*!40000 ALTER TABLE `health_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025-05-17-140636','App\\Database\\Migrations\\CreateUsersTable','default','App',1747490823,1),(2,'2025-05-20-232110','App\\Database\\Migrations\\CreateFaskesTable','default','App',1747758188,2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_posts`
--

DROP TABLE IF EXISTS `test_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `test_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_posts`
--

LOCK TABLES `test_posts` WRITE;
/*!40000 ALTER TABLE `test_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `test_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','johndoe','johndoe@example.com','$2y$10$uO0f6bFUmZXjE7UE3kMrfuzv.bJxCDkDPStHz35YFvNwGxyTgHyhW',NULL,1,NULL,NULL),(2,'Admin Coba','admin123','admin123@example.com','$2y$12$KY/zlRfLiHHLchdRDWUjX.Uze/QwfjaZHoI7tCC67EENR2alrLRrK',NULL,1,NULL,NULL),(3,'Admin Coba 2','admin234','admin234@gmail.com','$2y$12$vgwsmyANmJirWQGLTI7MZOwyq.CFFUeGQjA05flmu.A5JXGb6HWia','default2.jpg',1,NULL,'2025-05-21 20:03:19'),(4,'Percobaan Ketiga','coba321','coba321@gmail.com','$2y$12$pkZgN7rRdlEhTB3Gidyd/uJfluEtm5xUppqc3a9RFhdZH30chpImS',NULL,1,NULL,NULL),(6,'Apotek 46','apotek46','apotek46@gmail.com','$2y$12$eojb3dqq2Gys1AT37xKHT.k6aQCachulW89FkbcEwMHETbISQ.4ey',NULL,1,'2025-05-21 15:12:55','2025-05-21 15:12:55');
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

-- Dump completed on 2025-05-22  5:33:33
