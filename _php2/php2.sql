-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Mrz 2024 um 15:15
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `php2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `benutzername` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwort` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `benutzername_2` (`benutzername`),
  KEY `benutzername` (`benutzername`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `email`, `passwort`) VALUES
(1, 'herbert', NULL, '1234'),
(2, 'markus', 'markus@wifi.at', 'asdf'),
(3, 'sebastian', 'sebob@hotmail.com', '1234');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE IF NOT EXISTS `rezepte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beschreibung` text COLLATE utf8_unicode_ci,
  `benutzer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `titel` (`titel`),
  KEY `benutzer_id` (`benutzer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `zutaten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menge` float DEFAULT NULL,
  `einheit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kcal_pro_100` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `zutaten`
--

INSERT INTO `zutaten` (`id`, `titel`, `menge`, `einheit`, `kcal_pro_100`) VALUES
(1, 'Zwiebel', 1, 'Stk', 100),
(2, 'Mehl', 100, 'Gramm', 10),
(3, 'Eier', 1, 'Stk', 250);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten_zu_rezepte`
--

CREATE TABLE IF NOT EXISTS `zutaten_zu_rezepte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rezepte_id` int(10) unsigned NOT NULL,
  `zutaten_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zutaten_id` (`zutaten_id`),
  KEY `rezepte_id` (`rezepte_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `zutaten_zu_rezepte`
--

INSERT INTO `zutaten_zu_rezepte` (`id`, `rezepte_id`, `zutaten_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 2, 1);

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
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_2` FOREIGN KEY (`zutaten_id`) REFERENCES `zutaten` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_1` FOREIGN KEY (`rezepte_id`) REFERENCES `rezepte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
