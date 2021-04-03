-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 05:40 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syllabus_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE `tbl_announcements` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Message` varchar(1000) NOT NULL,
  `AnnounceDate` date NOT NULL DEFAULT current_timestamp(),
  `Attachment` varchar(100) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`Id`, `UserId`, `Title`, `Message`, `AnnounceDate`, `Attachment`, `Status`) VALUES
(1, 1, 'hii', 'there1', '2021-03-21', '../syllabusfiles/announcements/1616389364.pdf', '0'),
(2, 1, 'new one', 'hello', '2021-03-21', '', '0'),
(3, 1, 'syllabus updated', 'get your new syllabus', '2021-03-21', '../syllabusfiles/announcements/1616334951.pdf', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bos`
--

CREATE TABLE `tbl_bos` (
  `Id` int(11) NOT NULL,
  `MeetingName` varchar(100) NOT NULL,
  `MeetingVenue` varchar(100) NOT NULL,
  `MeetingDate` date NOT NULL,
  `MeetingAgenda` varchar(100) NOT NULL,
  `Minutes` varchar(100) NOT NULL,
  `SyllabusZip` varchar(100) NOT NULL,
  `TesZip` varchar(100) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bos`
--

INSERT INTO `tbl_bos` (`Id`, `MeetingName`, `MeetingVenue`, `MeetingDate`, `MeetingAgenda`, `Minutes`, `SyllabusZip`, `TesZip`, `Status`) VALUES
(1, 'new meeting1', 'UTU', '2021-03-27', '../syllabusfiles/bos/agenda/1616199939.docx', '', '../syllabusfiles/bos/syllabus/1616200676.rar', '../syllabusfiles/bos/tes/1616201502.zip', '0'),
(2, 'BOS7', 'Maliba Pharmacy Conference hall', '2021-03-21', '../syllabusfiles/bos/agenda/1616214869.docx', '../syllabusfiles/bos/minutes/1616683748.pdf', '../syllabusfiles/bos/syllabus/1616214869.zip', '../syllabusfiles/bos/syllabus/1616214869.zip', '0'),
(3, 'BOSS', 'UTU', '2021-03-26', '../syllabusfiles/bos/agenda/1616680421.pdf', '../syllabusfiles/bos/minutes/1616680421.pdf', '../syllabusfiles/bos/syllabus/1616680421.zip', '../syllabusfiles/bos/syllabus/1616680421.zip', '0'),
(4, 'BOS99', 'UTU', '2021-03-26', '../syllabusfiles/bos/agenda/1616681801.pdf', '../syllabusfiles/bos/minutes/1616681801.pdf', '../syllabusfiles/bos/syllabus/1616681801.zip', '../syllabusfiles/bos/tes/1616681801.zip', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `Id` int(11) NOT NULL,
  `Enro` char(20) NOT NULL,
  `Username` varchar(320) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`Id`, `Enro`, `Username`, `Password`, `FullName`, `Status`) VALUES
(1, '201806100110001', '18bmiit001@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Krishna Gandhi', '0'),
(2, '201806100110002', '18bmiit002@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Kishan Lad', '0'),
(39, '201806100110004', '18bmiit004@gmail.com', '77309e874821497abfdc11b7eda137964ed53f04502613cfc8aec0ad5d293042', 'Charvi Shah', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `Id` int(11) NOT NULL,
  `SubjectCode` char(15) DEFAULT NULL,
  `SubjectName` varchar(100) DEFAULT NULL,
  `EffectiveYear` varchar(15) DEFAULT NULL,
  `TheoryCredit` char(2) DEFAULT '-',
  `PracticalCredit` char(2) DEFAULT '-',
  `TheoryHour` char(2) DEFAULT '-',
  `PracticalHour` char(2) DEFAULT '-',
  `DocText` varchar(500) DEFAULT NULL,
  `DocPdf` varchar(500) DEFAULT NULL,
  `TheoryMarksInt` char(3) DEFAULT '-',
  `TheoryMarksExt` char(3) DEFAULT '-',
  `Cie` char(3) DEFAULT '-',
  `CieInt` char(3) DEFAULT '-',
  `CieExt` char(3) DEFAULT '-',
  `Isactive` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`Id`, `SubjectCode`, `SubjectName`, `EffectiveYear`, `TheoryCredit`, `PracticalCredit`, `TheoryHour`, `PracticalHour`, `DocText`, `DocPdf`, `TheoryMarksInt`, `TheoryMarksExt`, `Cie`, `CieInt`, `CieExt`, `Isactive`) VALUES
(1, 'IT3001', 'Fundamentals of Programming', '2019-06', '4', '2', '4', '6', '-', '-', '40', '60', '50', '-', '-', '0'),
(2, 'IT3002', 'Database Management Systems', '2020-06', '4', '2', '4', '6', '-', '-', '40', '60', '50', '-', '-', '0'),
(3, 'IT3003', 'Computer Fundamentals and Organization', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(4, 'MT3009', 'Mathematics for Computer Applications', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(5, 'EN3008', 'Professional Communication', '2019-06', '2', '-', '2', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(6, 'IT3004', 'Relational DBMS', '2019-06', '4', '3', '4', '6', '-', '-', '40', '60', '50', '-', '-', '0'),
(7, 'IT3005', 'Object Oriented Programming', '2019-06', '4', '3', '4', '6', '-', '-', '40', '60', '50', '-', '-', '0'),
(8, 'EC3001', 'Digital Electronics', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(9, 'MT3012', 'Advanced Mathematics for Computer Applications', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(10, 'CV3002', 'Environmental Studies', '2020-06', '2', '-', '2', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(11, 'IT4002', 'Data Structures', '2020-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(12, 'IT4003', 'Computer Networks', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(13, 'EC4008', 'Microprocessor Programming and Interfacing', '2019-06', '3', '2', '3', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(14, 'IT4004', 'Operating Systems', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(19, 'IT4005', 'System Analysis and Design', '2020-06', '3', '-', '3', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(20, 'IT4006', 'Web Designing', '2020-06', '-', '2', '-', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(21, 'IT4007', 'GUI Programming', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(22, 'IT4008', 'Java Programming', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(23, 'IT4009', 'LINUX and Shell Programming', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(24, 'IT4010', 'Cyber Security', '2020-06', '3', '-', '3', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(25, 'IT4011', 'Software Engineering', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(26, 'IIT4012', 'Multimedia Design', '2020-06', '-', '1', '-', '2', '-', '-', '-', '-', '50', '-', '-', '0'),
(27, '060010508', 'DSE8 Web Development using MVC', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(28, '060010509', 'DSE9 Information Security', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(29, '060010510', 'SEC1 Programming in Python', '2019-06', '-', '2', '-', '4', '-', '-', '-', '-', '50', '-', '-', '0'),
(30, '060010511', 'SEC2 Multimedia Applications', '2020-06', '3', '2', '3', '4', '-', '-', '-', '-', '-', '-', '-', '0'),
(31, '060010512', 'DSE10 Project', '2020-06', '-', '2', '-', '4', '-', '-', '-', '-', '50', '-', '-', '0'),
(37, '060010518', 'DSE7 Advanced Java', '2020-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(38, '060010521', 'Creativity, Problem Solving and Innovation', '2019-06', '2', '-', '2', '-', '-', '-', '-', '-', '100', '-', '-', '0'),
(39, '060010514', 'DSE11 Data Communications', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(40, '060010515', 'DSE11 Database Administration', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(41, '060010516', 'DSE11 Information System', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(52, '060010520', 'DSE11 Computer Graphics', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(53, '060010707', 'Digital Image Processing', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(54, '060010708', 'Network Security', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(55, '060010713', 'Soft Computing', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(59, '060010717', 'Distributed Database', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(60, '060010711', 'Software Testing', '2020-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(61, '060010712', 'Algorithm Analysis and Design', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(62, '060010715', 'Wireless Networks', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(63, '060010716', 'Android Application Development', '2021-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(64, '060010718', 'Project (Pw)', '2020-06', '-', '2', '-', '4', '-', '-', '-', '-', '-', '20', '30', '0'),
(65, '060010606', 'DSE12 Open Source Web Technology', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '50', '-', '-', '0'),
(66, '060010607', 'DSE13 Software Project Management', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(67, '060010608', 'SEC3 Introduction to Mobile Application Development', '2020-06', '-', '2', '-', '3', '-', '-', '-', '-', '50', '-', '-', '0'),
(71, '060010609', 'DSE14 Project (Pw)', '2020-06', '-', '8', '-', '15', '-', '-', '-', '-', '200', '-', '-', '0'),
(72, '060010610', 'DSE15 Green Computing', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(73, '060010611', 'DSE15 Data Warehouse and Mining', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(74, '060010612', 'DSE15 Enterprise Resource Planning', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(75, '060010613', 'DSE15 Search Engine Optimization', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(76, '060010614', 'AECC3 Soft Skill', '2020-06', '2', '-', '2', '-', '-', '-', '60', '40', '-', '-', '-', '0'),
(77, '060010903', 'Project (Pw)', '2020-06', '-', '8', '-', '16', '-', '-', '-', '-', '-', '80', '120', '0'),
(78, '060010905', 'BigData Analytics', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '-', '20', '30', '0'),
(79, '060010907', 'Machine Learning', '2020-06', '4', '2', '4', '3', '-', '-', '40', '60', '-', '20', '30', '0'),
(80, '060010908', 'Cross - Platform Mobile Application Development', '2019-06', '4', '2', '4', '3', '-', '-', '40', '60', '-', '20', '30', '0'),
(81, '060010804', 'Dissertation (Di)', '2020-06', '-', '2', '-', '4', '-', '-', '-', '-', '-', '20', '30', '0'),
(82, '060010815', 'iOS Application Development', '2019-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(83, '060010816', 'Internet of Things', '2020-06', '3', '1', '3', '2', '-', '-', '40', '60', '-', '20', '30', '0'),
(84, '060010817', 'Full Stack Development (Pw)', '2019-06', '-', '3', '-', '6', '-', '-', '-', '-', '-', '40', '60', '0'),
(85, '060010812', 'Digital Forensic', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(86, '060010813', 'Network Administration', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(87, '060010814', 'IT Infrastructure Management', '2019-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0'),
(88, '060010818', 'PHP Frameworks', '2021-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(89, '060010819', 'Content Management Systems', '2020-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(90, '060010820', 'Web Development using Java Frameworks', '2020-06', '4', '2', '4', '4', '-', '-', '40', '60', '-', '20', '30', '0'),
(91, '060010821', 'Cloud Computing', '2020-06', '4', '-', '4', '-', '-', '-', '40', '60', '-', '-', '-', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_syllabus_config_assign`
--

CREATE TABLE `tbl_syllabus_config_assign` (
  `Id` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DocText` varchar(500) DEFAULT NULL,
  `Isleader` char(1) NOT NULL DEFAULT '0',
  `Comments` varchar(100) NOT NULL,
  `AssignDate` date DEFAULT NULL,
  `VerifyDate` date DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_syllabus_config_master`
--

CREATE TABLE `tbl_syllabus_config_master` (
  `Id` int(11) NOT NULL,
  `AcademicYear` char(7) NOT NULL,
  `Sem` int(11) NOT NULL,
  `ProgramId` char(1) NOT NULL,
  `PublishedOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_syllabus_config_master`
--

INSERT INTO `tbl_syllabus_config_master` (`Id`, `AcademicYear`, `Sem`, `ProgramId`, `PublishedOn`) VALUES
(1, '2020-21', 1, '3', '2021-03-18'),
(2, '2020-21', 2, '3', '2021-03-30'),
(3, '2020-21', 3, '3', NULL),
(4, '2020-21', 4, '3', NULL),
(5, '2020-21', 5, '3', NULL),
(6, '2020-21', 6, '3', NULL),
(7, '2020-21', 7, '4', NULL),
(8, '2020-21', 8, '4', NULL),
(9, '2020-21', 9, '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_syllabus_config_transaction`
--

CREATE TABLE `tbl_syllabus_config_transaction` (
  `Id` int(11) NOT NULL,
  `ConfigId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `IsElective` char(1) NOT NULL DEFAULT '0',
  `ElectiveGroup` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_syllabus_config_transaction`
--

INSERT INTO `tbl_syllabus_config_transaction` (`Id`, `ConfigId`, `SubjectId`, `IsElective`, `ElectiveGroup`) VALUES
(1, 1, 1, '0', ''),
(2, 1, 2, '0', ''),
(3, 1, 3, '0', ''),
(4, 1, 4, '0', ''),
(5, 1, 5, '0', ''),
(6, 2, 6, '0', ''),
(7, 2, 7, '0', ''),
(8, 2, 8, '0', ''),
(9, 2, 9, '0', ''),
(10, 2, 10, '0', ''),
(11, 3, 11, '0', ''),
(12, 3, 12, '0', ''),
(13, 3, 13, '0', ''),
(14, 3, 14, '0', ''),
(15, 3, 19, '0', ''),
(16, 3, 20, '0', ''),
(17, 4, 21, '0', ''),
(18, 4, 22, '0', ''),
(19, 4, 23, '0', ''),
(20, 4, 24, '0', ''),
(21, 4, 25, '0', ''),
(22, 4, 26, '0', ''),
(23, 5, 27, '0', ''),
(24, 5, 28, '0', ''),
(25, 5, 29, '0', ''),
(26, 5, 30, '0', ''),
(27, 5, 31, '0', ''),
(28, 5, 37, '0', ''),
(29, 5, 38, '0', ''),
(30, 5, 39, '1', '1'),
(31, 5, 40, '1', '1'),
(32, 5, 41, '1', '1'),
(33, 5, 52, '1', '1'),
(34, 6, 65, '0', ''),
(35, 6, 66, '0', ''),
(36, 6, 67, '0', ''),
(37, 6, 71, '0', ''),
(38, 6, 72, '1', '1'),
(39, 6, 73, '1', '1'),
(40, 6, 74, '1', '1'),
(41, 6, 75, '1', '1'),
(42, 6, 76, '0', ''),
(43, 7, 53, '1', '1'),
(44, 7, 54, '1', '1'),
(45, 7, 55, '1', '1'),
(46, 7, 59, '1', '1'),
(47, 7, 60, '0', ''),
(48, 7, 61, '0', ''),
(49, 7, 62, '0', ''),
(50, 7, 64, '0', ''),
(51, 8, 81, '0', ''),
(52, 8, 82, '0', ''),
(53, 8, 83, '0', ''),
(54, 8, 84, '0', ''),
(55, 8, 85, '1', '2'),
(56, 8, 86, '1', '2'),
(57, 8, 87, '1', '2'),
(58, 8, 89, '1', '1'),
(59, 8, 90, '1', '1'),
(60, 8, 91, '1', '2'),
(61, 8, 88, '1', '1'),
(62, 7, 63, '0', ''),
(63, 9, 77, '0', ''),
(64, 9, 78, '0', ''),
(65, 9, 79, '0', ''),
(66, 9, 80, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(320) NOT NULL,
  `Password` char(64) NOT NULL,
  `UserType` char(1) NOT NULL DEFAULT '2',
  `FullName` varchar(100) NOT NULL,
  `Contact` char(10) NOT NULL,
  `Gender` char(1) NOT NULL,
  `ProfileImage` varchar(500) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`Id`, `Username`, `Password`, `UserType`, `FullName`, `Contact`, `Gender`, `ProfileImage`, `Status`) VALUES
(1, '18bmiit051@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '1', 'Admin', '9856325869', 'f', '../images/userdefault.png', '0'),
(6, '18bmiit119@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2', 'Abhay Lad', '9856325496', 'm', '../images/profile/1615881799.jpg', '0'),
(7, '18bmiit00@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '3', 'Akshay Patel', '9856321456', 'f', '../images/userdefault.png', '0'),
(8, 'damani.abha@gmail.com', '2b1b7edc71827a0fd04df6e8117bf9cdf9f5595ec1b22127768daf7f0ce3fb6d', '2', 'Sapan Naik', '9885454544', 'f', '../images/userdefault.png', '0'),
(9, '18bmiit104@gmail.com', '74611c1d6455b534323a21f8133a6f43dc3a8188e7b946f96dcc28dde932fcb2', '2', 'Deep Tallewar', '9874562641', 'm', '../images/userdefault.png', '0'),
(10, '18bmiit073@gmail.com', 'ceeceb979919fc7c108714ff9d90914b35ddf526855647faba86f8da1938602f', '2', 'Anjali Tailor', '9874565586', 'f', '../images/userdefault.png', '0'),
(11, '18bmiit008@gamil.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2', 'Darshan Patel', '9856321477', 'm', '../images/userdefault.png', '0'),
(12, '18bmiit067@gmail.com', 'b080819e30eee8cb1f7f79dabd138b8114c555281dcaccdc00efb72e2644c498', '2', 'Kishan Joshi', '9586542255', 'm', '../images/userdefault.png', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_bos`
--
ALTER TABLE `tbl_bos`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Enro` (`Enro`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_syllabus_config_assign`
--
ALTER TABLE `tbl_syllabus_config_assign`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_syllabus_config_master`
--
ALTER TABLE `tbl_syllabus_config_master`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_syllabus_config_transaction`
--
ALTER TABLE `tbl_syllabus_config_transaction`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bos`
--
ALTER TABLE `tbl_bos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbl_syllabus_config_assign`
--
ALTER TABLE `tbl_syllabus_config_assign`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_syllabus_config_master`
--
ALTER TABLE `tbl_syllabus_config_master`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_syllabus_config_transaction`
--
ALTER TABLE `tbl_syllabus_config_transaction`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
