<?php require("header.php"); ?>

<main style="top:100px">
	<div class="login">
		<section>
			<h1>Sign Up</h1>
			<form action="php/signup.inc.php" method="post" class="signup-form">
				<input type="text" name="firstName" placeholder="First name">
				<span class="help-block"><?php echo(!empty($firstName_error)) ?></span>
				<input type="text" name="lastName" placeholder="Last name">
				<span class="help-block"><?php echo(!empty($lastName_error)) ?></span>
				<select name="gender">
					<option hidden disabled selected value>Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<span class="help-block"><?php echo(!empty($gender_error)) ?></span>
				<input type="number" min="7" max="12" step="1" name="yearLevel" placeholder="Year Level">
				<span class="help-block"><?php echo(!empty($yearLevel_error)) ?></span>
				<input type="email" name="email" placeholder="E-mail">
				<span class="help-block"><?php echo(!empty($email_error)) ?></span>
				<input type="password" name="password" placeholder="Password">
				<span class="help-block"><?php echo(!empty($password_error)) ?></span>
				<input type="password" name="passwordConfirm" placeholder="Confirm">
				<span class="help-block"><?php echo(!empty($passwordConfirm_error)) ?></span>
				<button type="submit" name="signup-submit">Signup</button>
			</form>
		</section>
	</div>
</main>

<?php require("footer.php"); ?>