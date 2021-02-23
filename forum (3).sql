-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 fév. 2021 à 11:44
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_sujet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `date`, `id_utilisateur`, `id_sujet`) VALUES
(99, 'De mÃªme, lâ€™Utilisateur sâ€™engage Ã  ne pas diffuser de correspondances privÃ©es et Ã  porter une attention particuliÃ¨re Ã  la protection des mineurs, il sâ€™engage Ã  ne pas crÃ©er, diffuser, stocker, ou laisser diffuser, de contenus pornographiques ou pÃ©do-pornographiques sur les forums.\r\n\r\nEnfin, lâ€™Utilisateur sâ€™engage Ã  respecter les rÃ¨gles en vigueur en matiÃ¨re de propriÃ©tÃ© intellectuelle, et de droit dâ€™auteur', '2021-02-22 13:16:00', 17, 26),
(96, 'Avant de poster un message, vÃ©rifiez d\'abord si l\'on n\'a pas dÃ©jÃ  rÃ©pondu Ã  votre question sur un autre sujet, ou si le sujet n\'a pas dÃ©jÃ  Ã©tÃ© abordÃ©. Les majuscules sur les forums sont considÃ©rÃ©es comme un cri, ou un signe d\'Ã©nervement. Donc mÃªme si vous pensez que Ã§a rendra votre sujet plus visible, Ã©vitez les majuscules.Essayez de formuler vos posts en franÃ§ais correct de maniÃ¨re Ã  vous faire comprendre du plus grand nombre. Sachez que les posts en SMS ont de grandes chances d\'Ãªtre mal accueillis et d\'Ãªtre effacÃ©s.', '2021-02-19 14:48:25', 17, 27),
(97, 'Bonjour,\r\n\r\nJe serai absent du site du [21/02/2021] au [04/03/2021] inclus.\r\n\r\nN\'ayant pas accÃ¨s au site pendant cette pÃ©riode, je prendrai connaissance de votre message Ã  mon retour.\r\n\r\nEn cas d\'urgence, vous pouvez me contacter Ã  cette adresse : [louni.s@hotmail.com].\r\n\r\nCordialement,\r\n\r\n\r\nPour toute absence veuillez le signaler ici afin de prendre les dispostion nÃ©cessaire pour vous remplacer en tant qu\'admin.', '2021-02-19 14:56:11', 17, 28),
(100, 'Bonjours j\'aimerai savoir quand aura lieu le nouveau stock de ps5 et sur quel site ?? ', '2021-02-22 13:17:06', 1, 29),
(101, 'J\'ai le mÃªme problÃ¨me depuis 2 mois ', '2021-02-22 13:18:12', 23, 31),
(103, 'Pour avoir accÃ¨s a l\'ensemble du forum, rien du plus simple.  Il vous suffit de crÃ©er un compte', '2021-02-22 14:18:37', 17, 32),
(105, 'Bonjour je cherche des joueurs actif pour jouer sur ps5', '2021-02-23 11:42:49', 23, 33);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation` text NOT NULL,
  `date` datetime NOT NULL,
  `id_sujet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `id_commentaire` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `like`, `dislike`, `id_commentaire`, `id_utilisateur`) VALUES
(13, 0, 1, 40, 18),
(35, 1, 0, 40, 1),
(65, 1, 0, 45, 17),
(131, 1, 0, 48, 1),
(123, 1, 0, 46, 1),
(124, 0, 1, 47, 1),
(133, 0, 1, 53, 17),
(135, 0, 1, 54, 17),
(136, 1, 0, 55, 17),
(137, 1, 0, 57, 17),
(145, 0, 1, 58, 1),
(144, 1, 0, 59, 1),
(147, 0, 1, 58, 22),
(148, 1, 0, 69, 17),
(149, 1, 0, 96, 17),
(150, 1, 0, 97, 17),
(154, 1, 0, 100, 1),
(155, 1, 0, 101, 23),
(156, 1, 0, 103, 17),
(157, 1, 0, 100, 23),
(159, 0, 1, 104, 17),
(160, 1, 0, 105, 23);

-- --------------------------------------------------------

--
-- Structure de la table `sujets`
--

DROP TABLE IF EXISTS `sujets`;
CREATE TABLE IF NOT EXISTS `sujets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` text CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sujets`
--

INSERT INTO `sujets` (`id`, `sujet`, `date`, `id_utilisateur`, `id_topic`) VALUES
(31, 'Impossible de connecter mon compte PSN sur PS3', '2021-02-19 14:59:48', 17, 50),
(30, 'Ma PS4 bug, solutions ? ', '2021-02-19 14:58:57', 17, 51),
(29, 'A quand de nouveaux stock de consoles ? ', '2021-02-19 14:58:43', 17, 52),
(28, 'Absence et remplacement ', '2021-02-19 14:54:16', 17, 18627),
(27, 'Quelques rÃ¨gles de savoir-vivre', '2021-02-19 14:46:04', 17, 18628),
(26, 'Protection des mineurs', '2021-02-19 14:45:43', 17, 18628),
(25, 'Test de sujet', '2021-02-19 14:40:36', 17, 49),
(32, 'Avoir accÃ¨s au forum ', '2021-02-22 14:17:42', 17, 18628),
(33, 'Recherche joueur ps5', '2021-02-23 11:42:37', 23, 52);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `date`) VALUES
(52, 'PS5', '2021-02-19'),
(51, 'PS4', '2021-02-19'),
(50, 'PS3', '2021-02-19');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_droit` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `nom` text NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `id_droit`, `login`, `nom`, `password`) VALUES
(1, 2, 'Karim', 'Mazaoui', '$2y$10$DuGxAIjRpW.6d739ZFpLVukSlvueb/NxXLD5c9dpyvV6esRxD3WlW'),
(17, 3, 'Mehdi', 'Lamaf', '$2y$10$aSjNdxLHpei6inr/pypTI.IVhfFE5JdL28SFPAiFFsAgMl1zDB6tq'),
(16, 2, 'Samir', 'Louni', '$2y$10$xwxF8XsCdPrqal5MU/VHw.FIO2c2uqujL00iCOTiw4f/0uED4xN4C'),
(15, 1, 'Nadir', 'Ziane', '$2y$10$y6okni0qehue64qhWc/MceWCZBCz/gG8MbJTjp/Sr4tkdU8GtEcWq'),
(14, 1, 'Yanis', 'Tamj', '$2y$10$czxFiK7eTP1vCjAeXEiZN.hGwcYZta9tp8kyU76kZqKL71Av9EZ8G'),
(23, 1, 'YanisYZ', 'Yanis', '$2y$10$SH3ImEjdU8xU8/I2YvRfj.iEq1K7/3w8C7BpdLqNFLHLcJJWS.EaG'),
(22, 1, 'Julien', 'Marice', '$2y$10$Y2.TdbhvE1KUIlIrQQTibORaRlsTifWSobT11SPUkgODcqLVPbczO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
