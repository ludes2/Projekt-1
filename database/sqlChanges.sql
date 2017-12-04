-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Nov 2017 um 13:37
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `projekt1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `averages`
--

CREATE TABLE `averages` (
  `av_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dur_id` int(11) NOT NULL,
  `av_duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_id` int(11) NOT NULL,
  `av_latency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval_id` int(11) NOT NULL,
  `av_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `durations`
--

CREATE TABLE `durations` (
  `dur_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `durations` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `intervals`
--

CREATE TABLE `intervals` (
  `interval_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `intervals` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `latencies`
--

CREATE TABLE `latencies` (
  `lat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latencies` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`) VALUES
  (5, 'sa.lu@bluewin.ch', '$2y$10$1i2.EqYWwnabIloUGUj8kuBvp3m8hNkm7EVhOmi77k.v.UpweO8oa', 'Sandro', 'Luder');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `averages`
--
ALTER TABLE `averages`
  ADD PRIMARY KEY (`av_id`);

--
-- Indizes für die Tabelle `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`dur_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `intervals`
--
ALTER TABLE `intervals`
  ADD PRIMARY KEY (`interval_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `latencies`
--
ALTER TABLE `latencies`
  ADD PRIMARY KEY (`lat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `durations`
--
ALTER TABLE `durations`
  MODIFY `dur_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `durations`
--
ALTER TABLE `durations`
  ADD CONSTRAINT `durations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `intervals`
--
ALTER TABLE `intervals`
  ADD CONSTRAINT `intervals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `intervals` (`interval_id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `latencies`
--
ALTER TABLE `latencies`
  ADD CONSTRAINT `latencies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `latencies` (`lat_id`) ON DELETE CASCADE;
COMMIT;

--
-- User Martin hunzufügen (13.11.2017)
--
INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`) VALUES
  (1, 'martin-k@hotmail.ch', 'projekt1', 'Martin', 'Kieliger');

