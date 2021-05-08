-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2021 at 03:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mak_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `mstr_prospek`
--

CREATE TABLE `mstr_prospek` (
  `id_pk_prospek` int(11) NOT NULL,
  `id_fk_rs` int(11) NOT NULL,
  `prospek_principle` varchar(100) NOT NULL,
  `total_price_prospek` varchar(100) NOT NULL,
  `notes_kompetitor` varchar(1000) NOT NULL,
  `notes_prospek` varchar(1000) NOT NULL,
  `funnel` varchar(100) NOT NULL,
  `estimasi_pembelian` date NOT NULL,
  `prospek_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mstr_prospek`
--
ALTER TABLE `mstr_prospek`
  ADD PRIMARY KEY (`id_pk_prospek`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mstr_prospek`
--
ALTER TABLE `mstr_prospek`
  MODIFY `id_pk_prospek` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;