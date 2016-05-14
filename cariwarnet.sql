-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2016 at 10:58 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cariwarnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomment`
--

CREATE TABLE `tblcomment` (
  `com_warnet_id` int(8) NOT NULL,
  `com_mbr_id` int(8) NOT NULL,
  `com_desc` varchar(200) NOT NULL DEFAULT '',
  `com_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfasilitas`
--

CREATE TABLE `tblfasilitas` (
  `fsl_wrnet_id` int(8) NOT NULL,
  `fsl_id` int(8) NOT NULL,
  `fsl_typ` varchar(20) NOT NULL,
  `fsl_name` varchar(30) NOT NULL,
  `fsl_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `mbr_id` int(8) NOT NULL,
  `mbr_username` varchar(64) NOT NULL,
  `mbr_password` varchar(32) NOT NULL,
  `mbr_name` varchar(200) NOT NULL,
  `mbr_email` varchar(64) NOT NULL,
  `mbr_tempat_lhr` varchar(100) DEFAULT '',
  `mbr_tgl_lhr` datetime(6) NOT NULL,
  `mbr_phone` varchar(30) DEFAULT '',
  `mbr_mode` tinyint(4) DEFAULT '1',
  `mbr_img` longblob,
  `mbr_img_nm` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`mbr_id`, `mbr_username`, `mbr_password`, `mbr_name`, `mbr_email`, `mbr_tempat_lhr`, `mbr_tgl_lhr`, `mbr_phone`, `mbr_mode`, `mbr_img`, `mbr_img_nm`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin@cariwarnet.com', '', '2015-12-16 00:00:00.000000', '', 1, NULL, 'IMG_20140227_135334.jpg'),
(2, 'bukhari', 'tes', 'Bukhari Muslim', 'bukhari@cariwarnet.com', '', '1970-01-01 00:00:00.000000', '', 1, NULL, '6_1icecreamfloat.jpg'),
(3, 'New', 'new', 'New', 'test@test.com', '', '0000-00-00 00:00:00.000000', '', 1, NULL, ''),
(4, 'tes', 'tes', 'Testing', 'test@test.com', '', '0000-00-00 00:00:00.000000', '', 1, NULL, ''),
(6, 'makan', 'makan', 'enak', 'test@test.com', 'Test', '2015-12-11 00:00:00.000000', '', 1, NULL, ''),
(7, 'jay', 'jay', 'Jay Clarens', 'Clarens.Jay@gmail.com', 'Medan', '1995-12-13 00:00:00.000000', '', 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblrating`
--

CREATE TABLE `tblrating` (
  `mbr_id` int(8) NOT NULL,
  `wrnet_id` int(8) NOT NULL,
  `rate_val` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblwarnet`
--

CREATE TABLE `tblwarnet` (
  `wrnet_id` int(8) NOT NULL,
  `wrnet_owner` int(8) NOT NULL,
  `wrnet_name` varchar(64) NOT NULL,
  `wrnet_alamat` varchar(200) DEFAULT '',
  `wrnet_kota` varchar(50) DEFAULT '',
  `wrnet_phone` varchar(30) DEFAULT NULL,
  `wrnet_img` longblob,
  `wrnet_img_nm` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwarnet`
--

INSERT INTO `tblwarnet` (`wrnet_id`, `wrnet_owner`, `wrnet_name`, `wrnet_alamat`, `wrnet_kota`, `wrnet_phone`, `wrnet_img`, `wrnet_img_nm`) VALUES
(1, 1, 'Flux', 'Jln. S. Parman 104, Medan', '', '1', NULL, ''),
(2, 1, 'Level1CyberWorld', 'Gedung Parkir Kampus BINUS Anggrek LT.1', '', '1', NULL, ''),
(3, 1, 'Cyber Net', 'Jl. Darat No. 28', '', '1', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcomment`
--
ALTER TABLE `tblcomment`
  ADD PRIMARY KEY (`com_warnet_id`);

--
-- Indexes for table `tblmember`
--
ALTER TABLE `tblmember`
  ADD PRIMARY KEY (`mbr_id`),
  ADD UNIQUE KEY `mbr_username` (`mbr_username`);

--
-- Indexes for table `tblwarnet`
--
ALTER TABLE `tblwarnet`
  ADD PRIMARY KEY (`wrnet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcomment`
--
ALTER TABLE `tblcomment`
  MODIFY `com_warnet_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmember`
--
ALTER TABLE `tblmember`
  MODIFY `mbr_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblwarnet`
--
ALTER TABLE `tblwarnet`
  MODIFY `wrnet_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
