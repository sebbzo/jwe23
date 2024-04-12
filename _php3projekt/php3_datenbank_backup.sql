-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2024 um 20:12
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzer` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzer`, `passwort`, `email`) VALUES
(1, 'sebastian', '$2y$10$hnX/hSvSoMGncoa5d26fduCXTusAhmagQS0fe4EY.XsPg2xa6ArOC', 'wifi@sebastian.at');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeuge`
--

CREATE TABLE `fahrzeuge` (
  `id` int(10) UNSIGNED NOT NULL,
  `kennzeichen` varchar(50) NOT NULL,
  `marken_id` int(10) UNSIGNED NOT NULL,
  `farbe` varchar(255) NOT NULL,
  `baujahr` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `fahrzeuge`
--

INSERT INTO `fahrzeuge` (`id`, `kennzeichen`, `marken_id`, `farbe`, `baujahr`) VALUES
(1, 'S-5647', 1, 'Rot', '2015'),
(2, 'S-7384', 5, 'Gelb', '2020'),
(3, 'S-8594', 5, 'Grün', '2020');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `marken`
--

CREATE TABLE `marken` (
  `id` int(10) UNSIGNED NOT NULL,
  `marke` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `marken`
--

INSERT INTO `marken` (`id`, `marke`) VALUES
(1, 'Audi'),
(2, 'Volkswagen'),
(3, 'BMW'),
(4, 'Ford'),
(5, 'Kia');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzer` (`benutzer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fahrzeuge_ibfk_1` (`marken_id`);

--
-- Indizes für die Tabelle `marken`
--
ALTER TABLE `marken`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `marken`
--
ALTER TABLE `marken`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD CONSTRAINT `fahrzeuge_ibfk_1` FOREIGN KEY (`marken_id`) REFERENCES `marken` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
