-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 05:09 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `usernameAdmin` varchar(45) NOT NULL,
  `passwordAdmin` varchar(45) NOT NULL,
  `foto` varchar(100) NOT NULL	
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detailkulakpulsa`
--

CREATE TABLE `detailkulakpulsa` (
  `id_detailkulakpulsa` int(11) NOT NULL,
  `id_pulsa` int(11) NOT NULL,
  `harga` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `infopenyedia`
--

CREATE TABLE `infopenyedia` (
  `id_infopenyedia` int(11) NOT NULL,
  `nama_cs` varchar(45) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jam_layanan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kulak_pulsa`
--

CREATE TABLE `kulak_pulsa` (
  `id_kulakpulsa` int(11) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_penyedia` int(11) NOT NULL,
  `id_detailkulakpulsa` int(11) NOT NULL,
  `publisher` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(11) NOT NULL,
  `namapenyedia` varchar(45) NOT NULL,
  `id_infopenyedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pulsa`
--

CREATE TABLE `pulsa` (
  `id_pulsa` int(11) NOT NULL,
  `namapulsa` varchar(100) NOT NULL,
  `nominal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detailkulakpulsa`
--
ALTER TABLE `detailkulakpulsa`
  ADD PRIMARY KEY (`id_detailkulakpulsa`),
  ADD KEY `id_pulsa` (`id_pulsa`);

--
-- Indexes for table `infopenyedia`
--
ALTER TABLE `infopenyedia`
  ADD PRIMARY KEY (`id_infopenyedia`);

--
-- Indexes for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  ADD PRIMARY KEY (`id_kulakpulsa`),
  ADD KEY `id_detailkulakpulsa` (`id_detailkulakpulsa`),
  ADD KEY `id_operator` (`id_operator`),
  ADD KEY `id_penyedia` (`id_penyedia`),
  ADD KEY `publisher` (`publisher`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`),
  ADD KEY `id_infopenyedia` (`id_infopenyedia`);

--
-- Indexes for table `pulsa`
--
ALTER TABLE `pulsa`
  ADD PRIMARY KEY (`id_pulsa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailkulakpulsa`
--
ALTER TABLE `detailkulakpulsa`
  MODIFY `id_detailkulakpulsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infopenyedia`
--
ALTER TABLE `infopenyedia`
  MODIFY `id_infopenyedia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  MODIFY `id_kulakpulsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pulsa`
--
ALTER TABLE `pulsa`
  MODIFY `id_pulsa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailkulakpulsa`
--
ALTER TABLE `detailkulakpulsa`
  ADD CONSTRAINT `detailkulakpulsa_ibfk_1` FOREIGN KEY (`id_pulsa`) REFERENCES `pulsa` (`id_pulsa`);

--
-- Constraints for table `kulak_pulsa`
--
ALTER TABLE `kulak_pulsa`
  ADD CONSTRAINT `kulak_pulsa_ibfk_1` FOREIGN KEY (`id_detailkulakpulsa`) REFERENCES `detailkulakpulsa` (`id_detailkulakpulsa`),
  ADD CONSTRAINT `kulak_pulsa_ibfk_2` FOREIGN KEY (`id_operator`) REFERENCES `operator` (`id_operator`),
  ADD CONSTRAINT `kulak_pulsa_ibfk_3` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`),
  ADD CONSTRAINT `kulak_pulsa_ibfk_4` FOREIGN KEY (`publisher`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD CONSTRAINT `penyedia_ibfk_1` FOREIGN KEY (`id_infopenyedia`) REFERENCES `infopenyedia` (`id_infopenyedia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
