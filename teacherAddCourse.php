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
					
					<form
					action=""
					method="post"
					>
					<div class="entry">
						<h2 class="title">Add Course</h2>

						<?php
						
							if(isset($_GET['failAddTest'])){
								?>
								
									</h4> Course Already Exists </h4>
								
								<?php
							}
						
						?>
						
						<h4>Course Name: <input type="text"
								name="course"></input></h4>
								
						<h4>Num MCQ: <input type="number"
								name="numMCQ"></input></h4>
								
						<h4>Num Exam MCQ: <input type="number"
								name="ExamMCQ"></input></h4>


						<h4>Num Essay: <input type="number"
								name="numEssay"></input></h4>
								

						<h4>Num Exam Essay: <input type="number"
								name="ExamEssay"></input></h4>

						<h4>Time Limit: <input type="number"
								name="timeLimit"></input></h4>
								
						<button id="login">Add Course</button>
						<h3 class="link"><a href="teacherCoursesPage.php?userName=<?php echo $userName; ?>">Back to Courses</a></h3>
					</div>
					</form>
					
					<?php
					
						if(isset($_POST['course']) && isset($_POST['numMCQ']) && isset($_POST['numEssay']) && isset($_POST['timeLimit'])){
							$sql = "SELECT * FROM courses WHERE id='".$_POST['course'].$userName."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							if(!$result){


								$sql = "INSERT INTO courses (ID, name, numMCQ, numEssay, ExamMCQ, ExamEssay, timeLimit, owner) 
										VALUES ('".$_POST['course'].$userName."', '".$_POST['course']."', ".$_POST['numMCQ'].", ".$_POST['numEssay'].", ".$_POST['ExamMCQ'].", ".$_POST['ExamEssay'].", ".$_POST['timeLimit'].",'".$userName."')";

								$data = mysqli_query($conn, $sql);
								
								$sql = "INSERT INTO ".$userName." (course) VALUES ('".$_POST['course']."')";
								$data = mysqli_query($conn, $sql);
								
								header("Location: courseQuestions.php?userName=".$userName."&course=".$_POST['course']);
								die;
							}
							else{
								header("Location: teacherAddCourse.php?failAddTest=true&userName=".$userName);
								die;
							}
						}
					
					?>
					
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
