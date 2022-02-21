-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2022 at 04:53 PM
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
  `Admin_Name` varchar(254) NOT NULL,
  `Admin_Email` varchar(45) NOT NULL,
  `Admin_EmpNo` varchar(45) NOT NULL,
  `Admin_Dept` varchar(45) NOT NULL,
  `Admin_Status` varchar(45) NOT NULL,
  `FK_Admin_Login_ID` int(45) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Admin_ID`, `Admin_Name`, `Admin_Email`, `Admin_EmpNo`, `Admin_Dept`, `Admin_Status`, `FK_Admin_Login_ID`) VALUES
(1, 'Ameirul Mustaqim', 'musamirul@it.gmail', '344343', 'it', 'Active', 19),
(2, 'Dr Amran Musa', 'dramran@kpjklang.com', '12443837', 'consultant', 'active', 53);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`Billing_ID`, `Billing_Date`, `Billing_Time`, `Billing_PaymentStatus`, `Billing_PaymentMethod`, `Billing_ReferenceNo`, `FK_Billing_Cust_ID`, `FK_Billing_Order_ID`) VALUES
(17, '20-02-2022', '10:49:50 pm', 'completed', 'Online Banking', '84418641', 18, 43),
(16, '20-02-2022', '10:46:27 pm', 'completed', 'Online Banking', '74196007', 18, 3),
(15, '20-02-2022', '10:40:18 pm', 'completed', 'Online Banking', '95074547', 18, 2),
(14, '20-02-2022', '10:35:46 pm', 'completed', 'Online Banking', '65168441', 18, 39);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`BillAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_BillAdd_Cust_ID`) VALUES
(7, 'lorong 123', 'Parit Raja', 'Johor', 58738, 'Malaysia', 19),
(6, 'no 38, lorong haji abu', 'Bukit Tinggi', 'Selangor', 41230, 'Malaysia', 18),
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_ID`, `Cart_TimeStamp`, `Cart_Status`, `FK_Cart_Cust_ID`) VALUES
(43, '2022-02-20 10:49:50pm', 'payment_completed', 18),
(42, '2022-02-20 10:45:36pm', 'payment_completed', 18),
(40, '2022-02-20 10:35:46pm', 'payment_completed', 18),
(41, '2022-02-20 10:39:59pm', 'payment_completed', 18);

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
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`Cart_Item_ID`, `Cart_Item_Qty`, `Cart_Item_Amount`, `FK_Cart_ID`, `FK_Item_Product_ID`, `FK_Item_Seller_ID`, `FK_Item_Shipping_ID`, `FK_Item_Record_ID`) VALUES
(40, 1, 120, 43, 70, 8, 1, 19),
(39, 1, 110, 42, 69, 9, 1, 0),
(38, 1, 20, 42, 55, 7, 1, 0),
(37, 1, 35, 41, 56, 9, 1, 0),
(36, 1, 110, 41, 69, 9, 1, 0),
(35, 1, 110, 40, 69, 9, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `consult`
--

DROP TABLE IF EXISTS `consult`;
CREATE TABLE IF NOT EXISTS `consult` (
  `Consult_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Consult_RegDate` varchar(45) NOT NULL,
  `Consult_RegTime` varchar(45) NOT NULL,
  `Consult_Status` varchar(45) NOT NULL,
  `Consult_CompDate` varchar(45) NOT NULL,
  `Consult_CompTime` varchar(45) NOT NULL,
  `FK_Consult_Cust_ID` int(45) NOT NULL,
  `FK_Consult_Product_ID` int(45) NOT NULL,
  `FK_Consult_Admin_ID` int(45) NOT NULL,
  PRIMARY KEY (`Consult_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consult`
--

INSERT INTO `consult` (`Consult_ID`, `Consult_RegDate`, `Consult_RegTime`, `Consult_Status`, `Consult_CompDate`, `Consult_CompTime`, `FK_Consult_Cust_ID`, `FK_Consult_Product_ID`, `FK_Consult_Admin_ID`) VALUES
(3, '06-02-2022', '11:58:17 pm', 'complete', '07-02-2022', '10:54:41 pm', 18, 54, 1);

-- --------------------------------------------------------

--
-- Table structure for table `consultant_profile`
--

DROP TABLE IF EXISTS `consultant_profile`;
CREATE TABLE IF NOT EXISTS `consultant_profile` (
  `Consult_Profile_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Consult_Profile_Speciality` varchar(254) NOT NULL,
  `Consult_Profile_Education` varchar(254) NOT NULL,
  `Consult_Profile_Language` varchar(50) NOT NULL,
  `Consult_Profile_Phone` varchar(50) NOT NULL,
  `Consult_Profile_Experience` varchar(50) NOT NULL,
  `Consult_Profile_Img` varchar(254) NOT NULL,
  `FK_Consult_Profile_Admin_ID` int(11) NOT NULL,
  PRIMARY KEY (`Consult_Profile_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultant_profile`
--

INSERT INTO `consultant_profile` (`Consult_Profile_ID`, `Consult_Profile_Speciality`, `Consult_Profile_Education`, `Consult_Profile_Language`, `Consult_Profile_Phone`, `Consult_Profile_Experience`, `Consult_Profile_Img`, `FK_Consult_Profile_Admin_ID`) VALUES
(1, 'Neurologist, Internal Medicine', 'MD (USM), MRCP (UK), MRCP (Ireland), MSc. Clinical Neurology (London), Fellowship in Neurology (Malaysia)', 'English, Bahasa Melayu, Tamil', '017845957', '2000-02-03', '20220213200713_dramran.jpg', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Cust_Name`, `Cust_DOB`, `Cust_Gender`, `Cust_Phone`, `Cust_Email`, `Cust_Status`, `FK_Cust_Login_ID`) VALUES
(19, 'mus mus ameirul', '2021-09-01', 'male', '0193071722', 'musamirul.mus@gmail.com', 'Active', 54),
(18, 'mustaqim ameirul', '1998-02-04', 'male', '0193071723', 'musamirul.kpj@gmail.com', 'Active', 52),
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
  `HealthInfo_Img` varchar(254) NOT NULL,
  `HealthInfo_Date` varchar(45) NOT NULL,
  `HealthInfo_Time` varchar(45) NOT NULL,
  `HealthInfo_Tags` varchar(254) NOT NULL,
  `HealthInfo_Author` varchar(45) NOT NULL,
  `FK_HealthInfo_Admin_ID` int(45) NOT NULL,
  PRIMARY KEY (`HealthInfo_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthinfo`
--

INSERT INTO `healthinfo` (`HealthInfo_ID`, `HealthInfo_Title`, `HealthInfo_Desc`, `HealthInfo_Img`, `HealthInfo_Date`, `HealthInfo_Time`, `HealthInfo_Tags`, `HealthInfo_Author`, `FK_HealthInfo_Admin_ID`) VALUES
(11, 'COVID-19 vaccine among Malaysians', '<p><span style=\"background-color: rgba(var(--bs-body-bg-rgb),var(--bs-bg-opacity)); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Coronavirus disease 2019 or COVID-19 is caused by a newly discovered coronavirus, SARS-CoV-2. The Malaysian government has planned to procure COVID-19 vaccine through multiple agencies and companies in order to vaccinate at least 70% of the population. This study aimed to determine the knowledge, acceptance and perception of Malaysian adults regarding the COVID-19 vaccine.</span><br></p><p><b>Methodology</b></p><p>An online survey was conducted for two weeks in December 2020. A bilingual, semi-structured questionnaire was set up using Google Forms and the generated link was shared on social media (i.e., Facebook and WhatsApp). The questionnaire consisted of questions on knowledge, acceptance and perception of COVID-19 vaccine. The association between demographic factors with scores on knowledge about COVID-19 vaccine were analysed using the Mann-Whitney test for two categorical variables, and the Kruskal-Wallis test used for more than two categorical variables.</p><p><b>Results</b></p><p>A total of 1406 respondents participated, with the mean age of 37.07 years (SD = 16.05) years, and among them 926 (65.9%) were female. Sixty two percent of respondents had poor knowledge about COVID-19 vaccine (mean knowledge score 4.65; SD = 2.32) and 64.5% were willing to get a COVID-19 vaccine. High knowledge scores associated with higher education background, higher-income category and living with who is at higher risk of getting severe COVID-19. They were more likely to be willing to get vaccinated if they were in a lower age group, have higher education levels and were female.</p><p><b>Conclusion</b></p><p>Even though knowledge about vaccine COVID-19 is inadequate, the majority of the respondents were willing to get vaccinated. This finding can help the Ministry of Health plan for future efforts to increase vaccine uptake that may eventually lead to herd immunity against COVID-19.</p>', '20220211002155_vaccination.JPG', '11-02-2022', '12:21:55 am', 'vaccination, covid-19, coronavirus, sars', 'Mohd Dzulkhairi', 1),
(12, 'Coronary Heart Disease', '<p>If the human body were a machine, it would have been recalled by now. A case in point is the heart. The muscle itself is a marvel of engineering, a tireless pump that moves 75 gallons of blood every hour. But theres a glaring flaw in the system. The arteries that carry blood to the heart often become clogged, a condition called coronary heart disease or coronary artery disease. Its as if a car company designed the perfect engine but forgot to look at the fuel lines.</p><p>About 16 million Americans have coronary heart disease (CHD), and many of them will pay a high price. If the coronary arteries become too narrow, the heart wont get the oxygen or nutrients it needs to stay healthy. And if an artery becomes completely clogged, part of the heart will shut down. Doctors call this a myocardial infarction, but its better known as a heart attack. Over 450,000 people with CHD die of heart disease every year.</p><p><b>How does coronary heart disease occur?</b></p><p>The bloodstream is a highway for many substances, including cholesterol and other fats. Usually, these fats are harmless. But all too often, they can start sticking to the walls of the arteries, leaving less and less room for blood to flow. This condition is called atherosclerosis or hardening of the arteries. Atherosclerosis often gets its start when theres too much cholesterol in the blood. Anything that damages or inflames the arteries can also help set the disease in motion. Damaged arteries often become \"stickier,\" which speeds the buildup of plaque.</p><p><b>What are the symptoms of coronary heart disease</b></p><p>In its earliest stages, CHD is a silent disease. Some people never have symptoms, even as their arteries become dangerously clogged. Most people, however, will notice some warning signs. The symptoms may be subtle or severe, but they should never be taken lightly.</p><p>As the arteries feeding your heart become narrower and narrower, you may become short of breath. You may also feel chest pain, often called angina. Angina isnt just an ache; youll probably also have a heavy, tight, burning, squeezing sensation right behind your sternum (breastbone). The pain may also spread to your jaw, throat, or one arm. The attacks usually come on during exertion or emotional stress, and they go away when you rest or calm down. If the attacks suddenly become more frequent or if they start arriving while youre resting, a heart attack may be around the corner.</p><p>Symptoms are often different in women than men. If you are a woman and you experience fatigue, sleep disturbance, shortness of breath, indigestion, cold sweats, dizziness, or anxiety -- even in the absence of chest pain -- you may have heart disease and could even be experiencing a heart attack.</p><p><b>What raises the risk of coronary heart disease?</b></p><p>Coronary heart disease doesnt strike at random. People with CHD often have one or more traits that make them likely targets.</p><p>Three risk factors stand far above the rest: high cholesterol, high blood pressure, and smoking. Any one of these traits roughly doubles your chances for developing CHD. Combine all three, and youll be eight times more likely to develop CHD.</p><p><b>How is coronary heart disease treated?</b></p><p>If one or more of your coronary arteries is severely clogged, you may need treatment to restore the flow of blood to your heart. One option is coronary artery bypass surgery. Using a blood vessel from another part of your body, a surgeon can create a detour around the blocked artery. Another option is angioplasty, a procedure that involves threading a catheter through the clogged artery. Once the catheter is in place, it can widen the artery when the doctor inflates a small balloon, fires a laser, rotates a tiny blade, or inserts a small metal scaffold called a stent.</p><p>If your arteries arent severely blocked but youre still bothered by angina, your doctor may prescribe beta-blockers, nitroglycerin, or other medications to ease your symptoms. With proper self-care, theres little reason that you cant lead a rich, active life.</p>', '20220211003034_heart.JPG', '11-02-2022', '12:30:34 am', 'coronary, heart disease, ', 'Chris Woolston', 1),
(9, 'The Development and Causes of Cancer', '<p>The fundamental abnormality resulting in the development of cancer is the continual unregulated proliferation of cancer cells. Rather than responding appropriately to the signals that control normal cell behavior, cancer cells grow and divide in an uncontrolled manner, invading normal tissues and organs and eventually spreading throughout the body. The generalized loss of growth control exhibited by cancer cells is the net result of accumulated abnormalities in multiple cell regulatory systems and is reflected in several aspects of cell behavior that distinguish cancer cells from their normal counterparts.</p><p><b>Types of Cancer</b></p><p>Cancer can result from abnormal proliferation of any of the different kinds of cells in the body, so there are more than a hundred distinct types of cancer, which can vary substantially in their behavior and response to treatment. The most important issue in cancer pathology is the distinction between benign and malignant tumors. A tumor is any abnormal proliferation of cells, which may be either benign or malignant. A benign tumor, such as a common skin wart, remains confined to its original location, neither invading surrounding normal tissue nor spreading to distant body sites. A malignant tumor, however, is capable of both invading surrounding normal tissue and spreading throughout the body via the circulatory or lymphatic systems (metastasis). Only malignant tumors are properly referred to as cancers, and it is their ability to invade and metastasize that makes cancer so dangerous. Whereas benign tumors can usually be removed surgically, the spread of malignant tumors to distant body sites frequently makes them resistant to such localized treatment.</p><p>Both benign and malignant tumors are classified according to the type of cell from which they arise. Most cancers fall into one of three main groups: carcinomas, sarcomas, and leukemias or lymphomas. Carcinomas, which include approximately 90% of human cancers, are malignancies of epithelial cells. Sarcomas, which are rare in humans, are solid tumors of connective tissues, such as muscle, bone, cartilage, and fibrous tissue. Leukemias and lymphomas, which account for approximately 8% of human malignancies, arise from the blood-forming cells and from cells of the immune system, respectively. Tumors are further classified according to tissue of origin (e.g., lung or breast carcinomas) and the type of cell involved. For example, fibrosarcomas arise from fibroblasts, and erythroid leukemias from precursors of erythrocytes (red blood cells).</p><p>Although there are many kinds of cancer, only a few occur frequently. More than a million cases of cancer are diagnosed annually in the United States, and more than 500,000 Americans die of cancer each year. Cancers of 10 different body sites account for more than 75% of this total cancer incidence. The four most common cancers, accounting for more than half of all cancer cases, are those of the breast, prostate, lung, and colon/rectum. Lung cancer, by far the most lethal, is responsible for nearly 30% of all cancer deaths.</p><p><b>The Development of Cancer</b></p><p>One of the fundamental features of cancer is tumor clonality, the development of tumors from single cells that begin to proliferate abnormally. The single-cell origin of many tumors has been demonstrated by analysis of X chromosome inactivation . As discussed in Chapter 8, one member of the X chromosome pair is inactivated by being converted to heterochromatin in female cells. X inactivation occurs randomly during embryonic development, so one X chromosome is inactivated in some cells, while the other X chromosome is inactivated in other cells. Thus, if a female is heterozygous for an X chromosome gene, different alleles will be expressed in different cells. Normal tissues are composed of mixtures of cells with different inactive X chromosomes, so expression of both alleles is detected in normal tissues of heterozygous females. In contrast, tumor tissues generally express only one allele of a heterozygous X chromosome gene. The implication is that all of the cells constituting such a tumor were derived from a single cell of origin, in which the pattern of X inactivation was fixed before the tumor began to develop.</p><p>The clonal origin of tumors does not, however, imply that the original progenitor cell that gives rise to a tumor has initially acquired all of the characteristics of a cancer cell. On the contrary, the development of cancer is a multistep process in which cells gradually become malignant through a progressive series of alterations. One indication of the multistep development of cancer is that most cancers develop late in life. The incidence of colon cancer, for example, increases more than tenfold between the ages of 30 and 50, and another tenfold between 50 and 70. Such a dramatic increase of cancer incidence with age suggests that most cancers develop as a consequence of multiple abnormalities, which accumulate over periods of many years.</p>', '20220211000946_cancer.JPG', '11-02-2022', '12:09:46 am', 'cancer, tumor', 'Geoffrey M Cooper', 1),
(10, 'HIV/AIDS', '<p>The human immunodeficiency virus (HIV) targets the immune system and weakens peoples defense against many infections and some types of cancer that people with healthy immune systems can fight off. As the virus destroys and impairs the function of immune cells, infected individuals gradually become immunodeficient. Immune function is typically measured by CD4 cell count.</p><p>The most advanced stage of HIV infection is acquired immunodeficiency syndrome (AIDS), which can take many years to develop if not treated, depending on the individual. AIDS is defined by the development of certain cancers, infections or other severe long-term clinical manifestations.</p><p><b>Signs and symptoms</b></p><p>The symptoms of HIV vary depending on the stage of infection. Though people living with HIV tend to be most infectious in the first few months after being infected, many are unaware of their status until the later stages. In the first few weeks after initial infection people may experience no symptoms or an influenza-like illness including fever, headache, rash or sore throat.</p><p>As the infection progressively weakens the immune system, they can develop other signs and symptoms, such as swollen lymph nodes, weight loss, fever, diarrhoea and cough. Without treatment, they could also develop severe illnesses such as tuberculosis (TB), cryptococcal meningitis, severe bacterial infections, and cancers such as lymphomas and Kaposis sarcoma.</p><p><b>Transmission</b></p><p>HIV can be transmitted via the exchange of a variety of body fluids from infected people, such as blood, breast milk, semen and vaginal secretions. HIV can also be transmitted from a mother to her child during pregnancy and delivery. Individuals cannot become infected through ordinary day-to-day contact such as kissing, hugging, shaking hands, or sharing personal objects, food or water.&nbsp;</p><p>It is important to note that people with HIV who are taking ART and are virally suppressed do not transmit HIV to their sexual partners.&nbsp; Early access to ART and support to remain on treatment is therefore critical not only to improve the health of people with HIV but also to prevent HIV transmission.</p><p><b>Diagnosis</b></p><p>HIV can be diagnosed through rapid diagnostic tests that provide same-day results. This greatly facilitates early diagnosis and linkage with treatment and care. People can also use HIV self-tests to test themselves. However, no single test can provide a full HIV diagnosis; confirmatory testing is required, conducted by a qualified and trained health or community worker at a community centre or clinic. HIV infection can be detected with great accuracy using WHO prequalified tests within a nationally approved testing strategy.</p><p>Most widely-used HIV diagnostic tests detect antibodies produced by the person as part of their immune response to fight HIV. In most cases, people develop antibodies to HIV within 28 days of infection. During this time, people experience the so-called window period â€“ when HIV antibodies havenâ€™t been produced in high enough levels to be detected by standard tests and when they may have had no signs of HIV infection, but also when they may transmit HIV to others. After infection, an individual may transmit HIV transmission to a sexual or drug-sharing partner or for pregnant women to their infant during pregnancy or the breastfeeding period.</p><p>Following a positive diagnosis, people should be retested before they are enrolled in treatment and care to rule out any potential testing or reporting error. Notably, once a person diagnosed with HIV and has started treatment they should not be retested.</p><p>While testing for adolescents and adults has been made simple and efficient, this is not the case for babies born to HIV-positive mothers. For&nbsp; children less than 18 months of age, serological testing is not sufficient to identify HIV infection â€“ virological testing must be provided as early as birth or at 6 weeks of age. New technologies are now becoming available to perform this test at the point of care and enable same-day results, which will accelerate appropriate linkage with treatment and care.</p><p><b>Treatment</b></p><p>HIV disease can be managed by treatment regimens composed of a combination of three or more antiretroviral (ARV) drugs. Current antiretroviral therapy (ART) does not cure HIV infection but highly suppresses viral replication within a persons body and allows an individuals immune system recovery to strengthen and regain the capacity to fight off opportunistic infections and some cancers.</p><p>Since 2016, WHO has recommended that all people living with HIV be provided with lifelong ART, including children, adolescents, adults and pregnant and breastfeeding women, regardless of clinical status or CD4 cell count.&nbsp;</p><p>By June 2021, 187 countries had already adopted this recommendation, covering 99% of all people living with HIV globally. In addition to the treat all strategy, WHO recommends a rapid ART initiation to all people living with HIV, including offering ART on the same day as diagnosis among those who are ready to start treatment. By June 2021, 82 low- and middle-income countries reported that they have adopted this policy, and approximately half of them reported country-wide implementation.</p><p>Globally, 28.2 million people living with HIV were receiving ART in 2021. The global ART coverage rate was 73% [56â€“88%] in 2020. However, more efforts are needed to scale up treatment, particularly for children and adolescents. Only 54% [37â€“69%] of children (0â€“14 years old) were receiving ART at the end of 2020.</p>', '20220211001746_hiv.JPG', '11-02-2022', '12:17:46 am', 'hiv, aids', 'Ahmad Mustapha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `Help_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Help_Title` varchar(254) NOT NULL,
  `Help_Category` varchar(50) NOT NULL,
  `Help_Desc` varchar(500) NOT NULL,
  `Help_Date` varchar(50) NOT NULL,
  `FK_Help_Admin_ID` int(11) NOT NULL,
  PRIMARY KEY (`Help_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`Help_ID`, `Help_Title`, `Help_Category`, `Help_Desc`, `Help_Date`, `FK_Help_Admin_ID`) VALUES
(1, 'What if I forgot my password?', 'general', 'You can go to Forgot Password and proceed to reset your password', '2022-02-14', 1),
(2, 'Is OnlineMedicineShopping available on mobile app?', 'general', 'Unfortunately, we do not yet have an app service.', '2022-02-14', 1),
(3, 'What is OnlineShoppingMedicine?', 'general', 'OnlineShoppingMedicine is an online medication provider which allowing consumers to get their medication they need instantly', '2022-02-14', 1),
(4, 'Can I get Medical Certificate (MC) from online consultation', 'online_consultation', 'unfortunately, online doctor does not provide Medical Certificates(MC)', '2022-02-14', 1),
(5, 'Who are the doctors at OnlineShoppingMedicine', 'online_consultation', 'All doctors partnered with OnlineShoppingMedicine are MOH-registered and have at least 6 years of practice in their experiences. As such, our panel doctors have a valid MMC Registration and Annual Practicing Certificate (APC)', '2022-02-14', 1),
(6, 'Does OnlineShoppingMedicine provide home visits or emergency services?', 'online_consultation', 'We do not provide home visits or emergency services. Please visit your nearest hospital emergency department for urgent medical attention.', '2022-02-14', 1),
(7, 'Is the medication provided by OnlineMedicineShopping genuine and safe to use?', 'online_medicine', 'All our medications are sourced from local pharmacies with a Poisons A license granted by the Ministry of Health(MOH) to the licensed pharmacists. These medications must be registered with the MOH before they can be sold or marketed to consumers.', '2022-02-14', 1),
(8, 'How is my order packaged and delivered?', 'online_medicine', 'Our packages are delivered discreetly with no indication of contents. Medicines are packaged in factory-sealed blister/strip packaging. Your package is delivered and tracked by a trusted courier service', '2022-02-14', 1),
(9, 'How do I pay for the medication?', 'online_medicine', 'You can pay using Online Banking', '2022-02-14', 1),
(10, 'What are the payment methods availalbe?', 'payment_option', 'We accept payment via Online Banking', '2022-02-14', 1),
(11, 'Can I claim payment made to OnlineMedicineShopping from my insurance provider?', 'payment_option', 'This depends on your subscribed policy with your insurance provide. Please check with your insurance representative', '2022-02-14', 1),
(12, 'How do I pay for DOC consultation and medication?', 'corporate', 'As a corporate member, your consultation and medications are covered by your employer. No payment is required up front. Standard exclusion and coverage limits apply.', '2022-02-14', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Login_ID`, `username`, `password`, `role`) VALUES
(19, 'admin1', '123', 'administrator'),
(50, 'bigpharma', '123', 'seller'),
(51, 'healthlane', '123', 'seller'),
(52, 'mustaqim', '123', 'customer'),
(53, 'dramran', '123', 'administrator'),
(54, 'mus', '123', 'customer'),
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`Medical_ID`, `Blood_Group`, `Weight`, `Height`, `Alcohol`, `Smoking`, `Exercise`, `Illness`, `BMI`, `Surgery`, `FK_Med_Cust_ID`) VALUES
(6, 'A+', 59, 170, 'no', 'no', 'no', 'none', 20.42, 'none', 18),
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Order_No`, `Order_Status`, `Order_Amount`, `FK_Order_ShipAdd_ID`, `FK_Order_BillAdd_ID`, `FK_Order_Cust_ID`, `FK_Order_Seller_ID`, `FK_Order_Cart_ID`, `FK_Order_Ship_ID`) VALUES
(43, 4, 'payment_completed', 124.5, 12, 6, 18, 8, 43, 1),
(41, 3, 'payment_completed', 114.5, 12, 6, 18, 9, 42, 1),
(42, 3, 'payment_completed', 24.5, 12, 6, 18, 7, 42, 1),
(40, 2, 'payment_completed', 149.5, 12, 6, 18, 9, 41, 1),
(39, 1, 'payment_completed', 114.5, 12, 6, 18, 9, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Product_ID` int(45) NOT NULL AUTO_INCREMENT,
  `Product_Name` varchar(254) NOT NULL,
  `Product_Desc` text NOT NULL,
  `Product_Spec` text NOT NULL,
  `Product_Image` varchar(45) NOT NULL,
  `Product_Qty` int(45) NOT NULL,
  `Product_Type` varchar(45) NOT NULL,
  `Product_Category` varchar(50) NOT NULL,
  `Product_RecordType` varchar(45) NOT NULL,
  `Product_ExpiracyDate` varchar(45) NOT NULL,
  `Product_ManufacturerName` varchar(45) NOT NULL,
  `Product_SellingPrice` double NOT NULL,
  `Product_Tags` varchar(254) NOT NULL,
  `FK_Product_Seller_ID` int(45) NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Desc`, `Product_Spec`, `Product_Image`, `Product_Qty`, `Product_Type`, `Product_Category`, `Product_RecordType`, `Product_ExpiracyDate`, `Product_ManufacturerName`, `Product_SellingPrice`, `Product_Tags`, `FK_Product_Seller_ID`) VALUES
(55, 'prospan', '<p>When a chesty cough has become a family affair, consider Prospan a reliable cough remedy with a naturally sourced active ingredient that is suitable for both adults and children. When you want to take action, turn to Prospan for a clinically proven herbal cough medicine that can be given to the whole family&nbsp;</p><p>The non-drowsy, sugar-free formulation is reliable and very well tolerated, making it suitable for people of all ages.</p>', '<p><b>Features &amp; Benefits</b></p><ul><li>No added sugar</li><li>No added alcohol</li><li>No added colorings</li></ul><p><b>Dosage/How To Use</b></p><p>Unless otherwise prescribed.</p><p><b>Children &gt; 1 year old</b></p><p>Take 1 teaspoonful 3 times daily</p><p><b>School children and adolescents</b></p><p>Take 2 teaspoonsful 3 times daily</p><p><b>Adults</b></p><p>Take 2-3 teaspoonsful 3 times daily</p><p>PROSPAN F 100ML &amp; PROSPAN F COUGH SYRUP 21 STICK 5ML</p><p>These sticks packs are perfect single-dose sachets for your recovery on-the-go! Take 3 stick packs a day without having to miss a dosage anymore.</p>', 'img/prospan.jpg', 30, 'noncontrol', 'lungs', 'no', '2022-02-28', 'sterling', 20, 'prospan, cough syrup,', 7),
(54, 'Abraxane', '<p>Abraxane is used to treat advanced-stage breast cancer and usually is given:</p><p>The taxanes Taxol and Taxotere use solvents to dissolve paclitaxel the main ingredient so the medicine can enter the bloodstream. These solvents may make Taxol and Taxotere difficult to tolerate while being given. People usually take pre-medications to minimize reactions to the solvents. Instead of a solvent, the paclitaxel in Abraxane is suspended in albumin, a protein, which may make it easier to take without the need for pre-medication.<br></p>', '<p><b>Chemical name:</b> Albumin-bound or nab-paclitaxel</p><p><b>Class:</b> Taxane chemotherapy. Taxol and Taxotere are other taxanes.</p><p><b>How it works:</b> Taxanes interfere with the ability of cancer cells to divide.</p><p><b>Uses: </b>Abraxane typically is used to treat advanced-stage breast cancer and usually is given:</p><ul><li>in combination with other chemotherapy medicines</li><li>after other chemotherapy medicines given after surgery have stopped working</li></ul>', 'img/OralChemo.jpg', 15, 'control', 'other', 'yes', '2022-02-28', 'sterling', 50000, 'chemo, breast cancer, abraxane, taxane, chemotherapy', 7),
(56, 'RESPACK DISPOSABLE FACE MASK 4PLY KF94 EARLOOP', '<p>A face mask is a covering that you wear over your face, for example to prevent yourself from breathing bad air or from spreading germs, or to protect your face when you are in a dangerous situation.<br></p>', '<ol><li>Three dimensional mask with lightweight structure for easy breathing</li><li>Adjustable nose bridge and elastic ear loop has enough elasticity to make a good seal</li><li>Multilayer protection can filter out dust, germs smoke and almost 98 particles in the air</li></ol>', 'img/facemask.jpg', 20, 'noncontrol', 'other', 'no', '2022-02-26', 'minimask', 35, 'facemask, 4ply, mask', 9),
(69, 'HLP LIFESENZE COQ10 150MG PLUS', '<p><span style=\"background-color: rgba(var(--bs-body-bg-rgb),var(--bs-bg-opacity)); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">What is Coenzyme Q10</span></p><p><span style=\"background-color: rgba(var(--bs-body-bg-rgb),var(--bs-bg-opacity)); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">is a fat soluble antioxidant vitamin that plays an indispensable role in energy production and its found in every cell of the body</span></p>', '<p>The roles of Coenzyme Q10 in our body</p><ul><li>Energy booster</li><li>Powerful antioxidant</li><li>Cardio protection</li><li>Anti hypertension</li><li>Immuno stimulation</li><li>Increase stamina</li><li>Anti-aging</li><li>Reverse the effect of statin</li></ul>', 'img/20220206155121_lifesenze.jpg', 10, 'noncontrol', 'ortho', 'no', '2022-02-09', 'lifesenze', 110, 'lifesenze, coq10, hlp', 9),
(70, 'Lipitor 20mg Tablet', '<p><b>Introduction of Lipitor 20mg Tablet</b></p><p>When used as directed by a doctor, Lipitor 20mg Tablet is a regularly prescribed drug that is considered safe for long-term usage. It may be consumed either with food or on an empty stomach. It may be taken at any time of day, however it is best if you take it at the same time every day. Although most individuals do not feel bad when they stop taking their prescription, doing so may make their condition worse, increasing their risk of heart disease and stroke</p>', '<p>Before starting Lipitor, please consult a doctor especially if you are having any of the listed problems. Contraindications:</p><ul><li>Atve liver diseases</li><li>&nbsp;Raised hepatic enzymes</li><li>Allergy to Lipitor or any of its contents.</li><li>&nbsp;It is not advisable for children and babies. Please keep it away from their reach</li><li>Hypersensitivity</li><li>Drug interactions with Lipitor</li></ul><p>Interactions may differ individually. You are encouraged to ask your doctor about any possible interactions of this drug.</p><ol><li>Cyclosorine</li><li>Fibric acid derivatives</li><li>&nbsp;Erythromycin</li><li>Niacin</li><li>Diltiazem</li><li>&nbsp;Digoxin</li><li>Colestipol</li><li>Colchicine</li><li>&nbsp;Fibrates</li></ol><p>This list may be incomplete. Please mention all the drugs you are taking to the doctor before starting a new one. Please be alert of the following situations as well:</p><ol><li><span style=\"background-color: rgba(var(--bs-body-bg-rgb),var(--bs-bg-opacity)); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Avoid excessive exposure to sun</span></li><li>Avoid using it for a long term</li><li>Alcohol may affect the effectiveness of this drug</li></ol>', 'img/20220206160122_Lipitor.JPG', 50, 'control', 'heart', 'yes', '2022-02-11', 'Upjohn', 120, 'lipitor, atorvastatin', 8),
(71, 'Zykadia 150mg Hard Capsule', '<p><b>How To Use Zykadia 150mg Hard Capsule</b></p><p>This medicine is for oral use only. Swallow this medication as a whole with water. Do not chew or crush the capsule. It is better to take this medication at a fixed time if it is indicated for everyday use.</p>', '<p><b>Alcohol Warning( Safe )</b></p><p>There is no contraindication on the consumption of alcohol with Zykadia 150mg Hard Capsule suggested by any previous clinical data. However, the side effects of alcohol may worsen the adverse reaction of Zykadia 150mg Hard Capsule and caution should be taken by the user.</p><p><b>Pregnancy Warning (Not Safe)</b></p><p>Animal reproductive studies have been shown potential harm to the development of the fetus. Due to its potential harm to human pregnancy, it is not advisable to be used during pregnancy and effective contraception should be considered in women of child-bearing potential.</p><p><b>Breastfeeding Warning ( Limited Data )</b></p><p>It is not known whether Zykadia 150mg Hard Capsule will be excreted into human breastmilk or not and it is advisable not to breastfeed the infant during treatment period due to its potential adverse effects.</p><p><b>Driving Warning ( Not Advisable )</b></p><p>It is not advisable to drive or operate machinery when taking Ceritini due to its potential side effects such as dizziness and eye disorders which can affect concentration and ability to drive.</p>', 'img/20220206192935_zykadia.JPG', 15, 'control', 'lungs', 'yes', '2022-07-14', 'Novartis', 3799, 'zykadia, lung cancer, cancer', 8);

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`Record_ID`, `Record_Timestamp`, `Record_File`, `Record_FileName`, `FK_Record_Product_ID`, `FK_Record_Cust_ID`) VALUES
(19, '2022-02-07 12:54:31am', '20220207005431_ConsultPrescription.pdf', 'ConsultPrescription.pdf', 0, 18),
(20, '2022-02-07 10:53:58pm', '20220207225358_PrescriptionDoc.pdf', 'PrescriptionDoc.pdf', 0, 18),
(12, '2022-02-06 04:14:54pm', '20220206161454_Prescription.pdf', 'Prescription.pdf', 0, 18);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Seller_ID`, `Seller_Name`, `Seller_RegistrationNo`, `Seller_Phone`, `Seller_Address`, `Seller_BankAccName`, `Seller_BankAccNo`, `Seller_Registration_Status`, `FK_Seller_Login_ID`) VALUES
(9, 'Health Lane Family Pharmacy', 122545332, '0367305793', '5, Jln Burung Jentayu, Taman Bukit Maluri, 51200 Kuala Lumpur', 'hongleong', '5124448755365', 'Active', 51),
(7, 'Sterling Pharmacy', 25666421, '0333262598', 'Aeon Bukit Tinggi Shopping Centre, S21, Persiaran Batu Nilam 1/ks6, Bandar Bukit Tinggi 2, 41200 Klang', 'maybank', '2100025421534', 'Active', 49),
(8, 'Big Pharmacy', 51222342, '0342805099', 'No. 40, Jalan Bunga Tanjung 9,Taman Muda Cheras, 56100 Kuala Lumpur', 'cimb', '512445614523', 'Active', 50);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_shop`
--

INSERT INTO `seller_shop` (`Shop_ID`, `Shop_Desc`, `Shop_Img`, `Shop_Img_File`, `Shop_Cover`, `Shop_Cover_File`, `FK_Shop_Seller_ID`) VALUES
(5, '<p>With a vision to build a brand based on trust and to provide customers excellent services and products at competitive prices, the founders of BIG Pharmacy, Lee Meng Chuan and Lim Sin Yin opened their first outlet in Damansara Uptown in year 2006.</p><p>From there, the BIG Pharmacy brand was recognised by many and the number of outlets slowly grew from 1 outlet to 13 outlets.</p><p>As part of the Groupâ€™s plan to expand in the southern region of Malaysia, the Group merged with RedCap Pharmacy in year 2018, My Pharmacy in year 2019 and the combined entity now has more than 80 BIG Pharmacy outlets in Malaysia.</p><p>All the outlets are staffed with licensed pharmacists, registered under Lembaga Farmasi Malaysia. The pharmacists are trained to provide the best range of care for customers, from dispensing medications to providing healthcare advice. There are also nutritionists and dieticians on site to provide dietary advice and guidance on selection of supplements.</p>', '20220206155406_bigpharmacylogo.JPG', 'bigpharmacylogo.JPG', '20220206155411_bigpharmacybanner.JPG', 'bigpharmacybanner.JPG', 8),
(6, '<p>Health Lane Family Pharmacy is a growing chain of pharmacy with more than 30 years experience! We currently have almost 100 outlets in Klang Valley, Negeri Sembilan, Melaka, Johor, Sarawak and still expanding. Our retail outlets are supported by an efficient Headquarter team based in Sentul.</p><p><br></p><p>In Health Lane Family Pharmacy our tagline is â€œGREAT HEALTH BEGINS HEREâ€, our goal is to establish a strong bond and long term relationship with our customers, treating them like family by providing personalized service, caring advice and recommending wholesome solutions to help them achieve great health.</p>', '20220206144712_healthlanelogo.png', 'healthlanelogo.png', '20220206144718_healthlanebanner.jpg', 'healthlanebanner.jpg', 9),
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`ShipAdd_ID`, `address`, `city`, `state`, `zipcode`, `country`, `FK_ShipAdd_Cust_ID`) VALUES
(13, 'lorong 123', 'Parit Raja', 'Johor', 58738, 'Malaysia', 19),
(12, 'no 38, lorong haji abu', 'Bukit Tinggi', 'Selangor', 41230, 'Malaysia', 18),
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`Tracking_ID`, `Tracking_Date`, `Tracking_Time`, `Tracking_Status`, `Tracking_Channel`, `Tracking_EstimateDate`, `Tracking_EstimateTime`, `FK_Tracking_Order_ID`, `FK_Tracking_Ship_ID`, `FK_Tracking_Cust_ID`, `FK_Tracking_Seller_ID`, `FK_Tracking_Cart_ID`) VALUES
(21, '20-02-2022', '10:49:50 pm', 'completed', 'skynet', '25-02-2022', '10:49:50 pm', 43, 1, 18, 8, 43),
(20, '20-02-2022', '10:46:27 pm', 'completed', 'skynet', '25-02-2022', '10:46:27 pm', 42, 1, 18, 7, 42),
(19, '20-02-2022', '10:46:27 pm', 'completed', 'skynet', '25-02-2022', '10:46:27 pm', 41, 1, 18, 9, 42),
(18, '20-02-2022', '10:40:18 pm', 'completed', 'postlaju', '25-02-2022', '10:40:18 pm', 40, 1, 18, 9, 41),
(17, '20-02-2022', '10:35:46 pm', 'completed', 'citylink', '25-02-2022', '10:35:46 pm', 39, 1, 18, 9, 40);

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking_shipment`
--

INSERT INTO `tracking_shipment` (`Track_Ship_ID`, `Track_Ship_Status`, `Track_Ship_Date`, `Track_Ship_Time`, `FK_Tracking_ID`) VALUES
(26, 'ship', '20-02-2022', '10:48:38 pm', 19),
(25, 'completed', '20-02-2022', '10:42:04 pm', 18),
(23, 'ship', '20-02-2022', '10:41:59 pm', 18),
(24, 'delivered', '20-02-2022', '10:42:02 pm', 18),
(22, 'completed', '20-02-2022', '10:39:15 pm', 17),
(21, 'delivered', '20-02-2022', '10:39:09 pm', 17),
(20, 'ship', '20-02-2022', '10:38:55 pm', 17),
(27, 'delivered', '20-02-2022', '10:48:40 pm', 19),
(28, 'completed', '20-02-2022', '10:48:42 pm', 19),
(29, 'ship', '20-02-2022', '10:49:21 pm', 20),
(30, 'delivered', '20-02-2022', '10:49:23 pm', 20),
(31, 'completed', '20-02-2022', '10:49:24 pm', 20),
(32, 'ship', '20-02-2022', '10:50:36 pm', 21),
(33, 'delivered', '20-02-2022', '10:50:56 pm', 21),
(34, 'completed', '20-02-2022', '10:50:59 pm', 21);

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Transaction_ID`, `Transaction_Date`, `Transaction_Time`, `Transaction_Type`, `Transaction_Amount`, `Transaction_Status`, `FK_Transaction_Wallet_ID`, `FK_Transaction_Seller_ID`, `FK_Transaction_Order_ID`) VALUES
(20, '20-02-2022', '10:49:50 pm', 'income', 124.5, 'completed', 4, 8, 43),
(19, '20-02-2022', '10:46:27 pm', 'income', 24.5, 'completed', 3, 7, 42),
(18, '20-02-2022', '10:46:27 pm', 'income', 114.5, 'completed', 5, 9, 41),
(17, '20-02-2022', '10:40:18 pm', 'income', 149.5, 'completed', 5, 9, 40),
(16, '20-02-2022', '10:35:46 pm', 'income', 114.5, 'completed', 5, 9, 39);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`Wallet_ID`, `Wallet_Amount`, `FK_Wallet_Seller_ID`) VALUES
(3, 24.5, 7),
(4, 124.5, 8),
(5, 378.5, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
