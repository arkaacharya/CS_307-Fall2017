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
						<h4><a href="studentToGrade.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>&redirect=gradeEssay">Grade Exams</a></h4>
						<h4><a href="studentToGrade.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>&redirect=review">Review Student Exam</a></h4>
						<h4><a href="reviewStats.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Review Test Statistics</a></h4>


						<h4><a href="modCourseName.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Change Course Name</a></h4>
						<h4><a href="modQues.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Change Questions and Options</a></h4>
						<h4><a href="modNumQues.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Change Number of Questions</a></h4>
						<h4><a href="delQues.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Delete Specific Questions</a></h4>
						<h4><a href="modTime.php?userName=<?php echo $userName; ?>&course=<?php echo $course; ?>">Change Time Limit</a></h4>
	
						
						<h3 class="link"><a href="teacherCoursesPage.php?userName=<?php echo $userName; ?>">Back to Courses</a></h3>
					</div>
					
					<?php
		$sql = "SELECT timeLimit, numMCQ, numEssay FROM courses WHERE id=\"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql);
		$result = mysqli_fetch_row(mysqli_query($conn, $sql));		
		$timeLimit = $result[0];
		$numMCQ = $result[1];
		$numEssay = $result[2];
	?>

	<h3>Test Details:</h3>
	<table>

	<tr><td><font size="+2" face="arial"></br></br>Number of Multiple Choice Questions: <?php echo " ".$numMCQ;?></font></br></tr></td>
	<tr><td><font size="+2" face="arial">Number of Essay Questions: <?php echo " ".$numEssay;?></font></br></tr></td>
	</br></br>
	<tr><td><font size="+2" face="arial">Time Limit for Test: <?php echo " ".$timeLimit." ";?> minute(s) </font></br></tr></td>
	
					
					<?php
		$i = 1;
		$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
		$data = mysqli_query($conn, $sql);
		$result = false;
		if($data){
			$result = mysqli_fetch_row(mysqli_query($conn, $sql));
		}		
		while($result && $i <= $numMCQ){
	?>
	<tr><td>
	<font size="+2" face="arial">
		<b></br></br></br>Question
		<?php
			echo " ".$i.": ".$result[1];
		?></b>
		
		</br></br>a)
		<?php
		echo " ".$result[4];
		?>
		
		</br></br>b)
		<?php
		echo " ".$result[5];
		?>
		
		</br></br>c)
		<?php
		echo " ".$result[6];
		?>
		
		</br></br>d)
		<?php
		echo " ".$result[7];
		?>
		
		</br></br>Correct Answer:
		<?php
		echo " ".$result[8];?>
	
	<?php
			$i++;
			$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
			$data = mysqli_query($conn, $sql);
			$result = mysqli_fetch_row($data);
		}
	?>
	</font>
	</td>
	</tr>

	<?php
			$i = 1;
			$sql = "SELECT question, ansEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
			$data = mysqli_query($conn, $sql);
			$result = false;
			if($data){
				$result = mysqli_fetch_row(mysqli_query($conn, $sql));
			}
			while($result && $i <= $numEssay){
		?>
	<tr><td>
	<font size="+2" face="arial">
		<b></br></br></br>Essay Question
		<?php
		echo " ".$i.": ".$result[0]." ";
		?></b>
		
		</br></br>Answer
		<?php
		echo " ".$i.": ".$result[1]." ";?>
		
		<?php
				$i++;
				$sql = "SELECT question, ansEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
				$data = mysqli_query($conn, $sql);
				$result = mysqli_fetch_row($data);
			}
		?>
					
					
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
