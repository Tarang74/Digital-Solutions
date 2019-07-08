<?php
    session_start();

	$host = "localhost";
	$adminUsername = "root";
	$adminPassword = "";
	$database = "G21";
	
	$connection = mysqli_connect($host, $adminUsername, $adminPassword, $database);

	if($connection === false) {
		die("SQL Connection Error" . mysqli_connect_error());
	}
?>