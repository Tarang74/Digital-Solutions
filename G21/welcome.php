<?php
	session_start();

	if(isset($_SESSION['userID'])) {
		if(isset($_SESSION['student'])) {
			header("Location: student/student.php?userID=" . $GET['userID']);
		}
		
		if(isset($_SESSION['mentor'])) {
			header("Location: mentor/mentor.php?userID=" . $GET['userID']);
		}

		if(isset($_SESSION['teacher'])) {
			header("Location: teacher/teacher.php?userID=" . $GET['userID']);
		}
		
		if(isset($_SESSION['admin'])) {
			header("Location: teacher/teacher.php?userID=" . $GET['userID']);
		}
	}
?>
