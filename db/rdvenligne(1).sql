-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 juin 2018 à 16:21
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rdvenligne`
--

-- --------------------------------------------------------

--
-- Structure de la table `day_planning_default`
--

DROP TABLE IF EXISTS `day_planning_default`;
CREATE TABLE IF NOT EXISTS `day_planning_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planning_default_id` int(11) NOT NULL,
  `jourSemaine` int(11) DEFAULT NULL,
  `active_day` tinyint(1) NOT NULL,
  `heureDebut` time DEFAULT NULL,
  `heureFin` time DEFAULT NULL,
  `nbcreneaux` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD24CF35F5E6CA4D` (`planning_default_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `day_planning_default`
--

INSERT INTO `day_planning_default` (`id`, `planning_default_id`, `jourSemaine`, `active_day`, `heureDebut`, `heureFin`, `nbcreneaux`) VALUES
(1, 1, 7, 1, '00:00:00', '00:00:00', 1),
(2, 1, 1, 1, '00:00:00', '00:00:00', 1),
(3, 1, 2, 1, '00:00:00', '00:00:00', 1),
(4, 1, 3, 1, '00:00:00', '00:00:00', 1),
(5, 1, 4, 1, '00:00:00', '00:00:00', 1),
(6, 1, 5, 1, '00:00:00', '00:00:00', 1),
(7, 1, 6, 1, '00:00:00', '00:00:00', 1),
(8, 2, 7, 1, '00:00:00', '00:00:00', 1),
(9, 2, 1, 1, '00:00:00', '00:00:00', 1),
(10, 2, 2, 1, '00:00:00', '00:00:00', 1),
(11, 2, 3, 1, '00:00:00', '00:00:00', 1),
(12, 2, 4, 1, '00:00:00', '00:00:00', 1),
(13, 2, 5, 1, '00:00:00', '00:00:00', 1),
(14, 2, 6, 1, '00:00:00', '00:00:00', 1),
(15, 3, 7, 1, '00:00:00', '00:00:00', 1),
(16, 3, 1, 1, '00:00:00', '00:00:00', 1),
(17, 3, 2, 1, '00:00:00', '00:00:00', 1),
(18, 3, 3, 1, '00:00:00', '00:00:00', 1),
(19, 3, 4, 1, '00:00:00', '00:00:00', 1),
(20, 3, 5, 1, '00:00:00', '00:00:00', 1),
(21, 3, 6, 1, '00:00:00', '00:00:00', 1),
(22, 4, 7, 1, '00:00:00', '00:00:00', 1),
(23, 4, 1, 1, '00:00:00', '00:00:00', 1),
(24, 4, 2, 1, '00:00:00', '00:00:00', 1),
(25, 4, 3, 1, '00:00:00', '00:00:00', 1),
(26, 4, 4, 1, '00:00:00', '00:00:00', 1),
(27, 4, 5, 1, '00:00:00', '00:00:00', 1),
(28, 4, 6, 1, '00:00:00', '00:00:00', 1),
(29, 5, NULL, 1, '00:00:00', '00:00:00', 1),
(30, 5, 1, 1, '00:00:00', '00:00:00', 1),
(31, 5, 2, 1, '00:00:00', '00:00:00', 1),
(32, 5, 3, 1, '00:00:00', '00:00:00', 1),
(33, 5, 4, 1, '00:00:00', '00:00:00', 1),
(34, 5, 5, 1, '00:00:00', '00:00:00', 1),
(35, 5, 6, 1, '00:00:00', '00:00:00', 1),
(36, 6, NULL, 1, '00:00:00', '00:00:00', 1),
(37, 6, 1, 1, '00:00:00', '00:00:00', 1),
(38, 6, 2, 1, '00:00:00', '00:00:00', 1),
(39, 6, 3, 1, '00:00:00', '00:00:00', 1),
(40, 6, 4, 1, '00:00:00', '00:00:00', 1),
(41, 6, 5, 1, '00:00:00', '00:00:00', 1),
(42, 6, 6, 1, '00:00:00', '00:00:00', 1),
(43, 7, 1, 1, '00:00:00', '00:00:00', 1),
(44, 7, 2, 1, '00:00:00', '00:00:00', 1),
(45, 7, 3, 1, '00:00:00', '00:00:00', 1),
(46, 7, 4, 1, '00:00:00', '00:00:00', 1),
(47, 7, 5, 1, '00:00:00', '00:00:00', 1),
(48, 7, 6, 1, '00:00:00', '00:00:00', 1),
(49, 7, 7, 1, '00:00:00', '00:00:00', 1),
(50, 8, 1, 1, '00:00:00', '00:00:00', 1),
(51, 8, 2, 1, '00:00:00', '00:00:00', 1),
(52, 8, 3, 1, '00:00:00', '00:00:00', 1),
(53, 8, 4, 1, '00:00:00', '00:00:00', 1),
(54, 8, 5, 1, '00:00:00', '00:00:00', 1),
(55, 8, 6, 1, '00:00:00', '00:00:00', 1),
(56, 8, 7, 1, '00:00:00', '00:00:00', 1),
(57, 9, 1, 1, '00:00:00', '00:00:00', 1),
(58, 9, 2, 1, '00:00:00', '00:00:00', 1),
(59, 9, 3, 1, '00:00:00', '00:00:00', 1),
(60, 9, 4, 1, '00:00:00', '00:00:00', 1),
(61, 9, 5, 1, '00:00:00', '00:00:00', 1),
(62, 9, 6, 1, '00:00:00', '00:00:00', 1),
(63, 9, 7, 1, '00:00:00', '00:00:00', 1),
(64, 10, 1, 1, '00:00:00', '00:00:00', 1),
(65, 10, 2, 1, '00:00:00', '00:00:00', 1),
(66, 10, 3, 1, '00:00:00', '00:00:00', 1),
(67, 10, 4, 1, '00:00:00', '00:00:00', 1),
(68, 10, 5, 1, '00:00:00', '00:00:00', 1),
(69, 10, 6, 1, '00:00:00', '00:00:00', 1),
(70, 10, 7, 1, '00:00:00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lieu_rdv`
--

DROP TABLE IF EXISTS `lieu_rdv`;
CREATE TABLE IF NOT EXISTS `lieu_rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E9AF4B9DC3B7E4BA` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lieu_rdv`
--

INSERT INTO `lieu_rdv` (`id`, `pro_id`, `nom`, `adresse`, `valide`) VALUES
(1, 2, 'Lieu1', 'Place Esquirol, Toulouse', 1),
(2, 2, 'Lieu2', 'Route de Narbonne, 31330 Toulouse', 1),
(3, 7, 'Cabinet médical', '33 rue marie noël\r\n78180 Montigny le Bretonneux', 1),
(4, 7, 'Hopital Leo Lagrange', '13 rue de Bréhat\r\n78180 Montigny le Bretonneux', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lieu_rdv_type_rdv`
--

DROP TABLE IF EXISTS `lieu_rdv_type_rdv`;
CREATE TABLE IF NOT EXISTS `lieu_rdv_type_rdv` (
  `lieu_rdv_id` int(11) NOT NULL,
  `type_rdv_id` int(11) NOT NULL,
  PRIMARY KEY (`lieu_rdv_id`,`type_rdv_id`),
  KEY `IDX_F3912E18C66EC6CD` (`lieu_rdv_id`),
  KEY `IDX_F3912E186F1954BE` (`type_rdv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lieu_rdv_type_rdv`
--

INSERT INTO `lieu_rdv_type_rdv` (`lieu_rdv_id`, `type_rdv_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(3, 4),
(4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `paragraphe`
--

DROP TABLE IF EXISTS `paragraphe`;
CREATE TABLE IF NOT EXISTS `paragraphe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professionnel_id` int(11) DEFAULT NULL,
  `titre` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateModification` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C1BA9B68A49CC82` (`professionnel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `paragraphe`
--

INSERT INTO `paragraphe` (`id`, `professionnel_id`, `titre`, `text`, `dateCreation`, `dateModification`) VALUES
(1, 2, 'TestTitre1', 'Omitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico. \r\nVictus universis caro ferina est lactisque abundans copia qua sustentantur, et herbae multiplices et siquae alites capi per aucupium possint, et plerosque mos vidimus frumenti usum et vini penitus ignorantes.', '2018-06-05 11:59:40', '2018-06-05 23:01:42'),
(2, 2, 'Titre2', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\nCyprum itidem insulam procul a continenti discretam et portuosam inter municipia crebra urbes duae faciunt claram.\r\n\r\nSalamis et Paphus, altera Iovis delubris altera Veneris templo insignis. tanta autem tamque multiplici fertilitate abundat rerum omnium eadem Cyprus ut nullius externi indigens adminiculi indigenis viribus a fundamento ipso carinae ad supremos usque carbasos aedificet onerariam navem omnibusque armamentis instructam mari committat.\r\nUt enim quisque sibi plurimum confidit et ut quisque maxime virtute et sapientia sic munitus est, ut nullo egeat suaque omnia in se ipso posita iudicet, ita in amicitiis expetendis colendisque maxime excellit. Quid enim? Africanus indigens mei? Minime hercule! ac ne ego quidem illius; sed ego admiratione quadam virtutis eius, ille vicissim opinione fortasse non nulla, quam de meis moribus habebat, me dilexit; auxit benevolentiam consuetudo. Sed quamquam utilitates multae et magnae consecutae sunt, non sunt tamen ab earum spe causae diligendi profectae.\r\nHoc inmaturo interitu ipse quoque sui pertaesus excessit e vita aetatis nono anno atque vicensimo cum quadriennio imperasset. \r\n\r\nNatus apud Tuscos in Massa Veternensi, patre Constantio Constantini fratre imperatoris, matreque Galla sorore Rufini et Cerealis, quos trabeae consulares nobilitarunt et praefecturae.', '2018-06-05 09:00:00', '2018-06-05 23:47:34'),
(3, 7, 'Information sur le cabinet médical', 'Frapper avant d\'entrer, la sonnette ne marche pas\r\n3ème porte à droite dans le couloir du bas\r\nRDC', '2018-06-11 09:48:46', '2018-06-11 09:48:46');

-- --------------------------------------------------------

--
-- Structure de la table `planning_default`
--

DROP TABLE IF EXISTS `planning_default`;
CREATE TABLE IF NOT EXISTS `planning_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3E335D34C3B7E4BA` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `planning_default`
--

INSERT INTO `planning_default` (`id`, `pro_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `creneauxDebut` datetime NOT NULL,
  `creneauxFin` datetime NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10C31F86A76ED395` (`user_id`),
  KEY `IDX_10C31F86C3B7E4BA` (`pro_id`),
  KEY `IDX_10C31F86C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id`, `user_id`, `pro_id`, `type_id`, `creneauxDebut`, `creneauxFin`, `validation`, `statut`) VALUES
(1, 4, 2, 1, '2018-06-05 11:00:00', '2018-06-05 12:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rdv_default`
--

DROP TABLE IF EXISTS `rdv_default`;
CREATE TABLE IF NOT EXISTS `rdv_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) DEFAULT NULL,
  `jourSemaine` int(11) NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `nbCreneaux` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64487A40C3B7E4BA` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_rdv`
--

DROP TABLE IF EXISTS `type_rdv`;
CREATE TABLE IF NOT EXISTS `type_rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `duree` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_12D4F967C3B7E4BA` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type_rdv`
--

INSERT INTO `type_rdv` (`id`, `pro_id`, `type`, `tarif`, `duree`) VALUES
(1, 2, 'TypeRdv1', '51.59', '00:45:00'),
(2, 2, 'TypeRdv2', '34.95', '01:10:00'),
(3, 2, 'TypeRdv3', '24.99', '00:25:00'),
(4, 7, 'Consultation généraliste', '60.00', '00:10:00'),
(5, 7, 'Visite à domicile', '55.00', '00:20:00'),
(6, 7, 'Consultation hopital', '120.00', '00:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `lastname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `firstname` longtext COLLATE utf8_unicode_ci NOT NULL,
  `telephone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `validationAdmin` tinyint(1) NOT NULL,
  `metier` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `lastname`, `firstname`, `telephone`, `dateNaissance`, `validationAdmin`, `metier`) VALUES
(1, 'admin', 'admin', 'admin@rdv.fr', 'admin@rdv.fr', 1, NULL, '$2y$13$vJotbKjUp6qMWQh7PS6ADuSuSgzRMtEf6sqQP8K0U/FOwFok.ZJZC', '2018-06-11 16:16:08', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'Rossi', 'Valentino', '0123456789', '1990-01-01', 1, NULL),
(2, 'pro1', 'pro1', 'pro1@rdv.fr', 'pro1@rdv.fr', 1, NULL, '$2y$13$nKhaKzbi0baXOM.YdqE2m.mR845Dl2d9lXoS8Wb2bapERJho7j4ZC', '2018-06-11 16:16:17', NULL, NULL, 'a:1:{i:0;s:8:\"ROLE_PRO\";}', 'Márquez', 'Marc', '0123456789', '2013-01-01', 1, 'Médecin'),
(3, 'pro2', 'pro2', 'pro2@rdv.fr', 'pro2@rdv.fr', 1, NULL, '$2y$13$BDSlMh37vcpAa8Q1SKHtxe4LEiW9PVv7rn9w5GEsgS16NluDGM/4W', NULL, NULL, NULL, 'a:1:{i:0;s:8:\"ROLE_PRO\";}', 'Lorenzo', 'Jorge', '0123456789', '1966-01-01', 0, NULL),
(4, 'user1', 'user1', 'user1@rdv.fr', 'user1@rdv.fr', 1, NULL, '$2y$13$c4hBdtI7yrxyEwR/v5g48urucXFVkQQ4mETDdBlxkxH/e3bmxBqHO', '2018-06-06 00:05:32', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'Petrucci', 'Danilo ', '0123456789', '1982-01-01', 1, NULL),
(5, 'user2', 'user2', 'user2@rdv.fr', 'user2@rdv.fr', 1, NULL, '$2y$13$1aGtCqqjNBY3x1bp3I48FuEoWgNUu1M9xWD84fo4i3xuQZrpS6Jdu', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'user2', 'user2', '0123456789', '1973-01-01', 1, NULL),
(6, 'user3', 'user3', 'user3@rdv.fr', 'user3@rdv.fr', 1, NULL, '$2y$13$ivzB6u9L7H7tIKIQIaTCJ.quAVpIP6VOmdU55bLfeLZUe5pxfJTH6', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'user3', 'user3', '0123456789', '1954-01-01', 1, NULL),
(7, 'pro3', 'pro3', 'stephane.blusson@msiminsk.com', 'stephane.blusson@msiminsk.com', 1, NULL, '$2y$13$czxi1697LGfH0HsWVuZe1e5croAP8PeXDCpYdTempGJp0HfNDEFYO', '2018-06-11 09:54:30', NULL, NULL, 'a:1:{i:0;s:8:\"ROLE_PRO\";}', 'blusson', 'stephane', '0102030405', '1999-01-01', 0, NULL),
(8, 'client1', 'client1', 'client1@rdv.fr', 'client1@rdv.fr', 1, NULL, '$2y$13$Dmw1ea7l/xNffLIgN3jDSOke8gwU8g8qeWnofiCm2QfHp4q9ir5.O', '2018-06-11 16:20:43', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'client1', 'client1', '123456789', '2002-01-01', 1, NULL),
(9, 'client2', 'client2', 'client2@rdv.fr', 'client2@rdv.fr', 1, NULL, '$2y$13$qBDc5U66NndLgOKikbg70uuULl3ZJG/ijyHqs/cSowZh5gxiWVBxm', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'client2', 'client2', '123456789', '2000-01-01', 1, NULL),
(10, 'client3', 'client3', 'client3@rdv.fr', 'client3@rdv.fr', 1, NULL, '$2y$13$LbFE81Waa1lXMmGopaZGLe4tEnsfBHVzTVaFeDOLwIR7uNXSsX8fe', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'client3', 'client3', '123456789', '2000-01-01', 1, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `day_planning_default`
--
ALTER TABLE `day_planning_default`
  ADD CONSTRAINT `FK_BD24CF35F5E6CA4D` FOREIGN KEY (`planning_default_id`) REFERENCES `planning_default` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lieu_rdv`
--
ALTER TABLE `lieu_rdv`
  ADD CONSTRAINT `FK_E9AF4B9DC3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `lieu_rdv_type_rdv`
--
ALTER TABLE `lieu_rdv_type_rdv`
  ADD CONSTRAINT `FK_F3912E186F1954BE` FOREIGN KEY (`type_rdv_id`) REFERENCES `type_rdv` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F3912E18C66EC6CD` FOREIGN KEY (`lieu_rdv_id`) REFERENCES `lieu_rdv` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paragraphe`
--
ALTER TABLE `paragraphe`
  ADD CONSTRAINT `FK_4C1BA9B68A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `planning_default`
--
ALTER TABLE `planning_default`
  ADD CONSTRAINT `FK_3E335D34C3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `FK_10C31F86A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_10C31F86C3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_10C31F86C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_rdv` (`id`);

--
-- Contraintes pour la table `rdv_default`
--
ALTER TABLE `rdv_default`
  ADD CONSTRAINT `FK_64487A40C3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `type_rdv`
--
ALTER TABLE `type_rdv`
  ADD CONSTRAINT `FK_12D4F967C3B7E4BA` FOREIGN KEY (`pro_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
