<?php
session_start();
echo 'hello student';

echo '<a> All userID ='.$_SESSION['userID'].'name is '.$_SESSION['firstname'].' last name is '.$_SESSION['lastname'].'</a>';

?>
<!doctype html>
<html>
<body>
<?php require("header2.php");?>
<main>

<form action="createSession.php" method="post" class="session-form">
	
	<select name="subject">
		<option hidden disabled selected value>Select Subject</option>
		<option value="Mathematics">Mathematics</option>
		<option value="English">English</option>
		<option value="Science">Science</option>
	</select>

			<?php
		require("../php/session.php");
		
		$sql = "SELECT userID, name, houseTable.houseName FROM userTable INNER JOIN houseTable ON userTable.houseID = houseTable.houseID";
		$result = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo "<option value='" . $row['userID'] . "'>" . $row['name'] . " - " . $row['houseName'] . "</option>";
			}
		} else {
			echo "<option>No mentors available</option>";
		}
		
		mysqli_close($connection);
		?>
	
	<select name="mentor">
		<option hidden disabled selected value>Select Mentor</option>

	</select>
	
	<select name="teacher">
		<option hidden disabled selected value>Mentor</option>
		<option value="Asher">Asher</option>
		<option value="Ephraim">Ephraim</option>
		<option value="Judah">Judah</option>
		<option value="Levi">Levi</option>
	</select>
	<label for="password">Password</label>
	<input autocomplete="off" name="password" placeholder="password" type="password">

	<button type="submit" name="signup-submit">Signup</button>
</form>
	
</main>
</body>
	
</html>