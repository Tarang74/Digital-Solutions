<!doctype html>
<html>

<head>
<link href="css/signup.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
	
	<body class="login-page">
		<main>
			<div class="login">
				<section>
					<h1>Sign Up</h1>
					<form action="php/signup.inc.php" method="post" class="login-form">
						<input type="text" name="firstName" class="alpha-only" placeholder="First name">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'fn') {
									echo "Enter first name";
								}
							?>
						</span>

						<input type="text" name="lastName" class="alpha-only" placeholder="Last name">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'ln') {
									echo "Enter last name";
								}
							?>
						</span>

						<select name="gender">
							<option hidden disabled selected value>Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'g') {
									echo "Please select your gender";
								}
							?>
						</span>

						<input type="number" min="7" max="12" step="1" name="yearLevel" placeholder="Year Level">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'yl') {
									echo "Please select year level";
								}
							?>
						</span>

						<input type="text" name="username" placeholder="Username">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'u') {
									echo "Enter username";
								} elseif(isset($_GET['invalid']) && $_GET['invalid'] = 'u') {
									echo "That username is taken. Try logging in, or use another username.";
								}
							?>
						</span>

						<input type="password" name="password" placeholder="Password">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'p') {
									echo "Enter a password";
								} elseif(isset($_GET['invalid']) && $_GET['invalid'] = 'p') {
									echo "Use 6 or more characters for your password";
								}
							?>
						</span>

						<input type="password" name="passwordConfirm" placeholder="Confirm">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'pc') {
									echo "Confirm your password";
								} elseif(isset($_GET['invalid']) && $_GET['invalid'] = 'pc') {
									echo "The passwords do not match. Try again.";
								}
							?>
						</span>

						<input type="text" name="userRole" class="alpha-only" placeholder="User Role">
						<span class="help-block">
							<?php 
								if(isset($_GET['empty']) && $_GET['empty'] = 'ur') {
									echo "Enter user role";
								}
							?>
						</span>

						<button type="submit" name="signup-submit">Signup</button>
					</form>
				</section>
			</div>
		</main>
		<script src="js/alpha-only.js"></script>
	</body>
</html>