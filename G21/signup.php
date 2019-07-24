<?php require("header.php"); ?>

<main style="top:100px">
	<div class="login">
		<section>
			<h1>Sign Up</h1>
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
				
				<input type="text" name="email" placeholder="E-mail" value="<?php echo(!empty($email)) ?>">
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
<script>
	$(".alpha-only").on("keydown", function(event){
  // Ignore controls such as backspace
  var arr = [8,16,17,20,35,36,37,38,39,40,45,46];

  // Allow letters
  for(var i = 65; i <= 90; i++){
    arr.push(i);
  }

  if(jQuery.inArray(event.which, arr) === -1){
    event.preventDefault();
  }
});

$(".alpha-only").on("input", function(){
    var regexp = /[^a-zA-Z]/g;
    if($(this).val().match(regexp)){
      $(this).val( $(this).val().replace(regexp,'') );
    }
});
</script>
<?php require("footer.php"); ?>