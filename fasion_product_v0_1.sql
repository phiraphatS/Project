-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 08:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fasion_product_v0.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasion_product`
--

CREATE TABLE `fasion_product` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(55) NOT NULL COMMENT 'ชื่อสินค้า',
  `DETAIL` text DEFAULT NULL COMMENT 'รายละเอียด',
  `IN_STOCK` int(11) NOT NULL COMMENT 'จำนวนสินค้า',
  `PRICE` int(11) DEFAULT 0,
  `PRODUCT_TYPE` int(11) DEFAULT NULL,
  `IS_RECOMMEND` bit(1) DEFAULT b'0',
  `PROMPAY` varchar(255) DEFAULT NULL,
  `UPDATE_DT` date DEFAULT current_timestamp() COMMENT 'วันที่อัพเดต',
  `UPDATE_USER` varchar(55) DEFAULT NULL COMMENT 'รหัสผู้อัพเดตรายการ',
  `IS_DELETE` int(11) NOT NULL DEFAULT 0 COMMENT 'ลบ',
  `IS_ACTIVE` int(11) NOT NULL DEFAULT 1 COMMENT 'เปิดให้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasion_product`
--

INSERT INTO `fasion_product` (`ID`, `NAME`, `DETAIL`, `IN_STOCK`, `PRICE`, `PRODUCT_TYPE`, `IS_RECOMMEND`, `PROMPAY`, `UPDATE_DT`, `UPDATE_USER`, `IS_DELETE`, `IS_ACTIVE`) VALUES
(2, 'เสื้อผ้าผู้หญิง', 'เสื้อผ้าผู้หญิงใส่สบาย สวย', 500, 300, NULL, b'1', '000-654-5968', '2023-02-06', 'ADMIN01', 0, 1),
(3, 'เสื้อผ้าผู้หญิง2', 'เสื้อผ้าผู้หญิงใส่สบาย', 236, 600, NULL, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 1, 1),
(4, 'เสื้อผ้าผู้หญิง3', 'เสื้อผ้าผู้หญิงใส่สบาย', 400, 90, NULL, b'1', '000-654-5968', '2023-02-06', 'ADMIN01', 0, 1),
(5, 'เสื้อผ้าผู้หญิง4', 'เสื้อผ้าผู้หญิงใส่สบาย', 516, 300, NULL, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 1, 1),
(6, 'เสื้อผ้าผู้หญิง5', 'เสื้อผ้าผู้หญิงใส่สบาย', 516, 300, NULL, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 1, 1),
(7, 'เสื้อผ้าผู้หญิง', 'เสื้อผ้าผู้หญิงใส่สบาย สวย', 516, 300, NULL, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 1, 1),
(8, 'เสื้อผ้าผู้หญิง', 'เสื้อผ้าผู้หญิงใส่สบาย สวย', 516, 300, 1, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 0, 1),
(9, 'เสื้อผ้า Street', 'เสื้อผ้าผู้หญิงใส่เท่', 236, 600, 3, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 0, 1),
(10, 'เสื้อผ้าผู้หญิง', 'เสื้อผ้าผู้หญิงใส่สบาย สวย', 236, 90, 1, b'1', '000-654-5968', '2023-02-06', 'ADMIN01', 1, 1),
(11, 'เสื้อผ้าผู้หญิง', 'เสื้อผ้าผู้หญิงใส่สบาย', 516, 600, 3, b'0', '000-654-5968', '2023-02-06', 'ADMIN01', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fasion_user`
--

CREATE TABLE `fasion_user` (
  `ID` int(11) NOT NULL COMMENT 'ไอดี',
  `USER_NAME` varchar(20) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `PASSWORD` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `EMAIL` varchar(55) NOT NULL COMMENT 'อีเมล',
  `USER_TYPE` int(11) NOT NULL DEFAULT 2,
  `IS_ACTIVE` bit(1) NOT NULL DEFAULT b'1' COMMENT 'อนุญาติให้ใช้งาน',
  `IS_DELETE` bit(1) NOT NULL DEFAULT b'0' COMMENT 'บัญชีถูกลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasion_user`
--

INSERT INTO `fasion_user` (`ID`, `USER_NAME`, `PASSWORD`, `EMAIL`, `USER_TYPE`, `IS_ACTIVE`, `IS_DELETE`) VALUES
(3, 'ADMIN01', '81dc9bdb52d04dc20036dbd8313ed055', 'admin01@gmail.com', 1, b'1', b'0'),
(4, 'TEST01', '81dc9bdb52d04dc20036dbd8313ed055', 'test01@gmail.com', 2, b'1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `fasion_user_type`
--

CREATE TABLE `fasion_user_type` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(55) NOT NULL,
  `IS_ACTIVE` bit(1) NOT NULL DEFAULT b'1',
  `IS_DELETE` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasion_user_type`
--

INSERT INTO `fasion_user_type` (`ID`, `NAME`, `IS_ACTIVE`, `IS_DELETE`) VALUES
(1, 'ADMIN', b'1', b'0'),
(2, 'CUSTOMER', b'1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `file_temp`
--

CREATE TABLE `file_temp` (
  `ID` int(11) NOT NULL,
  `FILE_PATH` varchar(155) DEFAULT NULL,
  `FILE_NAME` varchar(155) DEFAULT NULL,
  `FILE_EXT` varchar(55) DEFAULT NULL,
  `FILE_TMPNAME` varchar(155) DEFAULT NULL,
  `FILE_SIZE` int(11) DEFAULT NULL,
  `FILE_TYPE` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_temp`
--

INSERT INTO `file_temp` (`ID`, `FILE_PATH`, `FILE_NAME`, `FILE_EXT`, `FILE_TMPNAME`, `FILE_SIZE`, `FILE_TYPE`) VALUES
(1, 'uploads/test1.jpg', 'test1.jpg', 'jpg', 'D:xampp	mpphp56ED.tmp', 42799, 0),
(2, 'uploads/test2.jpg', 'test2.jpg', 'jpg', 'D:xampp	mpphp664A.tmp', 170653, 0),
(3, 'uploads/03ac986bd3d5585165c73fbe68ff9bf3.jpg', '03ac986bd3d5585165c73fbe68ff9bf3.jpg', 'jpg', 'D:xampp	mpphp1EF7.tmp', 58268, 0),
(4, 'uploads/cef97101490e1a1cb2243c187c501be5.jpg', 'cef97101490e1a1cb2243c187c501be5.jpg', 'jpg', 'D:xampp	mpphp8505.tmp', 30051, 0),
(5, 'uploads/8497aadd0390525c22beb51eb16adcea.jpg', '8497aadd0390525c22beb51eb16adcea.jpg', 'jpg', 'D:xampp	mpphpE650.tmp', 58185, 0),
(6, 'uploads/cef97101490e1a1cb2243c187c501be5.jpg', 'cef97101490e1a1cb2243c187c501be5.jpg', 'jpg', 'D:xampp	mpphpA38E.tmp', 30051, 0),
(7, 'uploads/8497aadd0390525c22beb51eb16adcea.jpg', '8497aadd0390525c22beb51eb16adcea.jpg', 'jpg', 'D:xampp	mpphp4BB.tmp', 58185, 0),
(8, 'uploads/cef97101490e1a1cb2243c187c501be5.jpg', 'cef97101490e1a1cb2243c187c501be5.jpg', 'jpg', 'D:xampp	mpphp8D84.tmp', 30051, 0),
(9, 'uploads/03ac986bd3d5585165c73fbe68ff9bf3.jpg', '03ac986bd3d5585165c73fbe68ff9bf3.jpg', 'jpg', 'D:xampp	mpphp5F3E.tmp', 58268, 0),
(10, 'uploads/test1.jpg', 'test1.jpg', 'jpg', 'D:xampp	mpphpAD9F.tmp', 42799, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_file`
--

CREATE TABLE `product_file` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `FILE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_file`
--

INSERT INTO `product_file` (`ID`, `PRODUCT_ID`, `FILE_ID`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 4, 3),
(4, 5, 4),
(5, 6, 5),
(6, 7, 6),
(7, 8, 7),
(8, 9, 8),
(9, 10, 9),
(10, 11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_loading`
--

CREATE TABLE `product_loading` (
  `ID` int(11) NOT NULL,
  `USER_TEL` varchar(10) DEFAULT NULL,
  `ADDRESS` text NOT NULL,
  `USER_NAME` varchar(55) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QTY` int(11) NOT NULL DEFAULT 0 COMMENT 'จำนวน',
  `STATUS` varchar(55) NOT NULL DEFAULT 'wait_check_bills',
  `PATH_BILL` varchar(155) DEFAULT NULL,
  `UPDATED_DT` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_DT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_loading`
--

INSERT INTO `product_loading` (`ID`, `USER_TEL`, `ADDRESS`, `USER_NAME`, `PRODUCT_ID`, `QTY`, `STATUS`, `PATH_BILL`, `UPDATED_DT`, `CREATED_DT`) VALUES
(1, '0716545253', '11/111 สุคนธสวัสดิ์ 30 แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพฯ 10230', 'ADMIN01', 10, 10, 'wait_check_bills', NULL, '2023-02-18 17:00:00', '2023-02-18 17:00:00'),
(2, '0612865929', 'กรุงเทพฯ', 'TEST01', 2, 16, 'wait_verify', 'uploads/IC-Payment-Invoice-Template.jpg', '2023-02-24 03:41:56', '2023-02-23 21:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(55) NOT NULL,
  `UPDATE_DT` date NOT NULL DEFAULT current_timestamp(),
  `UPDATE_BY` varchar(55) NOT NULL,
  `IS_DELETE` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`ID`, `NAME`, `UPDATE_DT`, `UPDATE_BY`, `IS_DELETE`) VALUES
(1, 'แฟชั่นผู้หญิง', '2023-02-06', 'ADMIN01', b'0'),
(3, 'STREET', '2023-02-06', 'ADMIN01', b'0'),
(4, 'TEST', '2023-02-23', 'ADMIN01', b'1'),
(5, 'แฟชั่นผู้ชาย', '2023-02-23', '', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasion_product`
--
ALTER TABLE `fasion_product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fasion_user`
--
ALTER TABLE `fasion_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `fasion_user_type`
--
ALTER TABLE `fasion_user_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `file_temp`
--
ALTER TABLE `file_temp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_file`
--
ALTER TABLE `product_file`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_loading`
--
ALTER TABLE `product_loading`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasion_product`
--
ALTER TABLE `fasion_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fasion_user`
--
ALTER TABLE `fasion_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดี', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasion_user_type`
--
ALTER TABLE `fasion_user_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `file_temp`
--
ALTER TABLE `file_temp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_file`
--
ALTER TABLE `product_file`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_loading`
--
ALTER TABLE `product_loading`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
