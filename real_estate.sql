-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 11:01 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Dawit shenkutie', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `timePeriod` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `empId` varchar(20) CHARACTER SET utf8 NOT NULL,
  `custEmail` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `timePeriod`, `pid`, `empId`, `custEmail`) VALUES
(1, '2021-09-16', '8:00 AM - 10:00 AM', 3, 'agent/4499', 'ammanerme27@gmail.com'),
(3, '2021-09-16', '3:00 PM - 5:00 PM', 3, 'agent/4499', 'ammanerme27@gmail.com'),
(4, '2021-09-17', '10:00 AM - 12:00 PM', 10, 'agent/4499', 'ammanerme27@gmail.com'),
(6, '2021-09-17', '10:00 AM - 12:00 PM', 9, 'agent/9572', 'dawitzewdu00@gmail.com'),
(7, '2021-09-18', '3:00 PM - 5:00 PM', 3, 'agent/4499', 'ammanerme27@gmail.com'),
(8, '2021-09-19', '10:00 AM - 12:00 PM', 3, 'agent/4499', 'ammanerme27@gmail.com'),
(9, '2021-09-17', '10:00 AM - 12:00 PM', 3, 'agent/4499', 'dawitzewdu00@gmail.com'),
(16, '2021-10-16', '8:00 AM - 10:00 AM', 9, 'agent/4499', 'dawitzewdu00@gmail.com'),
(17, '2021-09-24', '8:00 AM - 10:00 AM', 3, 'agent/0000', 'dawitzewdu00@gmail.com'),
(18, '2021-10-06', '8:00 AM - 10:00 AM', 3, 'agent/0000', 'dawitzewdu00@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `CustMail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `propertyID` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `CustMail`, `propertyID`, `created`) VALUES
(0, '', 9, '2021-09-27 07:41:14'),
(0, 'dawitshenkutie@gmail.com', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empId` varchar(15) CHARACTER SET utf8 NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `city` varchar(20) NOT NULL,
  `subcity` varchar(50) NOT NULL,
  `woreda` int(3) NOT NULL,
  `kebele` int(3) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empId`, `firstName`, `lastName`, `email`, `type`, `password`, `DOB`, `city`, `subcity`, `woreda`, `kebele`, `gender`, `phone`) VALUES
('adm/0000', 'Nebil', 'Mohamed', 'dawitshenkutie@gmail.com', 'Admin', '$2y$10$4/zbHfdle.5nXDKQmuuXxOBl86W03sGHGnwERIvGWZ07pJbPiRf06', '0000-00-00', '', '', 0, 0, '', 946690749),
('adm/6288', '', '', 'dawitshenkutie@gmail.com', 'admin', '$2y$10$PpDd/nQDVhKhpVaPJGd/s.YIk9yJFq3M6g3EVZ3wOrtXOFr8cLeEK', '0000-00-00', '', '', 0, 0, '', 0),
('adm/7008', '', '', 'dawitshenkutie@gmail.com', 'admin', '$2y$10$zJhSsg2EjUxcVBZY3Nrqru.jQevZ6cTbYL62vGyKmFUFthL4AJqqm', '0000-00-00', '', '', 0, 0, '', 0),
('agent/0000', 'Dawit', 'Shenkutie', 'dawitshenkutie@yahoo.com', 'Field Agent', 'dave', '1998-09-17', '', 'D/B', 87, 9, 'Male', 946690749),
('agent/4499', 'Adonias', 'Nigussie', 'pandanigussie@gmail.com', 'Field Agent', '6879', '1999-12-04', 'Addis Ababa', 'Yeka', 2, 80, 'Male', 946690749),
('agent/5593', '', '', 'ammanerme27@gmail.com', 'Field Agent', '4175', '0000-00-00', '', '', 0, 0, '', 0),
('agent/9572', '', '', '', 'Field Agent', '6013', '0000-00-00', '', '', 0, 0, '', 0),
('sales/0000', 'dave', 'shenkutie', 'dawitshenkutie@yahoo.com', 'Office Sales', '$2y$10$grH/D2rJ6zS1TF0cpXNKBeV6FK9mQjOu59lcfYZWn1JkAhgErn2EC', '2021-10-08', 'aa', 'aa', 11, 80, 'Male', 946690749);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(10) NOT NULL,
  `link` varchar(255) NOT NULL,
  `pid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `link`, `pid`) VALUES
(1, 'dave.jpg', 3),
(4, '45-family-g10-738x1024.jpg', 6),
(9, 'property-9.jpg', 9),
(10, 'G+14, 77 Family.jpg', 10),
(11, 'ninty percent finished.jpg', 11),
(12, 'ninty percent finished floor.jpg', 11),
(13, 'ninty percent finished homes.jpg', 11),
(14, 'Capture.PNG', 12),
(15, 'bullbula.PNG', 12);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `subject`, `email`, `mobile`, `message`, `date`) VALUES
(1, 'Dawit', 'Dawit Zewdu', 'dawitzewdu00@gmail.com', '0947186055', 'message', '2021-09-27 12:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `property_title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `video` text NOT NULL,
  `locationLink` text NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `land_area` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `bedroom` varchar(255) NOT NULL,
  `kitchen` varchar(255) NOT NULL,
  `hall` varchar(255) NOT NULL,
  `registeredBy` varchar(15) CHARACTER SET utf8 NOT NULL,
  `keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `property_title`, `address`, `price`, `video`, `locationLink`, `property_type`, `land_area`, `description`, `image`, `date`, `bedroom`, `kitchen`, `hall`, `registeredBy`, `keywords`) VALUES
(3, '3B+G+20, 102 Family Mixed Use Apartment', 'Bole', '5790000', 'https://www.youtube.com/embed/BPyrqCxfEdo', 'https://www.google.com/maps/place/Gift+Real+Estate+(%E1%8C%8A%E1%8D%8D%E1%89%B5+%E1%88%AA%E1%88%8D+%E1%88%B5%E1%89%B4%E1%89%B5)/@8.9987099,38.7590441,15z/data=!4m2!3m1!1s0x0:0xc072e6b877772a7a?sa=X&ved=2ahUKEwjX2pS7vf7yAhWLsKQKHaEhAT0Q_BJ6BAheEAU', 'Apartment', '12.83', 'Sweet Living Rooms', 'null', '2021-09-28 21:17:37', '3', '1', '1', '', 'sweet living rooms'),
(6, 'Mixed Luxurious homes', 'Hayat', '4000000', 'https://youtu.be/a47UedDMey8', 'giftrealestate.com.et', 'Villa', '193', '70% up on signing of the contract and the remaining 30% (15% + 12% + 3%) based on work progress', 'null', '2021-08-16 19:28:10', '3', '1', '1', '', 'dave'),
(9, 'house 1674', 'Bole street, 6kilo', '134566', 'www.youtube', '1232', 'viilla', '123', 'very nice', 'null', '2021-08-20 07:05:59', '3', '1', '4', '', ''),
(10, 'G+14, 77 Family, Mixed Use Apartment', 'in front of Feres Bet around Hayat square', '5790000', 'https://www.youtube.com/embed/8jEIv9IJNcI', 'https://goo.gl/maps/e33JS8BDmwFheKA2A', 'Commercial & Residential Use', '138.53 ', '70% Down Payment for those who do not make a Payment under Bank Loan; and 50% down payment for those who made payment Under Bank Loan', 'null', '2021-09-14 12:57:44', '3', '3', '3', '', ''),
(11, 'Block C', '@ the top of cmc', '2713625', 'https://www.youtube.com/embed/BPyrqCxfEdo', 'https://www.google.com/maps/place/Gift+Real+Estate+(%E1%8C%8A%E1%8D%8D%E1%89%B5+%E1%88%AA%E1%88%8D+%E1%88%B5%E1%89%B4%E1%89%B5)/@8.9987099,38.7590441,15z/data=!4m2!3m1!1s0x0:0xc072e6b877772a7a?sa=X&ved=2ahUKEwjX2pS7vf7yAhWLsKQKHaEhAT0Q_BJ6BAheEAU', 'Apartments ', '85', '88% finished luxurious apartments ', 'null', '2021-09-25 09:16:57', '2', '1', '1', '', ''),
(12, 'Bulbula Apartment ', 'Bulbula, Bole Addis Ababa', '3500000', 'https://www.youtube.com/embed/F07cHMsbd4A', 'https://maps.app.goo.gl/oRQCgq9ozAP7kiv3A', 'Apartment', '14', 'Soresa Residence Located at Bole Bulbula Few minutes from Bole Airport Delivery in 30 DAYS Title Deed on hand Attractive payment plan Parking Available Elevators Intercom system Back up Generator', 'null', '2021-09-25 15:08:46', '3', '1', '4', '', 'Bulbula Bole Addis Ababa Soresa Residence Located at Bole Bulbula Few minutes from Bole Airport Delivery in 30 DAYS Title Deed on hand Attractive payment plan Parking Available Elevators Intercom system Back up Generator');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `custMail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `propertyId` int(11) NOT NULL,
  `kebeleId` varchar(10) DEFAULT NULL,
  `photograph` varchar(100) DEFAULT NULL,
  `payment` varchar(15) DEFAULT NULL,
  `reservedBy` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_stats`
--

CREATE TABLE `sales_stats` (
  `id` int(22) NOT NULL,
  `sales` int(22) NOT NULL,
  `month` varchar(25) NOT NULL,
  `pending_orders` int(55) NOT NULL,
  `revenue` int(55) NOT NULL,
  `Vistors` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(100) NOT NULL,
  `City` varchar(11) NOT NULL,
  `Phone` int(15) NOT NULL,
  `Subcity` varchar(11) NOT NULL,
  `Woreda` int(2) NOT NULL,
  `Kebele` int(2) NOT NULL,
  `Profile_image` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FirstName`, `LastName`, `Email`, `Password`, `City`, `Phone`, `Subcity`, `Woreda`, `Kebele`, `Profile_image`) VALUES
('Amanuel', 'Beyene', 'amanuelbeyene47@gmail.com', 'aman', '', 0, '', 0, 0, ''),
('aman', 'ermias', 'ammanerme27@gmail.com', '1234', '', 0, '', 0, 0, ''),
('Biruk', 'Fikre', 'burafikre1900@gmail.com', 'bura', '', 0, '', 0, 0, ''),
('Dawit', 'Shenkutie', 'dawitshenkutie@gmail.com', '$2y$10$gvbh3pw.MvwJ6aBJe/CmVOGk774SlT1KqMLyOLivGpT/szYK8g34K', 'Addis Ababa', 946690749, 'Addis kfle ', 99, 80, 'photo_2021-09-16_13-02-34.jpg'),
('dave', 'shenkutie', 'dawitzewdu00@gmail.com', '1234', '', 946690749, 'aa', 11, 80, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `empId` (`empId`),
  ADD KEY `custEmail` (`custEmail`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD KEY `custMail` (`custMail`),
  ADD KEY `propertyId` (`propertyId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`empId`) REFERENCES `employee` (`empId`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`custEmail`) REFERENCES `users` (`Email`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `property` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`custMail`) REFERENCES `users` (`Email`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`propertyId`) REFERENCES `property` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
