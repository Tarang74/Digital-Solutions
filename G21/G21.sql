-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2019 at 10:06 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g21`
--

-- --------------------------------------------------------

--
-- Table structure for table `logintable`
--

CREATE TABLE `logintable` (
    `userID` int(1) NOT NULL PRIMARY KEY,
    `firstName` varchar(100) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(100) COLLATE utf8_bin NOT NULL,
    `yearLevel` int(2) NOT NULL,
    `email` varchar(200) COLLATE utf8_bin NOT NULL,
    `username` int(11) NOT NULL,
    `password` text COLLATE utf8_bin NOT NULL,
    `verified` boolean
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logintable`
--

INSERT INTO `logintable` (`userID`, `firstName`, `lastName`, `yearLevel`, `email`, `username`, `password`, `verified`) VALUES
(1, 'Jo', 'Smith', 7, 's12345@citipointe.qld.edu.au', 's12345', 'Abcde123', false);

-- --------------------------------------------------------

--
-- Table structure for table `usertypetable`
--

CREATE TABLE `usertypetable` (
    `userID` int(1) NOT NULL,
    `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usertypetable`
--

INSERT INTO `usertypetable` (`userID`, `userType`) VALUES
(1, 'Teacher'),
(2, 'Mentor'),
(3, 'Mentee');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktable`
--

CREATE TABLE `feedbacktable` (
    `feedbackID` int(5) NOT NULL PRIMARY KEY,
    `sessionID` int(5) NOT NULL,
    `feedbackText` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `feedbacktable`
--

INSERT INTO `feedbacktable` (`feedbackID`, `sessionID`, `feedbackText`) VALUES
(1, 1, 'This was a great session, thank you Jill I learnt a lot.');

-- --------------------------------------------------------

--
-- Table structure for table `housetable`
--

CREATE TABLE `housetable` (
    `houseID` int(1) NOT NULL PRIMARY KEY,
    `houseName` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `housetable`
--

INSERT INTO `housetable` (`houseID`, `houseName`) VALUES
(1, 'Asher'),
(2, 'Ephraim'),
(3, 'Judah'),
(4, 'Levi');

-- --------------------------------------------------------

--
-- Table structure for table `menteesubjecttable`
--

CREATE TABLE `menteesubjecttable` (
    `menteeID` int(5) NOT NULL PRIMARY KEY,
    `subjectID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `menteesubjecttable`
--

INSERT INTO `menteesubjecttable` (`menteeID`, `subjectID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menteetable`
--

CREATE TABLE `menteetable` (
    `menteeID` int(5) NOT NULL PRIMARY KEY,
    `firstName` varchar(64) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(64) COLLATE utf8_bin NOT NULL,
    `yearLevel` int(2) NOT NULL,
    `email` varchar(64) COLLATE utf8_bin NOT NULL,
    `gender` char(1) COLLATE utf8_bin NOT NULL,
    `houseID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `menteetable`
--

INSERT INTO `menteetable` (`menteeID`, `firstName`, `lastName`, `yearLevel`, `email`, `gender`, `houseID`) VALUES
(1, 'Jo', 'Smith', 7, 's12345@citipointe.qld.edu.au', 'M', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mentorsubjecttable`
--

CREATE TABLE `mentorsubjecttable` (
    `mentorID` int(5) NOT NULL,
    `subjectID` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mentorsubjecttable`
--

INSERT INTO `mentorsubjecttable` (`mentorID`, `subjectID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mentortable`
--

CREATE TABLE `mentortable` (
    `mentorID` int(5) NOT NULL PRIMARY KEY,
    `firstName` varchar(64) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(64) COLLATE utf8_bin NOT NULL,
    `yearLevel` int(2) NOT NULL,
    `email` varchar(64) COLLATE utf8_bin NOT NULL,
    `gender` char(1) COLLATE utf8_bin NOT NULL,
    `houseID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mentortable`
--

INSERT INTO `mentortable` (`mentorID`, `firstName`, `lastName`, `yearLevel`, `email`, `gender`, `houseID`) VALUES
(1, 'Sana', 'Robinson', 11, 's23456@email.com', 'F', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessionstable`
--

CREATE TABLE `sessionstable` (
    `sessionID` int(5) NOT NULL PRIMARY KEY,
    `date` date NOT NULL,
    `subjectID` int(2) NOT NULL,
    `menteeID` int(5) NOT NULL,
    `mentorID` int(5) NOT NULL,
    `teacherID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sessionstable`
--

INSERT INTO `sessionstable` (`sessionID`, `date`, `subjectID`, `menteeID`, `mentorID`, `teacherID`) VALUES
(1, '2019-05-16', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjecttable`
--

CREATE TABLE `subjecttable` (
    `subjectID` int(2) NOT NULL PRIMARY KEY,
    `subjectName` varchar(64) COLLATE utf8_bin NOT NULL,
    `subjectDescription` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `subjecttable`
--

INSERT INTO `subjecttable` (`subjectID`, `subjectName`, `subjectDescription`) VALUES
(1, 'Digital Solutions', 'Help with Digital Technologies or Digital Solutions.');

-- --------------------------------------------------------

--
-- Table structure for table `teachersubjecttable`
--

CREATE TABLE `teachersubjecttable` (
    `teacherID` int(5) NOT NULL,
    `subjectID` int(2) NOT NULL,
    `mentorID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `teachersubjecttable`
--

INSERT INTO `teachersubjecttable` (`teacherID`, `subjectID`, `mentorID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachertable`
--

CREATE TABLE `teachertable` (
    `teacherID` int(5) NOT NULL PRIMARY KEY,
    `firstName` varchar(64) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(64) COLLATE utf8_bin NOT NULL,
    `email` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `teachertable`
--

INSERT INTO `teachertable` (`teacherID`, `firstName`, `lastName`, `email`) VALUES
(1, 'Bryde', 'Dodd', 'bryded@citipointe.qld.edu.au');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
    ADD KEY `sessionID` (`sessionID`);

--
-- Indexes for table `menteesubjecttable`
--
ALTER TABLE `menteesubjecttable`
    ADD KEY `menteeID` (`menteeID`),
    ADD KEY `subjectID` (`subjectID`);

--
-- Indexes for table `menteetable`
--
ALTER TABLE `menteetable`
    ADD KEY `houseID` (`houseID`);

--
-- Indexes for table `mentorsubjecttable`
--
ALTER TABLE `mentorsubjecttable`
    ADD KEY `subjectID` (`subjectID`),
    ADD KEY `MentorSubjectTable_ibfk_1` (`mentorID`);

--
-- Indexes for table `mentortable`
--
ALTER TABLE `mentortable`
    ADD KEY `houseID` (`houseID`);

--
-- Indexes for table `sessionstable`
--
ALTER TABLE `sessionstable`
    ADD KEY `subjectID` (`subjectID`),
    ADD KEY `menteeID` (`menteeID`),
    ADD KEY `mentorID` (`mentorID`),
    ADD KEY `teacherID` (`teacherID`);

--
-- Indexes for table `teachersubjecttable`
--
ALTER TABLE `teachersubjecttable`
    ADD KEY `teacherID` (`teacherID`),
    ADD KEY `subjectID` (`subjectID`),
    ADD KEY `mentorID` (`mentorID`);

--
-- AUTO_INCREMENT for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
    MODIFY `feedbackID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menteetable`
--
ALTER TABLE `menteetable`
    MODIFY `menteeID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentortable`
--
ALTER TABLE `mentortable`
    MODIFY `mentorID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessionstable`
--
ALTER TABLE `sessionstable`
    MODIFY `sessionID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjecttable`
--
ALTER TABLE `subjecttable`
    MODIFY `subjectID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachertable`
--
ALTER TABLE `teachertable`
    MODIFY `teacherID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
    ADD CONSTRAINT `FeedbackTable_ibfk_1` FOREIGN KEY (`sessionID`) REFERENCES `sessionstable` (`sessionID`);

--
-- Constraints for table `menteesubjecttable`
--
ALTER TABLE `menteesubjecttable`
    ADD CONSTRAINT `MenteeSubjectTable_ibfk_1` FOREIGN KEY (`menteeID`) REFERENCES `menteetable` (`menteeID`),
    ADD CONSTRAINT `MenteeSubjectTable_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subjecttable` (`subjectID`);

--
-- Constraints for table `menteetable`
--
ALTER TABLE `menteetable`
    ADD CONSTRAINT `MenteeTable_ibfk_1` FOREIGN KEY (`houseID`) REFERENCES `housetable` (`houseID`);

--
-- Constraints for table `mentorsubjecttable`
--
ALTER TABLE `mentorsubjecttable`
    ADD CONSTRAINT `MentorSubjectTable_ibfk_1` FOREIGN KEY (`mentorID`) REFERENCES `mentortable` (`mentorID`),
    ADD CONSTRAINT `MentorSubjectTable_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `subjecttable` (`subjectID`);

--
-- Constraints for table `mentortable`
--
ALTER TABLE `mentortable`
    ADD CONSTRAINT `MentorTable_ibfk_1` FOREIGN KEY (`houseID`) REFERENCES `housetable` (`houseID`);

--
-- Constraints for table `sessionstable`
--
ALTER TABLE `sessionstable`
    ADD CONSTRAINT `SessionsTable_ibfk_1` FOREIGN KEY (`menteeID`) REFERENCES `menteetable` (`menteeID`),
    ADD CONSTRAINT `SessionsTable_ibfk_2` FOREIGN KEY (`mentorID`) REFERENCES `mentortable` (`mentorID`),
    ADD CONSTRAINT `SessionsTable_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `subjecttable` (`subjectID`),
    ADD CONSTRAINT `SessionsTable_ibfk_4` FOREIGN KEY (`teacherID`) REFERENCES `teachertable` (`teacherID`);

--
-- Constraints for table `teachersubjecttable`
--
ALTER TABLE `teachersubjecttable`
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `teachertable` (`teacherID`),
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_2` FOREIGN KEY (`mentorID`) REFERENCES `mentortable` (`mentorID`),
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `subjecttable` (`subjectID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;