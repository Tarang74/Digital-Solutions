<?php	if(count(get_required_files()) == 1 || count(get_included_files()) == 1) {
		header("HTTP/1.1 404 File Not Found", 404);
		exit();
	}
?>

<header>
	<nav>
		<ul class="left">
			<li>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> </li>
		</ul>
		<div class="right">
			<form action="../php/logout.inc.php" method="post">
				<input type="submit" name="logout-submit" value="Logout">	
			</form>
		</div>
	</nav>
</header>
</html>
