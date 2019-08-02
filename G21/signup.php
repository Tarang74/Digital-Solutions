<?php require("header.php"); ?>

<main style="top:100px">
	<div class="login">
		<section>
			<h1>Sign Up</h1>
			<form action="php/signup.inc.php" method="post" class="signup-form">
				<input type="text" name="firstName" class="alpha-only" placeholder="First name" value="<?php if(isset($_GET['fields'])) ?>">
				<span class="help-block">
					<?php 
					if(isset($_GET['error'])) {
						if($_GET['empty'] = "&fn") {
							echo "Enter first name";
						}
					}
					?>
				</span>
				
				<input type="text" name="lastName" class="alpha-only" placeholder="Last name">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&ln") {
							echo "Enter last name";
						}
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
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&g") {
							echo "Please select your gender";
						}
					}
					?>
				</span>
				
				<input type="number" min="7" max="12" step="1" name="yearLevel" placeholder="Year Level">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&yl") {
							echo "Please select year level";
						}
					}
					?>
				</span>
				
				<input type="text" name="username" placeholder="Username">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&u*") {
							echo "That username is taken. Try another.";
						}
						if($_GET['errors'] == "&u") {
							echo "Enter username";
						}
					}
					?>
				</span>
				
				<input type="password" name="password" placeholder="Password">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&p*") {
							echo "Use 6 or more characters for your password";
						}
						if($_GET['errors'] == "&p") {
							echo "Enter a password";
						}
					}
					?>
				</span>
				
				<input type="password" name="passwordConfirm" placeholder="Confirm">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&pc*") {
							echo "Confirm your password";
						}
						if($_GET['errors'] == "&pc") {
							echo "The passwords do not match. Try again.";
						}
					}
					?>
				</span>
				
				<input type="text" name="userRole" class="alpha-only" placeholder="User Role">
				<span class="help-block">
					<?php 
					if(isset($_GET['errors'])) {
						if($_GET['errors'] == "&ur") {
							echo "Enter user role";
						}
					}
					?>
				</span>
				
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