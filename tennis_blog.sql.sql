-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 23 mars 2021 à 16:07
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tennis_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_membre` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign2` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date_creation`, `id_membre`) VALUES
(1, 'Mr Azaria', 'lkjhgfredza', '2021-03-13 01:03:49', 1),
(2, 'Mr Azaria', 'lkjhgfredza', '2021-03-13 01:03:32', 1),
(3, 'C\'est qui le patron??', 'Aucun doute sur le sujet, le patron c\'est MOI', '2021-03-13 06:03:09', 3),
(4, 'Essai', 'Bonjour à tous, je me permet ce message pour dire à quel point je suis heureux de m\'être inscris sur ce blog qui me semble de toute beauté, très fonctionnel et surtout remplie de superbes articles et commentaires. Un sourire &quot;niais&quot; illumine mon visage. Encore merci à toutes et à tous et surtout à très bientôt pour échanger sur le tennis. ', '2021-03-22 08:03:40', 1),
(5, 'Retour des beaux jours', 'Avec le retour des beaux jours c\'est le jeu en extérieur qui revient et avec lui la joie de pouvoir pratiquer notre sport préféré tout en profitant du bien fait de l\'air (ce qui est recommandé par les spécialistes en cette période de coronavirus), et du somptueux décors qui nous entoure. Donc excellent plaisir à tous.\r\n\r\n ', '2021-03-23 07:03:03', 1),
(6, 'Lorem ipsum', 'Lorem ipsum n\'est rien d\'autre qu\'un grand n\'importe quoi qui permet de remplir des champs de textes lorsque l\'on a pas d\'idée, et c\'est exactement ce que je suis en train de faire. Alors comme je le dis souvent: &quot;bon grand n\'importe quoi&quot;.', '2021-03-23 07:03:15', 1),
(7, 'Essai', 'Bin c\'est un simple essai', '2021-03-23 07:03:32', 1),
(8, 'Raquette Babolat', 'J\'ai entendu dire que Babolat (la célèbre marque d\'équipement de tennis française) venait de sortir une toute nouvelle gamme de raquettes haute qualité. Quelqu\'un aurait-il des infos?', '2021-03-23 08:03:23', 1),
(9, 'Coucou', 'Je passais sur le blog du merveilleux site du club de tennis de Thonon les Bains simplement pour vous faire un petit coucou amical. En cette période bien compliqué j\'espère que vous allez tous bien. ', '2021-03-23 08:03:24', 1),
(10, 'Novice', 'Bonjour à toutes et à tous, je me présente je suis Léonide et je viens de signer ma licence au club de Thonon les Bains. J\'espère que nous aurons le plaisir de nous affronter sur les courts.', '2021-03-23 08:03:08', 4),
(11, 'Impatient', 'Bonjour à tous, je suis impatient de reprendre la compétition avec tous mes amis du club de tennis de Thonon les Bains.', '2021-03-23 08:03:59', 5),
(12, '3WAcademy', 'SUPER NOUVELLE!! J\'ai l\'immense plaisir de vous annoncer que nous venons de signer un contrat de sponsoring avec la célèbre 3WAcademy. Ils se sont engagés dans un partenariat avec nous pour 5 ans, à hauteur de 100000 euros par an. Oui oui vous avez bien lu: 100 000 euros par an (c\'est le banquier qui va être content), de quoi payer les équipements pour l\'école de tennis et rénover les courts. Un grand MERCI à la 3WAcademy.', '2021-03-23 08:03:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_membre` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign2` (`id_membre`),
  KEY `foreign3` (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `pseudo`, `contenu`, `id_article`, `id_membre`) VALUES
(1, 'prof', 'bin voilà', 1, 1),
(2, 'prof', 'zertghyjkl', 1, 1),
(3, 'prof', 'sdfvfgbhnhj,k;klkiuyhgfdfgbhhj', 1, 1),
(4, 'papa', 'c\'est moi le papa donc j\'ai toujours raison', 1, 3),
(5, 'prof', 'Vraiment content!!!!!!!', 4, 1),
(6, 'N\'importe quoi', 'Comme nous sommes dans un article &quot;n\'importe quoi&quot;, je me devais de mettre un commentaire du même calibre..... Voilà c\'est chose faite.', 6, 1),
(7, 'leonide', 'C\'est avec un immense plaisir que je vous retourne le bonjour', 9, 4),
(8, 'leonide', 'Oui Babolat vient de sortir sa nouvelle gamme de raquettes mais compte tenu de mon niveau et des prix je ne sais pas si je vais changer ma raquette.', 8, 4),
(9, 'leonide', 'Si vous le dites', 3, 4),
(10, 'leonide', 'OOOOH oui quel plaisir!!', 5, 4),
(11, 'leonide', 'bin j\'ai envie de dire: &quot;essai transformé&quot;.', 7, 4),
(12, 'clement', 'Novice ou pas chez nous l\'important c\'est de prendre du plaisir. Bienvenue', 10, 5),
(13, 'clement', 'Je ne dirais pas mieux que Léonide', 5, 5),
(14, 'leonide', 'C\'est quoi la 3WAcademy??????????', 12, 4),
(15, 'clement', 'Tu connais pas la célèbre 3WAcademy?!?! C\'est le top du top en matière de formation dans le numérique. D\'ailleurs je crois que c\'est un de leurs élèves qui nous a fait notre splendide site internet.', 12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mail`, `motdepasse`, `is_admin`) VALUES
(1, 'prof', 'prof@gmail.com', '$2y$12$PywVb8bpAT7s48U0PF0LUe5ImNLkXAD/uTXWA1mpdJOl.BOfEO7Sm', 1),
(3, 'papa', 'papa@gmail.com', '$2y$12$jP3vnXklHUnkPUZAz7m/eeTFp6oRbDk8rvzPGimApzdzJUR8xp08a', 0),
(4, 'leonide', 'leonide@gmail.com', '$2y$12$tOMguC0l8/z3Zp/zW582OORoogQDavSaJ5h6p4O.yntMa3xwWa8.y', 0),
(5, 'clement', 'faivrelr@gmail.com', '$2y$12$wcV.aNx5X3uaXszbP5wolOtO7hotLCYEiPp8k0U3Btw7uRl.SUl0C', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `foreign1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
