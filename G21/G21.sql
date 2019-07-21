CREATE TABLE userTable (
	userID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userRole enum('admin','teacher','mentor','student') NOT NULL DEFAULT 'student',
	firstName varchar(100) NOT NULL,
	lastName varchar(100) NOT NULL,
	gender enum('Male','Female') NOT NULL,
	yearLevel int,
	emailAddress varchar(100) NOT NULL,
	user_username varchar(100),
	user_password varchar(100) NOT NULL,
	userTS timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	verified boolean DEFAULT false
);

INSERT INTO userTable (userID, userRole, user_username, user_password, verified) VALUES
(1,'admin','admin','adminpass',true);

CREATE TABLE sessionTable (
	sessionID int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	sessionTS timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	subjectID int NOT NULL,
	studentID int NOT NULL,
	mentorID int,
	teacherID int
);
	
CREATE TABLE subjectTable (
	subjectID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	subjectName varchar(100) NOT NULL UNIQUE,
	subjectDescription varchar(100) NOT NULL
);

CREATE TABLE teacherTable (
	teacherID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userID int NOT NULL,
	firstName varchar(100) NOT NULL,
	lastName varchar(100) NOT NULL,
	emailAddress varchar(100) NOT NULL
);

CREATE TABLE mentorTable (
	mentorID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userID int NOT NULL,
	firstName varchar(100) NOT NULL,
	lastName varchar(100) NOT NULL,
	yearLevel int NOT NULL,
	emailAddress varchar(100) NOT NULL
);

CREATE TABLE studentTable (
	studentID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userID int NOT NULL,
	firstName varchar(100) NOT NULL,
	lastName varchar(100) NOT NULL,
	yearLevel int NOT NULL,
	emailAddress varchar(100) NOT NULL
);

CREATE TABLE teacherSubjectTable (
	teacherID int NOT NULL,
	subjectID int NOT NULL
);

CREATE TABLE mentorSubjectTable (
	mentorID int NOT NULL,
	subjectID int NOT NULL
);

CREATE TABLE studentSubjectTable (
	studentID int NOT NULL,
	subjectID int NOT NULL
);

CREATE TABLE feedbackTable (
	feedbackID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	sessionID int NOT NULL,
	feedbackTS timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	feedbackText varchar(100) NOT NULL
);

ALTER TABLE userTable
  MODIFY userID int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE sessionTable
	ADD CONSTRAINT sessionTable_fk_1 FOREIGN KEY (subjectID) REFERENCES subjectTable (subjectID),
	ADD CONSTRAINT sessionTable_fk_2 FOREIGN KEY (studentID) REFERENCES studentTable (studentID),
	ADD CONSTRAINT sessionTable_fk_3 FOREIGN KEY (mentorID) REFERENCES mentorTable (mentorID),
	ADD CONSTRAINT sessionTable_fk_4 FOREIGN KEY (teacherID) REFERENCES teacherTable (teacherID);

ALTER TABLE teacherTable
	ADD CONSTRAINT teacherTable_fk_1 FOREIGN KEY (userID) REFERENCES userTable (userID);

ALTER TABLE mentorTable
	ADD CONSTRAINT mentorTable_fk_1 FOREIGN KEY (userID) REFERENCES userTable (userID);

ALTER TABLE studentTable
	ADD CONSTRAINT studentTable_fk_1 FOREIGN KEY (userID) REFERENCES userTable (userID);

ALTER TABLE teacherSubjectTable
	 ADD CONSTRAINT teacherSubjectTable_fk_1 FOREIGN KEY (teacherID) REFERENCES teacherTable (teacherID),
	 ADD CONSTRAINT teacherSubjectTable_fk_2 FOREIGN KEY (subjectID) REFERENCES subjectTable (subjectID);

ALTER TABLE mentorSubjectTable
	ADD CONSTRAINT mentorSubjectTable_fk_1 FOREIGN KEY (mentorID) REFERENCES mentorTable (mentorID),
	ADD CONSTRAINT mentorSubjectTable_fk_2 FOREIGN KEY (subjectID) REFERENCES subjectTable (subjectID);
	
ALTER TABLE studentSubjectTable
	ADD CONSTRAINT studentSubjectTable_fk_1 FOREIGN KEY (studentID) REFERENCES studentTable (studentID),
	ADD CONSTRAINT studentSubjectTable_fk_2 FOREIGN KEY (subjectID) REFERENCES subjectTable (subjectID);

ALTER TABLE feedbackTable
	ADD CONSTRAINT feedbackTable_fk_1 FOREIGN KEY (sessionID) REFERENCES sessionTable (sessionID);