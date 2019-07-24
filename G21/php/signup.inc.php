<?php

if(isset($_POST['signup-submit'])) {
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $yearLevel = $email = $password = $passwordConfirm = "";
	
	$firstName_error = $lastName_error = $gender_error = $yearLevel_error = $email_error = $password_error = $passwordConfirm_error = "";
	
	$fn = $ln = $g = $yl = $e = $e_ = $p = $p_ = $pc = "";
	
	if(!empty($_POST['firstName'])) {
		$firstName = $_POST['firstName'];
	} else {
		$firstName_error = "Enter first name";
		$fn = "&fn";
	}
	
	if(!empty($_POST['lastName'])) {
		$lastName = $_POST['lastName'];
	} else {
		$lastName_error = "Enter last name";
		$ln = "&ln";
	}
	
	if(!empty($_POST['gender'])) {
		$gender = $_POST['gender'];
	} else {
		$gender_error = "Please select your gender";
		$g = "&g";
	}
	
	if(!empty($_POST['yearLevel'])) {
		$yearLevel = $_POST['yearLevel'];
	} else {
		$yearLevel_error = "Please select your year level";
		$yl = "&yl";
	}
	
	if(!empty($_POST['email'])) {
		
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		
			$sql = "SELECT emailAddress FROM usertable WHERE userID = ?";
			$stmt = mysqli_stmt_init($connection);
			
			if(mysqli_stmt_prepare($stmt, $sql)) {
				mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				
				if($resultCheck = 0) {
					$email = $_POST['email'];
				} else {
					$email_error = "That email is taken. Try another.";
					$e_ = "&e*";
				}				
			} else {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			}
		} else {
			$email_error = "Email is invalid";
			$e_ = "&e";
			echo "invalidasdfafasdfasdf";
		}
		
	} else {
		$email_error = "Enter email";
		$e = "&e";
	}
	
	if(empty($_POST['password'])) {
		$password_error = "Enter a password";
		$p = "&p";
	} elseif(empty($_POST['passwordConfirm'])) {
			$passwordConfirm_error = "Confirm your password";
			$pc = "&pc";
	} elseif(strlen($_POST['password']) < 6) {
			$password_error = "Use 6 or more characters for your password";
			$p_ = "&p";
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$passwordConfirm_error = "The passwords do not match. Try again.";
			$pc = "&pc";
	} else {
			$password = $_POST['password'];
	}
	
	if($fn || $ln || $g || $yl || $e || $e_ || $p || $p_ || $pc) {
		$empty = "";
		$invalid = "";
		
		if($fn || $ln || $g || $yl || $e || $p || $pc) {
			$empty = "$fn$ln$g$yl$e$p$pc";
		}
		if($e_ || $p_) {
			$invalid = "$e_$p_";
		}
		
		if(!empty($empty) && !empty($invalid)) {
			$empty1 = "empty$empty";
			$invalid1 = "invalid$invalid";
			
			header("Location: ../signup.php?errors=$empty1*$invalid1");
			exit();
		} elseif (!empty($empty)) {
			$empty1 = "empty$empty";
			
			header("Location: ../signup.php?errors=$empty1");
			exit();
		} elseif (!empty($invalid)) {
			$invalid1 = "invalid$invalid";
			
			header("Location: ../signup.php?errors=$invalid1");
			exit();
		} 
	}
	
	if(empty($firstName_error) && empty($lastName_error) && empty($yearLevel_error) && empty($email_error) && empty($password_error) && empty($passwordConfirm_error)) {
		//$sql = "INSERT INTO users (userRole, firstName, lastName, ) VALUES ()";
		header("Location: ../signup.php?complete");
		exit();
	}
}