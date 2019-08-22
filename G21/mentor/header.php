<?php
	if(count(get_required_files()) == 1 || count(get_included_files()) == 1) {
		header("HTTP/1.1 404 File Not Found", 404);
		exit();
	}
?><head>
<link rel="stylesheet" href="../css/header.css" type="text/css">
</head>
	
<header>
	<nav>
		<div class="leftnav">
			<ul>
			<li><a href="#">asdf1</a></li>
			<li><a href="#">asdf2</a></li>
			<li><a href="#">asdf3</a></li>
			</ul>
		</div>
		
		<div class="rightnav">
			<ul>
			<li>
				<form action="../php/logout.inc.php" method="post">
					<input type="submit" name="logout-submit" value="Logout">
				</form>
			</li>
			<li><a>Notifications</a></li>
			<li><a>Notifications2</a></li>
			</ul>
		</div>
		
	</nav>
	
	</header>