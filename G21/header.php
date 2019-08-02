<<<<<<< HEAD
<?php session_start(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	</head>
<body>
	<header class="header">
		<nav class="headernav">
			<section class="headerleft">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</section>
			<section class="headerright">
				
				<?php
				if(isset($_SESSION['login'])) {
					echo '<form action="php/logout.inc.php" method="post" class="logout-form">
					<button type="submit" name="logout-submit" placeholder="logout">Logout</button>
				</form>';
				} else {
					echo '<a id="toggle" style="cursor:pointer;">Login</a>';
				}
				?>
				
			</section>
		</nav>
	</header>

	<script>
		$(function() {
			$(document).ready(function() {
				$("#login").toggle();	
			});
			
			$("#toggle").click(function() {
				$("#login").toggle();
			});
		});
	</script>

</body>
=======
<?php session_start(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	</head>
<body>
	<header class="header">
		<nav class="headernav">
			<section class="headerleft">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</section>
			<section class="headerright">
				
				<?php
				if(isset($_SESSION['userID'])) {
					echo '<form action="php/logout.inc.php" method="post" class="logout-form">
					<button type="submit" name="logout-submit" placeholder="logout">Logout</button>
				</form>';
				} else {
					echo '<a id="toggle" style="cursor:pointer;">Login</a>';
				}
				?>
				
			</section>
		</nav>
	</header>

	<script>
		$(function() {
			$(document).ready(function() {
				$("#login").toggle();	
			});
			
			$("#toggle").click(function() {
				$("#login").toggle();
			});
		});
	</script>

</body>
>>>>>>> origin/master
</html>