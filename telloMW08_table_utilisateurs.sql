-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2021 at 11:19 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MW04_drone`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `pseudo` varchar(45) DEFAULT NULL,
  `mdp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `nom`, `prenom`, `email`, `naissance`, `pseudo`, `mdp`) VALUES
(1, 'ABATAN', 'Evan', 'evan.abatan@gmail.com', '1970-01-02', 'login1', 'mdp1'),
(2, 'ABATAN', 'Evan', 'evan.abatan@gmail.com', '1970-01-03', 'login2', 'mdp2'),
(3, 'BECKER', 'Maxime', 'Maxime.BECKER@gmail.com', '1970-01-04', 'login3', 'mdp3'),
(4, 'BERANGER', 'Aurélien', 'Aurélien.BERANGER@gmail.com', '1970-01-05', 'login4', 'mdp4'),
(5, 'BLIN', 'Florent', 'Florent.BLIN@gmail.com', '1970-01-06', 'login5', 'mdp5'),
(6, 'CESARI', 'Jeffrey', 'Jeffrey.CESARI@gmail.com', '1970-01-07', 'login6', 'mdp6'),
(7, 'CHARLES', 'Dimitry', 'Dimitry.CHARLES@gmail.com', '1970-01-08', 'login7', 'mdp7'),
(8, 'CHARTIER', 'Pierre', 'Pierre.CHARTIER@gmail.com', '1970-01-09', 'login8', 'mdp8'),
(9, 'CHRISTON', 'Vincent', 'Vincent.CHRISTON@gmail.com', '1970-01-10', 'login9', 'mdp9'),
(11, 'Jean', 'Jacques', 'jean.jacques@protonmail.com', '1970-01-01', 'jeanjean', 'mdpDeJean01!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idutilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
