<!doctype html>
<html>

<head>
<link href="css/signup.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
	
	<body class="login-page">
		<div class="login-container">
			<div class="login-panel">
				<h1>Sign Up</h1>
				<form action="php/signup.inc.php" name="signup-form" method="post" class="signup-form" id="signup-form">
					<div id="loginFormFields">
						<ul>
							<li class="clearfix">
								<label for="userRole">User Role</label>
								<select name="userRole" id="userRole" required>
									<option hidden disabled selected value>Role</option>
									<option value="Student">Student</option>
									<option value="Mentor">Mentor</option>
									<option value="Teacher">Teacher</option>
								</select>
															
								<span class="help-block">
									<p id="ur_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="firstName">First name</label>
								<input type="text" name="firstName" class="alpha-only" placeholder="First name" id="firstname" required>
								<span class="help-block">
									<p id="fn_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="lastName">Last name</label>
								<input type="text" name="lastName" class="alpha-only" placeholder="Last name" id="lastname" required>
								<span class="help-block">
									<p id="ln_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="gender">Gender</label>
								<select name="gender" id="gender" required>
									<option hidden disabled selected value>Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								<span class="help-block">
									<p id="g_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="yearLevel">Year Level</label>
								<input type="number" min="7" max="12" step="1" name="yearLevel" placeholder="Year Level" id="yearlevel">
								<span class="help-block">
									<p id="yl_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="house">House</label>
								<select name="house" id="house">
									<option hidden disabled selected value>House</option>
										<option hidden disabled selected value>Select House</option>
										<?php
										require("php/session.php");

										$sql = "SELECT * FROM houseTable";
										$result = mysqli_query($connection, $sql);

										if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_assoc($result)) {
												echo "<option value='" . $row['houseID'] . "'>" . $row['houseName'] . "</option>";
											}
										}

										mysqli_close($connection);
										?>
									
								</select>
								<span class="help-block">
									<p id="g_e"></p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="username">Username</label>
								<input type="text" name="username" placeholder="Username" id="username" required>
								<span class="help-block">
									<p id="u_e"> </p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="password">Password</label>
								<input type="password" name="password" placeholder="Password" id="password" required>
								<span class="help-block">
									<p id="p_e"> </p>
								</span>
							</li>
							
							<li class="clearfix">
								<label for="passwordConfirm">Confirm</label>
								<input type="password" name="passwordConfirm" placeholder="Confirm" id="passwordconfirm" required>
								<span class="help-block">
									<p id="pc_e"> </p>
								</span>
							</li>
							
							<li class="clearfix">
								<input type="submit" name="signup-submit" id="signup-submit-button" value="Sign Up">
							</li>
							
						</ul>
					</div>
				</form>
			</div>
		</div>
	</body>

<script src="js/alpha-only.js"></script>

</html>