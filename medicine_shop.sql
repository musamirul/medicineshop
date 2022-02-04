-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 04, 2022 at 05:17 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`BillAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_BillAdd_Cust_ID`) VALUES
(5, 'No 39, Lorong Raja Nong', 'Klang', 'Selangor', 41200, 'Malaysia', 17);

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Cart_TimeStamp`, `Cart_Status`, `FK_Cart_Cust_ID`) VALUES
(22, '2022-02-05 01:00:45am', 'pending', 17);

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
  `FK_Item_Record_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cart_Item_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`Cart_Item_ID`, `Cart_Item_Qty`, `Cart_Item_Amount`, `FK_Cart_ID`, `FK_Item_Product_ID`, `FK_Item_Seller_ID`, `FK_Item_Shipping_ID`, `FK_Item_Record_ID`) VALUES
(19, 5, 20, 22, 55, 7, 1, 0),
(17, 1, 50000, 22, 54, 7, 1, 11);

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
  `Cust_Status` varchar(254) NOT NULL,
  `FK_Cust_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Cust_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Name`, `Cust_DOB`, `Cust_Gender`, `Cust_Phone`, `Cust_Email`, `Cust_Status`, `FK_Cust_Login_ID`) VALUES
(17, 'Ameirul Mustaqim', '2010-01-06', 'male', '0193071722', 'musamirul.kpj@gmail.com', 'Active', 48);

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `declaration`
--

INSERT INTO `declaration` (`Declaration_ID`, `Declaration_Name`, `Declaration_FileName`, `Declaration_File`, `Declaration_TimeStamp`, `FK_Declaration_Cust_ID`) VALUES
(28, 'cert', 'OtherCert.pdf', '20220204234557_OtherCert.pdf', '2022-02-04 11:45:57pm', 17),
(24, 'Identity Card', 'ICCard.pdf', '20220204234251_ICCard.pdf', '2022-02-04 11:42:51pm', 17),
(25, 'sijil', 'cetaksijil.pdf', '20220204234411_cetaksijil.pdf', '2022-02-04 11:44:11pm', 17);

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
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_ID`, `username`, `password`, `role`) VALUES
(19, 'admin1', '123', 'administrator'),
(49, 'sterling', '123', 'seller'),
(48, 'ameirul', '123', 'customer');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`Medical_ID`, `Blood_Group`, `Weight`, `Height`, `Alcohol`, `Smoking`, `Exercise`, `Illness`, `BMI`, `Surgery`, `FK_Med_Cust_ID`) VALUES
(5, 'A+', 51, 170, 'yes', 'yes', 'yes', 'infection, shingles, proriasis', 17.65, 'cataract surgery, free skin graft', 17);

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Desc`, `Product_Spec`, `Product_Image`, `Product_Qty`, `Product_Type`, `Product_RecordType`, `Product_ExpiracyDate`, `Product_ManufacturerName`, `Product_SellingPrice`, `Product_Tags`, `FK_Product_Seller_ID`) VALUES
(55, 'prospan', '<p>When a chesty cough has become a family affair, consider Prospan a reliable cough remedy with a naturally sourced active ingredient that is suitable for both adults and children. When you want to take action, turn to Prospan for a clinically proven herbal cough medicine that can be given to the whole family&nbsp;</p><p>The non-drowsy, sugar-free formulation is reliable and very well tolerated, making it suitable for people of all ages.</p>', '<p><b>Features &amp; Benefits</b></p><ul><li>No added sugar</li><li>No added alcohol</li><li>No added colorings</li></ul><p><b>Dosage/How To Use</b></p><p>Unless otherwise prescribed.</p><p><b>Children &gt; 1 year old</b></p><p>Take 1 teaspoonful 3 times daily</p><p><b>School children and adolescents</b></p><p>Take 2 teaspoonsful 3 times daily</p><p><b>Adults</b></p><p>Take 2-3 teaspoonsful 3 times daily</p><p>PROSPAN F 100ML &amp; PROSPAN F COUGH SYRUP 21 STICK 5ML</p><p>These sticks packs are perfect single-dose sachets for your recovery on-the-go! Take 3 stick packs a day without having to miss a dosage anymore.</p>', 'img/prospan.jpg', 30, 'noncontrol', 'no', '2022-02-28', 'sterling', 20, 'prospan, cough syrup,', 7),
(54, 'Abraxane', '<p>Abraxane is used to treat advanced-stage breast cancer and usually is given:</p><p>The taxanes Taxol and Taxotere use solvents to dissolve paclitaxel the main ingredient so the medicine can enter the bloodstream. These solvents may make Taxol and Taxotere difficult to tolerate while being given. People usually take pre-medications to minimize reactions to the solvents. Instead of a solvent, the paclitaxel in Abraxane is suspended in albumin, a protein, which may make it easier to take without the need for pre-medication.<br></p>', '<p><b>Chemical name:</b> Albumin-bound or nab-paclitaxel</p><p><b>Class:</b> Taxane chemotherapy. Taxol and Taxotere are other taxanes.</p><p><b>How it works:</b> Taxanes interfere with the ability of cancer cells to divide.</p><p><b>Uses: </b>Abraxane typically is used to treat advanced-stage breast cancer and usually is given:</p><ul><li>in combination with other chemotherapy medicines</li><li>after other chemotherapy medicines given after surgery have stopped working</li></ul>', 'img/OralChemo.jpg', 15, 'control', 'yes', '2022-02-28', 'sterling', 50000, 'chemo, breast cancer, abraxane, taxane, chemotherapy', 7);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`Record_ID`, `Record_Timestamp`, `Record_File`, `Record_FileName`, `FK_Record_Product_ID`, `FK_Record_Cust_ID`) VALUES
(11, '2022-02-05 01:00:23am', '20220205010023_chemoPrescription.pdf', 'chemoPrescription.pdf', 0, 17),
(7, '2022-02-04 11:35:47pm', '20220204233547_PrescriptionDoc.pdf', 'PrescriptionDoc.pdf', 0, 17);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Seller_ID`, `Seller_Name`, `Seller_RegistrationNo`, `Seller_Phone`, `Seller_Address`, `Seller_BankAccName`, `Seller_BankAccNo`, `Seller_Registration_Status`, `FK_Seller_Login_ID`) VALUES
(7, 'Sterling Pharmacy', 25666421, '0333262598', 'Aeon Bukit Tinggi Shopping Centre, S21, Persiaran Batu Nilam 1/ks6, Bandar Bukit Tinggi 2, 41200 Klang', 'maybank', '2100025421534', 'Active', 49);

-- --------------------------------------------------------

--
-- Table structure for table `seller_shop`
--

DROP TABLE IF EXISTS `seller_shop`;
CREATE TABLE IF NOT EXISTS `seller_shop` (
  `Shop_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Shop_Desc` text NOT NULL,
  `Shop_Img` varchar(254) NOT NULL,
  `Shop_Img_File` varchar(254) NOT NULL,
  `Shop_Cover` varchar(254) NOT NULL,
  `Shop_Cover_File` varchar(254) NOT NULL,
  `FK_Shop_Seller_ID` int(254) NOT NULL,
  PRIMARY KEY (`Shop_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_shop`
--

INSERT INTO `seller_shop` (`Shop_ID`, `Shop_Desc`, `Shop_Img`, `Shop_Img_File`, `Shop_Cover`, `Shop_Cover_File`, `FK_Shop_Seller_ID`) VALUES
(4, '<p>Sterling Specialty Pharmacyâ€™s mission is to streamline patient access to critical specialty medications while prioritizing continuity of care, clinical excellence, and strategic partnerships.</p><p><b>Long-Term Care Pharmacy</b></p><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Sterling Long Term Care Pharmacyâ€™s mission is to provide innovative services and advocacy to the long-term care community by partnering with others who care.</span></p>', '20220205002027_sterling.png', 'sterling.png', '20220205002043_sterlingbanner.jpg', 'sterlingbanner.jpg', 7);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`ShipAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_ShipAdd_Cust_ID`) VALUES
(10, 'No 39, Lorong Raja Nong', 'Klang', 'Selangor', 41200, 'Malaysia', 17);

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
  `Tracking_Channel` varchar(254) NOT NULL,
  `Tracking_EstimateDate` varchar(45) NOT NULL,
  `Tracking_EstimateTime` varchar(45) NOT NULL,
  `FK_Tracking_Order_ID` int(45) NOT NULL,
  `FK_Tracking_Ship_ID` int(45) NOT NULL,
  `FK_Tracking_Cust_ID` int(45) NOT NULL,
  `FK_Tracking_Seller_ID` int(45) NOT NULL,
  `FK_Tracking_Cart_ID` int(45) NOT NULL,
  PRIMARY KEY (`Tracking_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_shipment`
--

DROP TABLE IF EXISTS `tracking_shipment`;
CREATE TABLE IF NOT EXISTS `tracking_shipment` (
  `Track_Ship_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Track_Ship_Status` varchar(254) NOT NULL,
  `Track_Ship_Date` varchar(254) NOT NULL,
  `Track_Ship_Time` varchar(254) NOT NULL,
  `FK_Tracking_ID` int(11) NOT NULL,
  PRIMARY KEY (`Track_Ship_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Transaction_Date` varchar(50) NOT NULL,
  `Transaction_Time` varchar(50) NOT NULL,
  `Transaction_Type` varchar(50) NOT NULL,
  `Transaction_Amount` double NOT NULL,
  `Transaction_Status` varchar(50) NOT NULL,
  `FK_Transaction_Wallet_ID` int(11) NOT NULL,
  `FK_Transaction_Seller_ID` int(11) NOT NULL,
  `FK_Transaction_Order_ID` int(11) NOT NULL,
  PRIMARY KEY (`Transaction_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `Wallet_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Wallet_Amount` double NOT NULL,
  `FK_Wallet_Seller_ID` int(11) NOT NULL,
  PRIMARY KEY (`Wallet_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`Wallet_ID`, `Wallet_Amount`, `FK_Wallet_Seller_ID`) VALUES
(3, 0, 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
