-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 06:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utoolity`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ID` int(11) NOT NULL,
  `DeviceID` int(11) DEFAULT NULL,
  `ActivityType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ID`, `DeviceID`, `ActivityType`) VALUES
(1, 1, 'ACU On'),
(2, 1, 'ACU Off'),
(3, 2, 'Lights On'),
(4, 2, 'Lights Off'),
(5, 3, 'Remote On'),
(6, 3, 'Remote Off'),
(7, 4, 'Temperature Low'),
(8, 5, 'Temperature High'),
(9, 6, 'Chill'),
(10, 7, 'Pairing');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `ID` int(11) NOT NULL,
  `DeviceName` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`ID`, `DeviceName`, `State`) VALUES
(1, 'ACU', 'on'),
(2, 'Lights', 'off'),
(3, 'Remote', 'off'),
(4, 'Temperature', 'low'),
(5, 'Temperature', 'high'),
(6, 'Mode', 'chill'),
(7, 'Pair', 'paired');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ActivityID` int(11) DEFAULT NULL,
  `LogText` varchar(255) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`ID`, `UserID`, `ActivityID`, `LogText`, `Timestamp`, `Date`, `Time`) VALUES
(849, 7, 1, 'success', '2023-06-30 03:40:16', '2023-06-30', '11:40:16'),
(850, 7, 2, 'success', '2023-06-30 03:41:35', '2023-06-30', '11:41:35'),
(851, 7, 3, 'success', '2023-06-30 03:43:22', '2023-06-30', '11:43:22'),
(852, 7, 4, 'success', '2023-06-30 03:43:32', '2023-06-30', '11:43:32'),
(853, 7, 5, 'success', '2023-06-30 03:43:44', '2023-06-30', '11:43:44'),
(854, 7, 6, 'success', '2023-06-30 03:43:46', '2023-06-30', '11:43:46'),
(855, 7, 7, 'success', '2023-06-30 03:43:55', '2023-06-30', '11:43:55'),
(856, 7, 8, 'success', '2023-06-30 03:44:01', '2023-06-30', '11:44:01'),
(857, 7, 9, 'success', '2023-06-30 03:44:18', '2023-06-30', '11:44:18'),
(858, 7, 10, 'success', '2023-07-08 02:22:38', '2023-07-08', '10:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `temperature`
--

CREATE TABLE `temperature` (
  `ID` int(11) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temperature`
--

INSERT INTO `temperature` (`ID`, `Value`) VALUES
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `UserRole` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `FullName`, `UserRole`, `Status`) VALUES
(7, 'admin', '$2y$10$xd0WVdgJj29XHADefCauSOgSiXzhyh6daxx7hnsKsQl4gTQudpGTm', 'Comteq Admin CCBC', 'admin', 1),
(8, 'user', '$2y$10$94xOK3hjpBcoFcPawlQGI.bRE1KVF7O9zeOV8oYCG2ykdmsKjKWmm', 'Comteq Maintenance', 'user', 1),
(82, 'angelo', '$2y$10$z9fjWDzs0/ZXd5Ilys8C8OP59bY1Pnphddggy7fz17WFqcFB3HT3O', 'Angelo B. Joaquin', 'admin', 1),
(83, 'khenkenkenn', '$2y$10$vakj.u8Ke7pYyehv6aoO2.Q4QykMqVwCKbcwgvDD3OapFuw9MPoXW', 'John Kenneth', 'admin', 1),
(85, 'ronel', '$2y$10$Ki7N0uMTyRmMoIUX5amXM.oAyIiptkiALHXqzbEkaE6Q0YHMfn7ky', 'Ronel Rae Rafael', 'admin', 1),
(93, 'clarisse', '$2y$10$d27dbIUPTCsNJ0HnxxTIrepZeNbNz5lY/Lq4HNs7VqloROuK0M7du', 'Clarisse Avecilla', 'admin', 1),
(94, 'kenzera', '$2y$10$SHB3GW1oT.hTIKnUd55oZ.yXlPB0FQvYOKCcbJvKOH.h5EaQ6vWyq', 'Kenneth Lopez', 'admin', 1),
(95, '1234', '$2y$10$JFRN1n7w7Av9BgrDep93.O2VUhYMTKqvUlL7i2/kxh1rwaKD2hdeK', '123', 'admin', 0),
(96, 'asd', '$2y$10$PgWTGrYX3RJ0XhegM9hkpOE3Pl9zzdXaQBJa1Kkcb9cvRNDdfzq3i', 'asd', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DeviceID` (`DeviceID`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ActivityID` (`ActivityID`);

--
-- Indexes for table `temperature`
--
ALTER TABLE `temperature`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=863;

--
-- AUTO_INCREMENT for table `temperature`
--
ALTER TABLE `temperature`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`DeviceID`) REFERENCES `devices` (`ID`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`ActivityID`) REFERENCES `activities` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
