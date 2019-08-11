<!doctype html>
<html>

<body>
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
			<?php
				if(isset($_SESSION['userID'])) {
					echo '<form action="php/logout.inc.php" method="post" class="logout-form">
					<button type="submit" name="logout-submit" placeholder="logout">Logout</button>
				</form>';
				}
			?>
			</li>
			<li><a>Notifications</a></li>
			<li><a>Notifications2</a></li>
			</ul>
		</div>
		
	</nav>
	
	</header>
</body>
</html>