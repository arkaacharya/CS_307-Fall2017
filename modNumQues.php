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
	action=""
	method="post">
		
		<div id="insideBody">

		
		<h4>Num MCQ: <input type="number"
				name="numMCQ"></input></h4>
				
		<h4>Num Exam MCQ: <input type="number"
				name="ExamMCQ"></input></h4>

		<h4>Num Essay: <input type="number"
				name="numEssay"></input></h4>
				
		<h4>Num Exam Essay: <input type="number"
				name="ExamEssay"></input></h4>

		<button id="login">Make Changes</button>
		
	</form>
	
	<?php
	
	if(isset($_POST['numMCQ']) && isset($_POST['numEssay']) && isset($_POST['ExamMCQ']) && isset($_POST['ExamEssay'])){
		$numMCQ = preg_replace('/\s+/', '', $_POST['numMCQ']); //Getting the number of MCQ
		$numEssay = preg_replace('/\s+/', '', $_POST['numEssay']); //Getting the number of essay questions
		$ExamMCQ = preg_replace('/\s+/', '', $_POST['ExamMCQ']);
		$ExamEssay = preg_replace('/\s+/', '', $_POST['ExamEssay']);
		
		
		//Constructing an sql query to get the previous number of MCQ and essay questions
		$sql = "SELECT numMCQ, numEssay FROM courses WHERE id = \"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		$result = mysqli_fetch_row($data); //Extracting the information from the executed query
		$numMCQOld = $result[0]; //Storing the old number of MCQ
		$numEssayOld = $result[1]; //Storing the old number of Essay questions
		
		if($numMCQ == ""){
			$numMCQ = $numMCQOld;
		}
		
		if($numEssay == ""){
			$numEssay = $numEssayOld;
		}
		
		if($numMCQ == 0 && $numEssay == 0){
			header("Location: modNumQues.php?userName=".$userName."&course=".$course); //Redirecting to the next page
			die; //Terminating this page
		}
	
	
		//Constructing an sql query to store the new number of MCQ and essay questions
		$sql = "UPDATE courses SET numMCQ=".$numMCQ.", numEssay=".$numEssay.", ExamMCQ=".$ExamMCQ.", ExamEssay=".$ExamEssay." WHERE id = \"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		
		if($numMCQ < $numMCQOld){ //Checking if the number of old questions is more than the number of new questions
			$numQues = $numMCQ+1; //Incrementing the variable
			//Constructing an sql query to check if the question is an MCQ or not
			$sql = "SELECT isMCQ FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
			$data = mysqli_query($conn, $sql); //Executing the sql query
			$result = mysqli_fetch_row($data); //Extracting the information from executed query
			while($result){ //Condition to loop as long as information is being returned
				if($result[0]){ //Checking if it is an MCQ or not
					//Constructing an sql query to delete the appropriate question
					$sql = "DELETE FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
					$data = mysqli_query($conn, $sql); //Executing the query
				
					$numQues = $numQues+1; //Incrementing the variable
					//Creating an sql query to check if there are any questions after this current one
					$sql = "SELECT quesNum FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
					$data = mysqli_query($conn, $sql); //Executing query
					$result_new = mysqli_fetch_row($data); //Extracting information from the executed query
					while($result_new){ //Condition to loop as long as information is being received
						//Creating an sql query to update the question number of the next question
						$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET quesNum=".($numQues-1)." WHERE quesNum=".$numQues;
						$data = mysqli_query($conn, $sql); //Executing the query
						$numQues++; //Incrementing the number of questions
						//Craeting an sql query to check if there is another question
						$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
						$data = mysqli_query($conn, $sql); //Executing the query
						$result_new = mysqli_fetch_row($data); //Extracting the information from the query
					}
				}
				
				//Creating an sql query to check if the next question is an MCQ
				$sql = "SELECT isMCQ FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
				$data = mysqli_query($conn, $sql); //Executing the query
				$result = mysqli_fetch_row($data); //Extracting the information from the executed query
			}
			
			$numQues = $numMCQ+1+$numEssay; //Modifying the value of variable
			//Constructing an sql query to check if the question is an essay question
			$sql = "SELECT isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
			$data = mysqli_query($conn, $sql); //Executing the query
			$result = mysqli_fetch_row($data); //Extracting the information from the executed query
			while($result && $result[0]){ //Condition to loop as long as information is being returned
				//Constructing an sql query to delete the appropriate question
				$sql = "DELETE FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
				$data = mysqli_query($conn, $sql); //Executing the query
				$numQues++; //Incrementing the variable
				//Constructing an sql query to check if the question is an essay question
				$sql = "SELECT isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
				$data = mysqli_query($conn, $sql); //Executing the query
				$result = mysqli_fetch_row($data); //Extracting the information from the executed query
			}
		}
		else{
			$numQues = $numMCQOld + $numEssayOld; //Storing total number of old questions
			$newNumQues = $numMCQ + $numEssay;  //Storing total number of new questions
			//Constructing an sql query to check if the question is an essay question or not
			$sql = "SELECT isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
			$data = mysqli_query($conn, $sql); //Executing the query
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			while($result && $result[0]){ //Condition to loop as long as there is information passed and if the questions is an essay question
				//Constructing an sql query to update the question number of the current question
				$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET quesNum=".$newNumQues." WHERE quesNum=".$numQues;
				$data = mysqli_query($conn, $sql); //Executing the query
				
				$numQues--; //Decrementing the variable
				$newNumQues--; //Decrementing the variable
				
				//Constructing an sql query to check whether the next question is an essay question
				$sql = "SELECT isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$numQues;
				$data = mysqli_query($conn, $sql); //Executing the query
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
			}
		}
	
		header("Location: modQues.php?userName=".$userName."&course=".$course); //Redirecting to the next page
		die; //Terminating this page
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
