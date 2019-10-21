-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2019 at 11:03 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kulak_pulsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kulak_pulsa`
--

CREATE TABLE `kulak_pulsa` (
  `id_kulakpulsa` int(11) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_penyedia` int(11) NOT NULL,
  `id_detailkulakpulsa` int(11) NOT NULL,
  `id_publisher` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kulak_pulsa`
--

INSERT INTO `kulak_pulsa` (`id_kulakpulsa`, `id_operator`, `id_penyedia`, `id_detailkulakpulsa`, `id_publisher`, `tanggal`) VALUES
(1, 2, 1, 2, 1, '2019-10-18'),
(2, 1, 1, 1, 1, '2019-10-16'),
(3, 1, 2, 2, 1, '2019-10-16'),
(4, 2, 2, 1, 1, '2019-10-16'),
(5, 1, 1, 1, 1, '2019-10-16'),
(6, 1, 2, 2, 1, '2019-10-16'),
(7, 2, 2, 1, 1, '2019-10-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  ADD PRIMARY KEY (`id_kulakpulsa`),
  ADD KEY `fk_operator_operator` (`id_operator`),
  ADD KEY `fk_penyedia_penyedia` (`id_penyedia`),
  ADD KEY `fk_detailkulakpulsa_detailkulakpulsa` (`id_detailkulakpulsa`),
  ADD KEY `fk_publisher_user` (`id_publisher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  MODIFY `id_kulakpulsa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  ADD CONSTRAINT `fk_detailkulakpulsa_detailkulakpulsa` FOREIGN KEY (`id_detailkulakpulsa`) REFERENCES `detailkulakpulsa` (`id_detailkulakpulsa`),
  ADD CONSTRAINT `fk_operator_operator` FOREIGN KEY (`id_operator`) REFERENCES `operator` (`id_operator`),
  ADD CONSTRAINT `fk_penyedia_penyedia` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`),
  ADD CONSTRAINT `fk_publisher_user` FOREIGN KEY (`id_publisher`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
