<?php include('session.php'); ?>

<?php
    if(isset($_SESSION['login_user'])) {
        header("location: profile.php");
    }

    $error = '';
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Enter a username or password";
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $connection = mysqli_connect($host, $adminUsername, $adminPassword, $database);
            
            $query = "SELECT username, password FROM menteelogin where username=? AND password=? LIMIT 1";
            
            $encrypt = $connection->prepare($query);
            $encrypt->bind_param("ss", $username, $password);
            $encrypt->execute();
            $encrypt->bind_result($username, $password);
            $encrypt->store_result();
            
            if ($encrypt->fetch()) {
                $_SESSION['login_user'] = $username;
                header("location: profile.php");
            } else {
                $error = "The Username or Password is invalid";
            }
            mysqli_close($connection);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- make sure you change the title to match your page -->
<title>G21</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
<?php
	$_SESSION["userID"] = "1";
	$_SESSION["role"] = "mentee";
?>

<?php include("nav.php"); ?>
	<form action="login.php">
	<div class="imgcontainer">
    <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
  	</div>
        
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" value="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
		
</body>
</html>