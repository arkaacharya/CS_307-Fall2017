<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Exami-Nation</title>
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>

<style>
#table{
    text-align: center;
    display: table;
}
</style>

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
	
	$sql = "SELECT name, bio, loggedIn From teachers WHERE username='".$userName."'";
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
				<li class="current_page_item"><a href="teacherCoursesPage.php?userName=<?php echo $userName ?>">Courses</a></li>
				<li><a href="teacherStudentsPage.php?userName=<?php echo $userName ?>">Students</a></li>
				<li><a href="teacherAccountPage.php?userName=<?php echo $userName ?>">Account</a></li>
				<li><a href="logout.php?account=teacher&userName=<?php echo $userName; ?>">Logout</a></li>
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
	
					<h3>Test Statistics</h3>
					<?php	$sql = "SELECT MIN(finalPercentage), MAX(finalPercentage), AVG(finalPercentage) FROM studentanswers WHERE course='".$course."'";
					$data = mysqli_query($conn, $sql);
					$result = mysqli_fetch_row($data);
					$min = $result[0];
					$max = $result[1];
					$avg = $result[2];
					?>
						<h4><?php echo "Max Grade: ".$max ?></h4>
						<h4><?php echo "Min Grade: ".$min ?></h4>
						<h4><?php echo "Average Grade: ".$avg ?></h4>
					
					</br></br>
					
					<h3>Student Scores</h3>
					
					<table border="1" id="table">
						<tr>
							<td><h4>Student Name</h4></td>
							<td><h4>Total MCQ Grade</h4></td>
							<td><h4>Total Essay Grade</h4></td>
							<td><h4>Final Percentage</h4></td>
						</tr>
						<?php
						$sql = "SELECT numMCQ FROM courses WHERE name='".$course."'";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						$numMCQ = $result[0];
						
						$sql = "SELECT studentName, totalCorrect, achievedEssayGrade, totalEssayGrade, finalPercentage FROM studentanswers WHERE course='".$course."'";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						
						while($result){
						?>
						<tr>
							<td><h4><?php echo $result[0]; ?></h4></td>
							<td><h4><?php echo $result[1]."/".$numMCQ; ?></h4></td>
							<td><h4><?php echo $result[2]."/".$result[3]; ?></h4></td>
							<td><h4><?php echo $result[4]; ?></h4></td>
						</tr>
						<?php
							$result = mysqli_fetch_row($data);
						}
						?>
					</table>
					
					<div>
						<h3 class="link"><a href="logout.php?account=teacher&userName=<?php echo $userName; ?>">Logout</a></h3>
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
