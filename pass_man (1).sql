-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2023, 15:14
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pass_man`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `common_pass`
--

CREATE TABLE `common_pass` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `place` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `common_pass`
--

INSERT INTO `common_pass` (`id`, `id_user`, `place`, `login`, `password`, `create_date`) VALUES
(1, 1, 'Adobe- Photoshop', 'waszel@waszel.pl', 'waszel123', '2023-03-29 18:29:35'),
(2, 1, 'Photoshop', 'waszel@onet.pl', 'waszel123', '0000-00-00 00:00:00'),
(3, 1, 'global', 'waszel@wp.pl', 'waszel1313', '2023-03-22 07:29:35'),
(4, 1, 'Photoshop', 'waszel@onet.pl', 'waszel123', '0000-00-00 00:00:00'),
(5, 1, 'global', 'waszel@wp.pl', 'waszel1313', '2023-03-22 07:29:35');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `private_pass`
--

CREATE TABLE `private_pass` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `place` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `private_pass`
--

INSERT INTO `private_pass` (`id`, `id_user`, `place`, `login`, `password`, `create_date`) VALUES
(1, 1, 'Global', 'waszel@geo.pl', 'waszel1234', '2023-03-29 18:36:35'),
(2, 1, 'Global', 'waszel@geo.pl', 'waszel1234waasadjsd', '2023-03-29 18:36:35');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `surname`, `password`) VALUES
(1, 'waszel', 'Mikołaj', 'Waszel', '$2y$10$v/7QMIEFhUtus7V9f7.DBuZcA5wobAa/bSkEYc6q.kU2GNl.LW9nC'),
(2, 'tracz123', 'janusz', 'tracz', '$2y$10$k818WpyiGq1akYRyy6Ybie7xQRo5HVfYaSS1NaVvt3.DYq1JW4xma'),
(3, 'domi', 'Dominika', 'Mierzeja', '$2y$10$GKMMgsE84QT7I1uy162vzuidfnlPtf4bbpNh1Uf/6zoTgP1piDZ66');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `common_pass`
--
ALTER TABLE `common_pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `private_pass`
--
ALTER TABLE `private_pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `common_pass`
--
ALTER TABLE `common_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `private_pass`
--
ALTER TABLE `private_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `common_pass`
--
ALTER TABLE `common_pass`
  ADD CONSTRAINT `common_pass_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `private_pass`
--
ALTER TABLE `private_pass`
  ADD CONSTRAINT `private_pass_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
