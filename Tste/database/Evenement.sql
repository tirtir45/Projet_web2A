-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 16 nov. 2024 à 00:25
-- Version du serveur : 8.0.40
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Evenement`
--

CREATE TABLE `Evenement` (
  `IdEvent` int NOT NULL,
  `title` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `description` varchar(250) NOT NULL,
  `disponibility` tinyint(1) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Evenement`
--

INSERT INTO `Evenement` (`IdEvent`, `title`, `category`, `description`, `disponibility`, `price`) VALUES
(1, 'ElJem', 'History', 'Discover the Historical Beauty of the Country with Our Trip to the Coliseum.\r\n\r\n', 1, 100),
(2, 'Dougga', 'History', 'Discover the Historical Beauty of the Country with Our Trip to the Capitole.\r\n\r\n', 0, 350),
(3, 'Zaghouan', 'History', 'Discover the Historical Beauty of the Country with Our Trip to the Capitole.\r\n\r\n', 1, 200),
(4, 'El Kef', 'Nature', 'Discover the Natural Beauty of the Country with Our Trip to El Kef.\r\n\r\n', 0, 400),
(5, 'Matmata', 'Culture', 'Discover the Historical Civilisation of the Country with Our Trip to Matmata.\r\n\r\n', 1, 700);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Evenement`
--
ALTER TABLE `Evenement`
  ADD PRIMARY KEY (`IdEvent`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Evenement`
--
ALTER TABLE `Evenement`
  MODIFY `IdEvent` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
