<?php
	if(isset($_SESSION['userID'])) {
		if($_SESSION['userRole'] == "student") {
			header("Location: student/student.php");
		} elseif($_SESSION['userRole'] == "mentor") {
			header("Location: mentor/mentor.php");
		} elseif($_SESSION['userRole'] == "teacher" || $_SESSION['userRole'] == "admin") {
			header("Location: teacher/teacher.php");
		}
	} else {
		header("Location: index.php?error=nouser33");
	}
?>