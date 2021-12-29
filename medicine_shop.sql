-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2021 at 05:11 PM
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
-- Database: `medicine_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `Admin_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Admin_Email` varchar(45) NOT NULL,
  `Admin_EmpNo` varchar(45) NOT NULL,
  `Admin_Dept` varchar(45) NOT NULL,
  `FK_Admin_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `Billing_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Billing_Date` date NOT NULL,
  `Billing_Time` time NOT NULL,
  `Billing_PaymentStatus` varchar(45) NOT NULL,
  `Billing_PaymentMethod` varchar(45) NOT NULL,
  `Billing_ReferenceNo` varchar(45) NOT NULL,
  `FK_Billing_Cust_ID` int(45) NOT NULL,
  `FK_Billing_Order_ID` int(45) NOT NULL,
  PRIMARY KEY (`Billing_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

DROP TABLE IF EXISTS `billing_address`;
CREATE TABLE IF NOT EXISTS `billing_address` (
  `BillAdd_ID` int(45) NOT NULL AUTO_INCREMENT,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zipcode` int(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `FK_BillAdd_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`BillAdd_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`BillAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_BillAdd_Cust_ID`) VALUES
(1, 'no 34455', 'klang', 'Kedah', 41222, 'Malaysia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `Cart_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Cart_No` int(45) NOT NULL,
  `Cart_Status` varchar(45) NOT NULL,
  `FK_Cart_Cart_Item_ID` int(45) NOT NULL,
  `FK_Cart_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cart_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `Cart_Item_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Cart_Item_Qty` int(45) NOT NULL,
  `Cart_Item_Amount` double NOT NULL,
  `FK_Item_Product_ID` int(45) NOT NULL,
  `FK_Item_Seller_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cart_Item_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Cust_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Cust_Name` varchar(45) NOT NULL,
  `Cust_DOB` varchar(45) NOT NULL,
  `Cust_Gender` varchar(45) NOT NULL,
  `Cust_Phone` varchar(45) NOT NULL,
  `Cust_Email` varchar(45) NOT NULL,
  `FK_Cust_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cust_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Name`, `Cust_DOB`, `Cust_Gender`, `Cust_Phone`, `Cust_Email`, `FK_Cust_Login_ID`) VALUES
(1, 'Ameirul Mustaqim', '2021-12-14', 'male', '0193071722', 'musamirul.kpj@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `declaration`
--

DROP TABLE IF EXISTS `declaration`;
CREATE TABLE IF NOT EXISTS `declaration` (
  `Declaration_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Declaration_File` varchar(45) NOT NULL,
  `Declaration_TimeStamp` timestamp(6) NOT NULL,
  `FK_Declaration_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Declaration_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `healthinfo`
--

DROP TABLE IF EXISTS `healthinfo`;
CREATE TABLE IF NOT EXISTS `healthinfo` (
  `HealthInfo_ID` int(45) NOT NULL AUTO_INCREMENT,
  `HealthInfo_Title` varchar(45) NOT NULL,
  `HealthInfo_Desc` longtext NOT NULL,
  `HealthInfo_TimeStamp` timestamp(6) NOT NULL,
  `HealthInfo_Author` varchar(45) NOT NULL,
  `FK_HealthInfo_Admin_ID` int(45) NOT NULL,
  PRIMARY KEY (`HealthInfo_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Login_ID` int(45) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`Login_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_ID`, `username`, `password`, `role`) VALUES
(1, 'musamirul', 'qwerty30', 'customer'),
(2, 'test', '123', 'administrator'),
(3, 'testseller', '123', 'seller'),
(4, 'ameirul', 'qwerty30', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

DROP TABLE IF EXISTS `medical_history`;
CREATE TABLE IF NOT EXISTS `medical_history` (
  `Medical_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Blood_Group` varchar(45) NOT NULL,
  `Weight` double NOT NULL,
  `Height` double NOT NULL,
  `Alcohol` varchar(45) NOT NULL,
  `Smoking` varchar(45) NOT NULL,
  `Exercise` varchar(45) NOT NULL,
  `Illness` varchar(45) NOT NULL,
  `BMI` double NOT NULL,
  `Surgery` varchar(45) NOT NULL,
  `FK_Med_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Medical_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `Order_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Order_Status` varchar(45) NOT NULL,
  `FK_Order_ShipAdd_ID` int(45) NOT NULL,
  `FK_Order_BillAdd_ID` int(45) NOT NULL,
  `FK_Order_Cust_ID` int(45) NOT NULL,
  `FK_Order_Cart_ID` int(45) NOT NULL,
  PRIMARY KEY (`Order_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Product_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(45) NOT NULL,
  `Product_Desc` varchar(45) NOT NULL,
  `Product_Image` varchar(45) NOT NULL,
  `Product_Qty` int(45) NOT NULL,
  `Product_Type` varchar(45) NOT NULL,
  `Product_RecordType` varchar(45) NOT NULL,
  `Product_ExpiracyDate` varchar(45) NOT NULL,
  `Product_ManufacturerName` varchar(45) NOT NULL,
  `Product_SellingPrice` double NOT NULL,
  `FK_Product_Seller_ID` int(45) NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `Record_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Record_Timestamp` timestamp(6) NOT NULL,
  `Record_File` varchar(45) NOT NULL,
  `FK_Record_Product_ID` int(45) NOT NULL,
  `FK_Record_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Record_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `Seller_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Seller_Name` varchar(45) NOT NULL,
  `Seller_RegistrationNo` int(45) NOT NULL,
  `Seller_Phone` varchar(45) NOT NULL,
  `Seller_Address` varchar(255) NOT NULL,
  `Seller_BankAccName` varchar(45) NOT NULL,
  `Seller_BankAccNo` varchar(45) NOT NULL,
  `FK_Seller_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Seller_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

DROP TABLE IF EXISTS `shipping_address`;
CREATE TABLE IF NOT EXISTS `shipping_address` (
  `ShipAdd_ID` int(45) NOT NULL AUTO_INCREMENT,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zipcode` int(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `FK_ShipAdd_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`ShipAdd_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`ShipAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_ShipAdd_Cust_ID`) VALUES
(3, 'no 39', 'klang', 'Selangor', 41222, 'Malaysia', 1),
(4, 'no 39', 'klang', 'Selangor', 41222, 'Malaysia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
CREATE TABLE IF NOT EXISTS `tracking` (
  `Tracking_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Tracking_Date` date NOT NULL,
  `Tracking_Time` time NOT NULL,
  `Tracking_Status` varchar(45) NOT NULL,
  `Tracking_EstimateDate` varchar(45) NOT NULL,
  `Tracking_EstimateTime` varchar(45) NOT NULL,
  `FK_Tracking_Order_ID` int(45) NOT NULL,
  `FK_Tracking_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Tracking_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
