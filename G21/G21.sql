CREATE TABLE houseTable (
	houseID INT PRIMARY KEY AUTO_INCREMENT, 
	houseName TEXT, 
);
INSERT INTO houseTable (houseID, houseName) VALUES
	(1, 'Asher'),
	(2, 'Ephraim'),
	(3, 'Judah'),
	(4, 'Levi');
	
CREATE TABLE userTable (
	userID INT AUTO_INCREMENT PRIMARY KEY,
	userRole ENUM('student', 'mentor', 'teacher'),
	houseID ENUM('1', '2', '3', '4'),
	firstName TEXT,
	lastName TEXT,
	gender ENUM('Male', 'Female'),
	yearLevel INT,
	emailAddress TEXT,
	user_username TEXT,
	user_password TEXT,
	userTS TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subjectTable (
	subjectID INT AUTO_INCREMENT PRIMARY KEY, 
	subjectName TEXT
);

CREATE TABLE studentTable (
	studentID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT
);

CREATE TABLE mentorTable (
	mentorID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT
);

CREATE TABLE teacherTable (
	teacherID INT AUTO_INCREMENT PRIMARY KEY,
	userID INT
);

CREATE TABLE sessionTable (
	sessionID INT AUTO_INCREMENT PRIMARY KEY,
	sessionRequestDate DATE,
	subjectID INT,
	studentID INT,
	mentorID INT,
	sessionComment TEXT,
	available BOOL DEFAULT FALSE,
	completed BOOL DEFAULT FALSE,
	sessionTS TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mentorSubjectTable (
	mentorID INT,
	subjectID INT
);

CREATE TABLE feedbackTable (
	feedbackID INT AUTO_INCREMENT PRIMARY KEY,
	sessionID INT,
	feedbackComment TEXT,
	feedbackTS TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);