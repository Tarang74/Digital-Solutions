<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>G21</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	

	
	<?php require("login.php"); ?>
	
	<?php 
		if(isset($_SESSION['userID'])) {
			if(isset($_SESSION['student'])) {
				header("Location: student/student.php");
			} elseif(isset($_SESSION['mentor'])) {
				header("Location: mentor/mentor.php");
			} elseif(isset($_SESSION['teacher'])) {
				header("Location: teacher/teacher.php");
			}
		}
	?>
	
	<?php require("footer.php"); ?>
</body>
</html>