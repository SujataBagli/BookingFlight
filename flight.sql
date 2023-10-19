-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 08:52 AM
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
-- Database: `flight`
--

-- --------------------------------------------------------

--
-- Table structure for table `flight_bookings`
--

CREATE TABLE `flight_bookings` (
  `id` int(11) NOT NULL,
  `flightId` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullAddress` varchar(50) NOT NULL,
  `cardType` varchar(50) NOT NULL,
  `billingAddress` varchar(50) NOT NULL,
  `isBooked` tinyint(4) NOT NULL DEFAULT 0,
  `bookingStatus` varchar(50) DEFAULT NULL,
  `bookedOn` datetime DEFAULT NULL,
  `cancelledOn` datetime DEFAULT NULL,
  `noOfPassengers` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_bookings`
--

INSERT INTO `flight_bookings` (`id`, `flightId`, `fname`, `lname`, `phone`, `email`, `fullAddress`, `cardType`, `billingAddress`, `isBooked`, `bookingStatus`, `bookedOn`, `cancelledOn`, `noOfPassengers`, `active`, `deleted`) VALUES
(1, 2, 'Jac', 'Dias', '9856562323', 'test@gmail.com', 'TT Apartment', 'credit', 'ZT- A 09', 0, 'Pending', '2023-10-16 00:00:00', '0000-00-00 00:00:00', '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_airlines`
--

CREATE TABLE `tbl_airlines` (
  `id` int(11) NOT NULL,
  `airline` varchar(50) NOT NULL,
  `airlineCode` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_airlines`
--

INSERT INTO `tbl_airlines` (`id`, `airline`, `airlineCode`, `active`, `deleted`) VALUES
(1, 'Jet Airways', '9W', 1, 0),
(2, 'Indigo', '6E', 1, 0),
(3, 'Air India', 'AI', 1, 0),
(4, 'Spice Jet', 'SG', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_airports`
--

CREATE TABLE `tbl_airports` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_airports`
--

INSERT INTO `tbl_airports` (`id`, `name`, `active`, `deleted`) VALUES
(1, 'PNQ', 1, 0),
(2, 'DEL', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flights`
--

CREATE TABLE `tbl_flights` (
  `id` int(11) NOT NULL,
  `airlineId` int(11) NOT NULL,
  `originAirportId` int(11) NOT NULL,
  `destAirportId` int(11) NOT NULL,
  `departureDate` datetime NOT NULL,
  `arrivalDate` datetime NOT NULL,
  `price` varchar(10) NOT NULL,
  `flightNumber` varchar(15) NOT NULL,
  `duration` varchar(15) DEFAULT NULL,
  `operationalDays` varchar(15) DEFAULT NULL,
  `availableSeats` int(5) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_flights`
--

INSERT INTO `tbl_flights` (`id`, `airlineId`, `originAirportId`, `destAirportId`, `departureDate`, `arrivalDate`, `price`, `flightNumber`, `duration`, `operationalDays`, `availableSeats`, `active`, `deleted`) VALUES
(1, 1, 1, 2, '2023-10-20 07:56:54', '2023-10-20 16:56:54', '6733', '186', '2h 33m', '6', 90, 1, 0),
(2, 2, 2, 1, '2023-10-25 07:56:54', '2023-10-26 07:56:54', '8713', '251', '3h 37m', '7', 256, 1, 0),
(3, 1, 2, 1, '2023-10-23 07:56:54', '2023-10-24 03:56:54', '6733', '556', '5h 33m', '6', 116, 1, 0),
(4, 3, 1, 2, '2023-10-31 07:56:54', '2023-11-01 01:56:54', '8713', '523', '2h 37m', '7', 53, 1, 0),
(5, 1, 1, 2, '2023-10-26 07:56:54', '2023-10-27 20:56:54', '6733', '186', '6h 33m', '5', 88, 1, 0),
(6, 4, 1, 2, '2023-10-20 07:56:54', '2023-10-22 16:56:54', '8713', '222', '10h 37m', '7', 53, 1, 0),
(7, 3, 2, 1, '2023-11-15 07:56:54', '2023-11-16 07:56:54', '6733', '186', '5h 33m', '0,2', 56, 1, 0),
(8, 2, 1, 2, '2023-10-28 07:56:54', '2023-10-29 11:32:54', '8713', '758', '2h 37m', '7', 53, 1, 0),
(9, 4, 2, 1, '2023-10-24 15:56:54', '2023-10-25 10:56:54', '6733', '325', '2h 33m', '0,2', 116, 1, 0),
(10, 4, 1, 2, '2023-10-30 07:56:54', '2023-10-31 23:56:54', '8713', '251', '7h 37m', '7', 45, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flight_bookings`
--
ALTER TABLE `flight_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flightId` (`flightId`),
  ADD KEY `phone` (`phone`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_airlines`
--
ALTER TABLE `tbl_airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_airports`
--
ALTER TABLE `tbl_airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_flights`
--
ALTER TABLE `tbl_flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airlineId` (`airlineId`),
  ADD KEY `originAirportId` (`originAirportId`),
  ADD KEY `destAirportId` (`destAirportId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `flight_bookings`
--
ALTER TABLE `flight_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_airlines`
--
ALTER TABLE `tbl_airlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_airports`
--
ALTER TABLE `tbl_airports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_flights`
--
ALTER TABLE `tbl_flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
