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

					<div class="entry">
						<h2 class="title"><?php echo $course; ?></h2>
						
						<input type="text" name="course" value="<?php echo $course; ?>" style="display: none" />
						<input type="text" name="userName" value="<?php echo $userName; ?>" style="display: none" />
						<form
						method="post"
						action=""
						>
						
						<?php
							$sql = "SELECT * From ".preg_replace('/\s+/', '', $course);
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							while($result){
						?>
						
						<h4><input type="radio" name="ques" value="<?php echo $result[0]; ?>"><?php echo $result[0].": ".$result[1]; ?></input></h4>
								
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
						
						<button id="login">Delete</button>
						
						</form>
						<h3 class="link"><a href="teacherCoursesPage.php?userName=<?php echo $userName; ?>">Back to Courses</a></h3>
					</div>
					
					<?php
					
						if(isset($_POST['ques'])){
							$sql = "SELECT numMCQ, numEssay FROM courses WHERE id='".$_POST['courseName'].$userName."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							$numMCQ = $result[0];
							$numEssay = $result[1];
							
							$sql = "SELECT isMCQ FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$_POST['ques'];
							$data = mysqli_query($conn, $sql); //Executing the sql query
							$result = mysqli_fetch_row($data); //Extracting information from the executed query
							$isMCQ = $result[0]; //Storing the information in another variable
							
							if($isMCQ){
								$sql = "UPDATE courses SET numMCQ=".($numMCQ-1)." WHERE id = \"".$_POST['courseName'].$userName."\"";
								$data = mysqli_query($conn, $sql); //Executing the sql query
							}
							else{
								$sql = "UPDATE courses SET numEssay=".($numEssay-1)." WHERE id = \"".$_POST['courseName'].$userName."\"";
								$data = mysqli_query($conn, $sql); //Executing the sql query
							}
							
							$sql = "DELETE FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum = \"".$_POST['ques']."\"";
							$data = mysqli_query($conn, $sql); //Executing the sql query
							
							$quesNum = $_POST['ques'];
							$sql = "SELECT quesNum FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum = \"".($quesNum+1)."\"";
							$data = mysqli_query($conn, $sql); //Executing the sql query
							$result = mysqli_fetch_row($data); //Extracting information from executed query
							while($result){ //Condition to loop as long as information is being received
								//Constructing an sql query to modify the question number of the existing questions
								$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET quesNum=".($quesNum-1)." WHERE quesNum = \"".$quesNum."\"";
								$data = mysqli_query($conn, $sql); //Executing the sql query
								
								$quesNum++; //Incerementing the counter
								
								//Constructing an sql query to get the number of the next question
								$sql = "SELECT quesNum FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum = \"".($quesNum)."\"";
								$data = mysqli_query($conn, $sql); //Executing the sql query
								$result = mysqli_fetch_row($data); //Extracting information from executed query
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
