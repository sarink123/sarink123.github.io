-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2020 at 03:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlhh`
--

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

DROP TABLE IF EXISTS `distributor`;
CREATE TABLE IF NOT EXISTS `distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhà cung cấp ',
  `name` varchar(50) NOT NULL COMMENT 'tên nhà cung cấp',
  `email` varchar(50) NOT NULL COMMENT 'Email',
  `address` varchar(100) NOT NULL COMMENT 'địa chỉ',
  `phone` varchar(12) NOT NULL COMMENT 'số điện thoại',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `export`
--

DROP TABLE IF EXISTS `export`;
CREATE TABLE IF NOT EXISTS `export` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã phiếu xuất',
  `user_name` varchar(50) NOT NULL COMMENT 'tên nhân viên',
  `user_id` int(11) NOT NULL COMMENT 'mã nhân viên',
  `retailer_id` int(11) NOT NULL,
  `retailer_name` varchar(50) NOT NULL COMMENT 'tên cửa hàng',
  `address` varchar(100) NOT NULL COMMENT 'địa chỉ cửa hàng',
  `phone` varchar(12) NOT NULL COMMENT 'số điện thoại cửa hàng',
  `createdate` datetime DEFAULT NULL COMMENT 'ngày lập phiếu',
  `updatedate` datetime DEFAULT NULL COMMENT 'ngày cập nhật',
  PRIMARY KEY (`id`),
  KEY `export_fk_user` (`user_id`),
  KEY `export_fk_retailer` (`retailer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exportdetails`
--

DROP TABLE IF EXISTS `exportdetails`;
CREATE TABLE IF NOT EXISTS `exportdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `export_id` int(11) NOT NULL COMMENT 'mã phiếu xuất',
  `good_id` int(11) NOT NULL COMMENT 'mã hàng xuất',
  `good_name` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'tên hàng',
  `amount` int(11) NOT NULL COMMENT 'số lượng',
  `price` int(11) NOT NULL COMMENT 'đơn giá',
  `type` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'loại',
  `unit` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'đơn vị tính',
  PRIMARY KEY (`id`),
  KEY `details_fk_export` (`export_id`),
  KEY `details_fk_goods` (`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL COMMENT 'mã hàng',
  `name` varchar(50) NOT NULL COMMENT 'tên hàng',
  `amount` int(11) NOT NULL COMMENT 'số lượng',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT 'giá',
  `distributor_id` int(11) NOT NULL COMMENT 'mã cung cấp',
  `type` varchar(20) NOT NULL COMMENT 'loại',
  `unit` varchar(20) NOT NULL COMMENT 'đơn vị tính',
  `distributor_name` varchar(50) NOT NULL COMMENT 'tên nhà cung cấp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `distributor_id` (`distributor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `import`
--

DROP TABLE IF EXISTS `import`;
CREATE TABLE IF NOT EXISTS `import` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'mã phiếu nhập',
  `user_name` varchar(50) NOT NULL COMMENT 'tên nhân viên',
  `user_id` int(11) NOT NULL COMMENT 'mã nhân viên',
  `distributor_name` varchar(50) NOT NULL COMMENT 'tên nhà cung cấp',
  `address` varchar(100) NOT NULL COMMENT 'địa chỉ nhà cung cấp',
  `phone` varchar(12) NOT NULL COMMENT 'điện thoại nhà cung cấp',
  `createdate` datetime DEFAULT NULL COMMENT 'ngày tạo',
  `updatedate` datetime DEFAULT NULL COMMENT 'ngày cập nhật',
  PRIMARY KEY (`id`),
  KEY `import_fk_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `importdetails`
--

DROP TABLE IF EXISTS `importdetails`;
CREATE TABLE IF NOT EXISTS `importdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `import_id` int(11) NOT NULL COMMENT 'mã phiếu nhập',
  `good_id` int(11) NOT NULL COMMENT 'mã hàng',
  `goods_name` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'tên hàng ',
  `amount` int(11) NOT NULL COMMENT 'số lượng',
  `price` int(11) NOT NULL COMMENT 'đơn giá',
  `type` varchar(20) NOT NULL COMMENT 'loại ',
  `unit` varchar(20) NOT NULL COMMENT 'đơn vị tính',
  PRIMARY KEY (`id`),
  KEY `details_fk_import` (`import_id`),
  KEY `imdetails_fk_goods` (`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

DROP TABLE IF EXISTS `retailer`;
CREATE TABLE IF NOT EXISTS `retailer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã cửa hàng',
  `name` varchar(50) NOT NULL COMMENT 'tên cửa hàng',
  `email` varchar(50) NOT NULL COMMENT 'email',
  `address` varchar(100) NOT NULL COMMENT 'địa chỉ',
  `number` varchar(12) NOT NULL COMMENT 'số điện thoại',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã nhân viên',
  `username` varchar(50) NOT NULL COMMENT 'username',
  `password` varchar(50) NOT NULL COMMENT 'password ',
  `email` varchar(50) NOT NULL COMMENT 'email đăng ký',
  `fullname` varchar(50) NOT NULL COMMENT 'họ tên nhân viên',
  `createdate` datetime NOT NULL COMMENT 'ngày tạo ',
  `updatedate` datetime DEFAULT NULL COMMENT 'ngày cập nhật',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `export`
--
ALTER TABLE `export`
  ADD CONSTRAINT `export_fk_retailer` FOREIGN KEY (`retailer_id`) REFERENCES `retailer` (`id`),
  ADD CONSTRAINT `export_fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `exportdetails`
--
ALTER TABLE `exportdetails`
  ADD CONSTRAINT `details_fk_export` FOREIGN KEY (`export_id`) REFERENCES `export` (`id`),
  ADD CONSTRAINT `details_fk_goods` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`);

--
-- Constraints for table `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_fk_distributor` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`id`);

--
-- Constraints for table `import`
--
ALTER TABLE `import`
  ADD CONSTRAINT `import_fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `importdetails`
--
ALTER TABLE `importdetails`
  ADD CONSTRAINT `details_fk_import` FOREIGN KEY (`import_id`) REFERENCES `import` (`id`),
  ADD CONSTRAINT `imdetails_fk_goods` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
