-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5169
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kkp
DROP DATABASE IF EXISTS `kkp`;
CREATE DATABASE IF NOT EXISTS `kkp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kkp`;

-- Dumping structure for table kkp.files
DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id_file` int(6) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) NOT NULL,
  `orig_name` varchar(255) NOT NULL,
  `encrypt_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `full_path` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `file_size` float NOT NULL,
  `action` varchar(7) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `file_source` int(6) NOT NULL,
  PRIMARY KEY (`id_file`),
  KEY `id_file` (`id_file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kkp.files: ~0 rows (approximately)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table kkp.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `nip` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `userLevel` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipAddress` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `secret` int(16) NOT NULL,
  `GAuth` char(1) NOT NULL DEFAULT 'F',
  PRIMARY KEY (`nip`),
  KEY `nip` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kkp.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`nip`, `password`, `first_name`, `last_name`, `job`, `email`, `phone`, `address`, `status`, `userLevel`, `created`, `lastLogin`, `ipAddress`, `secret`, `GAuth`) VALUES
	('160074', '$2y$10$Zc3cT6HamAD.DoyzaGdqo.fMR72vnDu15pyBtBW1fSI2ZYKgI2Hm2', 'admin', 'istrator', 'administrator', 'admin@localhost.com', '089696159268', 'Jalan Raya Beraspal dan Berdebu No.0', 1, 0, '2017-04-20 12:02:13', '2017-06-09 11:41:30', '127.0.0.1', 0, 'F'),
	('160075', '$2y$10$Zc3cT6HamAD.DoyzaGdqo.fMR72vnDu15pyBtBW1fSI2ZYKgI2Hm2', 'user', 'user', 'user', 'user@localhost.com', '0123456789', 'Jalan Raya Beraspal dan Berdebu No.0', 1, 1, '2017-04-20 12:01:12', '2017-06-09 16:12:08', '127.0.0.1', 0, 'F'),
	('160076', '$2y$10$90Y.9ggpLnHpwBa2FGNXeOCVvUgGOKPH9q6mzlx20EGmr3c5CsjyW', 'Januri', 'Dwi Prasetyo', 'IT', 'janury.geek@gmail.com', '89696159268', 'asd', 1, 1, '2017-05-05 10:35:39', '2017-06-09 13:35:29', '127.0.0.1', 0, 'F'),
	('160077', '$2y$10$27UxJ.QR.BnLXTwIhiB02uI2rOVcamp2eXfifWqkrs49eotxbaYr6', 'user77', 'user77', 'IT', 'abc77@mail.com', '021021', 'asd', 1, 1, '2017-05-16 20:21:15', '2017-06-09 13:35:52', '127.0.0.1', 0, 'F');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
