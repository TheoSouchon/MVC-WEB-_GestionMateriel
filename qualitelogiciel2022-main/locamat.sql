-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 10 déc. 2022 à 10:57
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `locamat`
--

-- --------------------------------------------------------

--
-- Structure de la table `borrowing`
--

DROP TABLE IF EXISTS `borrowing`;
CREATE TABLE IF NOT EXISTS `borrowing` (
  `Reference` varchar(255) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `BorrowingDate` date NOT NULL,
  `DeliveryDate` date NOT NULL,
  PRIMARY KEY (`Reference`,`Email`),
  KEY `fk_email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `borrowing`
--

INSERT INTO `borrowing` (`Reference`, `Email`, `BorrowingDate`, `DeliveryDate`) VALUES
('CLAV52', 'theo.souchon@gmail.com', '2022-12-01', '2022-12-08'),
('TAB77', 'celian.pithon@gmail.com', '2022-12-06', '2022-12-13'),
('TEL30', 'celian.pithon@gmail.com', '2022-12-21', '2022-12-28');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `Name` varchar(100) NOT NULL,
  `Version` varchar(100) NOT NULL,
  `Reference` varchar(255) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Reference`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`Name`, `Version`, `Reference`, `Type`, `Brand`, `Picture`, `PhoneNumber`) VALUES
('Blackwidow', 'V.5.2.', 'CLAV52', 'Clavier', 'Razer', 'httpOuImageCheminProjet', NULL),
('NeonFlash', 'V.18.5.', 'ECRAN185', 'Ecran', 'AOC', NULL, NULL),
('Rival600', 'V.8.0.', 'SOURV80', 'Souris', 'Steelseries', 'httpOuCheminImageProjet', NULL),
('FlatLight', 'V.7.7.', 'TAB77', 'Tablette', 'Lenovo', NULL, NULL),
('SamsungS8', 'V.3.0.', 'TEL30', 'Telephone', 'Samsung', 'httpOuImageCheminProjet', '0678957420'),
('Facecam', 'V.12.4.', 'WEBCAM124', 'Webcam', 'Elgato', 'httpOuImageBureau', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Lastname` varchar(100) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Role` tinyint(1) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Lastname`, `Firstname`, `Email`, `Role`, `pwd`) VALUES
('Pithon', 'Celian', 'celian.pithon@gmail.com', 0, '$2y$10$vvhe9iu7KIb64a6a8Y1u1OXORgLOv8jQB./JPSy/NDq46Vqqvl4ja'),
('Poitrineau', 'Paul', 'paul.poitrineau@gmail.com', 0, '$2y$10$mG1h6ejrpquta5NYJ5K8jOr0U6zEtaeqxSWbW4Eyxlloz3aFNXPsm'),
('Souchon', 'Theo', 'theo.souchon@gmail.com', 1, '$2y$10$fm1Ds2iQSaEyHQ3UhHQ4XeHLJ6R49.ZubEnRHD7FsdNj1eLxgSF8i');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`),
  ADD CONSTRAINT `fk_reference` FOREIGN KEY (`Reference`) REFERENCES `items` (`Reference`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
