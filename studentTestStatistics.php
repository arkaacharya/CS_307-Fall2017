<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Exami-Nation</title>
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>

<?php

	$servername = "localhost"; //Name of the server
	$dbname = "examination"; //Name of the database
	$username = "root"; //Username used to connect to the database
	$password = NULL; //Password used to connect to the database

	$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
	if($conn->error){ //Checking connection for errors
		die("Could not establish connection to database."); //Terminating the page
	}

	$userName = $_GET['userName'];
	$course = $_GET['course'];
	
	$sql = "SELECT name, bio, loggedIn From students WHERE username='".$userName."'";
	$data = mysqli_query($conn, $sql);
	$result = mysqli_fetch_row($data);
	$name = $result[0];
	$bio = $result[1];
	
	if(!$result[2]){
		header("Location: login.php");
	}

?>

<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1><a href="#">Exami-Nation</a></h1>
				<p>[Logo goes here]</p>
			</div>
		</div>
	</div>
	<!-- end #header -->

	<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li><a href="studentNotificationsPage.php?userName=<?php echo $userName ?>">Notifications</a></li>
				<li class="current_page_item"><a href="studentCoursesPage.php?userName=<?php echo $userName ?>">Courses</a></li>
				<li><a href="studentAchievementsPage.php?userName=<?php echo $userName ?>">Achievements</a></li>
				<li><a href="studentAccountPage.php?userName=<?php echo $userName ?>">Account</a></li>
				<li><a href="logout.php?account=student&userName=<?php echo $userName; ?>">Logout</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<a href='#'>Welcome, <?php echo $name; ?></a>
	</div>

	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div style="clear: both;">&nbsp;</div>
					<div style="clear: both;">&nbsp;</div>

					
					<div class="entry">
						<h2 class="title"><?php echo $course; ?></h2>
						<?php
							$sql = "SELECT totalCorrect, totalEssayGrade, achievedEssayGrade From studentanswers WHERE studentName='".$userName."' AND course='".$course."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							$totalCorrect = $result[0];
							$totalEssayGrade = $result[1];
							$achievedEssayGrade = $result[2];
							
							$sql = "SELECT MIN(finalPercentage), MAX(finalPercentage), AVG(finalPercentage) FROM studentanswers WHERE course='".$course."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							$min = $result[0];
							$max = $result[1];
							$avg = $result[2];
							
							$sql = "SELECT numMCQ FROM courses WHERE name='".$course."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
						?>
								<h3><?php echo "Final MCQ Grade: ".$totalCorrect."/".$result[0]; ?></a></h3>
								<h3><?php echo "Final Essay Grade: ".$achievedEssayGrade."/".$totalEssayGrade; ?></a></h3>
								<h3><?php echo "Final Percentage: ".(100*($achievedEssayGrade+$totalCorrect)/($result[0]+$totalEssayGrade))."%"; ?></a></h3>
								</br>
								<h3><?php echo "Max Grade: ".$max ?></h3>
								<h3><?php echo "Min Grade: ".$min ?></h3>
								<h3><?php echo "Average Grade: ".$avg ?></h3>
								
					</div>
					
					<div>
						<h3 class="link"><a href="logout.php?account=student&userName=<?php echo $userName; ?>">Logout</a></h3>
					</div>
					
					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>

</body>
</html>

<script>
history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});
</script>