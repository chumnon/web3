-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 31 Août 2023 à 21:20
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `avion`
--

-- --------------------------------------------------------

--
-- Structure de la table `jet`
--

CREATE TABLE `jet` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `pays` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Contenu de la table `jet`
--

INSERT INTO `jet` (`id`, `nom`, `pays`, `role`, `img`) VALUES
(1, 'F/A-18', 'États-Unis', 'chasseur polyvalent', 'https://nationalinterest.org/sites/default/files/styles/desktop__1260_/public/main_images/8659432ol.jpg?itok=xjW4d3cF'),
(2, 'B-2', 'États-Unis', 'Bombardier', 'https://hips.hearstapps.com/vidthumb/images/2022-popularmechanics-heavymetal-ep07-b-2-jc-thumb-v02-6463db1d138cf.jpg?crop=1.00xw:1.00xh;0,0'),
(3, 'CF-105', 'Canada', 'Intercepteur', 'https://theaviationgeekclub.com/wp-content/uploads/2019/11/CF-105.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jet`
--
ALTER TABLE `jet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jet`
--
ALTER TABLE `jet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
