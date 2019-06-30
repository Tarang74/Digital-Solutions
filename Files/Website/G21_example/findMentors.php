<!-- This page is called by the getMentors function using ajax on the index.php page. -->
<?php 
	/**** define variables ***/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "G21_Example";
	$dataString = "";
	$getVal = "";
	$mentorsID = array();
	

	// Create connection to the database
	$conn = new mysqli($servername, $username, $password, $dbName);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	//make sure the value passed is a string
	$getVal = strval($_GET['selectedDate']);

	//create the sql to get the mentor names who are avaialbe on the selected date
	$sql_mentorAval = "SELECT MentorTable.mentorID, firstName FROM MentorTable WHERE MentorTable.mentorID != ALL (SELECT SessionsTable.mentorID FROM SessionsTable WHERE date = '$getVal');";
	$result_mentorAval = $conn->query($sql_mentorAval);

	//if mentors avaliable then put into mentorAval array otherwise add none avaliable to the array.
	if ($result_mentorAval->num_rows >0) {
		// assign the data of each row into the array.
		while($row = $result_mentorAval->fetch_assoc()) {
			$mentorsID[] = $row["mentorID"];
			$mentorsAval[] = $row["firstName"];
		}
	} else {
		//if no results add this text to the array instead.
		$mentorsID[] = "0";
		$mentorsAval[]= "no mentors avaliable";
	}
	
	//create the data string to output/pass back to the other page for output. We need the whole select box information created.
	$dataString = "<select name='mentorID'>";

	//loop through the array to create the options of the select box
	$arrlength = count($mentorsAval);
	  for($x = 0; $x < $arrlength; $x++) {
		$dataString .= " <option value='" . $mentorsID[$x] . "'>" . $mentorsAval[$x]. "</option>";
	  }
	//add the close tag for the select box
	$dataString .="</select>";

	//print the select box to the screen.
	echo $dataString;
	//echo $dataStringHidden;
?>
		