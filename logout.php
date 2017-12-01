<html>
<body>
<form>
	<?php
		$servername = "localhost"; //Name of the server
		$dbname = "examination"; //Name of the database
		$username = "root"; //Username used to connect to the database
		$password = NULL; //Password used to connect to the database

		$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
		if($conn->error){ //Checking connection for errors
			die("Could not establish connection to database."); //Terminating the page
		}
		
		if(isset($_GET['userName'])){ //Checking if username is set
			$userName = $_GET['userName']; //Getting the value of username
		}
		else if(isset($_POST['userName'])){ //Checking if the username is set
			$userName = $_POST['userName']; //Getting the value of username
		}
		else{
			header("Location: login.php"); //Redirecting to the login page
			die; //Terminating this page
		}
		
		if(isset($_GET['account'])){ //Checking if username is set
			$account = $_GET['account']; //Getting the value of username
		}
		else if(isset($_POST['account'])){ //Checking if the username is set
			$account = $_POST['account']; //Getting the value of username
		}
		else{
			header("Location: login.php"); //Redirecting to the login page
			die; //Terminating this page
		}
		
		echo $userName.":".$account;
		
		if($account == "teacher"){
			echo "\nchanging teacher flag\n";
			echo $sql = "UPDATE teachers SET loggedIn=0 WHERE username = \"".$userName."\"";
			$data = mysqli_query($conn, $sql); //Executing the sql query
		}
		else{
			//Creating an sql query to change the login value of the passed user
			$sql = "UPDATE students SET loggedIn=0 WHERE username = \"".$userName."\"";
			$data = mysqli_query($conn, $sql); //Executing the sql query
		}
		
		header("Location: login.php"); //Redirecting to the login page
		die; //Terminating this page
	?>
</form>
</body>
</html>