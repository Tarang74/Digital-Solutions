<?php

if(isset($_POST['login-submit'])) {
	
	require "session.php";
	
	$mailuid = $password = "";
	
	if(!empty($_POST['mailuid'])) {
		$mailuid = $_POST['mailuid'];
	}
	if(!empty($_POST['password'])) {
		$password = $_POST['password'];
	}
	
	if(empty($mailuid) || empty($password)) {
		header ("Location: ../index.php?error=emptyfields&u=$mailuid");
		exit();
	} else {
		$sql = "SELECT * FROM usertable WHERE user_username = ? OR emailAddress = ?;";
		$stmt = mysqli_stmt_init($connection);
		
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header ("Location: ../index.php?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if($row = mysqli_fetch_assoc($result)) {
				$passwordCheck = password_verify($password, $row['user_password']);
				if($passwordCheck == false) {
					header ("Location: ../index.php?error=wrongpassword");
					exit();
				} elseif($passwordCheck == true) {
					session_start();
					$_SESSION['userID'] = $row['userID'];
					$_SESSION['firstname'] = $row['firstName'];
					$_SESSION['lastname'] = $row['lastName'];
					
   				if($row['userRole'] == "student") {
						$_SESSION['userRole'] = "student";
						header("Location: ../welcome.php?userID=".$row['userID']);
					} elseif($row['userRole'] == "mentor") {
						$_SESSION['userRole'] = "mentor";
						header("Location: ../welcome.php?userID=".$row['userID']);
					} elseif($row['userRole'] == "teacher") {
						$_SESSION['userRole'] = "teacher";
						header("Location: ../welcome.php?userID=".$row['userID']);
					} elseif($row['userRole'] == "admin") {
						$_SESSION['userRole'] = "admin";
						header("Location: ../welcome.php?userID=".$row['userID']);
					}
					
					header ("Location: ../welcome.php");
					exit();
				} else {
					header ("Location: ../index.php?error=wrongpassword");
					exit();
				}
			} else {
				header ("Location: ../index.php?error=nouser2");
				exit();
			}
		}	
	}
} else {
	header ("Location: ../index.php");
	exit();
}