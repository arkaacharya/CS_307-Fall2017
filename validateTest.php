<html>
<head>
<head>
<body>
<form>
	<?php
		$servername = "localhost"; //Name of server
		$dbname = "examination"; //name of database
		$username = "root"; //Username used to connect to the database
		$password = NULL; //Password used to connect to the database
		
		$userName = $_GET['userName']; //Getting the user's username
		$course = $_GET['course'];
	
		$conn = new mysqli($servername, $username, $password, $dbname); //Establishing a connection to the database
		if($conn->error){ //Checking the connection for errors
			die("Could not establish connection to database."); //Terminating this page
		}
		
		//Constructing an sql query to check if the user has taken an exam from this chapter already
		$sql = "SELECT course FROM studentanswers WHERE studentName = \"".$userName."\"";
		$data = mysqli_query($conn, $sql); //Executing the query

		if($data == false){ //Checking if the query was executed
			header("Location: notEligibleForTest.php?userName=".$userName); //Redirecting to the error page
			die; //Terminating this page
		}

		$result = mysqli_fetch_row($data); //Extracting information from the executed query
		if($result){ //Checking if any information was passed
			$eligible = true; //Initializing a boolean variable
			//Constructing an sql query to get an entry from the table useranswers
			$sql = "SELECT * FROM studentanswers";
			$data = mysqli_query($conn, $sql); //Executing the query
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			while($result){ //Condition to loop as long as information is being received
				//Checking if the username chaptername and if the test has been completed
				if($result[0] == $userName && $result[1] == $course && $result[6] == true){
					$eligible = false; //Changing the value of boolean variable
				}
				$result = mysqli_fetch_row($data); //Exxtracting the information from the executed query
			}
			if(!$eligible){ //Checking eligibility
				header("Location: studentTestStatistics.php?userName=".$userName."&course=".$course); //Redirecting to error page
				die; //Terminating this page
			}
		}
		
		header("Location: displayExam.php?userName=".$userName."&course=".$course); //Redirecting to the exam page
		die; //Terminating this page
	?>
</form>
</body>
</html>