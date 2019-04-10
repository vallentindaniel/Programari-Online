-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07 Ian 2019 la 18:42
-- Versiune server: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfop`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`) VALUES
(1, 'Valentin_daniel', '$2y$10$oQ1EjWVRfhRZwVS/.3gnQeqbU5Iu1kSbfyUwoXb2P24bOaPsCqSg.');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `doctori`
--

DROP TABLE IF EXISTS `doctori`;
CREATE TABLE IF NOT EXISTS `doctori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `judete`
--

DROP TABLE IF EXISTS `judete`;
CREATE TABLE IF NOT EXISTS `judete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume_jud` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `judete`
--

INSERT INTO `judete` (`id`, `nume_jud`) VALUES
(1, 'Alba'),
(2, 'Arad'),
(3, 'Arges'),
(4, 'Bacau'),
(5, 'Bihor'),
(6, 'Bistrita-Nasaud'),
(7, 'Botosani'),
(8, 'Brasov'),
(9, 'Braila'),
(10, 'Buzau'),
(11, 'Caras-Severin'),
(12, 'Calarasi'),
(13, 'Cluj'),
(14, 'Constanta'),
(15, 'Covasna'),
(16, 'Dambovita'),
(17, 'Dolj'),
(18, 'Galati'),
(19, 'Giurgiu'),
(20, 'Gorj'),
(21, 'Harghita'),
(22, 'Hunedoara'),
(23, 'Ialomita'),
(24, 'Iasi'),
(25, 'Ilfov'),
(26, 'Maramures'),
(27, 'Mehedinti'),
(28, 'Mures'),
(29, 'Neamt'),
(30, 'Olt'),
(31, 'Prahova'),
(32, 'Satu Mare'),
(33, 'Salaj'),
(34, 'Sibiu'),
(35, 'Suceava'),
(36, 'Teleorman'),
(37, 'Timis'),
(38, 'Tulcea'),
(39, 'Vaslui'),
(40, 'Valcea'),
(41, 'Vrancea');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `localitati`
--

DROP TABLE IF EXISTS `localitati`;
CREATE TABLE IF NOT EXISTS `localitati` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jud` int(100) NOT NULL,
  `nume_loc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `localitati`
--

INSERT INTO `localitati` (`id`, `id_jud`, `nume_loc`) VALUES
(1, 1, 'Abrud'),
(2, 1, 'Sebes'),
(3, 1, 'Aiud'),
(4, 1, 'Alba Iulia'),
(5, 2, 'Arad'),
(6, 3, 'Pitesti'),
(7, 3, 'Costesti'),
(8, 3, 'Vedea'),
(9, 3, 'Leordeni'),
(10, 3, 'Valea Lesului'),
(11, 3, 'Bradet'),
(12, 3, 'Stefanesti'),
(13, 3, 'Calinesti');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `lunile_anului`
--

DROP TABLE IF EXISTS `lunile_anului`;
CREATE TABLE IF NOT EXISTS `lunile_anului` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nr_zile` int(11) NOT NULL,
  `luna` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `lunile_anului`
--

INSERT INTO `lunile_anului` (`id`, `nr_zile`, `luna`) VALUES
(1, 31, 'Ianuarie'),
(2, 28, 'Februarie'),
(3, 31, 'Martie'),
(4, 30, 'Aprilie'),
(5, 31, 'Mai'),
(6, 30, 'Iunie'),
(7, 31, 'Iulie'),
(8, 31, 'August'),
(9, 30, 'Septembrie'),
(10, 31, 'Octombrie'),
(11, 30, 'Noiembrie'),
(12, 31, 'Decembrie');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `programari`
--

DROP TABLE IF EXISTS `programari`;
CREATE TABLE IF NOT EXISTS `programari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jud` int(11) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `id_spital` int(11) NOT NULL,
  `id_sectie` int(11) NOT NULL,
  `ora_select` int(11) NOT NULL,
  `zi_select` int(11) NOT NULL,
  `luna_select` int(11) NOT NULL,
  `an_select` int(100) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `data_zi` int(100) NOT NULL,
  `data_luna` varchar(100) NOT NULL,
  `data_an` int(100) NOT NULL,
  `telefon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `programari_id`
--

DROP TABLE IF EXISTS `programari_id`;
CREATE TABLE IF NOT EXISTS `programari_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sectii`
--

DROP TABLE IF EXISTS `sectii`;
CREATE TABLE IF NOT EXISTS `sectii` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spital` int(11) NOT NULL,
  `sectia` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `sectii`
--

INSERT INTO `sectii` (`id`, `id_spital`, `sectia`) VALUES
(1, 1, 'Sectie 1'),
(2, 2, 'fizioterapie'),
(3, 2, 'neurologie'),
(4, 2, 'pediatrie'),
(5, 2, 'policlinica'),
(6, 2, 'psihiatrie'),
(7, 2, 'TBC'),
(8, 2, 'Cresa nr: 2'),
(9, 2, 'Dispensar nr: 2'),
(10, 3, 'geriatrie'),
(11, 3, 'TBC'),
(12, 4, '1'),
(13, 5, 'laborator sanatate mintala'),
(14, 5, 'boli infectioase adulti'),
(15, 5, 'psihiatrie adulti'),
(16, 5, 'serviciul de ergoterapie'),
(17, 6, 'policlinica'),
(18, 6, 'dermatologie'),
(19, 6, 'dispensar TBC'),
(20, 6, 'oncologie'),
(21, 6, 'ORL adulti'),
(22, 6, 'TBC'),
(23, 6, 'TBC camera de garda'),
(24, 7, 'ginecologie');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `spitale`
--

DROP TABLE IF EXISTS `spitale`;
CREATE TABLE IF NOT EXISTS `spitale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_loc` int(11) NOT NULL,
  `nume_sp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `spitale`
--

INSERT INTO `spitale` (`id`, `id_loc`, `nume_sp`) VALUES
(1, 1, 'Spital Abrud centrala'),
(2, 2, 'Spital Sebes'),
(3, 4, 'Spitalul Judetean Alba Iulia'),
(4, 3, 'Orasanesc'),
(5, 5, 'Spitalul Clinic Judetean Arad'),
(6, 5, 'Spitalul Clinic Municipal Arad'),
(7, 5, 'SPITALUL DE OBSTETRICA GINECOLOGIE DR. SALVATOR VUIA'),
(8, 6, 'Spitalul Judetean de Urgenta Pitesti'),
(9, 6, 'Spitalul de Pediatrie Pitesti'),
(10, 7, 'Spitalul orasanesc \"Regele Carol I\"'),
(11, 8, 'Spitalul de psihiatrie \"Sf. Maria\"'),
(12, 9, 'Spitalul de Pneumoftiziologie Cronici '),
(13, 10, 'Spitalul de Pneumoftiziologie \"sf. Andrei\"'),
(14, 11, 'Spitalul de Recuperare'),
(15, 12, 'Spitalul de Geriatrie ÅŸi Boli Cronice'),
(16, 13, 'Spitalul de Boli Cronice');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'dan', '$2y$10$7VDrD1OXuWWVmQnASgtaYeYZ1ZyY0Mdbbhk3FIS2u1Ee9vCimvtU2'),
(2, 'man', '$2y$10$bEGLWaeVMZPFr.VfXk9dfuiP39LLWizwdxsPzztnI6Ux1lJKDd4Di'),
(3, 'Madalin', '$2y$10$icyEdqpbeQl2.qLvmyoOuO70J7bguJDpgVh58m71JACP7uB9tVhwS');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `zile_sapt`
--

DROP TABLE IF EXISTS `zile_sapt`;
CREATE TABLE IF NOT EXISTS `zile_sapt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ziua` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Salvarea datelor din tabel `zile_sapt`
--

INSERT INTO `zile_sapt` (`id`, `ziua`) VALUES
(1, 'L'),
(2, 'M'),
(3, 'Mi'),
(4, 'J'),
(5, 'V'),
(6, 'S'),
(7, 'D');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
