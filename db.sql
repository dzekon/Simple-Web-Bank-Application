-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2020, 15:12
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
-- Struktura tabeli dla tabeli `account_transfer_log`
--

CREATE TABLE `account_transfer_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `number_account_send` char(26) NOT NULL,
  `number_account_receive` char(26) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `login` varchar(12) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `application`
--

CREATE TABLE `application` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('create_account','close_account','new_card') NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('wait','accept','reject') DEFAULT NULL,
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

--
-- Zrzut danych tabeli `bank_account`
--

INSERT INTO `bank_account` (`id`, `id_user`, `account_number`, `balance`) VALUES
(1, 1, '4444666688882222', 1500);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `card_number` char(16) NOT NULL,
  `cvv` int(11) NOT NULL,
  `duration` date NOT NULL,
  `balance` int(11) NOT NULL,
  `type` enum('credit','debit') DEFAULT NULL,
  `status` enum('inactive','active') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `card`
--

INSERT INTO `card` (`id`, `id_user`, `card_number`, `cvv`, `duration`, `balance`, `type`, `status`) VALUES
(1, 1, '1234987612349876', 101, '2024-01-01', 100, 'credit', 'active'),
(2, 1, '9876123498761234', 102, '2024-01-01', 150, 'debit', 'active');

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
-- Zrzut danych tabeli `user_bank`
--

INSERT INTO `user_bank` (`id`, `login`, `password`, `surname`, `lastname`, `pesel`, `street`, `house_number`, `zip_code`, `town`, `country`, `mail`, `telephone_number`, `status`) VALUES
(1, 'test', '12345', 'Paweł', 'Nowicki', '91010101201', 'Poznań', '10', '66-111', 'Poznań', 'Poland', 'pawel@wp.pl', '987654321', 'active'),
(2, 'admin', 'admin', 'Adam', 'Nowak', '91111111123', 'Warszawa', '30', '20-111', 'Warszawa', 'Poland', 'adam@wp.pl', '123456789', 'active');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `account_transfer_log`
--
ALTER TABLE `account_transfer_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `application`
--
ALTER TABLE `application`
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
-- Indeksy dla tabeli `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `application`
--
ALTER TABLE `application`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_bank`
--
ALTER TABLE `user_bank`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `account_transfer_log`
--
ALTER TABLE `account_transfer_log`
  ADD CONSTRAINT `account_transfer_log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_bank` (`id`);

--
-- Ograniczenia dla tabeli `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_bank` (`id`);

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
