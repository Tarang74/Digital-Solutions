<!doctype html>
<html>
<head>
<link href="css/login.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body style="width:100vw;">
	<form action="php/login.inc.php" class="login-form" method="post" name="login">
	<div id="loginFormFields">
          <ul id="loginFormList">
            <li class="clearfix">
							<label for="mailuid">Username</label>
							<input id="mailuid" maxlength="50" name="mailuid" placeholder="username" type="text">
						</li>
            <li class="clearfix">
							<label for="password">Password</label>
							<input autocomplete="off" id="password" name="password" placeholder="password" type="password">
						</li>
            <li class="clearfix">
							<input class="button expand" id="entry-login" name="login-submit" type="submit" value="Sign In">
						</li>
          </ul>
        </div>
		</form>
</body>
</html>