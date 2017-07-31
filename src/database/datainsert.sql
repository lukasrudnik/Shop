-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               5.7.19-0ubuntu0.16.04.1 - (Ubuntu)
-- Serwer OS:                    Linux
-- HeidiSQL Wersja:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Zrzut struktury bazy danych Shop_DB
CREATE DATABASE IF NOT EXISTS `Shop_DB` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Shop_DB`;

-- Zrzut struktury tabela Shop_DB.Products
CREATE TABLE IF NOT EXISTS `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `amount` int(5) NOT NULL,
  `descritpion` varchar(255) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `category_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Zrzucanie danych dla tabeli Shop_DB.Products: ~0 rows (około)
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` (`id`, `name`, `price`, `amount`, `descritpion`, `in_stock`, `category_id`) VALUES
	(1, 'Arbuz', 2.50, 5, 'arbuz', 1, 2),
	(2, 'Ananas', 4.99, 6, 'ananas', 1, 2),
	(3, 'Banan', 2.99, 15, 'banan', 1, 2),
	(4, 'Gruszka', 3.79, 10, 'gruszka', 1, 2),
	(5, 'Jablko', 1.99, 8, 'jablko', 1, 2),
	(6, 'Truskawka', 6.99, 7, 'truskawka', 1, 2),
	(7, 'Brokul', 2.99, 3, 'brokul', 1, 1),
	(8, 'Cebula', 0.99, 5, 'cebula', 1, 1),
	(9, 'Marchew', 1.79, 10, 'marchew', 1, 1),
	(10, 'Ogorek', 2.89, 4, 'ogorek', 1, 1),
	(11, 'Papryka', 6.99, 5, 'papryka', 1, 1),
	(12, 'Pomidor', 4.99, 1, 'pomidor', 1, 1),
	(13, 'Salata', 3.49, 2, 'salata', 1, 1),
	(14, 'Ziemniak', 0.79, 3, 'ziemniak', 1, 1);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
