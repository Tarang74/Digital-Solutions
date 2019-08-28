<?php   
	if(count(get_required_files()) == 1 || count(get_included_files()) == 1) {
		header("HTTP/1.1 404 File Not Found", 404);
		exit();
	}
?>
<head>
  <link type="text/css" rel="stylesheet" href="../css/header.css">
</head>
  

<header class="header" id="header">
    <div class="container">
      <div class="Header-container">
        <a class="Header-logo">
        <div class="Logo"></div></a>
        <nav class="Header-nav">
          <ul class="Header-navList">
            <li class="Header-navItem h6">
              <a class="page-header h2"><?php echo $_SESSION['userRole']?> Page</a>
            </li>
          </ul>
        </nav>
        <div class="Header-account h6">
          <a class="h6"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></p><a class="Header-accountLink no-barba">
          <form action="../php/logout.inc.php" method="post">
            <input name="logout-submit" type="submit" value="Logout">
          </form></a>
        </div>
      </div>
    </div>
		<script src="../js/header.js"></script>
  </header>
