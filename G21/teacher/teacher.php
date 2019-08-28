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
<link rel="stylesheet" href="../css/main-form.css" type="text/css">

</head>
<body>
	
	<?php require("../header.php")?>
	
	<main>
		<div class="section">
			<h3>Sessions</h3>
			<table class="main-table">
				<tr>
				<th>Date</th>
				<th>Subject</th>
				<th>Mentor</th>
				<th>Student</th>
				<th>Comment</th>
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

			while($row = mysqli_fetch_assoc($result)) {
				
			if($row['available'] == 1) {
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
				
			echo "
			<tr>
			<td>" . $row['sessionRequestDate'] . "</td>
			<td>" . $row['subjectName'] . "</td>
			<td> 
				<div class='availablecontainer'>" .
					"<div class='availabletext'>" . $row['mu_firstName'] . " " . $row['mu_lastName'] . " - " . $row['mu_yearLevel'] . "</div>" . 
					"<div class='availablesvg'>" . $available_svg . "</div>" .
				"</div>" .
			"</td>
			<td>" . $row['su_firstName'] . " " . $row['su_lastName'] . " - " . $row['su_yearLevel'] . "</td>
			<td>" . $row['sessionComment'] . "</td>
			<td>" . $complete_text . "</td>
			</tr>";
			}
			mysqli_close($connection);
			?>
			</table>
		</div>
		
		<div class="section">
			<h3>Mentors</h3>
			<table class="main-table">
				<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Subject</th>
				<th>Year Level</th>
				<th>Gender</th>
				<th>House</th>
				</tr>
			<?php
			require("../php/session.php");

			$sql = "
			SELECT
				*
			FROM
				userTable
			LEFT JOIN houseTable
			ON userTable.houseID = houseTable.houseID
			LEFT JOIN mentorTable
			ON userTable.userID = mentorTable.userID
			LEFT JOIN mentorSubjectTable
			ON mentorTable.mentorID = mentorSubjectTable.mentorID
			LEFT JOIN subjectTable
			ON mentorSubjectTable.subjectID = subjectTable.subjectID
			WHERE userRole = 'mentor'";

			$result = mysqli_query($connection, $sql);

			while($row = mysqli_fetch_assoc($result)) {
			echo "
			<tr>
			<td>" . $row['firstName'] . "</td>
			<td>" . $row['lastName'] . "</td>
			<td>" . $row['emailAddress'] . "</td>
			<td>" . $row['subjectName'] . "</td>
			<td>" . $row['yearLevel'] . "</td>
			<td>" . $row['gender'] . "</td>
			<td>" . $row['houseName'] . "</td>
			</tr>";
			}
			mysqli_close($connection);
			?>
			</table>
		</div>
		<div class="section">
			<h3>Students</h3>
			<table class="main-table">
				<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Year Level</th>
				<th>Gender</th>
				<th>House</th>
				</tr>
			<?php
			require("../php/session.php");

			$sql = "
			SELECT
				*
			FROM
				userTable
			LEFT JOIN houseTable
			ON userTable.houseID = houseTable.houseID
			WHERE userRole = 'student'";

			$result = mysqli_query($connection, $sql);

			while($row = mysqli_fetch_assoc($result)) {
			echo "
			<tr>
			<td>" . $row['firstName'] . "</td>
			<td>" . $row['lastName'] . "</td>
			<td>" . $row['emailAddress'] . "</td>
			<td>" . $row['yearLevel'] . "</td>
			<td>" . $row['gender'] . "</td>
			<td>" . $row['houseName'] . "</td>
			</tr>";
			}
			mysqli_close($connection);
			?>
			</table>
		</div>
		<div class="section">
			<h3>Change student role</h3>
			<form action="convert.php" method="post" name="covert-form">
			<table class="main-form">
				<tbody>
					<tr>
						<td>
							<label for="student">Select Student</label>
						</td>
						<td>
						<select name="student">
							<option hidden disabled selected value>Student List</option>
							<?php
							require("../php/session.php");

							$sql = "
							SELECT *
							FROM userTable
							WHERE userRole != 'teacher'";

							$result = mysqli_query($connection, $sql);

							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									echo "<option value='" . $row['userID'] . "'>" . "[" . strtoupper(substr($row['userRole'], 0, 1)) . "] " . $row['firstName'] . " " . $row['lastName'] . " - " . $row['yearLevel'] . "</option>";
								}
							}
							mysqli_close($connection);
							?>
						</select>
						</td>
					</tr>
					<tr>
						<td>	
							<label for="role">Role</label>
						</td>
						<td>
							<select name="role">
								<option>Mentor</option>
								<option>Student</option>
						</td>
					</tr>
						
				</tbody>
			</table>
			<input type="submit" name="convert-submit" value="Change Role">
		</form>
		</div>
		<div class="section">
			<h3>Subjects</h3>
			<form action="add-subject.php" method="post" name="subject-form">
			<table class="main-form">
				<tbody>
					<tr>
						<td>
							<label for="available-subjects">Available subjects</label>
						</td>
						<td>
						<select name="available-subjects">
							<option selected value>Subject List</option>
							<?php
							require("../php/session.php");

							$sql = "
							SELECT *
							FROM subjectTable";

							$result = mysqli_query($connection, $sql);

							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
									echo "<option>" . $row['subjectName'] . "</option>";
								}
							}
							mysqli_close($connection);
							?>
						</select>
						</td>
					</tr>
					<tr>
						<td>	
							<label for="subject">Add a subject</label>
						</td>
						<td>
							<input type="text" name="subject-name" placeholder="Subject Name">
						</td>
					</tr>
						
				</tbody>
			</table>
			<input type="submit" name="subject-submit" value="Add Subject">
		</form>
		</div>
	</main>
</body>
</html>