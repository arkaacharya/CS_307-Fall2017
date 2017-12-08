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
						<h2 class="title">Current Enrolment</h2>
						<?php
							$sql = "SELECT course From ".$userName;
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							while($result){
						?>
								<h3><a href="validateTest.php?course=<?php echo $result[0]; ?>&userName=<?php echo $userName?>"><?php echo $result[0]; ?></a></h3>
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
					</div>

					<form
					action=""
					method="post">
					<div class="entry">
						<h2 class="title">Course Search</h2>
						
						<?php
							if(isset($_GET['alreadyRegistered'])){
								?>
									<h3>You have already registered for this course.</h3>
								<?php
							}
						?>
						
						<select name=course>
						<option value=""></option>
						<?php
							$sql = "SELECT id, name, owner From courses";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							while($result){
						?>
								<option value="<?php echo $result[0] ?>"><?php echo $result[1]." - ".$result[2] ?></option>
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
						</select>
						
						<button id="login">Submit</button>
					</div>
					</form>
					
					<?php
						if(isset($_POST['course']) && $_POST['course'] != ""){
							$courseID = $_POST['course'];
							$sql = "SELECT name, owner from courses where id='".$courseID."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							$course = $result[0];
							$teacher = $result[1];
							
							$sql = "SELECT course From ".$userName." WHERE course='".$course."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							if($result){
								header("Location: studentCoursesPage.php?userName=".$userName."&alreadyRegistered=true");
								die;
							}
							
							$sql = "INSERT INTO ".$userName." (course, teacher) VALUES ('".$course."', '".$teacher."')";
							$data = mysqli_query($conn, $sql);
							//header("Location: studentCoursesPage.php?userName=".$userName);
							//die;
						}
						else{
							//header("Location: studentCoursesPage.php?userName=".$userName);
							//die;
						}
					?>
					
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
