-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 09 jan 2018 om 13:47
-- Serverversie: 10.2.7-MariaDB
-- PHP-versie: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nikhixu248_ewa`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `research_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `research_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `research_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `picture` varchar(216) DEFAULT 'https://s-media-cache-ak0.pinimg.com/originals/a9/8d/33/a98d336578c49bd121eeb9dc9e51174d.png',
  `skills` varchar(45) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `role` int(11) DEFAULT 1,
  `like` int(11) DEFAULT 0,
  `birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `research`
--

CREATE TABLE `research` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `summary` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `image_url` varchar(216) DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg',
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `youtube_url` varchar(512) DEFAULT NULL,
  `cover_image` varchar(512) DEFAULT NULL,
  `finished` varchar(1) DEFAULT '\0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `abbreviation` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(400) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `ipadress` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_has_school`
--

CREATE TABLE `user_has_school` (
  `idUser` int(11) NOT NULL,
  `idSchool` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`,`user_id`,`research_id`),
  ADD KEY `fk_comment_profile1_idx` (`user_id`),
  ADD KEY `fk_comment_research1_idx` (`research_id`);

--
-- Indexen voor tabel `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`,`profile_id`,`research_id`),
  ADD KEY `fk_like_profile1_idx` (`profile_id`),
  ADD KEY `fk_like_research1_idx` (`research_id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_profile_user1_idx` (`user_id`),
  ADD KEY `fk_profile_school1_idx` (`school_id`);

--
-- Indexen voor tabel `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_research_profile1_idx` (`user_id`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_has_school`
--
ALTER TABLE `user_has_school`
  ADD PRIMARY KEY (`idUser`,`idSchool`),
  ADD KEY `school_idx` (`idSchool`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `research`
--
ALTER TABLE `research`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT voor een tabel `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `user_has_school`
--
ALTER TABLE `user_has_school`
  ADD CONSTRAINT `school` FOREIGN KEY (`idSchool`) REFERENCES `school` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
