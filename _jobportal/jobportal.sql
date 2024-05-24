-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 24. Mai 2024 um 15:34
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `jobportal`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `passwort`) VALUES
(6, 'bernhard', '$2y$10$ni8ec3X.21kIvVgTJqkNv.ZfwcTEE.i6tZ6QQJp6xfN9HIkBBwzge'),
(7, 'lukas', '$2y$10$f1RPLU45pTmAIC14yhqgBeloGytil5EIFU.hslVKVV8gfEp54TsNS'),
(8, 'thomas', '$2y$10$3E4MuhUVRpSmVSDQih8hXuodMpuk4TvPHgnyPryZzSRRrCmO94k1m'),
(9, 'root', '$2y$10$mDQqqR2nqkLjSpl.Dchpf.NhVel5b3YLpYz0i.LC0gahuBj8/HKA.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `qualifikation` varchar(255) NOT NULL,
  `dienstort` varchar(255) NOT NULL,
  `stundenausmass` varchar(255) NOT NULL,
  `gehalt` varchar(255) NOT NULL,
  `kategorie_id` int(10) UNSIGNED NOT NULL,
  `benutzer_id` int(10) UNSIGNED NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `sichtbar` varchar(10) NOT NULL DEFAULT 'ja',
  `aenderungsdatum` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `jobs`
--

INSERT INTO `jobs` (`id`, `titel`, `beschreibung`, `qualifikation`, `dienstort`, `stundenausmass`, `gehalt`, `kategorie_id`, `benutzer_id`, `datum`, `sichtbar`, `aenderungsdatum`) VALUES
(1, 'Webentwickler:in', 'Beschreibung', 'Studium oder FH', 'Salzburg', '40', '2800', 5, 7, '2024-05-04 00:00:00', 'ja', '2024-05-24 13:54:32'),
(2, 'Vertriebsinnendienst', 'Rechnungen erstellen und Kontakt mit Außendienstmitarbeitern.', 'Ausbildung', 'Salzburg', '40', '2800', 1, 7, '2024-05-04 10:09:43', 'nein', '2024-05-24 00:00:00'),
(3, 'xcvfhj', 'xcvghjfg', 'cv', 'xxckhhh', 'xcv', 'xcv', 1, 7, '2024-05-04 13:37:32', 'ja', '2024-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `kategorie`) VALUES
(1, 'Bau'),
(2, 'Bergbau / Rohstoffe / Glas / Keramik / Stein'),
(3, 'Büro / Marketing / Finanz / Recht / Sicherheit'),
(4, 'Chemie / Biotechnologie / Lebensmittel / Kunststoffe'),
(5, 'Elektrotechnik / Elektronik / Telekommunikation / IT'),
(6, 'Handel / Logistik / Verkehr'),
(7, 'Landwirtschaft / Gartenbau / Forstwirtschaft'),
(8, 'Maschinenbau / Kfz / Metall'),
(9, 'Medien / Grafik / Design / Druck / Kunst / Kunsthandwerk'),
(10, 'Reinigung / Hausbetreuung / Anlern- und Hilfsberufe'),
(11, 'Soziales / Gesundheit / Schönheitspflege'),
(12, 'Textil und Bekleidung / Mode / Leder'),
(13, 'Tourismus / Gastgewerbe / Freizeit'),
(14, 'Umwelt'),
(15, 'Wissenschaft / Bildung / Forschung und Entwicklung'),
(16, 'Webentwickler'),
(17, 'Elektriker');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- Indizes für die Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategorie_id` (`kategorie_id`),
  ADD KEY `Benutzer ID` (`benutzer_id`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `Benutzer ID` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Kategorie ID` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorien` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
