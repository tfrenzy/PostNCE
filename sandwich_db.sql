-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2017 at 02:06 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sandwich_db`
--
CREATE DATABASE `sandwich_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sandwich_db`;

-- --------------------------------------------------------

--
-- Table structure for table `excel_files`
--

CREATE TABLE `excel_files` (
  `FileName` varchar(50) NOT NULL,
  `MatNoStartCell` varchar(10) NOT NULL,
  `ScoresStartCell` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `excel_files`
--

INSERT INTO `excel_files` (`FileName`, `MatNoStartCell`, `ScoresStartCell`) VALUES
('excel/ENG203_1.xls', 'A5', 'B5'),
('excel/2.xls', 'a5', 'b5');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `User` varchar(20) NOT NULL,
  `ImagePath` varchar(30) NOT NULL,
  `Description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--


-- --------------------------------------------------------

--
-- Table structure for table `lecturecourses`
--

CREATE TABLE `lecturecourses` (
  `User` varchar(20) NOT NULL,
  `CourseCode` varchar(10) NOT NULL,
  `CourseTitle` varchar(30) NOT NULL,
  `LevelFor` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturecourses`
--

INSERT INTO `lecturecourses` (`User`, `CourseCode`, `CourseTitle`, `LevelFor`) VALUES
('btamienyo@yahoo.com', 'ENG 209.2', 'Engineering Thermodynamics', '');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `FullName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `MatNumber` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Level` varchar(5) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`FullName`, `Email`, `Phone`, `MatNumber`, `Password`, `Level`, `Status`) VALUES
('Tonye Amienyo', 'btamienyo@gmail.com', '09056775530', 'U95/43317', 'btTvXN165Jl1g', '1', 'Confirmed'),
('Nico Corleone', 'btamienyo@yahoo.com', '08033171294', 'U2001/30132', 'btlG04aKam0vM', '', 'Lecturer'),
('Denvenue', 'info@jaysoftnigeria.com', '09037035684', 'None', 'ingtby/Zo4b/2', '0', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `registeredcourses`
--

CREATE TABLE `registeredcourses` (
  `User` varchar(20) NOT NULL,
  `CourseCode` varchar(10) NOT NULL,
  `CourseTitle` varchar(30) NOT NULL,
  `CreditUnit` varchar(5) NOT NULL,
  `YearOfStudy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeredcourses`
--

INSERT INTO `registeredcourses` (`User`, `CourseCode`, `CourseTitle`, `CreditUnit`, `YearOfStudy`) VALUES
('btamienyo@gmail.com', 'ENG 203.1', 'Engineering Fluids and Mechani', '3', '2'),
('btamienyo@gmail.com', 'ENG 209.2', 'Engineering Thermodynamics', '3', '2'),
('btamienyo@gmail.com', 'ENG 202.1', 'Egineering Mathematics I', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `resultcomplaint`
--

CREATE TABLE `resultcomplaint` (
  `User` varchar(20) NOT NULL,
  `MatNo` varchar(20) NOT NULL,
  `CourseCode` varchar(15) NOT NULL,
  `CourseTitle` varchar(40) NOT NULL,
  `DateAttempted` varchar(20) NOT NULL,
  `CourseLecturer` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultcomplaint`
--

INSERT INTO `resultcomplaint` (`User`, `MatNo`, `CourseCode`, `CourseTitle`, `DateAttempted`, `CourseLecturer`) VALUES
('btamienyo@gmail.com', 'U95/42567', 'ENG 203.1', 'Fluid And Mechanics', '13 January 2000', 'Engr. Iyagba');

-- --------------------------------------------------------

--
-- Table structure for table `resultcomplaint1`
--

CREATE TABLE `resultcomplaint1` (
  `User` varchar(20) NOT NULL,
  `WrongScore` varchar(10) NOT NULL,
  `WrongAddition` varchar(10) NOT NULL,
  `MissingAssessScore` varchar(10) NOT NULL,
  `MissingExamScore` varchar(10) NOT NULL,
  `NoResult` varchar(10) NOT NULL,
  `TwoResults` varchar(10) NOT NULL,
  `WrongMatNo` varchar(10) NOT NULL,
  `CorrectMatNo` varchar(30) NOT NULL,
  `WrongName` varchar(10) NOT NULL,
  `CorrectName` varchar(40) NOT NULL,
  `Others` varchar(10) NOT NULL,
  `OthersDetail` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultcomplaint1`
--

INSERT INTO `resultcomplaint1` (`User`, `WrongScore`, `WrongAddition`, `MissingAssessScore`, `MissingExamScore`, `NoResult`, `TwoResults`, `WrongMatNo`, `CorrectMatNo`, `WrongName`, `CorrectName`, `Others`, `OthersDetail`) VALUES
('btamienyo@gmail.com', 'false', 'false', 'true', 'true', 'false', 'false', 'false', '', 'false', '', 'false', '');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `MatNumber` varchar(20) NOT NULL,
  `CourseCode` varchar(10) NOT NULL,
  `CourseTitle` varchar(30) NOT NULL,
  `Mark` varchar(10) NOT NULL,
  `Grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`MatNumber`, `CourseCode`, `CourseTitle`, `Mark`, `Grade`) VALUES
('U9542567', 'ENG 203.1', 'Engineering Mechanics', '70', 'A'),
('U95/42635', 'ENG 203.1', 'Engineering Mechanics', '54', 'C'),
('U95/43317', 'ENG 203.1', 'Engineering Mechanics', '34', 'F'),
('U95/42424', 'ENG 203.1', 'Engineering Mechanics', '43', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `sif1`
--

CREATE TABLE `sif1` (
  `User` varchar(20) NOT NULL,
  `FullName` varchar(30) NOT NULL,
  `FormerSurname` varchar(20) NOT NULL,
  `RegistrationNumber` varchar(20) NOT NULL,
  `PlaceOfOrigin` varchar(20) NOT NULL,
  `MaritalStatus` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif1`
--

INSERT INTO `sif1` (`User`, `FullName`, `FormerSurname`, `RegistrationNumber`, `PlaceOfOrigin`, `MaritalStatus`, `Religion`) VALUES
('btamienyo@gmail.com', 'Mr. Tonye Amienyo', '', 'REG/0001', 'Bayelsa', 'Married', 'Christianity');

-- --------------------------------------------------------

--
-- Table structure for table `sif2`
--

CREATE TABLE `sif2` (
  `User` varchar(20) NOT NULL,
  `PermHomeAddr` varchar(50) NOT NULL,
  `ContactAddr` varchar(60) NOT NULL,
  `NextOfKinName` varchar(30) NOT NULL,
  `NextOfKinAddress` varchar(60) NOT NULL,
  `NextOfKinRelationship` varchar(20) NOT NULL,
  `NextOfKinPhone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif2`
--

INSERT INTO `sif2` (`User`, `PermHomeAddr`, `ContactAddr`, `NextOfKinName`, `NextOfKinAddress`, `NextOfKinRelationship`, `NextOfKinPhone`) VALUES
('btamienyo@gmail.com', 'No 4 Harold Wilson Drive, Borikiri, Port Harcourt', 'No 4 Harold Wilson Drive, Borikiri, Port Harcourt', 'Mrs Amienyo', 'No 4 Harold Wilson Drive, Borikiri, Port Harcourt', 'Mother', '08035528583');

-- --------------------------------------------------------

--
-- Table structure for table `sif3`
--

CREATE TABLE `sif3` (
  `User` varchar(20) NOT NULL,
  `NameSponsor` varchar(30) NOT NULL,
  `SponsorAddr` varchar(50) NOT NULL,
  `SponsorPhone` varchar(15) NOT NULL,
  `ModeOfEntry` varchar(20) NOT NULL,
  `PreviousUniversity` varchar(30) NOT NULL,
  `ProgramType` varchar(15) NOT NULL,
  `Qualification` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif3`
--

INSERT INTO `sif3` (`User`, `NameSponsor`, `SponsorAddr`, `SponsorPhone`, `ModeOfEntry`, `PreviousUniversity`, `ProgramType`, `Qualification`) VALUES
('btamienyo@gmail.com', 'Self', 'No 4 Harold Wilson Drive, Borikiri, Port Harcourt', '09056775530', 'UME', '', 'Degree', 'WASC/GCE OL');

-- --------------------------------------------------------

--
-- Table structure for table `sif4`
--

CREATE TABLE `sif4` (
  `User` varchar(20) NOT NULL,
  `InstitutionObtained` varchar(50) NOT NULL,
  `DateObtained` varchar(15) NOT NULL,
  `SubjectFirstDegree` varchar(30) NOT NULL,
  `YearOfEntry` varchar(15) NOT NULL,
  `CollegeOfEntry` varchar(50) NOT NULL,
  `FacultyOfEntry` varchar(50) NOT NULL,
  `DeptOfEntry` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif4`
--

INSERT INTO `sif4` (`User`, `InstitutionObtained`, `DateObtained`, `SubjectFirstDegree`, `YearOfEntry`, `CollegeOfEntry`, `FacultyOfEntry`, `DeptOfEntry`) VALUES
('btamienyo@gmail.com', 'University of Port Harcourt Secondary School', '1993', '', '2017', 'Engineering', 'Electrical Engineering', 'Electrical/Electronic Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `sif5`
--

CREATE TABLE `sif5` (
  `User` varchar(20) NOT NULL,
  `QualificationInView` varchar(20) NOT NULL,
  `ModeOfStudy` varchar(35) NOT NULL,
  `NormalCourseDuration` varchar(15) NOT NULL,
  `Extracurricular` varchar(50) NOT NULL,
  `HealthStatus` varchar(20) NOT NULL,
  `DisableType` varchar(20) NOT NULL,
  `MedicationType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif5`
--

INSERT INTO `sif5` (`User`, `QualificationInView`, `ModeOfStudy`, `NormalCourseDuration`, `Extracurricular`, `HealthStatus`, `DisableType`, `MedicationType`) VALUES
('btamienyo@gmail.com', 'B.Sc.', 'Sandwich/Long vacation', '4 years', 'Reading, Swimming, Playing tennis', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sif6`
--

CREATE TABLE `sif6` (
  `User` varchar(20) NOT NULL,
  `Subject` varchar(20) NOT NULL,
  `ExamNumber` varchar(20) NOT NULL,
  `ExamCenter` varchar(50) NOT NULL,
  `Date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif6`
--

INSERT INTO `sif6` (`User`, `Subject`, `ExamNumber`, `ExamCenter`, `Date`) VALUES
('btamienyo@gmail.com', 'Mathematics', 'U93/234', 'UDSS Uniport', '12/3/1993'),
('btamienyo@gmail.com', 'English', 'U93/234', 'UDSS Uniport', '12/3/1993'),
('btamienyo@gmail.com', 'Physics', 'U93/234', 'UDSS Uniport', '12/3/1993'),
('btamienyo@gmail.com', 'Chemistry', 'U93/234', 'UDSS Uniport', '12/3/1993');

-- --------------------------------------------------------

--
-- Table structure for table `sif7`
--

CREATE TABLE `sif7` (
  `User` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `College` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sif7`
--

INSERT INTO `sif7` (`User`, `Name`, `College`) VALUES
('btamienyo@gmail.com', 'Tonye Amienyo', 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `waiverapplication`
--

CREATE TABLE `waiverapplication` (
  `User` varchar(20) NOT NULL,
  `MatNo` varchar(20) NOT NULL,
  `CourseCode1` varchar(20) NOT NULL,
  `CourseTitle1` varchar(30) NOT NULL,
  `DateAttempted1` varchar(20) NOT NULL,
  `CourseCode2` varchar(20) NOT NULL,
  `CourseTitle2` varchar(30) NOT NULL,
  `DateAttempted2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waiverapplication`
--

