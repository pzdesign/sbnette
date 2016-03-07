-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 01. bře 2016, 17:10
-- Verze serveru: 10.1.9-MariaDB
-- Verze PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `sbnette`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `img` longtext NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `pin` tinyint(1) NOT NULL,
  `publish` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `events`
--

INSERT INTO `events` (`id`, `start`, `end`, `img`, `title`, `content`, `pin`, `publish`) VALUES
(5, '2016-03-02 12:00:00', '2016-03-09 23:00:00', '', 'Nová akce', '<p>Dovolujeme si V&aacute;s pozvat na na&scaron;&iacute; novou akci.</p>', 1, 1),
(6, '2016-03-12 19:00:00', '2016-03-13 00:00:00', '', 'Test akce 2', '<p>testtt</p>', 1, 1),
(7, '2016-03-01 00:00:00', '2016-03-02 00:00:00', 'bal1.png', 'top1. akce', '<p>top</p>\n<p>&nbsp;</p>', 1, 1),
(8, '2016-03-03 00:00:00', '2016-03-17 00:00:00', '', 'asdasd', '<p>asdasd</p>', 1, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
