-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 jan 2016 om 18:25
-- Serverversie: 10.0.17-MariaDB
-- PHP-versie: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wijndb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `idbestel` int(11) NOT NULL,
  `idklant` int(11) NOT NULL,
  `prijstotaal` decimal(4,2) NOT NULL,
  `besteldatum` datetime NOT NULL,
  `levering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelreg`
--

CREATE TABLE `bestelreg` (
  `idbestreg` int(11) NOT NULL,
  `idbestel` int(11) NOT NULL,
  `artcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aantal` int(11) NOT NULL,
  `prijs` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `idklant` int(11) NOT NULL,
  `naam` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `voornaam` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `straat` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `nr` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL,
  `gemeente` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`idklant`, `naam`, `voornaam`, `straat`, `nr`, `postcode`, `gemeente`, `wachtwoord`, `email`) VALUES
(3, 'Maurissen', 'Kristof', 'Frans van der Muerenstraat', '4', 2530, 'Boechout', '1dec2e86282afbe0864f4de2c28da2fafbbfbd04', 'kristof@hotmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verpakking`
--

CREATE TABLE `verpakking` (
  `idverpak` int(11) NOT NULL,
  `naam` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `aantalinhoud` int(11) NOT NULL,
  `artcode` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `prijs` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verpakking`
--

INSERT INTO `verpakking` (`idverpak`, `naam`, `aantalinhoud`, `artcode`, `prijs`) VALUES
(1, 'Geen verpakking', 0, 'v001', '0.00'),
(2, 'Doos  voor 2 flessen', 2, 'v002', '3.00'),
(3, 'Doos voor 4 flessen', 4, 'v003', '4.00'),
(4, 'Doos voor 6 flessen', 6, 'v004', '6.00'),
(5, 'Kist voor 2 flessen', 2, 'v005', '4.00'),
(6, 'Kist voor 4 flessen', 4, 'v006', '8.00'),
(7, 'Kist voor 6 flessen', 6, 'v007', '10.00'),
(8, 'Kist voor 12 flessen', 12, 'v008', '16.00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wijnen`
--

CREATE TABLE `wijnen` (
  `idwijn` int(11) NOT NULL,
  `naam` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `jaartal` int(11) NOT NULL,
  `land` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cat` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `artcode` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `prijs` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `wijnen`
--

INSERT INTO `wijnen` (`idwijn`, `naam`, `jaartal`, `land`, `cat`, `image`, `artcode`, `prijs`) VALUES
(1, 'beaujolais', 2010, 'Frankrijk', 'rood', 'wijnrood.jpg', 'w190083', '8.00'),
(2, 'Bergerac Sec A.O.P Blanc', 2013, 'Frankrijk', 'wit', '2626-1.jpg', 'w2626-1', '6.00'),
(3, 'Amuse Chardonnay', 2011, 'Frankrijk', 'wit', '2521-1.jpg', 'w2521-1', '7.00'),
(4, 'Beau Mayne Blanc', 2013, 'Frankrijk', 'wit', '2125.jpg', 'w2125', '8.00'),
(5, 'Bel Colle Reoro Arnies', 2012, 'Italie', 'wit', '2562.jpg', 'w2562', '7.00'),
(6, 'Chardonnay Redentore I.G.T.', 2014, 'Italie', 'wit', '0586.jpg', 'w0586', '11.00'),
(7, 'Bianco di Custoza D.O.C.', 2013, 'Italie', 'wit', '258108.jpg', 'w258108', '8.00'),
(8, 'Edulis Blanco D.O.C.a.', 2010, 'Spanje', 'wit', '0069.jpg', 'w0069', '13.00'),
(9, 'Eira da Raia', 2012, 'Spanje', 'wit', '0705.jpg', 'w0705', '16.00'),
(10, 'El Lagar de Isilla Verdejo', 2011, 'Spanje', 'wit', '0527.jpg', 'w0527', '7.00'),
(11, 'Edullis Crianza D.O.C.', 2010, 'Spanje', 'rood', '0071.jpg', 'w0071', '9.00'),
(12, 'Edulis Joven D.O.C.a. ', 2011, 'Spanje', 'rood', '0073.jpg', 'w0073', '7.00'),
(13, 'Tavs Jumilla seleccion', 2015, 'Spanje', 'rood', '0682-1.jpg', 'w0682-1', '10.00'),
(14, 'Amuse Merlot', 2015, 'Frankrijk', 'rood', '2526-1.jpg', 'w2526-1', '10.00'),
(15, 'Cahors Malbec A.O.P. Rouge ', 2014, 'Frankrijk', 'rood', '2628.jpg', 'w2628', '11.00'),
(16, 'Bel Colle Le Masche Barbera', 2010, 'Italie', 'rood', '25651.jpg', 'w2565-1', '13.00'),
(17, 'Baccolo Appasimento', 2011, 'Italie', 'rood', '0619.jpg', 'w0619', '9.00'),
(18, 'Chianti dei Colli Senesi', 2015, 'Italie', 'rood', '0611.jpg', 'w0611', '8.00'),
(19, 'Biologisch: Les Hauts', 2012, 'Frankrijk', 'rose', '2502.jpg', 'w2502', '6.00'),
(20, 'Cabernet de Saumur A.C. ', 2013, 'Frankrijk', 'rose', '6112-1.jpg', 'w6112-1', '8.00'),
(21, 'Chateau DAngles', 2014, 'Frankrijk', 'rose', '2516.jpg', 'w2516', '5.00'),
(22, 'Bardolino Chiaretto', 2012, 'Italie', 'rose', '2584.jpg', 'w2584', '9.00'),
(23, 'Il Saporito Raboso', 2013, 'Italie', 'rose', '0610.jpg', 'w0610', '8.00'),
(24, 'Galcibar Rosado', 2015, 'Spanje', 'rose', '0566.jpg', 'w0566', '11.00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`idbestel`),
  ADD KEY `klant_fk` (`idklant`);

--
-- Indexen voor tabel `bestelreg`
--
ALTER TABLE `bestelreg`
  ADD PRIMARY KEY (`idbestreg`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`idklant`);

--
-- Indexen voor tabel `verpakking`
--
ALTER TABLE `verpakking`
  ADD PRIMARY KEY (`idverpak`);

--
-- Indexen voor tabel `wijnen`
--
ALTER TABLE `wijnen`
  ADD PRIMARY KEY (`idwijn`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `idbestel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `bestelreg`
--
ALTER TABLE `bestelreg`
  MODIFY `idbestreg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `idklant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `verpakking`
--
ALTER TABLE `verpakking`
  MODIFY `idverpak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `wijnen`
--
ALTER TABLE `wijnen`
  MODIFY `idwijn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `klant_fk` FOREIGN KEY (`idklant`) REFERENCES `klant` (`idklant`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
