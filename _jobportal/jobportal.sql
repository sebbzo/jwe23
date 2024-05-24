-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 25. Mai 2024 um 00:31
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
(6, 'sebob2', '$2y$10$ni8ec3X.21kIvVgTJqkNv.ZfwcTEE.i6tZ6QQJp6xfN9HIkBBwzge'),
(7, 'sebob', '$2y$10$f1RPLU45pTmAIC14yhqgBeloGytil5EIFU.hslVKVV8gfEp54TsNS'),
(8, 'sebob3', '$2y$10$3E4MuhUVRpSmVSDQih8hXuodMpuk4TvPHgnyPryZzSRRrCmO94k1m'),
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
(7, 'FullStack Web-Entwickler (m/w)', 'to>day is your day! \r\nTO>DAY Experts Oberösterreich GmbH ist ein österreichisches Projektberatungsunternehmen, das sich auf ExpertInnen im IT-Bereich spezialisiert hat. Wir suchen laufend hochqualifizierte und erfahrene IT-Fachkräfte.', 'Abgeschlossene IT-Ausbildung oder fachspezifische Berufserfahrung', 'Salzburg', '38h', '2.600,- € / Monat', 17, 9, '2024-05-24 22:55:13', 'ja', '2024-05-25 00:13:55'),
(8, 'Grafikdesigner (m/w/d)', 'Kreatives Team sucht dich!', 'Ausbildung/Berufserfahrung im Bereich Grafik- & Mediendesign', 'Wien', '38,5h', '2.700,- € / Monat', 16, 7, '2024-05-24 22:55:13', 'ja', '2024-05-25 00:13:55'),
(9, 'Kellner mit Inkasso (m/w/d)', 'Für unseren Kunde, ein familiengeführtes Gasthaus/Hotel, suchen wir für den Standort Großgmain bei Salzburg einen motivierten Kellner mit Inkasso.', 'abgeschlossene Ausbildung als Restaurantfachmann/frau oder einschlägige Berufserfahrung', 'Klagenfurt', '45h/Woche', '4.00,- € / Monat', 18, 6, '2024-05-24 22:55:13', 'ja', '2024-05-25 00:13:55'),
(10, 'Sales- und Marketingleiter*in (m/w/d)', 'Du bist ein kreativer Kopf mit Verkaufsgeschick und Erfahrungen im Bereich Marketing? Unser 4-Sterne-Hotel mit Schwerpunkt Gesundheit, Wellness und Seminaren sucht ab sofort eine/n engagierte/n Sales- und Marketingleiter*in (m/w/d) mit frischen Ideen.', 'Erfahrung im Sales & Marketing', 'Bad Leonfelden', 'Vollzeit, Teilzeit', '2537,00 / Monat', 20, 8, '2024-05-24 22:55:13', 'ja', '2024-05-25 00:13:55'),
(11, 'Senior Lead Developer (w/m/d)', 'Wir verstärken unsere Teams an den Standorten Linz und Innsbruck und suchen einen Senior Lead Developer (w/m/d) auf Basis einer modernen Microservice-Architektur.', 'Du verfügst über sehr gute Kenntnisse in der Software-Architektur und bringst Leadership Skills mit', 'Linz', '40h / Woche', '70.000,00 € brutto / Jahr', 19, 9, '2024-05-24 22:55:13', 'ja', '2024-05-25 00:13:55');

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
(16, 'Grafikdesigner:in'),
(17, 'Webentwickler:in'),
(18, 'Kellner:in'),
(19, 'Programmierer:in'),
(20, 'Marketing-Spezialist:in');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `Benutzer ID` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Kategorie ID` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
