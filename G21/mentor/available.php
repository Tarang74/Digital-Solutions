<?php
if(isset($_POST['available-submit'])) {
	require "../php/session.php";
	
	$sessionID = $_POST['sessionID'];
	
	$string = "UPDATE sessionTable
					SET available = !available
					WHERE sessionID = " . $sessionID;
	$sql = $string;
	
	mysqli_query($connection, $sql);
	mysqli_close($connection);
	
	header("Location: mentor.php");
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}