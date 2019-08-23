<?php session_start() ?>
<?php if(!isset($_SESSION['userID'])) {
	header("Location: ../index.php?error=timeout");
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mentor Page</title>
<link rel="stylesheet" href="../css/main.css" type="text/css">

</head>
<body>
	
	<?php require("header.php")?>
	
	<main>
		<div class="section">
			<h1>Sessions</h1>
			<table>
				<tr>
				<th>Date</th>
				<th>Subject</th>
				<th>Name</th>
				<th>Comment</th>
				<th>Availability</th>
				<th>Completed</th>
				<th></th>
				</tr>
			<?php
			require("../php/session.php");

			$sql = "SELECT sessionRequestDate, subjectName, firstName, lastName, yearLevel, sessionComment, available, completed, sessionTable.sessionID, feedbackComment
			FROM sessionTable
			RIGHT JOIN mentorTable ON sessionTable.mentorID = mentorTable.mentorID
			LEFT JOIN subjectTable ON sessionTable.subjectID = subjectTable.subjectID
			LEFT JOIN studentTable ON sessionTable.studentID = studentTable.studentID
			LEFT JOIN userTable ON studentTable.userID = userTable.userID
			LEFT JOIN feedbackTable ON sessionTable.sessionID = feedbackTable.sessionID
			WHERE mentorTable.userID = " . $_SESSION['userID'] . "AND cancelled = 0";
			
			$result = mysqli_query($connection, $sql);

			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
				echo "
				<tr>
				<td>" . $row['sessionRequestDate'] . "</td>
				<td>" . $row['subjectName'] . "</td>
				<td>" . $row['firstName'] . " " . $row['lastName'] . " - " . $row['yearLevel'] . "</td>
				<td>" . $row['sessionComment'] . "</td>
				<td>" . $row['available'] .
						"<form name='available-form' action='available.php' method='post'>
						<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
						<input type='submit' name='available-submit' value='Available'>
						</form>" .
				"</td>
				<td>" . $row['completed'] . 
						"<form name='completed-session-form' action='completed.php' method='post'>
						<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
						<input type='submit' name='completed-session-submit' value='Complete'>
						</form>" .
				"</td>
				<td>" . $row['feedbackComment'] . "</td>
				</tr>";
				} 
			} else {
				echo "None";
			}
			mysqli_close($connection);
			?>
			</table>
		</div>
	</main>
</body>
</html>