<?php session_start(); ?>
<?php if(!isset($_SESSION['userID'])) {
	header("Location: ../index.php?error=timeout");
	exit();
}
?>
<!doctype html>
<html>
<head>
	<title>Student Page</title>	
  <link href="../css/main.css" rel="stylesheet" type="text/css">
</head>
	
<body>
<?php require("header.php");?>
	
<main>
	<div class="section">
		<h1>Booked Sessions</h1>
		<table>
			<tr>
				<th onClick="sortTable(0)">Session Date</th>
				<th onClick="sortTable(1)">Mentor</th>
				<th onClick="sortTable(2)">Subject</th>
				<th onClick="sortTable(3)">Confirmed</th>
				<th onClick="sortTable(4)">Completed</th>
				<th onClick="sortTable(5)"></th>
			</tr>
			
			<?php
				require("../php/session.php");
				
				$student = $_SESSION['userID'];			
			
				$string = "SELECT * FROM sessionTable
									LEFT JOIN mentorTable ON sessionTable.mentorID = mentorTable.mentorID
									LEFT JOIN subjectTable ON sessionTable.subjectID = subjectTable.subjectID
									LEFT JOIN userTable ON mentorTable.userID = userTable.userID
									WHERE sessionTable.studentID = '" . $student . "'";
				$sql = $string;
			
				$result = mysqli_query($connection, $sql);
				
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo
							"<tr>" .
							"<td>" . $row['sessionRequestDate'] . "</td>" .
							"<td>" . $row['firstName'] . " " . $row['lastName'] . " - " . $row['yearLevel'] . "</td>" .
							"<td>" . $row['subjectName'] . "</td>" .
							"<td>" . $row['available'] . "</td>" .
							"<td>" . $row['completed'] . "</td>" .
							"<td>
							<form name='cancel-booking-form' action='cancel-booking.php' method='post'>
							<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
							<input type='submit' name='cancel-booking-submit' value='Cancel'>
							</form>
							</td>" .
							"</tr>";
					}
				}
				mysqli_close($connection);
			?>
			   
		</table>
	</div>
	<div class="section">
		<form action="booking.php" method="post" name="booking-form">
			<input name="userID" style="display: none;" value="<?php echo $_SESSION['userID'];?>">

			<label for="subject">Select Subject</label>
			<select name="subject">
				<option hidden disabled selected value>Select Subject</option>
				<?php
				require("../php/session.php");

				$sql = "SELECT * FROM subjectTable ORDER BY subjectName ASC";
				$result = mysqli_query($connection, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value='" . $row['subjectID'] . "'>" . $row['subjectName'] . "</option>";
					}
				}

				mysqli_close($connection);
				?>
			</select>

			<label for="mentor">Select Mentor</label>
			<select name="mentor">
				<option hidden disabled selected value>Select Mentor</option>
				<?php
				require("../php/session.php");

				$sql = "SELECT mentorID, firstname, lastname, yearlevel, houseName
								FROM mentorTable
								LEFT JOIN userTable ON mentorTable.userID = userTable.userID
								LEFT JOIN houseTable ON userTable.houseID = houseTable.houseID
								ORDER BY lastname ASC";
				$result = mysqli_query($connection, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value='" . $row['mentorID'] . "'>" . "(" . substr($row['houseName'], 0, 1) . ") " . $row['firstname'] . " " . $row['lastname'] . " - " . $row['yearlevel'] . "</option>";
					}
				} else {
					echo "<option>No mentors available</option>";
				}

				mysqli_close($connection);
				?>
			</select>

			<label for="sessionDate">Choose Date</label>
			<input type="date" name="sessionDate" id="todaydate" min="" required>

			<label for="sessionComment">Add a comment</label>
			<input type="textarea" name="sessionComment">

			<input type="submit" name="student-session-submit" value="Book Session">
		</form>
	</div>
	
	<div class="section">
		<form action="feedback.php" method="post" name="feedback-form">

			<label for="sessionID">Select Session</label>
			<select name="sessionID">
				<option hidden disabled selected value>Select Session</option>
				<?php
				require("../php/session.php");
				
				$string = "
				SELECT *
				FROM sessionTable
				LEFT JOIN studentTable ON sessionTable.studentID = studentTable.studentID
				WHERE completed = 1 AND studentTable.userID = " . $_SESSION['userID'];
				$sql = $string;
				$result = mysqli_query($connection, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value='" . $row['sessionID'] . "'>" .
							$row['sessionRequestDate'] . "</option>";
					}
				}
				mysqli_close($connection);
				?>
			</select>

			<label for="feedbackComment">Add a comment</label>
			<input type="textarea" name="feedbackComment">

			<input type="submit" name="student-feedback-submit" value="Submit Feedback">
		</form>
	</div>
	
	<script src="../js/todaydate.js"></script>
</main>
</body>
</html>