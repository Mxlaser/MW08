
-- --------------------------------------------------------

--
-- Table structure for table `listeCommandes`
--

CREATE TABLE `listeCommandes` (
  `idlisteCommandes` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `listeCommandes`
--

INSERT INTO `listeCommandes` (`idlisteCommandes`, `nom`) VALUES
(1, 'command'),
(2, 'takeoff'),
(5, 'land'),
(6, 'emergency'),
(7, 'up'),
(8, 'down'),
(9, 'forward'),
(10, 'back'),
(11, 'cw'),
(12, 'ccw'),
(13, 'flip'),
(14, 'go'),
(15, 'curve');
