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

						if(isset($_GET['editBio'])){
					?>
					<form
					action="save_bio.php"
					method="post">
						<div class="entry">
							<h2 class="title">Bio</h2>
							
							<input type = "text"
							name = "userName"
							size = "50"
							value="<?php echo $userName ?>"
							readonly = "readonly"
							maxlength = "50"
							style = "display: none"
							/>
							
							<input type = "text"
							name = "account"
							size = "50"
							value="student"
							readonly = "readonly"
							maxlength = "50"
							style = "display: none"
							/>
							
							<textarea
							name = "bio"
							size = "300"
							maxlength = "300"
							rows = "2"
							cols = "50">
							<?php echo $bio; ?>
							</textarea>
							
							<button>Save</button>
						</div>
					</form>
					<?php
						}
						else{
					?>
					<div class="entry">
						<h2 class="title">Bio</h2>
						<h3 class="text"><?php echo $bio; ?></h3>
						<h3 class="link"><a href="student_page.php?editBio=true&userName=<?php echo $userName; ?>">Edit Bio</a></h3>
					</div>

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
					

					<div>
						<h3 class="link"><a href="logout.php?account=student&userName=<?php echo $userName; ?>">Logout</a></h3>
					</div>

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


<div>
	<p>\n\n</p>
</div>

</body>
</html>

