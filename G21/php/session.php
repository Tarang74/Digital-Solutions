<?php

	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "G21";
	
	$connection = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

	if(!$connection) {
		die("SQL Connection Failed: ". mysqli_connect_error());
	}
?>