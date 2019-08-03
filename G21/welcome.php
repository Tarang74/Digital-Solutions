<?php
	session_start();

	if(isset($_SESSION['userID'])) {
		if(isset($_SESSION['student'])) {
			header("Location: student/student.php?userID=");
		}
		
		if(isset($_SESSION['mentor'])) {
			header("Location: mentor/mentor.php?userID=");
		}

		if(isset($_SESSION['teacher'])) {
			header("Location: teacher/teacher.php?userID=");
		}
		
		if(isset($_SESSION['admin'])) {
			header("Location: teacher/teacher.php?userID="); // not necessary -- just for testing purposes
		}
	} else {
		echo $_SESSION['userID'].'<a id="toggle" style="cursor:pointer;">Login</a>';
	}
?>
