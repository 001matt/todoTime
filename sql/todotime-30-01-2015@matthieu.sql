-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 30 Janvier 2015 à 02:58
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `todotime`
--
CREATE DATABASE IF NOT EXISTS `todotime` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `todotime`;

-- --------------------------------------------------------

--
-- Structure de la table `assignation`
--

DROP TABLE IF EXISTS `assignation`;
CREATE TABLE IF NOT EXISTS `assignation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTache` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `reelTime` time NOT NULL,
  ` createdAt` datetime NOT NULL,
  `udpateAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTache` (`idTache`),
  KEY `idTache_2` (`idTache`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `assignation`
--

INSERT INTO `assignation` (`id`, `idTache`, `idUser`, `reelTime`, ` createdAt`, `udpateAt`) VALUES
(1, 1, 1, '01:00:00', '2015-01-29 00:00:00', '2015-01-29 00:00:00'),
(2, 1, 2, '01:00:00', '2015-01-30 00:00:00', '2015-01-30 00:00:00'),
(3, 2, 1, '01:00:00', '2015-01-30 00:00:00', '2015-01-30 00:00:00'),
(4, 2, 2, '01:00:00', '2015-01-30 00:00:00', '2015-01-30 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `echeance` date NOT NULL,
  `timeRealisation` time NOT NULL,
  `statut` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `titre`, `description`, `echeance`, `timeRealisation`, `statut`) VALUES
(1, 'Réalisation du projet', 'test', '2015-01-31', '02:00:00', 1),
(2, 'Création de la base', 'Avec phpmyadmin', '2015-01-31', '02:00:00', 2),
(3, 'Autoloader', 'Implementer l''autoloader dans le projet', '2015-01-30', '01:00:00', 1),
(4, 'creation de la classe tache', 'implémentation de la classe tache dans l''application ', '2015-01-30', '01:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `login`, `password`, `state`) VALUES
(1, 'pringuez', 'matthieu', '001matt@voila.fr', '001matt', 'matthieu', 1),
(2, 'Loungoundji', 'Murielle', 'murielle@gmail.com', 'murielle', 'murielle', 0),
(3, 'Jufre', 'prisca', 'prisca@gmail.com', 'prisca', 'prisca', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `assignation`
--
ALTER TABLE `assignation`
  ADD CONSTRAINT `assignation_ibfk_1` FOREIGN KEY (`idTache`) REFERENCES `tache` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `assignation_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
