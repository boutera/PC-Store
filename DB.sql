-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 01:36 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecommerce2`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `categorie_idName`(`idCat` INT) RETURNS varchar(1000) CHARSET utf8mb4
BEGIN
         DECLARE nameCat varchar(50);
         SELECT desp_cat INTO nameCat FROM categorie WHERE idCategorie=idCat;
    RETURN nameCat;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `produit_idName`(`idP` INT) RETURNS varchar(50) CHARSET utf8mb4
BEGIN
         DECLARE nameP varchar(50);
         SELECT nom_prod INTO nameP FROM produit WHERE idProduit=idP;
    RETURN nameP;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `produit_idPrice`(`idP` INT) RETURNS float
BEGIN
         DECLARE priceP float;
         SELECT prix INTO priceP FROM produit WHERE idProduit=idP;
    RETURN priceP;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `produit_idPromo`(`idP` INT) RETURNS int(11)
BEGIN
DECLARE promoP float;
SELECT promo INTO promoP FROM produit WHERE idProduit = idP;
RETURN promoP;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `stock_vendu`(`idP` INT, `quantite` INT) RETURNS int(11)
BEGIN
	UPDATE produit SET stock = (SELECT stock FROM produit WHERE idProduit = idP) - quantite, vendu = (SELECT vendu FROM produit WHERE idProduit = idP) + quantite WHERE idProduit = idP;
	RETURN 1;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `vider_panier`(`idC` INT) RETURNS int(11)
BEGIN
DELETE FROM panier_produits WHERE idClient = idC;
RETURN 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `numeroTel` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `email`, `mdp`, `nom`, `prenom`, `numeroTel`, `photo`) VALUES
(1, 'admin@gmail.com', 'admin', 'ziani', 'zakaria', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `numeroTel` varchar(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idAdmin`, `email`, `mdp`, `nom`, `prenom`, `numeroTel`, `photo`) VALUES
(1, 'admin@gmail.com', 'admin', 'ziani', 'zakaria', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `zipCode` varchar(20) NOT NULL,
  `details` varchar(100) NOT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idAdresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `ville`, `pays`, `zipCode`, `details`, `idClient`) VALUES
(1, 'fes', 'maroc', '2154862', '33, machin truc', 1),
(2, 'berlin', 'Germany', '2154862', '33, machin truc', 2),
(3, 'meknes', 'Maroc', '2154862', '33, machin truc', 1),
(4, 'Midelt', 'Maroc', '2154862', '33, machin truc', 3),
(5, 'Casablanca', 'Maroc', '2154862', '33, machin truc', 4),
(6, 'Khnifra', 'Maroc', '2154862', '33, machin truc', 5),
(10, 'meknes', 'Morocco', '50000', 'machin truc', 1),
(11, 'meknes', 'Morocco', '50000', 'machin truc', 1),
(12, 'meknes', 'Morocco', '50000', 'machin truc', 1),
(13, 'casablanca', 'Morocco', '12345', 'test, testtesttest', 7),
(14, 'casablanca', 'Morocco', '12345', 'test1, test2test3', 8),
(15, 'Missour', 'Morocco', '33250', '21, rue narjiss', 5),
(16, 'Midelt', 'Morocco', '12345', 'test1, test2', 5),
(17, 'Midelt', 'Morocco', '12345', 'test1, test2', 5),
(18, 'Missour', 'Morocco', '33250', '21, rue Narjiss, quartier administratif, Missour', 3),
(19, 'Missour', 'Morocco', '33250', '21, rue Narjiss, quartier administratif, Missour', 3);

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  `evaluation` enum('0','1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`idClient`,`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`idClient`, `idProduit`, `commentaire`, `evaluation`) VALUES
(5, 6, 'gg', '3');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand` int(9) NOT NULL AUTO_INCREMENT,
  `brand_nom` varchar(200) NOT NULL,
  PRIMARY KEY (`brand`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand`, `brand_nom`) VALUES
(1, 'Acer'),
(2, 'Asus'),
(3, 'HP'),
(4, 'Msi'),
(5, 'Alien'),
(6, 'Predator'),
(7, 'Lcd'),
(8, 'Dell');

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
  `idCatalogue` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(100) NOT NULL,
  PRIMARY KEY (`idCatalogue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `catalogue_produits`
--

CREATE TABLE IF NOT EXISTS `catalogue_produits` (
  `idCatalogue` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  PRIMARY KEY (`idCatalogue`,`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `desp_cat` varchar(1000) NOT NULL,
  `idCat_parente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `desp_cat`, `idCat_parente`) VALUES
(1, 'Composants', 0),
(2, 'Peripheriques', 0),
(3, 'Cartes graphiques', 1),
(4, 'Cartes Meres', 1),
(5, 'Processeurs', 1),
(6, 'Memoires RAM', 1),
(7, 'Alimentation', 1),
(8, 'Stockage', 1),
(9, 'Graveurs', 1),
(10, 'Refroidissement', 1),
(11, 'Cartes son', 1),
(12, 'Moniteurs', 2),
(14, 'Souris', 2),
(15, 'Claviers', 2),
(16, 'Tapis', 2),
(17, 'PC Gamer', 0),
(18, 'PC Portable', 0),
(20, 'AMD Build', 17),
(21, 'INTEL Build', 17);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `img_user` varchar(100) DEFAULT NULL,
  `dateCreation` date NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenom`, `email`, `pass`, `tel`, `img_user`, `dateCreation`) VALUES
(2, 'salamat', 'fatima zahrae', 'salamat.fatimazahrae@gmail.com', '1234', NULL, NULL, '2020-11-29'),
(3, 'zakaria', 'ziani', 'zakariaziani99@gmail.com', '1234', NULL, NULL, '2020-12-30'),
(4, 'baya', 'ziyad', 'baya@gmail.com', '1234', '123456789', NULL, '0000-00-00'),
(5, 'boutera', 'youssef', 'boutera@gmail.com', '1234', NULL, NULL, '2021-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `client_fidele`
--

CREATE TABLE IF NOT EXISTS `client_fidele` (
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_fidele`
--

INSERT INTO `client_fidele` (`idClient`) VALUES
(2),
(3),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `date_cmd` datetime NOT NULL,
  `total_cmd` float NOT NULL,
  `id_typeLivraison` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`idCommande`, `idClient`, `date_cmd`, `total_cmd`, `id_typeLivraison`) VALUES
(0, 1, '2020-12-28 20:23:25', 1207.5, 1),
(1, 2, '2020-12-30 00:19:41', 19200, 2),
(2, 3, '2020-12-30 00:34:00', 6580, 2),
(3, 4, '2020-12-30 00:39:07', 16770, 1),
(4, 5, '2020-12-31 16:35:27', 3170, 1),
(70, 3, '2021-01-30 14:39:55', 3690, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commande_produits`
--

CREATE TABLE IF NOT EXISTS `commande_produits` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commande_produits`
--

INSERT INTO `commande_produits` (`idCommande`, `idProduit`, `quantite`) VALUES
(53, 15, 5),
(54, 2, 1),
(54, 10, 2),
(54, 21, 1),
(55, 2, 1),
(55, 10, 2),
(55, 21, 1),
(56, 2, 1),
(56, 10, 2),
(56, 21, 1),
(57, 2, 1),
(57, 10, 2),
(57, 21, 1),
(58, 2, 1),
(58, 10, 1),
(58, 21, 1),
(59, 9, 1),
(61, 20, 1),
(62, 20, 1),
(65, 20, 1),
(66, 6, 1),
(67, 20, 1),
(68, 6, 1),
(70, 12, 1),
(70, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `codeCoupon` varchar(10) NOT NULL,
  `valeur` int(11) NOT NULL,
  `date_expiration` date NOT NULL,
  PRIMARY KEY (`codeCoupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `envie`
--

CREATE TABLE IF NOT EXISTS `envie` (
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  PRIMARY KEY (`idClient`,`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `envie`
--

INSERT INTO `envie` (`idClient`, `idProduit`) VALUES
(5, 7),
(5, 11),
(5, 12),
(16, 19);

-- --------------------------------------------------------

--
-- Table structure for table `livraison`
--

CREATE TABLE IF NOT EXISTS `livraison` (
  `idLivraison` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) NOT NULL,
  `statut_liv` int(11) NOT NULL,
  `date_liv` datetime NOT NULL,
  `idAdresse` int(11) NOT NULL,
  PRIMARY KEY (`idLivraison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `livraison`
--

INSERT INTO `livraison` (`idLivraison`, `idCommande`, `statut_liv`, `date_liv`, `idAdresse`) VALUES
(2, 0, 1, '2020-12-26 17:11:50', 1),
(3, 1, 0, '2020-12-26 17:19:34', 2),
(4, 2, 1, '2020-12-26 17:23:57', 3),
(5, 3, 0, '2020-12-26 17:50:24', 4),
(6, 4, 2, '2020-12-26 18:24:18', 5),
(7, 30, 0, '2020-12-26 18:30:14', 6),
(8, 31, 0, '2020-12-26 18:33:20', 7),
(9, 32, 0, '2020-12-26 18:36:59', 8),
(10, 50, 0, '2020-12-28 14:07:31', 9),
(11, 51, 0, '2020-12-28 15:12:22', 10),
(12, 52, 0, '2020-12-28 18:33:20', 11),
(13, 53, 0, '2020-12-28 20:24:11', 12),
(14, 55, 0, '2020-12-30 00:27:50', 13),
(15, 57, 0, '2020-12-30 00:35:17', 14),
(16, 59, 0, '2020-12-31 17:04:24', 15),
(17, 60, 0, '2020-12-31 17:08:42', 16),
(18, 67, 0, '2021-01-06 15:43:06', 17),
(19, 69, 0, '2021-01-30 12:25:26', 18),
(20, 70, 0, '2021-01-30 14:40:06', 19);

-- --------------------------------------------------------

--
-- Table structure for table `panier_produits`
--

CREATE TABLE IF NOT EXISTS `panier_produits` (
  `idClient` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idClient`,`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `panier_produits`
--

INSERT INTO `panier_produits` (`idClient`, `idProduit`, `quantite`) VALUES
(16, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prod` varchar(50) NOT NULL,
  `desp_prod` varchar(500) NOT NULL,
  `prix` float NOT NULL,
  `img_prod` varchar(100) NOT NULL,
  `promo` float NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `vendu` int(11) NOT NULL DEFAULT '0',
  `expedie` int(1) NOT NULL DEFAULT '1',
  `brand` int(5) NOT NULL,
  PRIMARY KEY (`idProduit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom_prod`, `desp_prod`, `prix`, `img_prod`, `promo`, `stock`, `idCategorie`, `vendu`, `expedie`, `brand`) VALUES
(2, 'Laptop DELL i7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1700, 'dell.webp', 12.5, 8, 18, 50, 2, 8),
(3, 'ASUS Laptop', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1350, 'Asus.png', 19, 0, 18, 12, 1, 2),
(4, 'PC Gamer ALIEN Build', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 2790, 'alien.jpg', 50, 6, 17, 13, 2, 0),
(6, 'NVIDIA RTX 2080', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1890, 'palit rtx.jpg', 15, 9, 3, 9, 1, 6),
(7, 'Nvidia ZOTAC', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 2530, 'zotac.jpg', 30, 3, 3, 5, 2, 2),
(8, 'PC MSI Ryzen 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 2500, '1.jpg', 0, 12, 20, 5, 1, 7),
(9, 'Moniteur ACER - PREDATOR', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1200, 'acer ecran.jpg', 17.5, 18, 12, 2, 2, 1),
(10, 'Moniteur MSI - 120Hz', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 800, 'msi ecran.jpg', 46.5, 3, 12, 6, 1, 4),
(11, 'Moniteur SAMSUNG', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1000, 'moniteur lcd.jpg', 9.5, 20, 12, 0, 2, 6),
(12, 'Carte Graphique MSI GTX 2060', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 950, 'GTX ventus.jpg', 13.5, 9, 3, 6, 1, 4),
(13, 'Souris ACER - 1800 DPI', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 250, 'acer souris.jpg', 6, 30, 14, 0, 1, 1),
(14, 'Souris Optique MARVO L-21', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 150, 'souris gamer.jpg', 40, 19, 14, 1, 1, 7),
(15, 'Souris Gamer JEDEL K90', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 250, 'souris roccat.jpg', 0, 10, 14, 5, 2, 3),
(16, 'Razer Scorpion F13', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1000, 'clavier2.jpg', 37.5, 5, 15, 0, 2, 3),
(17, 'Razer Scorpion - Special Edition', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 2225, 'clavier2.jpg', 26, 14, 15, 1, 1, 3),
(18, 'Carte Graphique MSI GTX 1080', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 1500, 'geforce.jpg', 18, 10, 3, 5, 2, 4),
(19, 'PC Gamer - AMD Ryzen 5', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 2600, 'amd1.png', 15, 3, 20, 0, 2, 7),
(20, 'PC Gamer - AMD Ryzen 9', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 900, 'amd2.png', 22, 3, 20, 1, 1, 7),
(21, 'PC Gamer - Intel i7', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.', 3000, 'intel1.png', 5.5, 4, 21, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `types_livraisons`
--

CREATE TABLE IF NOT EXISTS `types_livraisons` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(50) NOT NULL,
  `prix_livraison` int(11) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `types_livraisons`
--

INSERT INTO `types_livraisons` (`id_type`, `nom_type`, `prix_livraison`) VALUES
(1, 'standard', 20),
(2, 'express', 50);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
