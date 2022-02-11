-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 feb 2022 om 22:40
-- Serverversie: 10.4.20-MariaDB
-- PHP-versie: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhlwebshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `auth_id` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hash_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `auth_id`, `email`, `username`, `hash_password`) VALUES
(1, 0, '', 'Chris', '$2y$10$hnxQlEUDZbDrUHFOpjGHdOn8q/wAAs3VRgoH/GdInouqwmLuLu2zS'),
(2, 0, '', 'abc', '$2y$10$e1XweoyUnKVpebQcqhO.wu9OUZKxegX0HVtSva6zcBdRSnKAIuHnm'),
(3, 0, '123@321', '321', '$2y$10$uoyTQZ6V7VmtT9EvWXwCHew31Nf.7GScrNjKWJUftaPSfRarbF.tO'),
(4, 0, 'test@a', 'test', '$2y$10$bheukFppASRYnUUWyistluaRveNkQBicMAuGL//Ht8.p6soRD1.am'),
(5, 0, 'a@a', 'admin', '$2y$10$ox0NbnD4XDTj9mOl5oMCm.wAmeDEW4JeZYMGUDLf5/WWqGjALjjkK'),
(6, 0, 'testing@a', 'abd', '$2y$10$BvLEOX/md91gjTAnXYLgYuN9wrT4g95Sx0FJUPUDzgnR.9XFBblQ2'),
(7, 0, 'mnabszv@a', 'sfha', '$2y$10$tTFvR.r2rwns8bc9OuCb7e.gtzjsXpEhhzrsj/PDwcVDMyO0vdTwu');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
