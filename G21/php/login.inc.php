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
					$_SESSION['username'] = $row['user_username'];
					
					header ("Location: ../index.php?login=success");
					exit();
				} else {
					header ("Location: ../index.php?error=wrongpassword");
					exit();
				}
			} else {
				header ("Location: ../index.php?error=nouser");
				exit();
			}
		}	
	}
} else {
	header ("Location: ../index.php");
	exit();
}