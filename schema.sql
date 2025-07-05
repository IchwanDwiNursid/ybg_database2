-- MySQL dump 10.13  Distrib 9.3.0, for macos13.7 (x86_64)
--
-- Host: localhost    Database: benr1857_ybg
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alamat`
--

DROP TABLE IF EXISTS `alamat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alamat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCustomer` int DEFAULT NULL,
  `Alamat` text,
  `KodePos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idCustomer` (`idCustomer`),
  CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bayar_cicilan`
--

DROP TABLE IF EXISTS `bayar_cicilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bayar_cicilan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCicilan` int NOT NULL,
  `idSales` int NOT NULL,
  `jumlahBayar` int NOT NULL,
  `tanggalBayar` date NOT NULL,
  `ket` varchar(400) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCicilan` (`idCicilan`),
  KEY `idSales` (`idSales`),
  CONSTRAINT `bayar_cicilan_ibfk_1` FOREIGN KEY (`idCicilan`) REFERENCES `cicilan` (`id`),
  CONSTRAINT `bayar_cicilan_ibfk_2` FOREIGN KEY (`idSales`) REFERENCES `salesadvisor` (`IdSales`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `idBrand` int NOT NULL AUTO_INCREMENT,
  `Brand` varchar(255) NOT NULL,
  `idCategoryProduk` int NOT NULL,
  PRIMARY KEY (`idBrand`),
  KEY `idCategoryProduk` (`idCategoryProduk`),
  CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`idCategoryProduk`) REFERENCES `catprod` (`idCategoryProduk`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `catcust`
--

DROP TABLE IF EXISTS `catcust`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catcust` (
  `idCategoryCust` int NOT NULL AUTO_INCREMENT,
  `CategoryCust` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCategoryCust`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `catprod`
--

DROP TABLE IF EXISTS `catprod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catprod` (
  `idCategoryProduk` int NOT NULL AUTO_INCREMENT,
  `CategoryProduk` varchar(500) NOT NULL,
  PRIMARY KEY (`idCategoryProduk`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cicilan`
--

DROP TABLE IF EXISTS `cicilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cicilan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idOrder` int NOT NULL,
  `idCustomer` int NOT NULL,
  `totalCicilan` int NOT NULL,
  `jumlahAngsuran` int NOT NULL,
  `cicilan_ke` int NOT NULL,
  `sisaCicilan` int NOT NULL,
  `jatuhTempo` date NOT NULL,
  `status` enum('BELUM_LUNAS','LUNAS') DEFAULT 'BELUM_LUNAS',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idOrder` (`idOrder`),
  KEY `idCustomer` (`idCustomer`),
  CONSTRAINT `cicilan_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`),
  CONSTRAINT `cicilan_ibfk_2` FOREIGN KEY (`idOrder`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `idCustomer` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(500) NOT NULL,
  `Birthdate` date DEFAULT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCustomer`),
  UNIQUE KEY `unique_phonenumber` (`PhoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detail_order`
--

DROP TABLE IF EXISTS `detail_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idOrder` int NOT NULL,
  `status_shipping` enum('pending','processing','shipped','delivered','cancelled','returned') DEFAULT (_utf8mb4'pending'),
  `ongkir` int DEFAULT (0),
  `asuransi` int DEFAULT (0),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idOrder` (`idOrder`),
  CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kd_transaksi` varchar(200) NOT NULL,
  `dateTransaction` date DEFAULT NULL,
  `idCustomer` int DEFAULT NULL,
  `IdSales` int DEFAULT NULL,
  `Brand` int DEFAULT NULL,
  `SKUName` varchar(255) DEFAULT NULL,
  `idCategoryProduk` int NOT NULL,
  `QtyOrder` int DEFAULT NULL,
  `idMethode` int DEFAULT NULL,
  `BasePrice` varchar(255) DEFAULT NULL,
  `BeforeDisc` varchar(255) DEFAULT NULL,
  `Discount` varchar(255) DEFAULT NULL,
  `AfterDisc` varchar(255) DEFAULT NULL,
  `Point` int NOT NULL DEFAULT '0',
  `pointclaim` int NOT NULL,
  `idCategoryCust` int DEFAULT NULL,
  `idvoucher` varchar(255) DEFAULT NULL,
  `Keterangan` text,
  `Alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCustomer` (`idCustomer`),
  KEY `IdSales` (`IdSales`),
  KEY `idMethode` (`idMethode`),
  KEY `idCategoryCust` (`idCategoryCust`),
  KEY `idCategoryProduk` (`idCategoryProduk`),
  KEY `Brand` (`Brand`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`IdSales`) REFERENCES `salesadvisor` (`IdSales`),
  CONSTRAINT `order_ibfk_3` FOREIGN KEY (`idMethode`) REFERENCES `paymentmethode` (`idMethode`),
  CONSTRAINT `order_ibfk_4` FOREIGN KEY (`idCategoryCust`) REFERENCES `catcust` (`idCategoryCust`),
  CONSTRAINT `order_ibfk_5` FOREIGN KEY (`idCategoryProduk`) REFERENCES `catprod` (`idCategoryProduk`),
  CONSTRAINT `order_ibfk_6` FOREIGN KEY (`Brand`) REFERENCES `brand` (`idBrand`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `paymentmethode`
--

DROP TABLE IF EXISTS `paymentmethode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paymentmethode` (
  `idMethode` int NOT NULL AUTO_INCREMENT,
  `Methode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idMethode`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `salesadvisor`
--

DROP TABLE IF EXISTS `salesadvisor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salesadvisor` (
  `IdSales` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdSales`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voucher` (
  `idvoucher` varchar(255) NOT NULL,
  `namavoucher` varchar(100) NOT NULL,
  `nominal` varchar(200) NOT NULL,
  PRIMARY KEY (`idvoucher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-04 17:19:59
