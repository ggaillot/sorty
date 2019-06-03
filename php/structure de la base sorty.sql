-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 03 juin 2019 à 09:36
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sorty`
--

-- --------------------------------------------------------

--
-- Structure de la table `particips`
--

DROP TABLE IF EXISTS `particips`;
CREATE TABLE IF NOT EXISTS `particips` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_particip` text COLLATE utf8_unicode_ci,
  `sor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typ` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'typ',
  PRIMARY KEY (`id`),
  KEY `particips_sor_id_index` (`sor_id`),
  KEY `particips_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sors`
--

DROP TABLE IF EXISTS `sors`;
CREATE TABLE IF NOT EXISTS `sors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dat` date NOT NULL,
  `comment_sor` text COLLATE utf8_unicode_ci,
  `typ` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normale',
  `email` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'temoin envoi email',
  `autemail` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'auteur envoi email',
  `datemail` date DEFAULT NULL,
  `commentmail` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ajour` tinyint(1) NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statut` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `particips`
--
ALTER TABLE `particips`
  ADD CONSTRAINT `particips_sor_id_foreign` FOREIGN KEY (`sor_id`) REFERENCES `sors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `particips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
