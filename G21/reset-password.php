<?php
session_start();

//Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

require_once "config.php";

//Define variables and initialise with empty values
$new_password = $confirm_password = "";
$new_password_error = $confirm_password_error = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] = "POST") {
	
	///Validate new password
	if(empty(trim($_POST["new_password"]))) {
		$new_password_error = "Please enter a new password.";
	} elseif(strlen(trim($_POST["new_password"])) < 6) {
		$new_password_error = "Password must have at least 6 characters.";
	} else {
		$new_password = trim($_POST["new_password"]);
	}

	//Validate confirm password
	if(empty(trim($_POST["confirm_password"]))) {
		$confirm_password_error = "Please reenter password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($new_password_error) && ($new_password != $confirm_password)) {
			$confirm_password_error = "Passwords do not match.";
		}
	}
	
	//Check input errors before update the database
	if(empty($new_password_error) && empty($confirm_password_error)) {
		//Prepare an update statement
		$sql = "UPDATE logintable SET password = ? WHERE userID = ?";
		
		if($stmt = mysqli_prepare($connection, $sql)) {
			//Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_userid);
			
			//Set parameters
			$param_password = password_has($new_password, PASSWORD_DEFAULT);
			$param_userid = $_SESSION["userID"];
			
			//Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)) {
				//Password update successfully. Destroy the sesion, and redirect to login page
				session_destroy();
				header("location: login.php");
				exit();
			} else {
				echo "Something went wrong. Please try again later.";
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
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_error)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_error; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_error)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>