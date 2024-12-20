-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 déc. 2024 à 04:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `panier`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `content`, `created_at`) VALUES
(3, 34, 18, 'fds', '2024-12-18 23:25:29'),
(4, 34, 18, 'ccsqd', '2024-12-18 23:25:50'),
(5, 34, 18, 'ccsqd', '2024-12-18 23:29:39'),
(6, 34, 18, 's', '2024-12-18 23:29:43'),
(7, 34, 18, 'ds', '2024-12-18 23:34:21'),
(8, 33, 18, 'ds', '2024-12-18 23:34:27'),
(11, 34, 18, 'fsfds', '2024-12-18 23:37:31'),
(12, 33, 18, 'fds', '2024-12-18 23:37:39'),
(13, 34, 18, 'test', '2024-12-18 23:39:10'),
(14, 34, 18, 'test', '2024-12-18 23:39:41'),
(15, 35, 18, 'dsds', '2024-12-18 23:45:49'),
(16, 35, 18, 'ds', '2024-12-18 23:47:45'),
(17, 35, 18, 'dqs', '2024-12-18 23:47:47'),
(18, 35, 18, 'xc', '2024-12-18 23:47:57'),
(19, 35, 18, 'bcv', '2024-12-19 17:01:50'),
(20, 35, 18, 'vccv', '2024-12-19 17:05:12'),
(21, 35, 18, 'ttttttttt', '2024-12-19 17:05:15'),
(22, 35, 17, 'h', '2024-12-19 17:06:10'),
(23, 34, 17, 'nb', '2024-12-19 17:07:06'),
(24, 35, 17, 'nbv', '2024-12-19 17:07:36'),
(25, 35, 18, ',nn', '2024-12-19 17:07:54'),
(26, 33, 18, ':mm', '2024-12-19 17:08:02'),
(27, 34, 18, ',;,', '2024-12-19 17:11:22');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
