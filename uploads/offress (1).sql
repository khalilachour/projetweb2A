-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 11, 2024 at 12:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offress`
--

-- --------------------------------------------------------

--
-- Table structure for table `avantages`
--

CREATE TABLE `avantages` (
  `id` int(11) NOT NULL,
  `offre_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `avantagesSociaux` text DEFAULT NULL,
  `avantagesFinanciers` text DEFAULT NULL,
  `developpementProfessionnel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avantages`
--

INSERT INTO `avantages` (`id`, `offre_id`, `description`, `avantagesSociaux`, `avantagesFinanciers`, `developpementProfessionnel`) VALUES
(1, 1, '1', '1', '1', 1),
(2, 2, '2', '2', '2', 1),
(3, 3, 'ergt', 'lll', 'srth', 0),
(4, 4, '4', 'dfegr', 'zqe', 1),
(5, 5, '5', 'fxgrth', 'frgryj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `historique_modifications`
--

CREATE TABLE `historique_modifications` (
  `id` int(11) NOT NULL,
  `idOffre` int(11) DEFAULT NULL,
  `anciennes_donnees` text DEFAULT NULL,
  `nouvelles_donnees` text DEFAULT NULL,
  `type_modification` varchar(50) DEFAULT NULL,
  `date_modification` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historique_modifications`
--

INSERT INTO `historique_modifications` (`id`, `idOffre`, `anciennes_donnees`, `nouvelles_donnees`, `type_modification`, `date_modification`) VALUES
(45, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"ines\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 11:48:41'),
(55, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 11:52:56'),
(56, 4, '\"{}\"', '\"{\\\"description\\\":\\\"4\\\",\\\"avantagesSociaux\\\":\\\"dfegr\\\",\\\"avantagesFinanciers\\\":\\\"zqe\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 11:52:56'),
(57, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 11:53:51'),
(58, 4, '\"{}\"', '\"{\\\"description\\\":\\\"4\\\",\\\"avantagesSociaux\\\":\\\"dfegr\\\",\\\"avantagesFinanciers\\\":\\\"zqe\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 11:53:51'),
(59, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 15:20:13'),
(60, 4, '\"{}\"', '\"{\\\"description\\\":\\\"4\\\",\\\"avantagesSociaux\\\":\\\"dfegr\\\",\\\"avantagesFinanciers\\\":\\\"zqe\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 15:20:13'),
(61, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 15:20:23'),
(62, 4, '\"{}\"', '\"{\\\"description\\\":\\\"4\\\",\\\"avantagesSociaux\\\":\\\"dfegr\\\",\\\"avantagesFinanciers\\\":\\\"zqe\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 15:20:23'),
(63, 4, '\"{\\\"id\\\":4,\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"4000.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"dorra\\\",\\\"nomSociete\\\":\\\"esprit\\\",\\\"titrePoste\\\":\\\"ing\\\\u00e9nieur full stack\\\",\\\"description\\\":\\\"wsdfer\\\",\\\"lieu\\\":\\\"zef\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":4000,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kjggy\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 15:20:48'),
(64, 4, '\"{}\"', '\"{\\\"description\\\":\\\"4\\\",\\\"avantagesSociaux\\\":\\\"dfegr\\\",\\\"avantagesFinanciers\\\":\\\"zqe\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 15:20:48'),
(65, 5, '\"{\\\"id\\\":5,\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"1235.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":1235,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 15:28:03'),
(66, 5, '\"{}\"', '\"{\\\"description\\\":\\\"5\\\",\\\"avantagesSociaux\\\":\\\"fxgrth\\\",\\\"avantagesFinanciers\\\":\\\"frgryj\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 15:28:03'),
(67, 5, '\"{\\\"id\\\":5,\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"1235.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":1235,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', NULL, '2024-05-10 15:28:08'),
(68, 5, '\"{}\"', '\"{\\\"description\\\":\\\"5\\\",\\\"avantagesSociaux\\\":\\\"fxgrth\\\",\\\"avantagesFinanciers\\\":\\\"frgryj\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-10 15:28:08'),
(69, 5, '\"{\\\"id\\\":5,\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"1235.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":1235,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', NULL, '2024-05-11 09:33:32'),
(70, 5, '\"{}\"', '\"{\\\"description\\\":\\\"5\\\",\\\"avantagesSociaux\\\":\\\"fxgrth\\\",\\\"avantagesFinanciers\\\":\\\"frgryj\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-11 09:33:32'),
(71, 5, '\"{\\\"id\\\":5,\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"1235.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":1235,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', NULL, '2024-05-11 09:42:16'),
(72, 5, '\"{}\"', '\"{\\\"description\\\":\\\"5\\\",\\\"avantagesSociaux\\\":\\\"fxgrth\\\",\\\"avantagesFinanciers\\\":\\\"frgryj\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-11 09:42:16'),
(73, 5, '\"{\\\"id\\\":5,\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":\\\"1235.00\\\",\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', '\"{\\\"nomRecruteur\\\":\\\"khalola\\\",\\\"nomSociete\\\":\\\"sprite887\\\",\\\"titrePoste\\\":\\\"comptable\\\",\\\"description\\\":\\\"swdgr\\\",\\\"lieu\\\":\\\"surg\\\",\\\"date\\\":\\\"2024-05-10\\\",\\\"salaire\\\":1235,\\\"typeContrat\\\":\\\"CDI\\\",\\\"competencesRequises\\\":\\\"kug\\\",\\\"experience\\\":1}\"', NULL, '2024-05-11 09:44:46'),
(74, 5, '\"{}\"', '\"{\\\"description\\\":\\\"5\\\",\\\"avantagesSociaux\\\":\\\"fxgrth\\\",\\\"avantagesFinanciers\\\":\\\"frgryj\\\",\\\"developpementProfessionnel\\\":true}\"', NULL, '2024-05-11 09:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `nomRecruteur` varchar(100) DEFAULT NULL,
  `nomSociete` varchar(100) DEFAULT NULL,
  `titrePoste` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `typeContrat` varchar(50) DEFAULT NULL,
  `competencesRequises` text DEFAULT NULL,
  `experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id`, `nomRecruteur`, `nomSociete`, `titrePoste`, `description`, `lieu`, `date`, `salaire`, `typeContrat`, `competencesRequises`, `experience`) VALUES
(1, 'nour yazidi', 'esprit', 'esth', 'zeg', 'pppp', '2024-05-10', '1235.00', 'CDI', 'java kjlfd', 8),
(2, 'dorra yazidi', 'rtyrt', 'esrty', 'sdfdfgr', 'dwrg', '2024-05-10', '8888.00', 'CDI', 'iuyg', 8),
(3, 'lilo', 'rtyrt', 'esrty', 'sdfdfgr', 'dwrg', '2024-05-10', '1235.00', 'CDI', 'iuyg', 8),
(4, 'dorra', 'esprit', 'ingénieur full stack', 'wsdfer', 'zef', '2024-05-10', '4000.00', 'CDI', 'kjggy', 1),
(5, 'khalola', 'sprite887', 'comptable', 'swdgr', 'surg', '2024-05-10', '1235.00', 'CDI', 'kug', 1);

-- --------------------------------------------------------

--
-- Table structure for table `societes`
--

CREATE TABLE `societes` (
  `societe_id` int(11) NOT NULL,
  `nom_societe` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `societes`
--

INSERT INTO `societes` (`societe_id`, `nom_societe`, `email`, `password`, `type`, `numero`, `capital`, `localisation`, `created_at`) VALUES
(42, 'pfizer', 'pfizer@gmail.com', '$2y$10$Sj2iHCm7S9kRmQyeTAOkx.8Y/pkpXPxXOFr8UtZZETjJa4M1Sv/eC', 'Santé', '1265555', '15515456.00', 'america', '2024-05-04 09:02:13'),
(46, 'sprite887', 'sprite@gmail.com', '$2y$10$3wi1CPONGm7fIP3MudMRlu5hNJXKt/t4jfc3aW9DdgK.Aj3xuFowu', 'Alimentation et boissons', '1265555', '15515456.00', '-5.047170736919708, -73.89418333823153', '2024-05-09 19:17:10'),
(48, 'cidre', 'popipoopo@gmail.com', '$2y$10$3XZRA/VgsDUZjTAttR83vOKOewW.gjs1Enxq8c6vBRWZgJQbvXaCW', 'Finance', '1265555', '15515456.00', '35.17380831799959, 9.228826738998405', '2024-05-10 08:54:44'),
(49, 'esprit', 'esprit@gmail.com', '$2y$10$9.xYjJHXvG68B8OiTmNv5u7qfjVsFNSCat1FgBkp/6bo/McUWjXMW', 'Education', '588745621', '15515456.01', '35.58942501459377, -350.3408025693538', '2024-05-10 10:01:33'),
(50, 'tcy', 'esprit@esprit.tn', '$2y$10$3UL.znIXKJvlcepmyDtNYOBwd7Qg1uBosuOgxi2JVtZEU11NpWLl6', 'Finance', '12345', '99999999.99', '49.98513968453916, 10.56460043467748', '2024-05-10 14:00:23'),
(51, 'DORRA', 'dorra@gmail.com', '$2y$10$fYihXjxIqWhg18N/mlQzBO1MWT0q95ww9hc9BSDsRE9c1zrkn2izy', 'Santé', '12345', '99999999.99', '44.87144322538063, 6.003000287589391', '2024-05-11 10:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `type`, `age`, `localisation`, `created_at`) VALUES
(11, 'khalilachour', 'khalilachour@gmail.com', '$2y$10$e2OrJwQfBpIW7ArY7F69BeJDaAhkba5.qlE5AVIQkleC1OQumfl1.', 'normal', 18, 'manouba', '2024-04-29 21:08:04'),
(12, 'eya', 'eya@gmail.com', '$2y$10$NkS/4jL2HPSy2G3XZ29pCOXzpBNowcjz.oFYoUoaslsx9crfJ8vE6', 'normal', 27, 'ben arous', '2024-05-02 18:12:01'),
(13, 'eya', 'eya14@gmail.com', '$2y$10$32stdqYbppZeeBuFYbJeHeWGpy1flndN.VbyuvloGD9Yp/Buw/h1m', 'normal', 24, 'paris', '2024-05-02 21:55:51'),
(14, 'mahdi', 'mahdi@gmail.com', '$2y$10$71/1KnC/xjKHN4PCEgv6duHJDAjAUMb5.l9czaBxCv9M0NgeGRiIW', 'normal', 25, 'bizerte', '2024-05-02 22:17:52'),
(15, 'user1', 'user1@gmail.com', '$2y$10$pgkMI2wFcNzbBGt6em7iZ.c.SZp3cUORtUtHWHMszPKjyBauPYpi2', 'normal', 19, 'bizerte', '2024-05-02 22:21:02'),
(16, 'eya11', 'eya11@gmail.com', '$2y$10$lyGmM2P9AYEnDNkfZym0Bu7S04ZAuKqxCRiGFoI9YSRJH0fqPZhWW', 'normal', 25, 'bizerte', '2024-05-02 22:36:53'),
(17, 'user2', 'user2@gmail.com', '$2y$10$HyBZbI9DxLLS5meVGAipz.YPi.kJ3bdTmmQOgItSDQw0BNSWJ7Fv.', 'normal', 19, 'MALEZFA', '2024-05-02 22:43:23'),
(18, 'user3', 'user3@gmail.com', '$2y$10$PQZV0aXY1tGXl6SFs70rieYYXzyM5IdRkXw/nwgxV4MT5hkdQZqEy', 'normal', 20, 'MALEZFA', '2024-05-02 22:46:43'),
(19, 'user4', 'user4@gmail.com', '$2y$10$xAY4nrrpH.xj60rfTvAaJOhnU8MGJBIVziF0krqIbVHmzE7avoR.G', 'normal', 23, 'MALEZFA', '2024-05-02 22:59:28'),
(20, 'user5', 'user5@gmail.com', '$2y$10$fpfWdpcBvWuW6sxnlKGKke5xu1XKVS8iIb1wv6m7fJeD.KMhhkC0y', 'normal', 23, 'MALEZFA', '2024-05-02 23:01:14'),
(21, 'user5', 'user6@gmail.com', '$2y$10$F2KGC50QWtAxTD.cbmQMN.xFtX0UXryPqbM345pLJ1MWWlRZ6qKVO', 'normal', 23, 'MALEZFA', '2024-05-02 23:02:06'),
(22, 'khalila', 'dimanche@gmail.com', '$2y$10$1LBBCqiINjIN1cHVmAQDCegS4VOCfEail..yRwuMWVDkOtFBBaFHG', 'admin', 14, 'MALEZFA', '2024-05-03 08:52:21'),
(24, 'nada', 'nada@gmail.com', '$2y$10$KosLy3AXMsXPeC4UNm9x.exRs3fPSotHSNtXqktmMbbym/HdRNcn.', 'normal', 20, 'MALEZFA', '2024-05-03 09:07:47'),
(25, 'hedia', 'hedia@gmail.com', '$2y$10$HE.DV7GXKRiBlarbdpzkf.FIR5lvegZFzhu6XHRntBPx3wOaBw7Gu', 'normal', 59, 'la manouba', '2024-05-04 12:31:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avantages`
--
ALTER TABLE `avantages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_offre` (`offre_id`);

--
-- Indexes for table `historique_modifications`
--
ALTER TABLE `historique_modifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offre_id` (`idOffre`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `societes`
--
ALTER TABLE `societes`
  ADD PRIMARY KEY (`societe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avantages`
--
ALTER TABLE `avantages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `historique_modifications`
--
ALTER TABLE `historique_modifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `societes`
--
ALTER TABLE `societes`
  MODIFY `societe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avantages`
--
ALTER TABLE `avantages`
  ADD CONSTRAINT `id_offre` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historique_modifications`
--
ALTER TABLE `historique_modifications`
  ADD CONSTRAINT `historique_modifications_ibfk_1` FOREIGN KEY (`idOffre`) REFERENCES `offres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
