-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2019 at 01:07 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SA`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonne_newlester`
--

CREATE TABLE `abonne_newlester` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abonne_newlester`
--

INSERT INTO `abonne_newlester` (`id`, `email`, `date`) VALUES
(1, 'karimdiopabdou@gmail.com', '2019-03-01'),
(2, 'kekediop@gmail.com', '2019-03-01'),
(3, 'test@test.com', '2019-03-01'),
(4, 'rim@kangam.labs', '2019-03-01'),
(5, 'rim@kangam.labs', '2019-03-17'),
(6, 'test@test.com', '2019-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `apprenant`
--

CREATE TABLE `apprenant` (
  `id` int(11) NOT NULL,
  `cohorte_id` int(11) DEFAULT NULL,
  `fili�ere_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naiss` date NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apprenant`
--

INSERT INTO `apprenant` (`id`, `cohorte_id`, `fili�ere_id`, `nom`, `prenom`, `adresse`, `email`, `description`, `date_naiss`, `photo`, `cv`) VALUES
(1, 1, 1, 'Diop', 'Abdou Karim', 'Yoff Dakar/Senegal', 'karimdiopabdou@gmail.com', 'fghnfhfgdf', '2014-01-01', '5a3783f7c79a9b56af938fca05ced853.png', 'be4f198e27c071bfeefbb01297b0b0d9.pdf'),
(2, 1, 1, 'Gueye', 'Cheikh', 'Yoff', 'kheushbi@gmail.com', 'Bonjour', '2016-05-10', 'cc6aba25207b12efd03e90b65c2c378e.jpeg', '74502a622c75676a1debbc41f7d7acaa.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cohorte`
--

CREATE TABLE `cohorte` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cohorte`
--

INSERT INTO `cohorte` (`id`, `libelle`, `promotion`) VALUES
(1, 'Cohorte 1', 'Alioune Ndiaye');

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `typecour_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` datetime NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `module_id`, `typecour_id`, `libelle`, `photo`, `data`, `contenu`, `auteur`, `description`) VALUES
(2, 2, 1, 'Maths', 'b2651b1513ad954dee4bf3e57bb2e505.png', '2021-07-07 05:07:00', 'sdfagshzlkdmleùmrthymlrhtegrfztexdrazwxsfxdgchgfklhgj,klm;ùlmhkljghgdhfsdhjklm;ùmkh,ljgfsdhhgfjhdghkllmjkmljkùlmhjlkgjfkhbgjdvhfsdqsgdfhghfjhghlkjklmmlmlmhklgdjhsg', 'Rimka', 'Bonjour'),
(3, 1, 2, 'PC', 'c307e1b0d3bcb1d0fc55fd4c3dfd01a9.jpeg', '2014-01-01 00:00:00', 'fsgdhfgjhgkggjghfgdfsdfsdgf', 'Mbaye', 'dfghfgjghfgdfsdqfsdgfg');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `libelle`, `timer`) VALUES
(1, 'Développement Web', '980'),
(2, 'Référant Digital', '980'),
(3, 'Data Artisan', '980');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190213123250', '2019-02-21 12:04:46'),
('20190214112107', '2019-02-21 12:04:47'),
('20190214112734', '2019-02-21 12:04:47'),
('20190221120541', '2019-02-21 12:05:50'),
('20190301001023', '2019-03-01 00:11:01'),
('20190302003301', '2019-03-02 00:33:27'),
('20190302003522', '2019-03-02 00:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `filiere_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `filiere_id`, `libelle`) VALUES
(1, 1, 'PHP'),
(2, 2, 'SoftSkill'),
(3, 3, 'Scraping\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partenaire`
--

INSERT INTO `partenaire` (`id`, `photo`, `libelle`, `link`) VALUES
(1, 'fa09aa866894cdc1e4fb39be947c165a.png', 'Rimka', 'http://www.rim.com'),
(2, 'd8444971d07a504dc8ac3a190ce90737.jpeg', 'dale', 'http://www.dale.com'),
(3, 'ec6d85acd7bbbb1ac79b69d5bfe1d0ae.jpeg', 'bouky', 'http://www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `type_cours`
--

CREATE TABLE `type_cours` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_cours`
--

INSERT INTO `type_cours` (`id`, `libelle`) VALUES
(1, 'Cours'),
(2, 'Tuto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonne_newlester`
--
ALTER TABLE `abonne_newlester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C4EB462EFB30EFA4` (`cohorte_id`),
  ADD KEY `IDX_C4EB462E868DACD9` (`fili�ere_id`);

--
-- Indexes for table `cohorte`
--
ALTER TABLE `cohorte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FDCA8C9CAFC2B591` (`module_id`),
  ADD KEY `IDX_FDCA8C9C6D70A3B8` (`typecour_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C242628180AA129` (`filiere_id`);

--
-- Indexes for table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_cours`
--
ALTER TABLE `type_cours`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonne_newlester`
--
ALTER TABLE `abonne_newlester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cohorte`
--
ALTER TABLE `cohorte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `type_cours`
--
ALTER TABLE `type_cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `FK_C4EB462E868DACD9` FOREIGN KEY (`fili�ere_id`) REFERENCES `filiere` (`id`),
  ADD CONSTRAINT `FK_C4EB462EFB30EFA4` FOREIGN KEY (`cohorte_id`) REFERENCES `cohorte` (`id`);

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C6D70A3B8` FOREIGN KEY (`typecour_id`) REFERENCES `type_cours` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_C242628180AA129` FOREIGN KEY (`filiere_id`) REFERENCES `filiere` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
