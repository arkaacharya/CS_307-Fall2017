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
					
					<form
					action="storeQuestions.php"
					method="post"
					>
					<div class="entry">
						<h2 class="title"><?php echo $course; ?></h2>
						
						<input type="text" name="course" value="<?php echo $course; ?>" style="display: none" />
						<input type="text" name="userName" value="<?php echo $userName; ?>" style="display: none" />
						
						<?php
		//Creating an sql query to get the number of MCQ and the number of essay questions
		$sql = "SELECT numMCQ, numEssay FROM courses WHERE id = \"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		$result = mysqli_fetch_row($data); //Extracting information from the executed query
		$numMCQ = $result[0]; //Storing the number of MCQ in a separate variable
		$numEssay = $result[1]; //Storing the number of essay questions in a separate variable
		
		for($i = 1; $i <= $numMCQ; $i++){ //Loop for displaying all the spaces MCQ questions
			$sql = "SELECT * FROM ".$testName." WHERE quesNum=".$i; //Creating an sql query to get all the information of a question
			$data = mysqli_query($conn, $sql); //Executing the sql query
			$result=false; //Initializing result
			if($data){ //Checking if the query was executed
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
			}
	?>

	
	
	<h3><b><font size="+2" face="arial">Question <?php echo $i." " ?> (Max 300 characters): </font></b></td>
			<textarea
			name = "ques<?php echo $i?>"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50">
			<?php
			if($result){
				echo $result[1];
			}
			?>
			</textarea>
	</h3>

	<h4><font face="arial"> Option a (Max 300 characters): </font></td>
			<textarea
			name = "opt<?php echo $i?>a"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50"
			><?php
			if($result){
				echo $result[5];
			}
			?></textarea>
	</h4>

	<h4><font face="arial"> Option b (Max 300 characters): </font></td>
			<textarea
			name = "opt<?php echo $i?>b"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50"
			><?php
			if($result){
				echo $result[7];
			}
			?></textarea>
	</h4>

	<h4><font face="arial"> Option c (Max 300 characters): </font></td>
			<textarea
			name = "opt<?php echo $i?>c"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50"
			><?php
			if($result){
				echo $result[9];
			}
			?></textarea>
	</h4>

	<h4><font face="arial"> Option d (Max 300 characters): </font></td>
			<textarea
			name = "opt<?php echo $i?>d"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50"
			><?php
			if($result){
				echo $result[11];
			}
			?></textarea>
	</h4>

	<h4><font face="arial"> Correct Answer (Max 1 characters): </font></td>
			<input type = "text"
			name = "ans<?php echo $i?>"
			size = "1"
			maxlength = "1"
			value = "<?php if($result){echo $result[13];} ?>"
			/>
	</h4>

	<?php
		}
		
		for($i = 1; $i <= $numEssay; $i++){ //Loop to accept all essay questions
			$sql = "SELECT * FROM ".$testName." WHERE quesNum=".($i+$numMCQ); //Creating sql query to get all the information of a question
			$data = mysqli_query($conn, $sql); //Executing the sql query
			$result=false; //Initializing $result
			if($data){ //Checking if the query was executed
				$result = mysqli_fetch_row($data); //Extracting information from executed query
			}
	?>

	<h3><b><font size="+2" face="arial">Essay Question <?php echo $i." " ?> (Max 300 characters): </font></b></td>
			<textarea
			name = "quesEssay<?php echo $i?>"
			size = "300"
			maxlength = "300"
			rows = "1"
			cols = "50"
			><?php if($result){echo $result[1];} ?></textarea>
	</h3>

	<h4><font face="arial">Answer <?php echo $i." " ?> (Max 700 characters): </font></td>
			<textarea
			name = "ansEssay<?php echo $i?>"
			size = "700"
			maxlength = "700"
			rows = "1"
			cols = "50"
			><?php if($result){echo $result[1];} ?></textarea>
	</h4>

	<?php
		}
	?>
								
		<button id="login">Add Questions</button>
		<h3 class="link"><a href="teacherCoursesPage.php?userName=<?php echo $userName; ?>">Back to Courses</a></h3>
	</div>
	</form>
	
	<?php
	
		if(isset($_POST['course']) && isset($_POST['numMCQ']) && isset($_POST['numEssay']) && isset($_POST['timeLimit'])){
			$sql = "SELECT * FROM courses WHERE id='".$_POST['course'].$userName."'";
			$data = mysqli_query($conn, $sql);
			$result = mysqli_fetch_row($data);
			if(!$result){
				$sql = "INSERT INTO courses (ID, name, numMCQ, numEssay, timeLimit, owner) VALUES ('".$_POST['course'].$userName."', '".$_POST['course']."', ".$_POST['numMCQ'].", ".$_POST['numEssay'].", ".$_POST['timeLimit'].",'".$userName."')";
				$data = mysqli_query($conn, $sql);
				
				$sql = "INSERT INTO ".$userName." (course) VALUES ('".$_POST['course']."')";
				$data = mysqli_query($conn, $sql);
				
				header("Location: courseQuestions.php?userName=".$userName."&course=".$course);
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
