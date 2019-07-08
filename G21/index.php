<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	<title>G21</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    
	<?php
	    $_SESSION["userID"] = "1";
	    $_SESSION["role"] = "mentee";
	?>
    
	<?php include("nav.php"); ?>
    
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron">
					<h1 class="text-center">
                        <img alt="140x140" class="img-circle" data-holder-rendered="true" src="images/G21_logo.png" style="width: 140px; height: 140px; text-align: center;"><br>
					    G21 example code
                    </h1>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="text-center col-sm-6">
				<h3>Mentee Select Table Data Example</h3>
				<p><?php
 
				        $sql = "SELECT * FROM MenteeTable";
				        //result is a variable array that stores the results of the query.
				        //$connection is the database variable set at the start
				        //query() sends the sql query to the database.
				        $result = $connection->query($sql);
				        
				        //if there are results it loops through them outputing them to the screen, if not it outputs 0 results.
				        if ($result->num_rows > 0) {
				            //output data of each row of the query results. 
				            //join strings and variables with a .
				            while($row = $result->fetch_assoc()) {
				                echo "Mentee id: " . $row["menteeID"]. "<br> Name: " . $row["firstName"]. " " . $row["lastName"]. "<br> Email: " . $row["email"] . "<br> Year: " . $row["yearLevel"] . "<br> House: " . $row["houseID"] . "<br><br>";
				            }
				        } else {
				            echo "0 results";
				        }
				      ?></p><a class="btn btn-danger btn-lg" href="#" role="button">Mentee</a>
			</div>
			<div class="text-center col-sm-6">
				<h3>Mentor Select Table Data Example</h3>
				<p><?php
				            /* // select all of the data from MentorTable using mySQLi procedural example */
				            $sql = "SELECT * FROM mentortable";
				            //mysqli_query requires (database, query);
				            $result = mysqli_query($connection, $sql);

				            if (mysqli_num_rows($result) > 0) {
				                // output data of each row
				                while($row = mysqli_fetch_assoc($result)) {
				                    echo "Mentor id: " . $row["mentorID"]. "<br> Name: " . $row["firstName"]. " " . $row["lastName"]. "<br> Email: " . $row["email"] . "<br> Year: " . $row["yearLevel"] . "<br> House: " . $row["houseID"] . "<br><br>";
				                }
				            } else {
				                echo "0 results";
				            }
				          ?></p><a class="btn btn-info btn-lg" href="#" role="button">Mentor</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<h2><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Insert Data</h2>
				<p>Look in the code below to see example php and sql for inserting data: <?php
				            /* // insert data example 
				            $sql = "INSERT INTO MenteeTable (firstName, lastName, email, gender, yearLevel, houseID)
				                    VALUES ('John', 'Smith', 'john@example.com', 'M', '9', '2')";

				            if ($connection->query($sql) === TRUE) {
				                echo "New record created successfully";
				            } else {
				                echo "Error: " . $sql . "<br>" . $connection->error;
				            }*/

				        ?></p>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update Data</h2>
				<p>Look in the code below to see example php and sql for udating data: <?php
				            /* // sql to update a record 
				            $sql = "UPDATE MenteeTable SET lastName='Doe' WHERE menteeID=2";

				            if ($connection->query($sql) === TRUE) {
				                echo "Record updated successfully";
				            } else {
				                echo "Error updating record: " . $connection->error;
				            }*/
				        ?></p>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<h2><span class="glyphicon glyphicon-screenshot" aria-hidden="true"></span> Delete Data</h2>
				<p>Look in the code below to see example php and sql for deleting data: <?php
				            /* // sql to delete a record
				            $sql = "DELETE FROM MenteeTable WHERE menteeID=2";

				            if ($connection->query($sql) === TRUE) {
				                echo "Record deleted successfully";
				            } else {
				                echo "Error deleting record: " . $connection->error;
				            }*/
				        ?></p>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<h2><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Learn more about PHP and SQL</h2>
				<p>To learn more about PHP and SQL go to <a href="https://www.w3schools.com/php/php_mysql_select.asp">w3Schools</a>.</p>
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
						$result_menteeDetails = $connection->query($sql_menteeDetails);

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
						$result_menteeSubjects = $connection->query($sql_menteeSubjects);

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
					</div><!-- form tag to handle user input -->
					<form action="bookedSession.php" id="bookSession" method="post" name="bookSession">
						<!-- Table to help layout the information neatly-->
						<table class="table">
							<thead>
								<tr>
									<th class="right" width="30%">Name:</th>
									<th width="70%"><?php
									                        //output the Mentee's firstname you queried for above.
									                        echo "<input type='text' id='menteeName' name='menteeName' value='$menteeFirstName'/>";
									                    ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="right" scope="row">House:</th>
									<th><select name="formHouse">
										<option id="1" value="houseID">
											Asher
										</option>
										<option id="2" value="houseID">
											Ephraim
										</option>
										<option id="3" value="houseID">
											Judah
										</option>
										<option id="4" value="houseID">
											Levi
										</option>
									</select></th>
								</tr>
								<tr>
									<th class="right" scope="row">Subject:</th>
									<th><!-- output mentee subject array as checkboxes -->
									<?php
									                      //loop through mentee subjects array 
									                        //NOTE: change from checkbox to radio buttons if you only want them to select one subject (highly recommended)!!!!
									                        foreach($menteeSubjects as $x => $x_value) {
									                            //echo "mentee subject id = " . $x . ", Value = " . $x_value;
									                            echo "<input type='checkbox' id='$x_value' name='subjects[]' value='$x'/>  $x_value<br>";
									                        }
									                    ?></th>
								</tr>
								<tr>
									<th class="right" scope="row">Date:</th>
									<th><!-- call the getMentors function once the user selects a date -->
									<input id="sessionDate" name="sessionDate" onchange="getMentors();" required="" type="date"></th>
								</tr>
								<tr>
									<th class="right" scope="row">Mentor:</th>
									<th><select name="formHouse">
										<option id="1" value="mentorID">
											Jill Jack
										</option>
										<option id="2" value="mentorID">
											Thomas Borinetti
										</option>
										<option id="3" value="mentorID">
											Joshua Abbate
										</option>
										<option id="4" value="mentorID">
											Daniel Lee
										</option>
									</select></th>
								</tr>
								<tr>
									<th colspan="2" scope="row">
										<p class="text-center"><input class="btn-success btn" type="submit" value="Book Now"></p>
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
					</div><!-- Table -->
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
									<p class="text-center"><a class="btn-warning btn" href=""><span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"></span> Buy Now</a></p>
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
					</div><!-- Table -->
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
									<p class="text-center"><a class="btn-info btn" href=""><span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"></span> Buy Now</a></p>
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
					</div><!-- Table -->
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
									<p class="text-center"><a class="btn-danger btn" href=""><span aria-hidden="true" class="glyphicon glyphicon-shopping-cart"></span> Buy Now</a></p>
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
					<strong>MyCompany, Inc.</strong><br>
					Sunny Autumn Plaza, Grand Coulee,<br>
					CA, 91308-4075, US<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890
				</address>
				<h4>Social</h4>
				<div class="row">
					<div class="col-xs-2"><img alt="" class="img-circle" src="images/32X32.gif"></div>
					<div class="col-xs-2"><img alt="" class="img-circle" src="images/32X32.gif"></div>
					<div class="col-xs-2"><img alt="" class="img-circle" src="images/32X32.gif"></div>
					<div class="col-xs-2"><img alt="" class="img-circle" src="images/32X32.gif"></div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<h2>Testimonials</h2>
				<div class="media">
					<div class="media-left">
						<a href="#"><img alt="..." class="media-object" src="images/35X35.gif"></a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="#"><img alt="..." class="media-object" src="images/35X35.gif"></a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
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
	</footer><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery-1.11.3.min.js">
	</script> <!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="js/bootstrap.js">
	</script>f
    
	<script>
	   //getMentors fuction based on the date selected in the book sessions form
	  function getMentors(){
	       //create a variable to store the date selected, refered by the id # .val() gets the value of the field.
	       var selectedDate = $('#sessionDate').val();
	       //we need to put it in a format of GET as we will be passing it to another file. variableName=value
	       var dataDate = 'selectedDate=' + selectedDate;
	      
	      //use ajax to pass the information to the findMentors page and get back the html created by the php
	      $.ajax({
	           url: 'http://localhost/G21/G21/findMentors.php',
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
	    mysqli_close($connection);
	    
	    /*
	    // remove all session variables
	    session_unset(); 

	    // destroy the session use this for when a user logs out.
	    session_destroy(); 
	    */
	?>
</body>
</html>