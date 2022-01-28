-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2022 at 05:36 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Admin_ID`, `Admin_Email`, `Admin_EmpNo`, `Admin_Dept`, `FK_Admin_Login_ID`) VALUES
(1, 'musamirul@it.gmail', '344343', 'finance', 20);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `Billing_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Billing_Date` varchar(254) NOT NULL,
  `Billing_Time` varchar(254) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`BillAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_BillAdd_Cust_ID`) VALUES
(1, 'no 34455', 'klang', 'Kedah', 41222, 'Malaysia', 1),
(2, 'no 79 lorong ali', 'bandar baru klang', 'Selangor', 47000, 'Malaysia', 4),
(3, 'no 89', 'bandar baru', 'Selangor', 123455, 'Malaysia', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `Cart_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Cart_TimeStamp` varchar(254) NOT NULL,
  `Cart_Status` varchar(45) NOT NULL,
  `FK_Cart_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cart_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Cart_TimeStamp`, `Cart_Status`, `FK_Cart_Cust_ID`) VALUES
(10, '2022-01-17 03:32:53pm', 'payment_completed', 3),
(11, '2022-01-24 11:58:02pm', 'pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `Cart_Item_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Cart_Item_Qty` int(45) NOT NULL,
  `Cart_Item_Amount` double NOT NULL,
  `FK_Cart_ID` int(45) NOT NULL,
  `FK_Item_Product_ID` int(45) NOT NULL,
  `FK_Item_Seller_ID` int(45) NOT NULL,
  `FK_Item_Shipping_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cart_Item_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`Cart_Item_ID`, `Cart_Item_Qty`, `Cart_Item_Amount`, `FK_Cart_ID`, `FK_Item_Product_ID`, `FK_Item_Seller_ID`, `FK_Item_Shipping_ID`) VALUES
(6, 1, 30, 10, 50, 1, 2),
(7, 3, 30, 10, 50, 1, 2),
(8, 3, 19, 10, 49, 1, 2),
(9, 2, 19, 10, 49, 1, 2),
(10, 5, 150, 10, 51, 3, 3),
(11, 2, 30, 11, 50, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Name`, `Cust_DOB`, `Cust_Gender`, `Cust_Phone`, `Cust_Email`, `FK_Cust_Login_ID`) VALUES
(1, 'Ameirul Mustaqim bin omar', '2021-12-14', 'male', '0193071720', 'musamirul.kpj@gmail.com', 1),
(2, 'test', '2021-12-16', 'male', '0193071722', 'musamirul.kpj@gmail.com', 5),
(3, 'ameirul mustaqim', '2021-11-30', 'male', '0123456789', 'muss@kpjklang.com', 7),
(4, 'ali bin abu', '2022-01-06', 'male', '0193071722', 'mus@kpjklang.com', 12);

-- --------------------------------------------------------

--
-- Table structure for table `declaration`
--

DROP TABLE IF EXISTS `declaration`;
CREATE TABLE IF NOT EXISTS `declaration` (
  `Declaration_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Declaration_Name` varchar(45) NOT NULL,
  `Declaration_FileName` varchar(45) NOT NULL,
  `Declaration_File` varchar(254) NOT NULL,
  `Declaration_TimeStamp` varchar(45) NOT NULL,
  `FK_Declaration_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Declaration_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `declaration`
--

INSERT INTO `declaration` (`Declaration_ID`, `Declaration_Name`, `Declaration_FileName`, `Declaration_File`, `Declaration_TimeStamp`, `FK_Declaration_Cust_ID`) VALUES
(14, '123123123', 'dynamic_rpt_061221 (3).xls', '20220103003924_dynamic_rpt_061221 (3).xls', '2022-01-03 12:39:24am', 1),
(13, 'test123', 'instructions_for_use.pdf', '20220103003719_instructions_for_use.pdf', '2022-01-03 12:37:19am', 1),
(12, 'test1', 'instructions_for_use.pdf', '20220103003436_instructions_for_use.pdf', '2022-01-03 12:34:36am', 1),
(15, '123', 'instructions_for_use.pdf', '20220103004736_instructions_for_use.pdf', '2022-01-03 12:47:36am', 2),
(16, 'test1', 'instructions_for_use (1).pdf', '20220103214123_instructions_for_use (1).pdf', '2022-01-03 09:41:23pm', 1),
(17, 'ecommerce', 'E-Commerce Medicine.pdf', '20220117023842_E-Commerce Medicine.pdf', '2022-01-17 02:38:42am', 1),
(18, 'ecommerce', 'E-Commerce Medicine.pdf', '20220117024000_E-Commerce Medicine.pdf', '2022-01-17 02:40:00am', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_ID`, `username`, `password`, `role`) VALUES
(1, 'musamirul', 'qwerty30', 'customer'),
(2, 'test', '123', 'administrator'),
(3, 'testseller', '123', 'seller'),
(4, 'ameirul', 'qwerty30', 'customer'),
(5, 'mus', '123', 'customer'),
(7, 'amir', '123', 'customer'),
(12, 'ali', '123', 'customer'),
(11, 'pharmas', '123', 'seller'),
(19, 'admin1', '123', 'administrator'),
(18, 'administrator', '123', 'administrator'),
(20, 'admin2', '123', 'administrator'),
(21, 'bigpharma', '123', 'seller'),
(42, 'seller', '123', 'seller');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`Medical_ID`, `Blood_Group`, `Weight`, `Height`, `Alcohol`, `Smoking`, `Exercise`, `Illness`, `BMI`, `Surgery`, `FK_Med_Cust_ID`) VALUES
(1, 'A+', 41, 150, 'no', 'yes', 'yes', 'illness saya adalah', 18.22, 'surgery saya adalah', 3),
(3, 'AB-', 60, 190, 'yes', 'yes', 'yes', 'sakit ke tak sakit kan untung la', 16.62, 'surgery tak macamna untung', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `Order_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Order_No` int(254) NOT NULL,
  `Order_Status` varchar(45) NOT NULL,
  `Order_Amount` double NOT NULL,
  `FK_Order_ShipAdd_ID` int(45) NOT NULL,
  `FK_Order_BillAdd_ID` int(45) NOT NULL,
  `FK_Order_Cust_ID` int(45) NOT NULL,
  `FK_Order_Seller_ID` int(45) NOT NULL,
  `FK_Order_Cart_ID` int(45) NOT NULL,
  `FK_Order_Ship_ID` int(45) NOT NULL,
  PRIMARY KEY (`Order_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Order_No`, `Order_Status`, `Order_Amount`, `FK_Order_ShipAdd_ID`, `FK_Order_BillAdd_ID`, `FK_Order_Cust_ID`, `FK_Order_Seller_ID`, `FK_Order_Cart_ID`, `FK_Order_Ship_ID`) VALUES
(18, 2, 'payment_pending', 110, 6, 3, 3, 1, 11, 1),
(17, 1, 'payment_completed', 765, 6, 3, 3, 3, 10, 3),
(16, 1, 'payment_completed', 265, 6, 3, 3, 1, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Product_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(45) NOT NULL,
  `Product_Desc` text NOT NULL,
  `Product_Spec` text NOT NULL,
  `Product_Image` varchar(45) NOT NULL,
  `Product_Qty` int(45) NOT NULL,
  `Product_Type` varchar(45) NOT NULL,
  `Product_RecordType` varchar(45) NOT NULL,
  `Product_ExpiracyDate` varchar(45) NOT NULL,
  `Product_ManufacturerName` varchar(45) NOT NULL,
  `Product_SellingPrice` double NOT NULL,
  `Product_Tags` varchar(254) NOT NULL,
  `FK_Product_Seller_ID` int(45) NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Desc`, `Product_Spec`, `Product_Image`, `Product_Qty`, `Product_Type`, `Product_RecordType`, `Product_ExpiracyDate`, `Product_ManufacturerName`, `Product_SellingPrice`, `Product_Tags`, `FK_Product_Seller_ID`) VALUES
(50, 'product 2', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><span style=\"background-color: rgb(255, 255, 0);\">is simply dummy text of the printing </span>and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuri<b>es, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset shee</b>ts containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<ol><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">is simply dummy text of the printing and typesetting industry. </span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,</span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"> when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"> It has survived not only five centuries, but also the leap into electronic typesetting, </span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software </span></li><li><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">like Aldus PageMaker including versions of Lorem Ipsum.</span><br></li></ol>', 'img/1111.png', 19, 'control', 'yes', '2022-01-14', 'product 2', 30, 'panadol', 1),
(49, 'product 1', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 'img/123.PNG', 12, 'control', 'yes', '2022-01-14', 'product 1', 19, 'panadol', 1),
(51, 'fever pill', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 'img/hits2hang.PNG', 15, 'control', 'yes', '2022-01-19', 'fever manu', 150, 'fever', 3);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `Record_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Record_Timestamp` varchar(45) NOT NULL,
  `Record_File` varchar(254) NOT NULL,
  `Record_FileName` varchar(45) NOT NULL,
  `FK_Record_Product_ID` int(45) NOT NULL,
  `FK_Record_Cust_ID` int(45) NOT NULL,
  PRIMARY KEY (`Record_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`Record_ID`, `Record_Timestamp`, `Record_File`, `Record_FileName`, `FK_Record_Product_ID`, `FK_Record_Cust_ID`) VALUES
(1, '2022-01-03 09:43:04pm', '20220103214304_instructions_for_use (1).pdf', 'instructions_for_use (1).pdf', 0, 1),
(2, '2022-01-16 11:48:19pm', '20220116234819_CSharp+Book+2019+Refresh.pdf', 'CSharp+Book+2019+Refresh.pdf', 0, 1),
(3, '2022-01-17 02:51:08am', '20220117025108_cetaksijil.pdf', 'cetaksijil.pdf', 0, 1);

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
  `Seller_Registration_Status` varchar(45) NOT NULL,
  `FK_Seller_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Seller_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Seller_ID`, `Seller_Name`, `Seller_RegistrationNo`, `Seller_Phone`, `Seller_Address`, `Seller_BankAccName`, `Seller_BankAccNo`, `Seller_Registration_Status`, `FK_Seller_Login_ID`) VALUES
(1, 'pharma niaga', 123342323, '0193224748', 'lorong 5343 jalan 123', 'maybank', '123558437', 'Active', 11),
(2, 'big pharmacy', 53234252, '012834737', 'lorong pharmacy', 'rhb', '1234889123489', 'reqApproval', 21),
(3, 'seller sdn bhd', 1234444, '01233338747', 'lorong mohd tahir', 'cimb', '123334057487', 'Active', 42);

-- --------------------------------------------------------

--
-- Table structure for table `seller_shop`
--

DROP TABLE IF EXISTS `seller_shop`;
CREATE TABLE IF NOT EXISTS `seller_shop` (
  `Shop_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Shop_Desc` varchar(254) NOT NULL,
  `Shop_Img` varchar(254) NOT NULL,
  `Shop_Img_File` varchar(254) NOT NULL,
  `Shop_Cover` varchar(254) NOT NULL,
  `Shop_Cover_File` varchar(254) NOT NULL,
  `FK_Shop_Seller_ID` int(254) NOT NULL,
  PRIMARY KEY (`Shop_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_shop`
--

INSERT INTO `seller_shop` (`Shop_ID`, `Shop_Desc`, `Shop_Img`, `Shop_Img_File`, `Shop_Cover`, `Shop_Cover_File`, `FK_Shop_Seller_ID`) VALUES
(1, '', '20220129013408_sog order no.PNG', 'sog order no.PNG', '20220129013557_70619506_107291520659786_8722772007705378816_n.jpg', '70619506_107291520659786_8722772007705378816_n.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `Shipping_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Shipping_Method` varchar(254) NOT NULL,
  `Shipping_Price` double NOT NULL,
  `shipping_day` int(45) NOT NULL,
  PRIMARY KEY (`Shipping_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`Shipping_ID`, `Shipping_Method`, `Shipping_Price`, `shipping_day`) VALUES
(1, 'Standard Delivery', 4.5, 5),
(2, 'Same-day delivery', 50, 0),
(3, 'expedited shipping', 15, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`ShipAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_ShipAdd_Cust_ID`) VALUES
(3, 'no 39', 'klang', 'Selangor', 41222, 'Malaysia', 1),
(4, 'no 39', 'klang', 'Selangor', 41222, 'Malaysia', 1),
(5, 'no 39 lorong tahir', 'klang', 'Selangor', 41222, 'Malaysia', 4),
(6, 'no 70', 'klang', 'Selangor', 412555, 'Malaysia', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
CREATE TABLE IF NOT EXISTS `tracking` (
  `Tracking_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Tracking_Date` varchar(245) NOT NULL,
  `Tracking_Time` varchar(254) NOT NULL,
  `Tracking_Status` varchar(45) NOT NULL,
  `Tracking_EstimateDate` varchar(45) NOT NULL,
  `Tracking_EstimateTime` varchar(45) NOT NULL,
  `FK_Tracking_Order_ID` int(45) NOT NULL,
  `FK_Tracking_Ship_ID` int(45) NOT NULL,
  `FK_Tracking_Cust_ID` int(45) NOT NULL,
  `FK_Tracking_Seller_ID` int(45) NOT NULL,
  `FK_Tracking_Cart_ID` int(45) NOT NULL,
  PRIMARY KEY (`Tracking_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`Tracking_ID`, `Tracking_Date`, `Tracking_Time`, `Tracking_Status`, `Tracking_EstimateDate`, `Tracking_EstimateTime`, `FK_Tracking_Order_ID`, `FK_Tracking_Ship_ID`, `FK_Tracking_Cust_ID`, `FK_Tracking_Seller_ID`, `FK_Tracking_Cart_ID`) VALUES
(4, '23-01-2022', '12:09:23 pm', 'preparing', '24-01-2022', '12:09:23 pm', 16, 2, 3, 1, 10),
(3, '23-01-2022', '12:09:23 pm', 'preparing', '25-01-2022', '12:09:23 pm', 17, 3, 3, 3, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
