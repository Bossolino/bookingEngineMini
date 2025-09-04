-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 04, 2025 alle 13:02
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

--
-- Dump dei dati per la tabella `camere`
--

INSERT INTO `camere` (`id`, `nome`, `descrizione`, `capacita`, `prezzo_base`) VALUES
(1, 'Camera Singola Standard', 'Camera con letto singolo, ideale per viaggiatori solitari. Bagno privato incluso.', 1, 49.99),
(2, 'Camera Matrimoniale Deluxe', 'Camera spaziosa con letto matrimoniale, vista sul mare e balcone privato.', 2, 89.50),
(3, 'Suite Familiare', 'Ampia suite con due camere da letto e soggiorno, perfetta per famiglie.', 4, 149.00),
(4, 'Camera Doppia Economy', 'Camera con due letti singoli, soluzione economica ma confortevole.', 2, 59.00),
(5, 'Suite Luna di Miele', 'Suite romantica con vasca idromassaggio e bottiglia di prosecco in omaggio.', 2, 129.99);

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`id`, `nome_cliente`, `email_cliente`, `data_checkin`, `data_checkout`, `camera_id`) VALUES
(1, 'Mario Rossi', 'mario@example.com', '2025-08-10', '2025-08-12', 1),
(2, 'Luca Bianchi', 'luca@example.com', '2025-08-11', '2025-08-13', 5),
(3, 'Giulia Verdi', 'giulia@example.com', '2025-08-05', '2025-08-07', 2),
(4, 'Anna Neri', 'anna@example.com', '2025-08-08', '2025-08-10', 2),
(5, 'Francesco Blu', 'francesco@example.com', '2025-08-01', '2025-08-10', 3),
(6, 'Chiara Rosa', 'chiara@example.com', '2025-08-05', '2025-08-07', 3),
(7, 'Davide Gialli', 'davide@example.com', '2025-08-15', '2025-08-18', 4),
(8, 'Elisa Viola', 'elisa@example.com', '2025-08-19', '2025-08-21', 4),
(9, 'Laura Marrone', 'laura@example.com', '2025-08-20', '2025-08-25', 5),
(10, 'Alessio Grigio', 'alessio@example.com', '2025-08-24', '2025-08-27', 5),
(11, 'simone', 'simone@test.test', '2025-08-08', '2025-08-09', 1),
(14, 'Marco', 'Marco@test.test', '2025-08-20', '2025-08-21', 5),
(15, 'Giulia', 'giulia.lillo@example.test', '2025-08-07', '2025-08-19', 1),
(16, 'Roberto', 'rob.45@gmail.com', '2025-08-08', '2025-08-09', 1),
(34, 'Bob', 'bobob@example.com', '2025-09-14', '2025-09-17', 1),
(35, 'bob', 'bobob@example.com', '2025-09-23', '2025-09-24', 1),
(36, 'Lucia', 'luciii@example.com', '2025-09-04', '2025-09-05', 4),
(37, 'Giulia', 'giuli@example.com', '2025-09-30', '2025-10-04', 3),
(38, 'Giovanni', 'giovv.daloe@exaple.com', '2025-09-04', '2025-09-05', 1),
(40, 'Marco Polo', 'marco.polo@example.com', '2025-09-03', '2025-09-09', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
