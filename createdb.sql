-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Giu 19, 2017 alle 17:57
-- Versione del server: 5.6.35
-- Versione PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `registrations`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `conference`
--

CREATE TABLE `conference` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_bin NOT NULL,
  `code` varchar(128) COLLATE utf8_bin NOT NULL,
  `open` int(11) NOT NULL,
  `vendor` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `conference`
--

INSERT INTO `conference` (`id`, `title`, `code`, `open`, `vendor`) VALUES
(1, 'CHItaly 2017', 'chitaly2017', 0, 'test');

-- --------------------------------------------------------

--
-- Struttura della tabella `extra`
--

CREATE TABLE `extra` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `extra`
--

INSERT INTO `extra` (`id`, `conference_id`, `title`, `cost`) VALUES
(1, 1, 'Additional social dinner ticket', 60);

-- --------------------------------------------------------

--
-- Struttura della tabella `extra_participant`
--

CREATE TABLE `extra_participant` (
  `extra_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `extra_participant`
--

INSERT INTO `extra_participant` (`extra_id`, `participant_id`) VALUES
(1, 7),
(1, 9),
(1, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `regtype_id` int(11) DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `prefix` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `firstname` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `middlename` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `jobtitle` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `badge` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `company` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `addressline1` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `addressline2` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `zip` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `taxid` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `acm` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `meatfree` smallint(6) DEFAULT NULL,
  `fishfree` smallint(6) DEFAULT NULL,
  `shellfishfree` smallint(6) DEFAULT NULL,
  `eggfree` smallint(6) DEFAULT NULL,
  `milkfree` smallint(6) DEFAULT NULL,
  `animalfree` smallint(6) DEFAULT NULL,
  `glutenfree` smallint(6) DEFAULT NULL,
  `peanutfree` smallint(6) DEFAULT NULL,
  `wheatfree` smallint(6) DEFAULT NULL,
  `soyfree` smallint(6) DEFAULT NULL,
  `additionaldiet` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `state` int(11) NOT NULL,
  `ipaddress` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `closed` date DEFAULT NULL,
  `otp` varchar(128) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `participant`
--

INSERT INTO `participant` (`id`, `regtype_id`, `email`, `prefix`, `firstname`, `middlename`, `lastname`, `jobtitle`, `badge`, `company`, `country`, `addressline1`, `addressline2`, `city`, `zip`, `taxid`, `acm`, `meatfree`, `fishfree`, `shellfishfree`, `eggfree`, `milkfree`, `animalfree`, `glutenfree`, `peanutfree`, `wheatfree`, `soyfree`, `additionaldiet`, `state`, `ipaddress`, `closed`, `otp`) VALUES
(7, 2, 'spano.davide@gmail.com', 'Mr', 'Davide', 'Lucio', 'Spano', 'Job', 'Davide Spano', 'Università di Cagliari', 'IT', 'Addr 1', 'Addr 2', 'Cagliari', '09124', '12345', '123', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'None', 1, '::1', '0000-00-00', '123456789'),
(8, 2, 'spano.davide@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '0000-00-00', ''),
(9, 1, 'davide.spano@unica.it', 'Prof.', 'Davide', '', 'Spano', '', 'Davide spano', 'University of Cagliari', 'IT', 'Via Ospedale 72', '', 'Cagliari', '09124', '', '122344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '::1', NULL, NULL),
(10, 2, 'davide.spano@unica.it', '', 'Davide', '', 'Spano', '', 'Davide Spano', 'University of Cagliari', 'IT', 'Via Ospedale 72', '', 'Cagliari', '09124', '', '', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '', 0, '::1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `regType`
--

CREATE TABLE `regType` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `has_workshop` int(11) DEFAULT NULL,
  `available` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `regType`
--

INSERT INTO `regType` (`id`, `conference_id`, `title`, `cost`, `has_workshop`, `available`) VALUES
(1, 1, 'Main conference (early), ACM Member, with workshops', 340, 1, 1),
(2, 1, 'Main conference (early), Non-ACM Member, with workshops', 400, 1, 1),
(3, 1, 'Main conference (early), student, with workshops', 270, 1, 1),
(4, 1, 'Main conference (early), ACM Member, no workshops', 300, 1, 1),
(5, 1, 'Main conference (early), Non-ACM Member, no workshops', 360, 1, 1),
(6, 1, 'Main conference (early), student, no workshops', 230, 1, 1),
(7, 1, 'Workshop only (early)', 110, 1, 1),
(8, 1, 'Main conference, ACM Member, with workshops', 410, 1, 0),
(9, 1, 'Main conference, Non-ACM Member, with workshops', 470, 1, 0),
(10, 1, 'Main conference, student, with workshops', 310, 1, 0),
(11, 1, 'Main conference, ACM Member, no workshops', 360, 1, 0),
(12, 1, 'Main conference, Non-ACM Member, no workshops', 420, 1, 0),
(13, 1, 'Main conference, student, no workshops', 260, 1, 0),
(14, 1, 'Workshop only', 120, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `workshop`
--

CREATE TABLE `workshop` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `workshop`
--

INSERT INTO `workshop` (`id`, `conference_id`, `title`) VALUES
(1, 1, 'GHItaly17: 1st  Workshop on Games-Human Interaction'),
(2, 1, 'Designing, Implementing and Evaluating Mid-Air Gestures and Speech-Based Interaction'),
(3, 1, 'ICS Materials: Unfolding Expressive-Sensorial and Aesthetic Qualities of Interactive, Connected, and Smart Materials'),
(4, 1, 'HCI and education in a changing world: from school to public engagement');

-- --------------------------------------------------------

--
-- Struttura della tabella `workshop_participant`
--

CREATE TABLE `workshop_participant` (
  `workshop_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `workshop_participant`
--

INSERT INTO `workshop_participant` (`workshop_id`, `participant_id`) VALUES
(3, 7),
(1, 9),
(1, 10),
(2, 10);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_conference_fk` (`conference_id`);

--
-- Indici per le tabelle `extra_participant`
--
ALTER TABLE `extra_participant`
  ADD PRIMARY KEY (`extra_id`,`participant_id`),
  ADD KEY `ep_participant_fk` (`participant_id`);

--
-- Indici per le tabelle `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_regtype_fk` (`regtype_id`);

--
-- Indici per le tabelle `regType`
--
ALTER TABLE `regType`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_fk` (`conference_id`);

--
-- Indici per le tabelle `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_conference_fk` (`conference_id`);

--
-- Indici per le tabelle `workshop_participant`
--
ALTER TABLE `workshop_participant`
  ADD PRIMARY KEY (`workshop_id`,`participant_id`),
  ADD KEY `wp_participant_fk` (`participant_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `conference`
--
ALTER TABLE `conference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `regType`
--
ALTER TABLE `regType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT per la tabella `workshop`
--
ALTER TABLE `workshop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `extra`
--
ALTER TABLE `extra`
  ADD CONSTRAINT `extra_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `extra_participant`
--
ALTER TABLE `extra_participant`
  ADD CONSTRAINT `extra_participant_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `extra_participant_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`regtype_id`) REFERENCES `regtype` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `regType`
--
ALTER TABLE `regType`
  ADD CONSTRAINT `regtype_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `workshop`
--
ALTER TABLE `workshop`
  ADD CONSTRAINT `workshop_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `workshop_participant`
--
ALTER TABLE `workshop_participant`
  ADD CONSTRAINT `workshop_participant_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `workshop_participant_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`) ON UPDATE CASCADE;
