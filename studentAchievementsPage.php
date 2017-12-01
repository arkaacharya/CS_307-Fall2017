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
				<li><a href="studentCoursesPage.php?userName=<?php echo $userName ?>">Courses</a></li>
				<li class="current_page_item"><a href="studentAchievementsPage.php?userName=<?php echo $userName ?>">Achievements</a></li>
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

					<?php
						$sql = "SELECT finalPercentage From studentanswers WHERE studentName='".$userName."' AND finalPercentage >= 50";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						if($result){
					?>
						<h3><?php echo "Achievement Unlocked. Passed an Exam with more than 50%" ?><h3>
					<?php
						}
					?>
					
					<?php
						$sql = "SELECT finalPercentage From studentanswers WHERE studentName='".$userName."' AND finalPercentage = 100";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						if($result){
					?>
						<h3><?php echo "Achievement Unlocked. Aced an Exam. Received 100%" ?><h3>
					<?php
						}
					?>
					
					<?php
						$sql = "SELECT COUNT(finalPercentage) From studentanswers WHERE studentName='".$userName."'";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						if($result[0] >= 10){
					?>
						<h3><?php echo "Achievement Unlocked. Completed more than 10 Exams" ?><h3>
					<?php
						}
					?>
					
					<?php
						$sql = "SELECT finalPercentage From studentanswers WHERE studentName='".$userName."' AND finalPercentage < 50";
						$data = mysqli_query($conn, $sql);
						$result = mysqli_fetch_row($data);
						if($result){
					?>
						<h3><?php echo "Achievement Unlocked. Failed an Exam with more than 50%" ?><h3>
					<?php
						}
					?>
					
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