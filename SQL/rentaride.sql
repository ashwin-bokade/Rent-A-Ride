-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 09:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentaride`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `bid` int(11) NOT NULL,
  `uno` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `baddress` text NOT NULL,
  `bphone` varchar(15) NOT NULL,
  `bemail` varchar(100) NOT NULL,
  `bp_url` varchar(500) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`bid`, `uno`, `bname`, `baddress`, `bphone`, `bemail`, `bp_url`, `state`, `city`, `rating`, `date`) VALUES
(14, 14, 'XYZ travelssfddg', 'margaodsf', '1234567890', 'xyz@gmail.com', 'business-profile/14.jpg', 'goa', 'margao', 4, '2022-12-19 11:40:37'),
(22, 16, 'asdasd', 'sedfsdf', '1234567899', 'awsd@asd.rdsfg', 'business-profile/16.jpg', 'Goa', 'Margao', NULL, '2022-12-19 17:12:11');

--
-- Triggers `business`
--
DELIMITER $$
CREATE TRIGGER `update_role` AFTER DELETE ON `business` FOR EACH ROW BEGIN
  UPDATE users
  SET role = 'user'
  WHERE uno = old.uno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `uno` int(11) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  `bookingid` int(11) NOT NULL,
  `bdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`uno`, `regno`, `total`, `fromdate`, `todate`, `status`, `rating`, `bookingid`, `bdate`) VALUES
(17, 'GA 08 DE 6556', 12000, '2022-12-01', '2022-12-22', 'active', 4, 1, '2022-12-22 10:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `uno` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `rating` int(11) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uno` int(11) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `p_url` varchar(500) DEFAULT NULL,
  `address` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(80) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uno`, `role`, `fname`, `lname`, `p_url`, `address`, `email`, `phone`, `password`, `date`) VALUES
(14, 'owner', 'Raj', 'Dessai', 'user-profile/14.jpg', 'sdf', 'test1@gmail.com', '1234567899', '7c222fb2927d828af22f592134e8932480637c0d', '2022-12-09 13:53:16'),
(15, 'user', 'Rita', 'Naik', 'user-profile/15.jpg', 'xyz', 'test2@gmail.com', '9876543210', 'a7d579ba76398070eae654c30ff153a4c273272a', '2022-12-09 13:54:12'),
(16, 'owner', 'Anish', 'Naik', 'user-profile/16.jpg', 'abc', 'test3@gmail.com', '1234567889', '7c222fb2927d828af22f592134e8932480637c0d', '2022-12-09 14:01:22'),
(17, 'user', 'Ashwin', 'Bokade', 'user-profile/17.jpg', 'serfsef', 'test4@gmail.com', '123456789954', '7c222fb2927d828af22f592134e8932480637c0d', '2022-12-09 16:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `bid` int(11) NOT NULL,
  `vbrand` varchar(100) NOT NULL,
  `vname` varchar(100) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `trans` varchar(50) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `fuel` varchar(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `imgurl` varchar(500) DEFAULT NULL,
  `details` text NOT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`bid`, `vbrand`, `vname`, `regno`, `type`, `trans`, `variant`, `fuel`, `rate`, `imgurl`, `details`, `rating`) VALUES
(14, 'tata', 'tiago', 'GA 04 DS 4321', 'car', 'automatic', 'hatchback', 'petrol', 2000, 'https://cdni.autocarindia.com/utils/imageresizer.ashx?n=https://cms.haymarketindia.net/model/uploads/modelimages/2%20Series%20CoupeModelImage.jpg&w=872&h=578&q=75&c=1', '', 1),
(14, 'honda', 'civics', 'GA 05 G 0256', 'car', 'automatic', 'sedan', 'diesel', 3000, 'vehicle-img/img_63b94518178c94.80066679503051399.jpg', 'asas', NULL),
(14, 'tata', 'scorpio', 'GA 08 DE 5566', 'car', 'automatic', 'sedan', 'diesel', 1000, 'https://imgd.aeplcdn.com/370x208/n/cw/ec/106257/venue-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75', 'wefwef efewfewf wefwfeef wef', 5),
(14, 'tata', 'tigor', 'GA 08 DE 6546', 'car', 'automatic', 'sedan', 'electric', 2000, 'https://imgd-ct.aeplcdn.com/393x221/n/cw/ec/32597/tata-altroz-right-front-three-quarter20.jpeg?q=75', 'wefwef efewfewf wefwfeef wef', 3),
(14, 'audi', 'a9', 'GA 08 DE 6556', 'car', 'automatic', 'hatchback', 'diesel', 500, 'https://imgd.aeplcdn.com/600x337/n/cw/ec/106785/exterior-right-front-three-quarter-2.jpeg?isig=0&q=75', 'wefwef efewfewf wefwfeef wef', 3),
(14, 'tata', 'scorpio', 'GA 08 DE 6566', 'car', 'manual', 'suv', 'petrol', 2000, 'https://cdni.autocarindia.com/utils/imageresizer.ashx?n=https://cms.haymarketindia.net/model/uploads/modelimages/Mahindra-Scorpio-N-300620221053.jpg&w=872&h=578&q=75&c=1', 'wefwef efewfewf wefwfeef wef', 5),
(14, 'audi', 'etron', 'GA 08 GF 1111', 'car', 'automatic', 'sedan', 'electic', 4000, 'https://imgd.aeplcdn.com/1200x900/n/cw/ec/47073/e-tron-gt-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75', 'sdfsdf sdfdsf', NULL),
(22, 'audi', 'etron', 'GA 08 GF 2222', 'car', 'automatic', 'sedan', 'electic', 3500, 'https://imgd.aeplcdn.com/1200x900/n/cw/ec/47073/e-tron-gt-exterior-right-front-three-quarter-2.jpeg?isig=0&q=75', 'sdfsdf sdfdsf', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `owner` (`uno`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `gives_on` (`regno`),
  ADD KEY `rented_by` (`uno`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review` (`uno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uno`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`regno`),
  ADD KEY `belongto` (`bid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `bookingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `owner` FOREIGN KEY (`uno`) REFERENCES `users` (`uno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `gives_on` FOREIGN KEY (`regno`) REFERENCES `vehicle` (`regno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rented_by` FOREIGN KEY (`uno`) REFERENCES `users` (`uno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review` FOREIGN KEY (`uno`) REFERENCES `users` (`uno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `belongto` FOREIGN KEY (`bid`) REFERENCES `business` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
