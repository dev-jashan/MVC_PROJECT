-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 04:33 AM
-- Server version: 8.0.20
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_market`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout_data`
--

CREATE TABLE `checkout_data` (
  `ID` int NOT NULL,
  `stock_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock_price` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int NOT NULL,
  `status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockcart`
--

CREATE TABLE `stockcart` (
  `ID` int NOT NULL,
  `stock_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock_open` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `UserID` int NOT NULL,
  `stock_qty` int NOT NULL,
  `stock_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockinfo`
--

CREATE TABLE `stockinfo` (
  `ID` int NOT NULL,
  `symbol` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `open` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `close` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `high` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `low` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stockinfo`
--

INSERT INTO `stockinfo` (`ID`, `symbol`, `open`, `close`, `high`, `low`) VALUES
(70, 'AAPL', '179.8800', '179.8400', '179.7100', '179.8800'),
(71, 'MSFT', '342.4200', '342.5000', '342.4000', '342.5700'),
(72, 'TQQQ', '167.1500', '167.1100', '167.0800', '167.2000'),
(73, 'TLT', '148.9600', '148.9600', '148.9600', '148.9600'),
(74, 'DIA', '360.2100', '360.2100', '360.2100', '360.2100'),
(75, 'SPY', '470.6000', '471.0000', '470.5800', '471.0000'),
(76, 'GOOG', '2973.5000', '2974.0000', '2973.5000', '2974.0000'),
(77, 'AMZN', '3441.0000', '3438.2100', '3438.2100', '3441.0000'),
(78, 'FB', '329.5000', '329.4500', '329.4000', '329.5000'),
(79, 'NVDA', '301.7000', '301.9000', '301.7000', '301.9300'),
(80, 'HD', '415.6000', '415.6000', '415.6000', '415.6000'),
(81, 'JNJ', '165.0000', '165.0000', '165.0000', '165.0000'),
(82, 'WMT', '141.0000', '140.9000', '140.9000', '141.0000'),
(83, 'BAC', '44.5000', '44.5300', '44.5000', '44.5300'),
(84, 'ADBE', '654.4500', '655.0000', '654.4500', '655.0000'),
(85, 'NFLX', '610.9500', '610.9500', '610.9500', '610.9500'),
(86, 'NKE', '168.8100', '168.8100', '168.8100', '168.8100'),
(87, 'ORCL', '102.5500', '102.7100', '102.5500', '102.7100'),
(88, 'PEP', '168.9700', '168.9700', '168.9700', '168.9700'),
(89, 'DHR', '317.4000', '317.4000', '317.4000', '317.4000'),
(90, 'CVX', '118.3900', '118.3900', '118.3900', '118.3900'),
(91, 'VZ', '50.1900', '50.1900', '50.1900', '50.1900'),
(92, 'QCOM', '183.7400', '184.0000', '183.7400', '184.0000'),
(93, 'ABBV', '125.3500', '125.3500', '125.3500', '125.3500'),
(94, 'MRK', '72.6300', '72.6300', '72.6300', '72.6300'),
(95, 'INTC', '50.5000', '50.4800', '50.4800', '50.5000'),
(96, 'WFC', '50.3000', '50.2000', '50.1700', '50.3100'),
(97, 'INTU', '677.9500', '677.9500', '677.9500', '677.9500'),
(98, 'MCD', '264.7200', '264.7200', '264.7200', '264.7200'),
(99, 'AMD', '138.3900', '138.3700', '138.3400', '138.4200'),
(100, 'UPS', '209.0800', '209.0800', '209.0800', '209.0800'),
(101, 'LOW', '261.3400', '261.4300', '261.3400', '261.4300'),
(102, 'ARVL', '7.7800', '7.8300', '7.7800', '7.8300'),
(103, 'SEED', '8.4050', '8.4400', '8.3950', '8.4600'),
(104, 'SREA', '27.2380', '27.2700', '27.2380', '27.2874'),
(105, 'RXRAW', '0.7500', '0.7500', '0.7500', '0.7500'),
(106, 'RYAAY', '100.4100', '100.4100', '100.4100', '100.4100'),
(107, 'RYH', '303.8649', '303.8649', '303.8649', '303.8649'),
(108, 'QUBT', '4.0100', '4.0100', '4.0100', '4.0100'),
(109, 'QUIK', '5.3800', '5.5300', '5.3650', '5.5300'),
(110, 'QTJL', '27.8400', '27.8600', '27.8400', '27.8600'),
(111, 'EZM', '55.0757', '55.1800', '55.0501', '55.1800'),
(112, 'ENLV', '6.5300', '6.6465', '6.5300', '6.6500'),
(113, 'BTU', '9.3600', '9.3600', '9.3600', '9.3600'),
(114, 'GYRO', '11.2550', '11.2550', '11.2550', '11.2550'),
(115, 'HAAC', '9.7600', '9.7600', '9.7600', '9.7600'),
(116, 'HAIL', '57.8111', '57.8400', '57.8111', '57.8533'),
(117, 'DOGZ', '5.2700', '5.3500', '5.2700', '5.3500'),
(118, 'TMAC', '9.7700', '9.7300', '9.7300', '9.7700'),
(119, 'PSA', '348.0000', '348.0000', '348.0000', '348.0000'),
(120, 'PRVB', '6.2000', '6.2000', '6.2000', '6.2000'),
(121, 'ONEY', '97.6600', '97.6600', '97.6600', '97.6600'),
(122, 'TSLA', '1012.8000', '1012.5200', '1011.7500', '1012.8500'),
(123, 'T', '22.8400', '22.8699', '22.8400', '22.8700'),
(124, 'TSM', '119.0900', '119.1500', '119.0000', '119.1500'),
(125, 'AA', '48.7600', '48.7600', '48.7600', '48.7600'),
(126, 'NRC', '42.4200', '42.4200', '42.4200', '42.4200'),
(127, 'LPL', '9.3000', '9.3000', '9.3000', '9.3000'),
(128, 'LFUS', '304.4900', '304.4900', '304.4900', '304.4900'),
(129, 'KMDA', '6.5300', '6.5400', '6.5000', '6.5400'),
(130, 'JANX', '19.5200', '19.7100', '19.3800', '19.8400'),
(131, 'IVOV', '168.1200', '168.5600', '168.1200', '168.5600'),
(132, 'IVES', '48.3000', '48.3000', '48.3000', '48.3000'),
(133, 'IT', '321.9900', '321.9900', '321.9900', '321.9900'),
(134, 'HEQT', '25.4400', '25.4150', '25.4150', '25.4400'),
(135, 'HDB', '65.3400', '65.3400', '65.3400', '65.3400'),
(136, 'HCI', '100.0000', '101.6100', '100.0000', '101.6200');

-- --------------------------------------------------------

--
-- Table structure for table `stocktbl`
--

CREATE TABLE `stocktbl` (
  `ID` int NOT NULL,
  `stock_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `d_o_p` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int NOT NULL,
  `UserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `ID` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `money` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`ID`, `name`, `password`, `email`, `money`) VALUES
(1, 'jashan', '$2y$10$p0FG4GUb7pWd8q77x5GaYuFawOfwTSJeDQNUoioe.PhhUMv1lxKr2', 'madanjashan0@gmail.com', '10000'),
(2, 'joe', '$2y$10$PlJZ05JHAWNiRyicK7ugB.7LB.VEiBuCfPKY3ljILjrHghIye4vD6', 'joe@gmail.com', '10000'),
(3, 'josh', '$2y$10$8SI5gOaV6GLn4d.yROam.ODPA/v3ktplKUr7YsERQ801c0F/3yMUi', 'josh@gmail.com', '10000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout_data`
--
ALTER TABLE `checkout_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stockcart`
--
ALTER TABLE `stockcart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stockinfo`
--
ALTER TABLE `stockinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stocktbl`
--
ALTER TABLE `stocktbl`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout_data`
--
ALTER TABLE `checkout_data`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockcart`
--
ALTER TABLE `stockcart`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockinfo`
--
ALTER TABLE `stockinfo`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `stocktbl`
--
ALTER TABLE `stocktbl`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
