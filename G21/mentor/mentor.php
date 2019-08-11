<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/login.css">
</head>
<body>
	
	<?php require("header1.php")?>
	
	<main>

		<?php 
		require("../php/session.php");

		$sql = "SELECT * FROM sessionTable";
		$result = $connection->query($sql);

		echo "<table>";

		while($row = mysqli_fetch_array($result)) {
		echo "<tr><td>" . $row['sessionID'] . "</td><td>" . $row['sessionTS'] . "</td><td>" . $row['subjectID'] . "</td><td>" . $row['studentID'] . "</td><td>" . $row['mentorID'] . "</td><td>" . $row['sessionComment'] . "</td><td>" . $row['finished'] . "</td></tr>";
		}

		echo "</table>";

		mysqli_close();
	
		?>
		
	</main>
</body>
</html>