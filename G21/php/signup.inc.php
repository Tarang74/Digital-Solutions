<?php

if(isset($_POST['signup-submit'])) {
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $yearLevel = $username = $password = $passwordConfirm = "";
	
	$firstName_error = $lastName_error = $gender_error = $yearLevel_error = $username_error = $password_error = $passwordConfirm_error = "";

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
		$yearLevel_error = "Please select year level";
		$yl = "&yl";
	}
	
	if(!empty($_POST['username'])) {
		
		$sql = "SELECT user_username FROM usertable WHERE userID = ?";
		$stmt = mysqli_stmt_init($connection);

		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if($resultCheck == 0) {
				$username = $_POST['username'];
			} else {
				$username_error = "That username is taken. Try another.";
				$u_ = "&u*";
			}
		} else {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
	} else {
		$username_error = "Enter username";
		$u = "&u";
	}
	
	if(empty($_POST['password'])) {
		$password_error = "Enter a password";
		$p = "&p";
	} elseif(empty($_POST['passwordConfirm'])) {
			$passwordConfirm_error = "Confirm your password";
			$pc = "&pc";
	} elseif(strlen($_POST['password']) < 6) {
			$password_error = "Use 6 or more characters for your password";
			$p_ = "&p*";
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$passwordConfirm_error = "The passwords do not match. Try again.";
			$pc = "&pc*";
	} else {
			$password = $_POST['password'];
	}
	
	if($fn || $ln || $g || $yl || $u || $u_ || $p || $p_ || $pc) {
		$empty = "";
		$invalid = "";
		
		$G_fn = $G_ln = $G_g = $G_yl = $G_u = "";
		
		if(!empty($firstName)) {
			$G_fn = "&g_fn=$firstName";
		}
		
		if(!empty($lastName)) {
			$G_ln = "&g_ln=$lastName";
		}
		
		if(!empty($gender)) {
			$G_g = "&g_g=$gender";
		}
		
		if(!empty($yearLevel)) {
			$G_yl = "&g_yl=$yearLevel";
		}
		
		if(!empty($username)) {
			$G_u = "&g_u=$username";
		}
		if($G_fn || $G_ln || $G_g || $G_yl || $G_u) {
			$fields = "$G_fn$G_ln$G_g$G_yl$G_u";
		}
		if($fn || $ln || $g || $yl || $u || $p || $pc) {
			$empty = "$fn$ln$g$yl$u$p$pc";
		}
		if($u_ || $p_) {
			$invalid = "$u_$p_";
		}
		
		if(!empty($fields) && !empty($empty) && !empty($invalid)) { 
			
			header("Location: ../signup.php?error=empty=$empty&&invalid=$invalid&&fields=$fields");
			exit();
		} elseif (!empty($empty) && !empty($invalid)) {
			
			header("Location: ../signup.php?error=empty=$empty&&invalid=$invalid");
			exit();
		} elseif (!empty($empty) && !empty($fields)) {
			
			header("Location: ../signup.php?error=empty=$empty&&fields=$fields");
			exit();
		} elseif (!empty($invalid) && !empty($fields)) {
			
			header("Location: ../signup.php?error=invalid=$invalid&&fields=$fields");
			exit();
		} elseif (!empty($empty)) {
			
			header("Location: ../signup.php?error=empty=$empty");
			exit();
		} elseif (!empty($invalid)) {
			
			header("Location: ../signup.php?error=invalid=$invalid");
			exit();
		}
	}
	
	if(empty($firstName_error) && empty($lastName_error) && empty($yearLevel_error) && empty($username_error) && empty($password_error) && empty($passwordConfirm_error)) {
		
		$sql = "INSERT INTO usertable (firstName, lastName, gender, yearLevel, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		$emailAddress = $username."@citipointe.qld.edu.au";
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "sssisss", $firstName, $lastName, $gender, $yearLevel, $emailAddress, $username, $p_password);
			$p_password = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_execute($stmt);
		}
		
		mysqli_stmt_close($stmt);
		mysqli_close($connection);
		
		header("Location: ../signup.php?signup=success");
		exit();
	}
} else {
	header("Location: ../signup.php");
	exit();
}