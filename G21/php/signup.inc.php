<?php

if(isset($_POST['signup-submit'])) {
	session_start();
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $yearLevel = $username = $password = $passwordConfirm = $userRole = $house = "";
	
	$fn_e = $ln_e = $g_e = $yl_e = $u_e = $p_e = $pc_e = $ur_e = $h_e = $u_i = $p_i = $pc_i = "";

	if(!empty($_POST['firstName'])) {
		$firstName = $_POST['firstName'];
	} else {
		$fn_e = "&empty=fn";
	}
	
	if(!empty($_POST['lastName'])) {
		$lastName = $_POST['lastName'];
	} else {
		$ln_e = "&empty=ln";
	}
	
	if(!empty($_POST['gender'])) {
		$gender = $_POST['gender'];
	} else {
		$g_e = "&empty=g";
	}
	
	if(!empty($_POST['yearLevel'])) {
		$yearLevel = $_POST['yearLevel'];
	} else {
		$yl_e = "&empty=yl";
	}
	
	if(!empty($_POST['username'])) {
		
		$sql = "SELECT user_username FROM usertable WHERE user_username = ?";
		$stmt = mysqli_stmt_init($connection);

		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if($resultCheck == 0) {
				$username = $_POST['username'];
			} else {
				$u_i = "&invalid=u";
			}
		} else {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
	} else {
		$u_e = "&empty=u";
	}
	
	if(empty($_POST['password'])) {
		$p_e = "&empty=p";
	} elseif(empty($_POST['passwordConfirm'])) {
			$pc_e = "&empty=pc";
	} elseif(strlen($_POST['password']) < 6) {
			$p_i = "&invalid=p";
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$pc_i = "&invalid=pc";
	} else {
			$password = $_POST['password'];
	}
	
	if(!empty($_POST['userRole'])) {
		$userRole = $_POST['userRole'];
	} else {
		$ur_e = "&empty=ur";
	}
	
	if(!empty($_POST['house'])) {
		$house = $_POST['house'];
	} else {
		$h_e = "&empty=h";
	}
	
	if(!empty($_POST['subject'])) {
		$subject = $_POST['subject'];
	}
	
	if($fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e || $u_i || $p_i || $pc_i) {
		$empty = "";
		$invalid = "";
		
		if($fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e) {
			$empty = "$fn_e$ln_e$g_e$yl_e$u_e$p_e$pc_e$ur_e$h_e";
		}
		
		if($u_i || $p_i || $pc_i) {
			$invalid = "$u_i$p_i$pc_i";
		}
		
		$message = password_hash($empty . $invalid, PASSWORD_DEFAULT);
		
		if(!empty($empty) || !empty($invalid)) {
			if($fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e) {
				$_SESSION['emptyfields'] = "emptyfields";
			}
			
			if($u_i) {
				$_SESSION['error'] = "username_i";
			}
			
			if($p_i) {
				$_SESSION['error1'] = "password_i";
			}
			
			if($pc_i) {
				$_SESSION['error2'] = "passwordConfirm_i";
			}
			
			header("Location: ../signup.php?$message");
			exit();
		}
	}
	
	if(empty($fn_e) && empty($ln_e) && empty($yl_e) && empty($u_e) && empty($p_e) && empty($pc_e) && empty($ur_e) && empty($u_i) && empty($p_i) && empty($pc_i)) {
		
		$sql = "INSERT INTO usertable (userRole, houseID, firstName, lastName, gender, yearLevel, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		$emailAddress = $username."@citipointe.qld.edu.au";
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "sisssisss", $userRole, $house,  $firstName, $lastName, $gender, $yearLevel, $emailAddress, $username, $p_password);
			$p_password = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			
			$sql1 = "INSERT INTO " . $userRole . "Table (userID) SELECT MAX(userID) AS userID FROM userTable";
			mysqli_query($connection, $sql1);
			if($userRole == "mentor") {
				$sql2 = 
					"SELECT MAX(mentorID)
					FROM mentorTable";
				$result = mysqli_query($connection, $sql2);
				$row = mysqli_fetch_assoc($result);
				
				$sql3 = "INSERT INTO mentorSubjectTable (mentorID, subjectID) VALUES (?, ?)";
				$stmt = mysqli_stmt_init($connection);
				
				if(mysqli_stmt_prepare($stmt, $sql3)) {
					mysqli_stmt_bind_param($stmt, "ii", $row['mentorID'], $subject);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
			}
		}

		mysqli_close($connection);
		
		header("Location: ../index.php?signup=success");
		exit();
	}
} 

if(isset($_POST['t-signup-submit'])) {
	
	require 'session.php';
	
	$firstName = $lastName = $gender = $username = $password = $passwordConfirm = $userRole = "";
	
	$fn_e = $ln_e = $g_e = $u_e = $p_e = $pc_e = $ur_e = $u_i = $p_i = $pc_i = "";

	if(!empty($_POST['firstName'])) {
		$firstName = $_POST['firstName'];
	} else {
		$fn_e = "&empty=fn";
	}
	
	if(!empty($_POST['lastName'])) {
		$lastName = $_POST['lastName'];
	} else {
		$ln_e = "&empty=ln";
	}
	
	if(!empty($_POST['gender'])) {
		$gender = $_POST['gender'];
	} else {
		$g_e = "&empty=g";
	}

	if(!empty($_POST['username'])) {
		
		$sql = "SELECT user_username FROM usertable WHERE user_username = ?";
		$stmt = mysqli_stmt_init($connection);

		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if($resultCheck == 0) {
				$username = $_POST['username'];
			} else {
				$u_i = "&invalid=u";
			}
		} else {
			header("Location: ../t-signup.php?error=sqlerror");
			exit();
		}
	} else {
		$u_e = "&empty=u";
	}
	
	if(empty($_POST['password'])) {
		$p_e = "&empty=p";
	} elseif(empty($_POST['passwordConfirm'])) {
			$pc_e = "&empty=pc";
	} elseif(strlen($_POST['password']) < 6) {
			$p_i = "&invalid=p";
	} elseif ($_POST['password'] !== $_POST['passwordConfirm']) {
			$pc_i = "&invalid=pc";
	} else {
			$password = $_POST['password'];
	}
	
	if(!empty($_POST['userRole'])) {
		$string = $_POST['userRole'];
		$userRole = strtolower($string);
	} else {
		$ur_e = "&empty=ur";
	}
	
	if($fn_e || $ln_e || $g_e || $u_e || $p_e || $pc_e || $ur_e || $u_i || $p_i || $pc_i) {
		$empty = "";
		$invalid = "";
		
		if($fn_e || $ln_e || $g_e || $u_e || $p_e || $pc_e || $ur_e) {
			$empty = "$fn_e$ln_e$g_e$u_e$p_e$pc_e$ur_e";
		}
		
		if($u_i || $p_i || $pc_i) {
			$invalid = "$u_i$p_i$pc_i";
		}
		
		$message = password_hash($empty . $invalid, PASSWORD_DEFAULT);
		
		if(!empty($empty) || !empty($invalid)) {
			if($fn_e || $ln_e || $g_e || $u_e || $p_e || $pc_e) {
				$_SESSION['emptyfields'] = "emptyfields";
			}
			
			if($u_i) {
				$_SESSION['error'] = "username_i";
			}
			
			if($p_i) {
				$_SESSION['error1'] = "password_i";
			}
			
			if($pc_i) {
				$_SESSION['error2'] = "passwordConfirm_i";
			}

			header("Location: ../t-signup.php?$message");
			exit();
		}
	}
	
	if(empty($fn_e) && empty($ln_e) && empty($u_e) && empty($p_e) && empty($pc_e) && empty($ur_e) && empty($u_i) && empty($p_i) && empty($pc_i)) {
		
		$sql = "INSERT INTO usertable (userRole, firstName, lastName, gender, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		$emailAddress = $username."@citipointe.qld.edu.au";
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "sssssss", $userRole,  $firstName, $lastName, $gender, $emailAddress, $username, $p_password);
			$p_password = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			
			$sql1 = "INSERT INTO teacherTable (userID) SELECT MAX(userID) AS userID FROM userTable";
			mysqli_query($connection, $sql1);	
		}

		mysqli_close($connection);
		
		header("Location: ../index.php?signup=success");
		exit();
	}
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}
