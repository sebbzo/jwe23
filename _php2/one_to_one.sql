-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Apr 2024 um 20:32
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `one_to_one`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeiter`
--

CREATE TABLE `arbeiter` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `KVID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `arbeiter`
--

INSERT INTO `arbeiter` (`ID`, `Name`, `KVID`) VALUES
(1, 'John', 2),
(2, 'Michael', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `krankenversicherung`
--

CREATE TABLE `krankenversicherung` (
  `ID` int(11) NOT NULL,
  `Provider` varchar(255) DEFAULT NULL,
  `Start_Datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `krankenversicherung`
--

INSERT INTO `krankenversicherung` (`ID`, `Provider`, `Start_Datum`) VALUES
(1, 'UKF', '2023-10-05'),
(2, 'WKK', '2023-12-06'),
(3, 'WKV', '2023-11-07');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `arbeiter`
--
ALTER TABLE `arbeiter`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `KVID` (`KVID`),
  ADD UNIQUE KEY `KVID_2` (`KVID`);

--
-- Indizes für die Tabelle `krankenversicherung`
--
ALTER TABLE `krankenversicherung`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `arbeiter`
--
ALTER TABLE `arbeiter`
  ADD CONSTRAINT `arbeiter_ibfk_1` FOREIGN KEY (`KVID`) REFERENCES `krankenversicherung` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
