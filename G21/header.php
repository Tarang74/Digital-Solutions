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
				<a id="toggle" style="cursor:pointer;">Login</a>
				<form action="include/logout.inc.php" method="post" class="logout-form">
					<button type="submit" name="logout-submit" placeholder="logout">Logout</button>
				</form>
			</section>
		</nav>
	</header>
	<main>
		<div>
			<div id="login" class="login">
				<form action="include/login.inc.php" method="post" class="login-form">
					<input type="text" name="mailuid" placeholder="Username/Email">
					<input type="password" name="password" placeholder="Password">
					<button type="submit" name="login-submit">Login</button>
				</form>
				<a style="font-size:10px; color:lightblue;" href="signup.php">Signup</a>
			</div>
		</div>
	</main>
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
</html>