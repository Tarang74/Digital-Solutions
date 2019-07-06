-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
-- Host: localhost
-- Generation Time: May 16, 2019 at 04:32 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+ 00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;


-- Database: `g21`

-- ------------------------------------------------

-- Table structure for table `FeedbackTable`
CREATE TABLE `FeedbackTable`(
    `feedbackID` int(11) NOT NULL,
    `sessionID` int(11) NOT NULL,
    `feedbackText` text COLLATE utf8_bin NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `FeedbackTable`
INSERT INTO `FeedbackTable` (`feedbackID`, `sessionID`, `feedbackText`)
VALUES (1, 1, 'This was a great session, thank you Jill I learnt a lot.');

-- ------------------------------------------------

-- Table structure for table `HouseTable`
CREATE TABLE `HouseTable` (
    `houseID` int(11) NOT NULL,
    `houseName` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `HouseTable`
INSERT INTO `HouseTable` (`houseID`, `houseName`) 
VALUES
    (1, 'Asher'), 
	(2, 'Ephraim'), 
	(3, 'Judah'), 
	(4, 'Levi');

-- ------------------------------------------------

-- Table structure for table `MenteeSubjectTable`
CREATE TABLE `MenteeSubjectTable` (
    `menteeID` int(11) NOT NULL,
    `subjectID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `MenteeSubjectTable`
INSERT INTO `MenteeSubjectTable` (`menteeID`, `subjectID`) 
VALUES (1, 1);

-- ------------------------------------------------

-- Table structure for table `MenteeTable`
CREATE TABLE `MenteeTable` (
    `menteeID` int(11) NOT NULL,
    `firstName` varchar(100) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(100) COLLATE utf8_bin NOT NULL,
    `yearLevel` int(11) NOT NULL,
    `email` varchar(200) COLLATE utf8_bin NOT NULL,
    `gender` char(1) COLLATE utf8_bin NOT NULL,
    `houseID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `MenteeTable`
INSERT INTO `MenteeTable` (`menteeID`, `firstName`, `lastName`, `yearLevel`, `email`, `gender`, `houseID`) 
VALUES (1, 'Jo', 'Smith', 's12345@citipointe.qld.edu.au', 'M', 9, 2);

-- ------------------------------------------------

-- Table structure for table `MentorSubjectTable`
CREATE TABLE `MentorSubjectTable` (
    `mentorID` int(11) NOT NULL,
    `subjectID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `MentorSubjectTable`
INSERT INTO `MentorSubjectTable` (`mentorID`, `subjectID`) 
VALUES (1, 1);

-- ------------------------------------------------

-- Table structure for table `MentorTable`
CREATE TABLE `MentorTable` (
    `mentorID` int(11) NOT NULL,
    `firstName` varchar(100) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(100) COLLATE utf8_bin NOT NULL,
    `yearLevel` int(11) NOT NULL,
    `email` varchar(200) COLLATE utf8_bin NOT NULL,
    `gender` char(1) COLLATE utf8_bin NOT NULL,
    `houseID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `MentorTable`
INSERT INTO `MentorTable` (`mentorID`, `firstName`, `lastName`, `yearLevel`, `email`, `gender`, `houseID`) 
VALUES (1, 'Jill', 'Jack', 's23456@citipointe.qld.edu.au', 'F', 11, 2);

-- ------------------------------------------------

-- Table structure for table `SessionsTable`
CREATE TABLE `SessionsTable` (
    `sessionID` int(11) NOT NULL,
    `date` date NOT NULL,
    `subjectID` int(11) NOT NULL,
    `menteeID` int(11) NOT NULL,
    `mentorID` int(11) NOT NULL,
    `teacherID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `SessionsTable`
INSERT INTO `SessionsTable` (`sessionID`, `date`, `subjectID`, `menteeID`, `mentorID`, `teacherID`) 
VALUES (1, '2019-05-16', 1, 1, 1, 1);

-- ------------------------------------------------

-- Table structure for table `SubjectTable`
CREATE TABLE `SubjectTable` (
    `subjectID` int(11) NOT NULL,
    `subjectName` varchar(100) COLLATE utf8_bin NOT NULL,
    `subjectDescription` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `SubjectTable`
INSERT INTO `SubjectTable` (`subjectID`, `subjectName`, `subjectDescription`) 
VALUES (1, 'Digital Solutions', 'Help with Digital Technologies or Digital Solutions.');

-- ------------------------------------------------

-- Table structure for table `TeacherSubjectTable`
CREATE TABLE `TeacherSubjectTable` (
    `teacherID` int(11) NOT NULL,
    `subjectID` int(11) NOT NULL,
    `mentorID` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `TeacherSubjectTable`
INSERT INTO `TeacherSubjectTable` (`teacherID`, `subjectID`, `mentorID`) 
VALUES (1, 1, 1);

-- ------------------------------------------------

-- Table structure for table `TeacherTable`
CREATE TABLE `TeacherTable` (
    `teacherID` int(11) NOT NULL,
    `firstName` varchar(100) COLLATE utf8_bin NOT NULL,
    `lastName` varchar(100) COLLATE utf8_bin NOT NULL,
    `email` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;

-- Dumping data for table `TeacherTable`
INSERT INTO `TeacherTable` (`teacherID`, `firstName`, `lastName`, `email`) 
VALUES (1, 'Bryde', 'Dodd', 'bryded@citipointe.qld.edu.au');

-- ------------------------------------------------

-- Indexes for dumped tables

-- ------------------------------------------------

-- Indexes for table `FeedbackTable`
ALTER TABLE `FeedbackTable`
    ADD PRIMARY KEY (`feedbackID`),
    ADD KEY `sessionID` (`sessionID`);

-- Indexes for table `HouseTable`
ALTER TABLE `HouseTable`
    ADD PRIMARY KEY (`houseID`);

-- Indexes for table `MenteeSubjectTable`
ALTER TABLE `MenteeSubjectTable`
    ADD KEY `menteeID` (`menteeID`),
    ADD KEY `subjectID` (`subjectID`);

-- Indexes for table `MenteeTable`
ALTER TABLE `MenteeTable`
    ADD PRIMARY KEY (`menteeID`),
    ADD KEY `houseID` (`houseID`);

-- Indexes for table `MentorSubjectTable`
ALTER TABLE `MentorSubjectTable`
    ADD KEY `subjectID` (`subjectID`),
    ADD KEY `MentorSubjectTable_ibfk_1` (`mentorID`);

-- Indexes for table `MentorTable`
ALTER TABLE `MentorTable`
    ADD PRIMARY KEY (`mentorID`),
    ADD KEY `houseID` (`houseID`);

-- Indexes for table `SessionsTable`
ALTER TABLE `SessionsTable`
    ADD PRIMARY KEY (`sessionID`),
    ADD KEY `subjectID` (`subjectID`),
    ADD KEY `menteeID` (`menteeID`),
    ADD KEY `mentorID` (`mentorID`),
    ADD KEY `teacherID` (`teacherID`);

-- Indexes for table `SubjectTable`
ALTER TABLE `subjectTable`
    ADD PRIMARY KEY (`subjectID`);

-- Indexes for table `TeacherSubjectTable`
ALTER TABLE `TeacherSubjectTable`
    ADD KEY `teacherID` (`teacherID`),
    ADD KEY `subjectID` (`subjectID`);
    ADD KEY `mentorID` (`mentorID`),

-- Indexes for table `TeacherTable`
ALTER TABLE `TeacherTable`
    ADD PRIMARY KEY (`teacherID`);

-- ------------------------------------------------

-- AUTO_INCREMENT for dumped tables

-- ------------------------------------------------

-- AUTO_INCREMENT for table `FeedbackTable`
ALTER TABLE `FeedbackTable`
    MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- AUTO_INCREMENT for table `HouseTable`
ALTER TABLE `HouseTable`
    MODIFY `houseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 5;
    
-- AUTO_INCREMENT for table `MenteeTable`
ALTER TABLE `MenteeTable`
    MODIFY `menteeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- AUTO_INCREMENT for table `MentorTable`
ALTER TABLE `MentorTable`
    MODIFY `mentorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- AUTO_INCREMENT for table `SessionsTable`
ALTER TABLE `SessionsTable`
    MODIFY `sessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- AUTO_INCREMENT for table `SubjectTable`
ALTER TABLE `SubjectTable`
    MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- AUTO_INCREMENT for table `TeacherTable`
ALTER TABLE `TeacherTable`
    MODIFY `teacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 2;

-- ------------------------------------------------

-- Constraints for dumped tables

-- ------------------------------------------------

-- Constraints for table `FeedbackTable`
ALTER TABLE `FeedbackTable`
    ADD CONSTRAINT `FeedbackTable_ibfk_1` FOREIGN KEY (`sessionID`) REFERENCES `SessionsTable` (`sessionID`);

-- Constraints for table `MenteeSubjectTable`
ALTER TABLE `MenteeSubjectTable`
    ADD CONSTRAINT `MenteeSubjectTable_ibfk_1` FOREIGN KEY (`menteeID`) REFERENCES `MenteeTable` (`menteeID`),
    ADD CONSTRAINT `MenteeSubjectTable_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `SubjectTable` (`subjectID`);

-- Constraints for table `MenteeTable`
ALTER TABLE `MenteeTable`
    ADD CONSTRAINT `MenteeTable_ibfk_1` FOREIGN KEY (`houseID`) REFERENCES `HouseTable` (`houseID`);

-- Constraints for table `MentorSubjectTable`
ALTER TABLE `MentorSubjectTable`
    ADD CONSTRAINT `MentorSubjectTable_ibfk_1` FOREIGN KEY (`mentorID`) REFERENCES `MentorTable` (`mentorID`),
    ADD CONSTRAINT `MentorSubjectTable_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `SubjectTable` (`subjectID`);

-- Constraints for table `MentorTable`
ALTER TABLE `MentorTable`
    ADD CONSTRAINT `MentorTable_ibfk_1` FOREIGN KEY (`houseID`) REFERENCES `HouseTable` (`houseID`);

-- Constraints for table `SessionsTable`
ALTER TABLE `SessionsTable`
    ADD CONSTRAINT `SessionsTable_ibfk_1` FOREIGN KEY (`menteeID`) REFERENCES `MenteeTable` (`menteeID`),
    ADD CONSTRAINT `SessionsTable_ibfk_2` FOREIGN KEY (`mentorID`) REFERENCES `MentorTable` (`mentorID`),
    ADD CONSTRAINT `SessionsTable_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `SubjectTable` (`subjectID`),
    ADD CONSTRAINT `SessionsTable_ibfk_4` FOREIGN KEY (`teacherID`) REFERENCES `TeacherTable` (`teacherID`);

-- Constraints for table `TeacherSubjectTable`
ALTER TABLE `TeacherSubjectTable`
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_1` FOREIGN KEY (`teacherID`) REFERENCES `TeacherTable` (`teacherID`),
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_2` FOREIGN KEY (`mentorID`) REFERENCES `MentorTable` (`mentorID`),
    ADD CONSTRAINT `TeacherSubjectTable_ibfk_3` FOREIGN KEY (`subjectID`) REFERENCES `SubjectTable` (`subjectID`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;