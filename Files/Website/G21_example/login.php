<?php
	// Start the session ** must be before html tags **
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- make sure you change the title to match your page -->
<title>G21 Example Website</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="../../../G21_example/css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
	/**** define variables ****/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "G21_example";

	// Create connection to the database
	$conn = new mysqli($servername, $username, $password, $dbName);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	/*if using login use a session variable to store the users role and id
	NOTE: you must start the session at the start of the file and assign the login details to the session variables. You must destroy the session when the user logs out.
	*/
	// Set session variables
	$_SESSION["userID"] = "1";
	$_SESSION["role"] = "mentee";
	
?>

<!-- include navigation bar on all pages, so you only have to update ONE file (nav.php) when changes are made -->
<?php include("../../../G21_example/nav.php"); ?>
	<form action="login.php">
	<div class="imgcontainer">
    <img src="../../../G21_example/img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" value="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
		
</body>
</html>