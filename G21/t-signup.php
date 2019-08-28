<?php session_start(); ?>
<!doctype html>
<html>

<head>
<link href="css/signup.css" rel="stylesheet" type="text/css">
<link href="css/formerrors.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
	
	<body class="login-page">
		<div class="login-container">
			<div class="login-panel">
				<h1>Sign Up</h1>
				<form action="php/signup.inc.php" name="signup-form" method="post" class="signup-form" id="signup-form">
					<div id="loginFormFields">
						<ul>
							<input style="display:none;" name="userRole" value="teacher">
							
							<li class="clearfix">
								<label for="firstName">First name</label>
								<input tabindex="1" type="text" name="firstName" class="alpha-only" placeholder="First name" id="firstname">
							</li>
							
							<li class="clearfix">
								<label for="lastName">Last name</label>
								<input tabindex="2" type="text" name="lastName" class="alpha-only" placeholder="Last name" id="lastname">
							</li>
							
							<li class="clearfix">
								<label for="gender">Gender</label>
								<select tabindex="3" style="float: none !important;" name="gender" id="gender">
									<option hidden disabled selected value>Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</li>
														
							<li class="clearfix">
								<label for="username">Username</label>
								<input tabindex="4" type="text" name="username" placeholder="Username" id="username">
								<?php
									if(isset($_SESSION['error'])) {
										echo "<span class='error'>Username already exists.</span>";
									}
								?>
							</li>
							
							<li class="clearfix">
								<label for="password">Password</label>
								<input tabindex="5" type="password" name="password" placeholder="Password" id="password">
								<?php
									if(isset($_SESSION['error1'])) {
										echo "<span class='error'>Password must be 6 or more characters.</span>";
									}
								?>
							</li>
								
							<li class="clearfix">
								<label for="passwordConfirm">Confirm</label>
								<input tabindex="6" type="password" name="passwordConfirm" placeholder="Confirm" id="passwordconfirm">
								<?php
									if(isset($_SESSION['error2'])) {
										echo "<span class='error'>Passwords do not match.</span>";
									}
								?>
							</li>
								
							<li class="clearfix">
								<input type="submit" name="t-signup-submit" id="signup-submit-button" value="Sign Up">
								<?php
									if(isset($_SESSION['emptyfields'])) {
										echo "<span class='error'>Please fill out all fields.</span>";
									}
								?>
							</li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</body>

<script src="js/alpha-only.js"></script>

</html>

<?php

	if(isset($_SESSION['emptyfields']) && $_SESSION['emptyfields'] == "emptyfields") {
		unset($_SESSION['emptyfields']);
	}

	if(isset($_SESSION['error']) && $_SESSION['error'] == "username_i") {
		unset($_SESSION['error']);	
	}

	if(isset($_SESSION['error1']) && $_SESSION['error1'] == "password_i") {
		unset($_SESSION['error1']);
	}

	if(isset($_SESSION['error2']) && $_SESSION['error2'] == "passwordConfirm_i") {
		unset($_SESSION['error2']);
	}

?>