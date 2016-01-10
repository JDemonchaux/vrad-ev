-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 09 Janvier 2016 à 13:41
-- Version du serveur :  5.6.25
-- Version de PHP :  5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nuit_du_projet_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_rights_rgt`
--

CREATE TABLE IF NOT EXISTS `tj_rights_rgt` (
  `fk_usr_role` varchar(10) NOT NULL,
  `rgt_model` varchar(20) NOT NULL,
  `rgt_controller` varchar(30) NOT NULL,
  `rgt_allow` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tj_rights_rgt`
--

INSERT INTO `tj_rights_rgt` (`fk_usr_role`, `rgt_model`, `rgt_controller`, `rgt_allow`) VALUES
('admin', 'Notation', 'Ressources', '00000001111'),
('jury', 'Notation', 'Evaluation', '00000000011'),
('jury', 'Notation', 'Ressouces', '00000000001'),
('jury', 'Notation', 'Ressources', '00000000001'),
('jury', 'Notation', 'Resultats', '00000000111'),
('jury', 'Projet', 'Planification', '00000000001'),
('membre', 'Notation', 'Ressources', '00000000001'),
('membre', 'Notation', 'Resultats', '00000000111'),
('membre', 'Projet', 'Planification', '00000000011'),
('membre', 'Projet', 'Tache', '11111111111');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tj_rights_rgt`
--
ALTER TABLE `tj_rights_rgt`
  ADD PRIMARY KEY (`fk_usr_role`,`rgt_model`,`rgt_controller`,`rgt_allow`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tj_rights_rgt`
--
ALTER TABLE `tj_rights_rgt`
  ADD CONSTRAINT `fk_tj_rights_rgt_1` FOREIGN KEY (`fk_usr_role`) REFERENCES `tm_user_usr` (`usr_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
