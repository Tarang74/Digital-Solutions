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
-- Database: G21
--

-- --------------------------------------------------------

--
-- Table structure for table LoginTable
--

CREATE TABLE LoginTable (
	userID int(1) NOT NULL,
    firstName varchar(100) COLLATE utf8_bin NOT NULL,
    lastName varchar(100) COLLATE utf8_bin NOT NULL,
    yearLevel int(2) NOT NULL,
    email varchar(200) COLLATE utf8_bin NOT NULL,
    username int(11) NOT NULL,
    password varchar(50) COLLATE utf8_bin NOT NULL,
    verified boolean
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table LoginTable
--

INSERT INTO LoginTable (userID, firstName, lastName, yearLevel, email, username, password, verified) VALUES
(1, 'Jo', 'Smith', 7, 's12345@citipointe.qld.edu.au', 's12345', 'Abcde123', false);

-- --------------------------------------------------------

--
-- Table structure for table UserTypeTable
--

CREATE TABLE UserTypeTable (
    userID int(1) NOT NULL PRIMARY KEY,
    userType varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table UserTypeTable
--

INSERT INTO UserTypeTable (userID, userType) VALUES
(1, 'Teacher'),
(2, 'Mentor'),
(3, 'Mentee');

-- --------------------------------------------------------

--
-- Table structure for table FeedbackTable
--

CREATE TABLE FeedbackTable (
    feedbackID int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	sessionID int(5) NOT NULL,
    feedbackText text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table FeedbackTable
--

INSERT INTO FeedbackTable (feedbackID, sessionID, feedbackText) VALUES
(1, 1, 'This was a great session, thank you Jill I learnt a lot.');

-- --------------------------------------------------------

--
-- Table structure for table HouseTable
--

CREATE TABLE HouseTable (
    houseID int(1) NOT NULL PRIMARY KEY,
    houseName varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table HouseTable
--

INSERT INTO HouseTable (houseID, houseName) VALUES
(1, 'Asher'),
(2, 'Ephraim'),
(3, 'Judah'),
(4, 'Levi');

-- --------------------------------------------------------

--
-- Table structure for table MenteeSubjectTable
--

CREATE TABLE MenteeSubjectTable (
    menteeID int(5) NOT NULL PRIMARY KEY,
    subjectID int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table MenteeSubjectTable
--

INSERT INTO MenteeSubjectTable (menteeID, subjectID) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table MenteeTable
--

CREATE TABLE MenteeTable (
    menteeID int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(64) COLLATE utf8_bin NOT NULL,
    lastName varchar(64) COLLATE utf8_bin NOT NULL,
    yearLevel int(2) NOT NULL,
    email varchar(64) COLLATE utf8_bin NOT NULL,
    gender char(1) COLLATE utf8_bin NOT NULL,
    houseID int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table MenteeTable
--

INSERT INTO MenteeTable (menteeID, firstName, lastName, yearLevel, email, gender, houseID) VALUES
(1, 'Jo', 'Smith', 7, 's12345@citipointe.qld.edu.au', 'M', 2);

-- --------------------------------------------------------

--
-- Table structure for table MentorSubjectTable
--

CREATE TABLE MentorSubjectTable (
    mentorID int(5) NOT NULL,
    subjectID int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table MentorSubjectTable
--

INSERT INTO MentorSubjectTable (mentorID, subjectID) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table MentorTable
--

CREATE TABLE MentorTable (
    mentorID int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(64) COLLATE utf8_bin NOT NULL,
    lastName varchar(64) COLLATE utf8_bin NOT NULL,
    yearLevel int(2) NOT NULL,
    email varchar(64) COLLATE utf8_bin NOT NULL,
    gender char(1) COLLATE utf8_bin NOT NULL,
    houseID int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table MentorTable
--

INSERT INTO MentorTable (mentorID, firstName, lastName, yearLevel, email, gender, houseID) VALUES
(1, 'Sana', 'Robinson', 11, 's23456@email.com', 'F', 2);

-- --------------------------------------------------------

--
-- Table structure for table SessionTable
--

CREATE TABLE SessionTable (
    sessionID int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    date date NOT NULL,
    subjectID int(2) NOT NULL,
    menteeID int(5) NOT NULL,
    mentorID int(5) NOT NULL,
    teacherID int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table SessionTable
--

INSERT INTO SessionTable (sessionID, date, subjectID, menteeID, mentorID, teacherID) VALUES
(1, '2019-05-16', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table SubjectTable
--

CREATE TABLE SubjectTable (
    subjectID int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    subjectName varchar(64) COLLATE utf8_bin NOT NULL,
    subjectDescription varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table SubjectTable
--

INSERT INTO SubjectTable (subjectID, subjectName, subjectDescription) VALUES
(1, 'Digital Solutions', 'Help with Digital Technologies or Digital Solutions.');

-- --------------------------------------------------------

--
-- Table structure for table TeacherSubjectTable
--

CREATE TABLE TeacherSubjectTable (
    teacherID int(5) NOT NULL,
    subjectID int(2) NOT NULL,
    mentorID int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table TeacherSubjectTable
--

INSERT INTO TeacherSubjectTable (teacherID, subjectID, mentorID) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table TeacherTable
--

CREATE TABLE TeacherTable (
    teacherID int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(64) COLLATE utf8_bin NOT NULL,
    lastName varchar(64) COLLATE utf8_bin NOT NULL,
    email varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table TeacherTable
--

INSERT INTO TeacherTable (teacherID, firstName, lastName, email) VALUES
(1, 'Bryde', 'Dodd', 'bryded@citipointe.qld.edu.au');

--
-- Constraints for dumped tables
--

--
-- Constraints for table LoginTable
--
ALTER TABLE LoginTable
    ADD CONSTRAINT LoginTable_fk_1 FOREIGN KEY (userID) REFERENCES UserTypeTable (userID);

--
-- Constraints for table FeedbackTable
--
ALTER TABLE FeedbackTable
    ADD CONSTRAINT FeedbackTable_fk_1 FOREIGN KEY (sessionID) REFERENCES SessionTable (sessionID);

--
-- Constraints for table MenteeSubjectTable
--
ALTER TABLE MenteeSubjectTable
    ADD CONSTRAINT MenteeSubjectTable_fk_1 FOREIGN KEY (menteeID) REFERENCES MenteeTable (menteeID),
    ADD CONSTRAINT MenteeSubjectTable_fk_2 FOREIGN KEY (subjectID) REFERENCES SubjectTable (subjectID);

--
-- Constraints for table MenteeTable
--
ALTER TABLE MenteeTable
    ADD CONSTRAINT MenteeTable_fk_1 FOREIGN KEY (houseID) REFERENCES HouseTable (houseID);

--
-- Constraints for table MentorSubjectTable
--
ALTER TABLE MentorSubjectTable
    ADD CONSTRAINT MentorSubjectTable_fk_1 FOREIGN KEY (mentorID) REFERENCES MentorTable (mentorID),
    ADD CONSTRAINT MentorSubjectTable_fk_2 FOREIGN KEY (subjectID) REFERENCES SubjectTable (subjectID);

--
-- Constraints for table MentorTable
--
ALTER TABLE MentorTable
    ADD CONSTRAINT MentorTable_fk_1 FOREIGN KEY (houseID) REFERENCES HouseTable (houseID);

--
-- Constraints for table SessionTable
--
ALTER TABLE SessionTable
    ADD CONSTRAINT SessionTable_fk_1 FOREIGN KEY (menteeID) REFERENCES MenteeTable (menteeID),
    ADD CONSTRAINT SessionTable_fk_2 FOREIGN KEY (mentorID) REFERENCES MentorTable (mentorID),
    ADD CONSTRAINT SessionTable_fk_3 FOREIGN KEY (subjectID) REFERENCES SubjectTable (subjectID),
    ADD CONSTRAINT SessionTable_fk_4 FOREIGN KEY (teacherID) REFERENCES TeacherTable (teacherID);

--
-- Constraints for table TeacherSubjectTable
--
ALTER TABLE TeacherSubjectTable
    ADD CONSTRAINT TeacherSubjectTable_fk_1 FOREIGN KEY (teacherID) REFERENCES TeacherTable (teacherID),
    ADD CONSTRAINT TeacherSubjectTable_fk_2 FOREIGN KEY (mentorID) REFERENCES MentorTable (mentorID),
    ADD CONSTRAINT TeacherSubjectTable_fk_3 FOREIGN KEY (subjectID) REFERENCES SubjectTable (subjectID);
	

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;