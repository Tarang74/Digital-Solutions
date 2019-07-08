<?php
    session_start();

	$host = "localhost";
	$adminUsername = "root";
	$adminPassword = "";
	$database = "G21";
	
	$connection = new mysqli($host, $adminUsername, $adminPassword, $database) or die ($connection->error);
//	$test = mysqli_connect($host, $adminUsername, $adminPassword, $database);
//	
//	if($test === true) {
//		die("SQL Connection Error" . mysqli_connect_error());
//	}
//
?>