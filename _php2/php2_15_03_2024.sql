-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Mrz 2024 um 20:22
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
-- Datenbank: `php2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwort` varchar(255) NOT NULL,
  `anzahl_logins` int(11) NOT NULL,
  `last_login` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `email`, `passwort`, `anzahl_logins`, `last_login`) VALUES
(1, 'herbert', NULL, '$2y$10$hnX/hSvSoMGncoa5d26fduCXTusAhmagQS0fe4EY.XsPg2xa6ArOC', 12, '2024-03-15 19:47:04'),
(2, 'markus', 'markus@gmail.com', '$2y$10$QWbOK3FH.3pnCfWDJoUMeunVRa2wxZSMu6eLbUgDV5bbzK3QjgOOu', 0, NULL),
(3, 'sebastian', 'sebob@hotmail.com', '$2y$10$hnX/hSvSoMGncoa5d26fduCXTusAhmagQS0fe4EY.XsPg2xa6ArOC', 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE `rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL,
  `benutzer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `rezepte`
--

INSERT INTO `rezepte` (`id`, `titel`, `beschreibung`, `benutzer_id`) VALUES
(1, 'Kaiserschmarrn', 'Österreichische Spezialität', 1),
(2, 'Gulaschsuppe', 'Herzhaftes Fleischgericht', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten`
--

CREATE TABLE `zutaten` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) NOT NULL,
  `menge` float DEFAULT NULL,
  `einheit` varchar(50) DEFAULT NULL,
  `kcal_pro_100` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `zutaten`
--

INSERT INTO `zutaten` (`id`, `titel`, `menge`, `einheit`, `kcal_pro_100`) VALUES
(1, 'Zwiebel', 1, 'Stk', 100),
(2, 'Mehl', 100, 'Gramm', 10),
(3, 'Eier', 1, 'Stk', 250),
(4, '', 0, '', 0),
(5, 'Banane', 2, 'Stück', 200);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten_zu_rezepte`
--

CREATE TABLE `zutaten_zu_rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `rezepte_id` int(10) UNSIGNED NOT NULL,
  `zutaten_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `zutaten_zu_rezepte`
--

INSERT INTO `zutaten_zu_rezepte` (`id`, `rezepte_id`, `zutaten_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 2, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername_2` (`benutzername`),
  ADD KEY `benutzername` (`benutzername`);

--
-- Indizes für die Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titel` (`titel`),
  ADD KEY `benutzer_id` (`benutzer_id`);

--
-- Indizes für die Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zutaten_id` (`zutaten_id`),
  ADD KEY `rezepte_id` (`rezepte_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD CONSTRAINT `rezepte_ibfk_1` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_1` FOREIGN KEY (`rezepte_id`) REFERENCES `rezepte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_2` FOREIGN KEY (`zutaten_id`) REFERENCES `zutaten` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
