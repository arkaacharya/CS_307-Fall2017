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
						<h4>New Time Limit: <input type="number"
								name="timeLimit"/></h4>
						
						<button id="login">Save</button>
						</form>
						<h3 class="link"><a href="teacherCoursesPage.php?userName=<?php echo $userName; ?>">Back to Courses</a></h3>
					</div>
					
					<?php
					
						if(isset($_POST['timeLimit'])){
							$sql = "UPDATE courses SET timeLimit=".$_POST['timeLimit']." WHERE id='".$course.$userName."'";
							$data = mysqli_query($conn, $sql);
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
