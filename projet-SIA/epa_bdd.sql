-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 25 mai 2020 à 08:14
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `epa_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

DROP TABLE IF EXISTS `abonne`;
CREATE TABLE IF NOT EXISTS `abonne` (
  `id_abonne` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(16) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pays_origine` int(11) NOT NULL,
  `date_enreg` datetime NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `sexe` enum('F','M') DEFAULT NULL,
  `profession` varchar(60) DEFAULT NULL,
  `adresse` varchar(256) DEFAULT NULL,
  `centre_interet` mediumtext,
  PRIMARY KEY (`id_abonne`),
  KEY `fk_pays_origine` (`pays_origine`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`id_abonne`, `pseudo`, `mdp`, `email`, `pays_origine`, `date_enreg`, `nom`, `prenom`, `sexe`, `profession`, `adresse`, `centre_interet`) VALUES
(1, 'a1', 'a1', 'a1@a.fr', 75, '2020-04-06 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'a2', 'a2', 'a2@a.fr', 201, '2020-04-08 00:00:00', 'M.', 'Sofian', 'M', 'Professeur', NULL, NULL),
(3, 'a3', 'a3', 'a3@a.fr', 1, '2020-04-08 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'a4', 'a4', 'a4@a.fr', 75, '2020-04-09 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'a5', 'a5', 'a5@a.fr', 201, '2020-04-10 00:00:00', 'P.', 'Lola', 'F', NULL, 'Paris Dauphine', NULL),
(6, 'anonyme', 'motdepasse', 'duc-chinh.p@live.fr', 172, '2020-05-12 13:48:12', 'Pham', 'Duc-Chinh', 'M', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id_theme` int(4) NOT NULL,
  `id_abonne` int(4) DEFAULT NULL,
  `id_mb_bureau` int(4) DEFAULT NULL,
  KEY `fk_id_theme` (`id_theme`),
  KEY `fk_id_abonne` (`id_abonne`),
  KEY `fk_id_mb_bureau` (`id_mb_bureau`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`id_theme`, `id_abonne`, `id_mb_bureau`) VALUES
(1, NULL, 1),
(1, NULL, 1),
(1, NULL, 2),
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, NULL, 5),
(2, 3, NULL),
(2, 4, NULL),
(2, 1, NULL),
(2, 2, NULL),
(3, NULL, 1),
(3, NULL, 2),
(3, 1, NULL),
(3, 2, NULL),
(4, 1, NULL),
(4, 4, NULL),
(2, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `type` enum('pdf','img') NOT NULL,
  `date_ajout` datetime NOT NULL,
  `statut` enum('encours','accepte','refus') NOT NULL DEFAULT 'encours',
  PRIMARY KEY (`id_document`),
  KEY `fk_id_message` (`id_message`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_document`, `id_message`, `type`, `date_ajout`, `statut`) VALUES
(1, 3, 'pdf', '2020-04-23 19:18:27', 'encours'),
(3, 4, 'pdf', '2020-04-24 19:13:47', 'accepte'),
(4, 5, 'img', '2020-04-24 19:17:27', 'accepte'),
(5, 6, 'img', '2020-04-24 19:30:10', 'encours'),
(6, 10, 'img', '2020-05-12 15:57:27', 'accepte');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id_forum` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL COMMENT 'nom du forum',
  `description` mediumtext NOT NULL COMMENT 'description du forum',
  `nb_visites` int(11) NOT NULL COMMENT 'nombre de visites sur le forum',
  `date_maj` datetime NOT NULL COMMENT 'date de la derniere mise à jour',
  PRIMARY KEY (`id_forum`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id_forum`, `nom`, `description`, `nb_visites`, `date_maj`) VALUES
(1, 'Ensemble pour l\'Afrique', 'Forum blablabla a decrire', 0, '2007-04-20 15:09:00');

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

DROP TABLE IF EXISTS `lien`;
CREATE TABLE IF NOT EXISTS `lien` (
  `id_lien` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL COMMENT 'id du message dont le lien se trouve',
  `lien` varchar(256) NOT NULL COMMENT 'lien en question',
  `date_ajout` datetime NOT NULL COMMENT 'date d''ajout du lien',
  `statut` enum('encours','accepte','refuse') NOT NULL DEFAULT 'encours' COMMENT 'statut du lien',
  PRIMARY KEY (`id_lien`),
  KEY `fk_id_message` (`id_message`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lien`
--

INSERT INTO `lien` (`id_lien`, `id_message`, `lien`, `date_ajout`, `statut`) VALUES
(1, 2, 'https://students-francestay.com/fr/familles', '2020-04-23 19:16:58', 'accepte'),
(2, 6, 'https://www.etudiant.gouv.fr/', '2020-04-24 19:30:10', 'encours'),
(3, 9, 'https://fr.wikipedia.org/wiki/Pand%C3%A9mie_de_Covid-19_en_Afrique', '2020-05-12 15:53:53', 'accepte'),
(4, 10, 'https://www.gouvernement.fr/info-coronavirus', '2020-05-12 15:57:27', 'accepte');

-- --------------------------------------------------------

--
-- Structure de la table `membrebureau`
--

DROP TABLE IF EXISTS `membrebureau`;
CREATE TABLE IF NOT EXISTS `membrebureau` (
  `id_mb_bureau` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire identification du moderateur',
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL COMMENT 'email du moderateur',
  `mdp` varchar(60) NOT NULL COMMENT 'mot de passe',
  `moderateur` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mb_bureau`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membrebureau`
--

INSERT INTO `membrebureau` (`id_mb_bureau`, `nom`, `prenom`, `email`, `mdp`, `moderateur`) VALUES
(5, 'K', 'Taoufiq', 'taoufiq@dauphine.eu', 'tao', 1),
(4, 'T', 'Rowann', 'rowann@dauphine.eu', 'rowann', 1),
(3, 'M', 'Marie', 'marie@dauphine.eu', 'marie', 1),
(1, 'O', 'Léa', 'lea@dauphine.eu', 'lea', 1),
(2, 'P', 'Duc-Chinh', 'duc-chinh@dauphine.eu', 'duc', 1),
(6, 'Brunel Lobrichon', 'Geneviève', 'presidente@epa.fr', 'presidente', 1),
(7, 'Goungounga', 'Hélène', 'tresorier@epa.fr', 'tresorier', 0),
(8, 'Atangana', 'Symphorien', 'accueiletudiant@epa.fr', 'accueiletudiant', 0),
(9, 'Chan', 'Louise', 'secretaire@epa.fr', 'secretaire', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_abonne` int(11) DEFAULT NULL COMMENT 'id de l''abonne auteur du message , null si c''est le moderateur',
  `id_mb_bureau` int(11) DEFAULT NULL COMMENT 'null si c''est abonne',
  `id_sujet` int(11) NOT NULL COMMENT 'id du sujet dans lequel le message se trouve',
  `description` mediumtext NOT NULL COMMENT 'le message',
  `date_ajout` datetime NOT NULL COMMENT 'date d''ajout du message',
  `date_maj` datetime NOT NULL COMMENT 'date de modification du message',
  PRIMARY KEY (`id_message`),
  KEY `fk_id_abonne` (`id_abonne`),
  KEY `fk_id_sujet` (`id_sujet`),
  KEY `fk_id_mb_bureau` (`id_mb_bureau`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_abonne`, `id_mb_bureau`, `id_sujet`, `description`, `date_ajout`, `date_maj`) VALUES
(1, 1, NULL, 3, 'Bonjour je souhaiterais avoir un peu plus de détail sur comment bien intégré un étudiant étranger venant en france ?', '2020-04-21 00:00:00', '2020-04-21 00:00:00'),
(2, NULL, 1, 3, 'Bonjour a1 vous pouvez retrouver des information sur ce lien :', '2020-04-23 19:16:58', '2020-04-23 19:16:58'),
(3, 2, NULL, 3, 'Bonjour voici un document qui pourrait être utile', '2020-04-23 19:18:27', '2020-04-23 19:18:27'),
(4, NULL, 1, 1, 'Voici un document qui pourra être utile à certains. Le document regroupe les différents lieux de formations à la langue Française sur Paris.', '2020-04-24 19:13:47', '2020-04-24 19:13:47'),
(5, 3, NULL, 1, 'Merci pour ce document, pour ma part cela a été très utile !', '2020-04-24 19:17:27', '2020-04-24 19:17:48'),
(6, 1, NULL, 10, 'Bonjour, est-ce que l\'un d\'entre vous sait si on peut obtenir d\'autre aide que celle qui est proposé dans le lien suivant: \r<br>\r<br>Merci.', '2020-04-24 19:30:10', '2020-04-24 19:30:10'),
(7, 1, NULL, 2, 'Bonjour à tous <b> !!!</b>', '2020-04-28 15:42:49', '2020-04-28 15:42:49'),
(8, 4, NULL, 9, 'Bonjour je souhaiterais avoir des informations concernant les <b> stages</b> en France. Merci', '2020-04-28 15:46:47', '2020-04-28 15:46:47'),
(9, 6, NULL, 11, 'Voici Voici la situation actuelle en Afrique.', '2020-05-12 15:53:53', '2020-05-12 15:56:15'),
(10, NULL, 1, 11, 'Merci . Information sur le coronavirus', '2020-05-12 15:57:27', '2020-05-12 15:57:27');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `nom_fr` varchar(45) NOT NULL COMMENT 'nom en francais',
  `nom_en` varchar(45) NOT NULL COMMENT 'nom en anglais',
  PRIMARY KEY (`id_pays`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `code`, `alpha2`, `alpha3`, `nom_fr`, `nom_en`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albanie', 'Albania'),
(3, 10, 'AQ', 'ATA', 'Antarctique', 'Antarctica'),
(4, 12, 'DZ', 'DZA', 'Algérie', 'Algeria'),
(5, 16, 'AS', 'ASM', 'Samoa Américaines', 'American Samoa'),
(6, 20, 'AD', 'AND', 'Andorre', 'Andorra'),
(7, 24, 'AO', 'AGO', 'Angola', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua-et-Barbuda', 'Antigua and Barbuda'),
(9, 31, 'AZ', 'AZE', 'Azerbaïdjan', 'Azerbaijan'),
(10, 32, 'AR', 'ARG', 'Argentine', 'Argentina'),
(11, 36, 'AU', 'AUS', 'Australie', 'Australia'),
(12, 40, 'AT', 'AUT', 'Autriche', 'Austria'),
(13, 44, 'BS', 'BHS', 'Bahamas', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'Bahreïn', 'Bahrain'),
(15, 50, 'BD', 'BGD', 'Bangladesh', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'Arménie', 'Armenia'),
(17, 52, 'BB', 'BRB', 'Barbade', 'Barbados'),
(18, 56, 'BE', 'BEL', 'Belgique', 'Belgium'),
(19, 60, 'BM', 'BMU', 'Bermudes', 'Bermuda'),
(20, 64, 'BT', 'BTN', 'Bhoutan', 'Bhutan'),
(21, 68, 'BO', 'BOL', 'Bolivie', 'Bolivia'),
(22, 70, 'BA', 'BIH', 'Bosnie-Herzégovine', 'Bosnia and Herzegovina'),
(23, 72, 'BW', 'BWA', 'Botswana', 'Botswana'),
(24, 74, 'BV', 'BVT', 'Île Bouvet', 'Bouvet Island'),
(25, 76, 'BR', 'BRA', 'Brésil', 'Brazil'),
(26, 84, 'BZ', 'BLZ', 'Belize', 'Belize'),
(27, 86, 'IO', 'IOT', 'Territoire Britannique de l\'Océan Indien', 'British Indian Ocean Territory'),
(28, 90, 'SB', 'SLB', 'Îles Salomon', 'Solomon Islands'),
(29, 92, 'VG', 'VGB', 'Îles Vierges Britanniques', 'British Virgin Islands'),
(30, 96, 'BN', 'BRN', 'Brunéi Darussalam', 'Brunei Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgarie', 'Bulgaria'),
(32, 104, 'MM', 'MMR', 'Myanmar', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi', 'Burundi'),
(34, 112, 'BY', 'BLR', 'Bélarus', 'Belarus'),
(35, 116, 'KH', 'KHM', 'Cambodge', 'Cambodia'),
(36, 120, 'CM', 'CMR', 'Cameroun', 'Cameroon'),
(37, 124, 'CA', 'CAN', 'Canada', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cap-vert', 'Cape Verde'),
(39, 136, 'KY', 'CYM', 'Îles Caïmanes', 'Cayman Islands'),
(40, 140, 'CF', 'CAF', 'République Centrafricaine', 'Central African'),
(41, 144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Tchad', 'Chad'),
(43, 152, 'CL', 'CHL', 'Chili', 'Chile'),
(44, 156, 'CN', 'CHN', 'Chine', 'China'),
(45, 158, 'TW', 'TWN', 'Taïwan', 'Taiwan'),
(46, 162, 'CX', 'CXR', 'Île Christmas', 'Christmas Island'),
(47, 166, 'CC', 'CCK', 'Îles Cocos (Keeling)', 'Cocos (Keeling) Islands'),
(48, 170, 'CO', 'COL', 'Colombie', 'Colombia'),
(49, 174, 'KM', 'COM', 'Comores', 'Comoros'),
(50, 175, 'YT', 'MYT', 'Mayotte', 'Mayotte'),
(51, 178, 'CG', 'COG', 'République du Congo', 'Republic of the Congo'),
(52, 180, 'CD', 'COD', 'République Démocratique du Congo', 'The Democratic Republic Of The Congo'),
(53, 184, 'CK', 'COK', 'Îles Cook', 'Cook Islands'),
(54, 188, 'CR', 'CRI', 'Costa Rica', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatie', 'Croatia'),
(56, 192, 'CU', 'CUB', 'Cuba', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Chypre', 'Cyprus'),
(58, 203, 'CZ', 'CZE', 'République Tchèque', 'Czech Republic'),
(59, 204, 'BJ', 'BEN', 'Bénin', 'Benin'),
(60, 208, 'DK', 'DNK', 'Danemark', 'Denmark'),
(61, 212, 'DM', 'DMA', 'Dominique', 'Dominica'),
(62, 214, 'DO', 'DOM', 'République Dominicaine', 'Dominican Republic'),
(63, 218, 'EC', 'ECU', 'Équateur', 'Ecuador'),
(64, 222, 'SV', 'SLV', 'El Salvador', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'Guinée Équatoriale', 'Equatorial Guinea'),
(66, 231, 'ET', 'ETH', 'Éthiopie', 'Ethiopia'),
(67, 232, 'ER', 'ERI', 'Érythrée', 'Eritrea'),
(68, 233, 'EE', 'EST', 'Estonie', 'Estonia'),
(69, 234, 'FO', 'FRO', 'Îles Féroé', 'Faroe Islands'),
(70, 238, 'FK', 'FLK', 'Îles (malvinas) Falkland', 'Falkland Islands'),
(71, 239, 'GS', 'SGS', 'Géorgie du Sud et les Îles Sandwich du Sud', 'South Georgia and the South Sandwich Islands'),
(72, 242, 'FJ', 'FJI', 'Fidji', 'Fiji'),
(73, 246, 'FI', 'FIN', 'Finlande', 'Finland'),
(74, 248, 'AX', 'ALA', 'Îles Åland', 'Åland Islands'),
(75, 250, 'FR', 'FRA', 'France', 'France'),
(76, 254, 'GF', 'GUF', 'Guyane Française', 'French Guiana'),
(77, 258, 'PF', 'PYF', 'Polynésie Française', 'French Polynesia'),
(78, 260, 'TF', 'ATF', 'Terres Australes Françaises', 'French Southern Territories'),
(79, 262, 'DJ', 'DJI', 'Djibouti', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon', 'Gabon'),
(81, 268, 'GE', 'GEO', 'Géorgie', 'Georgia'),
(82, 270, 'GM', 'GMB', 'Gambie', 'Gambia'),
(83, 275, 'PS', 'PSE', 'Territoire Palestinien Occupé', 'Occupied Palestinian Territory'),
(84, 276, 'DE', 'DEU', 'Allemagne', 'Germany'),
(85, 288, 'GH', 'GHA', 'Ghana', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'Grèce', 'Greece'),
(89, 304, 'GL', 'GRL', 'Groenland', 'Greenland'),
(90, 308, 'GD', 'GRD', 'Grenade', 'Grenada'),
(91, 312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'Guinée', 'Guinea'),
(95, 328, 'GY', 'GUY', 'Guyana', 'Guyana'),
(96, 332, 'HT', 'HTI', 'Haïti', 'Haiti'),
(97, 334, 'HM', 'HMD', 'Îles Heard et Mcdonald', 'Heard Island and McDonald Islands'),
(98, 336, 'VA', 'VAT', 'Saint-Siège (état de la Cité du Vatican)', 'Vatican City State'),
(99, 340, 'HN', 'HND', 'Honduras', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong-Kong', 'Hong Kong'),
(101, 348, 'HU', 'HUN', 'Hongrie', 'Hungary'),
(102, 352, 'IS', 'ISL', 'Islande', 'Iceland'),
(103, 356, 'IN', 'IND', 'Inde', 'India'),
(104, 360, 'ID', 'IDN', 'Indonésie', 'Indonesia'),
(105, 364, 'IR', 'IRN', 'République Islamique d\'Iran', 'Islamic Republic of Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Irlande', 'Ireland'),
(108, 376, 'IL', 'ISR', 'Israël', 'Israel'),
(109, 380, 'IT', 'ITA', 'Italie', 'Italy'),
(110, 384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'Jamaïque', 'Jamaica'),
(112, 392, 'JP', 'JPN', 'Japon', 'Japan'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordanie', 'Jordan'),
(115, 404, 'KE', 'KEN', 'Kenya', 'Kenya'),
(116, 408, 'KP', 'PRK', 'République Populaire Démocratique de Corée', 'Democratic People\'s Republic of Korea'),
(117, 410, 'KR', 'KOR', 'République de Corée', 'Republic of Korea'),
(118, 414, 'KW', 'KWT', 'Koweït', 'Kuwait'),
(119, 417, 'KG', 'KGZ', 'Kirghizistan', 'Kyrgyzstan'),
(120, 418, 'LA', 'LAO', 'République Démocratique Populaire Lao', 'Lao People\'s Democratic Republic'),
(121, 422, 'LB', 'LBN', 'Liban', 'Lebanon'),
(122, 426, 'LS', 'LSO', 'Lesotho', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Lettonie', 'Latvia'),
(124, 430, 'LR', 'LBR', 'Libéria', 'Liberia'),
(125, 434, 'LY', 'LBY', 'Jamahiriya Arabe Libyenne', 'Libyan Arab Jamahiriya'),
(126, 438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lituanie', 'Lithuania'),
(128, 442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaisie', 'Malaysia'),
(133, 462, 'MV', 'MDV', 'Maldives', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malte', 'Malta'),
(136, 474, 'MQ', 'MTQ', 'Martinique', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritanie', 'Mauritania'),
(138, 480, 'MU', 'MUS', 'Maurice', 'Mauritius'),
(139, 484, 'MX', 'MEX', 'Mexique', 'Mexico'),
(140, 492, 'MC', 'MCO', 'Monaco', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolie', 'Mongolia'),
(142, 498, 'MD', 'MDA', 'République de Moldova', 'Republic of Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Maroc', 'Morocco'),
(145, 508, 'MZ', 'MOZ', 'Mozambique', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibie', 'Namibia'),
(148, 520, 'NR', 'NRU', 'Nauru', 'Nauru'),
(149, 524, 'NP', 'NPL', 'Népal', 'Nepal'),
(150, 528, 'NL', 'NLD', 'Pays-Bas', 'Netherlands'),
(151, 530, 'AN', 'ANT', 'Antilles Néerlandaises', 'Netherlands Antilles'),
(152, 533, 'AW', 'ABW', 'Aruba', 'Aruba'),
(153, 540, 'NC', 'NCL', 'Nouvelle-Calédonie', 'New Caledonia'),
(154, 548, 'VU', 'VUT', 'Vanuatu', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'Nouvelle-Zélande', 'New Zealand'),
(156, 558, 'NI', 'NIC', 'Nicaragua', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger', 'Niger'),
(158, 566, 'NG', 'NGA', 'Nigéria', 'Nigeria'),
(159, 570, 'NU', 'NIU', 'Niué', 'Niue'),
(160, 574, 'NF', 'NFK', 'Île Norfolk', 'Norfolk Island'),
(161, 578, 'NO', 'NOR', 'Norvège', 'Norway'),
(162, 580, 'MP', 'MNP', 'Îles Mariannes du Nord', 'Northern Mariana Islands'),
(163, 581, 'UM', 'UMI', 'Îles Mineures Éloignées des États-Unis', 'United States Minor Outlying Islands'),
(164, 583, 'FM', 'FSM', 'États Fédérés de Micronésie', 'Federated States of Micronesia'),
(165, 584, 'MH', 'MHL', 'Îles Marshall', 'Marshall Islands'),
(166, 585, 'PW', 'PLW', 'Palaos', 'Palau'),
(167, 586, 'PK', 'PAK', 'Pakistan', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papouasie-Nouvelle-Guinée', 'Papua New Guinea'),
(170, 600, 'PY', 'PRY', 'Paraguay', 'Paraguay'),
(171, 604, 'PE', 'PER', 'Pérou', 'Peru'),
(172, 608, 'PH', 'PHL', 'Philippines', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Pologne', 'Poland'),
(175, 620, 'PT', 'PRT', 'Portugal', 'Portugal'),
(176, 624, 'GW', 'GNB', 'Guinée-Bissau', 'Guinea-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Porto Rico', 'Puerto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar', 'Qatar'),
(180, 638, 'RE', 'REU', 'Réunion', 'Réunion'),
(181, 642, 'RO', 'ROU', 'Roumanie', 'Romania'),
(182, 643, 'RU', 'RUS', 'Fédération de Russie', 'Russian Federation'),
(183, 646, 'RW', 'RWA', 'Rwanda', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Sainte-Hélène', 'Saint Helena'),
(185, 659, 'KN', 'KNA', 'Saint-Kitts-et-Nevis', 'Saint Kitts and Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Sainte-Lucie', 'Saint Lucia'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre-et-Miquelon', 'Saint-Pierre and Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint-Vincent-et-les Grenadines', 'Saint Vincent and the Grenadines'),
(190, 674, 'SM', 'SMR', 'Saint-Marin', 'San Marino'),
(191, 678, 'ST', 'STP', 'Sao Tomé-et-Principe', 'Sao Tome and Principe'),
(192, 682, 'SA', 'SAU', 'Arabie Saoudite', 'Saudi Arabia'),
(193, 686, 'SN', 'SEN', 'Sénégal', 'Senegal'),
(194, 690, 'SC', 'SYC', 'Seychelles', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapour', 'Singapore'),
(197, 703, 'SK', 'SVK', 'Slovaquie', 'Slovakia'),
(198, 704, 'VN', 'VNM', 'Viet Nam', 'Vietnam'),
(199, 705, 'SI', 'SVN', 'Slovénie', 'Slovenia'),
(200, 706, 'SO', 'SOM', 'Somalie', 'Somalia'),
(201, 710, 'ZA', 'ZAF', 'Afrique du Sud', 'South Africa'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Espagne', 'Spain'),
(204, 732, 'EH', 'ESH', 'Sahara Occidental', 'Western Sahara'),
(205, 736, 'SD', 'SDN', 'Soudan', 'Sudan'),
(206, 740, 'SR', 'SUR', 'Suriname', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard etÎle Jan Mayen', 'Svalbard and Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'Suède', 'Sweden'),
(210, 756, 'CH', 'CHE', 'Suisse', 'Switzerland'),
(211, 760, 'SY', 'SYR', 'République Arabe Syrienne', 'Syrian Arab Republic'),
(212, 762, 'TJ', 'TJK', 'Tadjikistan', 'Tajikistan'),
(213, 764, 'TH', 'THA', 'Thaïlande', 'Thailand'),
(214, 768, 'TG', 'TGO', 'Togo', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga', 'Tonga'),
(217, 780, 'TT', 'TTO', 'Trinité-et-Tobago', 'Trinidad and Tobago'),
(218, 784, 'AE', 'ARE', 'Émirats Arabes Unis', 'United Arab Emirates'),
(219, 788, 'TN', 'TUN', 'Tunisie', 'Tunisia'),
(220, 792, 'TR', 'TUR', 'Turquie', 'Turkey'),
(221, 795, 'TM', 'TKM', 'Turkménistan', 'Turkmenistan'),
(222, 796, 'TC', 'TCA', 'Îles Turks et Caïques', 'Turks and Caicos Islands'),
(223, 798, 'TV', 'TUV', 'Tuvalu', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Ouganda', 'Uganda'),
(225, 804, 'UA', 'UKR', 'Ukraine', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'L\'ex-République Yougoslave de Macédoine', 'The Former Yugoslav Republic of Macedonia'),
(227, 818, 'EG', 'EGY', 'Égypte', 'Egypt'),
(228, 826, 'GB', 'GBR', 'Royaume-Uni', 'United Kingdom'),
(229, 833, 'IM', 'IMN', 'Île de Man', 'Isle of Man'),
(230, 834, 'TZ', 'TZA', 'République-Unie de Tanzanie', 'United Republic Of Tanzania'),
(231, 840, 'US', 'USA', 'États-Unis', 'United States'),
(232, 850, 'VI', 'VIR', 'Îles Vierges des États-Unis', 'U.S. Virgin Islands'),
(233, 854, 'BF', 'BFA', 'Burkina Faso', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'Ouzbékistan', 'Uzbekistan'),
(236, 862, 'VE', 'VEN', 'Venezuela', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis et Futuna', 'Wallis and Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa', 'Samoa'),
(239, 887, 'YE', 'YEM', 'Yémen', 'Yemen'),
(240, 891, 'CS', 'SCG', 'Serbie-et-Monténégro', 'Serbia and Montenegro'),
(241, 894, 'ZM', 'ZMB', 'Zambie', 'Zambia');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_message` int(4) NOT NULL COMMENT 'id du message ',
  `id_reponse` int(4) NOT NULL COMMENT 'id du message réponse ',
  PRIMARY KEY (`id_message`,`id_reponse`),
  KEY `I_FK_REL_7_id_message` (`id_message`),
  KEY `I_FK_REL_7_id_reponse` (`id_message`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_message`, `id_reponse`) VALUES
(1, 2),
(4, 5),
(9, 10);

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire identification du sujet',
  `id_abonne` int(11) DEFAULT NULL COMMENT 'auteur du sujet : id_abonne sinon null pour un moderateur',
  `id_mb_bureau` int(11) DEFAULT NULL COMMENT 'null si c''est abonne',
  `id_theme` int(11) NOT NULL COMMENT 'Clé secondaire de l''appartenant à un thème',
  `nom` varchar(256) NOT NULL,
  `date_ajout` datetime NOT NULL COMMENT 'date d''ajout du sujet',
  `date_maj` datetime NOT NULL COMMENT 'date de la dernière modification',
  PRIMARY KEY (`id_sujet`),
  KEY `fk_id_theme` (`id_theme`),
  KEY `fk_id_abonne` (`id_abonne`),
  KEY `fk_id_mb_bureau` (`id_mb_bureau`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id_sujet`, `id_abonne`, `id_mb_bureau`, `id_theme`, `nom`, `date_ajout`, `date_maj`) VALUES
(1, NULL, 1, 1, 'Langues et approche pour les étudiants', '2020-04-11 00:00:00', '2020-04-11 00:00:00'),
(2, NULL, 1, 1, 'Questionnement pour les étudiants africains', '2020-04-11 13:00:00', '2020-04-11 13:00:00'),
(3, NULL, 1, 1, 'Conditions sur la venues des étudiants', '2020-04-11 13:00:00', '2020-04-11 13:00:00'),
(4, 1, NULL, 1, 'Relations entre étudiants étranger et français', '2020-04-12 07:23:00', '2020-04-12 07:23:00'),
(5, NULL, 2, 2, 'Informations sécurité des étudiants', '2020-04-12 00:00:00', '2020-04-13 00:00:00'),
(6, 2, NULL, 2, 'En cas d\'urgence qui prévenir ?', '2020-04-12 15:00:15', '2020-04-12 15:00:15'),
(7, NULL, 3, 3, 'Les enfants d\'Afrique', '2020-04-21 00:00:00', '2020-04-21 00:00:00'),
(8, 3, NULL, 3, 'Education au sein des universités', '2020-04-21 00:00:00', '2020-04-21 00:00:00'),
(9, NULL, 5, 3, 'Stages et jobs', '2020-04-18 00:00:00', '2020-04-18 00:00:00'),
(10, 3, NULL, 4, 'Aide solidaire en france', '2020-04-13 00:00:00', '2020-04-13 00:00:00'),
(11, 6, NULL, 2, 'Cas du Coronavirus en Afrique', '2020-05-12 15:51:51', '2020-05-12 15:51:51');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire identification du theme',
  `nom` varchar(100) NOT NULL COMMENT 'nom du theme',
  `description` mediumtext NOT NULL COMMENT 'description du thème',
  `date_ajout` datetime NOT NULL COMMENT 'date d''ajout du thème',
  `date_maj` datetime NOT NULL COMMENT 'date de la dernière modification',
  PRIMARY KEY (`id_theme`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `nom`, `description`, `date_ajout`, `date_maj`) VALUES
(1, 'Accueil des étudiants en France', 'L\'arrivée d\'étudiants internationaux en France peut être compliquée. Entre choque culturel, difficulté à parler le français et complexité de notre système d\'enseignement supérieur, l\'arrivée en France n\'est pas toujours simple. Afin de faciliter votre venu vous pouvez retrouver toutes les informations dans ce thème et y poser toutes vos questions.', '2020-04-10 19:25:00', '2020-04-10 19:25:00'),
(2, 'Santé et mutuelle', 'Centres de santé, de vaccination, de protection maternelle et infantile, hôpitaux, pharmacies de garde…En matière de santé, Paris dispose de nombreux lieux et équipements. Retrouvez toutes ces informations pratiques et toutes les actions initiées par la Ville.', '2020-04-10 19:26:00', '2020-04-10 19:26:00'),
(3, 'Education', 'Retrouvez toutes les informations concernant la vie scolaire et de la vie étudiante en France et notamment à Paris. ', '2020-04-10 19:26:00', '2020-04-10 19:26:00'),
(4, 'Action sociale et solidarité', 'Vous pouvez retrouver toutes les informations concernant des actions sociales et culturelles visant à améliorer le bien-être et l’épanouissement des personnes dans le besoin. L\'Association vise notamment à apporter son aide aux populations des zones rurales et périurbaines, où l’accès aux soins et aux structures sanitaires est difficile du fait de l’éloignement, l’inadéquation ou simplement l’absence de ces structures; du fait également du faible niveau d\'instruction ou le manque d\'information et d\'éducation. ', '2020-04-10 19:25:00', '2020-04-10 19:25:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
