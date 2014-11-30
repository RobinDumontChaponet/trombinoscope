-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: 195.83.142.10:3306
-- Généré le : Dim 30 Novembre 2014 à 22:23
-- Version du serveur: 5.5.40
-- Version de PHP: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dumont28u_trombi`
--

-- --------------------------------------------------------

--
-- Structure de la table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `idAuth` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`idAuth`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `auth`
--

INSERT INTO `auth` (`idAuth`, `name`) VALUES
(0, 'admin'),
(1, 'student'),
(2, 'teacher');

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `idGroup` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `startDate` varchar(4) DEFAULT NULL,
  `endDate` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idGroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`idGroup`, `name`, `startDate`, `endDate`) VALUES
(3, '1.1', '2014', '2016'),
(4, '2.2', '2014', '2015'),
(29, '3.1', '2014', '2015');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `idUser` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `idGroup` int(5) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `id_group` (`idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `student`:
--   `idGroup`
--       `group` -> `idGroup`
--   `idUser`
--       `user` -> `idUser`
--

--
-- Contenu de la table `student`
--

INSERT INTO `student` (`idUser`, `name`, `firstName`, `idGroup`) VALUES
(2, 'Dumont', 'Robin', 3),
(6, 'Jozwicki', 'Victor', 4),
(14, 'Vann', 'Thomas', 3),
(32, ' Jozwicki', 'Victor', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(5) NOT NULL AUTO_INCREMENT,
  `idAuth` int(5) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `id_auth` (`idAuth`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- RELATIONS POUR LA TABLE `user`:
--   `idAuth`
--       `auth` -> `idAuth`
--

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `idAuth`, `login`, `pwd`) VALUES
(1, 0, 'admin', 'sha256:1000:CKTZog3SdTZeyJns0ohWeGfjIBKeIL/X:oCPXcTANIhUyAES'),
(2, 1, 'DumoRobi', 'e7@&D-f0'),
(3, 2, 'professeur', 'sha256:1000:8yVTlh3r2PPddmX3pg001kZ+0AYBN0SO:9ffuiWe2Tl+NFEu'),
(6, 1, 'JozwVict', 'z42_Ni&p'),
(14, 1, 'VannThom', '_B9^76@8'),
(32, 1, ' JozVict', 'znVx4GC*');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_12` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_11` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idAuth`) REFERENCES `auth` (`idAuth`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
