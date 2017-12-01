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
				<li><a href="teacherCoursesPage.php?userName=<?php echo $userName ?>">Courses</a></li>
				<li class="current_page_item"><a href="teacherStudentsPage.php?userName=<?php echo $userName ?>">Students</a></li>
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
						<h3>Add Students to Courses</h3>
						
						<?php
							if(isset($_GET['accessAlreadyGranted'])){
								?>
								</h4> Access has already been granted at a prior time. </h4>
								<?php
							}
						?>
						
						<h4>Select Student:<select name="studentAdd">
						<option value=""></option>
						<?php
							$sql = "SELECT name, username From students";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							while($result){
						?>
							<option value = "<?php echo $result[1]; ?>"><?php echo $result[0]." - ".$result[1];?></option>
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
						</select></h4>
						
						<h4>Select Course:<select name="courseAdd">
						<option value=""></option>
						<?php
							$sql = "SELECT course From ".$userName;
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							while($result){
						?>
							<option value = "<?php echo $result[0]; ?>"><?php echo $result[0];?></option>
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
						</select></h4>
						
						<h3>Remove Students from Courses</h3>
						<h4>Select Student:<select name="studentRem">
						<option value=""></option>
						<?php
							echo $sql = "SELECT name, username From students";
							$data = mysqli_query($conn, $sql);
							$result = mysqli_fetch_row($data);
							echo $result[1];
							while($result){
						?>
							<option value = "<?php echo $result[1]; ?>"><?php echo $result[0]." - ".$result[1];?></option>
						<?php
								$result = mysqli_fetch_row($data);
							}
						?>
						</select></h4>
						
						<button id="login">Make Changes</button>
						</form>
						
						<?php
							if(isset($_POST['studentAdd']) && isset($_POST['courseAdd']) && $_POST['studentAdd']!="" && $_POST['courseAdd'] != ""){
								$sql = "SELECT * FROM ".$_POST['studentAdd']." WHERE teacher='".$userName."'";
								$data = mysqli_query($conn, $sql);
								$result = mysqli_fetch_row($data);
								$result[0];
								if($result){
									header("Location: teacherStudentsPage.php?userName=".$userName."&accessAlreadyGranted=true");
									die;
								}
								
								$sql = "INSERT INTO ".$_POST['studentAdd']." (course, teacher) VALUES ('".$_POST['courseAdd']."', '".$userName."')";
								$data = mysqli_query($conn, $sql);
								
								header("Location: teacherStudentsPage.php?userName=".$userName);
								die;
							}
						
							if(isset($_POST['studentRem']) && $_POST['studentRem']!=""){
								$sql = "DELETE FROM ".$_POST['studentRem']." WHERE teacher='".$userName."'";
								$data = mysqli_query($conn, $sql);
								
								header("Location: teacherStudentsPage.php?userName=".$userName);
								die;
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
