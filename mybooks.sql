-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 05 nov. 2020 à 13:48
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mybooks`
--
CREATE DATABASE mybooks;
-- --------------------------------------------------------
USE mybooks;
--
-- Structure de la table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `hasBeenReadOn` date DEFAULT NULL,
  `hasBeenRead` varchar(3) DEFAULT NULL,
  `isbn` varchar(13) NOT NULL,
  `localization` varchar(100) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `releaseDate`, `hasBeenReadOn`, `hasBeenRead`, `isbn`, `localization`, `genre`, `description`) VALUES
(1, 'Les machines de l\'esprit', 'Dima Zales', '2017-11-15', NULL, NULL, '1631422898', '', 'science-fiction', 'Je m appelle Mike Cohen et voici la façon dont je suis devenu plus qu humain'),
(2, 'Le monde perdu', 'Arthur Conan Doyle', '2013-06-07', NULL, NULL, '1521995974', '', 'Fantastique', 'univers oublié, disparu ? Pas pour tous : Édouard Malone, reporter à la Daily Gazette, va tenter de prouver à la belle Gladys et à l’effrayant professeur Challenger qu’il existe encore.'),
(3, 'Dusty', 'David Atcock ', '2018-11-16', NULL, NULL, '9781731428172', '', 'Aventure horreur ', 'Durant l\'année de l\'élection de JFK, sans distinction entre hommes, femmes et enfants, un tueur sévi dans les rues d\'une ville du Texas, Dusty. C\'est avec l\'enlèvement de Peter que l\'affaire reprend. Après plusieurs années de silence, le retour de Mark Sanders marque une nouvelle avancée dans l\'enquête. Qui peut bien se cacher derrière de telles horreurs ? Qui est ce tueur ?'),
(4, 'La horde du contrevent', 'Alain Damasio ', '2015-03-05', NULL, NULL, '2070464237', '', 'Science Fiction', ' Un groupe d\'élite, formé dès l\'enfance à faire face, part des confins d\'une terre féroce, saignée de rafales, pour aller chercher l\'origine du vent. Ils sont vingt-trois, un bloc, un nœud de courage : la Horde. Ils sont pilier, ailier, traceur, aéromaître et géomaître, feuleuse et sourcière, troubadour et scribe'),
(5, 'Bear Town', 'Frederick ', '2018-02-08', NULL, NULL, '9781501160776', '', 'Fiction', ''),
(6, 'Roommaid', 'Sariah Wilson', '2020-10-01', NULL, NULL, '9781542023801', '', 'Comtemporain', ''),
(7, 'Naturopathie, le guide complet au quotidien', 'Marine Le Gouvello', '2018-02-16', NULL, NULL, '9782815309561', '', 'Santé', 'L’objectif de cet ouvrage est d’éclairer sur la façon dont la naturopathie, discipline millénaire issue de l’observation de la nature, peut aider chacun d’entre nous au quotidien, en plaçant l’hygiène de vie à la première place.'),
(8, 'Victor Hugo Oeuvres complètes', 'Victor Hugo', '2013-12-01', NULL, NULL, '9782368410165', '', 'Drame', ''),
(9, 'J\'apprend la photographie ', 'Nicolas Croce', '2016-10-27', NULL, NULL, '2212118848', '', 'Technique', 'Exercices de photographie'),
(10, 'L\'odyssée des gènes', 'Evelyne Heyer', '2020-09-09', NULL, NULL, '2081428229', '', 'Sciences', ''),
(11, 'Bonjour', 'moi', '2020-01-01', '2020-01-01', 1, '1234567891011', 'ici', 'indeterminé', 'blablabla');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
