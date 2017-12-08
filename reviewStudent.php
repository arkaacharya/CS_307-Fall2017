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
					
					<?php
		$sql = "SELECT timeLimit, numMCQ, numEssay FROM courses WHERE id=\"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql);
		$result = mysqli_fetch_row(mysqli_query($conn, $sql));		
		$timeLimit = $result[0];
		$numMCQ = $result[1];
		$numEssay = $result[2];
	?>
	
	
	<table>
	<h3><?php echo $student.": ".$course ?></h3>
	
	<?php
		$i = 1;
		$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
		$data = mysqli_query($conn, $sql);
		$result = false;
		if($data){
			$result = mysqli_fetch_row(mysqli_query($conn, $sql));
		}
		
		$sql = "SELECT ans".$i." FROM studentanswers WHERE course='".$course."' AND studentName='".$student."'";
		$data1 = mysqli_query($conn, $sql);
		$result1 = mysqli_fetch_row($data1);
		
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
		
		</br></br>Student Answer:
		<?php echo " ".$result1[0]; ?>
	
	<?php
			$i++;
			$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
			$data = mysqli_query($conn, $sql);
			$result = mysqli_fetch_row($data);
			
			$sql = "SELECT ans".$i." FROM studentanswers WHERE course='".$course."' AND studentName='".$student."'";
			$data1 = mysqli_query($conn, $sql);
			if($data1)
				$result1 = mysqli_fetch_row($data1);
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
			
			$sql = "SELECT ansEssay".$i." FROM studentanswers WHERE course='".$course."' AND studentName='".$student."'";
			$data1 = mysqli_query($conn, $sql);
			if($data1)
				$result1 = mysqli_fetch_row($data1);
			
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
		
		</br></br>Student Answer
		<?php echo ": ".$result1[0]; ?>
		
		<?php
				$i++;
				$sql = "SELECT question, ansEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
				$data = mysqli_query($conn, $sql);
				$result = mysqli_fetch_row($data);
				
				$sql = "SELECT ansEssay".$i." FROM studentanswers WHERE course='".$course."' AND studentName='".$student."'";
				$data1 = mysqli_query($conn, $sql);
				if($data1)
					$result1 = mysqli_fetch_row($data1);
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
