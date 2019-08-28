<?php
if(isset($_POST['subject-submit'])) {
	require "../php/session.php";
	
	if(!empty($_POST['subject-name'])) {
		$subjectName = $_POST['subject-name'];
	}
	
	$sql = "INSERT INTO subjectTable (subjectName) VALUES
					(?)";
	
	$stmt = mysqli_stmt_init($connection);
	
	if(mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "s", $subjectName);
		
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	mysqli_close($connection);
	
	header("Location: teacher.php?addsubject=success");
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}