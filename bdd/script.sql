-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 mars 2022 à 18:54
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lab2_021_nicolas_olagnon_v6.2`
--
CREATE DATABASE IF NOT EXISTS `lab2_021_nicolas_olagnon_v6.2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lab2_021_nicolas_olagnon_v6.2`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `contenu` text,
  `keywords` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `image_highlight_id` int DEFAULT NULL,
  `categories_articles_id` int DEFAULT NULL,
  `users_id` int DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `articles_users_FK` (`users_id`),
  KEY `articles_images_FK` (`image_highlight_id`),
  KEY `articles_categories_FK_idx` (`categories_articles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `categories_articles`
--

DROP TABLE IF EXISTS `categories_articles`;
CREATE TABLE IF NOT EXISTS `categories_articles` (
  `id_categorie_article` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categorie_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `categories_portfolio_items`
--

DROP TABLE IF EXISTS `categories_portfolio_items`;
CREATE TABLE IF NOT EXISTS `categories_portfolio_items` (
  `id_categorie_portfolio_item` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categorie_portfolio_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `auteur_login` varchar(255) DEFAULT NULL,
  `contenu` text,
  `created_at` datetime DEFAULT NULL,
  `users_id` int DEFAULT NULL,
  `articles_id` int DEFAULT NULL,
  `portfolio_items_id` int DEFAULT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `commentaires_users_FK` (`users_id`),
  KEY `commentaires_articles_FK` (`articles_id`),
  KEY `commentaires_portfolio_items_FK` (`portfolio_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `articles_id` int DEFAULT NULL,
  `portfolio_items_id` int DEFAULT NULL,
  PRIMARY KEY (`id_image`),
  KEY `images_articles_FK` (`articles_id`),
  KEY `images_portfolio_items_FK` (`portfolio_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `portfolio_items`
--

DROP TABLE IF EXISTS `portfolio_items`;
CREATE TABLE IF NOT EXISTS `portfolio_items` (
  `id_portfolio_item` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description_subtitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description_type_projet` varchar(255) DEFAULT NULL,
  `description_contenu` text,
  `access_login_admin` varchar(50) DEFAULT NULL,
  `access_mdp_admin` varchar(50) DEFAULT NULL,
  `access_login_user` varchar(50) DEFAULT NULL,
  `access_mdp_user` varchar(50) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `users_id` int DEFAULT NULL,
  `image_highlight_id` int DEFAULT NULL,
  `categories_portfolio_items_id` int DEFAULT NULL,
  PRIMARY KEY (`id_portfolio_item`),
  KEY `portfolio_items_users_FK` (`users_id`),
  KEY `portfolio_items_images_FK` (`image_highlight_id`),
  KEY `portfolio_items_categories_FK` (`categories_portfolio_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_categories_FK` FOREIGN KEY (`categories_articles_id`) REFERENCES `categories_articles` (`id_categorie_article`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_images_FK` FOREIGN KEY (`image_highlight_id`) REFERENCES `images` (`id_image`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_users_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_articles_FK` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_portfolio_items_FK` FOREIGN KEY (`portfolio_items_id`) REFERENCES `portfolio_items` (`id_portfolio_item`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_users_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_articles_FK` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id_article`) ON DELETE CASCADE,
  ADD CONSTRAINT `images_portfolio_items_FK` FOREIGN KEY (`portfolio_items_id`) REFERENCES `portfolio_items` (`id_portfolio_item`) ON DELETE CASCADE;

--
-- Contraintes pour la table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD CONSTRAINT `portfolio_items_categories_FK` FOREIGN KEY (`categories_portfolio_items_id`) REFERENCES `categories_portfolio_items` (`id_categorie_portfolio_item`) ON DELETE SET NULL,
  ADD CONSTRAINT `portfolio_items_images_FK` FOREIGN KEY (`image_highlight_id`) REFERENCES `images` (`id_image`) ON DELETE SET NULL,
  ADD CONSTRAINT `portfolio_items_users_FK` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
