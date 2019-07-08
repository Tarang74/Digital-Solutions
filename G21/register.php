<?php require_once ('session.php'); ?>

<?php

$firstName = $lastName = $email = $yearLevel = $username = $password = $confirm_password = "";
$firstName_error = $lastName_error = $email_error = $yearLevel_error = $username_error = $password_error = $confirm_password_error = "";

$username = substr($email, 0, 5);

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//Validate firstName
	if(empty(trim($_POST["firstName"]))) {
		$firstName_error = "First Name";
	} else {
		//Prepare a select statement
		$sql = "SELECT id FROM users WHERE username = ?";
		
		if($stmt = mysqli_prepare($link, $sql)) {
			//Bind variables to the prepared statement as paramaters
			mysqli_stmt_bind_param($stmt, "s", $param_firstName);
			
			//Set parameters
			$param_firstName = trim($_POST["firstName"]);
			
			//Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)) {
				// store result
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1) {
					$firstName_error = "First name already taken";
				} else {
					$firstName = trim($_POST["firstName"]);
				}
			} else {
				echo "something went wrong";
			}
		}
		
		//Close statement
		mysqli_stmt_close($stmt);
	}
	
	//Validate password
	if (empty(trim($_POST["password"]))) {
		$password_error = "Please enter a password.";
	} elseif(strlen(trim($_POST["password"])) < 6) {
		$password_error = "Password must have at least 6 characters.";
	} else {
		$password = trim($_POST["password"]);
	}
	
	//Validate Confirm password
	if (empty(trim($_POST["confirm_password"]))) {
		$comfirm_password_error = "Please reenter password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($password_error) && ($password != $confirm_password)) {
			$confirm_password_error = "Passwords do not match.";
		}
	}
	
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>