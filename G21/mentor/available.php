<?php
if(isset($_POST['available-submit'])) {
	require "../php/session.php";
	
	$sql = "UPDATE sessionTable
					SET available = !available
					WHERE sessionID = " . $_POST['sessionID'];
	
	mysqli_query($connection, $sql);
	mysqli_close($connection);
	
	header("Location: mentor.php");
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}