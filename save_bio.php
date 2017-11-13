<?php

	$servername = "localhost"; //Name of the server
	$dbname = "examination"; //Name of the database
	$username = "root"; //Username used to connect to the database
	$password = NULL; //Password used to connect to the database

	$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
	if($conn->error){ //Checking connection for errors
		die("Could not establish connection to database."); //Terminating the page
	}
	
	echo $userName = $_POST['userName'];
	echo $account = $_POST['account'];
	echo $bio = $_POST['bio'];

	if($account == "teacher"){
		echo $sql = "UPDATE teachers SET bio='".$bio."' WHERE username='".$userName."'";
		$data = mysqli_query($conn, $sql);
		header("Location: teacherAccountPage.php?userName=".$userName);
	}
	else{
		$sql = "UPDATE students SET bio='".$bio."' WHERE username='".$userName."'";
		$data = mysqli_query($conn, $sql);
		header("Location: studentAccountPage.php?userName=".$userName);
	}
?>