<?php

if(isset($_POST['signup-submit'])) {
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $yearLevel = $username = $password = $passwordConfirm = $userRole = "";
	
	$firstName_error = $lastName_error = $gender_error = $yearLevel_error = $username_error = $password_error = $passwordConfirm_error = $userRole_error = "";

	$fn = $ln = $g = $yl = $e = $e_ = $p = $p_ = $pc = $ur = "";

	if(!empty($_POST['firstName'])) {
		$firstName = $_POST['firstName'];
	} else {
		$firstName_error = "Enter first name";
		$fn = "&empty=fn";
	}
	
	if(!empty($_POST['lastName'])) {
		$lastName = $_POST['lastName'];
	} else {
		$lastName_error = "Enter last name";
		$ln = "&empty=ln";
	}
	
	if(!empty($_POST['gender'])) {
		$gender = $_POST['gender'];
	} else {
		$gender_error = "Please select your gender";
		$g = "&empty=g";
	}
	
	if(!empty($_POST['yearLevel'])) {
		$yearLevel = $_POST['yearLevel'];
	} else {
		$yearLevel_error = "Please select year level";
		$yl = "&empty=yl";
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
				$u_ = "&invalid=u";
			}
		} else {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
	} else {
		$username_error = "Enter username";
		$u = "&empty=u";
	}
	
	if(empty($_POST['password'])) {
		$password_error = "Enter a password";
		$p = "&empty=p";
	} elseif(empty($_POST['passwordConfirm'])) {
			$passwordConfirm_error = "Confirm your password";
			$pc = "&empty=pc";
	} elseif(strlen($_POST['password']) < 6) {
			$password_error = "Use 6 or more characters for your password";
			$p_ = "&invalid=p";
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$passwordConfirm_error = "The passwords do not match. Try again.";
			$pc = "&invalid=pc";
	} else {
			$password = $_POST['password'];
	}
	
	if(!empty($_POST['userRole'])) {
		$userRole = $_POST['userRole'];
	} else {
		$firstName_error = "Enter user type";
		$ur = "&empty=ur";
	}
	
	if($fn || $ln || $g || $yl || $u || $u_ || $p || $p_ || $pc || $ur) {
		$empty = "";
		$invalid = "";
		
		$G_fn = $G_ln = $G_g = $G_yl = $G_u = "";
		
		if(!empty($firstName)) {
			$G_fn = "&fn=$firstName";
		}
		
		if(!empty($lastName)) {
			$G_ln = "&ln=$lastName";
		}
		
		if(!empty($gender)) {
			$G_g = "&g=$gender";
		}
		
		if(!empty($yearLevel)) {
			$G_yl = "&yl=$yearLevel";
		}
		
		if(!empty($username)) {
			$G_u = "&u=$username";
		}

		if($fn || $ln || $g || $yl || $u || $p || $pc || $ur) {
			$empty = "$fn$ln$g$yl$u$p$pc$ur";
		}
		if($u_ || $p_) {
			$invalid = "$u_$p_";
		}
		if($G_fn || $G_ln || $G_g || $G_yl || $G_u) {
			$fields = "$G_fn$G_ln$G_g$G_yl$G_u";
		}
		
		if(!empty($fields) || !empty($empty) || !empty($invalid)) { 
			header("Location: ../signup.php?error?$empty$invalid$fields");
			exit();
		}
	}
	
	if(empty($firstName_error) && empty($lastName_error) && empty($yearLevel_error) && empty($username_error) && empty($password_error) && empty($passwordConfirm_error) && empty($yserType_error)) {
		
		$sql = "INSERT INTO usertable (userRole, firstName, lastName, gender, yearLevel, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		$emailAddress = $username."@citipointe.qld.edu.au";
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "ssssisss", $userRole, $firstName, $lastName, $gender, $yearLevel, $emailAddress, $username, $p_password);
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