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
					<title>G21 Example Website</title>
					<!-- Bootstrap -->
					<link rel="stylesheet" href="../../../G21_example/css/bootstrap.css">
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
	$dbName = "G21_example";

	// Create connection to the database
	$conn = new mysqli($servername, $username, $password, $dbName);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	/*if using login use a session variable to store the users role and id
	NOTE: you must start the session at the start of the file and assign the login details to the session variables. You must destroy the session when the user logs out.
	*/
	// Set session variables
	$_SESSION["userID"] = "1";
	$_SESSION["role"] = "mentee";
	
?>
						<!-- include navigation bar on all pages, so you only have to update ONE file (nav.php) when changes are made -->
						<?php include("../../../G21_example/nav.php"); ?>
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="jumbotron">
										<h1 class="text-center">
											<img class="img-circle" alt="140x140" style="width: 140px; height: 140px; text-align: center;" src="../../../G21_example/images/G21_logo.png" data-holder-rendered="true">
												<br>G21 example code
        
												</h1>
												<p class="text-center">Within the code you will find examples of php and sql code you might find helpful to modify for your assignment.</p>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row">
										<div class="text-center col-sm-6">
											<h3>Mentee Select Table Data Example</h3>
											<p>
												<?php
		/* // select all the data from the MenteeTable using mySQLi object-orientated example */
		$sql = "SELECT * FROM MenteeTable";
		//result is a variable array that stores the results of the query.
		//$conn is the database variable set at the start
		//query() sends the sql query to the database.
		$result = $conn->query($sql);
		
		//if there are results it loops through them outputing them to the screen, if not it outputs 0 results.
		if ($result->num_rows > 0) {
			//output data of each row of the query results. 
			//join strings and variables with a .
			while($row = $result->fetch_assoc()) {
				echo "Mentee id: " . $row["menteeID"]. "
												<br> Name: " . $row["firstName"]. " " . $row["lastName"]. "
													<br> Email: " . $row["email"] . "
														<br> Year: " . $row["yrLevel"] . "
															<br> House: " . $row["houseID"] . "
																<br>
																	<br>";
			}
		} else {
			echo "0 results";
		}
	  ?>
																	</p>
																	<a class="btn btn-danger btn-lg" href="#" role="button">Mentee</a>
																</div>
																<div class="text-center col-sm-6">
																	<h3>Mentor Select Table Data Example</h3>
																	<p>
																		<?php
		  	/* // select all of the data from MentorTable using mySQLi procedural example */
			$sql = "SELECT * FROM mentortable";
		    //mysqli_query requires (database, query);
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "Mentor id: " . $row["mentorID"]. "
																		<br> Name: " . $row["firstName"]. " " . $row["lastName"]. "
																			<br> Email: " . $row["email"] . "
																				<br> Year: " . $row["yrLevel"] . "
																					<br> House: " . $row["houseID"] . "
																						<br>
																							<br>";
				}
			} else {
				echo "0 results";
			}
		  ?>
																							</p>
																							<a class="btn btn-info btn-lg" href="#" role="button">Mentor</a>
																						</div>
																					</div>
																				</div>
																				<hr>
																					<div class="container">
																						<div class="row">
																							<div class="col-lg-3 col-md-6 col-sm-6">
																								<h2>
																									<span class="glyphicon glyphicon-music" aria-hidden="true"></span> Insert Data
																								</h2>
																								<p>Look in the code below to see example php and sql for inserting data:
	  	
																									<?php
	  		/* // insert data example 
			$sql = "INSERT INTO MenteeTable (firstName, lastName, email, gender, yrLevel, houseID)
					VALUES ('John', 'Smith', 'john@example.com', 'M', '9', '2')";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "
																									<br>" . $conn->error;
			}*/

		?>
																									</p>
																								</div>
																								<div class="col-lg-3 col-md-6 col-sm-6">
																									<h2>
																										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update Data
																									</h2>
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
																									<h2>
																										<span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span> Delete Data
																									</h2>
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
																									<h2>
																										<span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Learn more about PHP and SQL
																									</h2>
																									<p>To learn more about PHP and SQL go to 
																										<a href="https://www.w3schools.com/php/php_mysql_select.asp">w3Schools</a>.
																									</p>
																								</div>
																							</div>
																						</div>
																						<div class="container">
																							<div class="row">
																								<h1>How to link HTML forms to a database:</h1>
																								<hr>
																									<div class="col-lg-3 col-sm-6">
																										<div class="panel panel-default panel-success">
																											<!-- Use session userID to prefill some information -->
																											<?php 
		  	//set the variables you want to use later here
		  	$menteeFirstName = "";
		  	$menteeHouse = "";
		  	$menteeSubjects = array();
		  	$mentorAval = array();
		  	$mentorID = array();
		  	$subjectID = array();
		  
		  	//select Name and house based on their ID = $_SESSION['userID']
		  	$sql_menteeDetails = "SELECT * FROM MenteeTable INNER JOIN houseTable ON MenteeTable.houseID = houseTable.houseID WHERE menteeID = " . $_SESSION['userID'];
			$result_menteeDetails = $conn->query($sql_menteeDetails);
		  
		  	if ($result_menteeDetails->num_rows == 1) {
				// output data of each row (will only be one result)
				while($row = $result_menteeDetails->fetch_assoc()) {
					//assign result valules to the varibles created earlier.
					$menteeFirstName = $row["firstName"];
					$menteeHouse = $row["houseName"];
				}
			} else {
				echo "0 results";
			}
		  
		  	// get all the mentee's subjects for them to select the one they wish to have a session for.
		  	$sql_menteeSubjects = "SELECT subjectTable.subjectID, subjectName FROM MenteeSubjectTable INNER JOIN subjectTable ON MenteeSubjectTable.subjectID = subjectTable.subjectID WHERE menteeID = " . $_SESSION['userID'];
			$result_menteeSubjects = $conn->query($sql_menteeSubjects);
		  
		  	if ($result_menteeSubjects->num_rows >0) {
				// output data of each row
				while($row = $result_menteeSubjects->fetch_assoc()) {
					//as there will most likely be more than on result assign to an array variable.
					//$subjectID[] = $row["subjectID"];
					$menteeSubjects[$row["subjectID"]] = $row["subjectName"];
				}
			} else {
				echo "0 results";
			}

		?>
																											<div class="panel-heading">
																												<h3>Book Session</h3>
																											</div>
																											<!-- form tag to handle user input -->
																											<form action="../../../G21_example/bookedSession.php" name="bookSession" method="post">
																												<!-- Table to help layout the information neatly-->
																												<table class="table">
																													<thead>
																														<tr>
																															<th width="30%" class="right">Name:</th>
																															<th width="70%">
																																<?php
						//output the Mentee's firstname you queried for above.
						echo "
																																<input type='text' id='menteeName' name='menteeName' value='$menteeFirstName'/>";
					?>
																															</th>
																														</tr>
																													</thead>
																													<tbody>
																														<tr>
																															<th scope="row" class="right">House:</th>
																															<th>
																																<select name="formHouse">
																																	<option value="houseID" id="1">Asher</option>
																																	<option value="houseID" id="2">Ephraim</option>
																																	<option value="houseID" id="3">Judah</option>
																																	<option value="houseID" id="4">Levi</option>
																																</select>
																															</th>
																														</tr>
																														<tr>
																															<th scope="row" class="right">Subject: </th>
																															<th>
																																<!-- output mentee subject array as checkboxes -->
																																<?php
					  //loop through mentee subjects array 
						//NOTE: change from checkbox to radio buttons if you only want them to select one subject (highly recommended)!!!!
						foreach($menteeSubjects as $x => $x_value) {
							//echo "mentee subject id = " . $x . ", Value = " . $x_value;
							echo "
																																<input type='checkbox' id='$x_value' name='subjects[]' value='$x'/>  $x_value
																																<br>";
						}
					?>
																																</th>
																															</tr>
																															<tr>
																																<th scope="row" class="right">Date: </th>
																																<th>
																																	<!-- call the getMentors function once the user selects a date -->
																																	<input type="date" name="sessionDate" id="sessionDate" on onChange="getMentors();" required />
																																</th>
																															</tr>
																															<tr>
																																<th scope="row" class="right">Mentor:</th>
																																<th>
																																	<select name="formHouse">
																																		<option value="mentorID" id="1">Jill Jack</option>
																																		<option value="mentorID" id="2">Thomas Borinetti</option>
																																		<option value="mentorID" id="3">Joshua Abbate</option>
																																		<option value="mentorID" id="4">Daniel Lee</option>
																																	</select>
																																</th>
																															</tr>
																															<tr>
																																<th scope="row" colspan="2">
																																	<p class="text-center">
																																		<input type="submit" value="Book Now"   class="btn-success btn">
																																		</p>
																																	</th>
																																</tr>
																															</tbody>
																														</table>
																													</form>
																												</div>
																											</div>
																											<div class="col-lg-3 col-sm-6">
																												<div class="panel panel-default panel-warning">
																													<!-- Default panel contents -->
																													<div class="panel-heading">
																														<h3>Update Session (ToDo)</h3>
																													</div>
																													<!-- Table -->
																													<table class="table">
																														<thead>
																															<tr>
																																<th>Name:</th>
																															</tr>
																														</thead>
																														<tbody>
																															<tr>
																																<th scope="row">Subject:</th>
																															</tr>
																															<tr>
																																<th scope="row">Date:</th>
																															</tr>
																															<tr>
																																<th scope="row">Mentor:</th>
																															</tr>
																															<tr>
																																<th scope="row">
																																	<p class="text-center">
																																		<a href="" class="btn-warning btn">
																																			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Buy Now
																																		</a>
																																	</p>
																																</th>
																															</tr>
																														</tbody>
																													</table>
																												</div>
																											</div>
																											<div class="col-lg-3 col-sm-6">
																												<div class="panel panel-default panel-info">
																													<!-- Default panel contents -->
																													<div class="panel-heading">
																														<h3>Cancel Session (ToDo)</h3>
																													</div>
																													<!-- Table -->
																													<table class="table">
																														<thead>
																															<tr>
																																<th>Lorem ipsum dolor sit</th>
																															</tr>
																														</thead>
																														<tbody>
																															<tr>
																																<th scope="row">1 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">2 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">3 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">
																																	<p class="text-center">
																																		<a href="" class="btn-info btn">
																																			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Buy Now
																																		</a>
																																	</p>
																																</th>
																															</tr>
																														</tbody>
																													</table>
																												</div>
																											</div>
																											<div class="col-lg-3 col-sm-6">
																												<div class="panel panel-default panel-danger">
																													<!-- Default panel contents -->
																													<div class="panel-heading">
																														<h3>Enterprise</h3>
																													</div>
																													<!-- Table -->
																													<table class="table">
																														<thead>
																															<tr>
																																<th>Lorem ipsum dolor sit</th>
																															</tr>
																														</thead>
																														<tbody>
																															<tr>
																																<th scope="row">1 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">2 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">3 ......</th>
																															</tr>
																															<tr>
																																<th scope="row">
																																	<p class="text-center">
																																		<a href="" class="btn-danger btn">
																																			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Buy Now
																																		</a>
																																	</p>
																																</th>
																															</tr>
																														</tbody>
																													</table>
																												</div>
																											</div>
																										</div>
																									</div>
																									<hr>
																										<section class="well">
																											<h2 class="text-center">SQL Video Tutorial</h2>
																											<hr>
																												<div class="container">
																													<div class="row">
																														<div class="col-lg-12">
																															<div class="embed-responsive embed-responsive-16by9">
																																<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/9yeOJ0ZMUYw"></iframe>
																															</div>
																														</div>
																													</div>
																												</div>
																											</section>
																											<hr>
																												<div class="container">
																													<div class="row">
																														<div class="col-lg-4 col-md-6 col-sm-6">
																															<h2>Contact Us</h2>
																															<address>
																																<strong>MyCompany, Inc.</strong>
																																<br>
      Sunny Autumn Plaza, Grand Coulee,
																																	<br>
      CA, 91308-4075, US
																																		<br>
																																			<abbr title="Phone">P:</abbr> (123) 456-7890
      
																																		</address>
																																		<h4>Social</h4>
																																		<div class="row">
																																			<div class="col-xs-2">
																																				<img class="img-circle" src="../../../G21_example/images/32X32.gif" alt="">
																																				</div>
																																				<div class="col-xs-2">
																																					<img class="img-circle" src="../../../G21_example/images/32X32.gif" alt="">
																																					</div>
																																					<div class="col-xs-2">
																																						<img class="img-circle" src="../../../G21_example/images/32X32.gif" alt="">
																																						</div>
																																						<div class="col-xs-2">
																																							<img class="img-circle" src="../../../G21_example/images/32X32.gif" alt="">
																																							</div>
																																						</div>
																																					</div>
																																					<div class="col-lg-4 col-md-6 col-sm-6">
																																						<h2>Testimonials</h2>
																																						<div class="media">
																																							<div class="media-left">
																																								<a href="#">
																																									<img class="media-object" src="../../../G21_example/images/35X35.gif" alt="...">
																																									</a>
																																								</div>
																																								<div class="media-body">
																																									<h4 class="media-heading">Media heading</h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
																																								</div>
																																							</div>
																																							<div class="media">
																																								<div class="media-left">
																																									<a href="#">
																																										<img class="media-object" src="../../../G21_example/images/35X35.gif" alt="...">
																																										</a>
																																									</div>
																																									<div class="media-body">
																																										<h4 class="media-heading">Media heading</h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
																																									</div>
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
																																						<script src="../../../G21_example/js/jquery-1.11.3.min.js"></script>
																																						<!-- Include all compiled plugins (below), or include individual files as needed -->
																																						<script src="../../../G21_example/js/bootstrap.js"></script>
																																						<script>
	//getMentors fuction based on the date selected in the book sessions form
   function getMentors(){
	   	//create a variable to store the date selected, refered by the id # .val() gets the value of the field.
		var selectedDate = $('#sessionDate').val();
	    //we need to put it in a format of GET as we will be passing it to another file. variableName=value
		var dataDate = 'selectedDate=' + selectedDate;
	   
	   //use ajax to pass the information to the findMentors page and get back the html created by the php
	   $.ajax({
			url: 'http://localhost/G21_example/findMentors.php',
			type: 'GET',
			data: dataDate,
			success: function(data){
				//use the id to change the html to that created on the findMentors.php file.
				$('#dynamicMentors').html(data);    
			}
		});
	};
</script>
																																						<?php 
	// close the connection to the database
	mysqli_close($conn); 
?>
																																						<?php	
	/*// remove all session variables
	session_unset(); 

	// destroy the session use this for when a user logs out.
	session_destroy(); 
	*/
?>
																																					</body>
																																				</html>
v