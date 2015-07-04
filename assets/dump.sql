-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 24 Mai 2015 à 20:18
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `nuit_du_projet_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `ref_category_cat`
--

CREATE TABLE IF NOT EXISTS `ref_category_cat` (
`pk_cat` int(2) NOT NULL,
  `cat_lib` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_category_cat`
--

INSERT INTO `ref_category_cat` (`pk_cat`, `cat_lib`) VALUES
(1, 'Gestion de projet'),
(2, 'Qualité'),
(3, 'Système & réseau'),
(4, 'Développement');

-- --------------------------------------------------------

--
-- Structure de la table `ref_grade_grd`
--

CREATE TABLE IF NOT EXISTS `ref_grade_grd` (
`pk_grd` int(2) NOT NULL,
  `grd_lib` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_grade_grd`
--

INSERT INTO `ref_grade_grd` (`pk_grd`, `grd_lib`) VALUES
(1, 'BTS'),
(2, 'DUT'),
(3, 'Licence (Bac +3)'),
(4, 'Bac + 4'),
(5, 'Master (Bac +5)'),
(6, 'Ancien');

-- --------------------------------------------------------

--
-- Structure de la table `ref_item_itm`
--

CREATE TABLE IF NOT EXISTS `ref_item_itm` (
`pk_itm` int(3) NOT NULL,
  `fk_cat` int(2) NOT NULL,
  `itm_lib` varchar(100) NOT NULL,
  `itm_weight` int(2) NOT NULL,
  `itm_priority` varchar(6) NOT NULL COMMENT 'MUST, SHOULD, COULD, WOULD',
  `itm_type` enum('EF','ENF') NOT NULL,
  `itm_livrable` tinyint(1) NOT NULL,
  `itm_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_item_itm`
--

INSERT INTO `ref_item_itm` (`pk_itm`, `fk_cat`, `itm_lib`, `itm_weight`, `itm_priority`, `itm_type`, `itm_livrable`, `itm_desc`) VALUES
(1, 1, 'initiatives', 3, 'NA', 'EF', 0, 'réalisation (fonctionnalité/service)'),
(2, 1, 'revue de projet ', 6, 'NA', 'EF', 0, '(toutes les 2 heures)'),
(3, 1, 'planification Agora', 6, 'NA', 'EF', 0, NULL),
(4, 1, 'respect des priorités (réel)', 6, 'NA', 'EF', 0, NULL),
(5, 1, 'pas de bug / réseau Opérationnel', 2, 'NA', 'EF', 0, 'robustesse'),
(6, 2, 'document règles de filtrage FW', 4, 'NA', 'EF', 1, 'maintenabilité	Système & réseau'),
(7, 2, 'Document ressource avec mots de passe', 2, '', 'EF', 1, '	maintenabilité	Système & réseau'),
(8, 2, 'Schéma de principe des machines VM', 5, 'NA', 'EF', 1, '	maintenabilité	Système & réseau'),
(9, 2, 'Schéma réseau', 5, 'NA', 'EF', 0, '	maintenabilité	Système & réseau'),
(10, 2, 'évolutions et intervention en production facilité', 5, 'NA', 'EF', 0, 'maintenabilité	développement'),
(11, 2, 'respect charte graphique', 5, 'NA', 'EF', 0, '	ergonomie	développement'),
(12, 2, 'respect maquettes', 5, 'NA', 'EF', 0, '	ergonomie	développement'),
(13, 2, 'injections SQL/XSS', 4, 'NA', 'EF', 0, 'Sécurité	développement'),
(14, 2, 'pretty URL (URL rewrinting)', 4, 'NA', 'EF', 0, 'Sécurité	développement'),
(15, 2, 'login et gestion des droits par AD', 4, 'NA', 'EF', 0, 'Sécurité	développement'),
(16, 2, 'configuration PFSENSE (NAT,DMZ,FW,LAN…)', 10, 'NA', 'EF', 1, 'Sécurité	développement'),
(17, 2, 'HTTPS sur WEB', 2, 'NA', 'EF', 1, 'Sécurité	développement'),
(18, 2, 'Base de données sécurisées (mot de passe, acc', 2, 'NA', 'EF', 1, 'Sécurité	Système & réseau'),
(19, 4, 'home > avancement', 5, 'MUST', 'EF', 1, 'front office connecté home tous'),
(20, 4, 'affichage Gantt visuel', 5, 'SHOULD', 'EF', 1, 'front office connecté	mon projet	participant	Gantt visuel'),
(21, 4, 'Importer la liste des items', 3, 'WOULD', 'EF', 1, 'back office	ressources	Administrateur'),
(27, 4, 'Inscription Participant', 1, 'COULD', 'EF', 1, 'front office	inscription'),
(28, 4, 'Création groupe', 1, 'COULD', 'EF', 1, 'front office	inscription'),
(29, 4, 'Inscription Jury', 1, 'WOULD', 'EF', 1, 'front office	inscription'),
(30, 4, 'Création école', 1, 'WOULD', 'EF', 1, 'front office	inscription');

-- --------------------------------------------------------

--
-- Structure de la table `ref_page_page`
--

CREATE TABLE IF NOT EXISTS `ref_page_page` (
`pk_page` int(2) NOT NULL,
  `page_lib` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ref_subject_sbj`
--

CREATE TABLE IF NOT EXISTS `ref_subject_sbj` (
`pk_sbj` int(2) NOT NULL,
  `sbj_lib` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_subject_sbj`
--

INSERT INTO `ref_subject_sbj` (`pk_sbj`, `sbj_lib`) VALUES
(1, 'BDD'),
(2, 'Développement'),
(3, 'Gestion de projet'),
(4, 'Système'),
(5, 'Réseau'),
(6, 'Génie Logiciel');

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
('admin', 'Notation', 'Ressources', '00000000011'),
('jury', 'Notation', 'Jury', '00000000011'),
('jury', 'Notation', 'Ressouces', '00000000001'),
('jury', 'Notation', 'Resultats', '00000000111'),
('jury', 'Projet', 'Plannification', '00000000001'),
('membre', 'Projet', 'Plannification', '00000000011'),
('membre', 'Projet', 'tache', '11111111111');

-- --------------------------------------------------------

--
-- Structure de la table `tj_see_role_page_srp`
--

CREATE TABLE IF NOT EXISTS `tj_see_role_page_srp` (
  `fk_usr_role` varchar(10) NOT NULL,
  `fk_page` int(2) NOT NULL,
  `rgt_is_visible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tj_teach_tch`
--

CREATE TABLE IF NOT EXISTS `tj_teach_tch` (
  `fk_sbj` int(2) NOT NULL,
  `fk_usr` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tm_group_grp`
--

CREATE TABLE IF NOT EXISTS `tm_group_grp` (
`pk_grp` int(2) NOT NULL,
  `fk_schl` int(2) NOT NULL,
  `grp_lib` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_group_grp`
--

INSERT INTO `tm_group_grp` (`pk_grp`, `fk_schl`, `grp_lib`) VALUES
(1, 2, 'les Anonymous'),
(2, 2, 'Les Bras Cassés');

-- --------------------------------------------------------

--
-- Structure de la table `tm_school_schl`
--

CREATE TABLE IF NOT EXISTS `tm_school_schl` (
`pk_schl` int(2) NOT NULL,
  `schl_lib` varchar(50) NOT NULL,
  `schl_city` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_school_schl`
--

INSERT INTO `tm_school_schl` (`pk_schl`, `schl_lib`, `schl_city`) VALUES
(1, 'ESAIP - Saint Joseph', 'Dijon'),
(2, 'ES Pasteur Mont Roland', 'Dole');

-- --------------------------------------------------------

--
-- Structure de la table `tm_score_grp_itm_scr`
--

CREATE TABLE IF NOT EXISTS `tm_score_grp_itm_scr` (
`fk_grp` int(2) NOT NULL,
  `fk_itm` int(3) NOT NULL,
  `scr_score` int(2) NOT NULL,
  `scr_comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tm_user_usr`
--

CREATE TABLE IF NOT EXISTS `tm_user_usr` (
`pk_usr` int(3) NOT NULL,
  `fk_grd` int(2) DEFAULT NULL,
  `fk_schl` int(2) DEFAULT NULL,
  `fk_grp` int(2) DEFAULT NULL,
  `usr_role` varchar(10) NOT NULL,
  `usr_name` varchar(25) NOT NULL,
  `usr_firstname` varchar(25) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `usr_pwd` varchar(32) NOT NULL,
  `usr_account_valid` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_user_usr`
--

INSERT INTO `tm_user_usr` (`pk_usr`, `fk_grd`, `fk_schl`, `fk_grp`, `usr_role`, `usr_name`, `usr_firstname`, `usr_email`, `usr_pwd`, `usr_account_valid`) VALUES
(1, NULL, 1, NULL, 'admin', 'Dussert', 'Nicolas', 'nicolas.dussert@stjodijon.com', 'admin', 1),
(2, NULL, 2, NULL, 'jury', 'Bailly', 'Olivier', 'o.bailly@glpmr.info', 'Oby', 1),
(3, NULL, 1, NULL, 'jury', 'Barbier', 'Marie', 'marie.barbier.work@gmail.com', 'marie', 1),
(4, 6, 2, 1, 'membre', 'Renard', 'Julien', 'j.renard@glpmr.info', 'j.renard', 1),
(5, 4, 2, 1, 'membre', 'Quentin', 'Faivre', 'q.faivre@glpmr.info', 'q.faivre', 1),
(6, 4, 2, 1, 'membre', 'Demonchaux', 'Jérome', 'j.demonchaux@glpmr.info', 'd41d8cd98f00b204e9800998ecf8427e', 1),
(7, 4, 2, 1, 'membre', 'Bergerot', 'Marian', 'm.bergerot@glpmr.info', 'm.berger', 1),
(8, 4, 2, 2, 'membre', 'Delpeaux', 'Cindy', 'c.delpeaux@glpmr.info', 'c.delpea', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ref_category_cat`
--
ALTER TABLE `ref_category_cat`
 ADD PRIMARY KEY (`pk_cat`);

--
-- Index pour la table `ref_grade_grd`
--
ALTER TABLE `ref_grade_grd`
 ADD PRIMARY KEY (`pk_grd`);

--
-- Index pour la table `ref_item_itm`
--
ALTER TABLE `ref_item_itm`
 ADD PRIMARY KEY (`pk_itm`), ADD KEY `fk_REF_ITEM_itm_REF_CATEGORY_CAT1_idx` (`fk_cat`);

--
-- Index pour la table `ref_page_page`
--
ALTER TABLE `ref_page_page`
 ADD PRIMARY KEY (`pk_page`);

--
-- Index pour la table `ref_subject_sbj`
--
ALTER TABLE `ref_subject_sbj`
 ADD PRIMARY KEY (`pk_sbj`);

--
-- Index pour la table `tj_rights_rgt`
--
ALTER TABLE `tj_rights_rgt`
 ADD PRIMARY KEY (`fk_usr_role`,`rgt_model`,`rgt_controller`,`rgt_allow`);

--
-- Index pour la table `tj_see_role_page_srp`
--
ALTER TABLE `tj_see_role_page_srp`
 ADD PRIMARY KEY (`fk_usr_role`,`fk_page`,`rgt_is_visible`), ADD KEY `fk_tj_see_role_page_srp_2` (`fk_page`);

--
-- Index pour la table `tj_teach_tch`
--
ALTER TABLE `tj_teach_tch`
 ADD PRIMARY KEY (`fk_sbj`,`fk_usr`), ADD KEY `fk_tj_teach_tch_2` (`fk_usr`);

--
-- Index pour la table `tm_group_grp`
--
ALTER TABLE `tm_group_grp`
 ADD PRIMARY KEY (`pk_grp`), ADD KEY `fk_TM_GROUP_GRP_TM_SCHOOL_SCHL1_idx` (`fk_schl`);

--
-- Index pour la table `tm_school_schl`
--
ALTER TABLE `tm_school_schl`
 ADD PRIMARY KEY (`pk_schl`);

--
-- Index pour la table `tm_score_grp_itm_scr`
--
ALTER TABLE `tm_score_grp_itm_scr`
 ADD PRIMARY KEY (`fk_grp`,`fk_itm`), ADD KEY `fk_TM_SCORE_GRP_itm_SCR_REF_ITEM_ITM1_idx` (`fk_itm`);

--
-- Index pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
 ADD PRIMARY KEY (`pk_tsk`), ADD KEY `fk_itm` (`fk_itm`), ADD KEY `tm_task_tsk_ibfk_2` (`fk_usr`);

--
-- Index pour la table `tm_user_usr`
--
ALTER TABLE `tm_user_usr`
 ADD PRIMARY KEY (`pk_usr`), ADD UNIQUE KEY `usr_email_UNIQUE` (`usr_email`), ADD KEY `fk_TM_USER_usr_TM_SCHOOL_SCHL_idx` (`fk_schl`), ADD KEY `fk_TM_USER_usr_TM_GROUP_GRP1_idx` (`fk_grp`), ADD KEY `fk_TM_USER_usr_ref_grade_grd1_idx` (`fk_grd`), ADD KEY `usr_role` (`usr_role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ref_category_cat`
--
ALTER TABLE `ref_category_cat`
MODIFY `pk_cat` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ref_grade_grd`
--
ALTER TABLE `ref_grade_grd`
MODIFY `pk_grd` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ref_item_itm`
--
ALTER TABLE `ref_item_itm`
MODIFY `pk_itm` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `ref_page_page`
--
ALTER TABLE `ref_page_page`
MODIFY `pk_page` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ref_subject_sbj`
--
ALTER TABLE `ref_subject_sbj`
MODIFY `pk_sbj` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tm_group_grp`
--
ALTER TABLE `tm_group_grp`
MODIFY `pk_grp` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tm_school_schl`
--
ALTER TABLE `tm_school_schl`
MODIFY `pk_schl` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `tm_score_grp_itm_scr`
--
ALTER TABLE `tm_score_grp_itm_scr`
MODIFY `fk_grp` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
MODIFY `pk_tsk` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tm_user_usr`
--
ALTER TABLE `tm_user_usr`
MODIFY `pk_usr` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ref_item_itm`
--
ALTER TABLE `ref_item_itm`
ADD CONSTRAINT `fk_REF_ITEM_itm_REF_CATEGORY_CAT1` FOREIGN KEY (`fk_cat`) REFERENCES `ref_category_cat` (`pk_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tj_rights_rgt`
--
ALTER TABLE `tj_rights_rgt`
ADD CONSTRAINT `fk_tj_rights_rgt_1` FOREIGN KEY (`fk_usr_role`) REFERENCES `tm_user_usr` (`usr_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tj_see_role_page_srp`
--
ALTER TABLE `tj_see_role_page_srp`
ADD CONSTRAINT `fk_tj_see_role_page_srp_1` FOREIGN KEY (`fk_usr_role`) REFERENCES `tm_user_usr` (`usr_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tj_see_role_page_srp_2` FOREIGN KEY (`fk_page`) REFERENCES `ref_page_page` (`pk_page`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tj_teach_tch`
--
ALTER TABLE `tj_teach_tch`
ADD CONSTRAINT `fk_tj_teach_tch_1` FOREIGN KEY (`fk_sbj`) REFERENCES `ref_subject_sbj` (`pk_sbj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tj_teach_tch_2` FOREIGN KEY (`fk_usr`) REFERENCES `tm_user_usr` (`pk_usr`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tm_group_grp`
--
ALTER TABLE `tm_group_grp`
ADD CONSTRAINT `fk_TM_GROUP_GRP_TM_SCHOOL_SCHL1` FOREIGN KEY (`fk_schl`) REFERENCES `tm_school_schl` (`pk_schl`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tm_score_grp_itm_scr`
--
ALTER TABLE `tm_score_grp_itm_scr`
ADD CONSTRAINT `fk_TM_SCORE_GRP_itm_SCR_REF_ITEM_ITM1` FOREIGN KEY (`fk_itm`) REFERENCES `ref_item_itm` (`pk_itm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_TM_SCORE_GRP_itm_SCR_TM_GROUP_GRP1` FOREIGN KEY (`fk_grp`) REFERENCES `tm_group_grp` (`pk_grp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
ADD CONSTRAINT `tm_task_tsk_ibfk_1` FOREIGN KEY (`fk_itm`) REFERENCES `ref_item_itm` (`pk_itm`),
ADD CONSTRAINT `tm_task_tsk_ibfk_2` FOREIGN KEY (`fk_usr`) REFERENCES `tm_user_usr` (`pk_usr`);

--
-- Contraintes pour la table `tm_user_usr`
--
ALTER TABLE `tm_user_usr`
ADD CONSTRAINT `fk_TM_USER_usr_TM_GROUP_GRP1` FOREIGN KEY (`fk_grp`) REFERENCES `tm_group_grp` (`pk_grp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_TM_USER_usr_TM_SCHOOL_SCHL` FOREIGN KEY (`fk_schl`) REFERENCES `tm_school_schl` (`pk_schl`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_TM_USER_usr_ref_grade_grd1` FOREIGN KEY (`fk_grd`) REFERENCES `ref_grade_grd` (`pk_grd`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
