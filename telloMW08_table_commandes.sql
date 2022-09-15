
-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `idcommandes` int(11) NOT NULL,
  `idvol` int(11) NOT NULL,
  `idlisteCommandes` int(11) NOT NULL,
  `valeur` int(11) DEFAULT NULL,
  `time_ms` int(11) DEFAULT NULL COMMENT 'Délai en milliseconde entre chaque commande'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
