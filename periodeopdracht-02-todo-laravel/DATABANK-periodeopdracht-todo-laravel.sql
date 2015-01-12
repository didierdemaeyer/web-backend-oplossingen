-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 12 jan 2015 om 03:43
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `periodeopdracht-todo-laravel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(10) unsigned NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `done` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Gegevens worden geëxporteerd voor tabel `items`
--

INSERT INTO `items` (`id`, `owner_id`, `name`, `done`, `created_at`, `updated_at`) VALUES
(7, 2, 'test', 0, '2015-01-11 13:57:48', '2015-01-11 13:57:48'),
(8, 2, 'test2', 1, '2015-01-11 13:57:52', '2015-01-11 13:57:52'),
(14, 1, 'Samenvatting voor marketing maken', 0, '2015-01-11 17:26:37', '2015-01-11 17:26:37'),
(15, 1, 'Compositing leerstof herhalen', 0, '2015-01-11 17:26:50', '2015-01-11 17:26:50'),
(16, 1, 'Periodeopdracht Todo in laravel maken', 1, '2015-01-11 17:27:14', '2015-01-11 17:27:14');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_10_005612_create_items_table', 1),
('2015_01_11_142719_create_users_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'didier@test.be', '$2y$10$KR5YxHloCOIOYXuSc/IvBOyHOe/guR7uyBMofh/Z3Oqf6JDQCuJmy', 'H5PKTfLWoqXEV51seO5sYpAw68Uy4iWd57OqZEEZonSEGjDOSe8s5jRhDzQD', '0000-00-00 00:00:00', '2015-01-12 01:37:09'),
(2, 'test@test.be', '$2y$10$P.8v3uhhymDYDu9SVLcg1.iJSvObrjgxth6QFPTR0QQA5wgs4z6Xe', 'YVDJXAj9zjkpdo7irLDBPMucGDf1ugZwmn7ZG8xx4TwVTNOLtDkka7yHzaAN', '0000-00-00 00:00:00', '2015-01-11 14:02:51'),
(3, 'test2@test.be', '$2y$10$gf/1GNRK8rj6KPK4nkdi7e8VO2MwIqZq128Ri4LfoJfGgdWec0fTC', 'MXmMg7xUcZn1uPO7SWk6rXlnBD3jIpNuWG51PkarcndGYT4Y2ggjkjjxu03M', '2015-01-11 14:03:05', '2015-01-11 14:09:41'),
(4, 'test3@test.be', '$2y$10$camZ7UpiPggpQvr3Y/uSbuDLrZIDMxif0ePhyTBoTJIQPvnbt7vBi', 'Wr7jnrPaWQM87bNtGQfAMmo4PNT49eOw2hYFgaPrq8kGVpJhw1pntnjuh9kf', '2015-01-11 14:04:10', '2015-01-11 14:09:10');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
