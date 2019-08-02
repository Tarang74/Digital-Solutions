<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
  <title>Index/login</title>
  <link href="img/citipointe logo.png" rel="SHORTCUT ICON" type="image/x-icon">
  <link href="css/login/shared.css" id="css_0" rel="stylesheet" type="text/css">
  <link href="css/login/theme.css" id="css_1" rel="stylesheet" type="text/css">
  <link href="css/login/colorpalette.generated.modern.css" id="css_2" rel="stylesheet" type="text/css">
  <link href="css/login/print.css" media="print" rel="stylesheet" type="text/css">
</head>
<body class="usc usc-login-page" id="testid" style="">
  <div class="usc usc-login-container">
    <div class="usc usc-login-panel">
      <h1>CITIPOINTE G21</h1>
      <form action="php/login.inc.php" class="login-form" method="post" name="login" id="login">
        <div id="loginFormTitle">
          <h2>Have an account?</h2>
        </div>
        <div id="loginFormText">
          <p>Please enter your credentials and click the <b>Login</b> button below.</p>
        </div>
        <div class="clearfix" id="loginFormFields">
          <ul class="clearfix" id="loginFormList">
            <li class="clearfix">
				<label for="mailuid">Username</label>
				<input id="mailuid" maxlength="50" name="mailuid" placeholder="username" size="25" type="text">
			</li>
            <li class="clearfix">
				<label for="password">Password</label> 
				<input autocomplete="off" id="password" name="password" placeholder="password" size="25" type="password">
			</li>
            <li class="clearfix">
				<button class="button expand" id="entry-login" name="login-submit" type="submit">Sign In</button>
			</li>
          </ul>
        </div><submit name="action" type="hidden" value="login"> <input name="new_loc" type="hidden" value="">
      </form><span class="usc usc-login-error-msg"></span>
      <div class="receipt bad editmode alert-box alert" data-alert="" id="loginErrorMessage" role="alert">
        <span class="usc usc-login-error-msg">You've been logged out due to inactivity. Log in again to continue.</span>
      </div>
    </div>
  </div>
</body>
=======
<!DOCTYPE html>
<html>
<head>
  <title>Index/login</title>
  <link href="img/citipointe logo.png" rel="SHORTCUT ICON" type="image/x-icon">
  <link href="css/login/shared.css" id="css_0" rel="stylesheet" type="text/css">
  <link href="css/login/theme.css" id="css_1" rel="stylesheet" type="text/css">
  <link href="css/login/colorpalette.generated.modern.css" id="css_2" rel="stylesheet" type="text/css">
  <link href="css/login/print.css" media="print" rel="stylesheet" type="text/css">
</head>
<body class="usc usc-login-page" id="testid" style="">
  <div class="usc usc-login-container">
    <div class="usc usc-login-panel">
      <h1>CITIPOINTE G21</h1>
      <form action="php/login.inc.php" class="login-form" method="post" name="login" id="login">
        <div id="loginFormTitle">
          <h2>Have an account?</h2>
        </div>
        <div id="loginFormText">
          <p>Please enter your credentials and click the <b>Login</b> button below.</p>
        </div>
        <div class="clearfix" id="loginFormFields">
          <ul class="clearfix" id="loginFormList">
            <li class="clearfix">
				<label for="mailuid">Username</label>
				<input id="mailuid" maxlength="50" name="mailuid" placeholder="username" size="25" type="text">
			</li>
            <li class="clearfix">
				<label for="password">Password</label> 
				<input autocomplete="off" id="password" name="password" placeholder="password" size="25" type="password">
			</li>
            <li class="clearfix">
				<button class="button expand" id="entry-login" name="login-submit" type="submit">Sign In</button>
			</li>
          </ul>
        </div><submit name="action" type="hidden" value="login"> <input name="new_loc" type="hidden" value="">
      </form><span class="usc usc-login-error-msg"></span>
      <div class="receipt bad editmode alert-box alert" data-alert="" id="loginErrorMessage" role="alert">
        <span class="usc usc-login-error-msg">You've been logged out due to inactivity. Log in again to continue.</span>
      </div>
    </div>
  </div>
</body>
>>>>>>> origin/master
</html>