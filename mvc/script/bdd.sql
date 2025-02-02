-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 30 jan. 2025 à 13:58
-- Version du serveur : 10.6.18-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_full_stack`
--

-- --------------------------------------------------------

--
-- Structure de la table `group_pdv`
--

CREATE TABLE `group_pdv` (
                             `id` int(11) NOT NULL,
                             `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `group_pdv`
--

INSERT INTO `group_pdv` (`id`, `name`) VALUES
    (1, 'premier');

-- --------------------------------------------------------

--
-- Structure de la table `hourly`
--

CREATE TABLE `hourly` (
                          `id` int(11) NOT NULL,
                          `lundi` text NOT NULL,
                          `mardi` text NOT NULL,
                          `mercredi` text NOT NULL,
                          `jeudi` text NOT NULL,
                          `vendredi` text NOT NULL,
                          `samedi` text NOT NULL,
                          `dimanche` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hourly`
--

INSERT INTO `hourly` (`id`, `lundi`, `mardi`, `mercredi`, `jeudi`, `vendredi`, `samedi`, `dimanche`) VALUES
    (1, '11H00 - 00H00', '11H00 - 00H00', '11H00 - 01H00', '11H30 - 00H00', '11H00 - 23H00', '11H00 - 02H30', '11H00 - 00H00');

-- --------------------------------------------------------

--
-- Structure de la table `pdv`
--

CREATE TABLE `pdv` (
                       `id` int(11) NOT NULL,
                       `name` text NOT NULL,
                       `id_group` int(11) NOT NULL,
                       `siren` int(9) NOT NULL,
                       `rue` text NOT NULL,
                       `code_postal` int(5) NOT NULL,
                       `ville` text NOT NULL,
                       `x_pos` text NOT NULL,
                       `y_pos` text NOT NULL,
                       `manager` text NOT NULL,
                       `id_hourly` int(11) NOT NULL,
                       `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pdv`
--



--
-- Structure de la table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `name` text NOT NULL,
                        `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `name`, `password`) VALUES
                                                  (1, 'admin', '$2y$10$GYfy.RTXHzu0rTpA56NC/.7x.rIKd7vslBCwVaR8R.WWby3ZT7a46');
--
-- Index pour la table `group_pdv`
--
ALTER TABLE `group_pdv`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hourly`
--
ALTER TABLE `hourly`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pdv`
--
ALTER TABLE `pdv`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_hourly` (`id_hourly`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `group_pdv`
--

--
-- Contraintes pour la table `pdv`
--
ALTER TABLE `pdv`
    ADD CONSTRAINT `pdv_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `group_pdv` (`id`),
  ADD CONSTRAINT `pdv_ibfk_2` FOREIGN KEY (`id_hourly`) REFERENCES `hourly` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
