<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>G21</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require("header.php"); ?>
	
	<?php 
		if(isset($_SESSION['userID'])) {
			echo '<p>You are logged in</p>';
		} else {
			echo '<p>You are logged out</p>';
		}
	?>
	
	<?php require("footer.php"); ?>
</body>
</html>