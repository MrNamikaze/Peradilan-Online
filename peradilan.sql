-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2024 at 03:45 PM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mula7126_peradilan`
--

-- --------------------------------------------------------

--
-- Table structure for table `recognition`
--

CREATE TABLE `recognition` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL DEFAULT '1965-01-01',
  `alamat` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recognition`
--

INSERT INTO `recognition` (`id`, `nik`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `agama`) VALUES
(13, '1234', 'Syahrul', 'Tuban', '2023-08-03', 'Tuban', 'Islam'),
(14, '2345', 'Fadly', 'Bogor', '2023-08-05', 'Bogor', 'Islam'),
(16, '543278', 'imran', 'Jakarta', '2023-11-15', 'Jakarta', 'Islam'),
(19, '123', 'irwansyah', 'bogoe', '1997-11-27', 'Kp.Gugunung RT04', 'islam'),
(20, '123456', 'FADITYA', 'MALANG', '1981-02-16', 'JAKARTA', 'ISLAM'),
(21, '523123', 'Habibi', 'twawdwa', '2024-01-26', 'wdawad', 'dawadwawd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recognition`
--
ALTER TABLE `recognition`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recognition`
--
ALTER TABLE `recognition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
