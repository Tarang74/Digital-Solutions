<?php require_once ('session.php'); ?>

<?php

$firstName = $lastName = $email = $yearLevel = $username = $password = $confirm_password = "";
$firstName_error = $lastName_error = $email_error = $yearLevel_error = $username_error = $password_error = $confirm_password_error = "";

$userID = 1;
$username = substr($email, 0, 5);

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//Validate username
	if(empty(trim($_POST["username"]))) {
		$username_error = "Enter Username.";
	} else {
		//Prepare a select statement
		$sql = "SELECT id FROM users WHERE username = ?";
		
		if($stmt = mysqli_prepare($connection, $sql)) {
			//Bind variables to the prepared statement as paramaters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			//Set parameters
			$param_username = trim($_POST["username"]);
			
			//Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)) {
				// store result
				mysqli_stmt_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1) {
					$username_error = "Account with username already exists.";
				} else {
					$username = trim($_POST["username"]);
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
	
	//Check input errors before inserting in database
	if(/*empty($firstName_error) && empty($lastName_error) && empty($email_error) && empty($yearLevel_error) && */empty($username_error) && empty($password_error) && empty($confirm_password_error)) {
		
		//Prepare an insert statement
		$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
		
		if($stmt = mysqli_prepare($connection, $sql)) {
			//Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			
			//Set parameters
			$param_username = $username;
			$param_password = password_hash($password, PASSWORD_DEFAULT);
			//Creates password hash
			
			//Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)) {
				//Redirect to login page
				header("location: login.php");
			} else {
				echo "Something went wroooong.";
			}
		}
		
		//Close statement
		mysqli_stmt_close($stmt);
	}
	
	//Close connection
	mysqli_close($connection);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_error)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_error; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_error)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_error; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_error)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>