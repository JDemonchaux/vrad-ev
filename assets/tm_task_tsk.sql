-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 09 Janvier 2016 à 11:38
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
-- Structure de la table `tm_task_tsk`
--

CREATE TABLE IF NOT EXISTS `tm_task_tsk` (
  `pk_tsk` int(5) NOT NULL,
  `fk_usr` int(3) NOT NULL,
  `fk_itm` int(3) NOT NULL,
  `tsk_lib` varchar(45) NOT NULL,
  `tsk_comment` varchar(255) DEFAULT NULL,
  `tsk_start_hour_plan` datetime NOT NULL,
  `tsk_end_hour_plan` datetime NOT NULL,
  `tsk_start_hour_real` datetime DEFAULT NULL,
  `tsk_end_hour_real` datetime DEFAULT NULL,
  `tsk_state` tinyint(4) DEFAULT NULL COMMENT 'NULL : non commencée\n1 : en cours\n0 : terminée',
  `tsk_is_np` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_task_tsk`
--

INSERT INTO `tm_task_tsk` (`pk_tsk`, `fk_usr`, `fk_itm`, `tsk_lib`, `tsk_comment`, `tsk_start_hour_plan`, `tsk_end_hour_plan`, `tsk_start_hour_real`, `tsk_end_hour_real`, `tsk_state`, `tsk_is_np`) VALUES
(1, 4, 1, 'faire item 1', NULL, '2015-12-12 20:00:00', '2015-12-12 20:30:00', '2016-01-03 17:13:00', '2015-12-12 20:30:00', 0, 0),
(2, 4, 1, 'faire item 1 bis', NULL, '2015-12-12 20:30:00', '2015-12-12 21:00:00', '2016-01-03 17:07:00', '2015-12-12 21:00:00', 0, 0),
(3, 4, 2, 'faire item 2 ', NULL, '2015-12-12 21:00:00', '2015-12-12 21:30:00', '2015-12-12 21:00:00', '2015-12-12 22:30:00', 0, 0),
(4, 4, 2, 'faire item 2 bis', NULL, '2015-12-12 21:30:00', '2015-12-12 23:30:00', '2015-12-12 21:30:00', NULL, 1, 0),
(5, 4, 3, 'faire item 3', NULL, '2015-12-12 20:00:00', '2015-12-12 20:30:00', '2016-01-03 17:19:00', '2016-01-03 17:19:00', NULL, 0),
(6, 4, 3, 'faire item 3 bis', NULL, '2015-12-12 20:30:00', '2015-12-12 21:00:00', NULL, NULL, NULL, 0),
(7, 4, 4, 'faire item 4 ', NULL, '2015-12-12 21:00:00', '2015-12-12 21:30:00', NULL, NULL, NULL, 0),
(8, 4, 4, 'faire item 4 bis', NULL, '2015-12-12 21:30:00', '2015-12-12 22:00:00', NULL, NULL, NULL, 0),
(9, 4, 5, 'faire item 5', NULL, '2015-12-12 22:00:00', '2015-12-12 23:30:00', '2015-12-12 22:00:00', '2015-12-12 23:30:00', 0, 0),
(10, 4, 6, 'faire item 6 ', NULL, '2015-12-12 23:00:00', '2015-12-12 23:30:00', '2015-12-12 23:00:00', '2015-12-12 23:30:00', 0, 0),
(11, 4, 7, 'faire item 7', NULL, '2015-12-12 22:00:00', '2015-12-12 22:30:00', '2015-12-12 22:00:00', '2015-12-12 22:30:00', 0, 0),
(12, 4, 8, 'faire item 8 ', NULL, '2015-12-12 23:00:00', '2015-12-12 23:30:00', '2015-12-12 23:00:00', NULL, 1, 0),
(13, 4, 9, 'faire item 9 ', NULL, '2015-12-12 21:00:00', '2015-12-12 21:30:00', NULL, NULL, NULL, 1),
(14, 4, 10, 'faire item 10', NULL, '2015-12-13 00:00:00', '2015-12-13 00:30:00', NULL, NULL, NULL, 0),
(15, 4, 10, 'faire item 10 bis', NULL, '2015-12-13 00:30:00', '2015-12-13 01:00:00', NULL, NULL, NULL, 0),
(16, 4, 10, 'faire item 11', NULL, '2015-12-13 01:00:00', '2015-12-13 01:30:00', NULL, NULL, NULL, 0),
(17, 4, 10, 'faire item 11 bis', NULL, '2015-12-13 01:30:00', '2015-12-13 02:00:00', NULL, NULL, NULL, 0),
(18, 4, 10, 'faire item 12', NULL, '2015-12-13 02:00:00', '2015-12-13 02:30:00', NULL, NULL, NULL, 0),
(19, 4, 10, 'faire item 12 bis', NULL, '2015-12-13 02:30:00', '2015-12-13 03:00:00', NULL, NULL, NULL, 0),
(20, 4, 10, 'faire item 13', NULL, '2015-12-13 03:00:00', '2015-12-13 03:30:00', NULL, NULL, NULL, 1),
(21, 4, 10, 'faire item 13 bis', NULL, '2015-12-13 03:30:00', '2015-12-13 04:00:00', NULL, NULL, NULL, 1),
(22, 4, 10, 'faire item 14', NULL, '2015-12-13 04:00:00', '2015-12-13 04:30:00', NULL, NULL, NULL, 1),
(23, 4, 10, 'faire item 15 bis', NULL, '2015-12-13 04:30:00', '2015-12-13 05:30:00', NULL, NULL, NULL, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
  ADD PRIMARY KEY (`pk_tsk`),
  ADD KEY `fk_itm` (`fk_itm`),
  ADD KEY `tm_task_tsk_ibfk_2` (`fk_usr`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
  MODIFY `pk_tsk` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
  ADD CONSTRAINT `tm_task_tsk_ibfk_1` FOREIGN KEY (`fk_itm`) REFERENCES `ref_item_itm` (`pk_itm`),
  ADD CONSTRAINT `tm_task_tsk_ibfk_2` FOREIGN KEY (`fk_usr`) REFERENCES `tm_user_usr` (`pk_usr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
