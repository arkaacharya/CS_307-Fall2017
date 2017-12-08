<html>
<body>
<form>
	<?php
		$servername = "localhost"; //Name of server
		$dbname = "examination"; //Name of database
		$username = "root"; //Username used to connedt to database
		$password = NULL; //Password used to connect to database
		
		echo $userName = $_POST['username']; //Getting the user's username
		echo $passWord = $_POST['password']; //Getting the user's password
		echo $account = $_POST['account'];
	
		$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
		if($conn->error){ //Checking connection for errors
			die("Could not establish connection to database."); //Terminating this page
		}
		if($account == "teacher"){
			echo $sql = "SELECT password FROM teachers WHERE username = \"".$userName."\"";
			$data = mysqli_query($conn, $sql); //Executing the query

			if($data == false){ //Checking if the query was executed
				header("Location: errorLogin.php"); //Redirecting to the error page
				die; //Terminating this page
			}
			
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			echo $result[0];
			if($password = $result[0]){
				$sql = "UPDATE teachers SET loggedIn=1 WHERE username = \"".$userName."\"";
				$data = mysqli_query($conn, $sql); //Executing the query
				
				header("Location: teacherAccountPage.php?userName=".$userName);
				die;
			}
			else{
				echo "failed";
				header("Location: login.php?failLogin=true");
				die;
			}
		}
		else{
			$sql = "SELECT password FROM students WHERE username = \"".$userName."\"";
			$data = mysqli_query($conn, $sql); //Executing the query

			if($data == false){ //Checking if the query was executed
				header("Location: errorLogin.php"); //Redirecting to the error page
				die; //Terminating this page
			}
			
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			
			if($password = $result[0]){
				$sql = "UPDATE students SET loggedIn=1 WHERE username = \"".$userName."\"";
				$data = mysqli_query($conn, $sql); //Executing the query
				
				header("Location: studentAccountPage.php?userName=".$userName);
				die;
			}
			else{
				header("Location: login.php?failLogin=true");
				die;
			}
		}
	?>
</form>
</body>
</html>