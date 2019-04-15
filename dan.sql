-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: apr. 15, 2019 la 03:40 PM
-- Versiune server: 5.7.24
-- Versiune PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `dan`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `doctors`
--

INSERT INTO `doctors` (`Id`, `Username`, `Password`) VALUES
(1, 'Maria', '$2y$10$SdoCQMAD.HW1RYl1fecAquWVGYlvA/Hf7n.UisjQ/sG1uPYrSfIHe');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicament` text NOT NULL,
  `descriere` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `medicament`
--

INSERT INTO `medicament` (`id`, `medicament`, `descriere`) VALUES
(1, 'Paracetamol', 'A se administra cel mult 3 pastile pe zi la un interval de 6 ore'),
(2, 'Nurofen 400mg', 'Nurofen forte/Nurofen raceala si gripa'),
(3, 'Decasept', 'Prospect alimentar'),
(4, 'Osteocare', 'Viatamina D3 si zinc');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `medicamente`
--

DROP TABLE IF EXISTS `medicamente`;
CREATE TABLE IF NOT EXISTS `medicamente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicament` text NOT NULL,
  `administrare` text NOT NULL,
  `timp_de` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `medicamente`
--

INSERT INTO `medicamente` (`id`, `medicament`, `administrare`, `timp_de`) VALUES
(1, 'Paracetamol', '3 pe zi ', ' o saptamana'),
(2, 'Nurofen', 'o pastila la 6 ore', ' o saptamana'),
(3, 'Osteocare', '2 pe zi', ' o saptamana'),
(4, 'Paracetamol', '3 pe zi ', ' o saptamana'),
(5, 'Nurofen', 'o pastila la 6 ore', ' o saptamana'),
(6, 'Osteocare', '2 pe zi', ' o saptamana'),
(7, 'Paracetamol', '3 pe zi ', ' o saptamana'),
(8, 'Nurofen', 'o pastila la 6 ore', ' o saptamana'),
(9, 'Osteocare', '2 pe zi', ' o saptamana'),
(10, 'Paracetamol', '3 pe zi ', ' o saptamana'),
(11, 'Nurofen', 'o pastila la 6 ore', ' o saptamana'),
(12, 'Osteocare', '2 pe zi', ' o saptamana'),
(13, '1', 'vbggn', 'sdf');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `Email` text NOT NULL,
  `Nume` text NOT NULL,
  `Prenume` text NOT NULL,
  `DataNasterii` text NOT NULL,
  `NrTelefon` text NOT NULL,
  `Doctor` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
