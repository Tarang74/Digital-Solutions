<?php
if(isset($_POST['cancel-booking-submit'])) {
	require "../php/session.php";
	
	$sessionID = $_POST['sessionID'];
	
	$string = "UPDATE sessionTable
					SET cancelled = !cancelled
					WHERE sessionID = " . $sessionID;
	$sql = $string;
	
	mysqli_query($connection, $sql);
	mysqli_close($connection);
	
	header("Location: student.php");
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}