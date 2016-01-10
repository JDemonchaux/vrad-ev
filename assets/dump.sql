-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 12 Décembre 2015 à 10:31
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
-- Structure de la table `ref_category_cat`
--

CREATE TABLE IF NOT EXISTS `ref_category_cat` (
  `pk_cat` int(2) NOT NULL,
  `cat_lib` varchar(45) NOT NULL,
  `cat_hexa_color` varchar(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_category_cat`
--

INSERT INTO `ref_category_cat` (`pk_cat`, `cat_lib`, `cat_hexa_color`) VALUES
(1, 'Gestion de projet', '#9974AA'),
(2, 'Qualité', '#84C68C'),
(3, 'Sécurité', '#059CD6'),
(4, 'Système & réseau', '#FFF875'),
(5, 'Développement', '#FFC875');


-- --------------------------------------------------------

--
-- Structure de la table `ref_grade_grd`
--

CREATE TABLE IF NOT EXISTS `ref_grade_grd` (
  `pk_grd` int(2) NOT NULL,
  `grd_lib` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
  `itm_niv` tinyint(1) NOT NULL COMMENT '1 : BTS ; 2 : POST-BTS',
  `itm_weight` int(2) NOT NULL,
  `itm_priority` varchar(6) NOT NULL COMMENT 'MUST, SHOULD, COULD, WOULD',
  `itm_type` enum('EF','ENF') NOT NULL,
  `itm_livrable` tinyint(1) NOT NULL ,
  `itm_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ref_item_itm`
--


-- V 15/01/2016
INSERT INTO `ref_item_itm` (`pk_itm`, `fk_cat`, `itm_lib`,`itm_niv`,  `itm_weight`, `itm_priority`, `itm_type`, `itm_livrable`, `itm_desc`) VALUES
(1,1,'initiatives',1,3,'WOULD','ENF',0,'Gestion de projet > réalisation (fonctionnalité/service) >  > initiatives'),
(2,1,'Planification',1,6,'MUST','ENF',1,'Gestion de projet > réalisation (fonctionnalité/service) >  > Planification'),
(3,1,'MAJ régulière de l\'avancement',1,6,'SHOULD','ENF',0,'Gestion de projet > réalisation (fonctionnalité/service) >  > MAJ régulière de l\'avancement'),
(4,1,'respect des priorités (réel)',1,6,'COULD','ENF',0,'Gestion de projet > réalisation (fonctionnalité/service) >  > respect des priorités (réel)'),
(5,2,'pas de bug / réseau Opérationnel',1,2,'WOULD','ENF',0,'Qualité > robustesse >  > pas de bug / réseau Opérationnel'),
(6,2,'document règles de filtrage FW',1,5,'WOULD','ENF',1,'Qualité > maintenabilité > Système & réseaudocument règles de filtrage FW'),
(7,2,'Document ressource avec mots de passe',1,2,'WOULD','ENF',1,'Qualité > maintenabilité > Système & réseauDocument ressource avec mots de passe'),
(8,2,'Schéma de principe des machines VM',1,4,'WOULD','ENF',1,'Qualité > maintenabilité > Système & réseauSchéma de principe des machines VM'),
(9,2,'Schéma réseau',1,4,'MUST','ENF',1,'Qualité > maintenabilité > Système & réseauSchéma réseau'),
(10,2,'évolutions et intervention en production facilité',1,5,'WOULD','ENF',0,'Qualité > maintenabilité > développementévolutions et intervention en production facilité'),
(11,2,'respect maquettes',1,5,'COULD','ENF',0,'Qualité > ergonomie > développementrespect maquettes'),
(12,2,'respect responsive',2,5,'COULD','ENF',0,'Qualité > ergonomie > développementrespect responsive'),
(13,2,'one page',2,5,'WOULD','ENF',0,'Qualité > ergonomie > développementone page'),
(14,3,'injections SQL/XSS',1,4,'WOULD','ENF',0,'Qualité > Sécurité > développementinjections SQL/XSS'),
(15,3,'Appli mobile native',1,4,'WOULD','ENF',0,'Qualité > Sécurité > développementAppli mobile native'),
(16,3,'configuration PFSENSE (NAT,DMZ,FW,LAN…)',1,10,'SHOULD','ENF',0,'Qualité > Sécurité > Système & réseauconfiguration PFSENSE (NAT,DMZ,FW,LAN…)'),
(17,3,'HTTPS sur WEB',1,2,'WOULD','ENF',0,'Qualité > Sécurité > Système & réseauHTTPS sur WEB'),
(18,4,'Base de données sécurisées (mot de passe, accès réseau)',1,2,'WOULD','ENF',0,'Qualité > Sécurité > Système & réseauBase de données sécurisées (mot de passe, accès réseau)'),
(19,4,'Installation Hyperviseur',1,2,'MUST','EF',1,'Système & réseau > Matériel >  > Installation Hyperviseur'),
(20,4,'Installation PFSENSE',1,2,'MUST','EF',1,'Système & réseau > Matériel >  > Installation PFSENSE'),
(21,4,'installation serveur WEB',1,2,'SHOULD','EF',1,'Système & réseau > Matériel >  > installation serveur WEB'),
(22,4,'Installation serveur Base de Données',1,2,'SHOULD','EF',1,'Système & réseau > Matériel >  > Installation serveur Base de Données'),
(23,4,'Installation serveur windows',1,2,'SHOULD','EF',1,'Système & réseau > Matériel >  > Installation serveur windows'),
(24,4,'définition RAID5 ou RAID1',1,2,'COULD','EF',1,'Système & réseau > Matériel >  > définition RAID5 ou RAID1'),
(25,4,'Installation owncloud',1,2,'COULD','EF',1,'Système & réseau > Matériel >  > Installation owncloud'),
(26,4,'Configuration Hyperviseur',1,4,'MUST','EF',1,'Système & réseau > Logiciel >  > Configuration Hyperviseur'),
(27,4,'configuration service WEB',1,4,'SHOULD','EF',1,'Système & réseau > Logiciel >  > configuration service WEB'),
(28,4,'configuration BDD',1,4,'SHOULD','EF',1,'Système & réseau > Logiciel >  > configuration BDD'),
(29,4,'Configuration Proxy',1,3,'COULD','EF',1,'Système & réseau > Logiciel >  > Configuration Proxy'),
(30,4,'installation tournament director',1,1,'COULD','EF',1,'Système & réseau > Logiciel >  > installation tournament director'),
(31,4,'Configuration DHCP',1,4,'WOULD','EF',1,'Système & réseau > Logiciel >  > Configuration DHCP'),
(32,4,'Configuration AD',1,2,'WOULD','EF',1,'Système & réseau > Logiciel >  > Configuration AD'),
(33,4,'Création compte Groupe et OU dans AD',1,3,'WOULD','EF',1,'Système & réseau > Logiciel >  > Création compte Groupe et OU dans AD'),
(34,4,'portail captif',1,3,'WOULD','EF',1,'Système & réseau > Logiciel >  > portail captif'),
(35,4,'installation AD',1,3,'WOULD','EF',1,'Système & réseau > Logiciel >  > installation AD'),
(36,4,'Configuration owncloud avec lien AD',1,3,'WOULD','EF',1,'Système & réseau > Logiciel >  > Configuration owncloud avec lien AD'),
(37,4,'VNC',1,2,'WOULD','EF',1,'Système & réseau > Logiciel >  > VNC'),
(38,4,'authentification portail captif AD',2,10,'WOULD','EF',1,'Système & réseau > Logiciel >  > authentification portail captif AD'),
(39,5,'photo magic day et logo',1,1,'MUST','EF',1,'Développement > front office > affichagephoto magic day et logo'),
(40,5,'association',1,2,'MUST','EF',1,'Développement > front office > affichageassociation'),
(41,5,'lots',1,2,'MUST','EF',1,'Développement > front office > affichagelots'),
(42,5,'inscription + génération TOKEN',1,4,'MUST','EF',1,'Développement > front office > formulaireinscription + génération TOKEN'),
(43,5,'presentation',1,1,'MUST','EF',1,'Développement > front office > affichagepresentation'),
(44,5,'album',1,3,'MUST','EF',1,'Développement > front office > affichagealbum'),
(45,5,'menu',1,2,'SHOULD','EF',1,'Développement > front office > affichagemenu'),
(46,5,'pied de page',1,1,'SHOULD','EF',1,'Développement > front office > affichagepied de page'),
(47,5,'menu',1,1,'COULD','EF',1,'Développement > back office > affichagemenu'),
(48,5,'modifier',1,1,'COULD','EF',1,'Développement > back office > contenumodifier'),
(49,5,'mettre en forme',1,1,'WOULD','EF',1,'Développement > back office > contenumettre en forme'),
(50,5,'lister',1,1,'SHOULD','EF',1,'Développement > back office > photos lister'),
(51,5,'ajouter',1,1,'SHOULD','EF',1,'Développement > back office > photos ajouter'),
(52,5,'supprimer',1,1,'COULD','EF',1,'Développement > back office > photos supprimer'),
(53,5,'activer',1,1,'WOULD','EF',1,'Développement > back office > photos activer'),
(54,5,'lister',1,1,'COULD','EF',1,'Développement > back office > albumlister'),
(55,5,'ajouter',1,1,'COULD','EF',1,'Développement > back office > albumajouter'),
(56,5,'supprimer',1,1,'WOULD','EF',1,'Développement > back office > albumsupprimer'),
(57,5,'activer',1,1,'WOULD','EF',1,'Développement > back office > albumactiver'),
(58,5,'lister',1,1,'COULD','EF',1,'Développement > back office > ateliers  listelister'),
(59,5,'ajouter',1,1,'COULD','EF',1,'Développement > back office > ateliers  listeajouter'),
(60,5,'supprimer',1,1,'WOULD','EF',1,'Développement > back office > ateliers  listesupprimer'),
(61,5,'lister avec filtre par ateliers',1,2,'WOULD','EF',1,'Développement > back office > ateliers scorelister avec filtre par ateliers'),
(62,5,'lister',1,1,'SHOULD','EF',1,'Développement > back office > joueurslister'),
(63,5,'ajouter',1,1,'SHOULD','EF',1,'Développement > back office > joueursajouter'),
(64,5,'supprimer',1,1,'COULD','EF',1,'Développement > back office > joueurssupprimer'),
(65,5,'export',2,1,'WOULD','EF',1,'Développement > back office > joueursexport'),
(66,5,'import',2,2,'WOULD','EF',1,'Développement > back office > joueursimport'),
(67,5,'etiquette',2,3,'WOULD','EF',1,'Développement > back office > joueursetiquette'),
(68,5,'lister',1,1,'SHOULD','EF',1,'Développement > back office > associationlister'),
(69,5,'ajouter',1,1,'SHOULD','EF',1,'Développement > back office > associationajouter'),
(70,5,'supprimer',1,1,'COULD','EF',1,'Développement > back office > associationsupprimer'),
(71,5,'lister',1,1,'SHOULD','EF',1,'Développement > back office > lotslister'),
(72,5,'ajouter',1,1,'SHOULD','EF',1,'Développement > back office > lotsajouter'),
(73,5,'supprimer',1,1,'COULD','EF',1,'Développement > back office > lotssupprimer'),
(74,5,'classement',2,2,'WOULD','EF',1,'Développement > Appli Mobile > jetonsclassement'),
(75,5,'saisie',2,2,'WOULD','EF',1,'Développement > Appli Mobile > jetonssaisie'),
(76,5,'lister pour tous les ateliers',1,3,'WOULD','EF',1,'Développement > Appli Mobile > atelierlister pour tous les ateliers'),
(77,5,'Lister par ateliers',1,3,'WOULD','EF',1,'Développement > Appli Mobile > atelierLister par ateliers'),
(78,5,'ajouter score',1,3,'WOULD','EF',1,'Développement > Appli Mobile > atelierajouter score');

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
('jury', 'Notation', 'Evaluation', '00000000011'),
('jury', 'Notation', 'Ressouces', '00000000001'),
('jury', 'Notation', 'Resultats', '00000000111'),
('jury', 'Projet', 'Planification', '00000000001'),
('membre', 'Notation', 'Resultats', '00000000111'),
('membre', 'Projet', 'Planification', '00000000011'),
('membre', 'Projet', 'Tache', '11111111111');

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_group_grp`
--

INSERT INTO `tm_group_grp` (`pk_grp`, `fk_schl`, `grp_lib`) VALUES
(1, 2, 'les Anonymous'),
(2, 2, 'Les Bras Cassés'),
(3, 2, 'invASIon');

-- --------------------------------------------------------

--
-- Structure de la table `tm_school_schl`
--

CREATE TABLE IF NOT EXISTS `tm_school_schl` (
  `pk_schl` int(2) NOT NULL,
  `schl_lib` varchar(50) NOT NULL,
  `schl_city` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_school_schl`
--

INSERT INTO `tm_school_schl` (`pk_schl`, `schl_lib`, `schl_city`) VALUES
(1, 'ESAIP - Saint Joseph', 'Dijon'),
(2, 'ES Pasteur Mont Roland', 'Dole');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_user_usr`
--

INSERT INTO `tm_user_usr` (`pk_usr`, `fk_grd`, `fk_schl`, `fk_grp`, `usr_role`, `usr_name`, `usr_firstname`, `usr_email`, `usr_pwd`, `usr_account_valid`) VALUES
(1, NULL, 1, NULL, 'admin', 'Dussert', 'Nicolas', 'nicolas.dussert@stjodijon.com', '05a671c66aefea124cc08b76ea6d30bb', 1), -- mdp : testtest
(2, NULL, 2, NULL, 'jury', 'Bailly', 'Olivier', 'o.bailly@glpmr.info', '05a671c66aefea124cc08b76ea6d30bb', 1), -- mdp : testtest
(3, NULL, 1, NULL, 'jury', 'Barbier', 'Marie', 'mariebarbierwork@gmail.com', '05a671c66aefea124cc08b76ea6d30bb', 1), -- mdp : testtest
(4, 4, 2, 3, 'membre', 'Demonchaux', 'Jerome', 'jerome.demonchaux@gmail.com', '08adfb6ad85c3a66b42f69139f3cec80', 1); -- jeyz1990

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tm_task_tsk`
--

INSERT INTO `tm_task_tsk` (`pk_tsk`, `fk_usr`, `fk_itm`, `tsk_lib`, `tsk_comment`, `tsk_start_hour_plan`, `tsk_end_hour_plan`, `tsk_start_hour_real`, `tsk_end_hour_real`, `tsk_state`, `tsk_is_np`) VALUES
(1, 4, 1, 'faire item 1', NULL, '2015-12-12 07:25:00', '2015-12-12 07:55:00', NULL, NULL, NULL, 0),
(2, 4, 1, 'faire item 1 bis', NULL, '2015-12-12 08:25:00', '2015-12-12 08:55:00', NULL, NULL, NULL, 0),
(3, 4, 2, 'faire item 2', NULL, '2015-12-12 07:00:00', '2015-12-12 07:25:00', '2015-12-12 07:00:00', '2015-12-12 07:30:00', NULL, 0),
(4, 4, 3, 'faire item 3', NULL, '2015-12-12 07:00:00', '2015-12-12 07:25:00', '2015-12-12 07:00:00', NULL, NULL, 0);


-- --------------------------------------------------------

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
  ADD PRIMARY KEY (`pk_itm`),
  ADD KEY `fk_REF_ITEM_itm_REF_CATEGORY_CAT1_idx` (`fk_cat`);

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
  ADD PRIMARY KEY (`fk_usr_role`,`fk_page`,`rgt_is_visible`),
  ADD KEY `fk_tj_see_role_page_srp_2` (`fk_page`);

--
-- Index pour la table `tj_teach_tch`
--
ALTER TABLE `tj_teach_tch`
  ADD PRIMARY KEY (`fk_sbj`,`fk_usr`),
  ADD KEY `fk_tj_teach_tch_2` (`fk_usr`);

--
-- Index pour la table `tm_group_grp`
--
ALTER TABLE `tm_group_grp`
  ADD PRIMARY KEY (`pk_grp`),
  ADD KEY `fk_TM_GROUP_GRP_TM_SCHOOL_SCHL1_idx` (`fk_schl`);

--
-- Index pour la table `tm_school_schl`
--
ALTER TABLE `tm_school_schl`
  ADD PRIMARY KEY (`pk_schl`);

--
-- Index pour la table `tm_score_grp_itm_scr`
--
ALTER TABLE `tm_score_grp_itm_scr`
  ADD PRIMARY KEY (`fk_grp`,`fk_itm`),
  ADD KEY `fk_TM_SCORE_GRP_itm_SCR_REF_ITEM_ITM1_idx` (`fk_itm`);

--
-- Index pour la table `tm_task_tsk`
--
ALTER TABLE `tm_task_tsk`
  ADD PRIMARY KEY (`pk_tsk`),
  ADD KEY `fk_itm` (`fk_itm`),
  ADD KEY `tm_task_tsk_ibfk_2` (`fk_usr`);

--
-- Index pour la table `tm_user_usr`
--
ALTER TABLE `tm_user_usr`
  ADD PRIMARY KEY (`pk_usr`),
  ADD UNIQUE KEY `usr_email_UNIQUE` (`usr_email`),
  ADD KEY `fk_TM_USER_usr_TM_SCHOOL_SCHL_idx` (`fk_schl`),
  ADD KEY `fk_TM_USER_usr_TM_GROUP_GRP1_idx` (`fk_grp`),
  ADD KEY `fk_TM_USER_usr_ref_grade_grd1_idx` (`fk_grd`),
  ADD KEY `usr_role` (`usr_role`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ref_category_cat`
--
ALTER TABLE `ref_category_cat`
  MODIFY `pk_cat` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ref_grade_grd`
--
ALTER TABLE `ref_grade_grd`
  MODIFY `pk_grd` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ref_item_itm`
--
ALTER TABLE `ref_item_itm`
  MODIFY `pk_itm` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
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
  MODIFY `pk_grp` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
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
  MODIFY `pk_tsk` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `tm_user_usr`
--
ALTER TABLE `tm_user_usr`
  MODIFY `pk_usr` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
