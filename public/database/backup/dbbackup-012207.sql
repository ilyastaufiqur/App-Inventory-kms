-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: dbgudang
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.8-MariaDB
-- Date: Fri, 01 Jul 2022 13:50:59 +0700

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barang`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `brgkode` varchar(10) NOT NULL,
  `brgnama` varchar(100) NOT NULL,
  `brgkatid` int(10) unsigned NOT NULL,
  `brgsatid` int(10) unsigned NOT NULL,
  `brgharga` double NOT NULL,
  `brgstok` int(11) NOT NULL,
  `brggambar` varchar(200) NOT NULL,
  PRIMARY KEY (`brgkode`),
  KEY `barang_brgkatid_foreign` (`brgkatid`),
  KEY `barang_brgsatid_foreign` (`brgsatid`),
  CONSTRAINT `barang_brgkatid_foreign` FOREIGN KEY (`brgkatid`) REFERENCES `kategori` (`katid`),
  CONSTRAINT `barang_brgsatid_foreign` FOREIGN KEY (`brgsatid`) REFERENCES `satuan` (`satid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barang` VALUES ('111','Paralon',2,1,55000,20,'upload/111.jpg'),('1111','PARALON DFT',1,5,1000000,20,''),('1212','Paralon',4,8,100000,20,''),('12121','Pengukur Suhu',1,2,50000,20,''),('12222','PARALON DFT MODEL 1',2,2,200000,200,''),('131313','selang',4,5,10000,22,''),('323','netpot',4,1,10000,50,''),('343','rockwoll',4,5,20000,40,''),('545','stearofoam',4,2,200000,20,''),('555','pipa paralon',4,1,20000,20,'upload/555.jpg'),('656','kardus',7,5,30000,32,'upload/656.jpg');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barang` with 11 row(s)
--

--
-- Table structure for table `barangkeluar`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangkeluar` (
  `faktur` char(20) NOT NULL,
  `tglfaktur` date DEFAULT NULL,
  `idpel` int(11) DEFAULT NULL,
  `totalharga` double DEFAULT NULL,
  `jumlahuang` double DEFAULT NULL,
  `sisauang` double DEFAULT NULL,
  PRIMARY KEY (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangkeluar`
--

LOCK TABLES `barangkeluar` WRITE;
/*!40000 ALTER TABLE `barangkeluar` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barangkeluar` VALUES ('1106220001','2022-06-11',2,350000,600000,50000),('1106220002','2022-06-11',8,100000,300000,50000);
/*!40000 ALTER TABLE `barangkeluar` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barangkeluar` with 2 row(s)
--

--
-- Table structure for table `barangmasuk1`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangmasuk1` (
  `faktur` char(20) NOT NULL,
  `idsup` int(10) unsigned NOT NULL,
  `tglfaktur` date DEFAULT NULL,
  `totalharga` double DEFAULT NULL,
  PRIMARY KEY (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangmasuk1`
--

LOCK TABLES `barangmasuk1` WRITE;
/*!40000 ALTER TABLE `barangmasuk1` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barangmasuk1` VALUES ('F190622',9,'2022-06-21',300000);
/*!40000 ALTER TABLE `barangmasuk1` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barangmasuk1` with 1 row(s)
--

--
-- Table structure for table `detail_barangkeluar`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_barangkeluar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_barangkeluar`
--

LOCK TABLES `detail_barangkeluar` WRITE;
/*!40000 ALTER TABLE `detail_barangkeluar` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `detail_barangkeluar` VALUES (14,'1106220001','323',10000,20,200000),(15,'1106220002','12121',50000,2,100000),(18,'1106220001','656',30000,5,150000);
/*!40000 ALTER TABLE `detail_barangkeluar` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `detail_barangkeluar` with 3 row(s)
--

--
-- Table structure for table `detail_barangmasuk`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_barangmasuk` (
  `iddetail` bigint(20) NOT NULL AUTO_INCREMENT,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargamasuk` double DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL,
  PRIMARY KEY (`iddetail`),
  KEY `detbrgkode` (`detbrgkode`),
  KEY `detfaktur` (`detfaktur`),
  CONSTRAINT `detail_barangmasuk_ibfk_1` FOREIGN KEY (`detbrgkode`) REFERENCES `barang` (`brgkode`) ON DELETE CASCADE,
  CONSTRAINT `detail_barangmasuk_ibfk_2` FOREIGN KEY (`detfaktur`) REFERENCES `barangmasuk` (`faktur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_barangmasuk`
--

LOCK TABLES `detail_barangmasuk` WRITE;
/*!40000 ALTER TABLE `detail_barangmasuk` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `detail_barangmasuk` VALUES (10,'F-110622','323',7500,10000,5,37500),(11,'F-120622','323',8500,10000,10,85000),(12,'F2-120622','131313',7500,10000,2,15000),(13,'F3-120622','656',2500,30000,2,5000),(14,'F190622','323',7500,10000,10,75000);
/*!40000 ALTER TABLE `detail_barangmasuk` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `detail_barangmasuk` with 5 row(s)
--

--
-- Table structure for table `kategori`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `katid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `katnama` varchar(50) NOT NULL,
  KEY `katid` (`katid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `kategori` VALUES (1,'Hidroponik DFT '),(2,'Hidroponik NFT'),(4,'Sistem Week'),(5,'Aeroponik'),(6,'Sistem Fertigasi'),(7,'sistem nutrient film'),(8,'hidroponik'),(9,'3'),(10,'4'),(11,'5'),(12,'6');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `kategori` with 11 row(s)
--

--
-- Table structure for table `konsultasi`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konsultasi` (
  `konsul_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `pesan_konsul` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`konsul_id`),
  KEY `konsul_by` (`id_recipient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konsultasi`
--

LOCK TABLES `konsultasi` WRITE;
/*!40000 ALTER TABLE `konsultasi` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `konsultasi` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `konsultasi` with 0 row(s)
--

--
-- Table structure for table `levels`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `levelnama` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `levels` VALUES (1,'Admin'),(2,'team'),(3,'user');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `levels` with 3 row(s)
--

--
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migrations` VALUES (1,'2022-05-29-131350','App\\Database\\Migrations\\Kategori','default','App',1653830283,1),(2,'2022-05-29-131409','App\\Database\\Migrations\\Satuan','default','App',1653830283,1),(3,'2022-05-29-131417','App\\Database\\Migrations\\Barang','default','App',1653830283,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migrations` with 3 row(s)
--

--
-- Table structure for table `pelanggan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `pelid` int(11) NOT NULL AUTO_INCREMENT,
  `pelnama` varchar(100) DEFAULT NULL,
  `peltelp` char(20) DEFAULT NULL,
  PRIMARY KEY (`pelid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pelanggan` VALUES (2,'miv','0821212'),(4,'anton','089776'),(6,'pipit','12355'),(7,'Rindy','123456789'),(8,'husna','898776');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pelanggan` with 5 row(s)
--

--
-- Table structure for table `satuan`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satuan` (
  `satid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `satnama` varchar(50) NOT NULL,
  KEY `satid` (`satid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satuan`
--

LOCK TABLES `satuan` WRITE;
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `satuan` VALUES (1,'PCS'),(2,'PCS'),(4,'PCS'),(5,'BUAH'),(7,'BUAH'),(8,'BUAH');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `satuan` with 6 row(s)
--

--
-- Table structure for table `suplier`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suplier` (
  `supid` int(11) NOT NULL AUTO_INCREMENT,
  `supnama` varchar(100) DEFAULT NULL,
  `suptelp` char(20) DEFAULT NULL,
  PRIMARY KEY (`supid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suplier`
--

LOCK TABLES `suplier` WRITE;
/*!40000 ALTER TABLE `suplier` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `suplier` VALUES (9,'ILYAS','082216562743');
/*!40000 ALTER TABLE `suplier` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `suplier` with 1 row(s)
--

--
-- Table structure for table `temp_barangkeluar`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_barangkeluar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_barangkeluar`
--

LOCK TABLES `temp_barangkeluar` WRITE;
/*!40000 ALTER TABLE `temp_barangkeluar` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `temp_barangkeluar` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `temp_barangkeluar` with 0 row(s)
--

--
-- Table structure for table `temp_barangmasuk`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_barangmasuk` (
  `iddetail` bigint(20) NOT NULL AUTO_INCREMENT,
  `detfaktur` char(20) DEFAULT NULL,
  `detbrgkode` char(10) DEFAULT NULL,
  `dethargamasuk` double DEFAULT NULL,
  `dethargajual` double DEFAULT NULL,
  `detjml` int(11) DEFAULT NULL,
  `detsubtotal` double DEFAULT NULL,
  PRIMARY KEY (`iddetail`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_barangmasuk`
--

LOCK TABLES `temp_barangmasuk` WRITE;
/*!40000 ALTER TABLE `temp_barangmasuk` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `temp_barangmasuk` VALUES (16,'F190622','1111',100000,1000000,3,300000);
/*!40000 ALTER TABLE `temp_barangmasuk` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `temp_barangmasuk` with 1 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` char(50) NOT NULL,
  `usernama` varchar(225) DEFAULT NULL,
  `userpassword` varchar(225) DEFAULT NULL,
  `userlevelid` int(11) DEFAULT NULL,
  `useraktif` char(1) DEFAULT '1',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES ('admin','Administrator','$2y$10$RTgbU440RFp7o.T4MixR.uDNKpL4LXDyzfy73pjI2dxAkiiaORWsq',1,'1'),('team','ilyas','$2y$10$kygE2NnKI7UiypCwwU8xwuL5Hbp6YYun7TlnmzGNTBtXvBXjZ0NnW',2,'0'),('user','user','$2y$10$RTgbU440RFp7o.T4MixR.uDNKpL4LXDyzfy73pjI2dxAkiiaORWsq',3,'1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 3 row(s)
--

DROP TRIGGER IF EXISTS `tri_insert_detailBarangKeluar`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbgudang`.`tri_insert_detailBarangKeluar` AFTER INSERT
	ON `dbgudang`.`detail_barangkeluar`
	FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = brgstok - new.detjml WHERE brgkode = new.detbrgkode;
	END */;;
DELIMITER ;

DROP TRIGGER IF EXISTS `tri_update_detailBarangKeluar`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbgudang`.`tri_update_detailBarangKeluar` AFTER UPDATE
	ON `dbgudang`.`detail_barangkeluar`
	FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = (brgstok + old.detjml) - new.detjml WHERE brgkode = new.detbrgkode;
	END */;;
DELIMITER ;

DROP TRIGGER IF EXISTS `tri_delete_detailBarangKeluar`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tri_delete_detailBarangKeluar` AFTER DELETE ON `detail_barangkeluar` 
    FOR EACH ROW BEGIN
    UPDATE barang SET brgstok = brgstok + old.detjml WHERE brgkode = old.detbrgkode;
	END */;;
DELIMITER ;

DROP TRIGGER IF EXISTS `tri_tambah_stok_barang`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbgudang`.`tri_tambah_stok_barang` AFTER INSERT
    ON `dbgudang`.`detail_barangmasuk`
    FOR EACH ROW BEGIN
	UPDATE barang SET barang.`brgstok` = barang.`brgstok` + new.detjml where barang.`brgkode`= new.detbrgkode;
    END */;;
DELIMITER ;

DROP TRIGGER IF EXISTS `tri_update_stok_barang`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tri_update_stok_barang` AFTER UPDATE ON `detail_barangmasuk` 
    FOR EACH ROW BEGIN
	UPDATE barang SET brgstok = (brgstok - old.detjml) + new.detjml WHERE brgkode = new.detbrgkode;
    END */;;
DELIMITER ;

DROP TRIGGER IF EXISTS `tri_kurangi_stok_barang`;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `dbgudang`.`tri_kurangi_stok_barang` AFTER DELETE
    ON `dbgudang`.`detail_barangmasuk`
    FOR EACH ROW BEGIN
	update barang set brgstok = brgstok - old.detjml where brgkode = old.detbrgkode;
    END */;;
DELIMITER ;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Fri, 01 Jul 2022 13:51:00 +0700
