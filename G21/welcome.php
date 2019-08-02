<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

	<?php include("header.php");?>
	
	<?php
	if(isset($_SESSION['userID'])) {
		if(isset($_SESSION['mentor'])) {
			header("Location: mentor/mentor.php");
		}
		if(isset($_SESSION['student'])) {
			header("Location: student/student.php");
		}
		if(isset($_SESSION['teacher'])) {
			header("Location: teacher/teacher.php");
		}
		
	} else {
		echo '<a id="toggle" style="cursor:pointer;">Login</a>';
	}
	?>
	
	<?php include("footer.php");?>
	</body>
</html>