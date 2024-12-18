-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mar. 17 déc. 2024 à 22:19
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
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `IdDemande` int NOT NULL,
  `idClient` int NOT NULL,
  `IdEvenement` int NOT NULL,
  `details` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dateCreation` timestamp NULL DEFAULT NULL,
  `dateReservation` timestamp NULL DEFAULT NULL,
  `statut` varchar(100) DEFAULT 'In Progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Reservation`
--

INSERT INTO `Reservation` (`IdDemande`, `idClient`, `IdEvenement`, `details`, `dateCreation`, `dateReservation`, `statut`) VALUES
(1, 15, 2, ',hqgddjkhfgdudfskjgdhsqjkkukyjdsgkjsqiul', '2024-11-29 00:40:00', NULL, 'Accepted'),
(7, 15, 3, 'uodgdjkqhyhgtfydhtsqjhjcdyuydshigufq', '2024-12-12 19:50:00', NULL, 'Rejected');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`IdDemande`),
  ADD KEY `fek_Res_Cl` (`idClient`),
  ADD KEY `fk_Res_Ev` (`IdEvenement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `IdDemande` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `fek_Res_Cl` FOREIGN KEY (`idClient`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Res_Ev` FOREIGN KEY (`IdEvenement`) REFERENCES `Evenement` (`IdEvent`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
