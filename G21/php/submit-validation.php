<?php
	if(count(get_required_files()) == 1 || count(get_included_files()) == 1) {
		header("HTTP/1.1 404 File Not Found", 404);
		exit();
	}
?>
<!doctype html>
<html>
	<script>
document.getElementById("signup-form").onsubmit = function () {
	var fn = document.forms["signup-form"]["firstname"].value;
	var ln = document.forms["signup-form"]["lastname"].value;
	var g = document.forms["signup-form"]["gender"].value;
	var yl = document.forms["signup-form"]["yearlevel"].value;
	var u = document.forms["signup-form"]["username"].value;
	var p = document.forms["signup-form"]["password"].value;
	var pc = document.forms["signup-form"]["passwordconfirm"].value;
	var ur = document.forms["signup-form"]["userrole"].value;
 	var h = document.forms["signup-form"]["house"].value;
	
	var submit = true;

	if (fn == null || fn == "") {
		var fnError = "Please enter your name";
		document.getElementById("fn_e").innerHTML = fnError;
		submit = false;
	}
	
	if (ln == null || ln == "") {
		var lnError = "Please enter your last name";
		document.getElementById("ln_e").innerHTML = lnError;
		submit = false;
	}
	
	if (g == null || g == "") {
		var gError = "Please select gender";
		document.getElementById("g_e").innerHTML = gError;
		submit = false;
	}
	
	if (yl == null || yl == "") {
		var ylError = "Please enter year level";
		document.getElementById("yl_e").innerHTML = ylError;
		submit = false;
	}
	
	if (u == null || u == "") {
		var uError = "Please enter your username";
		document.getElementById("u_e").innerHTML = uError;
		submit = false;
	}
	
	var u_double = 
			<?php
			if(isset($POST['signup-submit'])) {
				require("session.php");

				$sql = "SELECT user_username FROM usertable WHERE user_username = ?";
				$stmt = mysqli_stmt_init($connection);

				if(mysqli_stmt_prepare($stmt, $sql)) {
					mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);

					if($resultCheck == 0) {
						echo "false";
					} else {
						echo "true";
					}
				}
			}
			?>;
	
	if (u_double = true) {
		var uError = "Username already exists, try to <a href='../index.php'>login</a>";
		document.getElementById("u_e").innerHTML = uError;
		submit = false;
	}
	
	if (p == null || p == "") {
		var pError = "Please enter your password";
		document.getElementById("p_e").innerHTML = pError;
		submit = false;
	}
	
	if (pc == null || pc == "") {
		var pcError = "Please confirm your password";
		document.getElementById("pc_e").innerHTML = pcError;
		submit = false;
	}
	
	if (p != pc) {
		var pcError = "The passwords do not match";
		document.getElementById("pc_e").innerHTML = pcError;
		submit = false;
	}
	
	if (ur == null || ur == "") {
		var urError = "Please enter user role";
		document.getElementById("ur_e").innerHTML = urError;
		submit = false;
	}
	
	if (h == null || h == "") {
		var hError = "Please select your house";
		document.getElementById("h_e").innerHTML = hError;
		submit = false;
	}
	
	return submit;
}

function removeWarning() {
  document.getElementById(this.id + "_e").innerHTML = "";
}

document.getElementById("firstname").onkeyup = removeWarning;
document.getElementById("lastname").onkeyup = removeWarning;
document.getElementById("yearlevel").onkeyup = removeWarning;
document.getElementById("gender").onkeyup = removeWarning;
document.getElementById("house").onkeyup = removeWarning;
document.getElementById("username").onkeyup = removeWarning;
document.getElementById("password").onkeyup = removeWarning;
document.getElementById("passwordconfirm").onkeyup = removeWarning;
document.getElementById("userrole").onkeyup = removeWarning;
</script>
	</html>
