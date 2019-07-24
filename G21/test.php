<!doctype HTML>
<form action="php/signup.inc.php" method="post" class="signup-form">
				<input type="text" name="firstName" class="alpha-only" placeholder="First name" value="<?php if(!empty($firstName)){echo($firstName);} ?>">
				<span class="help-block"><?php if(!empty($firstName_error)){echo($firstName_error);} ?></span>
				
				<input type="text" name="lastName" class="alpha-only" placeholder="Last name" value="<?php echo(!empty($lastName)) ?>">
				<span class="help-block"><?php echo(!empty($lastName_error)) ?></span>
				
				<select name="gender" value="<?php echo(!empty($gender)) ?>">
					<option hidden disabled value>Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<span class="help-block"><?php echo(!empty($gender_error)) ?></span>
				
				<input type="number" min="7" max="12" step="1" name="yearLevel" placeholder="Year Level" value="<?php echo(!empty($yearLevel)) ?>">
				<span class="help-block"><?php echo(!empty($yearLevel_error)) ?></span>
				
				<input type="email" name="email" placeholder="E-mail" value="<?php echo(!empty($email)) ?>">
				<span class="help-block"><?php echo(!empty($email_error)) ?></span>
				
				<input type="password" name="password" placeholder="Password">
				<span class="help-block"><?php echo(!empty($password_error)) ?></span>
				
				<input type="password" name="passwordConfirm" placeholder="Confirm">
				<span class="help-block"><?php echo(!empty($passwordConfirm_error)) ?></span>
				
				<button type="submit" name="signup-submit">Signup</button>
</form>