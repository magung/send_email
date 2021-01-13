-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2021 at 05:15 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `send_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_smtp`
--

CREATE TABLE `email_smtp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_smtp`
--

INSERT INTO `email_smtp` (`id`, `email`, `password`) VALUES
(1, 'agung@gmail.com', 'agung'),
(2, 'admajilapak@gmail.com', 'AdmAjiLapak2019');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `email_pengirim` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `email`, `subject`, `body`, `nama_pengirim`, `email_pengirim`, `status`, `created_at`) VALUES
(1, 'agung@andtechnolgy.mobi', 'agung tes', '<p>tes tes&nbsp;<strong>agung</strong></p>\r\n', 'agung', 'admajilapak@gmail.com', 'GAGAL', '2021-01-13 04:14:20'),
(2, 'agung040100@gmail.com', 'agung tes', '<p>tes tes&nbsp;<strong>agung</strong></p>\r\n', 'agung', 'admajilapak@gmail.com', 'GAGAL', '2021-01-13 04:14:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_smtp`
--
ALTER TABLE `email_smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_smtp`
--
ALTER TABLE `email_smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
