<?php
	// Start the session ** must be before html tags **
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- make sure you change the title to match your page -->
<title>G21 Example - Booked Session</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="../../G21_example/css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
	/**** define variables ****/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "G21_Example";
	$subjectID;

	// Create connection to the database
	$conn = new mysqli($servername, $username, $password, $dbName);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";
	
	
	//assign posted data from the form to variables
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$allSubjects = $_POST['subjects']; // can't trim arrays.
  		$menteeName = test_input($_POST['menteeName']);
		$date = test_input($_POST["sessionDate"]);
	  	$mentorID = test_input($_POST["mentorID"]);
	}
	
	//trim data sent.
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>

<!-- include navigation bar on all pages, so you only have to update ONE file (nav.php) when changes are made -->
<?php include("../../G21_example/nav.php"); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
        <h1 class="text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px; text-align: center;" src="../../G21_example/images/G21_logo.png" data-holder-rendered="true">
        <br>G21 example - Booked Session
        </h1>
        <p class="text-center">On the index.php page a user has booked a session and the form sent the information to this page.</p>
	  </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="text-center col-sm-6">
      <h3>Output Booked Session Details and commit to database</h3>
      <p><?php
		  //output all the data sent through from the form.
		  echo $menteeName . " booked a session on " . $date . " for:<br>";
		  	//output all subjects selected.
		  	if(empty($allSubjects)){
 				echo "Subject not selected";
			}else{
				$N = count($allSubjects);
				for($i=0; $i < $N; $i++){
					//based on the subjectID passed from the form get the subject Name.
					$sqlSubjectName = "SELECT subjectName FROM subjectTable WHERE subjectID=". $allSubjects[$i];
					$resultSubject = $conn->query($sqlSubjectName);
					  if ($resultSubject->num_rows == 1) {
						  while($row = $resultSubject->fetch_assoc()) {
							$subjectName = $row["subjectName"];
						  }
					  }else{
						  echo "no subject found for that id";
					  }
					$subjectID = $allSubjects[$i];
					echo "* $subjectID - $subjectName <br>";
					
				}
			}
		  
		  	// get Mentor name based of mentorID passed
		  	$sqlMentorName = "SELECT firstName FROM MentorTable WHERE mentorID=$mentorID";
			$resultMentor = $conn->query($sqlMentorName);
	
			  if ($resultMentor->num_rows == 1) {
				  while($row = $resultMentor->fetch_assoc()) {
					$mentorName = $row["firstName"];
				  }
			  }else{
				  echo "no mentor found for that id";
			  }
		  
		  	echo "with $mentorName ($mentorID) as the mentor <br>";
		  
		  //get the assigned teacher ID for that mentor
		  $sqlSelectTeacher = "SELECT teacherID FROM TeacherSubjectTable WHERE mentorID=$mentorID";
		  $result = $conn->query($sqlSelectTeacher);
		  if ($result->num_rows == 1) {
			  while($row = $result->fetch_assoc()) {
			  	$teacherID = $row["teacherID"];
			  }
		  }else{
			  echo "no teacher assigned";
		  }
		  
		  //commit data to the sessions table in the database
		  $sqlInsertSession = "INSERT INTO SessionsTable (date, mentorID, menteeID, subjectID, teacherID)
					VALUES ('$date', $mentorID,". $_SESSION['userID'] . ", '$subjectID', $teacherID)";
		  	//let the user know if it worked or not :)
			if ($conn->query($sqlInsertSession) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sqlInsertSession . "<br>" . $conn->error;
			}
		?>
      </p>
      <a class="btn btn-danger btn-lg" href="#" role="button">Mentee</a></div>
    <div class="text-center col-sm-6">
      <h3>Teacher Select Table Data Example</h3>
      <p>
		  <?php
		  	/* // select all of the data from TeacherTable using mySQLi procedural example */
			$sql = "SELECT * FROM TeacherTable";
		    //mysqli_query requires (database, query);
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "Teacher Table<br> id: " . $row["teacherID"]. "<br> Name: " . $row["firstName"]. " " . $row["lastName"]. "<br> Email: " . $row["email"] . "<br>";
				}
			} else {
				echo "0 results";
			}
		  ?>
	  </p>
      <a class="btn btn-info btn-lg" href="#" role="button">Teacher</a></div>
  </div>
</div>
<hr>
<div class="container">
  <div class="row">
   <div class="col-lg-3 col-md-6 col-sm-6">
      <h2><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Insert Data</h2>
      <p>Look in the code below to see example php and sql for inserting data:
	  	<?php
	  		/* // insert data example 
			$sql = "INSERT INTO MenteeTable (firstName, lastName, email, gender, yrLevel, houseID)
					VALUES ('John', 'Smith', 'john@example.com', 'M', '9', '2')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}*/

		?>
	  </p>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update Data</h2>
      <p>Look in the code below to see example php and sql for udating data:
		<?php
		    /* // sql to update a record 
		    $sql = "UPDATE MenteeTable SET lastName='Doe' WHERE menteeID=2";

			if ($conn->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}*/
		?>
      </p>
    </div>
    
    <div class="col-lg-3 col-md-6 col-sm-6">
      <h2><span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span> Delete Data</h2>
      <p> Look in the code below to see example php and sql for deleting data:
		<?php
		    /* // sql to delete a record
			$sql = "DELETE FROM MenteeTable WHERE menteeID=2";

			if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully";
			} else {
				echo "Error deleting record: " . $conn->error;
			}*/
		?>
      </p>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <h2><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Learn more about PHP and SQL</h2>
      <p>To learn more about PHP and SQL go to <a href="https://www.w3schools.com/php/php_mysql_select.asp">w3Schools</a>.</p>
    </div>
  </div>
</div>
<hr>
<div class="container">
  <div class="row">
<div class="col-lg-4 col-md-6 col-sm-6">
      <h2>Contact Us</h2>
      <address>
      <strong>MyCompany, Inc.</strong><br>
      Sunny Autumn Plaza, Grand Coulee,<br>
      CA, 91308-4075, US<br>
      <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
      <h4>Social</h4>
      <div class="row">
      	<div class="col-xs-2"><img class="img-circle" src="../../G21_example/images/32X32.gif" alt=""></div>
      	<div class="col-xs-2"><img class="img-circle" src="../../G21_example/images/32X32.gif" alt=""></div>
      	<div class="col-xs-2"><img class="img-circle" src="../../G21_example/images/32X32.gif" alt=""></div>
      	<div class="col-xs-2"><img class="img-circle" src="../../G21_example/images/32X32.gif" alt=""></div>        
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <h2>Testimonials</h2>
      <div class="media">
        <div class="media-left"> <a href="#"> <img class="media-object" src="../../G21_example/images/35X35.gif" alt="..."> </a> </div>
        <div class="media-body">
          <h4 class="media-heading">Media heading</h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. </div>
      </div>
      <div class="media">
        <div class="media-left"> <a href="#"> <img class="media-object" src="../../G21_example/images/35X35.gif" alt="..."> </a> </div>
        <div class="media-body">
          <h4 class="media-heading">Media heading</h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12">
      <h2>About Us</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, voluptates, soluta velit nostrum ut iste exercitationem vitae ipsum repellendus laudantium ab possimus nemo odio cumque illum nulla laborum blanditiis unde.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, voluptates, soluta velit nostrum ut iste exercitationem vitae ipsum repellendus laudantium ab possimus nemo odio cumque illum nulla laborum blanditiis unde.</p>
    </div>
  </div>
</div>
  <hr>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © MyWebsite. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../../G21_example/js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../../G21_example/js/bootstrap.js"></script>


<?php 
	// close the connection to the database
	mysqli_close($conn); 
?>

</body>
</html>
