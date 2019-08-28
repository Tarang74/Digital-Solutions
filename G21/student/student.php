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
  <link href="../css/main-form.css" rel="stylesheet" type="text/css">
</head>
	
<body>
<?php require("../header.php");?>
<main>
	<div class="section">
		<h3>Current Sessions</h3>
		<table class="main-table">
			<thead>
				<tr>
					<th onClick="sortTable(0)">Session Date</th>
					<th onClick="sortTable(1)">Mentor</th>
					<th onClick="sortTable(2)">Subject</th>
					<th onClick="sortTable(3)">Status</th>
				</tr>
			</thead>
			<tbody>
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
						if ($row['available'] == "1") {
							$available_svg = "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 130.2 130.2'>
													<circle class='path circle' fill='none' stroke='#73AF55' stroke-width='6' stroke-miterlimit='10' cx='65.1' cy='65.1' r='62.1'/>
													<polyline class='path check' fill='none' stroke='#73AF55' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' points='100.2,40.2 51.5,88.8 29.8,67.5'/>
												</svg>";
						} else {
							$available_svg = "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 130.2 130.2'>
													<circle class='path circle' fill='none' stroke='#D06079' stroke-width='6' stroke-miterlimit='10' cx='65.1' cy='65.1' r='62.1'/>
													<line class='path line' fill='none' stroke='#D06079' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' x1='34.4' y1='37.9' x2='95.8' y2='92.3'/>
													<line class='path line' fill='none' stroke='#D06079' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' x1='95.8' y1='38' x2='34.4' y2='92.2'/>
												</svg>";
						}
						
						if ($row['completed'] == "1") {
							$complete_text = "Completed";
						} else {
							$complete_text = "Not Completed";
						}
						
						echo
							"<tr>" .
								"<td class='c1'>" . $row['sessionRequestDate'] . "</td>" .
								"<td class='c2'>" . 
									"<div class='availablecontainer'>" .
										"<div class='availabletext'>" . $row['firstName'] . " " . $row['lastName'] . " - " . $row['yearLevel'] . "</div>" . 
										"<div class='availablesvg'>" . $available_svg . "</div>" .
									"</div>" .
								"</td>" .
								"<td class='c3'>" . $row['subjectName'] . "</td>" .
								"<td class='c4'>" .
									"<div class='completecontainer'>" .
										"<div class='completetext'>" . $complete_text . "</div>" .
										"<div class='cancelbutton'>
											<form name='cancel-booking-form' action='cancel-booking.php' method='post'>
												<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
												<input type='submit' name='cancel-booking-submit' value='Cancel'>
											</form>
										</div>
									</div>" .
								"</td>" .
								"<td class='c5'>
									
								</td>" .
							"</tr>";
					}
				}
				mysqli_close($connection);
			?>
			</tbody>
		</table>
	</div>
	<div class="section">
		<h3>Book Session</h3>
		<form action="booking.php" method="post" name="booking-form">
			<table class="main-form">
			<tbody>
					<input name="userID" style="display: none;" value="<?php echo $_SESSION['userID'];?>">
				<tr>
					<td>
					<label for="subject">Select Subject</label>
					</td>
					<td>
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
					</td>
				</tr>
				<tr>
					<td>
					<label for="mentor">Select Mentor</label>
					</td>
				<td>
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
					</td>
				</tr>
				<tr>
					<td>
					<label for="sessionDate">Choose Date</label>
					</td>
					<td>
					<input type="date" name="sessionDate" id="todaydate" min="" required>
					</td>
				</tr>
				<tr>
					<td>
					<label for="sessionComment">Add a comment</label>
					</td>
					<td>
					<input type="textarea" name="sessionComment">
					</td>
				</tr>
			</tbody>
			</table>
			<input type="submit" name="student-session-submit" value="Book Session">
		</form>
	</div>
	
	<div class="section">
		<h3>Feedback</h3>
		<form action="feedback.php" method="post" name="feedback-form">
			<table class="main-form">
				<tbody>
					<tr>
						<td>
						<label for="sessionID">Select Session</label>
						</td>
						<td>
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
						</td>
					</tr>
					<tr>
						<td>	
							<label for="feedbackComment">Add a comment</label>
						</td>
						<td>
							<input type="textarea" name="feedbackComment">
						</td>
					</tr>
						
				</tbody>
			</table>
			<input type="submit" name="student-feedback-submit" value="Submit Feedback">
		</form>
	</div>
	
	<script src="../js/todaydate.js"></script>
</main>
	
</body>
</html>