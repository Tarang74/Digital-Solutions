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
<title>Teacher Page</title>
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
				<th>Mentor Name</th>
				<th>Student Name</th>
				<th>Student Comment</th>
				<th>Mentor Availability</th>
				<th>Cancelled</th>
				<th>Completed</th>
				</tr>
			<?php
			require("../php/session.php");

			$sql = "
			SELECT
				sessionID,
				sessionRequestDate,
				subjectTable.subjectName,
				mu.firstName AS mu_firstName,
				mu.lastName AS mu_lastName,
				mu.yearLevel AS mu_yearLevel,
				su.firstName AS su_firstName,
				su.lastName AS su_lastName,
				su.yearLevel AS su_yearLevel,
				sessionComment,
				available,
				cancelled,
				completed
			FROM
				sessionTable
			LEFT JOIN subjectTable ON sessionTable.subjectID = subjectTable.subjectID
			LEFT JOIN studentTable AS st
			ON
				sessionTable.studentID = st.studentID
			LEFT JOIN userTable AS su
			ON
				st.userID = su.userID
			LEFT JOIN mentorTable AS mt
			ON
				sessionTable.mentorID = mt.mentorID
			LEFT JOIN userTable AS mu
			ON
				mt.userID = mu.userID
			ORDER BY
				sessionID ASC";

			$result = mysqli_query($connection, $sql);

			while($row = mysqli_fetch_array($result)) {			
			echo "
			<tr>
			<td>" . $row['sessionID'] . "</td>
			<td>" . $row['sessionRequestDate'] . "</td>
			<td>" . $row['subjectName'] . "</td>
			<td>" . $row['mu_firstName'] . " " . $row['mu_lastName'] . " - " . $row['mu_yearLevel'] . "</td>
			<td>" . $row['su_firstName'] . " " . $row['su_lastName'] . " - " . $row['su_yearLevel'] . "</td>
			<td>" . $row['sessionComment'] . "</td>
			<td>" . $row['available'] .
					"<form name='available-form' action='available.php' method='post'>
					<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
					<input type='submit' name='availability-submit' value='Available?'>
					</form>" .				
			"</td>
			<td>" . $row['completed'] . 
					"<form name='completed-session-form' action='completed.php' method='post'>
					<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
					<input type='submit' name='completed-session-submit' value='Complete'>
					</form>" .
			"</td>
			</tr>";
			}
			mysqli_close($connection);
			?>
			</table>
		</div>
	</main>
</body>
</html>