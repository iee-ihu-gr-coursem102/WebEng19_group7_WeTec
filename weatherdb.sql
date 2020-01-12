-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1:3306
-- Χρόνος δημιουργίας: 10 Ιαν 2020 στις 07:04:13
-- Έκδοση διακομιστή: 5.7.23
-- Έκδοση PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `weatherdb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `favoriteTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keyword` varchar(100) CHARACTER SET utf8 NOT NULL,
  `weatherDateTime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `minTemp` float DEFAULT '0',
  `maxTemp` float DEFAULT '0',
  `pressure` float DEFAULT '0',
  `humidity` float DEFAULT '0',
  `icon` varchar(10) NOT NULL,
  `weatherDescription` varchar(100) CHARACTER SET utf8 NOT NULL,
  `windSpeed` float DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `favorites_ibfk_1` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `favorites`
--

INSERT INTO `favorites` (`ID`, `userID`, `favoriteTime`, `keyword`, `weatherDateTime`, `minTemp`, `maxTemp`, `pressure`, `humidity`, `icon`, `weatherDescription`, `windSpeed`) VALUES
(20, 11, '2020-01-08 14:19:19', 'thessaloniki2', '2020-01-12 15:00:00', 8.81, 8.81, 1028, 57, '01d', 'clear sky', 2.3),
(21, 11, '2020-01-08 14:24:49', 'serres1', '2020-01-10 18:00:00', 3.54, 3.54, 1024, 56, '01n', 'clear sky', 0.12),
(22, 12, '2020-01-08 14:27:25', 'κοζάνη', '2020-01-11 12:00:00', 6.15, 6.15, 1024, 57, '04d', 'broken clouds', 1.6);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `jobName` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `minTemp` float NOT NULL DEFAULT '0',
  `maxTemp` float NOT NULL DEFAULT '0',
  `minHumidity` float NOT NULL DEFAULT '0',
  `maxHumidity` float NOT NULL DEFAULT '0',
  `minWindSpeed` float NOT NULL DEFAULT '0',
  `maxWindSpeed` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `jobs`
--

INSERT INTO `jobs` (`ID`, `jobName`, `minTemp`, `maxTemp`, `minHumidity`, `maxHumidity`, `minWindSpeed`, `maxWindSpeed`) VALUES
(1, 'Ασφαλτόστρωση', 0, 100, 0, 95, 0, 17),
(2, 'Σκυροδέτηση', 0, 40, 0, 100, 0, 14),
(3, 'Τοποθέτηση Ικριωμάτων', 0, 100, 0, 100, 0, 13),
(4, 'Ελαιοχρωματισμός', 10, 42, 0, 70, 0, 14);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `privileged` tinyint(1) NOT NULL DEFAULT '0',
  `registrationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`ID`, `privileged`, `registrationTime`, `name`, `surname`, `birth`, `email`, `password`) VALUES
(7, 0, '2020-01-02 17:17:32', 'asd', 'asdfg', '2020-01-16', 'asdf@sdfg.com', '$2y$10$v.GMTDkfW4197wL1WPY0r.yDSNKrbK3V9/N8G6Mvpazuo2zrPF70K'),
(11, 1, '2020-01-07 23:35:18', 'Παύλος', 'Κωστούλας', '1981-04-17', 'pavlos_31328@hotmail.com', '$2y$10$DoB/QYZIr5h0h7uwFX1HTOvhKh8h62mosZUm1FOCGhTVY2epSET4i'),
(12, 0, '2020-01-08 14:26:54', 'Σωτήρης', 'Ράπτης', '1981-04-17', 'user@user.com', '$2y$10$65JdlbE8WQtesO5RdazJtec1YqV4ECT9G3B9i3L0/Lh6c0n9gROLW');

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
