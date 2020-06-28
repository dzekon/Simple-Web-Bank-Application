-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Cze 2020, 20:14
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `account_to_assign`
--

CREATE TABLE `account_to_assign` (
  `id` int(11) NOT NULL,
  `account_number` char(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `account_to_assign`
--

INSERT INTO `account_to_assign` (`id`, `account_number`) VALUES
(1, '68109024024167151871817148'),
(2, '64109024022636916547518772'),
(3, '70109024025814789312513987'),
(4, '38109024021753432985965623'),
(5, '88109024021311387997663758'),
(6, '95109024025692913616145791'),
(7, '69109024027462916126457626'),
(8, '87109024028342218149285384'),
(9, '90109024022514413912521563'),
(10, '22109024027945395457947887');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `account_transfer_log`
--

CREATE TABLE `account_transfer_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number_account_send` char(26) NOT NULL,
  `number_account_receive` char(26) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `application_card`
--

CREATE TABLE `application_card` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('debit','credit') NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('wait','accept') DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `application_user`
--

CREATE TABLE `application_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('create_account','close_account') NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('wait','accept') DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `account_number` char(26) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `card`
--

CREATE TABLE `card` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `card_number` char(16) NOT NULL,
  `cvv` int(11) NOT NULL,
  `duration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `card_to_assign`
--

CREATE TABLE `card_to_assign` (
  `id` int(11) NOT NULL,
  `type` enum('debit','credit') DEFAULT NULL,
  `card_number` char(16) NOT NULL,
  `cvv` int(11) NOT NULL,
  `duration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `card_to_assign`
--

INSERT INTO `card_to_assign` (`id`, `type`, `card_number`, `cvv`, `duration`) VALUES
(1, 'credit', '5103703652702808', 191, '2024-06-28'),
(2, 'credit', '2720991419741892', 152, '2024-06-28'),
(3, 'credit', '5174356703461793', 161, '2024-06-28'),
(4, 'credit', '2720992292262477', 178, '2024-06-28'),
(5, 'credit', '2720993816230776', 197, '2024-06-28'),
(6, 'credit', '5318098508591500', 611, '2024-06-28'),
(7, 'credit', '2720993816230776', 235, '2024-06-28'),
(8, 'credit', '5318098508591500', 611, '2024-06-28'),
(9, 'credit', '5335230358272142', 813, '2024-06-28'),
(10, 'credit', '5143456309604859', 291, '2024-06-28'),
(11, 'debit', '4024007123991076', 692, '2024-06-28'),
(12, 'debit', '4485489471572165', 543, '2024-06-28'),
(13, 'debit', '4024007198223033', 243, '2024-06-28'),
(14, 'debit', '4916134785793946', 363, '2024-06-28'),
(15, 'debit', '4929689464907591', 514, '2024-06-28'),
(16, 'debit', '4539834804545055', 225, '2024-06-28'),
(17, 'debit', '4024007147228893', 356, '2024-06-28'),
(18, 'debit', '4024007149873068', 447, '2024-06-28'),
(19, 'debit', '4831601990282628', 458, '2024-06-28'),
(20, 'debit', '4532394100126537', 979, '2024-06-28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_bank`
--

CREATE TABLE `user_bank` (
  `id` int(20) NOT NULL,
  `login` varchar(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `pesel` char(11) NOT NULL,
  `street` varchar(20) NOT NULL,
  `house_number` varchar(10) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `town` varchar(35) NOT NULL,
  `country` varchar(20) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone_number` varchar(15) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `account_to_assign`
--
ALTER TABLE `account_to_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `account_transfer_log`
--
ALTER TABLE `account_transfer_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `application_card`
--
ALTER TABLE `application_card`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `application_user`
--
ALTER TABLE `application_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `card_to_assign`
--
ALTER TABLE `card_to_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `account_to_assign`
--
ALTER TABLE `account_to_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `account_transfer_log`
--
ALTER TABLE `account_transfer_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `application_card`
--
ALTER TABLE `application_card`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `application_user`
--
ALTER TABLE `application_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `card`
--
ALTER TABLE `card`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `card_to_assign`
--
ALTER TABLE `card_to_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `user_bank`
--
ALTER TABLE `user_bank`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `application_user`
--
ALTER TABLE `application_user`
  ADD CONSTRAINT `application_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_bank` (`id`);

--
-- Ograniczenia dla tabeli `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_bank` (`id`);

--
-- Ograniczenia dla tabeli `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_bank` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
