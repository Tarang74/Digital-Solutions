<?php

if(isset($_POST['signup-submit'])) {
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $yearLevel = $email = $password = $passwordConfirm = "";
	
	$firstName_error = $lastName_error = $gender_error = $yearLevel_error = $email_error = $password_error = $passwordConfirm_error = "";
	
	if(empty($_POST['firstName'])) {
		$firstName_error = "Enter first name";
		header("Location: ../signup.php?error=!fn");
		exit();
	} else {
			$firstName = $_POST['firstName'];
	}
	
	if(empty($_POST['lastName'])) {
		$lastName_error = "Enter last name";
		header("Location: ../signup.php?error=!ln");
		exit();
	} else {
			$lastName = $_POST['lastName'];
	}
	
	if(empty($_POST['gender'])) {
		$gender_error = "Please select your gender";
		header("Location: ../signup.php?error=!g");
		exit();
	} else {
			$gender = $_POST['gender'];
	}
	
	if(empty($_POST['yearLevel'])) {
		$yearLevel_error = "Please select your year level";
		header("Location: ../signup.php?error=!yl");
		exit();
	} else {
			$yearLevel = $_POST['yearLevel'];
	}
	
	if(empty($_POST['email'])) {
		$email_error = "Enter email";
		header("Location: ../signup.php?error=!e");
		exit();
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email_error = "Email is invalid";
			header("Location: ../signup.php?error=*e");
			exit();
	} else {
		
		$sql = "SELECT emailAddress FROM usertable WHERE userID = ?";
		$stmt = mysqli_stmt_init($connection);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		} else {
				mysqli_stmt_bind_param($stmt, "s", $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				
				if($resultCheck > 0) {
					$email_error = "That email is taken. Try another.";
					header("Location: ../signup.php?error=#e");
					exit();
				} else {
						$email = $_POST['email'];
				}
		}
	}
	
	if(empty($_POST['password'])) {
		$password_error = "Enter a password";
		header("Location: ../signup.php?error=!p");
		exit();
	} elseif($_POST['passwordConfirm']) {
			$passwordConfirm_error = "Confirm your password";
			header("Location: ../signup.php?error=!pc");
			exit();
	} elseif(strlen($_POST['password']) < 6) {
			$password_error = "Use 6 or more characters for your password";
			header("Location: ../signup.php?error=*p");
			exit();
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$passwordConfirm_error = "The passwords do not match. Try again.";
			header("Location: ../signup.php?error=p#pc");
			exit();
	} else {
			$password = $_POST['password'];
	}
	
	if(empty($firstName_error) && empty($lastName_error) && empty($yearLevel_error) && empty($email_error) && empty($password_error) && empty($passwordConfirm_error)) {
		//$sql = "INSERT INTO users (userRole, firstName, lastName, ) VALUES ()";
		header("Location: ../signup.php?complete");
		exit();
	}
}