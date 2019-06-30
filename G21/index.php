<?php
	// Start the session ** must be before html tags **
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>G21</title>
	<link href="../Website/G21/css/style.css" rel="stylesheet" type="text/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-color:rgba(53,53,53,1.00); background-image: linear-gradient(130deg, rgba(120,170,150,1.00), rgba(40,44,55,1.00));">
	<div class="about" onclick="location.href='#footer';">
		<a>About</a>
	</div>
	<div class="logoContainer">
		<a href="../Website/G21/index.html"><img alt="logo" class="logo" src="../Website/G21/images/citipointe logo.png"></a>
	</div>
	<header class="header">
		<div class="headernav">
			<section class="headerleft">
				<ul>
					<li>
						<a href="../Website/G21/menu.html">Menu</a>
					</li>
					<li>
						<a href="../Website/G21/location.html">Location</a>
					</li>
				</ul>
			</section>
			<section class="headercenter"></section>
			<section class="headerright">
				<ul>
					<li>
						<a href="../Website/G21/gallery.html">Gallery</a>
					</li>
					<li>
						<a href="../Website/G21/review.php">Review</a>
					</li>
				</ul>
			</section>
		</div>
	</header>
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
	
	
	
	
	
	<script src="../Website/G21/js/header.js" type="text/javascript">
	</script>
	<main id="content" style="padding: 10vh 5vw 0 5vw">
		<section class="review">
			<?php
			        $reviewName = $reviewEmail = $reviewGender = $reviewComment = $reviewRating = "";
			    
			        if ($_SERVER["REQUEST_METHOD"] == "POST") {
			            $reviewName = test_input($_POST["reviewName"]);
			            $reviewEmail = test_input($_POST["reviewEmail"]);
			            $reviewComment = test_input($_POST["reviewComment"]);
			            $reviewGender = test_input($_POST["reviewGender"]);
			            $reviewRating = test_input($_POST["reviewRating"]);
			        }

			        function test_input($data) {
			            $data = trim($data);
			            $data = stripslashes($data);
			            $data = htmlspecialchars($data);
			            return $data;
			        }
			    ?>
			<h2>Tell us what you think:</h2>
			<form action="../Website/G21/review.php" id="userReviewForm" method="post" name="userReviewForm">
				<table>
					<tr>
						<td>Name:</td>
						<td><input id="name" name="reviewName" type="text"></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input id="email" name="reviewEmail" type="email"></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><label><input id="Male" name="reviewGender" type="radio" value="Male"> Male</label> <label><input id="Female" name="reviewGender" type="radio" value="Female"> Female</label></td>
					</tr>
					<tr>
						<td>Comment:</td>
						<td>
						<textarea id="comment" name="reviewComment" placeholder="Enter your comment here." required=""></textarea></td>
					</tr>
					<tr>
						<td>Rating:</td>
						<td>
							<div class="rate">
								<input id="star5" name="reviewRating" type="radio" value="5"><label for="star5" title="5">5 stars</label>
                                <input id="star4" name="reviewRating" type="radio" value="4"><label for="star4" title="4">4 stars</label>
                                <input id="star3" name="reviewRating" type="radio" value="3"><label for="star3" title="3">3 stars</label>
                                <input id="star2" name="reviewRating" type="radio" value="2"><label for="star2" title="2">2 stars</label>
                                <input id="star1" name="reviewRating" type="radio" value="1"><label for="star1" title="1">1 star</label>
							</div>
						</td>
					</tr>
					<tr>
						<td><input type="submit"></td>
						<td><input type="reset"></td>
					</tr>
				</table>
			</form>
            
			<h1 style="text-transform: capitalize">Thank You <?php 
			                echo $reviewName; 
			            ?></h1>Email: <?php 
			                echo $reviewEmail; 
			            ?><br>
			Comment: <?php 
			                echo $reviewComment; 
			            ?><br>
			Rating: <?php
			                echo $reviewRating;
			            ?> <?php
			            $commentsFile = fopen("comments.txt", "a") or die("Unable to open file");
			            $publicCommentsFile = fopen("publicComments.txt", "a") or die("Unable to open file");
			            if ($reviewName == null) {
			                
			            } else {
			                
			                $commentText = 
			                "Name: " . $reviewName . "\r\n" . 
			                "Email: " . $reviewEmail . "\r\n" . 
			                "Gender: " . $reviewGender . "\r\n" . 
			                "Comment: " . $reviewComment . "\r\n" .
			                "Rating: " . $reviewRating . "\r\n" . "\r\n";
                            
                            $publicCommentsText =
                            "Name: " . $reviewName . "\r\n" .
                            "Rating: " . $reviewRating . "\r\n" .
			                "Comment: " . $reviewComment . "\r\n" . "\r\n";
                            
			            fwrite($commentsFile, $commentText);
			            fclose($commentsFile);
			            
                        fwrite($publicCommentsFile, $publicCommentsText);
                        fclose($publicCommentsFile);
                        
                        
			            $numCommentsFile = fopen("numComments.txt", "r") or die("Unable to open file");
			            $totalNumComments = intval(fgets($numCommentsFile));
			                
			            $totalStarsFile = fopen("totalStars.txt", "r") or die("Unable to open file");
			            $totalStars = intval(fgets($totalStarsFile));
			                
			            $totalNumComments = $totalNumComments + 1;
			            fclose($numCommentsFile);
			            
			            $totalStars = $totalStars + $reviewRating;
			            fclose($totalStarsFile);
			            
			            $numCommentsFile = fopen("numComments.txt", "w") or die("Unable to open file");
			            $totalStarsFile = fopen("totalStars.txt", "w") or die("Unable to open file");
			            $averageStarsFile = fopen("averageStars.txt", "w") or die("Unable to open file");
			            
			            $averageStars = $totalStars / $totalNumComments;
			                
			            fwrite($totalStarsFile, $totalStars);
			            fwrite($averageStarsFile, $averageStars);
			            fwrite($numCommentsFile, $totalNumComments);
			            fclose($totalStarsFile);
			            fclose($averageStarsFile);
			            fclose($numCommentsFile);
			            }

			        ?>
			<h1>Previous Reviews</h1>
			<p>NUMBER OF REVIEWERS: <?php
			            $numCommentsFile = fopen("numComments.txt", "r") or die("Unable to open file");
			            $totalNumComments = intval(fgets($numCommentsFile));
			            
			            echo $totalNumComments;
			            fclose($numCommentsFile);
			        ?></p>
			<p>AVERAGE RATING: <?php
			            $averageStarsFile = fopen("averageStars.txt", "r") or die("Unable to open file");
			            $averageStars = floor(floatval(fgets($averageStarsFile)) * 2) / 2;
			            
			            echo $averageStars;
			            fclose($averageStarsFile);
			        ?></p><?php
			            if($totalNumComments > 1) {
			               if ($fh = fopen("publicComments.txt", "r")) {
			                    while (!feof($fh)) {
			                        $line = fgets($fh);
			                        echo $line . "<br>";
			                    }
			                    fclose($fh);
			                } else {
			                    echo "Unable to open file";
			                }               
			            }
			        ?>
		</section>
	</main>
	<footer id="footer">
		<div class="footer">
			<section>
				<ul>
					<li>
						<a class="heading">Location</a>
					</li>
					<li>
						<a>96 Gaynesford St, Mount Gravatt QLD 4122</a>
					</li>
					<li>
						<a class="heading">Phone</a>
					</li>
					<li>
						<a>0478 509 090</a>
					</li>
				</ul>
			</section>
			<section>
				<ul>
					<li>
						<a class="heading">Sitemap</a>
					</li>
					<li>
						<a href="../Website/G21/menu.html">Menu</a>
					</li>
					<li>
						<a href="../Website/G21/location.html">Location</a>
					</li>
					<li>
						<a href="../Website/G21/gallery.html">Gallery</a>
					</li>
					<li>
						<a href="../Website/G21/review.php">Review</a>
					</li>
				</ul>
			</section>
			<section>
				<ul>
					<li>
						<a class="heading">Social</a>
					</li>
					<li>
						<a href="https://www.facebook.com/kithnchow"><i class="fa socialfb">&#xf09a;</i></a>
					</li>
					<li>
						<a href="https://www.instagram.com/kithnchow/"><i class="fa socialin">&#xf16d;</i></a>
					</li>
				</ul>
			</section>
		</div>
	</footer>
</body>
</html>