<<<<<<< HEAD
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
=======
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
>>>>>>> origin/master
