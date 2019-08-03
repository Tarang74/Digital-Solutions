<!DOCTYPE html>
<html>
<head>
  <title>Index/login</title>
  <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body class="login-page">
  <div class="login-container">
    <div class="login-panel">
      <h1>CITIPOINTE G21</h1>
      <form action="php/login.inc.php" class="login-form" method="post" name="login" id="login">
        <div id="loginFormFields">
          <ul id="loginFormList">
            <li class="clearfix">
							<label for="mailuid">Username</label>
							<input maxlength="50" name="mailuid" placeholder="username" type="text">
						</li>
            <li class="clearfix">
							<label for="password">Password</label>
							<input autocomplete="off" name="password" placeholder="password" type="password">
						</li>
            <li class="clearfix">
							<input class="button expand" id="entry-login" name="login-submit" type="submit" value="Sign In">
						</li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</body>
</html>