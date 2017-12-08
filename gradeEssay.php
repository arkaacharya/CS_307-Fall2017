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
	$student = $_GET['student'];
	
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
						action="inputGrades.php"
						method="post"
						>
						
						<input type = "text"
						name = "userName"
						value = <?php echo $userName;?>
						style = "display: none"
						readonly />
						
						<input type = "text"
						name = "student"
						value = <?php echo $student;?>
						style = "display: none"
						readonly />
						
						<input type = "text"
						name = "course"
						value = <?php echo $course;?>
						style = "display: none"
						readonly />
						
						<h3><?php echo $student.": ".$course ?></h3>
						<?php
							$sql = "SELECT numEssay,numMCQ From courses WHERE name='".$course."'";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							$numEssay = $result[0];
							$numMCQ = $result[1];
						?>
						<table>
							<?php
								for($i = 1; $i <= $numEssay; $i++){
									$sql = "SELECT ansEssay".$i." From studentanswers WHERE course='".$course."' AND studentName='".$student."';";
									$data1 = mysqli_query($conn, $sql);
									$result1 = mysqli_fetch_row($data1);
									
									$sql = "SELECT question, ansEssay From ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
									$data2 = mysqli_query($conn, $sql);
									$result2 = mysqli_fetch_row($data2);
							?>
								<tr>
									<td>
									<h4>Question <?php echo " ".$i; ?>: <?php echo " ".$result2[0] ?><h4>
									<h4>Answer Key: <?php echo " ".$result2[1] ?><h4>
									<h4>Student Answer: <?php echo " ".$result1[0] ?><h4>
									<h4>Given Grade: <input type = "number" name = "essay<?php echo $i;?>Grade"/><h4>
									<h4>Max Possible: <input type = "number" name = "essay<?php echo $i;?>MaxGrade"/><h4>
									<h4>Feedback: <input type = "text" name = "essay<?php echo $i;?>Feedback"/><h4>
									</br></br>
									</td>
								</tr>
							<?php
								}
							?>
						</table>
						
						<button id="login">Submit Grades</button>
						</form>
						
						<?php
							if(isset($_POST['selectStudent'])){
								if($redirect == "gradeEssay"){
									header("Location: gradeEssay.php?userName=".$userName."&student=".$_POST['selectStudent']."&course=".$course);
								}
								else if($redirect == "review"){
									header("Location: gradeEssay.php?userName=".$userName."&student=".$_POST['selectStudent']."&course=".$course);
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
